window.wp = window.wp || {};
window.eml = window.eml || { l10n: {} };


( function( $, _ ) {

    var media = wp.media,
        Attachments = media.model.Attachments,
        Query = media.model.Query;



    _.extend( eml.l10n, wpuxss_eml_media_models_l10n );



    _.extend( Attachments.prototype, {

        saveMenuOrder: function() {

            var nonce = wp.media.model.settings.post.nonce || eml.l10n.bulk_edit_nonce;

            if ( 'menuOrder' !== this.props.get('orderby') ) {
                return;
            }

            // Removes any uploading attachments, updates each attachment's
            // menu order, and returns an object with an { id: menuOrder }
            // mapping to pass to the request.
            var attachments = this.chain().filter( function( attachment ) {
                return ! _.isUndefined( attachment.id );
            }).map( function( attachment, index ) {
                // Indices start at 1.
                index = index + 1;
                attachment.set( 'menuOrder', index );
                return [ attachment.id, index ];
            }).object().value();

            if ( _.isEmpty( attachments ) ) {
                return;
            }

            return wp.media.post( 'save-attachment-order', {
                nonce: nonce,
                post_id: wp.media.model.settings.post.id,
                attachments: attachments
            });
        }
    });



    _.extend( Query.prototype, {

        initialize: function( models, options ) {

            var allowed;

            options = options || {};
            Attachments.prototype.initialize.apply( this, arguments );

            this.args     = options.args;
            this._hasMore = true;
            this.created  = new Date();

            this.filters.order = function( attachment ) {
                return attachment.get( 'menuOrder' ) === 0;
            };

            // Observe the central `wp.Uploader.queue` collection to watch for
            // new matches for the query.
            //
            // Only observe when a limited number of query args are set. There
            // are no filters for other properties, so observing will result in
            // false positives in those queries.
            allowed = [ 's', 'order', 'orderby', 'posts_per_page', 'post_mime_type', 'post_parent', 'year', 'monthnum' ];
            if ( wp.Uploader && _( this.args ).chain().keys().difference( allowed ).isEmpty().value() ) {
                this.observe( wp.Uploader.queue );
            }
        }
    });



    // add 'rand' to allowed
    _.extend( Query.orderby.allowed, [ 'name', 'author', 'date', 'title', 'rand', 'modified', 'uploadedTo', 'id', 'post__in', 'menuOrder' ] );



    _.extend( Query, {

        defaultProps: {
            orderby: eml.l10n.media_orderby,
            order: eml.l10n.media_order
        },

        queries: [],

        cleanQueries: function(){

            this.queries = [];
        },

        get: (function(){

            return function( props, options ) {

                var args       = {},
                    orderby    = Query.orderby,
                    defaults   = Query.defaultProps,
                    query,
                    cache      = !! props.cache || _.isUndefined( props.cache );

                delete props.query;
                delete props.cache;

                // Fill default args.
                _.defaults( props, defaults );

                // Normalize the order.
                props.order = props.order.toUpperCase();
                if ( 'DESC' !== props.order && 'ASC' !== props.order ) {
                    props.order = defaults.order.toUpperCase();
                }

                // Ensure we have a valid orderby value.
                if ( ! _.contains( orderby.allowed, props.orderby ) ) {
                    props.orderby = defaults.orderby;
                }

                // Generate the query `args` object.
                // Correct any differing property names.
                _.each( props, function( value, prop ) {
                    if ( _.isNull( value ) ) {
                        return;
                    }

                    args[ Query.propmap[ prop ] || prop ] = value;
                });

                // Fill any other default query args.
                _.defaults( args, Query.defaultArgs );

                // `props.orderby` does not always map directly to `args.orderby`.
                // Substitute exceptions specified in orderby.keymap.
                args.orderby = orderby.valuemap[ props.orderby ] || props.orderby;

                // Search the query cache for matches.
                if ( cache ) {
                    query = _.find( this.queries, function( query ) {
                        return _.isEqual( query.args, args );
                    });
                } else {
                    this.queries = [];
                }

                // Otherwise, create a new query and add it to the cache.
                if ( ! query ) {
                    query = new Query( [], _.extend( options || {}, {
                        props: props,
                        args:  args
                    } ) );
                    this.queries.push( query );
                }

                return query;
            };
        }())
    });



    media.query = function( props ) {

        return new Attachments( null, {
            props: _.extend( _.defaults( props || {}, {
                orderby: eml.l10n.media_orderby,
                order: eml.l10n.media_order
            } ), { query: true } )
        });
    };

})( jQuery, _ );
