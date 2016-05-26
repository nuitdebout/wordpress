<?php

namespace NuitDebout\Wordress\Homepage;

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

function get_latest_posts()
{
	return new \WP_Query([
		'posts_per_page'   => 3,
	    'orderby'          => 'post_date',
	    'order'            => 'DESC',
	    'post_type'        => 'post',
	    'post_status'      => 'publish',
	    'suppress_filters' => false
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
