<?php

/**
 * Override custom post type archive permalink
 *
 * If a page exists with the same rewrite slug as the post type archive, prefer
 * the page over the archive. This allows us to control content on that URL
 */
if( !function_exists( 'post_type_parmalink_override' ) ) {
	function post_type_parmalink_override( $args, $post_type ) {
		// If already false, we can bail...
		if( $args['has_archive'] === false || $args['rewrite'] === false || $args['publicly_queryable'] === false ) {
			return $args;
		}
		// Get rewrite slug
		$rewrite = isset( $args['rewrite']['slug'] ) ? $args['rewrite']['slug'] : $post_type;
		// Check for the existance of a page with the same rewrite slug
		$page = get_page_by_path( $rewrite , OBJECT );
		// Check for transient
		$transient = get_transient( sprintf( '%s_permalink_override', $rewrite ) );
		// If we are going to override the page
		if( !is_null( $page ) ) {
			// Set archives to false
			$args['has_archive'] = false;
			// var_dump($transient);
			if( intval( $transient ) !== $page->ID ) {
				// Flush permalinks
				flush_rewrite_rules();
				// Set transient so we don't have to flush again
				set_transient( sprintf( '%s_permalink_override', $rewrite), $page->ID, YEAR_IN_SECONDS );
			}
		}
		// Else if we don't have a page, did we just delete it?
		else if( $transient !== false ) {
			// Flush permalinks
			flush_rewrite_rules();
			// Remove transient so we don't have to do this again
			delete_transient( sprintf( '%s_permalink_override', $rewrite) );
		}
		return $args;
	}
	add_filter( 'register_post_type_args', 'post_type_parmalink_override', 20, 2 );
}
