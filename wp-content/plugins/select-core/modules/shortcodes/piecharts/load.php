<?php

//Pie Chart Basic
include_once QODE_CORE_MODULES_ABS_PATH.'/shortcodes/piecharts/piechartbasic/load.php';

//Pie Chart Basic
include_once QODE_CORE_MODULES_ABS_PATH.'/shortcodes/piecharts/piechartwithicon/load.php';

//Pie Chart Pie
include_once QODE_CORE_MODULES_ABS_PATH.'/shortcodes/piecharts/piechartpie/load.php';

//Pie Chart Doughnut
include_once QODE_CORE_MODULES_ABS_PATH.'/shortcodes/piecharts/piechartdoughnut/load.php';


if(!function_exists('qode_core_include_elementor_pie_chart_shortcodes')) {
	function qode_core_include_elementor_pie_chart_shortcodes() {
		if( qode_core_is_elementor_installed() && select_core_is_theme_registered() ) {
			foreach (glob(QODE_CORE_MODULES_ABS_PATH . '/shortcodes/piecharts/*/elementor-*.php') as $shortcode_load) {
				include_once $shortcode_load;
			}
		}
	}
	
	add_action('init', 'qode_core_include_elementor_pie_chart_shortcodes');
}
