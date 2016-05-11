<?php
namespace lib;

function get_modules() {
	return [
		'\\NuitDebout\\modules\\Home_Social',
		'\\NuitDebout\\modules\\Screen',
	];
}

function call_module_method($module, $method, $args = [], $obj = NULL) {
	$reflected = new \ReflectionClass($module);
	return $reflected->getMethod($method)->invokeArgs($obj, $args);
}


function register_modules () {
	foreach (get_modules() as $moduleName) {
		call_module_method($moduleName, 'register_as_widget');
	}
}
add_action('widgets_init', __NAMESPACE__ . '\\register_modules');
