<?php

namespace Mdm\Wp\Cornerstone;

class Posts extends \Mdm\Wp\Cornerstone\Common\Plugin implements \Mdm\Wp\Cornerstone\Interfaces\Action_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		return array(
			array( 'init' => 'add_post_types' ),
		);
	}

	public static function add_post_types() {
		// Get all post types
		$post_types = self::get_child_classes();
		// Get settings
		$settings = \Mdm\Wp\Cornerstone\Settings::get_settings();
		// Loop through each post type
		foreach( $post_types as $post_type ) {
			// If this post type is turned off, don't register it.
			if( !isset( $settings['post_types'][$post_type] ) || $settings['post_types'][$post_type] !== 'on' ) {
				continue;
			}
			// Append namespace to post type
			$class = '\\Mdm\\Wp\\Cornerstone\\Posts\\' . $post_type;
			// Initialize post type
			$pt = $class::register();
			// Register with wordpress
			register_post_type( $post_type, $pt::get_post_type_args() );
		}
	}

	public static function get_post_types() {
		return self::get_child_classes();
	}
}