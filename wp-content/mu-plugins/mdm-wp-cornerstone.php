<?php
/**
 * The plugin bootstrap file
 * This file is read by WordPress to generate the plugin information in the plugin admin area.
 * This file also defines plugin parameters, registers the activation and deactivation functions, and defines a function that starts the plugin.
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 *
 * @wordpress-plugin
 * Plugin Name: MDM WP-Cornerstone
 * Plugin URI:  http://midwestfamilymarketing.com
 * Description: Site Specific Wordpress Functionality
 * Version:     1.0.0
 * Author:      Mid-West Family Marketing
 * Author URI:  http://midwestfamilymarketing.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: mdm_wp_cornerstone
 * Domain Path: /languages
 */

// If this file is called directly, abort
if ( !defined( 'WPINC' ) ) {
	die( 'Bugger Off Script Kiddies!' );
}

define( 'MDM_WP_CORNERSTONE_PLUGIN_FILE', __DIR__ . '/mdm-wp-cornerstone/index.php' );

/**
 * Register the autoloader
 * @since 1.0.0
 * @see http://php.net/manual/en/function.spl-autoload.php
 * @param (string) $className : Fully qualified classname, including namespace
 */
function mdm_wp_cornerstone_autoload_register( $className ) {
	// Check and make damned sure we're only loading things from this namespace
	if( strpos( $className, 'Mdm\Wp\Cornerstone' ) === false ) {
		return false;
	}
	// replace backslashes
	$className = strtolower( str_replace( '\\', '/', $className ) );
	// Ensure there is no slash at the beginning of the classname
	$className = ltrim( $className, '/' );
	// Replace some known constants
	$className = str_ireplace( 'Mdm/Wp/Cornerstone/', '', $className );
	// Append full path to class
	$path = sprintf( '%s/mdm-wp-cornerstone/includes/%s.php', plugin_dir_path( __FILE__ ), $className );
	// include the class...
	// include_once( $path );
	if( file_exists( $path ) ) {
		include_once( $path );
	}
}

function mdm_wp_cornerstone_run() {
	// If version is less than minimum, register notice
	if( version_compare( '5.3.0', phpversion(), '>=' ) ) {
		// Deactivate plugin
		deactivate_plugins( plugin_basename( __FILE__ ) );
		// Print message to user
		wp_die( 'Irks! MDM Ads Manager requires minimum PHP v5.3.0 to run. Please update your version of PHP.' );
	}
	// Register Autoloader
	spl_autoload_register( 'mdm_wp_cornerstone_autoload_register' );
	// Register activation hook
	register_activation_hook( __FILE__, array( '\\Mdm\\Wp\\Cornerstone\\Activator', 'activate' ) );
	// Register Admin Module
	call_user_func( array( '\\Mdm\\Wp\\Cornerstone\\Admin', 'register' ) );

	call_user_func( array( '\\Mdm\\Wp\\Cornerstone\\FLBuilder', 'register' ) );
	// Register Settings Module
	call_user_func( array( '\\Mdm\\Wp\\Cornerstone\\Settings', 'register' ) );
	// Register Customizer Module
	call_user_func( array( '\\Mdm\\Wp\\Cornerstone\\Customizer', 'register' ) );
	// Register Post Types Module
	call_user_func( array( '\\Mdm\\Wp\\Cornerstone\\Posts', 'register' ) );
	// Register Taxonomies Modules
	call_user_func( array( '\\Mdm\\Wp\\Cornerstone\\Taxonomies', 'register' ) );
	// Register Widgets Modules
	call_user_func( array( '\\Mdm\\Wp\\Cornerstone\\Widgets', 'register' ) );
	// Register Addons Module
	call_user_func( array( '\\Mdm\\Wp\\Cornerstone\\Addons', 'register' ) );
}
mdm_wp_cornerstone_run();
