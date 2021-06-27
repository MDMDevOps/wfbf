<?php

/**
 * Add additional query_engine templates
 */
function add_wpcl_query_engine_templates( $templates = array() ) {
	// Array of new templates
	$new_templates = array(
		'Homepage Featured Posts' => get_stylesheet_directory() . '/templates/wp_query_homepage_featured_posts.php',
		'Blog Page Posts' => get_stylesheet_directory() . '/templates/wp_query_blog_page_posts.php',
	);
	return array_merge( $templates, $new_templates );
}
add_filter( 'wpcl_query_engine_templates', 'add_wpcl_query_engine_templates' );
add_filter( 'wp_query_engine_templates', 'add_wpcl_query_engine_templates' );