<?php

// Inlcude the archive settings
include_once( get_stylesheet_directory() . '/lib/archives.php' );

/**
 * Filters / actions specific to the post (blog) page
 */
function do_post_page_content( ) {
	if( !is_home() ) {
		return;
	}
	$posts_page = get_option( 'page_for_posts' );
	if ( is_null( $posts_page ) ) {
		return;
	}
	$content = get_post( $posts_page )->post_content;

	if ( $content ) {
		printf( '<div class="archive-description-content">%s</div>', apply_filters( 'the_content', $content ) );
	}
}
add_action( 'genesis_archive_title_descriptions', 'do_post_page_content' );