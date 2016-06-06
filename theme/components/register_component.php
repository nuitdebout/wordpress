<?php
$componentClasses = [
	'\Component\Navbar\NavbarComponent',
	'\Component\NewsCard\NewsCardComponent',
];

/** @var \Component\BaseComponent[] $components */
$components = [];

function instanciate_components() {
	global $componentClasses;
	global $components;

	// on wp-cli
	if ($componentClasses === null) {
		return;
	}

	foreach ($componentClasses as $componentClass) {
		$reflected = new \ReflectionClass($componentClass);
		$component = $reflected->newInstance();
		$components[$component->get_id()] = $component;
	}
}
add_action('after_setup_theme', 'instanciate_components');


function register_modules_as_widget () {
	global $components;
	// on wp-cli
	if ($components === null) {
		return;
	}
	foreach ($components as $component) {
		$component->register_as_widget();
	}
}
add_action('widgets_init','register_modules_as_widget');

function register_components_as_static($wpCustomize) {
	$wpCustomize->add_panel( 'components', [
		'title' => __( 'Components' ),
		'description' => __('Configuration des différents composants'),
	]);

	global $components;
	foreach ($components as $component) {
		$component->register_static($wpCustomize, 'components');
	}
}
add_action( 'customize_register', 'register_components_as_static' );


function the_component($id, $options = []) {
	global $components;
	$component = $components[$id];
	if (! $component) {
		return;
	}
	$component->render_static($options);
}
