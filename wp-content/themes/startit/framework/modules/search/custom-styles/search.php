<?php

if (!function_exists( 'startit_qode_search_covers_header_style' )) {

	function startit_qode_search_covers_header_style()
	{

		if ( startit_qode_options()->getOptionValue('search_height') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-slide-header-bottom.qodef-animated .qodef-form-holder-outer, .qodef-search-slide-header-bottom .qodef-form-holder-outer, .qodef-search-slide-header-bottom', array(
				'height' => startit_qode_filter_px(startit_qode_options()->getOptionValue('search_height')) . 'px'
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'startit_qode_search_covers_header_style');

}

if (!function_exists( 'startit_qode_search_opener_icon_size' )) {

	function startit_qode_search_opener_icon_size()
	{

		if (startit_qode_options()->getOptionValue('header_search_icon_size')) {
			echo startit_qode_dynamic_css('.qodef-search-opener', array(
				'font-size' => startit_qode_filter_px(startit_qode_options()->getOptionValue('header_search_icon_size')) . 'px'
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'startit_qode_search_opener_icon_size');

}

if (!function_exists( 'startit_qode_search_opener_icon_colors' )) {

	function startit_qode_search_opener_icon_colors()
	{

		if ( startit_qode_options()->getOptionValue('header_search_icon_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-opener', array(
				'color' => startit_qode_options()->getOptionValue('header_search_icon_color')
			));
		}

		if ( startit_qode_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-opener:hover', array(
				'color' => startit_qode_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

		if ( startit_qode_options()->getOptionValue('header_light_search_icon_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener,
			.qodef-light-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener,
			.qodef-light-header .qodef-top-bar .qodef-search-opener', array(
				'color' => startit_qode_options()->getOptionValue('header_light_search_icon_color') . ' !important'
			));
		}

		if ( startit_qode_options()->getOptionValue('header_light_search_icon_hover_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener:hover,
			.qodef-light-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener:hover,
			.qodef-light-header .qodef-top-bar .qodef-search-opener:hover', array(
				'color' => startit_qode_options()->getOptionValue('header_light_search_icon_hover_color') . ' !important'
			));
		}

		if ( startit_qode_options()->getOptionValue('header_dark_search_icon_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener,
			.qodef-dark-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener,
			.qodef-dark-header .qodef-top-bar .qodef-search-opener', array(
				'color' => startit_qode_options()->getOptionValue('header_dark_search_icon_color') . ' !important'
			));
		}
		if ( startit_qode_options()->getOptionValue('header_dark_search_icon_hover_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener:hover,
			.qodef-dark-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener:hover,
			.qodef-dark-header .qodef-top-bar .qodef-search-opener:hover', array(
				'color' => startit_qode_options()->getOptionValue('header_dark_search_icon_hover_color') . ' !important'
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'startit_qode_search_opener_icon_colors');

}

if (!function_exists( 'startit_qode_search_opener_icon_background_colors' )) {

	function startit_qode_search_opener_icon_background_colors()
	{

		if ( startit_qode_options()->getOptionValue('search_icon_background_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-opener', array(
				'background-color' => startit_qode_options()->getOptionValue('search_icon_background_color')
			));
		}

		if ( startit_qode_options()->getOptionValue('search_icon_background_hover_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-opener:hover', array(
				'background-color' => startit_qode_options()->getOptionValue('search_icon_background_hover_color')
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'startit_qode_search_opener_icon_background_colors');
}

if (!function_exists( 'startit_qode_search_opener_text_styles' )) {

	function startit_qode_search_opener_text_styles()
	{
		$text_styles = array();

		if ( startit_qode_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = startit_qode_options()->getOptionValue('search_icon_text_color');
		}
		if ( startit_qode_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('search_icon_text_fontsize')) . 'px';
		}
		if ( startit_qode_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('search_icon_text_lineheight')) . 'px';
		}
		if ( startit_qode_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = startit_qode_options()->getOptionValue('search_icon_text_texttransform');
		}
		if ( startit_qode_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = startit_qode_get_formatted_font_family(startit_qode_options()->getOptionValue('search_icon_text_google_fonts')) . ', sans-serif';
		}
		if ( startit_qode_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = startit_qode_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if ( startit_qode_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = startit_qode_options()->getOptionValue('search_icon_text_fontweight');
		}

		if (!empty($text_styles)) {
			echo startit_qode_dynamic_css('.qodef-search-icon-text', $text_styles);
		}
		if ( startit_qode_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-opener:hover .qodef-search-icon-text', array(
				'color' => startit_qode_options()->getOptionValue('search_icon_text_color_hover')
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'startit_qode_search_opener_text_styles');
}

if (!function_exists( 'startit_qode_search_opener_spacing' )) {

	function startit_qode_search_opener_spacing()
	{
		$spacing_styles = array();

		if ( startit_qode_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('search_padding_left')) . 'px';
		}
		if ( startit_qode_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('search_padding_right')) . 'px';
		}
		if ( startit_qode_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('search_margin_left')) . 'px';
		}
		if ( startit_qode_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('search_margin_right')) . 'px';
		}

		if (!empty($spacing_styles)) {
			echo startit_qode_dynamic_css('.qodef-search-opener', $spacing_styles);
		}

	}

	add_action('qode_startit_style_dynamic', 'startit_qode_search_opener_spacing');
}

if (!function_exists( 'startit_qode_search_bar_background' )) {

	function startit_qode_search_bar_background()
	{

		if ( startit_qode_options()->getOptionValue('search_background_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-slide-header-bottom, .qodef-search-cover,.qodef-header-overlapping .qodef-search-cover .qodef-form-holder-outer, .qodef-search-fade .qodef-fullscreen-search-holder .qodef-fullscreen-search-table, .qodef-fullscreen-search-overlay, .qodef-search-slide-window-top, .qodef-search-slide-window-top input[type="text"]', array(
				'background-color' => startit_qode_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('qode_startit_style_dynamic', 'startit_qode_search_bar_background');
}

if (!function_exists( 'startit_qode_search_text_styles' )) {

	function startit_qode_search_text_styles()
	{
		$text_styles = array();

		if ( startit_qode_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = startit_qode_options()->getOptionValue('search_text_color');
		}
		if ( startit_qode_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('search_text_fontsize')) . 'px';
		}
		if ( startit_qode_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = startit_qode_options()->getOptionValue('search_text_texttransform');
		}
		if ( startit_qode_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = startit_qode_get_formatted_font_family(startit_qode_options()->getOptionValue('search_text_google_fonts')) . ', sans-serif';
		}
		if ( startit_qode_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = startit_qode_options()->getOptionValue('search_text_fontstyle');
		}
		if ( startit_qode_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = startit_qode_options()->getOptionValue('search_text_fontweight');
		}
		if ( startit_qode_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('search_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo startit_qode_dynamic_css('.qodef-search-slide-header-bottom input[type="text"], .qodef-search-cover input[type="text"], .qodef-fullscreen-search-holder .qodef-search-field, .qodef-search-slide-window-top input[type="text"]', $text_styles);
		}
		if ( startit_qode_options()->getOptionValue('search_text_disabled_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-slide-header-bottom.qodef-disabled input[type="text"]::-webkit-input-placeholder, .qodef-search-slide-header-bottom.qodef-disabled input[type="text"]::-moz-input-placeholder', array(
				'color' => startit_qode_options()->getOptionValue('search_text_disabled_color')
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'startit_qode_search_text_styles');
}

if (!function_exists( 'startit_qode_search_label_styles' )) {

	function startit_qode_search_label_styles()
	{
		$text_styles = array();

		if ( startit_qode_options()->getOptionValue('search_label_text_color') !== '') {
			$text_styles['color'] = startit_qode_options()->getOptionValue('search_label_text_color');
		}
		if ( startit_qode_options()->getOptionValue('search_label_text_fontsize') !== '') {
			$text_styles['font-size'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('search_label_text_fontsize')) . 'px';
		}
		if ( startit_qode_options()->getOptionValue('search_label_text_texttransform') !== '') {
			$text_styles['text-transform'] = startit_qode_options()->getOptionValue('search_label_text_texttransform');
		}
		if ( startit_qode_options()->getOptionValue('search_label_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = startit_qode_get_formatted_font_family(startit_qode_options()->getOptionValue('search_label_text_google_fonts')) . ', sans-serif';
		}
		if ( startit_qode_options()->getOptionValue('search_label_text_fontstyle') !== '') {
			$text_styles['font-style'] = startit_qode_options()->getOptionValue('search_label_text_fontstyle');
		}
		if ( startit_qode_options()->getOptionValue('search_label_text_fontweight') !== '') {
			$text_styles['font-weight'] = startit_qode_options()->getOptionValue('search_label_text_fontweight');
		}
		if ( startit_qode_options()->getOptionValue('search_label_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('search_label_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo startit_qode_dynamic_css('.qodef-fullscreen-search-holder .qodef-search-label', $text_styles);
		}

	}

	add_action('qode_startit_style_dynamic', 'startit_qode_search_label_styles');
}

if (!function_exists( 'startit_qode_search_icon_styles' )) {

	function startit_qode_search_icon_styles()
	{

		if ( startit_qode_options()->getOptionValue('search_icon_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-slide-window-top > i, .qodef-search-slide-header-bottom .qodef-search-submit i, .qodef-fullscreen-search-holder .qodef-search-submit', array(
				'color' => startit_qode_options()->getOptionValue('search_icon_color')
			));
		}
		if ( startit_qode_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-slide-window-top > i:hover, .qodef-search-slide-header-bottom .qodef-search-submit i:hover, .qodef-fullscreen-search-holder .qodef-search-submit:hover', array(
				'color' => startit_qode_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if ( startit_qode_options()->getOptionValue('search_icon_disabled_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-slide-header-bottom.qodef-disabled .qodef-search-submit i, .qodef-search-slide-header-bottom.qodef-disabled .qodef-search-submit i:hover', array(
				'color' => startit_qode_options()->getOptionValue('search_icon_disabled_color')
			));
		}
		if ( startit_qode_options()->getOptionValue('search_icon_size') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-slide-window-top > i, .qodef-search-slide-header-bottom .qodef-search-submit i, .qodef-fullscreen-search-holder .qodef-search-submit', array(
				'font-size' => startit_qode_filter_px(startit_qode_options()->getOptionValue('search_icon_size')) . 'px'
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'startit_qode_search_icon_styles');
}

if (!function_exists( 'startit_qode_search_close_icon_styles' )) {

	function startit_qode_search_close_icon_styles()
	{

		if ( startit_qode_options()->getOptionValue('search_close_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-slide-window-top .qodef-search-close i, .qodef-search-cover .qodef-search-close i, .qodef-fullscreen-search-close i', array(
				'color' => startit_qode_options()->getOptionValue('search_close_color')
			));
		}
		if ( startit_qode_options()->getOptionValue('search_close_hover_color') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-slide-window-top .qodef-search-close i:hover, .qodef-search-cover .qodef-search-close i:hover, .qodef-fullscreen-search-close i:hover', array(
				'color' => startit_qode_options()->getOptionValue('search_close_hover_color')
			));
		}
		if ( startit_qode_options()->getOptionValue('search_close_size') !== '') {
			echo startit_qode_dynamic_css('.qodef-search-slide-window-top .qodef-search-close i, .qodef-search-cover .qodef-search-close i, .qodef-fullscreen-search-close i', array(
				'font-size' => startit_qode_filter_px(startit_qode_options()->getOptionValue('search_close_size')) . 'px'
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'startit_qode_search_close_icon_styles');
}

?>
