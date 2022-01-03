<?php
/*
Plugin Name: Select Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Select Themes
Version: 2.0.1
*/
define( 'QODEF_TWITTER_FEED_VERSION', '2.0.1' );
define( 'QODEF_TWITTER_ABS_PATH', dirname( __FILE__ ) );
define( 'QODEF_TWITTER_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'QODEF_TWITTER_URL_PATH', plugin_dir_url( __FILE__ ) );

include_once 'load.php';

if ( ! function_exists( 'select_twitter_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function select_twitter_theme_installed() {
		return defined( 'QODE_ROOT' );
	}
}

if ( ! function_exists( 'select_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function select_twitter_feed_text_domain() {
		load_plugin_textdomain( 'select-twitter-feed', false, QODEF_TWITTER_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'select_twitter_feed_text_domain' );
}