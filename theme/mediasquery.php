<?php
/**
 * Template Name: page media query
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
$args = array(
	'post_type' => 'attachment',
	'post_status' => 'any'
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		get_template_part('templates/entry-taxonomies');
		echo wp_get_attachment_image( get_the_ID(), 'thumbnail' );
	}
} else {
	// no attachments found
}
wp_reset_postdata();