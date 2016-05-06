( function( $ ) {

    var l10n = wpuxss_eml_media_list_l10n;



    $( document ).ready( function() {
        
        var $mainFilter = $('select[name="attachment-filter"]'),
            $dataFilter = $('select#filter-by-date'),
            $taxFilters = $('select.eml-taxonomy-filters'),
            $resetFilters,
            $_GET = $.parseJSON( l10n.$_GET );


        // Add "All Uncategorized" option
        $mainFilter.append('<option value="uncategorized">'+l10n.uncategorized+'</option>');

        // Add "Reset All Filters" button
        $('#post-query-submit').after('<input type="submit" name="filter_action" id="eml-reset-filters-query-submit" class="button" value="'+l10n.reset_all_filters+'">');
        $resetFilters = $('#eml-reset-filters-query-submit');

        if ( 'uncategorized' == $_GET['attachment-filter'] ) {
            $mainFilter.val("uncategorized");
        }


        if ( ! $mainFilter.prop( 'selectedIndex' ) &&
             ! $dataFilter.prop( 'selectedIndex' ) &&
             ! $taxFilters.filter( function() { return $(this).prop( 'selectedIndex' ) } ).get().length )
        {
            $resetFilters.prop( 'disabled', true );
        }
        else
        {
            $resetFilters.prop( 'disabled', false );
        }



        $( document ).on( 'change', 'select[name="attachment-filter"]', {
            checkFilter : $mainFilter,
            resetFilter : $taxFilters
        }, resetFilters );

        $( document ).on( 'change', 'select.eml-taxonomy-filters', {
            checkFilter : $mainFilter,
            resetFilter : $mainFilter
        }, resetFilters );

        $( document ).on( 'click', '#eml-reset-filters-query-submit', function() {

            $mainFilter.prop( 'selectedIndex', 0 );
            $taxFilters.prop( 'selectedIndex', 0 );
            $dataFilter.prop( 'selectedIndex', 0 );
        });

    });

    function resetFilters( event )
    {
        if ( 'uncategorized' == event.data.checkFilter.val() )
        {
            event.data.resetFilter.prop( 'selectedIndex', 0 );
        }
    }

})( jQuery );
