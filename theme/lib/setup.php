<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');
  add_post_type_support( 'page', 'excerpt' );

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'footer_navigation'  =>  __('Footer Navigation', 'sage'),
    'footer_colophon_navigation'  =>  __('footer Colophon', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
    add_image_size( 'page-banner', 1300, 9999 ); //300 pixels wide (and unlimited height)

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => 'Bannière homepage', // TODO translate
    'id'            => 'homepage-banner',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>'
  ]);
  register_sidebar([
    'name'          => 'Haut de page', // TODO translate
    'id'            => 'homepage-top',
    'before_widget' => '<div class=" %1$s %2$s section__content">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="section__title">',
    'after_title'   => '</h2>'
  ]);
  // register_sidebar([
  //   'name'          => 'homepage-flex-top',
  //   'id'            => 'homepage-flex-top',
  //   'before_widget' => '<div class="flex-widget"><div class=" %1$s %2$s">',
  //   'after_widget'  => '</div></div>',
  //   'before_title'  => '<h2 class="flex-widget__title">',
  //   'after_title'   => '</h2>'
  // ]);
  register_sidebar([
    'name'          => 'Bas de page', // TODO translate
    'id'            => 'homepage-bottom',
    'before_widget' => '<div id="widget-homepage-bottom"><div class="container padded"><div class="row"><div class=" %1$s %2$s col-md-8 col-md-offset-2">',
    'after_widget'  => '</div></div></div></div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>'
  ]);

  register_sidebar([
    'name'          => 'Panneau latéral', // TODO translate
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
  register_sidebar([
    'name'          => __('Footer', 'sage'), // TODO translate
    'id'            => 'sidebar-footer',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_main_site() && is_front_page(),
    is_page_template('page-globaldebout.php'),
    is_page_template('page-list-subpages.php'),
    is_page_template('page-periscope.php'),
    is_page_template('page-ville.php'),
    is_page_template('page-villes.php'),
    !is_active_sidebar('sidebar-primary'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}


/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('underscore');
  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);

  if ( is_home() ) {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/components/video-js.css'), false, null);
  wp_enqueue_script('videojs', Assets\asset_path('scripts/video.js'), null, null, true);
  wp_enqueue_script('videojs-ie8', Assets\asset_path('scripts/videojs-ie8.js'), null, null);
  wp_enqueue_script('videojs-contrib', Assets\asset_path('scripts/videojs-contrib-hls.js'), ['videojs'], null, true);
  wp_enqueue_script('nuitdebout/tvdeboutjs', Assets\asset_path('scripts/tvdebout.js'), ['videojs', 'videojs-contrib'], null, true);
  }

  if (is_page_template('page-periscope.php')) {
	  wp_enqueue_script('nuidebout/periscope', Assets\asset_path('scripts/periscope.js'), ['jquery'], null, true);
  }

  if (is_front_page() && is_main_site()) {
    wp_enqueue_script('nuidebout/snapwidget', Assets\asset_path('scripts/snapwidget.js'), ['jquery'], null, true);
  }

  wp_localize_script('sage/js', 'WP', [
  	'ajaxURL' => admin_url('admin-ajax.php')
  ]);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
