=== Meow Lightbox ===
Contributors: TigrouMeow, kywyz
Tags: lightbox, responsive, exif, media, gps, map, photography, photo, gutenberg, image, images, gallery, retina
Requires at least: 5.0
Tested up to: 5.7
Requires PHP: 5.6
Stable tag: 3.0.8

This is a responsive minimal Lightbox built for photographers, which displays EXIF information. This lightbox is highly optimized and designed to be fast and beautiful.

== Description ==

This is a responsive minimal Lightbox built for photographers, which displays EXIF information. This lightbox is highly optimized and designed to be fast and beautiful. Learn more about it here: [Meow Lightbox](https://meowapps.com/plugin/meow-lightbox/).

=== KEY FEATURES ===

- Responsive Layout. Looks great on mobile, tablets and bigger screens.
- Responsive Images. Image resolution itself will adapt to the screen and device.
- Display Image / EXIF information. Shutter speed, aperture, camera, lens.

== DEMOS ==
If you want to see how it performs, have a look at those examples.

- With a gallery: [Nara Dreamland](https://haikyo.org/nara-dreamland/)
- With single photos: [Best Abandoned Places in Japan](https://offbeatjapan.org/best-abandoned-places-2014/)

=== GALLERY ===
We believe that choice of the gallery system depends on you. We however recommend you to use the [Meow Gallery](https://wordpress.org/plugins/meow-gallery/).

=== PRO ===
Getting the Pro version will support us and the development of the plugin, and also add those features:

- Preloading: the images will load faster (or even instantly) in the Lightbox.
- Google Maps: if GPS is available in your image, a map will be available.
- Deep-Linking: allow sharing an URL that will open the Lightbox directly on a specific image.
- Slideshow: you can start a slideshow from the Lightbox.

=== IMPORTANT ===
By default, the selector is set for the classes '.entry-content, .gallery, .mgl-gallery'. If you need the Lightbox to be active for more selectors, you will need to update the settings. The plugin will apply the lightbox for images contained by the selector. For more information, please check the [official page](https://meowapps.com/plugin/meow-lightbox/).

Languages: English.

== Installation ==

1. Upload `meow-lightbox` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Upgrade Notice ==

Replace all the files. Nothing else to do.

== Frequently Asked Questions ==

Please have a look at [Meow Lightbox](https://meowapps.com/plugin/meow-lightbox/).

== Changelog ==

= 3.0.8 (2021/05/22) =
* Update: More natural zoom.
* Fix: Tiny fixes and improvements.

= 3.0.4 =
* Add: Option for magnification.
* Fix: Avoid breaking pagebuilders.
* Update: Replace Leaftlet by Google Maps SDK.
* Fix: Listen to arrow keys when lighbox is open.

= 3.0.3 =
* Fix: Doesn't break page builders and Rank Math SEO.
* Update: Meow Common 3.3.

= 3.0.2 =
* Add: Option to disable cache.
* Fix: Lightbox navigation arrows keeping hover state on mobile.

= 3.0.1 =
* Update: Avoid issues when reading the PHP Error Logs.
* Update: Re-added the timer/delay for the slideshow.

= 3.0.0 (2020/09/06) =
* Update: Brand new UI on the admin side.

= 2.0.7 =
* Fix: Const was used in a non-transpiled environment (and therefore, not working on old browsers).

= 2.0.6 =
* Fix: Divi Builder was not working when Meow Lightbox was enabled.

= 2.0.5 =
* Fix: Issue in the map when lazyloading was used in the gallery.
* Info: We absolutely need your help and motivation. You can do it by writing a review [here]( https://wordpress.org/support/plugin/meow-lightbox/reviews/?rate=5#new-post). Thanks a lot :)

= 2.0.4 =
* Add: Option to load a low-res first, to make sure the image appears instantly.
* Fix: Exif data format.
* Fix: Bug with certain theme, only the first image was displayed.

= 2.0.3 =
* Fix: Performance issue related to the DOM.
* Update: Optimized the way the images are prepared.
* Fix: Move lightbox controls down when admin bar is displayed.
* Fix: Wraps EXIF when too long.
* Fix: Byebye to the naturalWidth issue.
* Fix: Hide map icon if... it's disabled.
* Add: Display focal length and capture date.
* Info: We absolutely need your help and motivation. You can do it by writing a review [here]( https://wordpress.org/support/plugin/meow-lightbox/reviews/?rate=5#new-post). Thanks a lot :)

= 1.7.9 =
* Fix: There was a little notice in the Error Logs for old versions of PHP.

= 1.7.8 =
* Fix: Issue with WooCommerce checkout.

= 1.7.6 =
* Update: Exif analysis code restructured.
* Add: Slideshow feature for Pro.

= 1.7.5 =
* Fix: There was an JS error with ImageLoad.
* Update: Improve sizing of low-res image.
* Fix: Compatibility with IE11.

= 1.7.3 =
* Fix: REST requests with the GET method were handled by the plugin (and they shouldn't).
* Update: Loader SVG was moved inline.

= 1.7.1 =
* Fix: Avoid notices when lens it not available in EXIF.
* Fix: Swipe detection.

= 1.6.9 =
* Fix: Simpler and probably better REST detection.
* Fix: Potential fix for WooCommerce.
* Add: Support more camera names.

= 1.6.8 =
* Fix: Remove the notices about the 'Undefined index: geo_coordinates' and the missing path.
* Add: Filters for all the image information.
* Add: Enable right click option.
* Info: If you like this lightbox, please review it. We absolutely need your help in order to add fresh features. You can do it [here]( https://wordpress.org/support/plugin/meow-lightbox/reviews/?rate=5#new-post). Thanks a lot :)

= 1.6.4 =
* Add: Image Size option (Responsive Images or defined Image Size).
* Add: Low-Res First, Deep-Linking.
* Update: Better loader and cleaner JS.

= 1.6.3 =
* Fix: Issue with OB and REST updates in the Post Editor.
* Update: Dashboard and common librairies refreshed.
* Update: Default settings are now set to use OB Mode and HtmlDomParser. If that brings issues for you, please have a look at this: [For broken HTML / other issues](https://wordpress.org/support/topic/for-broken-html-other-issues/), and try the second piece of code.

= 1.6.1 =
* Fix: There was a little mess-up with the Output Buffering.
* Update: Back-end process go through all images instead of being limited by the selector (selector is activated in the front only).
* Info: Sorry, there was a lot of work done on the plugin this week to make it work everywhere, as always, your feedbacks are really valuable. Thank you so much :)

= 1.5.8 =
* Add: New hidden/internal options.
* Updated: Now use OB, coupled with a fast parsing engine.
* Update: Still trying to find the best compromise compatibility/performance (with default behavior that works on 99.8% of the installs). Now the internals of the plugin can work differently depending on internal options, so if you have an issue, please contact us and we will look into it.

= 1.5.7 =
* Update: Fix HTML issues and rendering.
* Update: Additional compatibility for W3C.

= 1.5.6 =
* Fix: Little issue caused by anti-selector.
* Fix: Captions and EXIF weren't showing in images used outside galleries. The Lightbox is now parsing the DOM to actually get all the required information and should work for everything.
* Info: If you like this lightbox, please review it. We absolutely need your help in order to add fresh features. You can do it [here]( https://wordpress.org/support/plugin/meow-lightbox/reviews/?rate=5#new-post). Thanks a lot :)

= 1.5.4 =
* Note: Many things were fixed in the very last commit, but are linked to the very recent changes. Please have a look at the changes below, and it is also recommended to visit your settings for the Lightbox and click on the Reset Cache button (at the top).
* Update: Refactoring of many parts of the lightbox, settings were simplified.
* Update: Do not use slow asynchronous requests anymore = no more delay, the lightbox works right away, with EXIF caching.
* Update: Icons and styles were reviewed.
* Fix: The little images are not blown out anymore.
* Info: If you like this lightbox, please review it. We absolutely need your help in order to add fresh features. You can do it [here](https://wordpress.org/support/plugin/meow-lightbox/reviews/?rate=5#new-post). Thanks a lot :)

= 1.4.6 =
* Fix: Cache was not always reset accordingly.

= 1.4.4 =
* Fix: GPS was not being cached.
* Fix: Ajax calls optimization.
* Update: Caching optimization.

= 1.4.2 =
* Update: Added Anti Selector (CSS selector) to avoid Lightbox to be applied.
* Fix: Better display of arrows on light photos.
* Fix: There was an issue when the same photo was used twice on the same page.
* Fix: Incompatibility had the bad effect to freeze the website.
* Update: Compatibility with WP 5 and Gutenberg.

= 1.2.2 =
* Fix: Remove Updraft link.
* Update: For speed and confidentiality purposes, top using external CDNs. Inline SVGs are used instead.
* Info: If you like this lightbox, please review it. We absolutely need your help in order to add fresh features. You can do it here: https://wordpress.org/support/plugin/meow-lightbox/reviews/?rate=5#new-post. Thanks a lot :)

= 1.1.2 =
* Add: By default, also add the Lightbox to the Meow Gallery.
* Update: Display a message in the admin if the Permalinks are not enabled (they are required by the Lightbox API).

= 1.1.0 =
* Update: Code cleaning.
* Fix: SSL verify for updates.

= 1.0.6 =
* Add: Swipe.
* Fix: Issue with preloading.
* Fix: Issue with vertical photo.

= 1.0.3 =
* Fix: If there are errors in the EXIF, show images anyway.
* Fix: Incompatibility with older versions of PHP.

= 1.0.0 =
* Add: Map for the Photography Layout, if there are GPS coordinates.
* Add: GPS coordinates for images.
* Update: Better performance.
* Update: Disable PrettyPhoto if it is forced by a theme.

= 0.1.3 =
* Add: Option to choose which caption to display in the lightbox (caption or description).

= 0.1.2 =
* Update: Better handing of the API calls.
* Pro: Preloading.

= 0.1.0 =
* Add: Lens information.
* Update: Bigger arrows.
* Update: Camera info, from now this data will be made "nicer" to look at little by little.

= 0.0.7 =
* Add: Theme (Dark or Light)
* Add: Layout (Minimal)
* Update: Improved options.

= 0.0.3 =
* Fix: Was catching too many JS key events.
* Add: Swiping images
* Add: 'Close' button

= 0.0.1 =
* First release.

== Screenshots ==

1. Lightbox displaying EXIF information
