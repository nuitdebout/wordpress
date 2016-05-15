<?php

namespace NuitDebout\Wordpress\Cities;

function hydrate_city($city_page)
{
	$fields = get_fields($city_page->ID);

	$other_links = [];
	if (!empty($fields['city_external_links'])) {
		$other_links = explode(PHP_EOL, $fields['city_external_links']);
	}

	return [
		'name' => $city_page->post_title,
		'official_website' => $fields['city_official_website'],
		'facebook_url' => $fields['facebook_page_url'],
		'twitter_url' => $fields['twitter_page_url'],
		'wiki_url' => $fields['wiki_page_url'],
		'coordinates' => $fields['city_coordinates'],
		'gathering_details' => $fields['city_gathering_details'],
		'other_links' => $other_links,
		'page_id' => $city_page->ID,
	];
}

function get_cities()
{
	$cities = [];
	if ($city_pages = get_pages(['child_of' => 17, 'post_type' => 'page', 'post_status' => 'publish'])) {
	    foreach ($city_pages as $city_page) {
	    	$cities[] = hydrate_city($city_page);
	    }
	}

	return $cities;
}

function find_city($page_id)
{
	if ($city_page = get_page($page_id)) {

		return hydrate_city($city_page);
	}

	return null;
}

function ajax_search_action()
{
	$q = $_GET['q'];

	$cities = get_cities();
	if (!empty($q)) {
		$cities = array_filter($cities, function($city) use ($q) {
			return false !== strpos(strtolower($city['name']), strtolower($q));
		});
	}

	echo json_encode($cities);
	exit;
};

add_action('wp_ajax_cities_api_search', __NAMESPACE__ . '\\ajax_search_action');
add_action('wp_ajax_nopriv_cities_api_search', __NAMESPACE__ . '\\ajax_search_action');

function ajax_find_action()
{
	$page_id = $_GET['id'];

	if ($city = find_city($page_id)) {
		echo json_encode($city);
		exit;
	}

	// TODO Send HTTP 404
};

add_action('wp_ajax_cities_api_find', __NAMESPACE__ . '\\ajax_find_action');
add_action('wp_ajax_nopriv_cities_api_find', __NAMESPACE__ . '\\ajax_find_action');

function ajax_render_city_details_action()
{
	$page_id = $_GET['id'];

	if ($city = find_city($page_id)) {
		include locate_template('templates/module-city_details.php');
		exit;
	}

	// TODO Send HTTP 404
}

add_action('wp_ajax_cities_api_render_city_details', __NAMESPACE__ . '\\ajax_render_city_details_action');
add_action('wp_ajax_nopriv_cities_api_render_city_details', __NAMESPACE__ . '\\ajax_render_city_details_action');