<?php

namespace Mdm\Wp\Cornerstone\Posts;

class Recipes extends \Mdm\Wp\Cornerstone\Common\Plugin {

		/**
	 * Get post type arguments
	 * @since 1.0.0
	 */
	public static function get_post_type_args() {
		$labels = array(
			'name'                  => _x( 'Farm Bureau Flavor', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Recipe', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Recipes', 'text_domain' ),
			'name_admin_bar'        => __( 'Recipes', 'text_domain' ),
			'archives'              => __( 'Recipe Archives', 'text_domain' ),
			'attributes'            => __( 'Recipe Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Recipe:', 'text_domain' ),
			'all_items'             => __( 'All Recipes', 'text_domain' ),
			'add_new_item'          => __( 'Add New Recipe', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Recipe', 'text_domain' ),
			'edit_item'             => __( 'Edit Recipe', 'text_domain' ),
			'update_item'           => __( 'Update Recipe', 'text_domain' ),
			'view_item'             => __( 'View Recipe', 'text_domain' ),
			'view_items'            => __( 'View Recipes', 'text_domain' ),
			'search_items'          => __( 'Search Recipe', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Recipes list', 'text_domain' ),
			'items_list_navigation' => __( 'Recipes list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		// $rewrite = array(
		// 	'slug'                  => 'farm-bureau-flavor',
		// 	'with_front'            => true,
		// 	'pages'                 => true,
		// 	'feeds'                 => true,
		// );
		$args = array(
			'label'                 => __( 'Recipe', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'author', 'thumbnail','comments', 'revisions', 'custom-fields'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 10,
			'menu_icon'             => 'dashicons-carrot',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'taxonomies'            => array( 'recipe_categories', 'post_tag' ),
			// 'rewrite'               => $rewrite,
			'capability_type'       => 'page',
		);
		return $args;
	}

}

