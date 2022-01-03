<?php

if(!function_exists( 'startit_qode_mobile_header_general_styles' )) {
    /**
     * Generates general custom styles for mobile header
     */
    function startit_qode_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if( startit_qode_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('mobile_header_height')) . 'px';
        }

        if(startit_qode_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = startit_qode_options()->getOptionValue('mobile_header_background_color');
        }

        echo startit_qode_dynamic_css('.qodef-mobile-header .qodef-mobile-header-inner', $mobile_header_styles);
    }

    add_action('qode_startit_style_dynamic', 'startit_qode_mobile_header_general_styles');
}

if(!function_exists( 'startit_qode_mobile_navigation_styles' )) {
    /**
     * Generates styles for mobile navigation
     */
    function startit_qode_mobile_navigation_styles() {
        $mobile_nav_styles = array();
        if(startit_qode_options()->getOptionValue('mobile_menu_background_color')) {
            $mobile_nav_styles['background-color'] = startit_qode_options()->getOptionValue('mobile_menu_background_color');
        }

        echo startit_qode_dynamic_css('.qodef-mobile-header .qodef-mobile-nav', $mobile_nav_styles);

        $mobile_nav_item_styles = array();
        if( startit_qode_options()->getOptionValue('mobile_menu_separator_color') !== '') {
            $mobile_nav_item_styles['border-bottom-color'] = startit_qode_options()->getOptionValue('mobile_menu_separator_color');
        }

        if( startit_qode_options()->getOptionValue('mobile_text_color') !== '') {
            $mobile_nav_item_styles['color'] = startit_qode_options()->getOptionValue('mobile_text_color');
        }

        if(startit_qode_is_font_option_valid(startit_qode_options()->getOptionValue('mobile_font_family'))) {
            $mobile_nav_item_styles['font-family'] = startit_qode_get_formatted_font_family(startit_qode_options()->getOptionValue('mobile_font_family'));
        }

        if( startit_qode_options()->getOptionValue('mobile_font_size') !== '') {
            $mobile_nav_item_styles['font-size'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('mobile_font_size')) . 'px';
        }

        if( startit_qode_options()->getOptionValue('mobile_line_height') !== '') {
            $mobile_nav_item_styles['line-height'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('mobile_line_height')) . 'px';
        }

        if( startit_qode_options()->getOptionValue('mobile_text_transform') !== '') {
            $mobile_nav_item_styles['text-transform'] = startit_qode_options()->getOptionValue('mobile_text_transform');
        }

        if( startit_qode_options()->getOptionValue('mobile_font_style') !== '') {
            $mobile_nav_item_styles['font-style'] = startit_qode_options()->getOptionValue('mobile_font_style');
        }

        if( startit_qode_options()->getOptionValue('mobile_font_weight') !== '') {
            $mobile_nav_item_styles['font-weight'] = startit_qode_options()->getOptionValue('mobile_font_weight');
        }

        $mobile_nav_item_selector = array(
            '.qodef-mobile-header .qodef-mobile-nav a',
            '.qodef-mobile-header .qodef-mobile-nav h4'
        );

        echo startit_qode_dynamic_css($mobile_nav_item_selector, $mobile_nav_item_styles);

        $mobile_nav_item_hover_styles = array();
        if( startit_qode_options()->getOptionValue('mobile_text_hover_color') !== '') {
            $mobile_nav_item_hover_styles['color'] = startit_qode_options()->getOptionValue('mobile_text_hover_color');
        }

        $mobile_nav_item_selector_hover = array(
            '.qodef-mobile-header .qodef-mobile-nav a:hover',
            '.qodef-mobile-header .qodef-mobile-nav h4:hover'
        );

        echo startit_qode_dynamic_css($mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles);
    }

    add_action('qode_startit_style_dynamic', 'startit_qode_mobile_navigation_styles');
}

if(!function_exists( 'startit_qode_mobile_logo_styles' )) {
    /**
     * Generates styles for mobile logo
     */
    function startit_qode_mobile_logo_styles() {
        if( startit_qode_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo startit_qode_dynamic_css(
                '.qodef-mobile-header .qodef-mobile-logo-wrapper a',
                array('height' => startit_qode_filter_px(startit_qode_options()->getOptionValue('mobile_logo_height')) . 'px !important')
            ); ?>
            }
        <?php }

        if( startit_qode_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo startit_qode_dynamic_css(
                '.qodef-mobile-header .qodef-mobile-logo-wrapper a',
                array('height' => startit_qode_filter_px(startit_qode_options()->getOptionValue('mobile_logo_height_phones')) . 'px !important')
            ); ?>
            }
        <?php }

        if( startit_qode_options()->getOptionValue('mobile_header_height') !== '') {
            $max_height = intval( startit_qode_filter_px(startit_qode_options()->getOptionValue('mobile_header_height')) * 0.9) . 'px';
            echo startit_qode_dynamic_css('.qodef-mobile-header .qodef-mobile-logo-wrapper a', array( 'max-height' => $max_height));
        }
    }

    add_action('qode_startit_style_dynamic', 'startit_qode_mobile_logo_styles');
}

if(!function_exists( 'startit_qode_mobile_icon_styles' )) {
    /**
     * Generates styles for mobile icon opener
     */
    function startit_qode_mobile_icon_styles() {
        $mobile_icon_styles = array();
        if( startit_qode_options()->getOptionValue('mobile_icon_color') !== '') {
            $mobile_icon_styles['color'] = startit_qode_options()->getOptionValue('mobile_icon_color');
        }

        if( startit_qode_options()->getOptionValue('mobile_icon_size') !== '') {
            $mobile_icon_styles['font-size'] = startit_qode_filter_px(startit_qode_options()->getOptionValue('mobile_icon_size')) . 'px';
        }

        echo startit_qode_dynamic_css('.qodef-mobile-header .qodef-mobile-menu-opener a', $mobile_icon_styles);

        if( startit_qode_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo startit_qode_dynamic_css(
                '.qodef-mobile-header .qodef-mobile-menu-opener a:hover',
                array('color' => startit_qode_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('qode_startit_style_dynamic', 'startit_qode_mobile_icon_styles');
}