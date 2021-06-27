<?php

/**
 * The plugin file that controls core wp tweaks and configurations
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Mdm\Wp\Cornerstone\Addons;

class Wordpress extends \Mdm\Wp\Cornerstone\Addons implements \Mdm\Wp\Cornerstone\Interfaces\Filter_Hook_Subscriber, \Mdm\Wp\Cornerstone\Interfaces\Action_Hook_Subscriber {

	/**
	 * Get the filter hooks this class subscribes to.
	 * @return array
	 */
	public static function get_filters() {
		return array(
			// array( 'script_loader_src' => array( 'remove_query_strings', 15, 1 ) ),
			// array( 'style_loader_src' => array( 'remove_query_strings', 15, 1 ) ),
			array( 'tiny_mce_plugins' => 'disable_emojis_tinymce' ),
			array( 'wp_resource_hints' => array( 'disable_emojis_remove_dns_prefetch', 10, 2 ) ),
		);
	}

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		return array(
			array( 'wp_enqueue_scripts' => 'enqueue_scripts' ),
			array( 'wp_enqueue_scripts' => 'enqueue_styles' ),
			array( 'init' => 'clean_head' ),
			array( 'wp_footer' => array( 'makers_mark', 0, 999999999 ) ),
		);
	}

	public function enqueue_scripts() {
		// Register all public scripts, including dependencies
		wp_enqueue_script( sprintf( '%s_public', self::$name ), self::url( 'scripts/dist/public.min.js' ), array( 'jquery' ), self::$version, true );
		// Localize public script
		wp_localize_script( sprintf( '%s_public', self::$name ), self::$name, array( 'wpajaxurl' => admin_url( 'admin-ajax.php') ) );
		if( get_post_type() === 'post' ) {

			wp_enqueue_script( 'mdm_cornerstone_custom_dimensions', self::url( 'scripts/dist/customdimensions.js' ), array( 'jquery' ), self::$version, true );

			$cats = get_the_category();

			$catlist = array();

			if( !empty( $cats ) ) {
				foreach( $cats as $cat ) {
					$catlist[] = $cat->cat_name;
				}
			}

			wp_localize_script( 'mdm_cornerstone_custom_dimensions', 'mdm_cornerstone_custom_dimensions', array( 'categories' => $catlist ) );
		}
	}

	public function enqueue_styles() {
		// Register font awesome
		wp_register_style( 'fontAwesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all' );
		// Enqueue font awesome
		wp_enqueue_style( 'fontAwesome' );
		// Register public styles
		// wp_register_style( sprintf( '%s_public', self::$name ), self::url( 'styles/dist/public.min.css' ), array( 'fontAwesome' ), self::$version, 'all' );
		// // Enqueue public style
		// wp_enqueue_style(  sprintf( '%s_public', self::$name ) );
	}


	public function remove_query_strings( $src ) {
		// remove ?ver=
		if ( strpos( $src, 'ver=' ) ) {
			$src = remove_query_arg( 'ver', $src );
		}
		// remove ?v=
		if ( strpos( $src, 'v=' ) ) {
			$src = remove_query_arg( 'v', $src );
		}
		return $src;
	}

	public function clean_head() {
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}

	/**
	* Filter function used to remove the tinymce emoji plugin.
	*
	* @param array $plugins
	* @return array Difference betwen the two arrays
	*/
	function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}

	/**
	* Remove emoji CDN hostname from DNS prefetching hints.
	*
	* @param array $urls URLs to print for resource hints.
	* @param string $relation_type The relation type the URLs are printed for.
	* @return array Difference betwen the two arrays.
	*/
	function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' == $relation_type ) {
			/** This filter is documented in wp-includes/formatting.php */
			$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
			$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}
		return $urls;
	}

	public function makers_mark() {
		// Get image from images directory
		$makers_mark = self::url( 'partials/images/makers-mark.svg' );
		// Allow themes and plugins to filter to different image
		$makers_mark = apply_filters( 'makers_mark', $makers_mark );
		// Output
		echo sprintf( '<img id="makers-mark" src="%1$s" alt="" style="display: none;">', esc_url_raw( $makers_mark ) );
	}

} // end class