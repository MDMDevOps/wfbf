<?php

/**
 * The plugin file that controls the admin functions
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Mdm\Wp\Cornerstone;

class Settings extends \Mdm\Wp\Cornerstone\Common\Plugin implements \Mdm\Wp\Cornerstone\Interfaces\Action_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		return array(
			array( 'admin_init' => 'register_settings' ),
			array( 'updated_option' => array( 'update_permalinks', 10, 3 ) ),
		);
	}

	/**
	 * After settings update, we need to update permalinks, flush rewrite rules, etc
	 */
	public function update_permalinks( $option, $old_settings, $new_settings ) {
		if( $option === self::$name ) {
			\Mdm\Wp\Cornerstone\Activator::activate();
		}
	}

	public static function get_settings() {
		// Get settings from database
		$settings = get_option( self::$name, array() );
		// Get all fields
		$fields = self::get_fields();
		// cycle through as make sure we have values for each
		foreach( $fields as $field => $args ) {
			// Special handling for groups
			if( $args['type'] === 'group' ) {
				foreach( $args['fields'] as $subfield_name => $subfield_args ) {
					if( isset( $settings[$field][$subfield_name] ) ) {
						continue;
					}
					// Else set default value
					$settings[$field][$subfield_name] = null;
				}
			} else {
				$settings[$field] = isset( $settings[$field] ) ? $settings[$field] : null;
			}
		}
		return $settings;
	}

	/**
	 * Get settings fields
	 * @since 1.0.0
	 * @access private
	 */
	private static function get_fields() {
		$fields = array(
			'post_types' => array(
				'title' => __( 'Post Types', self::$name ),
				'type' => 'group',
				'before' => '<ul>',
				'after' => '</ul>',
				'fields' => array(),
			),
			'taxonomies' => array(
				'title' => __( 'Taxonomies', self::$name ),
				'type' => 'group',
				'before' => '<ul>',
				'after' => '</ul>',
				'fields' => array(),
			),
			// 'addons' => array(
			// 	'title' => __( 'Addons', self::$name ),
			// 	'type' => 'group',
			// 	'before' => '<ul>',
			// 	'after' => '</ul>',
			// 	'fields' => array(),
			// ),
		);
		// Get all post types
		$post_types = self::get_child_classes( self::path( 'includes/posts/' ) );
		// Add post types
		foreach( $post_types as $post_type ) {
			$fields['post_types']['fields'][$post_type] = array(
					'type'     => 'checkbox',
					'field_id' => sprintf( '%s[post_types][%s]', self::$name, $post_type ),
					'label'    => $post_type,
					'before'       => '<li>',
					'after'        => '</li>',
			);
		}
		// Get all taxonomies
		$taxonomies = self::get_child_classes( self::path( 'includes/taxonomies/' ) );
		// Add taxonimies
		foreach( $taxonomies as $taxonomy ) {
			$fields['taxonomies']['fields'][$taxonomy] = array(
					'type'     => 'checkbox',
					'field_id' => sprintf( '%s[taxonomies][%s]', self::$name, $taxonomy ),
					'label'    => $taxonomy,
					'before'       => '<li>',
					'after'        => '</li>',
			);
		}
		// // Get all addons
		// $addons = self::get_child_classes( self::path( 'includes/addons/' ) );
		// // Add addons
		// foreach( $addons as $addon ) {
		// 	$fields['addons']['fields'][$addon] = array(
		// 			'type'     => 'checkbox',
		// 			'field_id' => sprintf( '%s[addons][%s]', self::$name, $addon ),
		// 			'label'    => $addon,
		// 			'before'       => '<li>',
		// 			'after'        => '</li>',
		// 	);
		// }
		return $fields;
	}

	/**
	 * Register plugin settings with WordPress
	 * @since 1.0.0
	 * @see https://codex.wordpress.org/Function_Reference/register_setting
	 * @see https://codex.wordpress.org/Function_Reference/add_settings_section
	 * @see https://codex.wordpress.org/Function_Reference/add_settings_field
	 */
	public function register_settings() {

		$fields   = $this->get_fields();

		$settings = $this->get_settings();

		register_setting( self::$name, self::$name );

		add_settings_section( self::$name, 'Settings', null, self::$name );
		// Cycle through fields, and register each
		foreach( $fields as $name => $field ) {
			// Construct some extra arguments
			if( $field['type'] === 'group' ) {
				foreach( $field['fields'] as $subfield_name => $subfield ) {
					$field['fields'][$subfield_name]['value'] = $settings[$name][$subfield_name];
				}
			} else {
				$field['value']   = $settings[$name];
			}
			// Add setting
			add_settings_field( $name, $field['title'], array( $this, 'display_field' ), self::$name, self::$name, $field );
		}
	}

	public function display_field( $field ) {
		// Display before text
		if( isset( $field['before'] ) && !empty( $field['before'] ) ) {
			echo $field['before'];
		}
		// Recursively add group fields
		if( $field['type'] === 'group' ) {
			foreach( $field['fields'] as $single ) {
				$this->display_field( $single );
			}
		} else {
			include self::path( sprintf( 'partials/inputs/%s.php', $field['type'] ) );
		}
		// Display after text
		if( isset( $field['after'] ) && !empty( $field['after'] ) ) {
			echo $field['after'];
		}
	}

} // end class