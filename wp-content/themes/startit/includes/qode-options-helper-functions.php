<?php

if(!function_exists( 'startit_qode_is_responsive_on' )) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function startit_qode_is_responsive_on() {
        return startit_qode_options()->getOptionValue('responsiveness') !== 'no';
    }
}

if(!function_exists( 'startit_qode_is_seo_enabled' )) {
    /**
     * Checks if SEO is enabled in theme options
     * @return bool
     */
    function startit_qode_is_seo_enabled() {
        return startit_qode_options()->getOptionValue('disable_seo') == 'no';
    }
}