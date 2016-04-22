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

	/**
	 * Module homepage screen
	 */
	if ( get_field('homepage_module_screen', 'option') == 'oui' ) {
		 get_template_part('templates/module', 'screen');
	}

	if ( get_field('homepage_module_blog', 'option') == 'oui' ) {
		 get_template_part('templates/module', 'blog');
	}


	if ( get_field('homepage_module_manifesto', 'option') == 'oui' ) {
		if ( get_field('homepage_manifesto', 'option') ) {
			 get_template_part('templates/module', 'manifesto');
		}
	}


  if ( get_field('homepage_module_map', 'option') == 'oui' ) {
    get_template_part('templates/module', 'rassemblements');
  }

  dynamic_sidebar('homepage-top');

	if ( get_field('global_module_social', 'option') == 'oui' ) {
		get_template_part('templates/module', 'home-social');
	}


	dynamic_sidebar('homepage-bottom		');


	if ( get_field('homepage_module_takepart', 'option') == 'oui' ) {
		if ( get_field('homepage_takepart', 'option') ) {
			get_template_part('templates/module', 'participate');
		}
	}
	if ( get_field('homepage_module_global', 'option') == 'oui' ) {
         get_template_part('templates/module', 'global');
    }
    if ( get_field('homepage_module_agenda', 'option') == 'oui' ) {
       get_template_part('templates/module', 'agenda');
    }

    if ( get_field('homepage_module_free_iframe_1', 'option') ) {
      get_template_part('templates/module', 'free_iframe_1');
    }
    if ( get_field('homepage_module_free_iframe_2', 'option') ) {
      get_template_part('templates/module', 'free_iframe_2');
    }
?>
