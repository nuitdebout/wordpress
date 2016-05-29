<?php

namespace Component;

use Component\Common\NotDisplayableException;

abstract class BaseComponent extends \WP_Widget
{
	/**
	 * Name of the component. Default class name
	 * @var string
	 */
	protected $componentName = null;

	/**
	 * Id of the component. Default lower case class name
	 * @var string
	 */
	protected $componentId = null;

	/**
	 * Description of the components
	 * @var string|null
	 */
	protected $componentDescription = null;

	/**
	 * Path to the template of the component
	 * @var string|null
	 */
	protected $templatePath = null;

	/**
	 * Path to the form template of the component
	 * @var string|null
	 */
	protected $formTemplatePath = 'components/Common/default_form.php';

	protected $isWidget = true;
	protected $isStatic = false;

	public function __construct($options = [])
	{
		$reflected = new \ReflectionClass($this);
		$this->componentName = $this->componentName ? $this->componentName : $reflected->getShortName();
		$this->componentId = $this->componentId ? $this->componentId : strtolower($this->componentName);
		$this->componentName = str_replace('_', ' ', $this->componentName);

		if ($this->componentDescripion) {
			$options['desription'] = __($this->componentDescription);
		}

		return parent::__construct($this->componentId, $this->componentName, $options);
	}

	/**
	 * Get the component id
	 * @return string
	 */
	public function get_id()
	{
		return $this->componentId;
	}

	/**
	 * Get the path of the template component
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
		try {
			extract($this->get_template_params($instance));

			echo '<div class="js-component-' . $this->get_id() . '">';
			include(locate_template($this->get_template_path($args, $instance)));
			echo "</div>";
		} catch (NotDisplayableException $e) {}
	}


	/**
	 * Get the path of the form template component
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
			$optionId = 'component_'.$this->componentId . '_' . $name;
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

		$section = 'component_'. $this->componentId;

		$wpCustomize->add_section( $section, [
			'title' => __( $this->componentName ),
			'description' => __( $this->componentDescription ),
			'capability' => 'edit_theme_options',
			'panel' => $panel,
		]);

		foreach ($this->get_static_options() as $name => $option) {
			$wpCustomize->add_setting('component_'.$this->componentId . '_' . $name, [
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => $option['default'],
			]);

			$wpCustomize->add_control( 'component_'.$this->componentId . '_' . $name, [
				'type' => $option['type'],
				'label' => __($option['label']),
				'section' => $section,
			]);
		}
	}


}
