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

/**
 * Link Pages
 * @author toscha
 * @link http://wordpress.stackexchange.com/questions/14406/how-to-style-current-page-number-wp-link-pages
 * @param  array $args
 * @return void
 * Modification of wp_link_pages() with an extra element to highlight the current page.
 */
function bootstrap_link_pages( $args = array () ) {
	$defaults = array(
		'before'      => '<p>' . __('Pages:'),
		'after'       => '</p>',
		'before_link' => '',
		'after_link'  => '',
		'current_before' => '',
		'current_after' => '',
		'link_before' => '',
		'link_after'  => '',
		'pagelink'    => '%',
		'echo'        => 1
	);
	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );
	global $page, $numpages, $multipage, $more, $pagenow;
	if ( ! $multipage ) {
		return;
	}
	$output = $before;
	for ( $i = 1; $i < ( $numpages + 1 ); $i++ ) {
		$j       = str_replace( '%', $i, $pagelink );
		$output .= ' ';
		if ( $i != $page || ( ! $more && 1 == $page ) ) {
			$output .= "{$before_link}" . _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a>{$after_link}";
		} else {
			$output .= "{$current_before}{$link_before}<a>{$j}</a>{$link_after}{$current_after}";
		}
	}
	print $output . $after;
}
add_action( 'bootstrap_link_pages', 'bootstrap_link_pages', 10, 1 );