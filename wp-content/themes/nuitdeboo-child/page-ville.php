<?php
/**
 * Template Name: page list ville
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

		$page = get_page_by_name('ville');

		$args = array(
			'child_of' => $page->ID,
			'post_type' => 'page',
			'post_status' => 'publish'
		);
		$pages_sub = get_pages($args);


		if($pages_sub){
			echo '<ul>';
			foreach ( $pages_sub as $p ) :
					$content = apply_filters('the_content',$p->post_content);
						$title = apply_filters('the_title',$p->post_title);
						$url = esc_url( get_permalink($p->ID) );
			echo '<li><a href="'.$url.'"">'.$title.'</a></li>';

			endforeach;
				echo '</ul>';

			echo '<p>	<button class="btn btn-primary"><a href="http://wiki.nuitdebout.fr">Votre ville n\'est pas listée ? ajoutez-la sur le wiki !</a></button>';
		}
