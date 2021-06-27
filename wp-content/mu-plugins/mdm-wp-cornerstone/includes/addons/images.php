<?php

/**
 * The plugin file that controls the social network functionality
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Mdm\Wp\Cornerstone\Addons;

class Images extends \Mdm\Wp\Cornerstone\Addons implements \Mdm\Wp\Cornerstone\Interfaces\Filter_Hook_Subscriber {

	/**
	 * Get the filter hooks this class subscribes to.
	 * @return array
	 */
	public static function get_filters() {
		return array(
			array( 'mdm_wp_cornerstone_customizer_settings' => 'register_customizer_settings' ),
			array( 'mdm_wp_cornerstone_customizer_controls' => 'register_customizer_controls' ),
		);
	}

	public function register_customizer_settings( $settings ) {
		$settings['featured_image'] = array(
			'default'           => null,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
		);
		return $settings;
	}


	public function register_customizer_controls( $controls ) {
		$controls['featured_image'] = array(
			'label'    => 'Default Featured Image',
			'section'  => 'genesis_archives',
			'type'     => 'image',
			'wp_customize_control' => 'WP_Customize_Image_Control',
		);
		return $controls;
	}

} // end class