<?php
/**
 * Template Name: page "home"
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php

dynamic_sidebar('homepage-top');

if (!is_main_site()) :
	if ('posts' == get_option('show_on_front')) :
		include get_home_template();
	else :
	    include get_page_template();
	endif;
	dynamic_sidebar('homepage-bottom');
	if (!is_paged() && get_field('global_module_social', 'option') == 'oui') :
		get_template_part('templates/module', 'home-social');
	endif;
else :

	get_template_part('templates/module', 'manifesto');
	get_template_part('templates/module', 'news');
	if( !is_paged() && get_field('global_module_social', 'option') == 'oui' ) {
		get_template_part('templates/module', 'home-social');
	}
	get_template_part('templates/module', 'rassemblements');
	if (!is_paged() && get_field('homepage_module_global', 'option') == 'oui') {
		get_template_part('templates/module', 'global');
	}
	get_template_part('templates/module', 'agenda');

	if ( !is_paged() && get_field('homepage_module_free_iframe_1', 'option') ) {
		get_template_part('templates/module', 'free_iframe_1');
	}
	if ( !is_paged() &&get_field('homepage_module_free_iframe_2', 'option') ) {
		get_template_part('templates/module', 'free_iframe_2');
	}

endif;
?>
