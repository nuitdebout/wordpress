( function( $ ) {

    var l10n = wpuxss_eml_options_l10n_data;



    $( document ).on('click', '#eml-settings-cleanup', function( event ) {

        event.preventDefault();

        emlConfirmDialog( l10n.cleanup_warning_title, l10n.cleanup_warning_text_p1+l10n.cleanup_warning_text_p2, l10n.cleanup_warning_yes, l10n.cancel, 'button button-primary eml-warning-button' )
        .done( function() {

            emlFullscreenSpinnerStart( l10n.in_progress_cleanup_text );

            $('#eml-form-cleanup').submit();

        })
        .fail(function() {
            return false;
        });
    });

})( jQuery );
