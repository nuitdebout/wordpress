<?php

namespace NuitDebout\Wordress\OpenAgenda;

use Goutte\Client as GoutteClient;

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

	public function getEvents(array $params = [])
	{
		$events = [];

		$get_params = ['oaq' => $params];

		$page = 1;
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

		usort($events, function($a, $b) {
			$date_a = new \DateTime($a['firstDateStart'].' '.$a['firstTimeStart']);
			$date_b = new \DateTime($b['firstDateStart'].' '.$b['firstTimeStart']);
			if ($date_a === $date_b) {
				return 0;
			}

			return $date_a < $date_b ? -1 : 1;
		});

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

function get_events()
{
	return Registry::getEvents();
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
	];

	return $dates;
}

/* Wordpress actions */

$client = new JsonApiClient();

add_action('wp_head', function() use ($client) {
	if (is_main_site() && is_front_page()) {
		$events = $client->getEvents([
			'from' => (new \DateTime('now'))->format('Y-m-d'),
			'to' => (new \DateTime('+2 days'))->format('Y-m-d'),
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

	header('Cache-Control: max-age=300, must-revalidate'); # 5min cache
	foreach ($events as $event) {
		include locate_template('templates/module-oaevent.php');
	}

	exit;
};

add_action('wp_ajax_openagenda', __NAMESPACE__ . '\\ajax_action');
add_action('wp_ajax_nopriv_openagenda', __NAMESPACE__ . '\\ajax_action');
