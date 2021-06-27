<?php
/**
 * This file adds the Home Page to the Enterprise Pro Theme.
 *
 * @author StudioPress
 * @package Enterprise Pro
 * @subpackage Customizations
 */

add_action( 'genesis_meta', 'enterprise_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function enterprise_home_genesis_meta() {

	//* Force full-width-content layout setting
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	//* Add support for structural wraps, removing site innner
	add_theme_support( 'genesis-structural-wraps', array(
		'header',
		'nav',
		'subnav',
		// 'site-inner',
		'footer-widgets',
		'footer',
	) );

	//* Add enterprise-pro-home body class
	add_filter( 'body_class', 'enterprise_body_class' );

	// Readd actions to genesis_loop executed from wp_query_engine
	add_action( 'wp_query_engine_before_genesis_loop', 'wp_query_engine_add_actions' );

	// If using advanced custom fields
	if( class_exists( 'acf' ) ) {
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'acf_custom_loop' );
	}

}

function wp_query_engine_add_actions() {
	remove_action( 'genesis_loop', 'acf_custom_loop' );
	add_action( 'genesis_loop', 'genesis_do_loop' );

}

function acf_content_sections() {

	 if( have_rows('sections') ) : while( have_rows('sections') ) : the_row();

		do_action('acf_page_section', array( 'field' => 'sections' ) );

	endwhile; endif;
}

function enterprise_body_class( $classes ) {

		$classes[] = 'wfbf-home force-full-width';
		return $classes;

}

function acf_custom_loop() {

	if( have_rows('sections') ) :

		do_action( 'genesis_before_while' );

		printf( '<div id="page-content" %s>', genesis_attr( 'acf-page-content' ) );

		while( have_rows('sections') ) : the_row();

			do_action( 'genesis_before_entry' );


				do_action( 'genesis_before_entry_content' );

				do_action('acf_page_section', array( 'field' => 'sections' ) );

				do_action( 'genesis_after_entry_content' );

				do_action( 'genesis_entry_footer' );


			do_action( 'genesis_after_entry' );

		endwhile; // End of one post.

		echo '</div>';

		do_action( 'genesis_after_endwhile' );

	endif; // End loop.

}

genesis();
