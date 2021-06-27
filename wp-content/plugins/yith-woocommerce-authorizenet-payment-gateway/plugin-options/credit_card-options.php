<?php
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

if ( ! defined( 'YITH_WCAUTHNET' ) ) {
	exit;
} // Exit if accessed directly

$gateway = YITH_WCAUTHNET()->get_gateway();

return apply_filters( 'yith_wcauthnet_credit_card_options', array(
	'credit_card' => array_merge(
		array(

			'credit_card_section_start' => array(
				'name' => __( 'Credit card payment settings', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'type' => 'title',
				'desc' => '',
				'id'   => 'yith_wcauth_credit_card_settings'
			),

			'enable' => array(
				'name'      => __( 'Enable YITH Authorize.net', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'desc'      => __( 'Choose whether to enable or not the Authorize.net payment method through credit cards', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'id'        => 'woocommerce_yith_wcauthnet_credit_card_gateway_settings[enabled]',
				'default'   => 'yes',
				'type'      => 'yith-field',
				'yith-type' => 'onoff'
			),

			'sandbox' => array(
				'name'      => __( 'Environment', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'desc'      => __( 'Choose whether to process real transactions or simulated transactions using a sandbox', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'id'        => 'woocommerce_yith_wcauthnet_credit_card_gateway_settings[sandbox]',
				'options'   => array(
					'no'  => __( 'Live', 'yith-woocommerce-authorizenet-payment-gateway' ),
					'yes' => __( 'Sandbox', 'yith-woocommerce-authorizenet-payment-gateway' ),
				),
				'default'   => 'yes',
				'type'      => 'yith-field',
				'yith-type' => 'radio'
			),

			'login_id' => array(
				'name' => __( 'Login ID', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'desc' => __( 'Enter the univocal ID associated to the admin\'s account.<br/>It can be retrieved in the "<a href="https://support.authorize.net/s/article/How-do-I-obtain-my-API-Login-ID-and-Transaction-Key">API Login ID and Transaction Key</a>" section', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'id'   => 'woocommerce_yith_wcauthnet_credit_card_gateway_settings[login_id]',
				'type' => 'text',
			),

			'transaction_key' => array(
				'name' => __( 'Transaction Key', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'desc' => __( 'Enter the unique key used to validate requests to Authorize.net.<br/>It can be retrieved in the "<a href="https://support.authorize.net/s/article/How-do-I-obtain-my-API-Login-ID-and-Transaction-Key">API Login ID and Transaction Key</a>" section', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'id'   => 'woocommerce_yith_wcauthnet_credit_card_gateway_settings[transaction_key]',
				'type' => 'password',
			),

			'transaction_type' => array(
				'name'      => __( 'Transation type', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'desc'      => __( 'Choose whether to capture funds immediately or authorize payment only', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'id'        => 'woocommerce_yith_wcauthnet_credit_card_gateway_settings[transaction_type]',
				'options'   => array(
					'AUTH_ONLY'    => __( 'Authorize only - Authorize payments without taking money from customer\'s account', 'yith-woocommerce-authorizenet-payment-gateway' ),
					'AUTH_CAPTURE' => __( 'Authorize and capture - Authorize payments and automatically take funds from customer\'s account', 'yith-woocommerce-authorizenet-payment-gateway' ),
				),
				'default'   => 'AUTH_CAPTURE',
				'type'      => 'yith-field',
				'yith-type' => 'radio'
			),

			'debug' => array(
				'name'      => __( 'Debug Log', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'desc'      => sprintf( __( 'Enable to save a log of the Authorize.net events inside <code>%s</code>', 'yith-woocommerce-authorizenet-payment-gateway' ), wc_get_log_file_path( 'authorize.net' ) ),
				'id'        => 'woocommerce_yith_wcauthnet_credit_card_gateway_settings[debug]',
				'default'   => 'yes',
				'type'      => 'yith-field',
				'yith-type' => 'onoff',
			),
		),

		$gateway ? array(
			'relay_url' => array(
				'title'     => __( 'Config Receipt URL', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'html'      => sprintf(
					__(
						'In order to correctly process payments, you\'ll need to set up Receipt URL for this site on your Authorize dashboard. Navigate to Authorize.net Dashboard -> Account -> Response/Receipt URLs, and add a new item with the following url: <code>%s</code>',
						'yith-woocommerce-authorizenet-payment-gateway'
					),
					$gateway->get_relay_url()
				),
				'id'        => 'relay_url',
				'type'      => 'yith-field',
				'yith-type' => 'html',
			),
		) : array(),

		array(
			'credit_card_section_end' => array(
				'type' => 'sectionend',
				'id'   => 'yith_wcauth_credit_card_settings'
			),

			'customization_section_start' => array(
				'name' => __( 'Customization', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'type' => 'title',
				'desc' => '',
				'id'   => 'yith_wcauth_customization_settings'
			),

			'title' => array(
				'name'    => __( 'Title', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'desc'    => __( 'Enter a title to identify this payment method during the checkout', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'id'      => 'woocommerce_yith_wcauthnet_credit_card_gateway_settings[title]',
				'default' => __( 'Authorize.net Payment', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'type'    => 'text',
			),

			'description' => array(
				'name'    => __( 'Description', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'desc'    => __( 'Enter an optional description for this payment method', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'id'      => 'woocommerce_yith_wcauthnet_credit_card_gateway_settings[description]',
				'default' => __( 'Accepts Payments. Anywhere', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'type'    => 'text',
			),

			'order_button' => array(
				'name'    => __( 'Order button label', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'desc'    => __( 'Enter the text for the order button', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'id'      => 'woocommerce_yith_wcauthnet_credit_card_gateway_settings[order_button]',
				'default' => __( 'Proceed to Authorize.net', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'type'    => 'text',
			),

			'show_cards' => array(
				'name'      => __( 'Show credit card icons', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'desc'      => __( 'Enable to show credit card icons on Checkout page', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'id'        => 'woocommerce_yith_wcauthnet_credit_card_gateway_settings[show_cards]',
				'default'   => 'yes',
				'type'      => 'yith-field',
				'yith-type' => 'onoff',
			),

			'card_types' => array(
				'name'      => __( 'Credit card icons to show', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'desc'      => __( 'Choose which credit card icon to show on Checkout page', 'yith-woocommerce-authorizenet-payment-gateway' ),
				'id'        => 'woocommerce_yith_wcauthnet_credit_card_gateway_settings[card_types]',
				'default'   => array( 'visa', 'mastercard', 'amex', 'discover', 'diners', 'jcb' ),
				'type'      => 'yith-field',
				'yith-type' => 'select',
				'multiple'  => true,
				'class'     => 'wc-enhanced-select',
				'options'   => apply_filters( 'yith_wcauthnet_card_types',
					array(
						'visa'       => __( 'Visa', 'yith-woocommerce-authorizenet-payment-gateway' ),
						'mastercard' => __( 'MasterCard', 'yith-woocommerce-authorizenet-payment-gateway' ),
						'amex'       => __( 'American Express', 'yith-woocommerce-authorizenet-payment-gateway' ),
						'discover'   => __( 'Discover', 'yith-woocommerce-authorizenet-payment-gateway' ),
						'diners'     => __( 'Diner\'s Club', 'yith-woocommerce-authorizenet-payment-gateway' ),
						'jcb'        => __( 'JCB', 'yith-woocommerce-authorizenet-payment-gateway' ),
					)
				),
			),

			'customization_section_end' => array(
				'type' => 'sectionend',
				'id'   => 'yith_wcauth_customization_settings'
			),

		)
	),
) );