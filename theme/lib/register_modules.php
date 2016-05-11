<?php
$moduleClasses = [
	'\\NuitDebout\\modules\\Home_Social',
	'\\NuitDebout\\modules\\Screen',
];
$modules = [];

function instanciate_modules() {
	global $moduleClass;
	global $modules;
	foreach ($modules as $moduleClass) {
		$reflected = new \ReflectionClass($moduleClass);
		$module = $reflected->newInstance();
		$moduleInstances[$module::get_module_id()] = $module;
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


function the_module($id, $options = []) {
	global $moduleInstances;
	$module = $moduleInstances[$id];
	if (! $module) {
		return;
	}
	$module->render_static($options);
}
