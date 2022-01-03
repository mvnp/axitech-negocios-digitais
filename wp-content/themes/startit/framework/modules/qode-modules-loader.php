<?php

if(!function_exists( 'startit_qode_load_modules' )) {
    /**
     * Loades all modules by going through all folders that are placed directly in modules folder
     * and loads load.php file in each. Hooks to qode_startit_after_options_map action
     *
     * @see http://php.net/manual/en/function.glob.php
     */
    function startit_qode_load_modules() {
        foreach(glob(QODE_FRAMEWORK_ROOT_DIR.'/modules/*/load.php') as $module_load) {
            include_once $module_load;
        }
    }

    add_action('qode_startit_before_options_map', 'startit_qode_load_modules');
}