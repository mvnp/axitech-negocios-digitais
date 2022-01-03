<?php

if(!function_exists( 'startit_qode_get_button_html' )) {
    /**
     * Calls button shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function startit_qode_get_button_html($params) {
        $button_html = startit_qode_execute_shortcode('qodef_button', $params);
        $button_html = str_replace("\n", '', $button_html);
        return $button_html;
    }
}