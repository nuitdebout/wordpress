window.wp = window.wp || {};
window.eml = window.eml || { l10n: {} };


( function( $, _ ) {

    var media = wp.media,
        l10n = media.view.l10n,
        original = {};



    _.extend( eml.l10n, wpuxss_eml_media_views_l10n );



    /**
     * wp.media.controller.Library
     *
     */
    original.controllerLibrary = {

        activate: media.controller.Library.prototype.activate
    };

    _.extend( media.controller.Library.prototype, {

        activate: function() {

            original.controllerLibrary.activate.apply( this, arguments );

            wp.Uploader.queue.on( 'reset', this.afterUpload, this );
    	},

        afterUpload: function() {

            var library = this.get( 'library' ),
                selection = this.get( 'selection' ),
                orderby = library.props.get( 'orderby' );

            if ( 'menuOrder' === orderby ) {
                library.saveMenuOrder();
            }

            library.reset( library.models );

            if ( selection.model.length ) {
                selection.trigger( 'selection:unsingle', selection.model, selection );
                selection.trigger( 'selection:single', selection.model, selection );
            }
        },

        uploading: function( attachment ) {

    		var content = this.frame.content,
                selection = this.get( 'selection' ),
                library = this.get( 'library' );


    		if ( 'upload' === content.mode() ) {
    			this.frame.content.mode('browse');
    		}

            if ( wp.Uploader.queue.length == 1 ) {
                $('.attachment-filters:has(option[value!="all"]:selected)').val( 'all' ).change();
            }

            if ( this.get( 'autoSelect' ) ) {

                if ( wp.Uploader.queue.length == 1 && selection.length ) {
                    selection.reset();
                }
                selection.add( attachment );
                selection.trigger( 'selection:unsingle', selection.model, selection );
                selection.trigger( 'selection:single', selection.model, selection );
    		}
    	}
    });



    /**
     * wp.media.view.AttachmentCompat
     *
     */
    var newAttachmentCompatEvents = {
        'click input'  : 'preSave'
    };

    _.extend( media.view.AttachmentCompat.prototype.events, newAttachmentCompatEvents );

    _.extend( media.view.AttachmentCompat.prototype, {

        preSave: function() {

            this.noRender = true;

            media.model.Query.cleanQueries();
        },

        render: function() {

            var compat = this.model.get('compat'),
                $compat_el = this.$el;

            if ( ! compat || ! compat.item ) {
                return;
            }

            if ( this.noRender ) {
                return this;
            }

            this.views.detach();
            this.$el.html( compat.item );
            this.views.render();


            // TODO: find a better solution
            if ( this.controller.isModeActive( 'select' ) && 'edit-attachment' != this.controller.state().get('id') ) {

                $.each( eml.l10n.compat_taxonomies_to_hide, function( id, taxonomy ) {
                    $compat_el.find( '.compat-field-'+taxonomy ).remove();
                });
            }


            // TODO: find a better solution
            $.each( eml.l10n.compat_taxonomies, function( id, taxonomy ) {

                $compat_el.find( '.compat-field-'+taxonomy+' .label' ).addClass( 'eml-tax-label' );
                $compat_el.find( '.compat-field-'+taxonomy+' .field' ).addClass( 'eml-tax-field' );
            });

            return this;
        }
    });



    /**
     * wp.media.view.AttachmentFilters
     *
     */
    _.extend( media.view.AttachmentFilters.prototype, {

        change: function() {

            var filter = this.filters[ this.el.value ],
                selection = this.controller.state().get( 'selection' ),
                resetFilterButton = this.controller.content.get().toolbar.get( 'resetFilterButton' ),

                all = $('.attachment-filters').length,
                unchanged = $('.attachment-filters').map(function(){
                    return this.value
                }).get().filter( function( val ){
                    return 'all' === val
                }).length;


            if ( filter ) {
                this.model.set( filter.props );
            }


            if ( filter && selection && selection.length && wp.Uploader.queue.length !== 1 ) {
                selection.reset();
            }

            if ( _.isUndefined( resetFilterButton ) ) {
                return;
            }

            resetFilterButton.model.set( 'disabled', all === unchanged );
        },

        select: function() {

    		var model = this.model,
    			value = 'all',
    			props = model.toJSON();


            props = _.omit( props, 'orderby', 'order' );

    		_.find( this.filters, function( filter, id ) {

                var filterProps = _.omit( filter.props, 'orderby', 'order' );

    			var equal = _.all( filterProps, function( prop, key ) {
    				return prop === ( _.isUndefined( props[ key ] ) ? null : props[ key ] );
    			});

    			if ( equal ) {
    				return value = id;
    			}
    		});

    		this.$el.val( value );
    	}
    });




    /**
     * wp.media.view.AttachmentFilters
     *
     */
    original.AttachmentFilters = {

        All: {
            createFilters: media.view.AttachmentFilters.All.prototype.createFilters
        },

        Uploaded: {
            createFilters: media.view.AttachmentFilters.Uploaded.prototype.createFilters
        }
    };



    /**
     * wp.media.view.AttachmentFilters.All
     *
     */
    _.extend( media.view.AttachmentFilters.All.prototype, {

        createFilters: function() {

            var uncategorizedProps,
                taxonomies = _.keys( eml.l10n.taxonomies );


            original.AttachmentFilters.All.createFilters.apply( this, arguments );

            _.each( this.filters, function( filter, key ) {
                filter.props['uncategorized'] = null;
                filter.props['orderby'] = eml.l10n.media_orderby;
                filter.props['order'] = eml.l10n.media_order;
            });

            this.filters.uncategorized = {
                text:  eml.l10n.uncategorized,
                props: {
                    uploadedTo    : null,
                    uncategorized : true,
                    status        : null,
                    type          : null,
                    orderby       : eml.l10n.media_orderby,
                    order         : eml.l10n.media_order
                },
                priority: 60
            };


            uncategorizedProps = this.filters.uncategorized.props;

            _.each( taxonomies, function( taxonomy ) {
                uncategorizedProps[taxonomy] = null;
            });
        }
    });



    /**
     * wp.media.view.AttachmentFilters.Uploaded
     *
     */
    _.extend( media.view.AttachmentFilters.Uploaded.prototype, {

        createFilters: function() {

            var uncategorizedProps,
                taxonomies = _.keys( eml.l10n.taxonomies );


            original.AttachmentFilters.Uploaded.createFilters.apply( this, arguments );

            _.each( this.filters, function( filter, key ) {
                filter.props['orderby'] = eml.l10n.media_orderby;
                filter.props['order'] = eml.l10n.media_order;
            });
        }
    });



    /**
     * wp.media.view.AttachmentFilters.Taxonomy
     *
     */
    media.view.AttachmentFilters.Taxonomy = media.view.AttachmentFilters.extend({

        id: function() {

            return 'media-attachment-'+this.options.taxonomy+'-filters';
        },

        className: function() {

            // TODO: get rid of excess class name that duplicates id
            return 'attachment-filters eml-taxonomy-filters attachment-'+this.options.taxonomy+'-filter';
        },

        createFilters: function() {

            var filters = {},
                self = this;


            _.each( self.options.termList || {}, function( term, key ) {

                var term_id = term['term_id'],
                    term_name = $("<div/>").html(term['term_name']).text();

                filters[ term_id ] = {
                    text: term_name,
                    props: {
                        uncategorized : null,
                        orderby       : eml.l10n.media_orderby,
                        order         : eml.l10n.media_order
                    },
                    priority: key+4
                };

                filters[term_id]['props'][self.options.taxonomy] = term_id;
            });

            filters.all = {
                text: eml.l10n.filter_by + self.options.singularName,
                props: {
                    uncategorized : null,
                    orderby       : eml.l10n.media_orderby,
                    order         : eml.l10n.media_order
                },
                priority: 1
            };

            filters['all']['props'][self.options.taxonomy] = null;

            filters.in = {
                text: '&#8212; ' + eml.l10n.in + self.options.pluralName + ' &#8212;',
                props: {
                    uncategorized : null,
                    orderby       : eml.l10n.media_orderby,
                    order         : eml.l10n.media_order
                },
                priority: 2
            };

            filters['in']['props'][self.options.taxonomy] = 'in';

            filters.not_in = {
                text: '&#8212; ' + eml.l10n.not_in + self.options.singularName + ' &#8212;',
                props: {
                    uncategorized : null,
                    orderby       : eml.l10n.media_orderby,
                    order         : eml.l10n.media_order
                },
                priority: 3
            };

            filters['not_in']['props'][self.options.taxonomy] = 'not_in';

            this.filters = filters;
        }
    });



    media.view.Button.resetFilters = media.view.Button.extend({

        id: 'reset-all-filters',

        initialize: function() {

            media.view.Button.prototype.initialize.apply( this, arguments );
            this.controller.on( 'select:activate select:deactivate', this.toogleResetFilters, this );
        },

        click: function( event ) {

            if ( '#' === this.attributes.href ) {
				event.preventDefault();
			}

            $('.attachment-filters:has(option[value!="all"]:selected)').each( function( index ) {
                $(this).val( 'all' ).change();
            });
		},

        toogleResetFilters: function() {
            this.$el.toggleClass( 'hidden' );
        }
    });



    /**
     * wp.media.view.AttachmentsBrowser
     *
     */
    original.AttachmentsBrowser = {

        initialize: media.view.AttachmentsBrowser.prototype.initialize,
        createToolbar: media.view.AttachmentsBrowser.prototype.createToolbar,
    };

    _.extend( media.view.AttachmentsBrowser.prototype, {

        initialize: function() {

            original.AttachmentsBrowser.initialize.apply( this, arguments );

            this.on( 'ready', this.fixLayout, this );
        },

        fixLayout: function() {

            var $browser = this.$el,
                $attachments = $browser.find('.attachments'),
                $uploader = $browser.find('.uploader-inline'),
                $toolbar = $browser.find('.media-toolbar'),
                $messages = $('.eml-media-css .updated:visible, .eml-media-css .error:visible');


            if ( ! this.controller.isModeActive( 'select' ) &&
                 ! this.controller.isModeActive( 'eml-grid' ) ) {
                return;
            }

            if ( this.controller.isModeActive( 'select' ) ) {

                $attachments.css( 'top', $toolbar.height() + 10 + 'px' );
                $uploader.css( 'top', $toolbar.height() + 10 + 'px' );
                $browser.find('.eml-loader').css( 'top', $toolbar.height() + 10 + 'px' );

                // TODO: find a better place for it, something like fixLayoutOnce
                $toolbar.find('.media-toolbar-secondary').prepend( $toolbar.find('.instructions') );
            }

            if ( this.controller.isModeActive( 'eml-grid' ) )
            {
                var messagesOuterHeight = 0;

                if ( ! _.isUndefined( $messages ) )
                {
                    $messages.each( function() {
                        messagesOuterHeight += $(this).outerHeight( true );
                    });

                    messagesOuterHeight = messagesOuterHeight ? messagesOuterHeight - 20 : 0;
                }

                $browser.css( 'top', $toolbar.outerHeight() + messagesOuterHeight + 20 + 'px' );
                $toolbar.css( 'top', - $toolbar.outerHeight() - 30 + 'px' );
            }
        },

        createToolbar: function() {

            var filters = this.options.filters,
                self = this,
                i = 1;


            original.AttachmentsBrowser.createToolbar.apply( this, arguments );


            if ( -1 !== $.inArray( this.options.filters, [ 'uploaded', 'all' ] ) ||
               ( parseInt( eml.l10n.force_filters ) &&
               'gallery-edit' !== this.controller._state &&
               'playlist-edit' !== this.controller._state &&
               'video-playlist-edit' !== this.controller._state ) ||
               'customize' === eml.l10n.current_screen ) {


                this.toolbar.set( 'filtersLabel', new media.view.Label({
                    value: l10n.filterByType,
                    attributes: {
                        'for':  'media-attachment-filters'
                    },
                    priority:   -80
                }).render() );

                if ( 'uploaded' === this.options.filters ) {
                    this.toolbar.set( 'filters', new media.view.AttachmentFilters.Uploaded({
                        controller: this.controller,
                        model:      this.collection.props,
                        priority:   -80
                    }).render() );
                } else {
                    Filters = new media.view.AttachmentFilters.All({
                        controller: this.controller,
                        model:      this.collection.props,
                        priority:   -80
                    });

                    this.toolbar.set( 'filters', Filters.render() );
                }

                if ( eml.l10n.wp_version >= '4.0' )
                {
                    this.toolbar.set( 'dateFilterLabel', new media.view.Label({
                        value: l10n.filterByDate,
                        attributes: {
                            'for': 'media-attachment-date-filters'
                        },
                        priority: -75
                    }).render() );
                    this.toolbar.set( 'dateFilter', new media.view.DateFilter({
                        controller: this.controller,
                        model:      this.collection.props,
                        priority: -75
                    }).render() );
                }


                $.each( eml.l10n.taxonomies, function( taxonomy, values ) {

                    if ( values.term_list ) {

                        self.toolbar.set( taxonomy+'FilterLabel', new media.view.Label({
                            value: eml.l10n.filter_by + values.singular_name,
                            attributes: {
                                'for':  'media-attachment-' + taxonomy + '-filters',
                            },
                            priority: -70 + i++
                        }).render() );
                        self.toolbar.set( taxonomy+'-filter', new media.view.AttachmentFilters.Taxonomy({
                            controller: self.controller,
                            model: self.collection.props,
                            priority: -70 + i++,
                            taxonomy: taxonomy,
                            termList: values.term_list,
                            singularName: values.singular_name,
                            pluralName: values.plural_name
                        }).render() );
                    }
                });


                this.toolbar.set( 'resetFilterButton', new media.view.Button.resetFilters({
                    controller: this.controller,
                    text: eml.l10n.reset_filters,
                    disabled: true,
                    priority: -70 + i
                }).render() );

            } // endif
        }
    });



    /**
     * wp.media.view.DateFilter
     *
     * a copy from media-grid.js | for WP less than 4.1
     */
    if ( _.isUndefined( media.view.DateFilter ) ) {

        media.view.DateFilter = media.view.AttachmentFilters.extend({

            id: 'media-attachment-date-filters',

            createFilters: function() {
                var filters = {};
                _.each( media.view.settings.months || {}, function( value, index ) {
                    filters[ index ] = {
                        text: value.text,
                        props: {
                            year: value.year,
                            monthnum: value.month
                        }
                    };
                });
                filters.all = {
                    text:  l10n.allDates,
                    props: {
                        monthnum: false,
                        year:  false
                    },
                    priority: 10
                };
                this.filters = filters;
            }
        });
    }



    /**
     * wp.media.view.MediaFrame.Post
     *
     */
    original.MediaFrame = {

        Post: {
            activate: media.view.MediaFrame.Post.prototype.activate
        }
    };

    _.extend( media.view.MediaFrame.Post.prototype, {

        activate: function() {

            var content = this.content.get();

            original.MediaFrame.Post.activate.apply( this, arguments );

            this.on( 'open', content.fixLayout, content );
        }
    });



    // TODO: move to the PHP side
    $('body').addClass('eml-media-css');

})( jQuery, _ );
