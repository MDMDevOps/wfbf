<?php
/**
 * The plugin bootstrap file
 * This file is read by WordPress to generate the plugin information in the plugin admin area.
 * This file also defines plugin parameters, registers the activation and deactivation functions, and defines a function that starts the plugin.
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_jira_support
 *
 * @wordpress-plugin
 * Plugin Name: Jira Support Tickets
 * Plugin URI:  http://midwestfamilymarketing.com
 * Description: Add support ticket functionality
 * Version:     1.0.0
 * Author:      Mid-West Family Marketing
 * Author URI:  http://midwestfamilymarketing.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: mdm_jira_support
 */

// If this file is called directly, abort
if ( !defined( 'WPINC' ) ) {
	die( 'Bugger Off Script Kiddies!' );
}

function mdm_jira_support_menu_item( $admin_bar ) {
	$admin_bar->add_menu( array(
		'id'    => 'support_request',
		'title' => 'Support',
		'parent' => 'site-name',
		'href'  => 'https://midwestdigitalmarketing.atlassian.net/servicedesk/customer/portal/1/group/1',
		'meta'  => array(
			'title' => __( 'Support Request' ),
			'target' => '_blank',
		),
	));
}
add_action( 'admin_bar_menu', 'mdm_jira_support_menu_item', 999 );

/**
 * Output support request button
 *
 * @see https://midwestdigitalmarketing.atlassian.net/servicedesk/admin/SR/addon/com.atlassian.servicedesk.embedded__settings
 */
function mdm_jira_support_button() {
	// If user cannot manage options, we can bail
	if( !current_user_can( 'manage_options' ) ) {
		return false;
	}
	// Else echo javascript embed
	echo '<script data-jsd-embedded data-key="f770f0bf-ff05-4490-80c5-9f409b106b14" data-base-url="https://jsd-widget.atlassian.com" src="https://jsd-widget.atlassian.com/assets/embed.js"></script>';
	echo '<style>#jsd-widget{bottom:14px !important;z-index:99999!important}</style>';
}
add_action( 'admin_head', 'mdm_jira_support_button' );
