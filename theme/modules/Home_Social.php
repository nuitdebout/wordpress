<?php

namespace NuitDebout\modules;

/**
* Module Home Social
* Display a line with all the social network
*/
class Home_Social extends Module
{
	protected $templatePath = 'templates/module-home-social.php';

	public function __construct() {
		return parent::__construct([
			'description' => __('Affichez une ligne avec vos réseaux sociaux')
		]);
	}

	protected function get_template_params($instance) {
		$displayedSocials = [];
		$sc = static::get_social_array();
		foreach ( $sc as $key => $socialConfig ) {
			if (! $instance[$key]) {
				continue;
			}
			$socialConfig['url'] = $instance[$key];
			$displayedSocials[$key] = $socialConfig;
		}
		if (!is_page_template('page-ville.php') ) {
			$displayedSocials['nuitdebout'] = [
				'icon' => '',
				'name' => 'est partout',
				'image' => 'logowhite.svg'
			];
		}
		return [
			'displayedSocials' => $displayedSocials,
			'title' => $instance['title']
		];
	}

	protected function get_options()
	{
		$socials = static::get_social_array();
		$options = [
			'title' => [
				'label' => 'Title'
			],
		];

		foreach ($socials as $id => $config) {
			$options[$id] = [
				'label' => $config['name'],
			];
		}
		return $options;
	}


	public static function get_social_array($include_only = NULL)
	{
		$sc = array(
			'twitter'=> array(
				'name'=>'Twitter',
				'icon' => 'ic-twitter'
			),
			'facebook' => array(
				'name'=>'Facebook',
				'icon' => 'ic-facebook'
			),
			'bambuser'=> array(
				'name'=>'Bambuser',
				'icon' => 'ic-bambuser'
			),
			'youtube'=> array(
				'name'=>'Youtube',
				'icon' => 'ic-youtube'
			),

			'instagram'=> array(
				'name'=>'Instagram',
				'icon' => 'ic-instagram'
			),
			'tumblr'=> array(
				'name'=>'Tumblr',
				'icon' => 'ic-tumblr'
			),
			'periscope'=> array(
				'name'=>'Periscope',
				'icon' => 'ic-periscope'
			),
			'snapchat'=> array(
				'name'=>'Snapchat',
				'icon' => 'ic-snapchat'
			),
			'scoopit'=> array(
				'name'=>'Scoopit',
				'icon' => 'ic-scoopit'
			),
			'github'=> array(
				'name'=>'Github',
				'icon' => 'ic-github'
			),
			'reddit'=> array(
				'name'=>'Reddit',
				'icon' => 'ic-reddit'
			),
		);
		if ($include_only) {
			return array_filter($sc, function($key) use ($include_only) { return in_array($key, $include_only);  }, ARRAY_FILTER_USE_KEY);
		}
		return $sc;
	}
}
