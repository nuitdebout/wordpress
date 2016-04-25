<?php

require __DIR__. '/../vendor/autoload.php';

// create_commission_page.php

use Mediawiki\Api\MediawikiApi;
use Mediawiki\Api\FluentRequest;
use Mediawiki\Api\SimpleRequest;

$api = MediawikiApi::newFromApiEndpoint('https://wiki.nuitdebout.fr/api.php');

$queryResponse = $api->getRequest(
	FluentRequest::factory()
		->setAction('query')
		->setParam('meta', 'siteinfo')
);

print_r($queryResponse);