<?php

namespace Nuitdebout\modules;

abstract class Module extends \WP_Widget
{
	/**
	 * Name of the module. Default class name
	 * @var string
	 */
	protected $moduleName = null;

	/**
	 * Id of the module. Default lower case class name
	 * @var string
	 */
	protected $moduleId = null;

	/**
	 * Path to the template of the module
	 * @var string|null
	 */
	protected $templatePath = null;

    public function __construct($options = [])
	{
		$reflected = new \ReflectionClass($this);
		$this->moduleName = $this->moduleName ? $this->moduleName : $reflected->getShortName();
		$this->moduleId = $this->moduleId ? $this->moduleId : strtolower($reflected->getShortName());
		$this->moduleName = str_replace('_', ' ', $this->moduleName);

		return parent::__construct($this->moduleId, $this->moduleName, $options);
    }

	/**
	 * Get the path of the template module
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database
	 * @return string
	 */
	protected function get_template_path($args, $instance)
	{
		return  $this->templatePath;
	}


	/**
	 * Define the parameter to expose to the templates
	 * @param Array $instance The instance of the widget (custom options)
	 * @return Array
	 */
	protected function get_template_params($instance) {
		return $instance;
	}

	/**
	 * {@inheritdoc}
	 */
    public function widget( $args, $instance )
	{
		extract($this->get_template_params($instance));
		include(locate_template($this->get_template_path($args, $instance)));
    }

	/**
	 * {@inheritdoc}
	 */
    public function form( $instance )
	{
        // outputs the options form in the admin
    }

	/**
	 * {@inheritdoc}
	 */
    public function update( $new_instance, $old_instance )
	{
        // processes widget options to be saved
    }
}
