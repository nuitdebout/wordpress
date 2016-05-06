window.wp = window.wp || {};
window.eml = window.eml || { l10n: {} };



function emlIsFilterBased( attrs ) {

    if ( _.isUndefined( attrs ) || _.isEmpty( attrs ) ) {
        return false;
    }

    if ( attrs.uploadedTo ) {
        return true;
    }

    if ( _.filter( _.pick( attrs, 'monthnum', 'year' ), _.identity ).length == 2 ) {
        return true;
    }

    return _.some( eml.l10n.all_taxonomies, function( terms, taxonomy ) {
        return ( ! _.isUndefined( attrs[taxonomy] ) && ! _.isNull( attrs[taxonomy] ) );
    });
}



( function( $, _ ) {

    var media = wp.media,
        original = {};



    _.extend( eml.l10n, wpuxss_eml_enhanced_medialist_l10n );



    /**
     * wp.media.view.MediaFrame.Post
     *
     */
    original.MediaFrame = {

        Post: {
            galleryMenu: media.view.MediaFrame.Post.prototype.galleryMenu,
            playlistMenu: media.view.MediaFrame.Post.prototype.playlistMenu,
            videoPlaylistMenu: media.view.MediaFrame.Post.prototype.videoPlaylistMenu
        }
    };

    _.extend( media.view.MediaFrame.Post.prototype, {

        galleryMenu: function( view ) {

            original.MediaFrame.Post.galleryMenu.apply( this, arguments );

            var library = this.state().get('library'),
                isFilterBased = emlIsFilterBased( library.props.toJSON() );


            if ( isFilterBased ) {
                view.hide( 'gallery-library' );
            }
        },

        playlistMenu: function( view ) {

            original.MediaFrame.Post.playlistMenu.apply( this, arguments );

            var library = this.state().get('library'),
                isFilterBased = emlIsFilterBased( library.props.toJSON() );


            if ( isFilterBased ) {
                view.hide( 'playlist-library' );
            }
        },

        videoPlaylistMenu: function( view ) {

            original.MediaFrame.Post.playlistMenu.apply( this, arguments );

            var library = this.state().get('library'),
                isFilterBased = emlIsFilterBased( library.props.toJSON() );


            if ( isFilterBased ) {
                view.hide( 'video-playlist-library' );
            }
        }
    });



    /**
     * wp.media.view.Attachment.EditLibrary
     *
     */
    _.extend( media.view.Attachment.EditLibrary.prototype, {

        initialize: function() {

            var state = this.controller.state(),
                isFilterBased = emlIsFilterBased( state.get('library').props.toJSON() ),
                isMediaList = 'gallery-edit' === state.get('id') || 'playlist-edit' === state.get('id') || 'video-playlist-edit' === state.get('id');


            this.buttons.close = ( isMediaList && isFilterBased ) ? false : true;
        }
    });



    /**
     * wp.media.view.Settings
     *
     */
    original.Settings = {

        Gallery: {
            render: media.view.Settings.Gallery.prototype.render
        },
        Playlist: {
            render: media.view.Settings.Playlist.prototype.render
        }
    };



    /**
     * wp.media.view.Settings.Gallery
     *
     */
    _.extend( media.view.Settings.Gallery.prototype.events, {
        'change [data-setting=_orderbyRandom]' : 'change_orderbyRandom'
    });

    _.extend( media.view.Settings.Gallery.prototype, {

        render: function() {

            var library = this.controller.frame.state().get('library'),
                append = eml.basedOnHTML( library );


            original.Settings.Gallery.render.apply( this, arguments );

            if ( append ) {
                this.$el.append( append );
            }

            return this;
        },

        change_orderbyRandom: function( event ) {

            var content = this.controller.frame.content,
                reverse = content.get().toolbar.get( 'reverse' );

            reverse.model.set( 'disabled', $( event.target ).is(':checked') );
        }
    });



    /**
     * wp.media.view.Settings.Playlist
     *
     */
    _.extend( media.view.Settings.Playlist.prototype, {

        render: function() {

            var library = this.controller.frame.state().get('library'),
                append = eml.basedOnHTML( library );


            original.Settings.Playlist.render.apply( this, arguments );

            if ( append ) {
                this.$el.append( append );
            }

            return this;
        }
    });



    /**
     * eml.basedOnHTML
     *
     * output for:
     * wp.media.view.Settings.Gallery
     * wp.media.view.Settings.Playlist
     *
     */
    eml.basedOnHTML = function( library ) {

        var isFilterBased = emlIsFilterBased( library.props.toJSON() ),
            append = '',
            date,
            months = media.view.settings.months,
            monthnum = library.props.get( 'monthnum' ),
            year = library.props.get( 'year' ),
            uploadedTo = library.props.get( 'uploadedTo' );

        if ( isFilterBased ) {

            append = '<br class="clear" /><h3>' + eml.l10n.based_on + '</h3><label class="setting eml-filter-based"><ul class="eml-filter-based">';

            _.each( eml.l10n.all_taxonomies, function( attrs, taxonomy ) {

                var ids = library.props.get( taxonomy ),
                    taxonomy_string;

                if ( ids ) {

                    taxonomy_string = attrs.singular_name + ': ' + _.values( _.pick( attrs.terms, ids ) ).join(', ');
                    append += '<li>' + taxonomy_string + '</li>';
                }
            });

            if ( monthnum && year ) {
                date = _.first( _.where( months, { month: monthnum, year: year } ) ).text;
                append += '<li>' + date + '</li>';
            }

            if ( ! _.isUndefined( uploadedTo ) ) {

                if ( uploadedTo == media.view.settings.post.id ) {
                    append += '<li>' + media.view.l10n.uploadedToThisPost + '</li>';
                }
                else if ( parseInt( uploadedTo ) ) {
                    append += '<li>' + eml.l10n.uploaded_to + uploadedTo + '</li>';
                }
            }
            append += '</ul></label>';
        }

        return append;
    };



    /**
     * eml.renderSettings
     *
     * for:
     * wp.media.controller.GalleryEdit
     * wp.media.controller.CollectionEdit (Playlist)
     *
     */
    eml.renderSettings = function( browser, library, tag ) {

        var reverse = browser.toolbar.get( 'reverse' );


        reverse.model.set( 'disabled', 'rand' === library.props.get('orderby') );

        reverse.options.click = function() {

            order = library.props.get( 'order' );

            if ( 'ASC' === order ) {
                order = 'DESC';
            }
            else if ( 'DESC' === order ) {
                order = 'ASC';
            }

            library[ tag ].set( 'order', order );

            library.props.set( 'order', order, { silent: true } );
            library.reset( library.toArray().reverse() );
            library.saveMenuOrder();
        }
    };



    /**
     * wp.media.controller.GalleryEdit
     *
     */
    original.GalleryEdit = {

        gallerySettings: media.controller.GalleryEdit.prototype.gallerySettings
    };

    _.extend( media.controller.GalleryEdit.prototype, {

        gallerySettings: function( browser ) {

            var library = this.get('library');

            original.GalleryEdit.gallerySettings.apply( this, arguments );

            eml.renderSettings( browser, library, media.gallery.tag );
        }
    });



    /**
     * wp.media.controller.CollectionEdit
     *
     */
    original.CollectionEdit = {

        renderSettings: media.controller.CollectionEdit.prototype.renderSettings
    };

    _.extend( media.controller.CollectionEdit.prototype, {

        renderSettings: function( browser ) {

            var library = this.get('library');

            original.CollectionEdit.renderSettings.apply( this, arguments );

            eml.renderSettings( browser, library, media.playlist.tag );
        }
    });

})( jQuery, _ );
