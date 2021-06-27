<?php

namespace Mdm\Wp\Cornerstone\Taxonomies;

class Staff_Member_Group extends \Mdm\Wp\Cornerstone\Common\Plugin {


	public static function get_tax_args() {
		$group_labels = array(
			'name'              => _x( 'Groups', 'taxonomy general name', self::$name ),
			'singular_name'     => _x( 'Group', 'taxonomy singular name', self::$name ),
			'search_items'      => __( 'Search Groups', self::$name ),
			'all_items'         => __( 'All Groups', self::$name ),
			'parent_item'       => __( 'Parent Group', self::$name ),
			'parent_item_colon' => __( 'Parent Group:', self::$name ),
			'edit_item'         => __( 'Edit Group', self::$name ),
			'update_item'       => __( 'Update Group', self::$name ),
			'add_new_item'      => __( 'Add New Group', self::$name ),
			'new_item_name'     => __( 'New Group Name', self::$name ),
		);

		$args = array(
			'hierarchical' => true,
			'labels' => $group_labels, /* NOTICE: Here is where the $labels variable is used */
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'group' ),
		);
		return $args;
	}

	public static function get_tax_post_types() {
		return array( 'staff_member' );
	}

}