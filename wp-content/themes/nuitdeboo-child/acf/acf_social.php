<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_reseaux-sociaux',
		'title' => 'Réseaux sociaux',
		'fields' => array (
			array (
				'key' => 'field_571125d575dd2',
				'label' => 'Compte / Page facebook',
				'name' => 'social_facebook',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://facebook.com/xxxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5711260b75dd4',
				'label' => 'Compte Twitter',
				'name' => 'social_twitter',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://twitter.com/xxxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5711262075dd5',
				'label' => 'Compte Pinterest',
				'name' => 'social_pinterest',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://pinterest.com/xxxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5711264875dd6',
				'label' => 'Compte Instagram',
				'name' => 'social_instagram',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://instagram.com/xxxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

?>
