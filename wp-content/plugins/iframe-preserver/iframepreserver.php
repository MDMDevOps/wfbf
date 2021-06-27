<?php
/*
Plugin Name: Iframe Preserver
Plugin URI: http://resultzdigital.com/wordpress-plugins/
Description: Iframe Preserver allows you to easily embed an iframe in a page or post and preserves your embedded iframes by allowing use of a simple shortcode and WordPress' Custom Fields. Works for all iframe embeds including YouTube, Vimeo, Scribd even Real Estate IDXs.
Version: 1.1
Author: Marc Fuller
Author URI: http://resultzdigital.com/wordpress-plugins/
/*  Copyright 2011  Marc Fuller & Tim Anderson  (email : marc@marcfuller.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Custom field iframe preservation 
function field_func($atts) {
global $post;
$name = $atts['name'];
if (empty($name)) return;
 
return get_post_meta($post->ID, $name, true);
}
 
add_shortcode('field', 'field_func');

?>