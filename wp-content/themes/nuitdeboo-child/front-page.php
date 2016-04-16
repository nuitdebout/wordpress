<?php get_template_part('templates/page', 'header'); ?>

front-page.php

<?php

	/**
	 * Module homepage screen
	 */
	if ( get_field('homepage_module_screen', 'option') == 'oui' ) {
		get_template_part('templates/module', 'screen');
	}

	//if ( get_field('manifesto_module_screen', 'option') == 'oui' ) {
		get_template_part('templates/module', 'manifesto');
	//}

	//if ( get_field('manifesto_module_screen', 'option') == 'oui' ) {
		get_template_part('templates/module', 'participate');
	//}

	/**
	* Module social network
	*/
	if ( get_field('global_module_social', 'option') == 'oui' ) {
		get_template_part('templates/social');
	}
?>