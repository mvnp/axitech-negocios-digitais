<?php

if(!function_exists('qode_startit_load_widget_class')) {
	/**
	 * Loades widget class file.
	 *
	 */
	function qode_startit_load_widget_class(){
		include_once QODE_CORE_ABS_PATH.'/modules/widgets/lib/widget-class.php';
	}

	add_action('after_setup_theme', 'qode_startit_load_widget_class');
}

if(!function_exists('qode_startit_load_widgets')) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to qode_startit_after_options_map action
	 */
	function qode_startit_load_widgets() {

		foreach(glob(QODE_CORE_ABS_PATH.'/modules/widgets/*/load.php') as $widget_load) {
			include_once $widget_load;
		}

		include_once QODE_CORE_ABS_PATH.'/modules/widgets/lib/widget-loader.php';
	}

	add_action('after_setup_theme', 'qode_startit_load_widgets');
}
