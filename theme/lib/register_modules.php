<?php
namespace lib;


function register_modules () {
	register_widget('\\NuitDebout\\modules\\Home_Social');
}
add_action('widgets_init', __NAMESPACE__ . '\\register_modules');
