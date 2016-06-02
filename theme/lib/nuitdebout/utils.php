<?php

function nd_get_revolutionary_date(\DateTime $now = null)
{
	if (!$now) {
		$now = new \DateTime('now');
	}

	$days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

	$start = new \DateTime('2016-03-31');
	$diff = $now->diff($start);
	$diffDays = $diff->format('%a');
	$dayNumber = $diffDays + 31;

	return sprintf('%s %s Mars', $days[$now->format('w')], $dayNumber);
}

function getAttachmentThumb($id) {
	$thumb =  get_post_thumbnail_id( $id );
	$url = wp_get_attachment_image_src($thumb , [330, 180])[0];
	return $url;
}

function get_social_array($include_only = NULL) {
	$sc = array(
		'twitter'=> array(
			'name'=>'Twitter',
			'icon' => 'ic-twitter'
		),
		'facebook' => array(
			'name'=>'Facebook',
			'icon' => 'ic-facebook'
		),
		'bambuser'=> array(
			'name'=>'Bambuser',
			'icon' => 'ic-bambuser'
		),
		'youtube'=> array(
			'name'=>'Youtube',
			'icon' => 'ic-youtube'
		),

		'instagram'=> array(
			'name'=>'Instagram',
			'icon' => 'ic-instagram'
		),
		'tumblr'=> array(
			'name'=>'Tumblr',
			'icon' => 'ic-tumblr'
		),
		'periscope'=> array(
			'name'=>'Periscope',
			'icon' => 'ic-periscope'
		),
		'snapchat'=> array(
			'name'=>'Snapchat',
			'icon' => 'ic-snapchat'
		),
		'scoopit'=> array(
			'name'=>'Scoopit',
			'icon' => 'ic-scoopit'
		),
		'github'=> array(
			'name'=>'Github',
			'icon' => 'ic-github'
		),
		'reddit'=> array(
			'name'=>'Reddit',
			'icon' => 'ic-reddit'
		),

		'nuitdebout'=> array(
			'icon' => '',
			'name' => 'est partout',
			'image' => 'logowhite.svg'
		),
	);
	if ($include_only) {
		return array_filter($sc, function($key) use ($include_only) { return in_array($key, $include_only);  }, ARRAY_FILTER_USE_KEY);
	}
	return $sc;
}
