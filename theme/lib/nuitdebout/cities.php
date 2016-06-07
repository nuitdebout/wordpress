<?php

namespace NuitDebout\Wordpress\Cities;

/* Classes */

class City implements \JsonSerializable
{
	public $id;
	public $slug;
	public $name;
	public $officia_website;
	public $facebook_url;
	public $twitter_url;
	public $wiki_url;
	public $coordinates;
	public $gathering_details;
	public $other_links;

	private $commissions_loaded = false;
	private $commissions = [];
	private $page;

	public function __construct($page)
	{
		$this->page = $page;

		$this->id = $page->ID;
		$this->slug = $page->post_name;
		$this->name = $page->post_title;

		$fields = get_fields($page->ID);

		$other_links = [];
		if (!empty($fields['city_external_links'])) {
			$other_links = explode(PHP_EOL, $fields['city_external_links']);
		}

		$this->official_website = $fields['city_official_website'];
		$this->facebook_url = $fields['facebook_page_url'];
		$this->twitter_url = $fields['twitter_page_url'];
		$this->wiki_url = $fields['wiki_page_url'];
		$this->coordinates = $fields['city_coordinates'];
		$this->gathering_details = $fields['city_gathering_details'];
		$this->other_links = $other_links;
	}

	public function hasCommissions()
	{
		return !empty($this->getCommissions());
	}

	public function getCommissions()
	{
		if (!$this->commissions_loaded) {
			if ($pages = get_pages(['child_of' => $this->page->ID, 'post_type' => 'page', 'post_status' => 'publish'])) {
			    foreach ($pages as $page) {
			    	$this->commissions[] = new Commission($page);
			    }
			}
			$this->commissions_loaded = true;
		}

		return $this->commissions;
	}

	public function __get($name)
	{
	    switch ($name) {
	    	case 'commissions':
	    		return $this->getCommissions();
	    		break;
	    }
	}

	public function jsonSerialize()
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'official_website' => $this->official_website,
			'facebook_url' => $this->facebook_url,
			'twitter_url' => $this->twitter_url,
			'wiki_url' => $this->wiki_url,
			'coordinates' => $this->coordinates,
			'gathering_details' => $this->gathering_details,
			'other_links' => $this->other_links,
		];
	}
}

class Commission
{
	public $name;
	public $contact_email;
	public $goals;

	public function __construct($page)
	{
		$this->page = $page;

		$this->id = $page->ID;
		$this->slug = $page->post_name;
		$this->name = $page->post_title;

		$this->contact_email = get_field('contact_email', $page->ID);
		$this->goals = get_field('commission_goals', $page->ID);
	}
}

/* Functions */

function get_cities()
{
	$cities = [];
	if ($city_pages = get_pages(['child_of' => 17, 'post_type' => 'page', 'post_status' => 'publish'])) {
	    foreach ($city_pages as $city_page) {
	    	$cities[] = new City($city_page);
	    }
	}

	return $cities;
}

function find_city($page_id)
{
	if ($city_page = get_page($page_id)) {
		$city = new City($city_page);

		return $city;
	}

	return null;
}

/* Ajax actions */

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