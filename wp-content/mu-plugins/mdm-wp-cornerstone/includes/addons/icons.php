<?php

/**
 * The plugin file that controls the frontend (public) output
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Mdm\Wp\Cornerstone\Addons;

class Icons extends \Mdm\Wp\Cornerstone\Addons implements \Mdm\Wp\Cornerstone\Interfaces\Shortcode_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		return array(
			array( 'icon' => 'action_callback' ),
		);
	}

	/**
	 * Get the shortcode hooks this class subscribes to.
	 * @return array
	 */
	public static function get_shortcodes() {
		return array(
			array( 'icon' => 'shortcode_callback' ),
		);
	}

	public static function get_icon_markup( $icon_name = null ) {
		// If no icon request is passed in, just bail
		if( !$icon_name ) {
			return false;
		}
		// Define preset icons
		$icons = array(
			'twitter'         => 'fa fa-twitter',
			'facebook'        => 'fa fa-facebook',
			'googleplus'      => 'fa fa-google-plus',
			'youtube'         => 'fa fa-youtube',
			'pinterest'       => 'fa fa-pinterest',
			'linkedin'        => 'fa fa-linkedin',
			'instagram'       => 'fa fa-instagram',
			'snapchat'        => 'fa fa-snapchat-ghost',
		);
		// Allow child themes / plugins / etc to manipulate icon classes
		$icons = apply_filters( 'mdm_wp_cornerstone_icons', $icons );
		// Set icon class
		$icon_class = isset( $icons[ trim( strtolower( $icon_name ) ) ] ) ? esc_attr( $icons[ trim( strtolower( $icon_name ) ) ] ) : trim( esc_attr( $icon_name ) );
		// Return formed markup
		return sprintf( '<span class="icon %s" aria-hidden="true"></span>', $icon_class );
	}

	public function shortcode_callback( $atts = array() ) {
		return self::get_icon( $atts );
	}

	public static function get_icon( $atts = array() ) {
		// Parse shortcode atts
		$atts = shortcode_atts( array( 'name' => null ), $atts, 'icon' );
		// Return result
		return self::get_icon_markup( $atts['name'] );
	}

	public function action_callback( $args = array() ) {
		echo self::get_icon( $args );
	}

} // end class