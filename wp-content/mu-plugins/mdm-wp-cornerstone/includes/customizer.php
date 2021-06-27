<?php

/**
 * The plugin file that controls the customizer
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Mdm\Wp\Cornerstone;

class Customizer extends \Mdm\Wp\Cornerstone\Common\Plugin implements \Mdm\Wp\Cornerstone\Interfaces\Action_Hook_Subscriber {

	public static function get_actions() {
			return array(
				array( 'customize_register' => 'register_panels' ),
				array( 'customize_register' => 'register_sections' ),
				array( 'customize_register' => 'register_settings' ),
				array( 'customize_register' => 'register_controls' ),
				array( 'customize_preview_init' => 'register_scripts' ),
			);
		}

		/**
		 * Register / Enqueue Script(s)
		 * @since version 2.0.0
		 * @see https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
		 * @see https://developer.wordpress.org/reference/functions/wp_localize_script
		 */
		public function register_scripts() {
			wp_register_script( sprintf( '%s_customizer', self::$name ), self::url( 'scripts/dist/customizer.min.js' ), array( 'jquery' ), self::$version, false );
			wp_enqueue_script( sprintf( '%s_customizer', self::$name ) );
		}

		public function register_panels( $wp_customize ) {
			foreach( $this->get_panels() as $key => $panel ) {
				// Setup defaults
				$defaults = array(
					'priority'       => 5,
					'capability'     => 'edit_theme_options',
					'title'          => null,
				);
				// Merge defaults
				$panel = wp_parse_args( $panel, $defaults );
				// Add Panel
				$wp_customize->add_panel( sprintf( 'mdm_wp_cornerstone[%s]' ,$key ), $panel );
			}
		}

		public function register_sections( $wp_customize ) {
			foreach( $this->get_sections() as $key => $section ) {
				// Setup defaults
				$defaults = array(
					'cabability'  => 'edit_theme_options',
					'title'       => null,
					'description' => null,
					'priority'    => 5,
				);
				// Merge defaults
				$section = wp_parse_args( $section, $defaults );
				// Add Section
				$wp_customize->add_section( sprintf( 'mdm_wp_cornerstone_%s', $key ), $section );
			}
		}

		public function register_settings( $wp_customize ) {
			// var_dump($this->get_settings());
			foreach( $this->get_settings() as $key => $setting ) {
				// Setup defaults
				$defaults = array(
					'default'           => null,
					'type'              => 'theme_mod',
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage',
					'sanitize_callback' => 'sanitize_text_field',
				);
				// Merge defaults
				$setting = wp_parse_args( $setting, $defaults );
				// var_dump($setting);
				// Add Setting
				$wp_customize->add_setting( sprintf( 'mdm_wp_cornerstone[%s]' ,$key ), $setting );
			}
		}

		public function register_controls( $wp_customize ) {
			foreach( $this->get_controls() as $key => $control ) {
				// Setup defaults
				$defaults = array(
					'label'                => null,
					'description'          => null,
					'section'              => null,
					// 'setting'              => null,
					'type'                 => 'text',
					'priority'             => 50,
					'wp_customize_control' => 'WP_Customize_Control',
				);
				// Merge defaults
				$control = wp_parse_args( $control, $defaults );
				// Add Control
				$wp_customize->add_control( new $control['wp_customize_control']( $wp_customize, sprintf( 'mdm_wp_cornerstone[%s]' ,$key ), $control ) );
			}
		}

		private function get_panels() {
			// Define panels
			$panels = array();
			// Apply filters
			return apply_filters( 'mdm_wp_cornerstone_customizer_panels', $panels );
		}

		private function get_sections() {
			// Define sections
			$sections = array();
			// Apply filters
			return apply_filters( 'mdm_wp_cornerstone_customizer_sections', $sections );
		}

		private function get_settings() {
			// Define settings
			$settings = array();
			// Apply filters
			return apply_filters( 'mdm_wp_cornerstone_customizer_settings', $settings );
		}

		private function get_controls() {
			// Define controls
			$controls = array();
			// Apply filters
			return apply_filters( 'mdm_wp_cornerstone_customizer_controls', $controls );
		}

		public function output_styles() {
			$output  = '<style id="mdm_wp_cornerstone">';
			$output .= apply_filters( 'mdm_wp_cornerstone_customizer_styles', '' );
			$output .= '</style>';
			echo $output;
		}

		/**
		 * Sanitize checkbox values
		 * @since 1.0.0
		 */
		public static function sanitize_checkbox( $input ) {
			if ( $input ) {
				$output = true;
			} else {
				$output = false;
			}
			return $output;
		}

} // end class