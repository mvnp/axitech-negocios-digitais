<?php

if(!function_exists( 'startit_qode_header_register_main_navigation' )) {
    /**
     * Registers main navigation
     */
    function startit_qode_header_register_main_navigation() {
        register_nav_menus(
            array(
                'main-navigation' => esc_html__('Main Navigation', 'startit')
            )
        );
    }

    add_action('after_setup_theme', 'startit_qode_header_register_main_navigation');
}

if(!function_exists( 'startit_qode_is_top_bar_transparent' )) {
    /**
     * Checks if top bar is transparent or not
     *
     * @return bool
     */
    function startit_qode_is_top_bar_transparent() {
        $top_bar_enabled = startit_qode_is_top_bar_enabled();

        $top_bar_bg_color = startit_qode_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = startit_qode_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency >= 0 && $top_bar_transparency < 1;
        }

        return false;
    }
}

if(!function_exists( 'startit_qode_is_top_bar_completely_transparent' )) {
    function startit_qode_is_top_bar_completely_transparent() {
        $top_bar_enabled = startit_qode_is_top_bar_enabled();

        $top_bar_bg_color = startit_qode_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = startit_qode_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency === '0';
        }

        return false;
    }
}

if(!function_exists( 'startit_qode_is_top_bar_enabled' )) {
    function startit_qode_is_top_bar_enabled() {

        $top_bar_enabled = startit_qode_get_meta_field_intersect('top_bar') == 'yes';

        return $top_bar_enabled;
    }
}

if(!function_exists( 'startit_qode_get_top_bar_height' )) {
    /**
     * Returns top bar height
     *
     * @return bool|int|void
     */
    function startit_qode_get_top_bar_height() {
        if(startit_qode_is_top_bar_enabled()) {
            $top_bar_height = startit_qode_filter_px(startit_qode_options()->getOptionValue('top_bar_height'));

            return $top_bar_height !== '' ? intval($top_bar_height) : 40;
        }

        return 0;
    }
}

if(!function_exists( 'startit_qode_get_sticky_header_height' )) {
    /**
     * Returns top sticky header height
     *
     * @return bool|int|void
     */
    function startit_qode_get_sticky_header_height() {
        //sticky menu height, needed only for sticky header on scroll up
        if( startit_qode_get_meta_field_intersect('header_type') !== 'header-vertical' &&
            in_array(startit_qode_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up'))) {

            $sticky_header_height = startit_qode_filter_px(startit_qode_options()->getOptionValue('sticky_header_height'));

            return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
        }

        return 0;

    }
}

if(!function_exists( 'startit_qode_get_sticky_header_height_of_complete_transparency' )) {
    /**
     * Returns top sticky header height it is fully transparent. used in anchor logic
     *
     * @return bool|int|void
     */
    function startit_qode_get_sticky_header_height_of_complete_transparency() {

        if( startit_qode_get_meta_field_intersect('header_type') !== 'header-vertical') {
            if( startit_qode_options()->getOptionValue('sticky_header_transparency') === '0') {
                $stickyHeaderTransparent = startit_qode_options()->getOptionValue('sticky_header_grid_background_color') !== '' &&
                                           startit_qode_options()->getOptionValue('sticky_header_grid_transparency') === '0';
            } else {
                $stickyHeaderTransparent = startit_qode_options()->getOptionValue('sticky_header_background_color') !== '' &&
                                           startit_qode_options()->getOptionValue('sticky_header_transparency') === '0';
            }

            if($stickyHeaderTransparent) {
                return 0;
            } else {
                $sticky_header_height = startit_qode_filter_px(startit_qode_options()->getOptionValue('sticky_header_height'));

                return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
            }
        }
        return 0;
    }
}

if(!function_exists( 'startit_qode_get_sticky_scroll_amount' )) {
    /**
     * Returns top sticky scroll amount
     *

     * @return bool|int|void
     */
    function startit_qode_get_sticky_scroll_amount() {

        //sticky menu scroll amount
        if( startit_qode_get_meta_field_intersect('header_type') !== 'header-vertical' &&
            in_array(startit_qode_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {

            if(startit_qode_get_meta_field_intersect('qodef_scroll_amount_for_sticky')) {
                $sticky_scroll_amount = startit_qode_filter_px(startit_qode_get_meta_field_intersect('qodef_scroll_amount_for_sticky'));
            }
            else {
                $sticky_scroll_amount = startit_qode_filter_px(startit_qode_options()->getOptionValue('scroll_amount_for_sticky'));
            }

            return $sticky_scroll_amount !== '' ? intval($sticky_scroll_amount) : 0;
        }

        return 0;

    }
}

