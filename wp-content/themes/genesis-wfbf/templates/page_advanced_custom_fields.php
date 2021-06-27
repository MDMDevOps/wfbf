<?php
/**
 * Genesis Sample.
 *
 * This file adds the Advanced Custom Fields page template
 *
 * Template Name: Advanced Custom Fields
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */




if( class_exists( 'acf' ) && is_main_query() ) {
	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
	add_action( 'genesis_entry_content', 'acf_do_post_content' );

	// add_action( 'genesis_entry_content', 'genesis_do_post_content', 12 );
	// var_dump(current_user_can( 'edit_posts' ));
	// if ( current_user_can( 'edit_posts' ) ) {
	// 	add_action( 'genesis_entry_content', 'genesis_do_post_content', 12 );
	// }
}

function acf_do_post_content() {

	// Re-add our default action back in, so other things can use it
	// add_action( 'genesis_entry_content', 'genesis_do_post_content' );
	// Remove this action for nested loops
	remove_action( 'genesis_entry_content', 'acf_do_post_content' );
	// Continue with our content...
	if( have_rows('page_section') ) : while ( have_rows('page_section') ) : the_row();
		// Open the section markup
		genesis_markup( array( 'open' => '<section %s>', 'context' => 'acf_page_section' ) );
			// Do the section header
			if( get_sub_field('display_title') ) :
				genesis_markup( array(
					'open' => '<header %s>',
					'close' => '</header>',
					'context' => 'acf_page_section_header',
					'content' => sprintf( '<h2 class="section-title">%s</h2>', get_sub_field('section_title') ),
				) );
			endif;
			// Open the inner markup
			genesis_markup( array( 'open' => '<div %s>', 'context' => 'acf_page_section_inner', 'content' => '<div class="row">' ) );
			// Loop through individual elements
			if( have_rows('section_elements') ) : while ( have_rows('section_elements') ) : the_row();
				// Open the column
				genesis_markup( array( 'open' => '<div %s>', 'context' => 'acf_column' ) );
					// Output each individual type of layout
					do_action( sprintf( 'acf_do_layout_%s', get_row_layout() ) );
				// Close the column
				genesis_markup( array( 'close' => '</div>', 'context' => 'acf_column' ) );
			endwhile; endif;
			// Close the inner markup
			genesis_markup( array( 'close' => '</div>', 'context' => 'acf_page_section_inner', 'content' => '</div>' ) );
		// Close the section markup
		genesis_markup( array( 'close' => '</section>', 'context' => 'acf_page_section' ) );

	endwhile; endif;

	if ( current_user_can( 'edit_posts' ) && class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_enabled() ) {
		// echo 'Endwhile';
		genesis_do_post_content();
		// the_content();
	}

}

function acf_do_layout_legislative_links() {
	echo '<div class="panel">';
		$imgID = get_sub_field( 'image' );
		echo wp_get_attachment_image( $imgID, 'featured-image' );
		printf( '<header class="panel-header"><a href="%s" target="_blank" rel="noopener noreferrer">%s</a></header>', get_sub_field( 'url' ), get_sub_field( 'title' ) );
		printf( '<div class="panel-body">%s</div>', get_sub_field( 'description' ) );
	echo '</div>';
}
add_action( 'acf_do_layout_legislative_links', 'acf_do_layout_legislative_links' );
/**
 * Output function for standard content fields
 */
function acf_do_layout_standard_content() {
	// echo apply_filters( 'the_content', get_sub_field( 'content' ) );
	echo get_sub_field( 'content' );
}
add_action( 'acf_do_layout_standard_content', 'acf_do_layout_standard_content' );

/**
 * Output function for single line fields
 */
function acf_do_layout_single_line_text() {
	echo get_sub_field( 'content' );
	// echo apply_filters( 'the_content', get_sub_field( 'content' ) );
}
add_action( 'acf_do_layout_single_line_text', 'acf_do_layout_single_line_text' );

/**
 * Output function for content card fields
 */
function acf_do_layout_content_card() {
	genesis_markup( array( 'open' => '<div %s>', 'close' => '</div>', 'context' => 'content_card', 'content' => get_sub_field( 'content' ) ) );
}
add_action( 'acf_do_layout_content_card', 'acf_do_layout_content_card' );

/**
 * Output function for staff list fields
 */
function acf_do_layout_staff_list() {
	if( have_rows('staff_members') ):
		echo '<div class="row flexrow flexwrap">';

		while ( have_rows('staff_members') ) : the_row();

		/**
		 * Staff member is a post object
		 * Information can be gotton with functions like get_post_meta( $staff_member->ID, 'meta_name', true ), etc
		 */

		$staff_member = get_sub_field('staff_member');

		if( $staff_member ):
			echo '<div class="cols-md-40">';
			echo '<div class="staff-member-wrap">';

			//Display the staff image
			genesis_markup( array( 'open' => '<figure %s>', 'context' => '_staff_member_image' ) );
			echo get_the_post_thumbnail( $staff_member->ID );

			//Display the staff name
			genesis_markup( array( 'open' => '<strong><figcaption %s>', 'close' => '</figcaption></strong>' , 'context' => '_staff_member_name' , 'content' => get_the_title( $staff_member->ID ) ) );

			//Closes figure tag for the image
			genesis_markup( array( 'close' => '</figure>', 'context' => '_staff_member_image' ) );

			//Display the staff title
			genesis_markup( array( 'open' => '<span %s>', 'close' => '</span>' , 'context' => '_staff_member_title' , 'content' => get_post_meta( $staff_member->ID, '_staff_member_title' , true ) ) );

			//Create array of values from post type
			$fields = array(
				'_staff_member_phone',
				'_staff_member_email',
				'_staff_member_fb',
				'_staff_member_tw',
			);

			//Create switch case that will esc each value and display them in a list
			echo '<ul>';

			foreach( $fields as $field ) {

				$value = get_post_meta( $staff_member->ID, $field, true );
				if( empty( $value ) ) :
					continue;
				endif;

				switch( $field ) {
					case '_staff_member_email' :
						$value = sprintf( '<a class="ghost-button" href="mailto:%s" target="_blank" rel=”noreferrer noopener nofollow”>Email</a>', antispambot( $value ) );
						break;
					case '_staff_member_fb' :
						$value = sprintf( '<a href="%s" target="_blank" rel=”noreferrer noopener nofollow”>Facebook</a> ' , esc_url_raw( $value ) );;
						break;

					case '_staff_member_tw' :
						$value = sprintf( '<a href="%s" target="_blank" rel=”noreferrer noopener nofollow”>Twitter</a> ' , esc_url_raw( $value ) );
						break;

					default :
						$value = esc_attr( $value );
						break;
				}
				genesis_markup( array( 'open' => '<li %s>', 'close' => '</li>' , 'context' => $field , 'content' => $value ) );
			}
			echo "</ul>";
			echo "</div>";
			echo "</div>";
		endif;

	endwhile; endif;
}
add_action( 'acf_do_layout_staff_list', 'acf_do_layout_staff_list');

/**
 * Add column classes to columns
 */
function acf_column_attr( $attr ) {
	$attr['class'] .= ' ' . get_sub_field( 'layout' );
	$attr['class'] .= ' ' . get_sub_field( 'class' );
	$attr['class']  = trim( $attr['class'] );
	// Conditional styling
	return $attr;
}
add_filter( 'genesis_attr_acf_column', 'acf_column_attr' );

/**
 * Add attributes to page sections and content cards
 */
function acf_page_section_attr( $attr ) {
	// Set the ID
	$attr['id'] = get_sub_field('id');
	// Set the classes
	$attr['class'] .= ' ' . get_sub_field( 'class' );
	$attr['class']  = trim( $attr['class'] );
	// Set the style
	$attr['style']  = '';
	$attr['style'] .= !empty( get_sub_field('background_color') ) ? ' background-color: ' . get_sub_field('background_color') . ';' : '';
	// Special handling for image object
	$image = get_sub_field('background_image');
	$attr['style'] .= !empty( $image ) ? ' background-image: url(' . esc_url_raw( $image['url'] ) . ');' : '';
	// Return
	return $attr;
}
add_filter( 'genesis_attr_acf_page_section', 'acf_page_section_attr' );
add_filter( 'genesis_attr_content_card', 'acf_page_section_attr' );

function acf_page_section_inner_attr( $attr ) {
	$attr['class'] .= ' wrap';
	return $attr;
}
add_filter( 'genesis_attr_acf_page_section_inner', 'acf_page_section_inner_attr' );
add_filter( 'genesis_attr_acf_page_section_header', 'acf_page_section_inner_attr' );

/**
 * Run genesis
 */
genesis();