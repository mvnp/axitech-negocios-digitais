<?php

if( !function_exists( 'startit_qode_search_body_class' ) ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function startit_qode_search_body_class($classes) {

		if ( is_active_widget( false, false, 'qode_search_opener' ) ) {

			$classes[] = 'qodef-' . startit_qode_options()->getOptionValue('search_type');

			if ( startit_qode_options()->getOptionValue('search_type') == 'fullscreen-search' ) {

				$classes[] = 'qodef-' . startit_qode_options()->getOptionValue('search_animation');

			}

		}
		return $classes;

	}

	add_filter('body_class', 'startit_qode_search_body_class');
}

if ( ! function_exists( 'startit_qode_get_search' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function startit_qode_get_search() {

		if ( startit_qode_active_widget( false, false, 'qode_search_opener' ) ) {

			$search_type = startit_qode_options()->getOptionValue('search_type');

			if ($search_type == 'search-covers-header') {
				startit_qode_set_position_for_covering_search();
				return;
			} else if ($search_type == 'search-slides-from-window-top') {
				startit_qode_set_search_position_in_menu( $search_type );
				if ( startit_qode_is_responsive_on() ) {
					startit_qode_set_search_position_mobile();
				}
				return;
			}

			startit_qode_load_search_template();

		}
	}

}

if ( ! function_exists( 'startit_qode_set_position_for_covering_search' ) ) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function startit_qode_set_position_for_covering_search() {

		$containing_sidebar = startit_qode_active_widget( false, false, 'qode_search_opener' );

		foreach ($containing_sidebar as $sidebar) {

			if ( strpos( $sidebar, 'top-bar' ) !== false ) {
				add_action( 'qode_startit_after_header_top_html_open', 'startit_qode_load_search_template');
			} else if ( strpos( $sidebar, 'main-menu' ) !== false ) {
				add_action( 'qode_startit_after_header_menu_area_html_open', 'startit_qode_load_search_template');
			} else if ( strpos( $sidebar, 'mobile-logo' ) !== false ) {
				add_action( 'qode_startit_after_mobile_header_html_open', 'startit_qode_load_search_template');
			} else if ( strpos( $sidebar, 'logo' ) !== false ) {
				add_action( 'qode_startit_after_header_logo_area_html_open', 'startit_qode_load_search_template');
			} else if ( strpos( $sidebar, 'sticky' ) !== false ) {
				add_action( 'qode_startit_after_sticky_menu_html_open', 'startit_qode_load_search_template');
			}

		}

	}

}

if ( ! function_exists( 'startit_qode_set_search_position_in_menu' ) ) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function startit_qode_set_search_position_in_menu( $type ) {

		add_action( 'qode_startit_after_header_menu_area_html_open', 'startit_qode_load_search_template');

	}
}

if ( ! function_exists( 'startit_qode_set_search_position_mobile' ) ) {
	/**
	 * Hooks search template to mobile header
	 */
	function startit_qode_set_search_position_mobile() {

		add_action( 'qode_startit_after_mobile_header_html_open', 'startit_qode_load_search_template');

	}

}

if ( ! function_exists('startit_qode_load_search_template') ) {
	/**
	 * Loads HTML template with parameters
	 */
	function startit_qode_load_search_template() {
		$qode_startit_IconCollections = startit_qode_return_icon_collection();

		$search_type = startit_qode_options()->getOptionValue('search_type');

		$search_icon = '';
		$search_icon_close = '';
		if ( startit_qode_options()->getOptionValue('search_icon_pack') !== '' ) {
			$search_icon = $qode_startit_IconCollections->getSearchIcon( startit_qode_options()->getOptionValue('search_icon_pack'), true );
			$search_icon_close = $qode_startit_IconCollections->getSearchClose( startit_qode_options()->getOptionValue('search_icon_pack'), true );
		}

		$parameters = array(
			'search_in_grid'		=> startit_qode_get_meta_field_intersect('search_in_grid') == 'yes' ? true : false,
			'search_icon'			=> $search_icon,
			'search_icon_close'		=> $search_icon_close
		);

		startit_qode_get_module_template_part( 'templates/types/' . $search_type, 'search', '', $parameters );

	}

}