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
	* Description of the modules
	* @var string|null
	*/
	protected $moduleDescription = null;

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

	protected $isWidget = true;
	protected $isStatic = false;

	public function __construct($options = [])
	{
		$reflected = new \ReflectionClass($this);
		$this->moduleName = $this->moduleName ? $this->moduleName : $reflected->getShortName();
		$this->moduleId = $this->moduleId ? $this->moduleId : strtolower($this->moduleName);
		$this->moduleName = str_replace('_', ' ', $this->moduleName);

		if ($this->moduleDescripion) {
			$options['desription'] = __($this->moduleDescription);
		}

		return parent::__construct($this->moduleId, $this->moduleName, $options);
	}

	/**
	 * Get the module id
	 * @return string
	 */
	public function get_module_id()
	{
		return $this->moduleId;
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

	protected function get_options()
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
		$options = $this->get_options();
		foreach ($options as $key => $option) {
			$options[$key]['value'] = $option['default'];
		}
		foreach ($instance as $key => $value) {
			$options[$key]['value'] = $value;
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

	public function register_as_widget()
	{
		if (! $this->isWidget) {
			return;
		}
		register_widget('\\' . get_called_class());
	}


	protected function get_static_instance($instance)
	{
		foreach($this->get_static_options() as $name => $option) {
			if (array_key_exists($name, $instance)) {
				continue;
			}
			$optionId = 'module_'.$this->moduleId . '_' . $name;
			if (get_option($optionId)) {
				$instance[$name] = get_option($optionId);
				continue;
			}
			return $option['default'];
		}
		return $instance;
	}

	public function render_static($options = [])
	{
		$this->widget([], $this->get_static_instance($options));
	}

	protected function get_static_options()
	{
		return $this->get_options();
	}
	public function register_static($wpCustomize, $panel)
	{
		if (! $this->isStatic) {
			return;
		}

		$section = 'module_'. $this->moduleId;

		$wpCustomize->add_section( $section, [
			'title' => __( $this->moduleName ),
			'description' => __( $this->moduleDescription ),
			'capability' => 'edit_theme_options',
			'panel' => $panel,
		]);

		foreach ($this->get_static_options() as $name => $option) {
			$wpCustomize->add_setting('module_'.$this->moduleId . '_' . $name, [
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => $option['default'],
			]);

			$wpCustomize->add_control( 'module_'.$this->moduleId . '_' . $name, [
				'type' => $option['type'],
				'label' => __($option['label']),
				'section' => $section,
			]);
		}
	}


}
