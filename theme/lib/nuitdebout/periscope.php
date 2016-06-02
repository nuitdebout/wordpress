<?php

namespace NuitDebout\Wordpress\Periscope;

function get_periscopers($post)
{
	$periscopers = [];
	$params = [
		'child_of' => $post->ID,
		'post_type' => 'page',
		'post_status' => 'publish',
	];
	if ($pages = get_pages($params)) {
	    foreach ($pages as $page) {
	    	$image = get_field('periscoper_profile_image', $page->ID);
	    	$periscopers[] = [
	    		'name' => get_field('periscoper_name', $page->ID),
	    		'username' => get_field('periscoper_username', $page->ID),
	    		'profile_image' => $image['url'],
	    		'interview_url' => get_field('periscoper_interview_url', $page->ID),
	    	];
	    }
	}

	return $periscopers;
}