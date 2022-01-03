<?php

require_once QODE_CORE_ABS_PATH . '/post-types/portfolio/portfolio-register.php';
require_once QODE_CORE_ABS_PATH . '/post-types/portfolio/shortcodes/portfolio-list.php';
require_once QODE_CORE_ABS_PATH . '/post-types/portfolio/shortcodes/portfolio-slider.php';

require_once QODE_CORE_ABS_PATH . '/post-types/testimonials/testimonials-register.php';
require_once QODE_CORE_ABS_PATH . '/post-types/testimonials/shortcodes/testimonials.php';

require_once QODE_CORE_ABS_PATH . '/post-types/carousels/carousel-register.php';
require_once QODE_CORE_ABS_PATH . '/post-types/carousels/shortcodes/carousel.php';

require_once QODE_CORE_ABS_PATH . '/post-types/slider/slider-register.php';
require_once QODE_CORE_ABS_PATH . '/post-types/slider/tax-custom-fields.php';
require_once QODE_CORE_ABS_PATH . '/post-types/slider/shortcodes/slider.php';

require_once QODE_CORE_ABS_PATH . '/post-types/post-types-register.php'; //this has to be loaded last

if(!function_exists('qode_core_include_elementor_shortcodes_from_post_types')) {
	function qode_core_include_elementor_shortcodes_from_post_types() {
		if( qode_core_is_elementor_installed() && select_core_is_theme_registered() ) {
			foreach (glob(QODE_CORE_ABS_PATH . '/post-types/*/shortcodes/elementor-*.php') as $shortcode_load) {
				include_once $shortcode_load;
			}
		}
	}
	
	add_action('init', 'qode_core_include_elementor_shortcodes_from_post_types');
}
