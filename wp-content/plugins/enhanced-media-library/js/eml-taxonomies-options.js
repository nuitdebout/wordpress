( function( $ ) {

    var l10n = wpuxss_eml_taxonomies_options_l10n_data;



    // remove taxonomy
    $( document ).on( 'click', 'li .wpuxss-eml-button-remove', function() {

        var target = $(this).parent();

        if ( target.hasClass( 'wpuxss-eml-clone-taxonomy' ) ) {

            target.hide( 300, function() {
                $(this).remove();
            });
        }
        else {

            emlConfirmDialog( l10n.tax_deletion_confirm_title, l10n.tax_deletion_confirm_text_p1+l10n.tax_deletion_confirm_text_p2+l10n.tax_deletion_confirm_text_p3+l10n.tax_deletion_confirm_text_p4, l10n.tax_deletion_yes, l10n.cancel, 'button button-primary eml-warning-button' )
            .done( function() {

                target.hide( 300, function() {
                    $(this).remove();
                });
            })
            .fail(function() {
                return false;
            });
        }

        return false;
    });



    // create new taxonomy
    $(document).on( 'click', '.wpuxss-eml-button-create-taxonomy', function()
    {
        $('.wpuxss-eml-media-taxonomy-list').find('.wpuxss-eml-clone').clone().attr('class','wpuxss-eml-clone-taxonomy').appendTo('.wpuxss-eml-media-taxonomy-list').show(300);

        return false;
    });



    // edit taxonomy parameters
    $(document).on( 'click', '.wpuxss-eml-button-edit', function() {

        $(this).parent().find('.wpuxss-eml-taxonomy-edit').toggle(300);

        $(this).html(function(i, html)
        {
            return html == l10n.edit+' \u2193' ? l10n.close+' \u2191' : l10n.edit+' \u2193';
        });

        return false;
    });



    // on change of a singular taxonomy name during creation
    $(document).on( 'blur', '.wpuxss-eml-clone-taxonomy .wpuxss-eml-singular_name', function() {

        var dictionary,
            taxonomy_singular_name = $(this).val().replace(/(<([^>]+)>)/g,''),
            taxonomy_name = taxonomy_singular_name.toLowerCase(),
            taxonomy_edit_box = $(this).parents('.wpuxss-eml-taxonomy-edit'),
            built_in = [ 'link_category', 'post_format' ];


        if ( 'year' == taxonomy_name ) {
            taxonomy_name = 'media_year';
        }


        if ( '' !== taxonomy_name ) {

            // thanks to
            // https://github.com/borodean/jquery-translit
            // https://gist.github.com/richardsweeney/5317392
            // http://www.advancedcustomfields.com/
            // for the 'dictionary' code!
            dictionary = {
                'а': 'a',
                'б': 'b',
                'в': 'v',
                'г': 'g',
                'д': 'd',
                'е': 'e',
                'ё': 'e',
                'ж': 'zh',
                'з': 'z',
                'и': 'i',
                'й': 'i',
                'к': 'k',
                'л': 'l',
                'м': 'm',
                'н': 'n',
                'о': 'o',
                'п': 'p',
                'р': 'r',
                'с': 's',
                'т': 't',
                'у': 'u',
                'ф': 'f',
                'х': 'kh',
                'ц': 'tc',
                'ч': 'ch',
                'ш': 'sh',
                'щ': 'shch',
                'ъ': '',
                'ы': 'y',
                'ь': '',
                'э': 'e',
                'ю': 'iu',
                'я': 'ia',
                'ä': 'a',
                'æ': 'a',
                'å': 'a',
                'ö': 'o',
                'ø': 'o',
                'é': 'e',
                'ë': 'e',
                'ü': 'u',
                'ó': 'o',
                'ő': 'o',
                'ú': 'u',
                'é': 'e',
                'á': 'a',
                'ű': 'u',
                'í': 'i',
                ' ' : '_',
                '-' : '_',
                '\'' : '',
                '&' : '_'
            };

            $.each( dictionary, function(k, v) {

                var regex = new RegExp( k, 'g' );
                taxonomy_name = taxonomy_name.replace( regex, v );
            });

            taxonomy_name = taxonomy_name.replace(/[^a-z0-9_\s]/g, '');

            $(this).closest('.wpuxss-eml-clone-taxonomy').attr('id',taxonomy_name);


            if ( $('.wpuxss-eml-clone-taxonomy[id='+taxonomy_name+'], .wpuxss-eml-taxonomy[id='+taxonomy_name+'], .wpuxss-non-eml-taxonomy[id='+taxonomy_name+']').length > 1 || -1 !== $.inArray( taxonomy_name, built_in ) ) {
                emlAlertDialog( l10n.tax_error_duplicate_title, l10n.tax_error_duplicate_text, l10n.okay, 'button button-primary' )
                .done( function() {
                    return false;
                });
            }

            $(this).attr('name','wpuxss_eml_taxonomies['+taxonomy_name+'][labels][singular_name]');

            $(this).closest('.wpuxss-eml-clone-taxonomy').find('.wpuxss-eml-assigned').attr('name','wpuxss_eml_taxonomies['+taxonomy_name+'][assigned]');
            $(this).closest('.wpuxss-eml-clone-taxonomy').find('.wpuxss-eml-eml_media').attr('name','wpuxss_eml_taxonomies['+taxonomy_name+'][eml_media]');
            $(this).closest('.wpuxss-eml-clone-taxonomy').find('.wpuxss-eml-create_taxonomy').attr('name','wpuxss_eml_taxonomies['+taxonomy_name+'][create_taxonomy]');

            addTaxonomyName( taxonomy_edit_box, taxonomy_name );
            taxonomy_edit_box.find('.wpuxss-eml-taxonomy-name').val( taxonomy_name );
        }

        taxonomy_edit_box.find('.wpuxss-eml-slug').val(taxonomy_name);

        changeSingularLabels( taxonomy_edit_box, taxonomy_singular_name );
    });

    $(document).on( 'blur', '.wpuxss-eml-taxonomy .wpuxss-eml-singular_name', function() {

        changeSingularLabels( $(this).parents('.wpuxss-eml-taxonomy-edit'), $(this).val() );
    });

    function addTaxonomyName( edit_box, taxonomy_name ) {

        var fields = {
                'labels' : [ 'name', 'menu_name', 'all_items', 'edit_item', 'view_item', 'update_item', 'add_new_item', 'new_item_name', 'parent_item', 'search_items' ],
                'hierarchical' : 'hierarchical',
                'show_admin_column' : 'show_admin_column',
                'admin_filter' : 'admin_filter',
                'media_uploader_filter' : 'media_uploader_filter',
                'media_popup_taxonomy_edit' : 'media_popup_taxonomy_edit',
                'show_in_nav_menus' : 'show_in_nav_menus',
                'sort' : 'sort',
                'show_in_rest' : 'show_in_rest',
                'rewrite' : [ 'slug', 'with_front' ]
            };

        $.each( fields, function( index, field ) {

            if ( index === field ) {
                edit_box.find('.wpuxss-eml-'+field).attr('name','wpuxss_eml_taxonomies['+taxonomy_name+']['+field+']');
            }
            else {
                $.each( field, function( i, field ) {
                    edit_box.find('.wpuxss-eml-'+field).attr('name','wpuxss_eml_taxonomies['+taxonomy_name+']['+index+']['+field+']');
                });
            }
        });
    }

    function changeSingularLabels( edit_box, singular_name ) {

        if ( '' !== singular_name ) {

            edit_box.find('.wpuxss-eml-edit_item').val( l10n.edit+' '+singular_name );
            edit_box.find('.wpuxss-eml-view_item').val( l10n.view+' '+singular_name );
            edit_box.find('.wpuxss-eml-update_item').val( l10n.update+' '+singular_name );
            edit_box.find('.wpuxss-eml-add_new_item').val( l10n.add_new+' '+singular_name );
            edit_box.find('.wpuxss-eml-new_item_name').val( l10n.new+' '+singular_name );
            edit_box.find('.wpuxss-eml-parent_item').val( l10n.parent+' '+singular_name );
        }
        else {

            edit_box.find('.wpuxss-eml-edit_item').val('');
            edit_box.find('.wpuxss-eml-view_item').val('');
            edit_box.find('.wpuxss-eml-update_item').val('');
            edit_box.find('.wpuxss-eml-add_new_item').val('');
            edit_box.find('.wpuxss-eml-new_item_name').val('');
            edit_box.find('.wpuxss-eml-parent_item').val('');
        }
    }



    // on change of a plural taxonomy name during creation
    $(document).on( 'blur', '.wpuxss-eml-clone-taxonomy .wpuxss-eml-name, .wpuxss-eml-taxonomy .wpuxss-eml-name', function()
    {
        var taxonomy_plural_name = $(this).val().replace(/(<([^>]+)>)/g,''),
            taxonomy_edit_box = $(this).parents('.wpuxss-eml-taxonomy-edit'),
            main_tax_label = $(this).closest('.wpuxss-eml-clone-taxonomy').find('.wpuxss-eml-taxonomy-label span');


        if ( '' !== taxonomy_plural_name ) {

            taxonomy_edit_box.find('.wpuxss-eml-menu_name').val( taxonomy_plural_name );
            taxonomy_edit_box.find('.wpuxss-eml-all_items').val( l10n.all+' '+taxonomy_plural_name );
            taxonomy_edit_box.find('.wpuxss-eml-search_items').val( l10n.search+' '+taxonomy_plural_name );
            main_tax_label.text( taxonomy_plural_name );
        }
        else {

            taxonomy_edit_box.find('.wpuxss-eml-menu_name').val('');
            taxonomy_edit_box.find('.wpuxss-eml-all_items').val('');
            taxonomy_edit_box.find('.wpuxss-eml-search_items').val('');
            main_tax_label.text( l10n.tax_new );
        }
    });



    // on taxonomy form submit
    $('#wpuxss-eml-form-taxonomies').submit(function( event ) {

        var built_in = [ 'link_category', 'post_format' ];


        submit_it = true;
        alert_title = l10n.tax_error_empty_fileds_title;
        alert_text = '';

        $('.wpuxss-eml-clone-taxonomy, .wpuxss-eml-taxonomy').each(function( index )
        {
            current_taxonomy = $(this).attr('id');

            if ( ! $('.wpuxss-eml-singular_name',this).val() && ! $('.wpuxss-eml-name',this).val() )
            {
                submit_it = false;
                alert_text = l10n.tax_error_empty_both;
            }
            else if ( ! $('.wpuxss-eml-singular_name',this).val() )
            {
                submit_it = false;
                alert_text = l10n.tax_error_empty_singular;
            }
            else if ( ! $('.wpuxss-eml-name',this).val() )
            {
                submit_it = false;
                alert_text = l10n.tax_error_empty_plural;
            }
            else if ( $('.wpuxss-eml-clone-taxonomy[id='+current_taxonomy+'], .wpuxss-eml-taxonomy[id='+current_taxonomy+'], .wpuxss-non-eml-taxonomy[id='+current_taxonomy+']').length > 1 || -1 !== $.inArray( current_taxonomy, built_in ) )
            {
                submit_it = false;
                alert_title = l10n.tax_error_duplicate_title;
                alert_text = l10n.tax_error_duplicate_text;
            }
        });


        if ( ! submit_it ) {
            emlAlertDialog( alert_title, alert_text, l10n.okay, 'button button-primary' )
            .done( function() {
                return false;
            });
        }

        return submit_it;
    });



    // synchronize parent terms to media items (PRO)
    $( document ).on( 'click', '.eml-button-synchronize-terms', function( event ) {

        var $el, post_type, taxonomy;


        emlConfirmDialog( l10n.sync_warning_title, l10n.sync_warning_text, l10n.sync_warning_yes, l10n.sync_warning_no, 'button button-primary' )
        .done( function() {

            $el = $( event.target );

            post_type = $el.attr( 'data-post-type' );
            taxonomy = $el.attr( 'data-taxonomy' );

            emlFullscreenSpinnerStart( l10n.in_progress_sync_text );

            $.post( ajaxurl, {
                nonce: l10n.bulk_edit_nonce,
                action: 'eml-synchronize-terms',
                post_type: post_type,
                taxonomy: taxonomy
            },function( response ) {
                emlFullscreenSpinnerStop();
    		});
        })
        .fail(function() {
            return;
        });
    });

})( jQuery );
