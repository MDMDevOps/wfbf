<?php

namespace Mdm\Wp\Cornerstone;

class Addons extends \Mdm\Wp\Cornerstone\Common\Plugin implements \Mdm\Wp\Cornerstone\Interfaces\Action_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		return array(
			array( 'plugins_loaded' => 'register_addons' ),
		);
	}

	public static function register_addons() {
		// Get all addons
		$addons = self::get_child_classes();
		// Register each
		foreach( $addons as $addon ) {
			// Append namespace to addon
			$addon = '\\Mdm\\Wp\\Cornerstone\\Addons\\' . $addon;
			// Initialize addon
			$addon = $addon::register();
		}
	}
}