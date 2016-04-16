<?php
$sc = array('facebook', 'twitter');
foreach ($sc as $value){
	if( get_option('options_social_'.$value)){
		echo '<a href="'.get_option('options_social_facebook').'" target="_blank" class="social-icons facebook">
		<img src="'.get_stylesheet_directory_uri().'/images/ic_fb.svg" />
		</a>';
	}
}
?>