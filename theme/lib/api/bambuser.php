<?php

/**
 * Proxies AJAX calls to the Bambuser public API,
 * and retrieves broadcast data.
 */

require __DIR__.'/../../vendor/autoload.php';

use GuzzleHttp\Client;

header('Content-Type: application/json');

$client = new Client();

$params = [
  'query' => [
    'api_key'=> BAMBUSER_API_KEY,
    'tag'=> 'NuitDeboutLive,NuitDebout'
  ]
];

$response = $client->get('http://api.bambuser.com/broadcast.json', $params);


$body = $response->getBody();

// Implicitly cast the body to a string and echo it
echo $body;
