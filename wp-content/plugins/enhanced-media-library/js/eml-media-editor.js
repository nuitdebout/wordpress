window.wp = window.wp || {};
window.eml = window.eml || { l10n: {} };



( function( $, _ ) {

    var media = wp.media,
        l10n = media.view.l10n;



    /**
     * eml.mediaCollection
     *
     */
    eml.mediaCollection = {

        collections: {},

        attachments: function( shortcode ) {

            var collections = this.collections,
                shortcodeString = shortcode.string(),
                result = collections[ shortcodeString ],
                attrs, args, query, others, self = this,
                isFilterBased = emlIsFilterBased( shortcode.attrs.named );


            delete collections[ shortcodeString ];


            if ( result && ! isFilterBased && _.isUndefined( shortcode.attrs.named.limit ) ) {
                return result;
            }

            // Fill the default shortcode attributes.
            attrs = _.defaults( shortcode.attrs.named, this.defaults );
            args  = _.pick( attrs, 'orderby', 'order' );

            if ( ! attrs.limit || _.isNaN( parseInt( attrs.limit, 10 ) ) || parseInt( attrs.limit, 10 ) < 1 ) {
                delete attrs.limit;
            }
            else {
                attrs.limit = parseInt( attrs.limit, 10 );
            }

            args.type = this.type;
            args.perPage = attrs.limit || -1;


            if ( 'rand' === attrs.orderby ) {
                attrs._orderbyRandom = true;
            }

            if ( 'post_date' === attrs.orderby ) {
                args.orderby = 'date';
            }

            // Map the `orderby` attribute to the corresponding model property.
            if ( ! attrs.orderby || /^menu_order(?: ID)?$/i.test( attrs.orderby ) ) {
                args.orderby = 'menuOrder';
            }

            if ( 'menuOrder' === args.orderby ) {
                args.order = 'ASC';
            }

            if ( _.isUndefined( attrs.id )  && ! isFilterBased ) {
                attrs.id = media.view.settings.post && media.view.settings.post.id;
            }

            if ( isFilterBased ) {

                if ( attrs.id ) {
                    args.uploadedTo = attrs.id;
                }

                _.each( eml.l10n.all_taxonomies, function( terms, taxonomy ) {

                    if ( attrs[taxonomy] ) {

                        if ( _.isArray( attrs[taxonomy] ) ) {
                            args[taxonomy] = attrs[taxonomy];
                        }
                        else {
                            args[taxonomy] = attrs[taxonomy].split(',');
                        }
                    }
                });

                if ( attrs.monthnum && attrs.year ) {
                    args.monthnum = attrs.monthnum;
                    args.year = attrs.year;
                }
            }
            else {

                if ( attrs.ids ) {

                    args.post__in = attrs.ids.split(',');

                    if ( 'menuOrder' === args.orderby ) {
                        args.orderby = 'post__in';
                    }
                }
                else if ( attrs.include ) {
                    args.post__in = attrs.include.split(',');
                }

                if ( attrs.exclude ) {
                    args.post__not_in = attrs.exclude.split(',');
                }

                if ( ! args.post__in ) {
                    args.uploadedTo = attrs.id;
                }
            }


            // Collect the attributes that were not included in `args`.
            others = _.omit( attrs, 'id', 'ids', 'include', 'exclude' );

            _.each( this.defaults, function( value, key ) {
                others[ key ] = self.coerce( others, key );
            });

            media.model.Query.cleanQueries();

            query = wp.media.query( args );
            query[ this.tag ] = new Backbone.Model( others );

            return query;
        },

        shortcode: function( attachments ) {

            var collections = this.collections,
                props = attachments.props.toJSON(),
                attrs = _.pick( props, 'orderby', 'order' ),
                shortcode, clone,
                isFilterBased = emlIsFilterBased( props );


            if ( attachments.type ) {
                attrs.type = attachments.type;
                delete attachments.type;
            }

            if ( attachments[this.tag] ) {
                _.extend( attrs, attachments[this.tag].toJSON() );
            }

            if ( ! isFilterBased ) {
                // Convert all gallery shortcodes to use the `ids` property.
                // Ignore `post__in` and `post__not_in`; the attachments in
                // the collection will already reflect those properties.
                attrs.ids = attachments.pluck('id');
            }

            // Copy the `uploadedTo` post ID.
            if ( props.uploadedTo ) {
                attrs.id = props.uploadedTo;
            }

            if ( undefined !== attrs._orderbyRandom ) {

                if ( attrs._orderbyRandom ) {
                    attrs.orderby = 'rand';
                } else {
                    delete attrs.orderby;
                }
                delete attrs._orderbyRandom;
            }


            _.each( eml.l10n.all_taxonomies, function( terms, taxonomy ) {

                if ( props[taxonomy] ) {
                    attrs[taxonomy] = props[taxonomy];
                }
            });


            if ( props.monthnum && props.year ) {
                attrs.monthnum = props.monthnum;
                attrs.year = props.year;
            }

            if ( 'rand' === attrs.orderby || 'menuOrder' === attrs.orderby ) {
                delete attrs.order;
            }

            if ( ! attrs.limit || _.isNaN( parseInt( attrs.limit, 10 ) ) || parseInt( attrs.limit, 10 ) < 1 ) {
                delete attrs.limit;
                delete media.galleryDefaults.limit;
            }
            else {
                attrs.limit = parseInt( attrs.limit, 10 ).toString();
            }

            attrs = this.setDefaults( attrs );

            shortcode = new wp.shortcode({
                tag:    this.tag,
                attrs:  attrs,
                type:   'single'
            });

            // Use a cloned version of the gallery.
            clone = new wp.media.model.Attachments( attachments.models, {
                props: props
            });
            clone[ this.tag ] = attachments[ this.tag ];
            collections[ shortcode.string() ] = clone;

            return shortcode;
        },

        edit: function( content ) {

            var shortcode = wp.shortcode.next( this.tag, content ),
                defaultPostId = this.defaults.id,
                attachments, selection, state, props;


            // Bail if we didn't match the shortcode or all of the content.
            if ( ! shortcode || shortcode.content !== content ) {
                return;
            }

            // Ignore the rest of the match object.
            shortcode = shortcode.shortcode;

            if ( _.isUndefined( shortcode.get('id') ) && ! _.isUndefined( defaultPostId ) ) {
                shortcode.set( 'id', defaultPostId );
            }

            attachments = this.attachments( shortcode );
            attachments.props.set( 'perPage', -1 );

            selection = new wp.media.model.Selection( attachments.models, {
                props:    attachments.props.toJSON(),
                multiple: true
            });

            selection[ this.tag ] = attachments[ this.tag ];

            // Fetch the query's attachments, and then break ties from the
            // query to allow for sorting.
            selection.more().done( function() {
                // Break ties with the query.
                selection.props.set({ query: false });
                selection.unmirror();
            });

            // Destroy the previous gallery frame.
            if ( this.frame ) {
                this.frame.dispose();
            }

            if ( shortcode.attrs.named.type && 'video' === shortcode.attrs.named.type ) {
                state = 'video-' + this.tag + '-edit';
            } else {
                state = this.tag + '-edit';
            }

            // Store the current frame.
            this.frame = wp.media({
                frame:     'post',
                state:     state,
                title:     this.editTitle,
                editing:   true,
                multiple:  true,
                selection: selection
            }).open();

            return this.frame;
        }
    };



    /**
     * wp.media.gallery
     *
     */
    _.extend( media.gallery.defaults, {
		orderby : 'menuOrder',
        order: 'ASC'
    });

    delete media.gallery.defaults.id;

    _.extend( media.gallery, eml.mediaCollection );



    /**
     * wp.media.playlist
     *
     */

    _.extend( media.playlist.defaults, {
        orderby: 'menuOrder',
        order: 'ASC'
    });

    delete media.playlist.defaults.id;

    _.extend( media.playlist, eml.mediaCollection );

})( jQuery, _ );
