<?php

if( !function_exists( 'homepage_featured_insert_column_classes' ) ) {
	function homepage_featured_insert_column_classes( $atts ) {
		global $wp_query;
		// Set the column count
		if( $wp_query->current_post === 0 || $wp_query->current_post === 1 ) {
			$column_count = 60;
		} else {
			$column_count = 40;
		}
		$atts['class'] .= sprintf( ' cols-md-%s', $column_count );
		return $atts;
	}
}
add_action( 'genesis_attr_featured_post_column', 'homepage_featured_insert_column_classes' );

if( !function_exists( 'homepage_featured_insert_column_wrapper' ) ) {
	function homepage_featured_insert_column_wrapper( $count, $context ) {
		global $wp_query;
		// do opening
		if( $context === 'open' ) {
			if( $count === 0 || $count === 2 ) {
				echo '<div class="row-container flexrow flexwrap">';
			}
		}
		// do closing
		else {
			if( $count === 1 || $count === $wp_query->post_count - 1 ) {
				echo '</div>';
			}
		}
	}
}
add_action( 'homepage_featured_posts_outer_wrapper', 'homepage_featured_insert_column_wrapper', 10, 2 );

if( !function_exists( 'homepage_featured_insert_background_images' ) ) {
	function homepage_featured_insert_background_images( $attr ) {
		// // Get the category
		// $category = current( get_the_category() );
		// // Make sure we have a category
		// if( empty( $category ) ) {
		// 	return $attr;
		// }
		// // Make sure we have the function we need
		// if( !function_exists( 'gtaxi_get_taxonomy_image' ) ) {
		// 	return $attr;
		// }
		// // get the image
		// $image = gtaxi_get_taxonomy_image( array( 'term' => $category, 'format' => 'url' ) );
		// 	// set the image
		// if( $image !== 0 ) {
		// 	$attr['style'] = sprintf( 'background-image:url("%s");', $image );
		// }

		// return $attr;
		//

		// Update to NOT use category images
		$image = genesis_get_image( array( 'format' => 'url', 'size' => 'featured-image' ) );
			// set the image
		if( $image !== 0 && !empty( $image ) ) {
			$attr['style'] = sprintf( 'background-image:url("%s");', $image );
		}

		return $attr;
	}
}
add_action( 'genesis_attr_featured-post-grid-item', 'homepage_featured_insert_background_images' );

if( $wp_query->have_posts() ) :

	while( $wp_query->have_posts() ) : $wp_query->the_post();
		// Conditionally open up outer wrapper
		do_action( 'homepage_featured_posts_outer_wrapper', $wp_query->current_post, 'open' );
		// Open up columns
		genesis_markup( array( 'open' => '<div %s>', 'context' => 'featured_post_column' ) );

			genesis_markup( array( 'open' => '<article %s>', 'context' => 'featured-post-grid-item' ) );

			echo sprintf( '<a href="%s" rel="bookmark" class="overlay-link"><div class="entry-footer"><h2 class="entry-title" itemprop="headline">%s</h2></div></a>',get_the_permalink(), get_the_title() );


			genesis_markup( array( 'close' => '</article>', 'context' => 'featured-post-grid-item' ) );

		// Close columns
		genesis_markup( array( 'close' => '</div>', 'context' => 'featured_post_column' ) );

		// Conditionally open up outer wrapper
		do_action( 'homepage_featured_posts_outer_wrapper', $wp_query->current_post, 'close' );

	endwhile;

endif;





