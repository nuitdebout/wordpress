<?php

if ( ! defined( 'ABSPATH' ) )
	exit;



/**
 *  wpuxss_eml_taxonomies_validate
 *
 *  @type     callback function
 *  @since    1.0
 *  @created  28/09/13
 */

if ( ! function_exists( 'wpuxss_eml_taxonomies_validate' ) ) {

    function wpuxss_eml_taxonomies_validate( $input ) {

        if ( ! $input ) $input = array();


        foreach ( $input as $taxonomy => $params ) {

            $sanitized_taxonomy = sanitize_key( $taxonomy );

            if ( isset( $params['create_taxonomy'] ) ) {

                unset( $input[$taxonomy]['create_taxonomy'] );

                if ( taxonomy_exists( $sanitized_taxonomy ) ) {

                    unset( $input[$taxonomy] );
                    continue;
                }
            }


            if ( ! empty( $sanitized_taxonomy ) ) {

                $input[$sanitized_taxonomy] = $input[$taxonomy];
                unset( $input[$taxonomy] );
                $taxonomy = $sanitized_taxonomy;
            }
            else {
                unset( $input[$taxonomy] );
                continue;
            }


            $input[$taxonomy]['eml_media'] = isset( $params['eml_media'] ) && !! $params['eml_media'] ? 1 : 0;

            if ( $input[$taxonomy]['eml_media'] ) {
                $input[$taxonomy]['hierarchical'] = isset($params['hierarchical']) && !! $params['hierarchical'] ? 1 : 0;
                $input[$taxonomy]['show_in_rest'] = isset($params['show_in_rest']) && !! $params['show_in_rest'] ? 1 : 0;
                $input[$taxonomy]['sort'] = isset($params['sort']) && !! $params['sort'] ? 1 : 0;
                $input[$taxonomy]['show_admin_column'] = isset($params['show_admin_column']) && !! $params['show_admin_column'] ? 1 : 0;
                $input[$taxonomy]['show_in_nav_menus'] = isset($params['show_in_nav_menus']) && !! $params['show_in_nav_menus'] ? 1 : 0;
                $input[$taxonomy]['rewrite']['with_front'] = isset($params['rewrite']['with_front']) && !! $params['rewrite']['with_front'] ? 1 : 0;
                $input[$taxonomy]['rewrite']['slug'] = isset($params['rewrite']['slug']) ? wpuxss_eml_sanitize_slug( $params['rewrite']['slug'], $taxonomy ) : '';
            }

            if ( ! $input[$taxonomy]['eml_media'] ) {
                $input[$taxonomy]['taxonomy_auto_assign'] = isset($params['taxonomy_auto_assign']) && !! $params['taxonomy_auto_assign'] ? 1 : 0;
            }


            $input[$taxonomy]['assigned'] = isset($params['assigned']) && !! $params['assigned'] ? 1 : 0;
            $input[$taxonomy]['admin_filter'] = isset($params['admin_filter']) && !! $params['admin_filter'] ? 1 : 0;
            $input[$taxonomy]['media_uploader_filter'] = isset($params['media_uploader_filter']) && !! $params['media_uploader_filter'] ? 1 : 0;
            $input[$taxonomy]['media_popup_taxonomy_edit'] = isset($params['media_popup_taxonomy_edit']) && !! $params['media_popup_taxonomy_edit'] ? 1 : 0;


            if ( isset( $params['labels'] ) ) {

                $default_labels = array(
                    'menu_name' => $params['labels']['name'],
                    'all_items' => 'All ' . $params['labels']['name'],
                    'edit_item' => 'Edit ' . $params['labels']['singular_name'],
                    'view_item' => 'View ' . $params['labels']['singular_name'],
                    'update_item' => 'Update ' . $params['labels']['singular_name'],
                    'add_new_item' => 'Add New ' . $params['labels']['singular_name'],
                    'new_item_name' => 'New ' . $params['labels']['singular_name'] . ' Name',
                    'parent_item' => 'Parent ' . $params['labels']['singular_name'],
                    'search_items' => 'Search ' . $params['labels']['name']
                );

                foreach ( $params['labels'] as $label => $value ) {

                    $input[$taxonomy]['labels'][$label] = sanitize_text_field($value);

                    if ( empty($value) && isset($default_labels[$label]) )
                        $input[$taxonomy]['labels'][$label] = sanitize_text_field($default_labels[$label]);
                }
            }
        }

        add_settings_error(
            'media-taxonomies',
            'eml_taxonomy_settings_saved',
            __('Media Taxonomies settings saved.', 'enhanced-media-library'),
            'updated'
        );

        return $input;
    }
}



/**
 *  wpuxss_eml_sanitize_slug
 *
 *  @since    2.0.4
 *  @created  07/02/15
 */

if ( ! function_exists( 'wpuxss_eml_sanitize_slug' ) ) {

    function wpuxss_eml_sanitize_slug( $slug, $fallback_slug = '' ) {

        $slug_array = explode ( '/', $slug );
        $slug_array = array_filter( $slug_array );
        $slug_array = array_map ( 'remove_accents', $slug_array );
        $slug_array = array_map ( 'sanitize_title_with_dashes', $slug_array );

        $slug = implode ( '/', $slug_array );

        if ( '' === $slug || false === $slug )
            $slug = $fallback_slug;

        return $slug;
    }
}



if ( ! function_exists( 'wpuxss_eml_lib_options_validate' ) ) {

    function wpuxss_eml_lib_options_validate( $input ) {

        foreach ( (array)$input as $key => $option ) {

            if ( 'media_orderby' === $key || 'media_order' === $key ) {
                $input[$key] = sanitize_text_field( $option );
            }
            else {
                $input[$key] = isset( $option ) && !! $option ? 1 : 0;
            }
        }

        if ( ! isset( $input['media_order'] ) ) {
            $input['media_order'] = 'ASC';
        }

        add_settings_error(
            'media-library',
            'eml_library_settings_saved',
            __('Media Library settings saved.', 'enhanced-media-library'),
            'updated'
        );

        return $input;
    }
}



/**
 *  wpuxss_eml_tax_options_validate
 *
 *  @type     callback function
 *  @since    2.0.4
 *  @created  28/01/15
 */

if ( ! function_exists( 'wpuxss_eml_tax_options_validate' ) ) {

    function wpuxss_eml_tax_options_validate( $input ) {

        foreach ( (array)$input as $key => $option ) {
            $input[$key] = isset( $option ) && !! $option ? 1 : 0;
        }

        return $input;
    }
}



/**
 *  wpuxss_eml_ajax_query_attachments
 *
 *  Based on /wp-admin/includes/ajax-actions.php
 *
 *  @since    1.0
 *  @created  03/08/13
 */

add_action( 'wp_ajax_query-attachments', 'wpuxss_eml_ajax_query_attachments', 0 );

if ( ! function_exists( 'wpuxss_eml_ajax_query_attachments' ) ) {

    function wpuxss_eml_ajax_query_attachments() {

        global $wp_version;

        if ( ! current_user_can( 'upload_files' ) )
            wp_send_json_error();

        $query = isset( $_REQUEST['query'] ) ? (array) $_REQUEST['query'] : array();

        $uncategorized = ( isset( $query['uncategorized'] ) && $query['uncategorized'] ) ? 1 : 0;

        // TODO: delete code for < 4.1
        if ( version_compare( $wp_version, '4.1', '<' ) ) {

            if ( isset( $query['year'] ) && $query['year'] &&
                 isset( $query['monthnum'] ) && $query['monthnum'] ) {

                $query['m'] = $query['year'] . $query['monthnum'];
            }
            else {

                $query['m'] = '';
            }

            $query = array_intersect_key( $query, array_flip( array(
                's', 'order', 'orderby', 'posts_per_page', 'paged', 'post_mime_type',
                'post_parent', 'post__in', 'post__not_in', 'm'
            ) ) );
        }
        else {

            $query = array_intersect_key( $query, array_flip( array(
                's', 'order', 'orderby', 'posts_per_page', 'paged', 'post_mime_type',
                'post_parent', 'post__in', 'post__not_in', 'year', 'monthnum'
            ) ) );
        }

        foreach ( get_object_taxonomies( 'attachment', 'names' ) as $taxonomy ) {

            if ( $uncategorized ) {

                $terms = get_terms( $taxonomy, array('fields'=>'ids','get'=>'all') );

                $tax_query[] = array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $terms,
                    'operator' => 'NOT IN',
                );
            }
            else {

                if ( isset( $_REQUEST['query'][$taxonomy] ) && $_REQUEST['query'][$taxonomy] ) {

                    if( is_numeric( $_REQUEST['query'][$taxonomy] ) ||
                        is_array( $_REQUEST['query'][$taxonomy] ) ) {

                        $tax_query[] = array(
                            'taxonomy' => $taxonomy,
                            'field' => 'term_id',
                            'terms' => (array) $_REQUEST['query'][$taxonomy]
                        );
                    }
                    elseif ( 'not_in' === $_REQUEST['query'][$taxonomy] ) {

                        $terms = get_terms( $taxonomy, array('fields'=>'ids','get'=>'all') );

                        $tax_query[] = array(
                            'taxonomy' => $taxonomy,
                            'field' => 'term_id',
                            'terms' => $terms,
                            'operator' => 'NOT IN',
                        );
                    }
                    elseif ( 'in' === $_REQUEST['query'][$taxonomy] ) {

                        $terms = get_terms( $taxonomy, array('fields'=>'ids','get'=>'all') );

                        $tax_query[] = array(
                            'taxonomy' => $taxonomy,
                            'field' => 'term_id',
                            'terms' => $terms,
                            'operator' => 'IN',
                        );
                    }
                }
            }
        } // endforeach

        if ( ! empty( $tax_query ) ) {
            $tax_query['relation'] = 'AND';
            $query['tax_query'] = $tax_query;
        }

        $query['post_type'] = 'attachment';

        if ( MEDIA_TRASH
            && ! empty( $_REQUEST['query']['post_status'] )
            && 'trash' === $_REQUEST['query']['post_status'] ) {

            $query['post_status'] = 'trash';
        }
        else {

            $query['post_status'] = 'inherit';
        }

        if ( current_user_can( get_post_type_object( 'attachment' )->cap->read_private_posts ) )
            $query['post_status'] .= ',private';

        $query = apply_filters( 'ajax_query_attachments_args', $query );
        $query = new WP_Query( $query );

        $posts = array_map( 'wp_prepare_attachment_for_js', $query->posts );
        $posts = array_filter( $posts );

        wp_send_json_success( $posts );
    }
}



/**
 *  wpuxss_eml_restrict_manage_posts
 *
 *  Adds taxonomy filters to Media Library List View
 *
 *  @since    1.0
 *  @created  11/08/13
 */

add_action( 'restrict_manage_posts', 'wpuxss_eml_restrict_manage_posts' );

if ( ! function_exists( 'wpuxss_eml_restrict_manage_posts' ) ) {

    function wpuxss_eml_restrict_manage_posts() {

        global $current_screen,
               $wp_query;


        $media_library_mode = get_user_option( 'media_library_mode'  ) ? get_user_option( 'media_library_mode'  ) : 'grid';


        if ( isset( $current_screen ) && 'upload' === $current_screen->base && 'list' === $media_library_mode ) {

            $wpuxss_eml_taxonomies = get_option('wpuxss_eml_taxonomies');

            $uncategorized = ( isset( $_REQUEST['attachment-filter'] ) && 'uncategorized' === $_REQUEST['attachment-filter'] ) ? 1 : 0;

            foreach ( get_object_taxonomies( 'attachment', 'object' ) as $taxonomy ) {

                if ( $wpuxss_eml_taxonomies[$taxonomy->name]['admin_filter'] ) {

                    echo "<label for='{$taxonomy->name}' class='screen-reader-text'>" . __('Filter by','enhanced-media-library') . " {$taxonomy->labels->singular_name}</label>";

                    $selected = ( ! $uncategorized && isset( $wp_query->query[$taxonomy->name] ) ) ? $wp_query->query[$taxonomy->name] : 0;

                    wp_dropdown_categories(
                        array(
                            'show_option_all'    =>  __( 'Filter by', 'enhanced-media-library' ) . ' ' . $taxonomy->labels->singular_name,
                            'show_option_in'     =>  '— ' . __( 'All', 'enhanced-media-library' ) . ' ' . $taxonomy->labels->name . ' —',
                            'show_option_not_in' =>  '— ' . __( 'Not in', 'enhanced-media-library' ) . ' ' . $taxonomy->labels->singular_name . ' —',
                            'taxonomy'           =>  $taxonomy->name,
                            'name'               =>  $taxonomy->name,
                            'orderby'            =>  'name',
                            'selected'           =>  $selected,
                            'hierarchical'       =>  true,
                            'show_count'         =>  true,
                            'hide_empty'         =>  false,
                            'hide_if_empty'      =>  true,
                            'class'              =>  'eml-taxonomy-filters'
                        )
                    );
                }
            } // endforeach
        }
    }
}



/**
 *  wpuxss_eml_dropdown_cats
 *
 *  Modifies taxonomy filters in Media Library List View
 *
 *  @since    2.0.4.5
 *  @created  19/04/15
 */

add_filter( 'wp_dropdown_cats', 'wpuxss_eml_dropdown_cats', 10, 2 );

if ( ! function_exists( 'wpuxss_eml_dropdown_cats' ) ) {

    function wpuxss_eml_dropdown_cats( $output, $r ) {

        global $current_screen;


        if ( ! is_admin() || empty( $output ) || ! isset( $current_screen ) ) {
            return $output;
        }


        $media_library_mode = get_user_option( 'media_library_mode' ) ? get_user_option( 'media_library_mode' ) : 'grid';


        if ( 'upload' !== $current_screen->base || 'list' !== $media_library_mode ) {
            return $output;
        }


        $whole_select = $output;
        $options_array = array();

        while ( strlen( $whole_select ) >= 7 && false !== ( $option_pos = strpos( $whole_select, '<option', 7 ) ) ) {

            $options_array[] = substr($whole_select, 0, $option_pos);
            $whole_select = substr($whole_select, $option_pos);
        }
        $options_array[] = $whole_select;

        if ( empty( $options_array ) )
            return $output;

        $new_output = '';

        if ( isset( $r['show_option_in'] ) && (bool) $r['show_option_in'] ) {

            $show_option_in = $r['show_option_in'];
            $selected = ( 'in' === strval($r['selected']) ) ? " selected='selected'" : '';
            $new_output .= "\t<option value='in'$selected>$show_option_in</option>\n";
        }

        if ( isset( $r['show_option_not_in'] ) && (bool) $r['show_option_not_in'] ) {

            $show_option_not_in = $r['show_option_not_in'];
            $selected = ( 'not_in' === strval($r['selected']) ) ? " selected='selected'" : '';
            $new_output .= "\t<option value='not_in'$selected>$show_option_not_in</option>\n";
        }

        array_splice( $options_array, 2, 0, $new_output );

        $output = implode('', $options_array);

        return $output;
    }
}



/**
 *  wpuxss_eml_parse_tax_query
 *
 *  @since    2.0.4
 *  @created  19/02/15
 */

add_action( 'parse_tax_query', 'wpuxss_eml_parse_tax_query' );

if ( ! function_exists( 'wpuxss_eml_parse_tax_query' ) ) {

    function wpuxss_eml_parse_tax_query( $query ) {

        global $current_screen;


        if ( ! is_admin() || ! isset( $current_screen ) ) {
            return;
        }


        $media_library_mode = get_user_option( 'media_library_mode' ) ? get_user_option( 'media_library_mode' ) : 'grid';


        if ( 'upload' !== $current_screen->base || 'list' !== $media_library_mode ) {
            return;
        }


        $uncategorized = ( isset( $_REQUEST['attachment-filter'] ) && 'uncategorized' === $_REQUEST['attachment-filter'] ) ? 1 : 0;

        if ( isset( $_REQUEST['category'] ) )
            $query->query['category'] = $query->query_vars['category'] = $_REQUEST['category'];

        if ( isset( $_REQUEST['post_tag'] ) )
            $query->query['post_tag'] = $query->query_vars['post_tag'] = $_REQUEST['post_tag'];

        if ( isset( $query->query_vars['taxonomy'] ) && isset( $query->query_vars['term'] ) ) {

            $tax = $query->query_vars['taxonomy'];
            $term = get_term_by( 'slug', $query->query_vars['term'], $tax );

            if ( $term ) {

                $query->query_vars[$tax] = $term->term_id;
                $query->query[$tax] = $term->term_id;

                unset( $query->query_vars['taxonomy'] );
                unset( $query->query_vars['term'] );

                unset( $query->query['taxonomy'] );
                unset( $query->query['term'] );
            }
        }


        foreach ( get_object_taxonomies( 'attachment','names' ) as $taxonomy ) {

            if ( ! isset( $_REQUEST['filter_action'] ) && isset( $_REQUEST[$taxonomy] ) ) {

                $term = get_term_by( 'slug', $_REQUEST[$taxonomy], $taxonomy );

                if ( $term ) {

                    $tax_query[] = array(
                        'taxonomy' => $taxonomy,
                        'field' => 'term_id',
                        'terms' => array( $term->term_id )
                    );

                    $query->query_vars[$taxonomy] = $term->term_id;
                    $query->query[$taxonomy] = $term->term_id;
                }
            }
            elseif ( $uncategorized ) {

                $terms = get_terms( $taxonomy, array('fields'=>'ids','get'=>'all') );

                $tax_query[] = array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $terms,
                    'operator' => 'NOT IN',
                );

                if ( isset( $query->query[$taxonomy] ) ) unset( $query->query[$taxonomy] );
                if ( isset( $query->query_vars[$taxonomy] ) ) unset( $query->query_vars[$taxonomy] );
            }
            else {

                if ( isset( $query->query[$taxonomy] ) && $query->query[$taxonomy] ) {

                    if ( is_numeric( $query->query[$taxonomy] ) ) {

                        $tax_query[] = array(
                            'taxonomy' => $taxonomy,
                            'field' => 'term_id',
                            'terms' => array( $query->query[$taxonomy] )
                        );
                    }
                    elseif ( 'not_in' === $query->query[$taxonomy] ) {

                        $terms = get_terms( $taxonomy, array('fields'=>'ids','get'=>'all') );

                        $tax_query[] = array(
                            'taxonomy' => $taxonomy,
                            'field' => 'term_id',
                            'terms' => $terms,
                            'operator' => 'NOT IN',
                        );
                    }
                    elseif ( 'in' === $query->query[$taxonomy] ) {

                        $terms = get_terms( $taxonomy, array('fields'=>'ids','get'=>'all') );

                        $tax_query[] = array(
                            'taxonomy' => $taxonomy,
                            'field' => 'term_id',
                            'terms' => $terms,
                            'operator' => 'IN',
                        );
                    }
                }
            }
        } // endforeach

        if ( ! empty( $tax_query ) ) {
            $query->tax_query = new WP_Tax_Query( $tax_query );
        }
    }
}



/**
 *  wpuxss_eml_attachment_fields_to_edit
 *
 *  Based on /wp-admin/includes/media.php
 *
 *  @since    1.0
 *  @created  14/08/13
 */

add_filter( 'attachment_fields_to_edit', 'wpuxss_eml_attachment_fields_to_edit', 10, 2 );

if ( ! function_exists( 'wpuxss_eml_attachment_fields_to_edit' ) ) {

    function wpuxss_eml_attachment_fields_to_edit( $form_fields, $post ) {

        $wpuxss_eml_tax_options = get_option('wpuxss_eml_tax_options');

        foreach( $form_fields as $field => $args ) {

            if ( isset( $args['hierarchical'] ) &&
                 function_exists( 'wp_terms_checklist' ) &&
                 ( (bool) $wpuxss_eml_tax_options['edit_all_as_hierarchical'] || (bool) $args['hierarchical'] ) ) {

                ob_start();

                    wp_terms_checklist( $post->ID, array( 'taxonomy' => $field, 'checked_ontop' => false, 'walker' => new Walker_Media_Taxonomy_Checklist() ) );

                    $content = ob_get_contents();

                    if ( $content )
                        $html = '<ul class="term-list">' . $content . '</ul>';
                    else
                        $html = '<ul class="term-list"><li>No ' . $args['label'] . ' found.</li></ul>';

                ob_end_clean();

                unset( $form_fields[$field]['value'] );

                $form_fields[$field]['input'] = 'html';
                $form_fields[$field]['html'] = $html;
            }
        }

        return $form_fields;
    }
}



/**
 *  Walker_Media_Taxonomy_Checklist
 *
 *  Based on /wp-includes/category-template.php
 *
 *  @since    1.0
 *  @created  09/09/13
 */

if( ! class_exists('Walker_Media_Taxonomy_Checklist') ) {

    class Walker_Media_Taxonomy_Checklist extends Walker {

        var $tree_type = 'category';
        var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

        function start_lvl( &$output, $depth = 0, $args = array() ) {

            $indent = str_repeat("\t", $depth);
            $output .= "$indent<ul class='children'>\n";
        }

        function end_lvl( &$output, $depth = 0, $args = array() ) {

            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }

        function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {

            extract($args);

            if ( empty($taxonomy) )
                $taxonomy = 'category';

            $class = in_array( $category->term_id, $popular_cats ) ? ' class="popular-category"' : '';
            $output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" . "<label class='selectit'><input value='0' type='hidden' name='tax_input[{$taxonomy}][{$category->term_id}]' /><input value='1' type='checkbox' name='tax_input[{$taxonomy}][{$category->term_id}]' id='in-{$taxonomy}-{$category->term_id}'" . checked( in_array( $category->term_id, $selected_cats ), true, false ) . disabled( empty( $args['disabled'] ), false, false ) . " />" . esc_html( apply_filters('the_category', $category->name )) . "</label>";
        }

        function end_el( &$output, $category, $depth = 0, $args = array() ) {

            $output .= "</li>\n";
        }
    }
}



/**
 *  Walker_Media_Taxonomy_Uploader_Filter
 *
 *  Based on /wp-includes/category-template.php
 *
 *  @since    1.0.1
 *  @created  05/11/13
 */

if( ! class_exists('Walker_Media_Taxonomy_Uploader_Filter') ) {

    class Walker_Media_Taxonomy_Uploader_Filter extends Walker {

        var $tree_type = 'category';
        var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

        function start_lvl( &$output, $depth = 0, $args = array() ) {

            $output .= "";
        }

        function end_lvl( &$output, $depth = 0, $args = array() ) {

            $output .= "";
        }

        function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {

            //extract($args);

            $indent = str_repeat('&nbsp;&nbsp;&nbsp;', $depth);

            $el = array(
                'term_id' => $category->term_id,
                'term_name' => $indent . esc_html( apply_filters( 'the_category', $category->name ) ) . '&nbsp;&nbsp;(' . $category->count . ')'
            );

            $output .= json_encode( $el );
        }

        function end_el( &$output, $category, $depth = 0, $args = array() ) {

                $output .= "";
        }
    }
}



/**
 *  wpuxss_eml_save_attachment_compat
 *
 *  Based on /wp-admin/includes/ajax-actions.php
 *
 *  @since    1.0.6
 *  @created  06/14/14
 */

add_action( 'wp_ajax_save-attachment-compat', 'wpuxss_eml_save_attachment_compat', 0 );

if ( ! function_exists( 'wpuxss_eml_save_attachment_compat' ) ) {

    function wpuxss_eml_save_attachment_compat() {

        if ( ! isset( $_REQUEST['id'] ) )
            wp_send_json_error();

        if ( ! $id = absint( $_REQUEST['id'] ) )
            wp_send_json_error();

        if ( empty( $_REQUEST['attachments'] ) || empty( $_REQUEST['attachments'][ $id ] ) )
            wp_send_json_error();


        $attachment_data = $_REQUEST['attachments'][ $id ];

        check_ajax_referer( 'update-post_' . $id, 'nonce' );

        if ( ! current_user_can( 'edit_post', $id ) )
            wp_send_json_error();

        $post = get_post( $id, ARRAY_A );

        if ( 'attachment' != $post['post_type'] )
            wp_send_json_error();

        /** This filter is documented in wp-admin/includes/media.php */
        $post = apply_filters( 'attachment_fields_to_save', $post, $attachment_data );

        if ( isset( $post['errors'] ) ) {

            $errors = $post['errors']; // @todo return me and display me!
            unset( $post['errors'] );
        }

        wp_update_post( $post );

        foreach ( get_attachment_taxonomies( $post ) as $taxonomy ) {

            if ( isset( $attachment_data[ $taxonomy ] ) ) {

                wp_set_object_terms( $id, array_map( 'trim', preg_split( '/,+/', $attachment_data[ $taxonomy ] ) ), $taxonomy, false );
            }
            elseif ( isset( $_REQUEST['tax_input'] ) && isset( $_REQUEST['tax_input'][ $taxonomy ] ) ) {

                $term_ids = array_keys( $_REQUEST['tax_input'][ $taxonomy ], 1 );
                $term_ids = array_map( 'intval', $term_ids );

                wp_set_object_terms( $id, $term_ids, $taxonomy, false );
            }
        }

        if ( ! $attachment = wp_prepare_attachment_for_js( $id ) )
            wp_send_json_error();

        wp_send_json_success( $attachment );
    }
}



/**
 *  wpuxss_eml_save_attachment_order
 *
 *  Based on /wp-admin/includes/ajax-actions.php
 *
 *  @since    2.2
 *  @created  11/02/16
 */

add_action( 'wp_ajax_save-attachment-order', 'wpuxss_eml_save_attachment_order', 0 );

if ( ! function_exists( 'wpuxss_eml_save_attachment_order' ) ) {

    function wpuxss_eml_save_attachment_order() {

        if ( ! isset( $_REQUEST['post_id'] ) )
            wp_send_json_error();

        if ( empty( $_REQUEST['attachments'] ) )
            wp_send_json_error();

        if ( $post_id = absint( $_REQUEST['post_id'] ) ) {

            check_ajax_referer( 'update-post_' . $post_id, 'nonce' );

            if ( ! current_user_can( 'edit_post', $post_id ) )
                wp_send_json_error();
        }
        else {
            check_ajax_referer( 'eml-bulk-edit-nonce', 'nonce' );
        }

        $attachments = $_REQUEST['attachments'];

        foreach ( $attachments as $attachment_id => $menu_order ) {

            if ( ! current_user_can( 'edit_post', $attachment_id ) )
                continue;
            if ( ! $attachment = get_post( $attachment_id ) )
                continue;
            if ( 'attachment' != $attachment->post_type )
                continue;

            wp_update_post( array( 'ID' => $attachment_id, 'menu_order' => $menu_order ) );
        }

        wp_send_json_success();
    }
}



/**
 *  wpuxss_eml_get_eml_taxonomies
 *
 *  @since    2.2
 *  @created  13/03/16
 */

if ( ! function_exists( 'wpuxss_eml_get_eml_taxonomies' ) ) {

    function wpuxss_eml_get_eml_taxonomies() {

        $wpuxss_eml_taxonomies = get_option( 'wpuxss_eml_taxonomies', array() );
        $return = array_filter( $wpuxss_eml_taxonomies, 'wpuxss_eml_filter_by_eml_taxonomies' );

        return $return;
    }
}



/**
 *  wpuxss_eml_filter_by_eml_taxonomies
 *
 *  @since    2.2
 *  @created  13/03/16
 */

if ( ! function_exists( 'wpuxss_eml_filter_by_eml_taxonomies' ) ) {

    function wpuxss_eml_filter_by_eml_taxonomies( $taxonomy ) {

        return $taxonomy['eml_media'];
    }
}



// TODO: Quick Edit for the List mode (MediaFrame.EditAttachments)
// add_filter( 'media_row_actions', 'wpuxss_eml_media_row_actions', 10, 2 );
//
// if ( ! function_exists( 'wpuxss_eml_media_row_actions' ) ) {
//
//     function wpuxss_eml_media_row_actions( $actions, $post ) {
//
//         $first = array_splice ( $actions, 0, 1 );
//         $actions = array_merge ( $first, array( 'eml_quick_edit' => '<a href="#" data-attachment-id="' . $post->ID . '">Quick Edit</a>' ), $actions );
//
//         return $actions;
//     }
// }



/**
 *  wpuxss_eml_pre_get_posts
 *
 *  Taxonomy archive specific query (front-end)
 *
 *  @since    1.0
 *  @created  03/08/13
 */

add_action( 'pre_get_posts', 'wpuxss_eml_pre_get_posts', 99 );

if ( ! function_exists('wpuxss_eml_pre_get_posts') ) {

    function wpuxss_eml_pre_get_posts( $query ) {

        global $current_screen;

        if ( ! is_admin() && $query->is_main_query() ) {

            $wpuxss_eml_tax_options = get_option('wpuxss_eml_tax_options');

            if ( $wpuxss_eml_tax_options['tax_archives'] ) {

                $wpuxss_eml_taxonomies = get_option('wpuxss_eml_taxonomies');

                foreach ( (array) $wpuxss_eml_taxonomies as $taxonomy => $params ) {

                    if ( $params['assigned'] && $params['eml_media'] && is_tax( $taxonomy ) ) {

                        $query->set( 'post_type', 'attachment' );
                        $query->set( 'post_status', 'inherit' );
                    }
                }
            }
        }

        if ( is_admin() && $query->is_main_query() &&  'attachment' === $query->get('post_type') ) {

            $media_library_mode = get_user_option( 'media_library_mode'  ) ? get_user_option( 'media_library_mode'  ) : 'grid';
            $wpuxss_eml_lib_options = get_option('wpuxss_eml_lib_options');

            $query_orderby = $query->get('orderby');
            $query_order = $query->get('order');

            if ( isset( $current_screen ) && 'upload' === $current_screen->base && 'list' === $media_library_mode && empty( $query_orderby ) && empty( $query_order ) ) {

                $orderby = ( 'menuOrder' === $wpuxss_eml_lib_options['media_orderby'] ) ? 'menu_order' : $wpuxss_eml_lib_options['media_orderby'];
                $order = $wpuxss_eml_lib_options['media_order'];

                $query->set('orderby', $orderby );
                $query->set('order', $order );
            }
        }
    }
}

?>
