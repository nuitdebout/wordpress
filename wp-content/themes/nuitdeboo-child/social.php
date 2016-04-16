<?php
$sc = array('facebook', 'twitter');
foreach ($sc as $value){
	if( get_field('social_'.$value, 'option')){
		echo '<a href="'.get_field('social_'.$value, 'option').'" target="_blank" class="social-icons facebook">
		<!-- <img src="'.get_stylesheet_directory_uri().'/images/ic_fb.svg" /> -->
		<i class="fa fa-'.$value.'"></i>
		</a>';
	}
}

?>