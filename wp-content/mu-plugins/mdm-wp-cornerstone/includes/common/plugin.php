<?php

/**
 * The main plugin file definition
 * This file isn't instatiated directly, it acts as a shared parent for other classes
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package wp_ads_manager
 */

namespace Mdm\Wp\Cornerstone\Common;

class Plugin {

	/**
	 * Plugin Name
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $name : The unique identifier for this plugin
	 */
	protected static $name;

	/**
	 * Plugin Version
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $version : The version number of the plugin, used to version scripts / styles
	 */
	protected static $version;

	/**
	 * Plugin Path
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $path : The path to the plugins location on the server, is inherited by child classes
	 */
	protected static $path;

	/**
	 * Plugin URL
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $url : The URL path to the location on the web, accessible by a browser
	 */
	protected static $url;

	/**
	 * Plugin Slug
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $slug : Basename of the plugin, needed for Wordpress to set transients, and udpates
	 */
	protected static $slug;

	/**
	 * Plugin Options
	 * @since 1.0.0
	 * @access protected
	 * @var (array) $settings : The array that holds plugin options
	 */
	protected $loader;

	/**
	 * Registers our plugin with WordPress.
	 */
	public static function register() {
		// Get called class
		$className = get_called_class();
		// Instantiate class
		$class = new $className();
		// Create API manager
		$class->loader = \Mdm\Wp\Cornerstone\Loader::get_instance();
		// Register stuff
		$class->loader->register( $class );
		// Set fields
		$class->set_fields();
		// Return instance
		return $class;
	}

	/**
	 * Constructor
	 * @since 1.0.0
	 */
	public function __construct() {
		// Nothing to do here by default
	}

	/**
	 * Set Plugin Fields
	 * @since 1.0.0
	 */
	public function set_fields() {
		self::$version = '1.0.1';
		self::$name  = 'mdm_wp_cornerstone';
		self::$path = plugin_dir_path( MDM_WP_CORNERSTONE_PLUGIN_FILE );
		self::$url  = plugin_dir_url( MDM_WP_CORNERSTONE_PLUGIN_FILE );
		self::$slug = plugin_basename( MDM_WP_CORNERSTONE_PLUGIN_FILE );
	}

	/**
	 * Helper function to use relative URLs
	 * @since 1.0.0
	 * @access protected
	 */
	protected static function url( $url = '' ) {
		return self::$url . ltrim( $url, '/' );
	}

	/**
	 * Helper function to use relative paths
	 * @since 1.0.0
	 * @access protected
	 */
	protected static function path( $path = '' ) {
		return self::$path . ltrim( $path, '/' );
	}

	/**
	 * Helper function to print debugging statements to the window
	 * @since 1.0.0
	 * @access protected
	 */
	protected static function expose( $expression ) {
		echo '<pre class="expose">';
		print_r( $expression );
		echo '</pre>';
	}

	protected static function get_child_classes( $path = null ) {
		// Try to create path from called class if no path is passed in
		if( empty( $path ) ) {
			// Use ReflectionClass to get the shortname
			$reflection = new \ReflectionClass( get_called_class() );
			// Attempt to construct to path
			$path = self::path( sprintf( 'includes/%s/', strtolower( $reflection->getShortName() ) ) );
		}
		// Bail if our path is not a directory
		if( !is_dir( $path ) ) {
			return array();
		}
		// Empty array to hold post types
		$classes = array();
		// Get all files in directory
		$files = scandir( $path );

		// If empty, we can bail
		if( !is_array( $files ) || empty( $files ) ) {
			return array();
		}
		// Iterate over all found files
		foreach( $files as $file ) {
			if( strpos( $file, '.php' ) === false ) {
				continue;
			}
			$classes[] = str_replace( '.php', '', $file );
		}
		// Return child classes;
		return $classes;
	}

} // end class