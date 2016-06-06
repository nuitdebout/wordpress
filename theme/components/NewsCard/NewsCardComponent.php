<?php
namespace Component\NewsCard;

use Component\BaseComponent;
use Component\Common\NotDisplayableException;


class NewsCardComponent extends BaseComponent
{

	protected $componentId = 'news-card';
	protected $componentName = 'NewsCard';
	protected $componentDescription = 'Une carte pour afficher une news';

	protected $isWidget = false;
	protected $isStatic = true;

	protected $addJsWrapper = false;

	protected function get_options()
	{
		return [
			'title' => [],
			'content' => [],
			'image' => [],
			'source' => [],
			'embedded' => [],
			'link' => [
				'default' => '#'
			]
		];
	}

	protected function get_template_path($args, $instance)
	{
		if (sizeof($instance['embedded']) > 0) {
			return 'components/NewsCard/news_card_embedded_template.php';
		}

		if (! $instance['image']) {
			return 'components/NewsCard/news_card_no_image_template.php';
		}
		return 'components/NewsCard/news_card_template.php';
	}

	protected function get_template_params($instance)
	{
		if (! $instance['title']) {
			throw new NotDisplayableException();
		}
		return $instance;
	}

	public function register_static($wpCustomize, $panel)
	{
	}
}