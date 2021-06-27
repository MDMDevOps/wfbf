<?php

/**
 * Fired during plugin activation
 *
 * This class defines all code necessary to run during the plugin's activation.
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Mdm\Wp\Cornerstone;

class Activator {

	/**
	 * Activate Plugin
	 *
	 * Register Post Types, Register Taxonomies, and Flush Permalinks
	 * @since 1.0.0
	 */
	public static function activate() {
		// Register post types
		self::register_post_types();
		// Register taxonomies
		self::register_taxonomies();
		// Flush rewrite rules
		self::flush_permalinks();
	}

	public static function register_post_types() {
		\Mdm\Wp\Cornerstone\Posts::add_post_types();
	}

	public static function register_taxonomies() {
		\Mdm\Wp\Cornerstone\Taxonomies::add_taxonomies();
	}

	public static function flush_permalinks() {
		global $wp_rewrite;
		$wp_rewrite->init();
		$wp_rewrite->flush_rules();
	}

} // end class