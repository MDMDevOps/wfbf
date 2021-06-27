/*  Copyright 2013  Your Inspiration Themes  (email : plugins@yithemes.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Admin js
 *
 * @author  Your Inspiration Themes
 * @package YITH WooCommerce Authorize.net
 * @version 1.0.0
 */
jQuery( function($) {
	var show_cards = $('[id^="woocommerce_yith_wcauthnet_credit_card_gateway_settings[show_cards]"]'),
		card_types = $('[id^="woocommerce_yith_wcauthnet_credit_card_gateway_settings[card_types]"]');

	show_cards.on( 'change', function(){
		if ( show_cards.is(':checked') ) {
			card_types.closest('tr').fadeIn('slow');
		} else {
			card_types.closest('tr').fadeOut('slow');
		}
	} ).change();
} );ssh