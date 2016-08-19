<?php
/*
	Plugin Name: Webnus Shortcodes
	Description: Adds Webnus Shortcodes to your WordPress website.
	Version: 1.0
	Author: Webnus
	Author URI: http://webnus.net
	License: GPL2
*/

add_action( 'plugins_loaded', 'shortcodes_init' );
function shortcodes_init() {
	foreach( glob( plugin_dir_path( __FILE__ ) . '/shortcodes/*.php' ) as $filename ) {
		require_once $filename;
	}
}