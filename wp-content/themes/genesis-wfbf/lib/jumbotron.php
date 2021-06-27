<?php

// function gsp_do_jumbotron() {
// 	// Open markup
// 	genesis_markup( array( 'open' => '<section %s>', 'context' => 'jumbotron' ) );
// 	// Do wrapper
// 	genesis_markup( array( 'open' => '<div %s>', 'context' => 'jumbotron-inner' ) );
// 	// Do before content
// 	do_action( 'gsp_jumbotron_before_content' );
// 	// Do content
// 	do_action( 'gsp_jumbotron_content' );
// 	// Do before content
// 	do_action( 'gsp_jumbotron_after_content' );
// 	// Close wrapper
// 	genesis_markup( array( 'close' => '</div>', 'context' => 'jumbotron-inner' ) );
// 	// Closed markup
// 	genesis_markup( array( 'close' => '</section>', 'context' => 'jumbotron' ) );
// }
// add_action( 'genesis_after_header', 'gsp_do_jumbotron' );

// function gsp_jumbotron_move_headlines() {
// 	// On singular pages, we just need to add the post title
// 	if( is_singular() ) {
// 		// Remove the post title from entry-header
// 		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
// 		// Do the post title at jumbotron content
// 		add_action( 'gsp_jumbotron_content', 'genesis_do_post_title' );
// 	}
// 	// Handle search specific actions
// 	else if( is_search() ) {
// 		remove_action( 'genesis_before_loop', 'genesis_do_search_title' );
// 		add_action( 'gsp_jumbotron_content', 'genesis_do_search_title' );
// 	}
// 	// Otherwise, if it's before content, we need to add our actions
// 	if( current_filter() === 'gsp_jumbotron_before_content' ) {
// 		// Add all fo our archive heading / description
// 		add_action( 'gsp_jumbotron_content', 'genesis_do_cpt_archive_title_description' );
// 		add_action( 'gsp_jumbotron_content', 'genesis_do_posts_page_heading' );
// 		add_action( 'gsp_jumbotron_content', 'genesis_do_date_archive_title' );
// 		add_action( 'gsp_jumbotron_content', 'genesis_do_taxonomy_title_description', 15 );
// 		add_action( 'gsp_jumbotron_content', 'genesis_do_author_title_description', 15 );
// 		add_action( 'gsp_jumbotron_content', 'genesis_do_blog_template_heading' );
// 		// Remove the intro text for this spot only
// 		add_filter( 'genesis_term_intro_text_output', '__return_false' );
// 		// Remove the wrappers
// 		remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_open', 5, 3 );
// 		remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_close', 15, 3 );

// 	}
// 	// Remove the filter after it has ran
// 	else if( current_filter() === 'gsp_jumbotron_after_content' ) {
// 		remove_filter( 'genesis_term_intro_text_output', '__return_false' );
// 		// Remove titles from normal intro area
// 		remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_headline', 10, 3 );
// 		// Re-add the wrappers
// 		add_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_open', 5, 3 );
// 		add_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_close', 15, 3 );
// 	}
// }
// add_action( 'gsp_jumbotron_before_content', 'gsp_jumbotron_move_headlines' );
// add_action( 'gsp_jumbotron_after_content', 'gsp_jumbotron_move_headlines' );

// function gsp_cleanup_search_title_markup( $markup ) {
// 	// Replace opening div
// 	$markup = str_replace( '<div class="archive-description">', '', $markup );
// 	// Replace closing div
// 	$markup = str_replace( '</div>', '', $markup );
// 	return $markup;
// }
// add_filter( 'genesis_search_title_output', 'gsp_cleanup_search_title_markup' );






function gsp_do_jumbotron() {
	// First action
	do_action( 'gsp_jumbotron_before' );
	// Open markup
	genesis_markup( array( 'open' => '<section %s>', 'context' => 'jumbotron-area' ) );
	// Do inner wrapper
	genesis_markup( array( 'open' => '<div %s>', 'context' => 'jumbotron-area-inner' ) );
	// Do structural wrap
	genesis_structural_wrap( 'jumbotron' );
	// Do before content
	do_action( 'gsp_jumbotron_before_content' );
	// Do content
	do_action( 'gsp_jumbotron_content' );
	// Do before content
	do_action( 'gsp_jumbotron_after_content' );
	// Close structural wrap
	genesis_structural_wrap( 'jumbotron', 'close' );
	// Close wrapper
	genesis_markup( array( 'close' => '</div>', 'context' => 'jumbotron-area-inner' ) );
	// Closed markup
	genesis_markup( array( 'close' => '</section>', 'context' => 'jumbotron-area' ) );
	// Do final action
	do_action( 'gsp_jumbotron_after' );
}
add_action( 'genesis_after_header', 'gsp_do_jumbotron' );

function reposition_post_info() {
	if( is_singular() ) {
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		add_action( 'gsp_jumbotron_content', 'genesis_post_info', 12 );
	}
}
add_action( 'wp', 'reposition_post_info' );

function gsp_jumbotron_move_headlines() {

	// On singular pages, we just need to add the post title
	if( is_singular() ) {
		// Remove the post title from entry-header
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		// Do the post title at jumbotron content
		add_action( 'gsp_jumbotron_content', 'genesis_do_post_title' );
	}
	// Handle search specific actions
	else if( is_search() ) {
		remove_action( 'genesis_before_loop', 'genesis_do_search_title' );
		add_action( 'gsp_jumbotron_content', 'genesis_do_search_title' );
	}
	// Otherwise, if it's before content, we need to add our actions
	else if( current_filter() === 'gsp_jumbotron_before' ) {
		// Add all fo our archive heading / description
		add_action( 'gsp_jumbotron_content', 'genesis_do_cpt_archive_title_description' );
		add_action( 'gsp_jumbotron_content', 'genesis_do_posts_page_heading' );
		add_action( 'gsp_jumbotron_content', 'genesis_do_date_archive_title' );
		add_action( 'gsp_jumbotron_content', 'genesis_do_taxonomy_title_description', 15 );
		add_action( 'gsp_jumbotron_content', 'genesis_do_author_title_description', 15 );
		add_action( 'gsp_jumbotron_content', 'genesis_do_blog_template_heading' );
		// Remove the intro text for this spot only
		add_filter( 'genesis_term_intro_text_output', '__return_false' );
		add_filter( 'genesis_author_intro_text_output', '__return_false' );
		add_filter( 'genesis_cpt_archive_intro_text_output', '__return_false' );

		// Remove the wrappers
		remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_open', 5, 3 );
		remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_close', 15, 3 );

	}
	// Remove the filter after it has ran
	else if( current_filter() === 'gsp_jumbotron_after' ) {
		remove_filter( 'genesis_term_intro_text_output', '__return_false' );
		remove_filter( 'genesis_author_intro_text_output', '__return_false' );
		remove_filter( 'genesis_cpt_archive_intro_text_output', '__return_false' );
		// Remove titles from normal intro area
		remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_headline', 10, 3 );

		// Re-add the wrappers
		add_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_open', 5, 3 );
		add_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_close', 15, 3 );
	}
}
add_action( 'gsp_jumbotron_before', 'gsp_jumbotron_move_headlines' );
add_action( 'gsp_jumbotron_after', 'gsp_jumbotron_move_headlines' );

