<?php
	if(!function_exists( 'startit_qode_layerslider_overrides' )) {
		/**
		 * Disables Layer Slider auto update box
		 */
		function startit_qode_layerslider_overrides() {
			$GLOBALS['lsAutoUpdateBox'] = false;
		}

		add_action('layerslider_ready', 'startit_qode_layerslider_overrides');
	}
?>