<?php

/**
 * The plugin file that controls the widget hooks
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Mdm\Wp\Cornerstone;

class Widgets extends \Mdm\Wp\Cornerstone\Common\Plugin implements \Mdm\Wp\Cornerstone\Interfaces\Action_Hook_Subscriber {

	protected static $widgets = array();

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		return array(
			array( 'widgets_init' => 'add_widgets' ),
		);
	}

	public function add_widgets() {
		// Get all widgets
		$widgets = self::get_child_classes();
		// Register each
		foreach( $widgets as $widget ) {
			// Append namespace to widget
			$widget = '\\Mdm\\Wp\\Cornerstone\\Widgets\\' . $widget;
			// Register with wordpress
			register_widget( $widget );
		}
	}
} // end class