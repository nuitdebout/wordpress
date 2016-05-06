=== Enhanced Media Library ===
Contributors: webbistro
Tags: media library, media category, media categories, media gallery, gallery shortcode, media tag, media tags, media taxonomy, media taxonomies, media uploader, mime type, mime, mime types, file types, media types, media filter, attachment, gallery, image, images, media, ux, user experience, wp-admin, admin, taxonomy, taxonomies
Requires at least: 4.5
Tested up to: 4.5.1
Stable tag: 2.2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html



A better management for WordPress Media Library



== Description ==

The plugin will be handy for those who need to manage a lot of media files.


= Media Taxonomies =

**Categories and Tags for media items**

**Various media categories.** With the plugin installed you immediately obtain Media Categories for categorizing and filtering media items in WordPress admin. This feature alone will save you hours of searching through a media library with even as few as 100 images.

Whether you have a lot of images that need to be organized into complex structures or simply dislike the name of the default taxonomy – Media Categories – you can create and (un)assign to the media library as many taxonomies as you wish without writing a single line of code.

You can also assign to the media library built-in WordPress taxonomies – Categories and Tags – as well as any other taxonomy created by third-party plugin, theme, or hand-coded – with only plugin's UI.

**For both new and existing media items.** Categorize both new and existing media items. You can assign a category to a media item during the upload process, in the media library (preferably in the Grid Mode), in post/page editor media popup ("Add Media" button). If you need to manage a lot of media items at once, there is the PRO version of the plugin that allows to do it in bulk.

**Filter media items in WP admin.** Every media library screen is enhanced with the plugin's filters to search and sort your media files. With flexible plugin's options you can adjust what filters you will see in Grid and List modes of the media library and in post/page editor media popups, and what taxonomies you would like to edit when inserting media to posts/pages. The plugin works with custom post types as well. The options can also help you to force plugin's filters for third-party plugins or themes, manage media taxonomies archive pages, etc.

**Order options.** With two options "Order media items by" (Date, Title, and Custom Order) and "Sort order" (Ascending and Descending) you can control media items order for all screens of the media library in WP admin. "Custom Order" allows to re-order media items within a category with drag and drop. This order will be used, in particular, for the gallery based on this category. See `Settings > Media > Media Library`.


= Filter-Based Shortcodes =

**Image Gallery and Audio / Video Playlist**

**Fully compatible with WordPress native shortcodes.** Media items categorizing can be useful for the front-end as well. To insert media galleries or audio / video playlists based on media categories you have to use the familiar format like `[gallery media_category="5" category="2" limit="10" monthnum="12" year="2015" orderby="title" order="DESC"]` or `[playlist media_category="5" category="2" limit="10" monthnum="12" year="2015" orderby="title" order="DESC"]`. The PRO version of the plugin allows to manage gallery or playlist shortcode without "coding" at all. Just choose the settings with the plugin's UI in the familiar edit popup and see your gallery / playlis live immediately in the post/page editor.

To turn on the feature set "Enhanced media shortcodes" option on `Settings > Media > Media Library > Media Shortcodes`. Please be advised that conflicts with other gallery plugins or themes are possible. Check your front-end and back-end gallery / playlist functionality after activating the feature.


= MIME Types =

**Media File Types**

Another feature of the plugin is the MIME Types control. You can add new MIME types, delete existing ones, and point what file types are allowed for uploading. Initially, the plugin shows up the WordPress default MIME Type settings and creates the backup of them. The column "Add Filter" allows to add a MIME Type to plugin's filters so that you will be able to filter your media items not only by categories but also by the file type. You can set any label you wish to see in a filter with columns "Singular Label" and "Plural Label".


= Export / Import Plugin Settings =

If you need to move your media library to another website you should export and import WordPress content with WordPress built-in export/import. But to make the Enhanced Media Library work on the new site with the same settings you are provided with the export/import feature.


= Easy to Use and WordPress Native Functionality Oriented Plugin =

We spend hours to make plugins features work as though they were native WordPress functionality. If you are a developer and looking for a solution totally compatible with WordPress core and, at the same point, really easy to deal with for your non-geeky customers, give it a try, you won't be disappointed.


= Support =

Support is free for both versions of the plugin. "PRO"-users do not have priority. We do out best to respond in 24 hours if not sooner.


= Available Languages =

You can see available translations and their progress here: https://translate.wordpress.org/projects/wp-plugins/enhanced-media-library Many thanks to all involved!

Assistance with the translation is highly appreciated!


= Compatibility with Other Plugins =

* Advanced Custom Fields
* Search & Filter
* I Order Terms
* WooCommerce
* Meta Slider
* Jetpack Carousel
* Jetpack Tiled Galleries
* Simple Lightbox
* Responsive Lightbox by dFactory

Please let us know if you find any issue with the plugins from the list above or others.


= Incompatibility =

Please notice that you use the Enhanced Media Library with other plugins that add media categories, media folders, and manage MIME Types at your own risk. We cannot guarantee their compatibility because of different approach to the same functionality. It does NOT mean that we do not recommend using those plugins, it just means we do not recommend to use them at the same time with the Enhanced Media Library. Please choose the one you prefer.


> #### Enhanced Media Library PRO

> The key features:

> * Media items categorization in bulk (multiple items to multiple categories at once) for both just uploaded and existing
> * Media items within a category can be selected in bulk with a single click
> * Selected media items can be deleted in bulk in the Grid mode of the media library or in the post/page editor media popup with a single click
> * Media items child to a post of any type can be auto-assigned to their parent post categories on upload
> * Categories of existing media items can be synchronized with their parent post categories of any type with a single click
> * Filter-based gallery in two clicks, no need to figure out your media category IDs, nor to delve into the text editor shortcode


= Useful Links =

* [Where to start? (Information is being updated)](http://wpuxsolutions.com/documents/enhanced-media-library/eml-where-to-start/)
* [Enhanced Media Shortcode Possible Conflicts](http://www.wpuxsolutions.com/documents/enhanced-media-library/enhanced-media-shortcode-possible-conflicts/)



== Installation ==

1. Upload plugin folder to '/wp-content/plugins/' directory

2. Activate the plugin through `Plugins` menu in WordPress admin

3. Adjust plugin's settings on `Settings > Media`

4. Enjoy Enhanced Media Library!



== Frequently Asked Questions ==

= Why my custom media taxonomy's page is 404? =

Try to just re-save permalinks settings. Go to `Settings > Permalinks` and push "Save Changes" button.

= Why Media Popup of some theme/plugin does not show taxonomy filters? =

By default EML adds its filters to any media popup that already contains native WordPress filters. If a third-party plugin or theme supports native WordPress filters, EML will enhance them.

If a third-party plugin or theme does not support WordPress native filters, but you believe that you need them, try "Force filters" option (`Settings > Media > Taxonomies > Options`). It allows forcing media filters for ANY media popup regardless of what was intended by its creator.

= How to show images per media category on a webpage? =

Since EML 2.1 you can use gallery shortcode with taxonomy parameters like this: `[gallery media_category="5" category="2" limit="10" monthnum="12" year="2015" orderby="title" order="DESC"]` to show filter-based gallery on the front-end. The feature should be activated on `Settings > Media > Media Library > Media Shortcodes`.

Also, you can use WP_Query ([example of the code](http://wordpress.org/support/topic/php-displaying-an-array-of-images-per-category-or-categories)).

= Drag and Drop re-order does not work for media library =

First, please make sure that you chose "Custom Order" for "Order media items by" on `Settings > Media > Media Library > Media Items Order`.

If you use Chrome on Windows, there can be an unexplored issue with it. See core tickets [#22607](https://core.trac.wordpress.org/ticket/22607), [#29606](https://core.trac.wordpress.org/ticket/29606), [#31652](https://core.trac.wordpress.org/ticket/31652). Feel free to contribute your issue details.

In case you use Chrome on a touch screen laptop try to fix the issue as described [here](https://github.com/dbushell/Nestable/issues/92) or use other browser to re-order with drag and drop.

= My gallery behavior is strange | Wrong or none media items displayed | Ligtbox/carousel/slideshow/mosaic looks broken =

The plugin enhances WordPress gallery shortcode in most gentle manner possible. Since v2.1.5 the mechanism of the enhancement is dramatically improved to avoid possible conflicts. In most cases Enhanced Media Library is compatible with any plugin that changes *native* WP gallery template in order to provide lightbox, carousel, slideshow, grid/mosaic functionality.

That said, other plugins might override WP gallery attributes or database query for media items in a way that would prevent Enhanced Media Library from displaying correct set of media items for gallery.

If you find a possible conflict and prefer third-party features to taxonomy-based gallery of the plugin, please deactivate the feature (unset "Enhanced media shortcodes" option on `Settings > Media > Media Library > Media Shortcodes`) and let us know about the issue. We would like to find a solution!

If you are a plugin/theme developer please read [Enhanced Media Shortcode Possible Conflicts](http://www.wpuxsolutions.com/documents/enhanced-media-library/enhanced-media-shortcode-possible-conflicts/)

= I get "Something went wrong" error when bulk-editing in PRO =

Your server can simply not have enough time when processing a lot of media items. Increase `max_execution_time` to 300 (5 minutes) and try again. Increasing memory_limit could help as well.

= Will I lose media categories I’ve created if I upgrade from free to PRO? =

No, all your data will remain intact. Your created media categories and their ties with your images are stored in the database. When you deactivate and delete the free version and then upload and activate the PRO one nothing happens to the database.



== Screenshots ==

1. Plugin Settings: WordPress General Media Settings

2. Plugin Settings: Media Items Order & Enhanced Media Shortcodes

3. Plugin Settings: Media Taxonomies & Filters

4. Plugin Settings: MIME Types settings

5. Plugin Settings: Export, Import, Restore, Cleanup

6. Media Taxonomies are just usual WordPress taxonomies

7. Media categories and tags in Nav Menu

8. Media Library Grid Mode

9. Media Library List Mode

10. Editing individual image / media items

11. Filter-based image gallery



== Changelog ==

= 2.2.2 =
*Release Date - April 30, 2016*

= Improvements =
* Many typos corrected
* Localization added for default taxonomy Media Categories and credits
* CSS for RTL improved
* Encoding for Japanese translation fixed
* Taxonomy queries (filtering) improved for List mode of the media library
* Count number added to filters for List and Grid modes
* Media Taxonomy tab: various CSS and JS improvements, minor bugs fixed
* Performance: enhanced media library loading time reduced for about 40%
* Media taxonomy 'years' is now being renamed to 'media_years' automatically on creation to avoid issues with WP queries


&nbsp;
= 2.2.1 =
*Release Date - April 13, 2016*

= Improvements =
* Enhanced media library settings moved under Settings > Media
* Text domain changed to match the plugin slug
* Better CSS for media library grid mode, addressing some minor issues as well

= Compatibility =
* Wordpress 4.5 compatibility ensured


&nbsp;
= 2.2 =
*Release Date - March 19, 2016*

= New =
* Option "Auto-assign media items to parent post categories on upload" added per non-media taxonomy [PRO only]
* Options and database cleanup added

= Improvements =
* Few security improvements
* Few CSS, UI and behavior improvements
* Slight performance improvement

= Bugfixes =
* A bug with non-saved drag and drop order in media library fixed
* A bug with "Reset All Filters" button fixed
* Custom order works now correctly on upload


&nbsp;
= 2.1.7 =
*Release Date - January 24, 2016*

= Improvements =
* Correct order during uploading for orderby "Title" ensured
* Bulk delete performance improved [PRO only]


&nbsp;
= 2.1.6.1 =
*Release Date - January 22, 2016*

= Bugfixes =
* The bug of post/page uploader fixed
* Few minor bugs fixed


&nbsp;
= 2.1.6 =
*Release Date - January 19, 2016*

= New =
* Support for [playlist] shortcode added
* Easy visual playlist editing with the native WordPress UI [PRO only]
* "Show in REST" option added per taxonomy, see [Registering A Custom Taxonomy With REST API Support](http://v2.wp-api.org/extending/custom-content-types/#registering-a-custom-taxonomy-with-rest-api-support)

= Improvements =
* Option "Enhanced gallery" replaced with "Enhanced media shortcodes"

= Bugfixes =
* Orderby and order behavior improved, minor bugs fixed
* Minor CSS fixes


&nbsp;
= 2.1.5 =
*Release Date - January 14, 2016*

= Improvements =
* Gallery enhancement is dramatically (!) improved to avoid possible conflicts ([learn more](http://www.wpuxsolutions.com/documents/enhanced-media-library/enhanced-gallery-possible-conflicts/))
* Few code improvements

= Bugfixes =
Filters returned to Customizer


&nbsp;
= 2.1.4 =
*Release Date - January 10, 2016*

= New =
* Option "limit" added to the gallery shortcode
* Options "Order media items by" (orderby) and "Sort order" (order) added to admin

= Improvements =
* Bulk edit is now 3 times faster and less server resources consuming! [PRO only]
* Gallery feature are now turned off by default. Option "Turn off enhanced gallery" replaced with "Enhanced gallery"
* Minor CSS improvements

= Compatibility =
* Jetpack Tiled Galleries compatibility ensured
* We are going to abandon support for older versions of WordPress. EML 2.1.4 is still compatible with WP 4.0, but from the next release we stop testing it with older versions.

= Bugfixes =
* Characters | and > are no longer delimiters (there are no delimiters any more) and can be used for media category name.
* Few minor bugs fixed


&nbsp;
= 2.1.3 =
*Release Date - December 17, 2015*

= Bugfixes =
* Compatibility of the plugin's code with different PHP versions ensured
* "Warning: Missing argument 3 for wpuxss_eml_gallery_shortcode()" fixed
* The bug with unavailable image meta on Edit Gallery screen fixed

= Improvements =
* "Turn off enhanced gallery" option added. Allows to turn off the gallery shortcode enhancement without deactivating the whole plugin in case of incompatibility with other plugins or themes. Please inform plugin authors about the issue. We would like to fix it!


&nbsp;
= 2.1.2 =
*Release Date - December 15, 2015*

= Compatibility =
* Fixed v2.1 and Jetpack Carousel incompatibility


&nbsp;
= 2.1.1 =
*Release Date - December 15, 2015*

= Bugfixes =
* Minor incompatibility with WordPress 4.3 fixed


&nbsp;
= 2.1 =
*Release Date - December 15, 2015*

= New =
* Filter-based Image Galleries by extending native WordPress gallery shortcode
* Easy visual gallery editing with the native WordPress gallery UI [PRO only]
* Export/import of the plugin settings to JSON

= Improvements =
* Better filtering and "force filters" mechanism, sorting by 'menuOrder' by default for media taxonomy filters
* Plugin credits in admin removed from Media Settings > Taxonomies, and Media Settings > MIME Types, moved to Settings > Enhanced Media Library
* "Deactivate License" added [PRO only]
* Various code improvements for both free and PRO
* Minor UX improvements

= Compatibility =
* Fixed incompatibility with [WP Plugin Dependencies](https://github.com/xwp/wp-plugin-dependencies)
* Wordpress 4.4 compatibility ensured

= Languages =
* Korean translation added


&nbsp;
= Previous releases... =
