<?php

	/**
	 * Module homepage screen
	 */
	if ( get_field('homepage_module_screen', 'option') == 'oui' ) {
		get_template_part('templates/module', 'screen');
	}

	if ( get_field('homepage_module_manifesto', 'option') == 'oui' ) {
		if ( get_field('homepage_manifesto', 'option') ) {
			get_template_part('templates/module', 'manifesto');
		}
	}

	get_template_part('templates/module', 'home-social');


	if ( get_field('homepage_module_free_iframe_1', 'option') ) {
		get_template_part('templates/module', 'free_iframe_1');

	}
	if ( get_field('homepage_module_free_iframe_2', 'option') ) {
		get_template_part('templates/module', 'free_iframe_2');

	}
	if ( get_field('homepage_module_map', 'option') == 'oui' ) {
		if ( get_field('homepage_module_map', 'option') ) {
			get_template_part('templates/module', 'rassemblements');
		}
	}
	if ( get_field('homepage_module_takepart', 'option') == 'oui' ) {
		if ( get_field('homepage_takepart', 'option') ) {
			get_template_part('templates/module', 'participate');
		}
	}

	if ( get_field('homepage_module_global', 'option') == 'oui' ) {
                //if ( get_field('homepage_globaldebout', 'option') ) {
                        get_template_part('templates/module', 'global');
                //}
        }

	/**
	* Module social network
	*/
	if ( get_field('global_module_social', 'option') == 'oui' ) {
		// get_template_part('templates/module', 'social');
	}
?>
