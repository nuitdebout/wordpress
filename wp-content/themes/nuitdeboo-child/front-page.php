<?php

	/**
	 * Module homepage screen
	 */
	if ( get_field('homepage_module_screen', 'option') == 'oui' ) {
		get_template_part('templates/module', 'screen');
	}

	/**
	* Module social network
	*/
	if ( get_field('global_module_social', 'option') == 'oui' ) {
		get_template_part('templates/social');
	}
?>