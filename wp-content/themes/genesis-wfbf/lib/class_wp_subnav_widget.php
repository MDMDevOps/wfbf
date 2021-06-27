<?php
/**
 * Widget API: WP_Nav_Menu_Widget class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement the Navigation Menu widget.
 *
 * @since 3.0.0
 *
 * @see WP_Widget
 */
class WP_Sub_Nav_Menu_Widget extends WP_Widget {

	/**
	 * Sets up a new Navigation Menu widget instance.
	 *
	 * @since 3.0.0
	 */
	public function __construct() {
		$widget_ops = array(
			'description' => __( 'Add a sub navigation menu to your sidebar.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'sub_nav_menu', __('Sub Navigation Menu'), $widget_ops );
	}

	/**
	 * Outputs the content for the current Navigation Menu widget instance.
	 *
	 * @since 3.0.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Navigation Menu widget instance.
	 */
	public function widget( $args, $instance ) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$nav_menu_args = array(
			'fallback_cb' => '',
            'menu'        => $nav_menu,
            'menu_type'   => 'subpagenav',
		);

		/**
		 * Filters the arguments for the Navigation Menu widget.
		 *
		 * @since 4.2.0
		 * @since 4.4.0 Added the `$instance` parameter.
		 *
		 * @param array    $nav_menu_args {
		 *     An array of arguments passed to wp_nav_menu() to retrieve a navigation menu.
		 *
		 *     @type callable|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
		 *     @type mixed         $menu        Menu ID, slug, or name.
		 * }
		 * @param WP_Term  $nav_menu      Nav menu object for the current menu.
		 * @param array    $args          Display arguments for the current widget.
		 * @param array    $instance      Array of settings for the current widget.
		 */
		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Navigation Menu widget instance.
	 *
	 * @since 3.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		return $instance;
	}

	/**
	 * Outputs the settings form for the Navigation Menu widget.
	 *
	 * @since 3.0.0
	 *
	 * @param array $instance Current settings.
	 * @global WP_Customize_Manager $wp_customize
	 */
	public function form( $instance ) {
		global $wp_customize;
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ) ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
				<p class="edit-selected-nav-menu" style="<?php if ( ! $nav_menu ) { echo 'display: none;'; } ?>">
					<button type="button" class="button"><?php _e( 'Edit Menu' ) ?></button>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'WP_Sub_Nav_Menu_Widget' );
});

function wpse31748_exclude_menu_items( $menu_items, $args ) {
	$top_level = array();
	$sorted_menu_items = array();
	$top_level_id = null;
	$parents = array();
	// Iterate over the items to search and destroy
	if( !isset( $args->menu_type ) || $args->menu_type !== 'subpagenav' ) {
		return $menu_items;
	}

	// Loop over each
	foreach( $menu_items as $item ){
		// Check for top level items
		if( $item->menu_item_parent === '0' ){
			$top_level[] = $item;
			// Now Set ID for the next iteration
			if( $item->current === true || $item->current_item_ancestor === true || $item->current_item_parent === true ) {
				$sorted_menu_items[] = $item;
				$top_level_id = $item->ID;
				$parents[] = $item->ID;
				continue;
			}
			continue;
		}
		// Get the second level down
		if( $item->menu_item_parent === $top_level_id ) {
			$parents[] = $item->ID;
		}
		// Check each for a parent in the parents array
		if( in_array( $item->menu_item_parent, $parents ) ) {
			$parents[] = $item->ID;
			$sorted_menu_items[] = $item;
		}
	}
    return count( $sorted_menu_items ) <= 1 ? $top_level : $sorted_menu_items;
}

add_filter( 'wp_nav_menu_objects', 'wpse31748_exclude_menu_items', 10, 2 );
