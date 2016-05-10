<?php

namespace NuitDebout\modules;

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

	/**
	 * Path to the form template of the module
	 * @var string|null
	 */
	protected $formTemplatePath = 'modules/forms/default_form.php';

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
	 * Get the path of the form template module
	 * @param array $instance Saved values from database
	 * @return string
	 */
	protected function get_form_template_path($instance)
	{
		return  $this->formTemplatePath;
	}

	public static function get_options()
	{
		return [
			'title' => [
				'tag' => 'input',
				'type' => 'text',
				'default' => 'Mon Title',
				'label' => 'Title'
			],
		];
	}

	/**
	 * Define the parameter to expose to the templates
	 * @param Array $instance The instance of the widget (custom options)
	 * @return Array
	 */
	protected function get_form_template_params($instance) {
		$options = static::get_options();
		foreach ($instance as $key => $value) {
			$options[$key]['default'] = $value;
		}

		return [
			'options' => $options,
			'instance' => $instance
		];
	}

	/**
	 * {@inheritdoc}
	 */
    public function form( $instance )
	{
		extract($this->get_form_template_params($instance));
		include(locate_template($this->get_form_template_path($instance)));
    }

	/**
	 * {@inheritdoc}
	 */
    public function update( $newInstance, $oldInstance )
	{
		return $newInstance;
    }
}
