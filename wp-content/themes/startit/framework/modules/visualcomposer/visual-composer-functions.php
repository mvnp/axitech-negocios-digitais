<?php

if(!function_exists( 'startit_qode_vc_grid_elements_enabled' )) {

	/**
	 * Function that checks if Visual Composer Grid Elements are enabled
	 *
	 * @return bool
	 */
	function startit_qode_vc_grid_elements_enabled() {

		return ( startit_qode_options()->getOptionValue('enable_grid_elements') == 'yes') ? true : false;

	}
}

if(!function_exists( 'startit_qode_visual_composer_grid_elements' )) {

	/**
	 * Removes Visual Composer Grid Elements post type if VC Grid option disabled
	 * and enables Visual Composer Grid Elements post type
	 * if VC Grid option enabled
	 */
	function startit_qode_visual_composer_grid_elements() {

		if(!startit_qode_vc_grid_elements_enabled()) {
			remove_action('init', 'vc_grid_item_editor_create_post_type');
		}
	}

	add_action('vc_after_init', 'startit_qode_visual_composer_grid_elements', 12);
}

if(!function_exists( 'startit_qode_grid_elements_ajax_disable' )) {
	/**
	 * Function that disables ajax transitions if grid elements are enabled in theme options
	 */
	function startit_qode_grid_elements_ajax_disable() {
		$qode_startit_options = startit_qode_return_global_options();

		if(startit_qode_vc_grid_elements_enabled()) {
			$qode_startit_options['page_transitions'] = '0';
		}
	}

	add_action('wp', 'startit_qode_grid_elements_ajax_disable');
}


if(!function_exists( 'startit_qode_get_vc_version' )) {
	/**
	 * Return Visual Composer version string
	 *
	 * @return bool|string
	 */
	function startit_qode_get_vc_version() {
		if(startit_qode_visual_composer_installed()) {
			return WPB_VC_VERSION;
		}

		return false;
	}
}