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


function get_iframe($nid){
	$output = '';
	$prefix = 'homepage_module_free_iframe_';
	if ( get_field($prefix.$nid, 'option') ) :
		$iframe = array(
	    		'url' 	 => get_field($prefix.$nid, 'option'),
	   			'title'  => get_field($prefix.$nid.'_title', 'option'),
	   			'height' => get_field($prefix.$nid.'_height', 'option'),
	   			'id'     => get_field($prefix.$nid.'_id', 'option'),
	   			'class'  => get_field($prefix.$nid.'_class', 'option')
	    );
		$output .= '<div class="section iframe-module iframe-module--'.$nid.'">';
		$output .= 		'<h2 class="section__title">'.$iframe['title'].'</h2>';
		$output .=  	'<iframe src="'.$iframe['url'].'"  height="'.$iframe['height'].'" class="'.$iframe['class'].'" id="'.$iframe['id'].'" allowTransparency="true" frameborder="0" scrolling="no"></iframe>';
		$output .='</div>';
	endif;
    return $output;
}
function getAttachmentThumb($id) {
	$thumb =  get_post_thumbnail_id( $id );
	$url = wp_get_attachment_image_src($thumb , [330, 180])[0];
	return $url;
}

function get_extra_social_array() {

	$sc = array(
		'wiki'=> array(
			'name'=>'Wiki',
			'icon' => 'ic-wiki'
		),
		'chat'=> array(
			'name'=>'chat',
			'icon' => 'ic-chat'
		)

	);
	return $sc;
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
