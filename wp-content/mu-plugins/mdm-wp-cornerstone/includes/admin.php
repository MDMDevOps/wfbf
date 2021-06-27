<?php

/**
 * The plugin file that controls the admin functions
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Mdm\Wp\Cornerstone;

class Admin extends \Mdm\Wp\Cornerstone\Common\Plugin implements \Mdm\Wp\Cornerstone\Interfaces\Action_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		// Add a default wordpress action
		add_action( 'custom_menu_order', '__return_true' );
		// Return our custom actions
		return array(
			array( 'admin_menu' => 'add_admin_pages' ),
			array( 'admin_head' => 'print_debug_styles' ),
			array( 'admin_enqueue_scripts' => 'enqueue_scripts' ),
			array( 'admin_enqueue_scripts' => 'enqueue_styles' ),
			array( 'menu_order' => 'reorder_admin_menu' ),
		);
	}

	public function enqueue_scripts() {
		// Register all public scripts, including dependencies
		wp_register_script( sprintf( '%s_admin', self::$name ), self::url( 'scripts/dist/admin.min.js' ), array( 'jquery' ), self::$version, true );
		// Enqueue public script
		wp_enqueue_script( sprintf( '%s_admin', self::$name ) );
		// Localize public script
		wp_localize_script( sprintf( '%s_admin', self::$name ), self::$name, array( 'wpajaxurl' => admin_url( 'admin-ajax.php') ) );
	}

	public function enqueue_styles() {
		// Register font awesome
		wp_register_style( 'fontAwesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all' );
		// Enqueue font awesome
		wp_enqueue_style( 'fontAwesome' );
		// Register admin styles
		wp_register_style( sprintf( '%s_admin', self::$name ), self::url( 'styles/dist/admin.min.css' ), array( 'fontAwesome' ), self::$version, 'all' );
		// Enqueue admin style
		wp_enqueue_style(  sprintf( '%s_admin', self::$name ) );
	}

	public function print_debug_styles() {
		echo '<style>.xdebug-var-dump{margin-left:200px;}</style>';
	}

	public function add_admin_pages() {
		add_options_page( __( 'Cornerstone', self::$name ), __( 'Cornerstone', self::$name ), 'manage_options', self::$name, array( $this, 'display_admin_page' ) );
	}

	public function display_admin_page() {
		// Get Admin Page Tabs
		$tabs = $this->get_admin_page_tabs();
		// Get current tab name
		$current = isset( $_GET['tab'] ) && !empty( $_GET['tab'] ) ? $_GET['tab'] : key( $tabs );
		// Make sure tab name exists in our tab list
		$current = isset( $tabs[$current] ) ? $current : key( $tabs );
		// Start output
		echo '<div class="wrap">';
			// Begin output
			echo '<h2 class="nav-tab-wrapper">';
			foreach( $tabs as $tab => $args ) {
				// Set the class of the tab
				$class = ( $current === $tab ) ? 'nav-tab nav-tab-active' : 'nav-tab';
				// Append tab markup
				echo sprintf( '<a class="%s" href="?page=%s&tab=%s">%s</a>', $class, self::$name, urlencode($tab), $tab );
			}
			echo '</h2>';
			// // Display page content
			if( file_exists( $tabs[$current]['path'] ) ) {
				include $tabs[$current]['path'];
			}
		echo '</div>';
	}

	private function get_admin_page_tabs() {
		$tabs = array(
			'Settings'    => array(),
			'LOG'           => array(),
			'Documentation' => array(),
		);
		// Apply filters so other modules can add additional tabs
		$tabs = (array)apply_filters( sprintf( '%s_admin_page_tabs', self::$name ), $tabs );
		// Clean up array structure
		foreach( $tabs as $tab => $args ) {
			// Define default structure
			$default = array(
				'slug'     => null,
				'priority' => 5,
				'path'     => null,
			);
			$tabs[$tab] = array_merge( $default, (array)$args );
			// Do slug correction
			$tabs[$tab]['slug'] = !empty( $args['slug'] ) ? $args['slug'] : trim( str_replace( ' ', '_', strtolower( $tab ) ) );
			// Do path correction
			$tabs[$tab]['path'] = !empty( $args['path'] ) ? $args['path'] : self::path( sprintf( 'partials/pages/%s.php', $tabs[$tab]['slug'] ) );
		}
		// Sort tabs
		uasort( $tabs, array( $this, 'priority_sort' ) );
		// Finally, return
		return $tabs;

	}

	public function priority_sort( $a, $b ) {
		/**
		 * 1 : If both have equal priority, return 0
		 */
		if( $a['priority'] === $b['priority'] ) {
			return 0;
		}

		/**
		 * 2 : return value based on which is larger
		 */
		return ( $a['priority'] < $b['priority'] ) ? -1 : 1;
	}

	public function reorder_admin_menu( $menu_items ) {
		// Our top level items
		$top_level = array();
		// Post Types
		$post_types = array();
		// Secondary
		$secondary = array();
		// Woocommerce
		$woo = array();
		// Our bottom level items
		$bottom_level = array();
		// And our penalty box...known that we want last
		$penalty_box = array();
		// Loop over each item
		foreach( $menu_items as $menu_item ) {
			// var_dump($menu_item);
			// 'edit.php?post_type=product'
			// 'edit.php?post_type=product'
			// woocommerce
			// 'wc-admin&path=/analytics/revenue'
			// 'separator-woocommerce'
			/**
			 * Known offenders that we want to stick as low as possible
			 */
			if( in_array( $menu_item, array( 'jetpack', 'genesis', 'edit.php?post_type=fl-builder-template', 'video-user-manuals/plugin.php', 'edit.php?post_type=acf-field-group', 'googlesitekit-dashboard' ) ) ) {
				$penalty_box[] = $menu_item;
				// 'woocommerce',
				// https://wiid.mdmserver.us/wp-admin/edit.php?post_type=acf-field-group
			}
			/**
			 * Woocommerce
			 */
			else if( is_plugin_active( 'woocommerce/woocommerce.php' ) && in_array( $menu_item, array( 'edit.php?post_type=product', 'woocommerce', 'separator-woocommerce', 'wc-admin&path=/analytics/revenue' ) ) ) {
				if( $menu_item === 'separator-woocommerce' ) {
					array_unshift( $woo, $menu_item );
				}
				else if( in_array( $menu_item, array( 'edit.php?post_type=product', 'woocommerce', 'wc-admin&path=/analytics/revenue' ) ) ) {
					$woo[] = $menu_item;
				}
			}
			/**
			 * Our top level items
			 * Dashboard, and the first seperator
			 */
			else if( in_array( $menu_item, array( 'index.php', 'separator1' ) ) ) {
				$top_level[] = $menu_item;
			}
			/**
			 * Content related items
			 * anything that starts with edit.php and not already in another area
			 * Nested pages plugin is whitelisted for this section
			 */
			else if( strripos( $menu_item , 'edit.php' ) !== false || $menu_item === 'nestedpages' ) {
				$post_types[] = $menu_item;
			}
			/**
			 * Secondary items
			 */
			else if( in_array( $menu_item, array( 'upload.php', 'gf_edit_forms', 'edit-comments.php' ) ) ) {
				$secondary[] = $menu_item;
			}
			/**
			 * Everything else
			 * Contains settings, users, appearence, etc.
			 */
			else {
				$bottom_level[] = $menu_item;
			}
		}
		// var_dump($post_types);
		// Mush it all together in a new order, and send it back
		return array_merge( $top_level, $post_types, $secondary, $woo, $bottom_level, $penalty_box );
	}

} // end class