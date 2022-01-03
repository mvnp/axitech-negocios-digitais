<?php

if(!function_exists( 'startit_select_is_css_folder_writable' )) {
	/**
	 * Function that checks if css folder is writable
	 * @return bool
	 *
	 * @version 0.1
	 * @uses is_writable()
	 */
	function startit_select_is_css_folder_writable() {
		$css_dir = QODE_ASSETS_ROOT_DIR.'/css';

		return is_writable($css_dir);
	}
}

if(!function_exists( 'startit_select_is_js_folder_writable' )) {
	/**
	 * Function that checks if js folder is writable
	 * @return bool
	 *
	 * @version 0.1
	 * @uses is_writable()
	 */
	function startit_select_is_js_folder_writable() {
		$js_dir = QODE_ASSETS_ROOT_DIR.'/js';

		return is_writable($js_dir);
	}
}

if(!function_exists( 'startit_select_assets_folders_writable' )) {
	/**
	 * Function that if css and js folders are writable
	 * @return bool
	 *
	 * @version 0.1
	 * @see startit_select_is_css_folder_writable()
	 * @see startit_select_is_js_folder_writable()
	 */
	function startit_select_assets_folders_writable() {
		return startit_select_is_css_folder_writable() && startit_select_is_js_folder_writable();
	}
}

if ( ! function_exists( 'startit_select_get_multisite_blog_id' ) ) {
	function startit_select_get_multisite_blog_id() {
		if ( is_multisite() ) {
			return get_blog_details()->blog_id;
		}
	}
}

if (!function_exists( 'startit_select_generate_dynamic_css_and_js' )){
	/**
	 * Function that gets content of dynamic assets files and puts that in static ones
	 */
	function startit_select_generate_dynamic_css_and_js() {

		global $wp_filesystem;
		WP_Filesystem();

		if ( startit_select_is_css_folder_writable() ) {

			ob_start();
			include_once QODE_ASSETS_ROOT_DIR . '/css/style_dynamic.php';
			$css = ob_get_clean();
			if ( is_multisite() ) {
				$wp_filesystem->put_contents( QODE_ASSETS_ROOT_DIR . '/css/style_dynamic_ms_id_' . startit_select_get_multisite_blog_id() . '.css', $css );
			} else {
				$wp_filesystem->put_contents( QODE_ASSETS_ROOT_DIR . '/css/style_dynamic.css', $css );
			}

			ob_start();
			include_once QODE_ASSETS_ROOT_DIR . '/css/style_dynamic_responsive.php';
			$css = ob_get_clean();
			if ( is_multisite() ) {
				$wp_filesystem->put_contents( QODE_ASSETS_ROOT_DIR . '/css/style_dynamic_responsive_ms_id_' . startit_select_get_multisite_blog_id() . '.css', $css );
			} else {
				$wp_filesystem->put_contents( QODE_ASSETS_ROOT_DIR . '/css/style_dynamic_responsive.css', $css );
			}
		}
		
	}

	add_action('qode_startit_after_theme_option_save', 'startit_select_generate_dynamic_css_and_js');
}


