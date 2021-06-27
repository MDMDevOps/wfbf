<?php

/**
 * Put all global archive filters here
 */
if( !function_exists( 'gsp_wrap_while' ) ) {
	function gsp_wrap_while() {
	    // Get the current filter
	    $current_filter = current_filter();
	    // Opening markup
	    if( $current_filter === 'genesis_before_while' ) {
	        genesis_markup( array( 'open' => '<div %s>', 'context' => 'archive-while-wrap' ) );
	    }
	    // Closing markup
	    else {
	        genesis_markup( array( 'close' => '</div>', 'context' => 'archive-while-wrap' ) );
	    }

	}
}



add_action( 'genesis_before_while', 'gsp_wrap_while', 999 );
add_action( 'genesis_after_endwhile', 'gsp_wrap_while', 1 );

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 8 );

// Remove author metabox...we add in an alternate meta box on archives
add_filter( 'get_the_author_genesis_author_box_archive', '__return_false' );

if( !function_exists( 'filter_custom_excerpt_length' ) ) {
	function filter_custom_excerpt_length( $length ) {
		return 30;
	}
}

add_filter( 'excerpt_length', 'filter_custom_excerpt_length', 999 );

// Force full width layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/**
 * Include archive templates
 */
// Empty template array
$templates = array();
// Inlude taxonomy template, such as templates/archive-category.php
if( is_tax() ) {
	$templates[] = sprintf( 'templates/archive-%s.php', get_queried_object()->taxonomy );
}
// Inlude date template, such as templates/archive-date.php
// Only has one option, archive-date.php
if( is_date() ) {
	$template[] = 'templates/archive-date.php';
}
// Include post type template, such as archive-testimonial.php
$templates[] = sprintf( 'templates/archive-%s.php', get_post_type() );
// Load each found template
locate_template( $templates, true );

