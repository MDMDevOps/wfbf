=== YITH WooCommerce Authorize.net Payment Gateway ===

Contributors: yithemes
Tags: authorize.net, woocommerce, products, themes, yit, e-commerce, shop, payment gateway, yith, woocommerce authorize.net payment gateway, woocommerce 2.6 ready, credit card, authorize
Requires at least: 4.5
Tested up to: 5.6
Stable tag: 1.2.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

YITH Authorize.net allows your users to pay using the Authorize.net network services.
It requires WooCommerce to work. WooCommerce 4.7.x compatible.

== Description ==

YITH Authorize.net Payment Gateway extends the WooCommerce default payment modes, adding the possibility to pay with credit cards through the services offered by the Authorize.net network. A system that indeed includes an amount of reliability, with the guarantee that your purchase process will not be stopped by lost payments. In addition, research have proved that the more payment methods are available on your website, the more website's reliability is improved: this means that adding credit card will persuade more in choosing your shop to purchase.

= Main features: =

*   Use of Authorize.net for the payment system
*   Neat redirect to Authorize.net's pages for the conclusion of the payment
*   A completely automatic Instant Payment Notification service managed by Authorize.net

== Installation ==

1. Unzip the downloaded zip file.
2. Upload the plugin folder into the `wp-content/plugins/` directory of your WordPress site.
3. Activate `YITH WooCommerce Authorize.net Payment Gateway` from Plugins page

YITH WooCommerce Authorize.net Payment Gateway will add a new submenu called "Authorize.net" under "YITH" menu. Here you are able to configure all the plugin settings.

== Changelog ==

= 1.2.5 - Released on 10 November 2020 =

* New: support for WordPress 5.6
* New: support for WooCommerce 4.7
* New: possibility to update plugin via WP-CLI
* Update: plugin framework
* Dev: removed deprecated .ready method from scripts

= 1.2.4 - Released on 15 October 2020 =

* New support for WooCommerce 4.6
* Update: plugin framework

= 1.2.3 - Released on 17 September 2020 =

* New support for WooCommerce 4.5
* Update: plugin framework

= 1.2.2 - Released on 27 August 2020 =

* Fix: possible fatal error on admins screen

= 1.2.1 - Released on 13 August 2020 =

* New: support for WordPress 5.5
* New: support for WooCommerce 4.4
* Update: plugin framework
* Tweak: added some additional notes regarding Receipt url

= 1.2.0 - Released on 07 July 2020 =

* New: support for WooCommerce 4.3
* New: improved settings panel layout
* New: svg card icons
* Update: plugin framework

= 1.1.20 - Released on 09 June 2020 =

* New: support for WooCommerce 4.2
* Update: plugin framework

= 1.1.19 - Released on 08 May 2020 =

* New: support for WooCommerce 4.1
* Update: plugin framework

= 1.1.18 - Released on 14 March 2020 =

* New: support for WordPress 5.4
* New: support for WooCommerce 4.0
* Update: plugin framework
* Tweak: code reformat

= 1.1.17 - Released on 24 December 2019 =

* New: support for WooCommerce 3.9
* Update: plugin framework

= 1.1.16 - Released on 12 December 2019 =

* Update: Plugin Framework

= 1.1.15 - Released on 29 November 2019 =

* Update: Notice handler
* Update: Plugin Framework

= 1.1.14 - Released on 05 November 2019 =

* New: support for WordPress 5.3
* New: support for WooCommerce 3.8
* Update: Plugin Framework

= 1.1.13 - Released on 30 October 2019 =

* Update: internal plugin framework

= 1.1.12 - Released on 13 June 2019 =

* New: WooCommerce 3.7.0 RC2 support
* Update: internal plugin framework

= 1.1.11 - Released on 13 June 2019 =

* Update: internal plugin framework

= 1.1.10 - Released on 23 April 2019 =

* Update: internal plugin framework

= 1.1.9 - Released on 04 April 2019 =

* New: WooCommerce 3.6.0 RC1 support
* Update: internal plugin framework

= 1.1.8 - Released on 30 January 2019 =

* New: WooCommerce 3.5.4 support
* Tweak: removed check over deprecated MD5 Hash
* Update: internal plugin framework

= 1.1.7 - Released on 12 December 2018 =

* New: WordPress 5.0 support
* New: WooCommerce 3.5.2 support
* Tweak: updated plugin framework

= 1.1.6 - Released on 24 October 2018 =

* New: WooCommerce 3.5 support
* Tweak: updated plugin framework
* Update: Dutch language

= 1.1.5 - Released on 16 October 2018 =

* New: WordPress 4.9.8 support
* New: WooCommerce 3.5-rc support
* Tweak: updated plugin framework
* Fix: check if debug is enabled before trying to access logger object
* Update: Spanish language
* Update: Italian language

= 1.1.4 - Released on 28 May 2018 =

* New: WooCommerce 3.4 compatibility
* New: WordPress 4.9.6 compatibility
* New: updated plugin framework to latest version
* New: GDPR compliance
* New: Italian language

= 1.1.3 - Released on 01 February 2018 =

* New: added WooCommerce 3.3.0 support
* New: added WordPress 4.9.2 support
* New: updated plugin-fw to latest revision
* New: added Dutch translation

= 1.1.0 - Released on 04 April 2017 =

* New: WordPress 4.7.3 compatibility
* New: WooCommerce 3.0.0 RC2 compatibility
* Tweak: Changed Transaction Key from text field to password field

= 1.0.9 - Released on 17 June 2016 =

* Added WooCommerce 2.6 compatibility
* Tweak: switched authorize.net serve url to https://secure2.authorize.net/gateway/transact.dll (Akamai SureRoute production)

= 1.0.8 - Released on 05 May 2016 =

* Added: Support to WordPress 4.5.1
* Added: Support to WooCommerce 2.5.5
* Added: js code to keep user data through update_checkout process
* Tweak: Removed deprecated WC functions/methods

= 1.0.7 - Released on 13 January 2016 =

* Added: option to customize "Pay button"
* Added: WC 2.5-RC compatibility
* Added: WP 4.4 compatibility
* Tweak: Performance improved with new plugin core 2.0

= 1.0.6 - Released on 13 August 2015 =

* Added: Compatibility with WP 4.2.4
* Added: Compatibility with WC 2.4.2
* Tweak: Updated internal plugin-fw

= 1.0.5 - Released on 03 July 2015 =

* Tweak: formatted order amount with number_format() function
* Tweak: formatted relay url with user_trailingslashit() function
* Fixed: Fingerprint calculation for SIM

= 1.0.4 - Released on 19 June 2015 =

* Added: WooCommerce 2.3.11
* Fixed: Fingerprint calculation for prices without decimals

= 1.0.3 - Released on 04 May 2015 =

* Fixed: "Plugin Documentation" link appearing on all plugins
* Fixed: minor bugs

= 1.0.2 - Released on 29 April 2015 =

* Added: handling for "Authorize only" transactions
* Fixed: escaped add_query_arg and remove_query_arg

= 1.0.1 - Released on 09 March 2015 =

* Updated: removed unused libraries
* Fixed: minor fixes

= 1.0.0 - Released on 20 February 2015 =

* Initial release

== Suggestions ==

If you have suggestions about how to improve YITH Authorize.net Payment Gateway, you can [write us](mailto:plugins@yithemes.com "Your Inspiration Themes") so we can bundle them into YITH Authorize.net Payment Gateway.

== Screenshots ==

1. Settings
2. Authorize.net Checkout panel
3. Authorize.net payment form
4. Order complete after Authorize.net payment

== Translators ==

= Available Languages =
* English (Default)
* Italian - ITALY
* Spanish - SPAIN
* Dutch - NETHERLANDS

Need to translate this plugin into your own language? You can contribute to its translation from [this page](https://translate.wordpress.org/projects/wp-plugins/yith-woocommerce-authorizenet-payment-gateway "Translating WordPress").
Your help is precious! Thanks

== Documentation ==

Full documentation is available [here](http://yithemes.com/docs-plugins/yith-woocommerce-authorizenet-payment-gateway).