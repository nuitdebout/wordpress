( function( $ ) {

    var orderValue;



    $( document ).ready( function() {

        orderValue = $('#wpuxss_eml_lib_options_media_order').val();
        $('#wpuxss_eml_lib_options_media_orderby').change();
    });



    $( document ).on( 'change', '#wpuxss_eml_lib_options_media_orderby', function( event ) {

        var isMenuOrder = 'menuOrder' === $( event.target ).val(),
            value;

        orderValue = isMenuOrder ? $('#wpuxss_eml_lib_options_media_order').val() : orderValue;
        value = isMenuOrder ? 'ASC' : orderValue;

        $('#wpuxss_eml_lib_options_media_order').prop( 'disabled', isMenuOrder ).val( value );
    });

})( jQuery );
