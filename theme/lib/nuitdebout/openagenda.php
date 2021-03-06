<?php

namespace NuitDebout\Wordpress\OpenAgenda;

use Goutte\Client as GoutteClient;
use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Cache\VoidCache;

class JsonApiClient extends GoutteClient
{
	private $agendaID = '27805494';
	private $cache;

	public function __construct(Cache $cache)
	{
		$this->cache = $cache;

		parent::__construct();
	}

	public function getEvents(array $params = [])
	{
		$cache_key = 'openagenda_request_'.sha1(json_encode($params));

		if (!$events = $this->cache->fetch($cache_key)) {

			$events = [];

			$get_params = ['oaq' => $params];

			$page = 1;

			try {

				while (true) {

					$get_params['page'] = $page;
					$query_string = http_build_query($get_params);

					$url = "https://openagenda.com/agendas/{$this->agendaID}/events.json?{$query_string}";
					$this->request('GET', $url);

					$content = $this->getResponse()->getContent();
					$data = json_decode($content, true);

					if (empty($data['events'])) {
						break;
					}

					$events = array_merge($events, $data['events']);
					$page++;
				}

			} catch (\Exception $e) {}

			// Dirty fix for Paris
			$events = array_map(function($event) {
				if (preg_match('/Paris-[0-9]+E-Arrondissement/', $event['city'])) {
					$event['city'] = 'Paris';
				}

				return $event;
			}, $events);

			// Cache for 5 minutes
			$this->cache->save($cache_key, $events, 5 * 60);
		}

		return $events;
	}
}

function get_next_timing($event, \DateTime $date = null)
{
	if (!$date) {
		$date = new \DateTime('now');
	}

	$date->setTime(0, 0, 0);

	foreach ($event['timings'] as $timing) {
		$start = new \DateTime($timing['start'], new \DateTimeZone('UTC'));
		$start->setTimeZone(new \DateTimeZone('Europe/Paris'));
		if ($start >= $date) {
			return $start;
		}
	}
}

function get_cities()
{
	$events = [];
	foreach (get_dates() as $date) {
		$events = array_merge($events, get_events_by_date($date));
	}

	$cities = [];

	foreach ($events as $event) {
		$city = $event['city'];
		if ($city != '') $cities[] = $city;
	}

	$cities = array_values(array_unique($cities));

	sort($cities);

	array_unshift($cities, get_default_city());

	return $cities;
}

function get_featured_events()
{
	$dates = [
		new \DateTime('now'),
		new \DateTime('+1 day'),
		new \DateTime('+2 days'),
	];

	$events = [];
	foreach ($dates as $date) {
		$events = array_merge($events, get_events_by_date($date));
	}

    return filter_featured($events);
}

function has_featured_events()
{
    return count(get_featured_events()) > 0;
}

function get_events_by_date(\DateTime $date)
{
	global $client;

	$events = $client->getEvents([
		'from' => $date->format('Y-m-d'),
		'to' => $date->format('Y-m-d'),
	]);

	usort($events, function($a, $b) use ($date) {
		$next_timing_a = get_next_timing($a, $date);
		$next_timing_b = get_next_timing($b, $date);

		if ($next_timing_a === $next_timing_b) {
			return 0;
		}

		return $next_timing_a < $next_timing_b ? -1 : 1;
	});

	return $events;
}

function filter_by_city(array $events, $city)
{

	if ($city == get_default_city()) return $events;

	return array_values(array_filter($events, function($event) use ($city) {
		return $event['city'] == $city;
	}));
}

function filter_featured(array $events)
{
	return array_values(array_filter($events, function($event) {
		return $event['featured'] == 1;
	}));
}

function get_default_city()
{
	return 'Toutes les villes';
}

function get_dates()
{

	$events = get_next_events();

	$dates = [];

	foreach ($events as $event) {

		$date = get_next_timing($event);
		$date = $date->format('Y-m-d');
		array_push($dates, $date);

	}

	$dates = array_unique($dates);

	$results = [];

	foreach ($dates as $date) {

		array_push($results, date_create_from_format('Y-m-d', $date));

	}

	return $results;
}

function get_next_events()
{
	global $client;

	$now = new \DateTime('now');

	$events = $client->getEvents([
		'from' => $now->format('Y-m-d'),
		'to' => date('Y-m-d', strtotime('+1 year'))
	]);

	usort($events, function($a, $b) use ($date) {
		$next_timing_a = get_next_timing($a, $date);
		$next_timing_b = get_next_timing($b, $date);

		if ($next_timing_a === $next_timing_b) {
			return 0;
		}

		return $next_timing_a < $next_timing_b ? -1 : 1;
	});

	return $events;
}

/* Wordpress actions */

define('USE_CACHE', true);

$cache = USE_CACHE ? new FilesystemCache(__DIR__.'/../../cache/agenda') : new VoidCache();
$client = new JsonApiClient($cache);

function precache_events()
{
	if (is_main_site() && is_front_page()) {
		foreach (get_dates() as $date) {
			get_events_by_date($date);
		}
	}
}

// TODO Find a callback which is called earlier during Wordpress request lifecycle
add_action('wp_head', __NAMESPACE__ . '\\precache_events');

function ajax_action()
{
	global $client;

	$city = isset($_GET['city']) ? $_GET['city'] : get_default_city();
	$date = isset($_GET['date']) ? new \DateTime($_GET['date']) : new \DateTime('now');

	$events = get_events_by_date($date);
	$events = filter_by_city($events, $city);

	if (isset($_GET['featured'])) {
		$events = filter_featured($events);
	}

	foreach ($events as $event) {
		include locate_template('templates/module-oaevent.php');
	}

	exit;
};

add_action('wp_ajax_openagenda', __NAMESPACE__ . '\\ajax_action');
add_action('wp_ajax_nopriv_openagenda', __NAMESPACE__ . '\\ajax_action');
