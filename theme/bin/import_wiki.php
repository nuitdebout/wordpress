<?php

if (php_sapi_name() !== 'cli') {
	exit(1);
}

require __DIR__.'/../vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

define('WIKI_BASE_URL', 'https://wiki.nuitdebout.fr/api.php');

function wiki_get_cities()
{
	$client = new Client();
	$client->request('GET', WIKI_BASE_URL
		.'?action=query&generator=categorymembers&gcmtitle=Cat%C3%A9gorie:Ville_NuitDebout&prop=pagecllimit=max&gcmlimit=max&format=json');

	$data = json_decode($client->getResponse()->getContent(), true);

	$exclude = ['en', 'fr', 'pt'];
	$cities = [];
	foreach ($data['query']['pages'] as $page) {
		if (preg_match('#^Villes/(.*)#', $page['title'], $matches)) {
			$city = $matches[1];
			if (!in_array($city, $exclude)) {
				$cities[] = [
					'name' => $city,
					'page_title' => $page['title'],
				];
			}
		}
	}

	return $cities;
}

function wiki_get_city_details($city)
{
	$client = new Client();
	$client->request('GET', WIKI_BASE_URL
		.'?action=parse&page='.$city['page_title'].'&contentmodel=wikitext&format=json');

	$data = json_decode($client->getResponse()->getContent(), true);

	$wiki_text = $data['parse']['text']['*'];

	$crawler = new DomCrawler($wiki_text);

	// <h2><span class="mw-headline" id="Lieux">Lieux</span><span class="mw-editsection"><span class="mw-editsection-bracket">[</span><a href="/index.php?title=Villes/Auch&amp;veaction=edit&amp;vesection=2" title="Modifier la section : Lieux" class="mw-editsection-visualeditor">modifier</a><span class="mw-editsection-divider"> | </span><a href="/index.php?title=Villes/Auch&amp;action=edit&amp;section=2" title="Modifier la section : Lieux">modifier le wikicode</a><span class="mw-editsection-bracket">]</span></span></h2>
	// <p>Rassemblement place de la République (Parvis de la cathédrale)
	// </p>

	// Extract place from HTML code
	$gathering_details = null;
	if (count($crawler->filter('#Lieux')) === 1) {
		$crawler->filter('#Lieux')->parents()->each(function($node) use (&$gathering_details) {
			if ($node->getNode(0)->tagName === 'h2') {
				$node->nextAll()->each(function($node, $i) use (&$gathering_details) {
					if ($i === 0) {
						$gathering_details = trim($node->text());
					}
				});
			}
		});
	}

	if ($gathering_details == 'Rassemblement sur la place XXXXXXX.') {
		$gathering_details = null;
	}

	$links = [];
	if (!empty($data['parse']['externallinks'])) {
		$external_links = array_filter($data['parse']['externallinks'], function($link) {
			return !in_array($link, [
				'https://twitter.com/NOM_DU_COMPTE_TWITTER',
				'https://twitter.com/NOMBRE_DE_LA_CUENTA_TWITTER',
				'https://openagenda.com/nuitdebout/addevent',
			]);
		});
		foreach ($external_links as $link) {
			if (preg_match('#facebook\.com/(events|groups)#', $link)) {
				$links['city_external_links'][] = $link;
				continue;
			}
			if (preg_match('#facebook\.com/[^/]+/?$#', $link)) {
				$links['facebook_page_url'] = $link;
				continue;
			}
			if (preg_match('/twitter\.com/', $link)) {
				$links['twitter_page_url'] = $link;
				continue;
			}
			if (preg_match('/chat\.nuitdebout\.fr/', $link)) {
				$links['chat_page_url'] = $link;
				continue;
			}
			if (preg_match('#https?://.*nuitdebout.*\.[a-z]{2,3}#', $link)) {
				$links['city_official_website'] = $link;
				continue;
			}
			if (preg_match('/@/', $link)) {
				$links['city_contact_emails'][] = $link;
				continue;
			}

			$links['city_external_links'][] = $link;
		}
	}

	return [
		'name' => $city['name'],
		'gathering_details' => $gathering_details,
		'links' => $links,
		'wiki_url' => 'https://wiki.nuitdebout.fr/wiki/'.$city['page_title'],
	];
}

function get_map_data($city_name)
{
	static $city_map;

	if (empty($city_map)) {
		$geojson = json_decode(file_get_contents(__DIR__.'/nuitdebout.geojson'), true);
		$city_map = [];
		foreach ($geojson['features'] as $feature) {
			$name = $feature['properties']['name'];

			$name = preg_replace('/Nuit ?Debout/i', '', $name);
			$name = str_replace('#', '', $name);
			$name = trim($name);

			if (!empty($name)) {
				$city_map[$name] = [
					'coordinates' => $feature['geometry']['coordinates'],
					'description' => isset($feature['properties']['description']) ? $feature['properties']['description'] : null,
				];
			}
		}
	}

	if (isset($city_map[$city_name])) {
		return $city_map[$city_name];
	}
}

function get_city_page($city_name)
{
	static $city_pages;

	if (empty($city_pages)) {
		$pages = get_pages([
			'child_of' => 17,
			'post_type' => 'page',
			'post_status' => 'publish'
		]);

		$city_pages = [];
		foreach ($pages as $page) {
			$city_pages[$page->post_title] = $page;
		}
	}

	return isset($city_pages[$city_name]) ? $city_pages[$city_name] : null;
}

function get_acf_field_id($field_name)
{
	$fields_map = [
		'twitter_page_url' => 'field_331qsd1d8218',
		'facebook_page_url' => 'field_3315qs318218',
		'wiki_page_url' => 'field_3314574576sdf45658',
		'chat_page_url' => 'field_331qdqd456456456452348',
		'city_coordinates' => 'field_5736075ea71fd',
		'city_contact_emails' => 'field_57360fe247c7b',
		'city_external_links' => 'field_57364c9f221c5',
		'city_official_website' => 'field_5736069ccbb62',
		'city_gathering_details' => 'field_5736696cb5ee9',
	];

	return isset($fields_map[$field_name]) ? $fields_map[$field_name] : null;
}

function update_acf_field($post_id, $field_name, $field_value)
{
	if ($field_id = get_acf_field_id($field_name)) {
		$result = update_field($field_id, $field_value, $post_id);
		echo "- Updated field {$field_name} : ".var_export($result, true)."\n";
	}
}

//////////////////////////////////////////

$parent_id = 17;
$cities = wiki_get_cities();
foreach ($cities as $city) {

	$city = wiki_get_city_details($city);

	echo "Processing {$city['name']}…\n";

	$is_new = false;
	if (!$city_page = get_city_page($city['name'])) {
		echo "- Page does not exist, creating page…\n";
		$is_new = true;

		$post_params = array(
			'post_title'    =>  $city['name'],
			'post_content'  => '',
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_type' => 'page',
			'post_parent' =>  $parent_id,
		);

		$page_id = wp_insert_post($post_params, true);
		if (is_wp_error($page_id)) {
			echo "ERROR:\n";
			foreach ($page_id->get_error_messages() as $error) {
				echo "{$error}\n";
			}
			exit(1);
		}

		$city_page = get_post($page_id);
	} else {
		echo "- Page already exists ({$city_page->ID})\n";
	}

	update_post_meta($city_page->ID, '_wp_page_template', 'page-ville.php');

	update_acf_field($city_page->ID, 'wiki_page_url', $city['wiki_url']);

	if (!empty($city['gathering_details'])) {
		update_acf_field($city_page->ID, 'city_gathering_details', $city['gathering_details']);
	}

	if ($city['links']) {
		foreach ($city['links'] as $key => $link) {
			update_acf_field($city_page->ID, $key, is_array($link) ? implode("\n", $link) : $link);
		}
	}

	if ($map_data = get_map_data($city['name'])) {

		if ($is_new && !empty($map_data['description'])) {
			$city_page->post_content = $map_data['description'];
			wp_update_post($city_page);
		}

		update_acf_field($city_page->ID, 'city_coordinates', [
			'address' => $city['name'],
			'lat' => $map_data['coordinates'][1],
			'lng' => $map_data['coordinates'][0],
		]);
	}
}