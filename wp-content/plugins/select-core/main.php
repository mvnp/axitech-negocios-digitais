<?php
/*
Plugin Name: Select Core
Description: Plugin that adds all post types needed by our theme
Author: Select Themes
Version: 2.2.4
*/

use QodeCore\CPT;
use QodeCore\Lib;

if ( ! class_exists( 'StartitCore' ) ) {
	class StartitCore {
		private static $instance;

		public function __construct() {

			//include all necessary files
			require_once 'const.php';
			require_once 'load.php';

			require_once QODE_CORE_ABS_PATH . '/helpers/select-core-helpers.php';

			// Make plugin available for translation
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

			// Add plugin's body classes
			add_filter( 'body_class', array( $this, 'add_body_classes' ) );

			add_action( 'after_setup_theme', array( $this, 'init' ), 5 );


		}

		public static function get_instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function load_plugin_textdomain() {
			load_plugin_textdomain('select-core', false, QODE_CORE_REL_PATH.'/languages');
		}

		function add_body_classes( $classes ) {
			$classes[] = 'select-core-' . QODE_CORE_VERSION;

			return $classes;
		}

		function init() {

			if ( qode_core_theme_installed() && select_core_is_theme_registered() ) {

				Lib\ShortcodeLoader::getInstance()->load();
				add_action( 'init', array( $this, 'cpt_activation' ), 0 );
			}
		}

		function cpt_activation() {

			do_action('qode_startit_core_on_activate');

			CPT\PostTypesRegister::getInstance()->register();
			flush_rewrite_rules();
		}
	}

	StartitCore::get_instance();
}
