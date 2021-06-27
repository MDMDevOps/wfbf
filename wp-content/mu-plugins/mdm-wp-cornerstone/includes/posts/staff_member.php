<?php

namespace Mdm\Wp\Cornerstone\Posts;

class Staff_Member extends \Mdm\Wp\Cornerstone\Common\Plugin {

	public static function get_post_type_args() {
		// Set up post type options
		$labels = array(
			'name'                	=> 'Staff Members',
			'singular_name'       	=> 'Staff Member',
			'add_new'             	=> _x( 'Add New', 'staff member', self::$name ),
			'add_new_item'        	=> __( 'Add New Staff Member', self::$name ),
			'edit_item'           	=> __( 'Edit Staff Member', self::$name ),
			'new_item'            	=> __( 'New Staff Member', self::$name ),
			'view_item'           	=> __( 'View Staff Member', self::$name ),
			'search_items'        	=> __( 'Search Staff Members', self::$name ),
			'exclude_from_search' 	=> true,
			'not_found'           	=> __( 'No staff members found', self::$name ),
			'not_found_in_trash'  	=> __( 'No staff members found in Trash', self::$name ),
			'parent_item_colon'   	=> '',
			'all_items'           	=> __( 'All Staff Members', self::$name ),
			'menu_name'           	=> __( 'Staff Members', self::$name ),
			'featured_image'	  	=> __( 'Staff Photo', self::$name ),
			'set_featured_image'  	=> __( 'Set Staff Photo', self::$name ),
			'remove_featured_image' => __( 'Remove Staff Photo', self::$name ),
			'use_featured_image'	=> __( 'Use Staff Photo', self::$name ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'page',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 100,
			'rewrite'            => array( 'slug' => 'staff-member', 'with_front' => false ),
			'supports'           => array( 'title', 'thumbnail', 'excerpt' ),
			'menu_icon'			 => 'dashicons-groups',
		);

		// Register post type
		return $args;
	}

}

