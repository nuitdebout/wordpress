<?php
function is_rootsite(){
	$blogid = get_current_blog_id();
	$blog_details = get_blog_details($blogid);
	if($blog_details && $blogid && $blogid =='1' && ($blog_details->domain == 'nuitdebout.dev' || $blog_details->domain == 'nuitdebout.fr' || $blog_details->domain == '185.34.33.84' ) ){
	  return 'is root site';
	}
}

function get_extra_social_array() {

	$sc = array(
		'wiki'=> array(
			'name'=>'Wiki',
			'icon' => 'ic-wiki'
		),
		'chat'=> array(
			'name'=>'chat',
			'icon' => 'ic-chat'
		)

	);
	return $sc;
}

function get_social_array($include_only = NULL) {
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

		'nuitdebout'=> array(
			'icon' => '',
			'name' => 'est partout',
			'image' => 'logowhite.svg'
		),
	);
	if ($include_only) {
		return array_filter($sc, function($key) use ($include_only) { return in_array($key, $include_only);  }, ARRAY_FILTER_USE_KEY);
	}
	return $sc;
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_modules',
		'title' => 'Modules',
		'fields' => array (
			array (
				'key' => 'field_571239024bdd0',
				'label' => 'Homepage',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_57123848f36de',
				'label' => 'Inclure le module "homepage" fond d\'écran',
				'name' => 'homepage_module_screen',
				'type' => 'select',
				'choices' => array (
					'oui' => 'Oui',
					'non' => 'Non',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),

			array (
				'key' => 'field_571239164bdd1',
				'label' => 'Changer l\'écran de la page d\'accueil',
				'name' => 'homepage_screen',
				'type' => 'image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123848f36de',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_545d3848f36de',
				'label' => 'homepage_module_blog',
				'name' => 'homepage_module_blog',
				'type' => 'select',
				'choices' => array (
					'oui' => 'Oui',
					'non' => 'Non',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
 			array (
                'key' => 'field_57qsd123qsqsd9sdf024bdd0',
                'label' => 'Module globalDebout',
                'name' => '',
                'type' => 'tab',
            ),
            array (
                'key' => 'field_571sqqez23848f36dqse',
                'label' => 'Inclure le module "globaldebout" ',
                'name' => 'homepage_module_global',
                'type' => 'select',
                'choices' => array (
                        'oui' => 'Oui',
                        'non' => 'Non',
                ),
                'default_value' => 'non',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
				'key' => 'field_5712uio5edsddfc26c22',
				'label' => 'global (page parent)',
				'name' => 'homepage_global',
				'type' => 'post_object',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_571sqqez23848f36dqse',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'post_type' => array (
					0 => 'page',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5712ssd397bda1ca',
				'label' => 'Réseaux',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_57123987da1cb',
				'label' => 'Inclure le module réseaux sociaux',
				'name' => 'global_module_social',
				'type' => 'select',
				'choices' => array (
					'oui' => 'Oui',
					'non' => 'Non',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_57123a35b63f8',
				'label' => 'Facebook',
				'name' => 'social_facebook',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => 'https://www.facebook.com/NuitDebout/',
				'placeholder' => 'https://facebook.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57123a5db63f9',
				'label' => 'Twitter',
				'name' => 'social_twitter',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => 'https://twitter.com/nuitdebout',
				'placeholder' => 'https://twitter.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57123a7cb63fa',
				'label' => 'Periscope',
				'name' => 'social_periscope',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => 'https://www.periscope.tv/RemyBuisine',
				'placeholder' => 'https://periscope.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57123aa7b63fb',
				'label' => 'Instagram',
				'name' => 'social_instagram',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'https://instagram.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57123ac0b63fc',
				'label' => 'Github',
				'name' => 'social_github',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'https://github.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57123ad7b63fd',
				'label' => 'Youtube',
				'name' => 'social_youtube',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'https://youtube.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57dsdfsdfsdf63fd',
				'label' => 'Reddit',
				'name' => 'social_reddit',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'https://www.reddit.com/r/nuitdebout/',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57123ae5b63fe',
				'label' => 'Bambuser',
				'name' => 'social_bambuser',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'https://bambuser.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57123af6b63ff',
				'label' => 'Scoopit',
				'name' => 'social_scoopit',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'https://scoopit.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57123b0ab6400',
				'label' => 'Tumblr',
				'name' => 'social_tumblr',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'https://tumblr.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57123b1db6401',
				'label' => 'Snapchat',
				'name' => 'social_snapchat',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'https://snapchat.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			/*
			array (
				'key' => 'field_5sdfsdf3aa7b63fb',
				'label' => 'WIKI',
				'name' => 'extra_social_wiki',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'https://instagram.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5ssdfaa7b63fb',
				'label' => 'chat',
				'name' => 'extra_social_chat',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57123987da1cb',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'https://instagram.com/xxxx',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),

			array (
				'key' => 'field_57123b4136e55',
				'label' => 'Carte',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_57123be236e57',
				'label' => 'Inclure le module carte',
  				'name' => 'homepage_module_map',
				'type' => 'select',
				'choices' => array (
					'oui' => 'Oui',
					'non' => 'Non',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			*/
			array (
				'key' => 'field_57123b4936e56',
				'label' => 'Participer',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_57123c1936e58',
				'label' => 'Inclure le module participer',
				'name' => 'homepage_module_takepart',
				'type' => 'select',
				'choices' => array (
					'oui' => 'Oui',
					'non' => 'Non',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_571261bcb088d',
				'label' => 'Participer (page)',
				'name' => 'homepage_takepart',
				'type' => 'post_object',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57125fb8963ea',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'post_type' => array (
					0 => 'page',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_57125fb0963e9',
				'label' => 'Manifesto',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_57125fb8963ea',
				'label' => 'Inclure le module manifesto',
				'name' => 'homepage_module_manifesto',
				'type' => 'select',
				'choices' => array (
					'oui' => 'Oui',
					'non' => 'Non',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_57qs125fb8963ea',
				'label' => 'Url bouton libre',
				'name' => 'homepage_manifesto_btn_url',
				'type' => 'text',
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57125fb8963ea',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_57qs1qsd25fb8963ea',
				'label' => 'Texte bouton libre',
				'name' => 'homepage_manifesto_btn_text',
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57125fb8963ea',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_57125edc26c22',
				'label' => 'Manifesto (page)',
				'name' => 'homepage_manifesto',
				'type' => 'post_object',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57125fb8963ea',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'post_type' => array (
					0 => 'page',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_57544125fb0963e9',
				'label' => 'iframe libre',
				'name' => 'iframe_libre',
				'type' => 'tab',
			),
			array (
				'key' => 'field_5712781119845f1984b8963ea',
				'label' => 'Inclure iframe libre 1 (url)',
				'name' => 'homepage_module_free_iframe_1',
				'type' => 'text',
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_iosqqsoi9845fb8963ea',
				'label' => 'titre iframe libre 1 ',
				'name' => 'homepage_module_free_iframe_1_title',
				'type' => 'text',
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_57sf1984b8963ea',
				'label' => 'hauteur iframe libre 1',
				'name' => 'homepage_module_free_iframe_1_height',
				'type' => 'text',
				'default_value' => '200px',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_s4b8968543ea',
				'label' => 'id iframe libre 1',
				'name' => 'homepage_module_free_iframe_1_id',
				'type' => 'text',
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_s4b8945875863ea',
				'label' => 'class css iframe libre 1',
				'name' => 'homepage_module_free_iframe_1_class',
				'type' => 'text',
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5712781119845fb8963ea',
				'label' => 'Inclure iframe libre 2 (url)',
				'name' => 'homepage_module_free_iframe_2',
				'type' => 'text',
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_ioppoi9845fb8963ea',
				'label' => 'titre iframe libre 2 ',
				'name' => 'homepage_module_free_iframe_2_title',
				'type' => 'text',
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_s4b8963ea',
				'label' => 'hauteur iframe libre 2',
				'name' => 'homepage_module_free_iframe_2_height',
				'type' => 'text',
				'default_value' => '200px',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_s4b89638554588888ea',
				'label' => 'id iframe libre 2',
				'name' => 'homepage_module_free_iframe_2_id',
				'type' => 'text',
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_7887478b8963ea',
				'label' => 'class css iframe libre 2',
				'name' => 'homepage_module_free_iframe_2_class',
				'type' => 'text',
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_57544s5fb0963e9',
				'label' => 'Agenda',
				'name' => 'agenda',
				'type' => 'tab',
			),
			array (
				'key' => 'field_57125fbfgh8963ea',
				'label' => 'Inclure le module agenda',
				'name' => 'homepage_module_agenda',
				'type' => 'select',
				'choices' => array (
					'oui' => 'Oui',
					'non' => 'Non',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5vuhvggfgh8963ea',
				'label' => 'agenda ID',
				'name' => 'homepage_agenda_ID',
				'type' => 'text',
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5712uio5edc26c22',
				'label' => 'agenda (page)',
				'name' => 'homepage_agenda',
				'type' => 'post_object',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57125fbfgh8963ea',
							'operator' => '==',
							'value' => 'oui',
						),
					),
					'allorany' => 'all',
				),
				'post_type' => array (
					0 => 'page',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'allow_null' => 0,
				'multiple' => 0,
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
		'id' => 'acf_social-page',
		'title' => 'social page',
		'fields' => array (
			array (
				'key' => 'field_57182e6hj18',
				'label' => 'Garder cette page synchronisée automatiquement au wiki ?',
				'name' => 'keep_sync',
				'type' => 'true_false',
				'instructions' => '',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_5qs318218',
				'label' => 'facebook page url',
				'name' => 'facebook_page_url',
				'type' => 'text',
				'instructions' => 'url',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_qsd1d8218',
				'label' => 'twitter page url',
				'name' => 'twitter_page_url',
				'type' => 'text',
				'instructions' => 'url',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_1qqqspoiuysd8218',
				'label' => 'instagram page url',
				'name' => 'instagram_page_url',
				'type' => 'text',
				'instructions' => 'url',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_4qqqspoiuysd8218',
				'label' => 'bambuser page url',
				'name' => 'bambuser_page_url',
				'type' => 'text',
				'instructions' => 'url',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_2qqqspoiuysd8218',
				'label' => 'periscope page url',
				'name' => 'periscope_page_url',
				'type' => 'text',
				'instructions' => 'url',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_3qqqspoiuysd8218',
				'label' => 'tumblr page url',
				'name' => 'tumblr_page_url',
				'type' => 'text',
				'instructions' => 'url',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_qdqd456456456452348',
				'label' => '#chat page url',
				'name' => 'chat_page_url',
				'type' => 'text',
				'instructions' => 'url',
				'default_value' => 'http://chat.nuitdebout.fr',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_4574576sdf45658',
				'label' => '#wiki page url',
				'name' => 'wiki_page_url',
				'type' => 'text',
				'instructions' => 'url',
				'default_value' => 'http://wiki.nuitdebout.fr',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_4sdesdf45658',
				'label' => 'agendaID',
				'name' => 'agenda_page',
				'type' => 'text',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_45qsd74576sdf45658',
				'label' => 'france ou monde',
				'name' => 'location_type',
				'type' => 'select',
				'choices' => array (
					'france' => 'france',
					'monde' => 'monde',
				),
				'instructions' => 'France ou monde',
				'default_value' => 'france',
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
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-ville.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_commission-page',
		'title' => 'commission page',
		'fields' => array (
			array (
				'key' => 'field_2e6hj18',
				'label' => 'testkey',
				'name' => 'key_name',
				'type' => 'true_false',
				'instructions' => '',
				'layout' => 'vertical',
			),

		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-commission.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_extra-page',
		'title' => 'extra page',
		'fields' => array (
			array (
				'key' => 'field_opedffd6hj18',
				'label' => 'inclure banniere en-tete',
				'name' => 'page_include_screen',
				'type' => 'true_false',
				'instructions' => '',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_pagest228',
				'label' => 'Sous-titre',
				'name' => 'page_include_subtitle',
				'type' => 'text',
				'instructions' => '',
				'layout' => 'vertical',
			)

		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'default',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_globaldebout-page',
		'title' => 'globalpage page',
		'fields' => array (
			array (
				'key' => 'field_57182e6hj18',
				'label' => 'langue code',
				'name' => 'page_lang_code',
				'type' => 'text',
				'instructions' => '',
				'layout' => 'vertical',
			)

		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-globaldebout.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));







}

?>
