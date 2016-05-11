<?php

namespace NuitDebout\modules;

/**
* Module Screen
*/
class Screen extends Module
{
	protected $templatePath = 'templates/module-screen.php';

	public function __construct() {
		return parent::__construct([
			'description' => __('Affiche un grande image avec un titre')
		]);
	}

	public static function get_options()
	{
		return [
			'title' => [
				'label' => 'Title'
			],
		];
	}
}
