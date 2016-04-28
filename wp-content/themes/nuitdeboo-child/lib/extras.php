<?php

function nd_get_revolutionary_date()
{


	$days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

	$start = new \DateTime('2016-03-31');
	$now = new \DateTime();
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