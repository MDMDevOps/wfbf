<?php

/**
 * Remove unused legacy page templates
 *
 * The "blog page" & "archive page" templates are now part of core, and only
 * exist in Genesis for backwards compatibility. Any new site being built should
 * not include them.
 */
if( !function_exists( 'remove_genesis_page_templates' ) ) {
	function remove_genesis_page_templates( $page_templates ) {
		unset( $page_templates['page_archive.php'] );
		unset( $page_templates['page_blog.php'] );
		return $page_templates;
	}
	add_filter( 'theme_page_templates', 'remove_genesis_page_templates' );
}

/**
 * Remove blog page settings metabox
 *
 * The "blog page" & "archive page" templates are now part of core, and only
 * exist in Genesis for backwards compatibility. There is no need to display the
 * associated settings for them.
 */
if( !function_exists( 'remove_genesis_metaboxes' ) ) {
	function remove_genesis_metaboxes() {
		remove_meta_box( 'genesis-theme-settings-blogpage', 'toplevel_page_genesis', 'main' );
	}
	add_action( 'toplevel_page_genesis_settings_page_boxes', 'remove_genesis_metaboxes' );
}

/**
 * Remove comment form allowed tags
 *
 * The allowed tags box is annoying. It should be removed
 */
if( !function_exists( 'remove_comment_form_allowed_tags' ) ) {
	function remove_comment_form_allowed_tags( $defaults ) {
		$defaults['comment_notes_after'] = '';
		return $defaults;
	}
	add_filter( 'comment_form_defaults', 'remove_comment_form_allowed_tags' );
}
