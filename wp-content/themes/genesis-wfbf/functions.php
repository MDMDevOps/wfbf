<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Global Includes
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );
include_once( get_stylesheet_directory() . '/lib/theme-mods.php' );
include_once( get_stylesheet_directory() . '/lib/wp_query.php' );
include_once( get_stylesheet_directory() . '/lib/jumbotron.php' );
include_once( get_stylesheet_directory() . '/lib/class_wp_subnav_widget.php' );

if ( ! isset( $content_width ) ) {
	$content_width = 1920;
}
add_filter( 'fl_builder_render_assets_inline', '__return_true' );
// function jeherve_custom_tiled_gallery_width() {
//     return '800';
// }
// add_filter( 'tiled_gallery_content_width', 'jeherve_custom_tiled_gallery_width' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'enterprise', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'enterprise' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Enterprise Pro Theme', 'enterprise' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/enterprise/' );
define( 'CHILD_THEME_VERSION', '2.2.3' );
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );
//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );
//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer',
	'jumbotron',
) );
// Add logo support
add_theme_support( 'custom-logo', array(
	'width'       => 270,
	'height'      => 55,
	'flex-width'  => true,
	'flex-height' => true,
) );
add_action( 'genesis_site_title', 'the_custom_logo', 0 );
//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );
//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );
//* Filter to not use default taxonomy image
add_filter( 'gtaxi_get_placeholder_img_src', '__return_false' );
//* Enqueue Scripts
function enterprise_load_scripts() {
	wp_enqueue_script( 'enterprise-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/scripts/libs/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,600,700,300italic,400italic|Titillium+Web:600', array(), CHILD_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'enterprise_load_scripts' );

function load_admin_scripts() {
	wp_enqueue_script( 'theme-admin', get_bloginfo( 'stylesheet_directory' ) . '/scripts/dist/admin.min.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'theme-admin', get_bloginfo( 'stylesheet_directory' ) . '/styles/dist/admin.min.css', array(), CHILD_THEME_VERSION );
}
add_action( 'admin_enqueue_scripts', 'load_admin_scripts' );

//* Add new image sizes
add_image_size( 'featured-image', 770, 460, TRUE );
add_image_size( 'home-top', 750, 600, TRUE );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

//* Reposition breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'gsp_jumbotron_content', 'genesis_do_breadcrumbs', 20 );

//* Reduce the secondary navigation menu to one level depth
function enterprise_secondary_menu_args( $args ){
	if( 'secondary' != $args['theme_location'] )
	return $args;
	$args['depth'] = 1;
	return $args;
}
add_filter( 'wp_nav_menu_args', 'enterprise_secondary_menu_args' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

/**
 * Parse shortcodes in the text widget
 */
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );

genesis_register_sidebar( array(
	'id' => 'before-footer',
	'name' => 'Before Footer Area',
) );

function do_before_footer_sidebar() {
	genesis_widget_area('before-footer', array(
		'before' => '<aside id="before-footer-widgets" class="widget-area">',
		'after'  => '</aside>',
	) );
}
add_action( 'genesis_before_footer', 'do_before_footer_sidebar' );

//Add custom backgrounds
add_theme_support( 'custom-background' );

function do_back_to_top() {
	echo '<a id="back-to-top" href="body" class="jumpscroll scrolltoggle" data-trigger-element="body" data-trigger-offset="-300" data-scrollspeed="slow"><span class="icon fa fa-angle-up" aria-hidden="true"></span><span class="screen-reader-text">Back to Top</span></a>';
}
// add_action( 'genesis_after_footer', 'do_back_to_top' );


function genesis_child_additional_structural_wrap( $atts ) {
	$atts['class'] .= ' wrap';
	return $atts;
}
add_filter( 'genesis_attr_jumbotron-inner', 'genesis_child_additional_structural_wrap' );

/**
 * These should remain at bottom of functions.php (last) to override defaults farther up
 * conditionally include functions, depending on where we are at
 */
function genesis_child_conditional_includes() {

	if( is_singular() ) {
		include_once( get_stylesheet_directory() . '/lib/single.php' );
	}
	if( !is_home() && is_front_page() ) {
		include_once( get_stylesheet_directory() . '/lib/homepage.php' );
	}
	if( is_home() && !is_front_page() ) {
		include_once( get_stylesheet_directory() . '/lib/blog.php' );
	}
	if( is_archive() ) {
		include_once( get_stylesheet_directory() . '/lib/archives.php' );
	}
	if( is_search() ) {
		include ( get_stylesheet_directory() . '/lib/search.php' );
	}
	if( is_404() ) {
		include_once( get_stylesheet_directory() . '/lib/404.php' );
	}
}
add_action( 'wp', 'genesis_child_conditional_includes' );

function genesis_default_featured_image( $defaults, $args ) {
	// Get the category
	$category = current( get_the_category() );
	// Make sure we have a category
	if( empty( $category ) ) {
		return $defaults;
	}
	// See if we have a fallback image in the content
	$image_id = genesis_get_image_id( 0, get_the_id() );
	// If we don't have an attachment or a featured image, get the taxonomy image
	if( $image_id === false && function_exists( 'gtaxi_get_taxonomy_image' ) ) {
		// Get the image
		$image = gtaxi_get_taxonomy_image( array( 'term' => $category, 'format' => 'url' ) );
		// Attempt to get ID
		$image_id = attachment_url_to_postid( $image );
	}
	// If we still don't have an image, use default
	if( $image_id === 0 ) {
		$options = get_option( 'mdm_wp_cornerstone' );
		$image_id = isset( $options['featured_image'] ) && !empty( $options['featured_image'] ) ? attachment_url_to_postid( $options['featured_image'] ) : 0;
	}
	// set the image
	if( $image_id !== 0 && $image_id !== false ) {
		$defaults['fallback'] = $image_id;
		$defaults['context'] = 'archive';
	}

	return $defaults;
}

add_filter( 'genesis_get_image_default_args', 'genesis_default_featured_image', 10, 2 );


function do_recipe_links_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'recipe_categories' => array() ), $atts, 'recipe_links' );

	if( empty( $atts['recipe_categories'] ) ) {
		return false;
	}

	$categories = genesis_child_get_terms_from_string( $atts['recipe_categories'], 'recipe_categories' );

	$content = '<div class="category-links row">';

	$image_url = null;

	foreach( $categories as $category ) {

		$recipe_term = get_term( $category, 'recipe_categories');

		if( function_exists( 'gtaxi_get_taxonomy_image' ) ) {
			// Get the image
			$image_url = gtaxi_get_taxonomy_image( array( 'term' => $recipe_term, 'format' => 'url', 'size' => 'featured-image', ) );
			// Attempt to get ID
		}

		$content .= sprintf( '<div class="cols-xs-60 cols-md-30">' );
			$content .= '<div class="category-link-wrapper">';
				$content .= sprintf( '<a class="category-link" href="%s" style="background-image: url(%s);"><span class="screen-reader-text">%s</span></a>', get_term_link( $recipe_term ), $image_url, $recipe_term->name );

				$content .= sprintf( '<a class="caterory-link-title h6" href="%s">%s</a>', get_term_link( $recipe_term ), $recipe_term->name );

			$content .= '</div>';
		$content .= '</div>';
	}
	$content .= '</div>';

	return $content;

}
add_shortcode( 'recipe_links', 'do_recipe_links_shortcode' );


function do_category_links_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'categories' => array() ), $atts, 'category_links' );

	if( empty( $atts['categories'] ) ) {
		return false;
	}

	$categories = genesis_child_get_terms_from_string( $atts['categories'] );

	$content = '<div class="category-links row">';

	$image_url = null;

	foreach( $categories as $category ) {
		$category = get_category( $category );

		if( function_exists( 'gtaxi_get_taxonomy_image' ) ) {
			// Get the image
			$image_url = gtaxi_get_taxonomy_image( array( 'term' => $category, 'format' => 'url', 'size' => 'featured-image', ) );
			// Attempt to get ID
		}

		$content .= sprintf( '<div class="cols-xs-60 cols-md-30">' );
			$content .= '<div class="category-link-wrapper">';
				$content .= sprintf( '<a class="category-link" href="%s" style="background-image: url(%s);"><span class="screen-reader-text">%s</span></a>', get_category_link( $category->term_id ), $image_url, $category->name );
				// $content .= sprintf( '<span class="category-link-image" style="background-image: url(%s);"></span>', $image_url );
				$content .= sprintf( '<a class="caterory-link-title h6" href="%s">%s</a>', get_category_link( $category->term_id ), $category->name );
				// $content .= '</a>';
			$content .= '</div>';
		$content .= '</div>';
	}
	$content .= '</div>';

	return $content;
}
add_shortcode( 'category_links', 'do_category_links_shortcode' );

function genesis_child_string_to_array_values( $string ) {
	// make sure we have an array
	$args = is_array( $string ) ? $string : explode( ',', $string );
	// Trim and Escape values
	foreach( $args as $index => $arg ) {
		$args[$index] = esc_attr( trim( $arg ) );
	}
	return $args;
}

function genesis_child_get_terms_from_string( $terms = '', $term_type = 'category' ) {
    // Make sure we have an array
    $terms = genesis_child_string_to_array_values( $terms );
    // Create empty array to hold IDs
    $term_ids = array();
    // Get ids for each
    foreach( $terms as $term ) {
    	// See if already an ID
    	if( is_numeric( $term ) ) {
    		$term_ids[] = intval( $term  );
    	}
    	// Check if looking for author
    	else if( $term_type === 'author' ) {
    		$user_object = get_user_by( 'slug', trim( $term ) );
    		// If failed, try login
    		if( $user_object === false ) {
    			$user_object = get_user_by( 'login', trim( $term ) );
    		}
    		// If failed, try email
    		if( $user_object === false ) {
    			$user_object = get_user_by( 'email', trim( $term ) );
    		}
    		// Lastly, assign term
    		if( $user_object ) {
    			$term_ids[] = $user_object->id;
    		}
    	}
    	// If looking for any other term
    	else {
    		$term_object = get_term_by( 'slug', trim( $term ), $term_type );
    		// If failed, try name
    		if( $term_object === false ) {
    			$term_object = get_term_by( 'name', trim( $term ), $term_type );
    		}
    		// Lastly, assign term
    		if( $term_object ) {

    			$term_ids[] = $term_object->term_id;
    		}
    	}
    }
    return $term_ids;
}

function sp_footer_creds_filter( $creds ) {
	$creds = sprintf( 'Copyright [footer_copyright] <a href="%s">%s</a>', home_url( '/' ), get_bloginfo( 'name' ) );
	return $creds;
}
add_filter('genesis_footer_creds_text', 'sp_footer_creds_filter');


function genesis_child_do_archive_intro_shortcodes( $text ) {
	return apply_filters( 'the_content', $text );
}
add_filter( 'genesis_term_intro_text_output', 'genesis_child_do_archive_intro_shortcodes' );
add_filter( 'genesis_author_intro_text_output', 'genesis_child_do_archive_intro_shortcodes' );
add_filter( 'genesis_cpt_archive_intro_text_output', 'genesis_child_do_archive_intro_shortcodes' );

function filter_post_info( $info ) {
	$post_info = '[post_date] [post_edit]';
	return $post_info;
}
add_filter( 'genesis_post_info', 'filter_post_info' );

/**
 * Woocommerce - Force full page layout & disable comments
 */
function genesis_products_page_layout( $setting ) {
	if( is_singular( 'product' ) === true ) {
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
		add_filter('comments_open', '__return_false', 20, 2);
		add_filter('pings_open', '__return_false', 20, 2);
	}
}
add_filter( 'wp', 'genesis_products_page_layout' );

/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// First, remove Add to Cart Button
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// Second, add View Product Button

add_action( 'woocommerce_after_shop_loop_item', 'shop_view_product_button', 10);
function shop_view_product_button() {
	global $product;
	$link = $product->get_permalink();
	echo '<a href="' . $link . '" class="button addtocartbutton">View Product</a>';
}

//* Register webshop sidebar
genesis_register_sidebar( array(
    'id'            => 'woo_primary_sidebar',
    'name'          => __( 'WooCommerce Sidebar', 'themename' ),
    'description' => __( 'This is the WooCommerce webshop sidebar', 'themename' ),
) );

//* Remove default sidebar, add shop sidebar
add_action( 'genesis_before', 'wpstudio_add_woo_sidebar', 20 );
function wpstudio_add_woo_sidebar() {

    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        if( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
            remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
            add_action( 'genesis_sidebar', 'wpstudio_woo_sidebar' );
        }
    }
}

//* Display the WooCommerce sidebar
function wpstudio_woo_sidebar() {
    if ( ! dynamic_sidebar( 'woo_primary_sidebar' ) && current_user_can( 'edit_theme_options' )  ) {
        genesis_default_widget_area_content( __( 'WooCommerce Primary Sidebar', 'genesis' ) );
    }
}
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

function _wfbf_cart_wrapper_open() {
	echo '<div class="cart-form-container">';
}
add_action( 'woocommerce_checkout_before_order_review_heading', '_wfbf_cart_wrapper_open' );

function _wfbf_cart_wrapper_close() {
	echo '</div>';
}
add_action( 'woocommerce_checkout_after_order_review', '_wfbf_cart_wrapper_close' );

add_filter( 'woocommerce_defer_transactional_emails', '__return_true' );



function get_page_by_template($template = 'templates/page_advanced_custom_fields.php') {
	$args = array(
	    'post_type' => 'page',
	    'posts_per_page' => -1,
	    'meta_query' => array(
	        array(
	            'key' => '_wp_page_template',
	            'value' => 'templates/page_advanced_custom_fields.php'
	        )
	    )
	);
	$the_pages = new WP_Query( $args );

	if( $the_pages->have_posts() ){
	    while( $the_pages->have_posts() ){
	        $the_pages->the_post();
	        the_title();
	        echo '<br>';
	    }
	}
	wp_reset_postdata();
  // $args = array(
  //   'meta_key' => '_wp_page_template',
  //   'meta_value' => 'templates/page_advanced_custom_fields.php',
  // );
  // $pages = get_pages($args);
  // echo count($pages);
  // foreach( $pages as $page ) {
  // 	echo $page->post_title . '<br>';
  // }
  // var_dump(get_post_meta(get_the_id(), '_wp_page_template', true));
}
// add_action( 'wp', 'get_page_by_template' );