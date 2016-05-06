( function( $ ) {

    var w;


    if ( $(window).width() < 600 )
        w = '90%';
    else if ( $(window).width() > 1024 )
        w = '500';
    else
        w = '50%';


    window.emlConfirmDialog = function( title, html, yes, no, yesClass ) {

        var def = $.Deferred(),

            confirmdialog = $('<div id="dialog-modal"></div>').appendTo('body')
            .html( html )
            .dialog({
                modal     : true,
                resizable : false,
                width     : w,
                autoOpen  : false,
                title     : title,
                buttons   : [
                    {
                        'text'  : yes,
                        'class' : yesClass,
                        'click' : function() {
                            $(this).dialog( 'close' );
                            def.resolve();
                        }
                    },
                    {
                        'text'  : no,
                        'click': function() {
                            $(this).dialog( 'close' );
                            def.reject();
                        }
                    }
                ],
                close: function() {
                    $(this).remove();
                }
            });

        confirmdialog.dialog('open');

        return def.promise();
    }


    window.emlAlertDialog = function( title, html, yes, yesClass ) {

        var def = $.Deferred(),

            alertdialog = $('<div id="dialog-modal"></div>').appendTo('body')
            .html( html )
            .dialog({
                modal     : true,
                resizable : false,
                width     : w,
                autoOpen  : false,
                title     : title,
                buttons   : [
                    {
                        'text'  : yes,
                        'class' : yesClass,
                        'click' : function() {
                            $(this).dialog( 'close' );
                            def.resolve();
                        }
                    }
                ],
                close: function() {
                    $(this).remove();
                }
            });

        alertdialog.dialog('open');

        return def.promise();
    }


    window.emlFullscreenSpinnerStart = function( text ) {
        $('body').append( '<div class="fullscreen-spinner-box"><div class="fullscreen-spinner-inner-box"><span class="eml-spinner">'+text+'</span></div></div>' );
    }


    window.emlFullscreenSpinnerStop = function( text ) {
        $('.fullscreen-spinner-box').remove();
    }

})( jQuery );
