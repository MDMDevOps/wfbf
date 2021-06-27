<?php

// Remove jumbotron action
remove_action( 'genesis_after_header', 'gsp_do_jumbotron' );

function remove_frontpage_title() {
	if( is_main_query() ) {
		remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	} else {
		// Re-add all of our main actions
		add_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
		add_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		add_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
		add_action( 'genesis_entry_header', 'genesis_do_post_title' );
		add_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	}
}
add_action( 'genesis_loop', 'remove_frontpage_title' );
