<?php
namespace Component\Navbar;

use Component\BaseComponent;
use Component\Common\NotDisplayableException;
use Roots\Sage\Assets;

class NavbarComponent extends BaseComponent
{

	protected $componentId = 'navbar';
	protected $componentName = 'Navbar';
	protected $componentDescription = 'La barre de navigation';

	protected $isWidget = false;
	protected $isStatic = true;

	protected $templatePath = 'components/Navbar/navbar_template.php';

	public function __construct($options = []) {
		parent::__construct($options);
		register_nav_menu('primary_navigation', __('Primary Navigation', 'sage'));
	}

	protected function get_template_params($instance)
	{
		if (! has_nav_menu('primary_navigation')) {
			throw new NotDisplayableException('No menu to display in the navbar');
		}

		$walker = new NavWalker();

		return [
			'logoImg' => Assets\asset_path('images/logoblack.svg'),
			'mobileNavImg' =>  Assets\asset_path('images/mobile-nav.jpg'),
			'walker' => $walker,
		];
	}

	public function register_static($wpCustomize, $panel)
	{
	}
}