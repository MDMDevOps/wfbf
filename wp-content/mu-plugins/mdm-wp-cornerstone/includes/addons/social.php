<?php

/**
 * The plugin file that controls the social network functionality
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Mdm\Wp\Cornerstone\Addons;

class Social extends \Mdm\Wp\Cornerstone\Addons implements \Mdm\Wp\Cornerstone\Interfaces\Action_Hook_Subscriber, \Mdm\Wp\Cornerstone\Interfaces\Filter_Hook_Subscriber, \Mdm\Wp\Cornerstone\Interfaces\Shortcode_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		return array(
			array( 'social_links' => 'action_callback' ),
		);
	}

	/**
	 * Get the shortcode hooks this class subscribes to.
	 * @return array
	 */
	public static function get_shortcodes() {
		return array(
			array( 'social_links' => 'shortcode_callback' ),
		);
	}

	/**
	 * Get the filter hooks this class subscribes to.
	 * @return array
	 */
	public static function get_filters() {
		return array(
			array( 'mdm_wp_cornerstone_customizer_sections' => 'register_customizer_sections' ),
			array( 'mdm_wp_cornerstone_customizer_settings' => 'register_customizer_settings' ),
			array( 'mdm_wp_cornerstone_customizer_controls' => 'register_customizer_controls' ),
		);
	}

	public static function get_network_list() {
		$networks = array(
			'facebook' => array(
				'label'   => __( 'Facebook URI', 'mpress' ),
			),
			'twitter' => array(
				'label'   => __( 'Twitter URI', 'mpress' ),
			),
			'googleplus' => array(
				'label'   => __( 'Google Plus URI', 'mpress' ),
			),
			'youtube' => array(
				'label'   => __( 'Youtube URI', 'mpress' ),
			),
			'linkedin' => array(
				'label'   => __( 'Linkedin URI', 'mpress' ),
			),
			'pinterest' => array(
				'label'   => __( 'Pinterest URI', 'mpress' ),
			),
			'instagram' => array(
				'label'   => __( 'Instagram URI', 'mpress' ),
			),
			'snapchat' => array(
				'label'   => __( 'Snapchat URI', 'mpress' ),
			),
		);
		return apply_filters( 'mpress_social_networks', $networks );
	}

	public function register_customizer_sections( $sections ) {
		$sections['social'] = array(
			'cabability'  => 'edit_theme_options',
			'title'       => __( 'Social Networks', self::$name ),
			'description' => __( 'Set Social Network URI\'s', self::$name ) . ', use <code>[social_links]</code> to output.',
			'priority'    => 80,
		);
		return $sections;
	}


	public function register_customizer_settings( $settings ) {
		foreach( self::get_network_list() as $key => $network ) {
			$settings[$key] = array(
				'default'           => null,
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url_raw'
			);
		}
		return $settings;
	}


	public function register_customizer_controls( $controls ) {
		foreach( self::get_network_list() as $key => $network ) {
			$controls[ $key ] = array(
				'label'    => $network['label'],
				'section'  => sprintf( '%s_social', self::$name ),
				'type'     => 'text',
			);
		}
		return $controls;
	}

	public function get_social_markup( $text_class ) {
		// Get options
		$options = get_option( self::$name );
		// Open output
		$output = '';
		// loop through networks
		foreach( self::get_network_list() as $key => $network ) {
			// If option not set, or blank, we can bail
			if( !isset( $options[$key] ) || empty( $options[$key] ) ) {
				continue;
			}
			// Else append output
			$output .= sprintf( '<li class="social-link %1$s"><a href="%2$s" target="_blank" ref="noreferrer noopener">%3$s<span class="%4$s">%1$s</span></a></li>', $key, esc_url_raw( $options[$key] ), \Mdm\Wp\Cornerstone\Addons\Icons::get_icon_markup( $key ), $text_class );
		}
		return !empty( $output ) ? '<ul class="mdm-social-links">' . $output . '</ul>' : '';
	}

	public function shortcode_callback( $atts = array() ) {
		// Parse shortcode atts
		$atts = shortcode_atts( array( 'text_class' => 'screen-reader-text' ), $atts, 'social_links' );
		// Get markup
		return $this->get_social_markup( $atts['text_class'] );
	}

	public function action_callback( $args = array() ) {
		echo $this->shortcode_callback( $args );
	}

} // end class