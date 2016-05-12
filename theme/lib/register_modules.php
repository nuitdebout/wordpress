<?php
$moduleClasses = [
	'\\NuitDebout\\modules\\Home_Social',
	'\\NuitDebout\\modules\\Screen',
];
$modules = [];

function instanciate_modules() {
	global $moduleClasses;
	global $modules;
	foreach ($moduleClasses as $moduleClass) {
		$reflected = new \ReflectionClass($moduleClass);
		$module = $reflected->newInstance();
		$modules[$module->get_module_id()] = $module;
	}
}
instanciate_modules();


function register_modules_as_widget () {
	global $modules;
	foreach ($modules as $module) {
		$module->register_as_widget();
	}
}
add_action('widgets_init','register_modules_as_widget');

function register_modules_as_static($wpCustomize) {
	$wpCustomize->add_panel( 'modules', [
	  'title' => __( 'Modules' ),
	  'description' => __('Configuration des différents modules'),
  	]);

	global $modules;
	foreach ($modules as $module) {
		$module->register_static($wpCustomize, 'modules');
	}
}
add_action( 'customize_register', 'register_modules_as_static' );

function the_module($id, $options = []) {
	global $modules;
	$module = $modules[$id];
	if (! $module) {
		return;
	}
	$module->render_static($options);
}
