<?php

namespace NuitDebout\Wordress\OpenAgenda;

use Goutte\Client as GoutteClient;
use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Cache\VoidCache;

class Registry
{
	private static $events = [];

	public static function setEvents(array $events = [])
	{
		self::$events = $events;
	}

	public static function getEvents()
	{
		return self::$events;
	}
}

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
		$cache_key = sha1(json_encode($params));

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

			// FIXME should rely on timings, not firstDate / firstTimeStart
			usort($events, function($a, $b) {
				$date_a = new \DateTime($a['firstDate'].' '.$a['firstTimeStart']);
				$date_b = new \DateTime($b['firstDate'].' '.$b['firstTimeStart']);
				if ($date_a === $date_b) {
					return 0;
				}

				return $date_a < $date_b ? -1 : 1;
			});

			$this->cache->save($cache_key, $events, 5 * 60);
		}

		return $events;
	}
}

function get_cities()
{
	$events = get_events();

	$cities = [];
	foreach ($events as $event) {
		$city = $event['city'];
		$cities[] = $city;
	}

	$cities = array_values(array_unique($cities));

	sort($cities);

	return $cities;
}

function get_events(\DateTime $date = null)
{
	$events = Registry::getEvents();

	if (isset($date)) {
		return filter_by_date($events, $date);
	}

	return $events;
}

function filter_by_date(array $events, \DateTime $date)
{
	return array_filter($events, function($event) use ($date) {
		foreach ($event['timings'] as $timing) {
			$start = new \DateTime($timing['start']);
			if ($start->format('Y-m-d') === $date->format('Y-m-d')) {

				return true;
			}
		}

		return false;
	});
}

function filter_by_city(array $events, $city)
{
	return array_filter($events, function($event) use ($city) {
		return $event['city'] == $city;
	});
}

function get_default_city()
{
	return 'Paris';
}

function get_dates()
{
	$dates = [
		new \DateTime('now'),
		new \DateTime('+1 day'),
		new \DateTime('+2 days'),
		new \DateTime('+3 days'),
	];

	return $dates;
}

/* Wordpress actions */

define('USE_CACHE', true);

$cache = USE_CACHE ? new FilesystemCache(__DIR__.'/../cache/agenda') : new VoidCache();
$client = new JsonApiClient($cache);

add_action('wp_head', function() use ($client) {
	if (is_main_site() && is_front_page()) {
		$events = $client->getEvents([
			'from' => (new \DateTime('now'))->format('Y-m-d'),
			'to' => (new \DateTime('+3 days'))->format('Y-m-d'),
		]);
		Registry::setEvents($events);
	}
});

function ajax_action()
{
	global $client;

	$city = isset($_GET['city']) ? $_GET['city'] : 'Paris';
	$date = isset($_GET['date']) ? $_GET['date'] : (new \DateTime('now'))->format('Y-m-d');

	$events = $client->getEvents([
		'from' => $date,
		'to' => $date,
	]);

	$events = filter_by_city($events, $city);

	foreach ($events as $event) {
		include locate_template('templates/module-oaevent.php');
	}

	exit;
};

add_action('wp_ajax_openagenda', __NAMESPACE__ . '\\ajax_action');
add_action('wp_ajax_nopriv_openagenda', __NAMESPACE__ . '\\ajax_action');
