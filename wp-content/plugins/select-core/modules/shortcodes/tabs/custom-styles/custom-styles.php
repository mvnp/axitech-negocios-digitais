<?php
if(!function_exists('qode_startit_tabs_typography_styles')){
	function qode_startit_tabs_typography_styles(){
		$selector = '.qodef-tabs .qodef-tabs-nav li a';
		$tabs_typography_array = array();

		$font_family = startit_qode_options()->getOptionValue('tabs_font_family');
		if(startit_qode_is_font_option_valid($font_family)){
            $tabs_typography_array['font-family'] = startit_qode_is_font_option_valid($font_family);
		}
		
		$text_transform = startit_qode_options()->getOptionValue('tabs_text_transform');
        if(!empty($text_transform)) {
            $tabs_typography_array['text-transform'] = $text_transform;
        }

        $font_style = startit_qode_options()->getOptionValue('tabs_font_style');
        if(!empty($font_style)) {
            $tabs_typography_array['font-style'] = $font_style;
        }

        $letter_spacing = startit_qode_options()->getOptionValue('tabs_letter_spacing');
        if($letter_spacing !== '') {
            $tabs_typography_array['letter-spacing'] = startit_qode_filter_px($letter_spacing) . 'px';
        }

        $font_weight = startit_qode_options()->getOptionValue('tabs_font_weight');
        if(!empty($font_weight)) {
            $tabs_typography_array['font-weight'] = $font_weight;
        }

        echo startit_qode_dynamic_css($selector, $tabs_typography_array);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_tabs_typography_styles');
}

if(!function_exists('qode_startit_tabs_inital_color_styles')){
	function qode_startit_tabs_inital_color_styles(){
		$selector = '.qodef-tabs .qodef-tabs-nav li a';
		$styles = array();
		
		if(startit_qode_options()->getOptionValue('tabs_color')) {
            $styles['color'] = startit_qode_options()->getOptionValue('tabs_color');
        }
		if(startit_qode_options()->getOptionValue('tabs_back_color')) {
            $styles['background-color'] = startit_qode_options()->getOptionValue('tabs_back_color');
        }
		if(startit_qode_options()->getOptionValue('tabs_border_color')) {
            $styles['border-color'] = startit_qode_options()->getOptionValue('tabs_border_color');
        }
		
		echo startit_qode_dynamic_css($selector, $styles);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_tabs_inital_color_styles');
}
if(!function_exists('qode_startit_tabs_active_color_styles')){
	function qode_startit_tabs_active_color_styles(){
		$selector = '.qodef-tabs .qodef-tabs-nav li.ui-state-active a, .qodef-tabs .qodef-tabs-nav li.ui-state-hover a';
		$styles = array();
		
		if(startit_qode_options()->getOptionValue('tabs_color_active')) {
            $styles['color'] = startit_qode_options()->getOptionValue('tabs_color_active');
        }
		if(startit_qode_options()->getOptionValue('tabs_back_color_active')) {
            $styles['background-color'] = startit_qode_options()->getOptionValue('tabs_back_color_active');
        }
		if(startit_qode_options()->getOptionValue('tabs_border_color_active')) {
            $styles['border-color'] = startit_qode_options()->getOptionValue('tabs_border_color_active');
        }
		
		echo startit_qode_dynamic_css($selector, $styles);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_tabs_active_color_styles');
}