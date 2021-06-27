<?php

namespace Mdm\Wp\Cornerstone;

class FLBuilder extends \Mdm\Wp\Cornerstone\Common\Plugin implements \Mdm\Wp\Cornerstone\Interfaces\Action_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		return array(
			array( 'init' => 'register_modules' ),
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

	/**
	 * Register custom beaver builder modules
	 */
	public static function register_modules() {

		if( !class_exists( 'FLBuilder' ) ) {
			return false;
		}

		\Mdm\Wp\Cornerstone\FLBuilder\CSBlockQuote\CSBlockQuote::register();
	}
}