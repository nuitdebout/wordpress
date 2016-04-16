<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_reseaux-sociaux',
		'title' => 'Réseaux sociaux',
		'fields' => array (
			array (
				'key' => 'field_571125d575dd2',
				'label' => 'Page facebook',
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
				'key' => 'field_571124ze62075dd5',
				'label' => 'Compte Periscope',
				'name' => 'social_periscope',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://periscope.com/xxxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5233711264875dd6',
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
			array (
				'key' => 'field_571126qSD4875dd6',
				'label' => 'Compte Github',
				'name' => 'social_github',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://github.com/xxxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_571126qsd4875dd6',
				'label' => 'Compte Youtube',
				'name' => 'social_youtube',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://youtube.com/xxxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_571QDS1264875dd6',
				'label' => 'Compte Bambuser',
				'name' => 'social_bambuser',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://bambuser.com/xxxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5711263ed4875dd6',
				'label' => 'Compte Scoopit',
				'name' => 'social_scoopit',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://scoopit.com/xxxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_571126WSD4875dd6',
				'label' => 'Compte tumblr',
				'name' => 'social_tumblr',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://tumblr.com/xxxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5711232464875dd6',
				'label' => 'Compte Snapchat',
				'name' => 'social_snapchat',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://snapchat.com/xxxxx',
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



	register_field_group(array (
		'id' => 'acf_modules',
		'title' => 'modules',
		'fields' => array (
			array (
				'key' => 'field_5711e18a0e46a',
				'label' => 'inclure super header',
				'name' => 'sup_header',
				'type' => 'select',
				'instructions' => 'qsd',
				'choices' => array (
					'Oui:Oui' => 'Oui:true',
					'Non:non' => 'Non:false',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5711eqsdqS18a0e46a',
				'label' => 'inclure reseaux sociaux',
				'name' => 'socialaccounts',
				'type' => 'select',
				'instructions' => 'qsd',
				'choices' => array (
					'Oui:Oui' => 'Oui:true',
					'Non:non' => 'Non:false',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5711eqs18a0e46a',
				'label' => 'inclure carte',
				'name' => 'carte',
				'type' => 'select',
				'instructions' => 'qsd',
				'choices' => array (
					'Oui:Oui' => 'Oui:true',
					'Non:non' => 'Non:false',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5711esdqsd18a0e46a',
				'label' => 'inclure participer',
				'name' => 'participer',
				'type' => 'select',
				'instructions' => 'qsd',
				'choices' => array (
					'Oui:Oui' => 'Oui:true',
					'Non:non' => 'Non:false',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
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