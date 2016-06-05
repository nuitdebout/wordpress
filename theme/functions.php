<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
define( 'ACF_LITE', true );

include_once(ABSPATH . 'wp-content/plugins/advanced-custom-fields/acf.php');

require_once __DIR__.'/vendor/autoload.php';

$sage_includes = [
	'lib/assets.php',    // Scripts and stylesheets
	'lib/extras.php',    // Custom functions
	'lib/setup.php',     // Theme setup
	'lib/titles.php',    // Page titles
	'lib/wrapper.php',   // Theme wrapper class
	'lib/customizer.php', // Theme customizer

	'acf/acf_options.php',
	'lib/nuitdebout/cities.php',
	'lib/nuitdebout/homepage.php',
	'lib/nuitdebout/openagenda.php',
	'lib/nuitdebout/periscope.php',
	'lib/nuitdebout/utils.php',
	'lib/nuitdebout/jeuxdebout.php',
	'components/register_component.php',
];

foreach ($sage_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}
unset($file, $filepath);
