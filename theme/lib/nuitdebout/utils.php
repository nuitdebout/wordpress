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
function attachment_search( $query ) {
    if ( $query->is_search ) {
       $query->set( 'post_type', array( 'post', 'attachment' ) );
       $query->set( 'post_status', array( 'publish', 'inherit' ) );
    }
   return $query;
}
add_filter( 'pre_get_posts', 'attachment_search' );