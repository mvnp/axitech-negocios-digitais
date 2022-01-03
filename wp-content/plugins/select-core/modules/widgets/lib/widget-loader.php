<?php

if (!function_exists('qode_startit_register_widgets')) {

	function qode_startit_register_widgets() {

		$widgets = array(
			'QodeStartitFullScreenMenuOpener',
			'QodeStartitLatestPosts',
			'QodeStartitSearchOpener',
			'QodeStartitSideAreaOpener',
			'QodeStartitStickySidebar',
            'QodeStartitSeparatorWidget'
		);

		foreach ($widgets as $widget) {
			register_widget($widget);
		}

	}

}

add_action('widgets_init', 'qode_startit_register_widgets');