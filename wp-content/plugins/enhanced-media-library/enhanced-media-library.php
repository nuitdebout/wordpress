<?php
/*
Plugin Name: Enhanced Media Library
Plugin URI: http://wpUXsolutions.com
Description: This plugin will be handy for those who need to manage a lot of media files.
Version: 2.2.2
Author: wpUXsolutions
Author URI: http://wpUXsolutions.com
Text Domain: enhanced-media-library
Domain Path: /languages
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html

Copyright 2013-2016  wpUXsolutions  (email : wpUXsolutions@gmail.com)
*/



if ( ! defined( 'ABSPATH' ) )
	exit;



global $wp_version,
       $wpuxss_eml_version,
       $wpuxss_eml_dir,
       $wpuxss_eml_path;



$wpuxss_eml_version = '2.2.2';



/**
 *  wpuxss_get_eml_slug
 *
 *  @since    2.1
 *  @created  27/10/15
 */

if ( ! function_exists( 'wpuxss_get_eml_slug' ) ) {

    function wpuxss_get_eml_slug() {

        $path_array = array_filter( explode ( '/', plugin_dir_url( __FILE__ ) ) );
        $wpuxss_eml_slug = end( $path_array );

        return $wpuxss_eml_slug;
    }
}



/**
 *  wpuxss_get_eml_basename
 *
 *  @since    2.1
 *  @created  27/10/15
 */

if ( ! function_exists( 'wpuxss_get_eml_basename' ) ) {

    function wpuxss_get_eml_basename() {

        $wpuxss_eml_basename = wpuxss_get_eml_slug() . '/' . basename(__FILE__);

        return $wpuxss_eml_basename;
    }
}



/**
 *  wpuxss_eml_enhance_media_shortcodes
 *
 *  @since    2.1.4
 *  @created  08/01/16
 */

if ( ! function_exists( 'wpuxss_eml_enhance_media_shortcodes' ) ) {

    function wpuxss_eml_enhance_media_shortcodes() {

        $wpuxss_eml_lib_options = get_option('wpuxss_eml_lib_options');

        $enhance_media_shortcodes = isset( $wpuxss_eml_lib_options['enhance_media_shortcodes'] ) ? (bool)$wpuxss_eml_lib_options['enhance_media_shortcodes'] : false;

        return $enhance_media_shortcodes;
    }
}



/**
 *  Load plugin text domain
 *
 *  @since    2.0.4.7
 *  @created  18/07/15
 */

add_action( 'plugins_loaded', 'wpuxss_eml_on_plugins_loaded' );

if ( ! function_exists( 'wpuxss_eml_on_plugins_loaded' ) ) {

    function wpuxss_eml_on_plugins_loaded() {

      load_plugin_textdomain( 'enhanced-media-library', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }
}



/**
 *  Free functionality
 */

include_once( 'core/mime-types.php' );
include_once( 'core/taxonomies.php' );

if ( wpuxss_eml_enhance_media_shortcodes() ) {
    include_once( 'core/medialist.php' );
}

if ( is_admin() ) {
    include_once( 'core/options-pages.php' );
}



/**
 *  wpuxss_eml_on_init
 *
 *  @since    1.0
 *  @created  03/08/13
 */

add_action('init', 'wpuxss_eml_on_init', 12);

if ( ! function_exists( 'wpuxss_eml_on_init' ) ) {

    function wpuxss_eml_on_init() {

        global $wpuxss_eml_dir,
               $wpuxss_eml_path,
               $wpuxss_eml_version;


        $wpuxss_eml_dir = plugin_dir_url( __FILE__ );
        $wpuxss_eml_path = plugin_dir_path( __FILE__ );


        $wpuxss_eml_old_version = get_option( 'wpuxss_eml_version', null );

        if ( version_compare( $wpuxss_eml_version, $wpuxss_eml_old_version, '<>' ) ) {
            update_option( 'wpuxss_eml_version', $wpuxss_eml_version );
        }

        if ( is_null( $wpuxss_eml_old_version ) ) {
            wpuxss_eml_on_activation();
        }
        else {
            wpuxss_eml_on_update();
        }


        $wpuxss_eml_taxonomies = get_option( 'wpuxss_eml_taxonomies', array() );

        // register eml taxonomies
        foreach ( (array) $wpuxss_eml_taxonomies as $taxonomy => $params ) {

            if ( $params['eml_media'] && ! empty( $params['labels']['singular_name'] ) && ! empty( $params['labels']['name'] ) ) {

                register_taxonomy(
                    $taxonomy,
                    'attachment',
                    array(
                        'labels' => $params['labels'],
                        'public' => true,
                        'show_admin_column' => $params['show_admin_column'],
                        'show_in_nav_menus' => $params['show_in_nav_menus'],
                        'hierarchical' => $params['hierarchical'],
                        'update_count_callback' => '_update_generic_term_count',
                        'sort' => $params['sort'],
                        'show_in_rest' => $params['show_in_rest'],
                        'rewrite' => array(
                            'slug' => $params['rewrite']['slug'],
                            'with_front' => $params['rewrite']['with_front']
                        )
                    )
                );
            }
        } // endforeach
    }
}



/**
 *  wpuxss_eml_on_wp_loaded
 *
 *  @since    1.0
 *  @created  03/11/13
 */

add_action( 'wp_loaded', 'wpuxss_eml_on_wp_loaded' );

if ( ! function_exists( 'wpuxss_eml_on_wp_loaded' ) ) {

    function wpuxss_eml_on_wp_loaded() {

        global $wp_taxonomies;

        $wpuxss_eml_taxonomies = get_option( 'wpuxss_eml_taxonomies', array() );
        $taxonomies = get_taxonomies( array(), 'object' );

        // discover 'foreign' taxonomies
        foreach ( $taxonomies as $taxonomy => $params ) {

            if ( ! empty( $params->object_type ) && ! array_key_exists( $taxonomy,$wpuxss_eml_taxonomies ) && ! in_array( 'revision', $params->object_type ) && ! in_array( 'nav_menu_item', $params->object_type ) && $taxonomy !== 'post_format' && $taxonomy !== 'link_category' ) {

                $wpuxss_eml_taxonomies[$taxonomy] = array(
                    'eml_media' => 0,
                    'admin_filter' => 0,
                    'media_uploader_filter' => 0,
                    'media_popup_taxonomy_edit' => 0,
                    'taxonomy_auto_assign' => 0
                );

                if ( in_array('attachment',$params->object_type) )
                    $wpuxss_eml_taxonomies[$taxonomy]['assigned'] = 1;
                else
                    $wpuxss_eml_taxonomies[$taxonomy]['assigned'] = 0;
            }
        }

        // assign/unassign taxonomies to atachment
        foreach ( $wpuxss_eml_taxonomies as $taxonomy => $params ) {

            if ( $params['assigned'] )
                register_taxonomy_for_object_type( $taxonomy, 'attachment' );

            if ( ! $params['assigned'] )
                unregister_taxonomy_for_object_type( $taxonomy, 'attachment' );
        }

        // update_count_callback for attachment taxonomies if needed
        foreach ( $taxonomies as $taxonomy => $params ) {

            if ( in_array('attachment',$params->object_type) ) {

                if ( ! isset( $wp_taxonomies[$taxonomy]->update_count_callback ) ||
                       empty( $wp_taxonomies[$taxonomy]->update_count_callback ) ) {

                    $wp_taxonomies[$taxonomy]->update_count_callback = '_update_generic_term_count';
                }
            }
        }

        update_option( 'wpuxss_eml_taxonomies', $wpuxss_eml_taxonomies );
    }
}



/**
 *  wpuxss_eml_admin_enqueue_scripts
 *
 *  @since    1.1.1
 *  @created  07/04/14
 */

add_action( 'admin_enqueue_scripts', 'wpuxss_eml_admin_enqueue_scripts' );

if ( ! function_exists( 'wpuxss_eml_admin_enqueue_scripts' ) ) {

    function wpuxss_eml_admin_enqueue_scripts() {

        global $wpuxss_eml_version,
               $wpuxss_eml_dir,
               $current_screen;


        $media_library_mode = get_user_option( 'media_library_mode', get_current_user_id() ) ? get_user_option( 'media_library_mode', get_current_user_id() ) : 'grid';


        // admin styles
        wp_enqueue_style(
            'wpuxss-eml-admin-custom-style',
            $wpuxss_eml_dir . 'css/eml-admin.css',
            false,
            $wpuxss_eml_version,
            'all'
        );

        wp_enqueue_style ( 'wp-jquery-ui-dialog' );


        // admin scripts
        wp_enqueue_script(
            'wpuxss-eml-admin-script',
            $wpuxss_eml_dir . 'js/eml-admin.js',
            array( 'jquery', 'jquery-ui-dialog' ),
            $wpuxss_eml_version,
            true
        );



        // scripts for list view :: /wp-admin/upload.php
        if ( isset( $current_screen ) && 'upload' === $current_screen->base && 'list' === $media_library_mode ) {

            wp_enqueue_script(
                'wpuxss-eml-media-list-script',
                $wpuxss_eml_dir . 'js/eml-media-list.js',
                array('jquery'),
                $wpuxss_eml_version,
                true
            );

            $media_list_l10n = array(
                '$_GET'   => wp_json_encode($_GET),
                'uncategorized' => __( 'All Uncategorized', 'enhanced-media-library' ),
                'reset_all_filters' => __( 'Reset All Filters', 'enhanced-media-library' )
            );

            wp_localize_script(
                'wpuxss-eml-media-list-script',
                'wpuxss_eml_media_list_l10n',
                $media_list_l10n
            );
        }
    }
}



/**
 *  wpuxss_eml_enqueue_media
 *
 *  @since    2.0
 *  @created  04/09/14
 */

add_action( 'wp_enqueue_media', 'wpuxss_eml_enqueue_media' );

if ( ! function_exists( 'wpuxss_eml_enqueue_media' ) ) {

    function wpuxss_eml_enqueue_media() {

        global $wpuxss_eml_version,
               $wpuxss_eml_dir,
               $wp_version,
               $current_screen;


        if ( ! is_admin() ) {
            return;
        }


        $media_library_mode = get_user_option( 'media_library_mode', get_current_user_id() ) ? get_user_option( 'media_library_mode', get_current_user_id() ) : 'grid';

        $wpuxss_eml_lib_options = get_option('wpuxss_eml_lib_options');
        $wpuxss_eml_tax_options = get_option('wpuxss_eml_tax_options');

        // taxonomies for passing to media uploader's filter
        $wpuxss_eml_taxonomies = get_option('wpuxss_eml_taxonomies');
        if ( empty($wpuxss_eml_taxonomies) ) $wpuxss_eml_taxonomies = array();

        $all_taxonomies_array = array(); // all attachment taxonomies
        $taxonomies_array = array(); // attachment taxonomies excluding those without grid view filter
        $compat_taxonomies_to_hide = array();
        $compat_taxonomies_to_show = array();
        $compat_taxonomies = array();

        foreach ( get_object_taxonomies('attachment','object') as $taxonomy ) {

            $terms_array = array();
            $terms = array();

            if ( $wpuxss_eml_taxonomies[$taxonomy->name]['media_uploader_filter'] && function_exists( 'wp_terms_checklist' ) ) {

                ob_start();

                    wp_terms_checklist( 0, array( 'taxonomy' => $taxonomy->name, 'checked_ontop' => false, 'walker' => new Walker_Media_Taxonomy_Uploader_Filter() ) );

                    $html = '';
                    if ( ob_get_contents() != false ) {
                        $html = ob_get_contents();
                    }

                ob_end_clean();


                $html = str_replace( '}{', '},{', $html );
                $html = '[' . $html . ']';
                $terms = json_decode( $html, true );
                $terms = array_filter( $terms );


                if ( ! empty( $terms ) ) {

                    $taxonomies_array[$taxonomy->name] = array(
                        'singular_name' => $taxonomy->labels->singular_name,
                        'plural_name'   => $taxonomy->labels->name,
                        'term_list'     => $terms
                    );
                }
            }

            $all_terms = get_terms( $taxonomy->name, array('fields'=>'id=>name','get'=>'all') );
            $all_taxonomies_array[$taxonomy->name] = array(
                'singular_name' => $taxonomy->labels->singular_name,
                'plural_name'   => $taxonomy->labels->name,
                'terms' => $all_terms
            );

            if ( ! $wpuxss_eml_taxonomies[$taxonomy->name]['media_popup_taxonomy_edit'] ) {
                $compat_taxonomies_to_hide[] = $taxonomy->name;
            }
            elseif ( $wpuxss_eml_tax_options['edit_all_as_hierarchical'] || $taxonomy->hierarchical ) {
                $compat_taxonomies_to_show[] = $taxonomy->name;
            }

            $compat_taxonomies[] = $taxonomy->name;

        } //endforeach


        // generic scripts

        wp_enqueue_script(
            'wpuxss-eml-media-models-script',
            $wpuxss_eml_dir . 'js/eml-media-models.js',
            array('media-models'),
            $wpuxss_eml_version,
            true
        );

        wp_enqueue_script(
            'wpuxss-eml-media-views-script',
            $wpuxss_eml_dir . 'js/eml-media-views.js',
            array('media-views'),
            $wpuxss_eml_version,
            true
        );


// TODO:
//        wp_enqueue_script(
//            'wpuxss-eml-tags-box-script',
//            '/wp-admin/js/tags-box.js',
//            array(),
//            $wpuxss_eml_version,
//            true
//        );


        $media_models_l10n = array(
            'media_orderby'   => $wpuxss_eml_lib_options['media_orderby'],
            'media_order'     => $wpuxss_eml_lib_options['media_order'],
            'bulk_edit_nonce' => wp_create_nonce( 'eml-bulk-edit-nonce' )
        );

        wp_localize_script(
            'wpuxss-eml-media-models-script',
            'wpuxss_eml_media_models_l10n',
            $media_models_l10n
        );


        $media_views_l10n = array(
            'taxonomies'                => $taxonomies_array,
            'compat_taxonomies'         => $compat_taxonomies,
            'compat_taxonomies_to_hide' => $compat_taxonomies_to_hide,
            'is_tax_compat'             => count( $compat_taxonomies_to_show ) ? 1 : 0,
            'force_filters'             => $wpuxss_eml_tax_options['force_filters'],
            'wp_version'                => $wp_version,
            'uncategorized'             => __( 'All Uncategorized', 'enhanced-media-library' ),
            'filter_by'                 => __( 'Filter by', 'enhanced-media-library' ),
            'in'                        => __( 'All', 'enhanced-media-library' ),
            'not_in'                    => __( 'Not in', 'enhanced-media-library' ),
            'reset_filters'             => __( 'Reset All Filters', 'enhanced-media-library' ),
            'current_screen'            => isset( $current_screen ) ? $current_screen->id : ''
        );

        wp_localize_script(
            'wpuxss-eml-media-views-script',
            'wpuxss_eml_media_views_l10n',
            $media_views_l10n
        );


        if ( wpuxss_eml_enhance_media_shortcodes() ) {

            wp_enqueue_script(
                'wpuxss-eml-enhanced-medialist-script',
                $wpuxss_eml_dir . 'js/eml-enhanced-medialist.js',
                array('media-views'),
                $wpuxss_eml_version,
                true
            );

            wp_enqueue_script(
                'wpuxss-eml-media-editor-script',
                $wpuxss_eml_dir . 'js/eml-media-editor.js',
                array('media-editor','media-views', 'wpuxss-eml-enhanced-medialist-script'),
                $wpuxss_eml_version,
                true
            );

            $enhanced_medialist_l10n = array(
                'all_taxonomies' => $all_taxonomies_array,
                'uploaded_to' => __( 'Uploaded to post #', 'enhanced-media-library' ),
                'based_on' => __( 'Based On', 'enhanced-media-library' )
            );

            wp_localize_script(
                'wpuxss-eml-enhanced-medialist-script',
                'wpuxss_eml_enhanced_medialist_l10n',
                $enhanced_medialist_l10n
            );
        }


        // scripts for grid view :: /wp-admin/upload.php
        if ( isset( $current_screen ) && 'upload' === $current_screen->base && 'grid' === $media_library_mode ) {

            wp_enqueue_script(
                'wpuxss-eml-media-grid-script',
                $wpuxss_eml_dir . 'js/eml-media-grid.js',
                array('media'),
                $wpuxss_eml_version,
                true
            );
        }
    }
}




/**
 *  wpuxss_eml_on_activation
 *
 *  @since    2.2
 *  @created  12/03/16
 */

if ( ! function_exists( 'wpuxss_eml_on_activation' ) ) {

    function wpuxss_eml_on_activation() {

        $wpuxss_eml_taxonomies['media_category'] = array(
            'assigned' => 1,
            'eml_media' => 1,
            'public' => 1,

            'labels' => array(
                'name' => __( 'Media Categories', 'enhanced-media-library' ),
                'singular_name' => __( 'Media Category', 'enhanced-media-library' ),
                'menu_name' => __( 'Media Categories', 'enhanced-media-library' ),
                'all_items' => __( 'All Media Categories', 'enhanced-media-library' ),
                'edit_item' => __( 'Edit Media Category', 'enhanced-media-library' ),
                'view_item' => __( 'View Media Category', 'enhanced-media-library' ),
                'update_item' => __( 'Update Media Category', 'enhanced-media-library' ),
                'add_new_item' => __( 'Add New Media Category', 'enhanced-media-library' ),
                'new_item_name' => __( 'New Media Category Name', 'enhanced-media-library' ),
                'parent_item' => __( 'Parent Media Category', 'enhanced-media-library' ),
                'parent_item_colon' => __( 'Parent Media Category:', 'enhanced-media-library' ),
                'search_items' => __( 'Search Media Categories', 'enhanced-media-library' )
            ),

            'hierarchical' => 1,

            'show_admin_column' => 1,
            'admin_filter' => 1,          // list view filter
            'media_uploader_filter' => 1, // grid view filter
            'media_popup_taxonomy_edit' => 1,

            'show_in_nav_menus' => 1,
            'sort' => 0,
            'show_in_rest' => 0,
            'rewrite' => array(
                'slug' => 'media_category',
                'with_front' => 1
            )
        );

        $wpuxss_eml_lib_options = array(
            'enhance_media_shortcodes' => 0,
            'media_orderby' => 'date',
            'media_order' => 'DESC'
        );

        $wpuxss_eml_tax_options = array(
            'tax_archives' => 1,
            'edit_all_as_hierarchical' => 0,
            'force_filters' => 0
        );

        $allowed_mimes = get_allowed_mime_types();

        foreach ( wp_get_mime_types() as $type => $mime ) {

            $wpuxss_eml_mimes[$type] = array(
                'mime'     => $mime,
                'singular' => $mime,
                'plural'   => $mime,
                'filter'   => 0,
                'upload'   => isset($allowed_mimes[$type]) ? 1 : 0
            );
        }

        // backup mimes without PDF
        update_option( 'wpuxss_eml_mimes_backup', $wpuxss_eml_mimes );

        $wpuxss_eml_mimes['pdf']['singular'] = 'PDF';
        $wpuxss_eml_mimes['pdf']['plural'] = 'PDFs';
        $wpuxss_eml_mimes['pdf']['filter'] = 1;

        update_option( 'wpuxss_eml_taxonomies', $wpuxss_eml_taxonomies );
        update_option( 'wpuxss_eml_lib_options', $wpuxss_eml_lib_options );
        update_option( 'wpuxss_eml_tax_options', $wpuxss_eml_tax_options );

        update_option( 'wpuxss_eml_mimes', $wpuxss_eml_mimes );
    }
}



/**
 *  wpuxss_eml_on_update
 *
 *  @since    2.2
 *  @created  12/03/16
 */

if ( ! function_exists( 'wpuxss_eml_on_update' ) ) {

    function wpuxss_eml_on_update() {

        $wpuxss_eml_taxonomies = get_option( 'wpuxss_eml_taxonomies' );
        $wpuxss_eml_lib_options = get_option( 'wpuxss_eml_lib_options', null );
        $wpuxss_eml_tax_options = get_option( 'wpuxss_eml_tax_options', null );


        foreach( (array) $wpuxss_eml_taxonomies as $taxonomy => $params ) {

            $eml_media = intval( $params['eml_media'] );

            // since 2.0.2
            if ( $eml_media && ! isset( $params['rewrite']['with_front'] ) ) {
                $wpuxss_eml_taxonomies[$taxonomy]['rewrite']['with_front'] = 1;
            }

            // since 2.0.4
            if ( ! isset( $wpuxss_eml_taxonomies[$taxonomy]['media_popup_taxonomy_edit'] ) ) {
                $wpuxss_eml_taxonomies[$taxonomy]['media_popup_taxonomy_edit'] = 0;
            }

            // since 2.1.6
            if ( $eml_media && ! isset( $params['show_in_rest'] ) ) {
                $wpuxss_eml_taxonomies[$taxonomy]['show_in_rest'] = 0;
            }

            // since 2.2
            if ( ! $eml_media && ! isset( $params['taxonomy_auto_assign'] ) ) {
                $wpuxss_eml_taxonomies[$taxonomy]['taxonomy_auto_assign'] = 0;
            }

            // unset since 2.2
            if ( $taxonomy == 'link_category' ) {
                unset( $wpuxss_eml_taxonomies[$taxonomy] );
            }
            if ( ! $eml_media ) {

                if ( isset( $params['hierarchical'] ) ) {
                    unset( $wpuxss_eml_taxonomies[$taxonomy]['hierarchical'] );
                }
                if ( isset( $params['rewrite'] ) ) {
                    unset( $wpuxss_eml_taxonomies[$taxonomy]['rewrite'] );
                }
                if ( isset( $params['sort'] ) ) {
                    unset( $wpuxss_eml_taxonomies[$taxonomy]['sort'] );
                }
                if ( isset( $params['show_admin_column'] ) ) {
                    unset( $wpuxss_eml_taxonomies[$taxonomy]['show_admin_column'] );
                }
                if ( isset( $params['show_in_nav_menus'] ) ) {
                    unset( $wpuxss_eml_taxonomies[$taxonomy]['show_in_nav_menus'] );
                }
                if ( isset( $params['show_in_rest'] ) ) {
                    unset( $wpuxss_eml_taxonomies[$taxonomy]['show_in_rest'] );
                }
            }
        }


        // since 2.0.4
        if ( is_null( $wpuxss_eml_tax_options ) ) {

            $wpuxss_eml_tax_options = array(
                'tax_archives' => 1,
                'edit_all_as_hierarchical' => 0,
                'force_filters' => 0
            );
        }


        // since 2.2.1
        if ( is_null( $wpuxss_eml_lib_options ) ) {

            if ( ! is_null( $wpuxss_eml_tax_options ) ) {

                if ( isset( $wpuxss_eml_tax_options['enhance_media_shortcodes'] ) ) {
                    $wpuxss_eml_lib_options['enhance_media_shortcodes'] = $wpuxss_eml_tax_options['enhance_media_shortcodes'];
                    unset( $wpuxss_eml_tax_options['enhance_media_shortcodes'] );
                }
                elseif ( isset( $wpuxss_eml_tax_options['enhance_gallery_shortcode'] ) ) {
                    $wpuxss_eml_lib_options['enhance_media_shortcodes'] = $wpuxss_eml_tax_options['enhance_gallery_shortcode'];
                    unset( $wpuxss_eml_tax_options['enhance_gallery_shortcode'] );
                }
                else {
                    $wpuxss_eml_lib_options['enhance_media_shortcodes'] = 0;
                }

                if ( isset( $wpuxss_eml_tax_options['media_orderby'] ) ) {
                    $wpuxss_eml_lib_options['media_orderby'] = $wpuxss_eml_tax_options['media_orderby'];
                    unset( $wpuxss_eml_tax_options['media_orderby'] );
                }
                else {
                    $wpuxss_eml_lib_options['media_orderby'] = 'date';
                }

                if ( isset( $wpuxss_eml_tax_options['media_order'] ) ) {
                    $wpuxss_eml_lib_options['media_order'] = $wpuxss_eml_tax_options['media_order'];
                    unset( $wpuxss_eml_tax_options['media_order'] );
                }
                else {
                    $wpuxss_eml_lib_options['media_order'] = 'DESC';
                }
            }
            else {
                $wpuxss_eml_lib_options = array(
                    'enhance_media_shortcodes' => 0,
                    'media_orderby' => 'date',
                    'media_order' => 'DESC'
                );
            }
        }


        update_option( 'wpuxss_eml_taxonomies', $wpuxss_eml_taxonomies );
        update_option( 'wpuxss_eml_lib_options', $wpuxss_eml_lib_options );
        update_option( 'wpuxss_eml_tax_options', $wpuxss_eml_tax_options );
    }
}

?>
