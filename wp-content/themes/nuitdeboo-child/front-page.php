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

<h1>Ma title</h1>

<h2>Ma second title</h2>

<button class="btn btn-primary">My button</button>
<br /><br />