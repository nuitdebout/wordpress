<?php

namespace NuitDebout\modules;

/**
* Module Screen
*/
class Screen extends Module
{
	protected $isStatic = true;
	
	protected $templatePath = 'templates/module-screen.php';

	public function __construct() {
		return parent::__construct([
			'description' => __('Affiche un grande image avec un titre')
		]);
	}

	protected function get_options()
	{
		return [
			'nuitDeboutIcon' => [
				'label' => 'Utiliser le logo Nuit Debout ?',
				'type' => 'checkbox'
			],
			'title' => [
				'label' => 'Titre (optionel)'
			],
			'smallTitle' => [
				'label' => 'Police du titre plus faible ?',
				'type' => 'checkbox'
			],
			'description' => [
				'label' => 'Description (optionel)',
			],
			'sentenceRotate' => [
				'label' => 'Faire tourner des catchline ?',
				'type' => 'checkbox'
			],
		];
	}

	protected function get_static_instance($options)
	{
		return [
			'title' => get_the_title(),
			'smallTitle' => 'true',
		];
	}
}
