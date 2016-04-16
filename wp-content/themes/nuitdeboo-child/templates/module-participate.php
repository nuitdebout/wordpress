<?php
/*
 module "participer" goes here
*/
$page_parent = get_field('homepage_manifesto', 'option');

if($page_parent->ID){
	$parent_id = $page_parent->ID;

	$include = get_pages('include='.$parent_id);
	$content = apply_filters('the_content',$include[0]->post_content);
	$title = apply_filters('the_title',$include[0]->post_title);
	echo '<h2>'.$title.'</h2>';
	echo '<strong>'.$content.'</strong>';
	$args = array(
		'child_of' => $parent_id,
		'post_type' => 'page',
		'post_status' => 'publish'
	);
	$pages_sub = get_pages($args);
	if($pages_sub){
		foreach ( $pages_sub as $p ) :
			$content = apply_filters('the_content',$p->post_content);
			$title = apply_filters('the_title',$p->post_title);
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($p->ID), 'thumbnail' );
			$url = $thumb['0'];
			echo '<img src='.$url.' />';
			echo '<h2>'.$title.'</h2>';
			echo $content;
		endforeach;
	} // if subs
}
else{
	echo 'Please go to admin > options > Participer and select the page you want to display (a page must be created before)';
}
?>
