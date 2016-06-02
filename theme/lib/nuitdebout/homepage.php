<?php

namespace NuitDebout\Wordpress\Homepage;

use TwitterAPIExchange;
use GuzzleHttp\Client;
use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Cache\VoidCache;

/* Functions to retrieve posts on homepage */

function get_sticky_posts($limit, array $not_in = [])
{
	$sticky = get_option('sticky_posts');

	$sticky = array_slice($sticky, 0, $limit);
	$sticky = array_diff($sticky, $not_in);

	$sticky_posts_args = [
		'post_type' => 'post',
		'post__in' => $sticky,
		'ignore_sticky_posts' => 1,
		'orderby' => 'date',
		'order'   => 'DESC',
	];

	return new \WP_Query($sticky_posts_args);
}

function get_featured_post()
{
	$cat = get_category_by_slug('a-la-une');

	return new \WP_Query([
		'posts_per_page' => 1,
		'category__in' => [$cat->cat_ID],
	]);
}

function get_important_post()
{
	$cat = get_category_by_slug('important');

	return new \WP_Query([
		'posts_per_page' => 1,
		'category__in' => [$cat->cat_ID],
	]);
}

function get_latest_posts_by_slug($slug)
{
	$cat = get_category_by_slug($slug);

	return new \WP_Query([
		'posts_per_page'   => 3,
		'category__in' => [$cat->cat_ID],
	    'orderby'          => 'post_date',
	    'order'            => 'DESC',
	    'post_type'        => 'post',
	    'post_status'      => 'publish',
	    'suppress_filters' => false
	 ]);
}

/* Search for live Periscope on Twitter */

function twitter_periscope()
{
	$cache = new FilesystemCache(__DIR__.'/../../cache/twitter_api');

	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$getfield = '?q=filter:periscope -RT #nuitdebout OR @nuitdebout OR #StreamDebout';
	$requestMethod = 'GET';

	$cache_key = sha1($requestMethod.$url.$getfield);

	if (!$results = $cache->fetch($cache_key)) {
		$settings = array(
		    'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
		    'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
		    'consumer_key' => TWITTER_CONSUMER_KEY,
		    'consumer_secret' => TWITTER_CONSUMER_SECRET
		);

		$twitter = new TwitterAPIExchange($settings);
		$results = $twitter->setGetfield($getfield)
		    ->buildOauth($url, $requestMethod)
		    ->performRequest();

		// Cache for 5 minutes
		$cache->save($cache_key, $results, 5 * 60);
	}

	echo $results;

	exit;
};

add_action('wp_ajax_homepage_twitter_periscope', __NAMESPACE__ . '\\twitter_periscope');
add_action('wp_ajax_nopriv_homepage_twitter_periscope', __NAMESPACE__ . '\\twitter_periscope');

/* Search for live Periscope on Twitter */

function periscope_check()
{
	header('Content-Type: application/json');

	$client = new Client(['http_errors' => false]);

	$token = $_GET['token'];

	$params = [
	  'query' => [
	    'token' => $token
	  ]
	];

	$response = $client->get('https://api.periscope.tv/api/v2/getAccessPublic', $params);

	$body = $response->getBody();

	// Implicitly cast the body to a string and echo it
	echo $body;

	exit;
}

add_action('wp_ajax_homepage_periscope_check', __NAMESPACE__ . '\\periscope_check');
add_action('wp_ajax_nopriv_homepage_periscope_check', __NAMESPACE__ . '\\periscope_check');