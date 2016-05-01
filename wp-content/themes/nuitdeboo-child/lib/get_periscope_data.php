<?php

/**
 * Proxies AJAX calls to the Periscope public API,
 * and retrieves broadcast data.
 * @link https://medium.com/@matteocontrini/how-to-use-the-public-periscope-stream-api-8dfedc7fe872
 */

require __DIR__.'/../vendor/autoload.php';

use Goutte\Client;

$handle = $_GET['handle'];

$client = new Client();

$crawler = $client->request('GET', 'https://www.periscope.tv/'.$handle);
$broadcast_data = $crawler->filter('meta#broadcast-data')->attr('content');

echo $broadcast_data;
