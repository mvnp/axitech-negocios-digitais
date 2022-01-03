<?php

if (!function_exists( 'startit_qode_register_footer_sidebar' )) {

	function startit_qode_register_footer_sidebar() {

		register_sidebar(array(
			'name'          => esc_html__( 'Footer Column 1','startit'),
			'id'            => 'footer_column_1',
			'description'   => esc_html__( 'Widgets added here will appear in the first column of top footer area','startit'),
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-1 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name'          => esc_html__( 'Footer Column 2','startit'),
			'id'            => 'footer_column_2',
			'description'   => esc_html__( 'Widgets added here will appear in the second column of top footer area','startit'),
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-2 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name'          => esc_html__( 'Footer Column 3','startit'),
			'id'            => 'footer_column_3',
			'description'   => esc_html__( 'Widgets added here will appear in the third column of top footer area','startit'),
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-3 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name'          => esc_html__( 'Footer Column 4','startit'),
			'id'            => 'footer_column_4',
			'description'   => esc_html__( 'Widgets added here will appear in the fourth column of top footer area','startit'),
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-4 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name'          => esc_html__( 'Footer Bottom','startit'),
			'id' => 'footer_text',
			'description'   => esc_html__( 'Widgets added here will appear in the area of bottom footer area','startit'),
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-text %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name'          => esc_html__( 'Footer Bottom Left','startit'),
			'id'            => 'footer_bottom_left',
			'description'   => esc_html__( 'Widgets added here will appear in the first column of bottom footer area','startit'),
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-bottom-left %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name'          => esc_html__( 'Footer Bottom Right','startit'),
			'id'            => 'footer_bottom_right',
			'description'   => esc_html__( 'Widgets added here will appear in the second column of bottom footer area','startit'),
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-bottom-left %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

	}

	add_action('widgets_init', 'startit_qode_register_footer_sidebar');

}

if (!function_exists( 'startit_qode_get_footer' )) {
	/**
	 * Loads footer HTML
	 */
	function startit_qode_get_footer() {

		$parameters = array();
		$id = startit_qode_get_page_id();
		$parameters['footer_classes'] = startit_qode_get_footer_classes($id);
		$parameters['display_footer_top'] = ( startit_qode_options()->getOptionValue('show_footer_top') == 'yes') ? true : false;
		$parameters['display_footer_bottom'] = ( startit_qode_options()->getOptionValue('show_footer_bottom') == 'yes') ? true : false;

		if(!is_active_sidebar('footer_column_1') && !is_active_sidebar('footer_column_2') && !is_active_sidebar('footer_column_3') && !is_active_sidebar('footer_column_4')) {
			$parameters['display_footer_top'] = false;
		}
		if(!is_active_sidebar('footer_bottom_left') && !is_active_sidebar('footer_bottom_right') && !is_active_sidebar('footer_text')) {
			$parameters['display_footer_bottom'] = false;
		}

		startit_qode_get_module_template_part('templates/footer', 'footer', '', $parameters);

	}

}

if (!function_exists( 'startit_qode_get_content_bottom_area' )) {
	/**
	 * Loads content bottom area HTML with all needed parameters
	 */
	function startit_qode_get_content_bottom_area() {

		$parameters = array();

		//Current page id
		$id = startit_qode_get_page_id();

		//is content bottom area enabled for current page?

        if( startit_qode_get_meta_field_intersect('qodef_enable_content_bottom_area', $id)) {
            $parameters['content_bottom_area'] = startit_qode_get_meta_field_intersect('qodef_enable_content_bottom_area', $id);
        }
        else {
            $parameters['content_bottom_area'] = startit_qode_options()->getOptionValue('enable_content_bottom_area');
        }
		if ($parameters['content_bottom_area'] == 'yes') {
			//Sidebar for content bottom area
            if( startit_qode_get_meta_field_intersect('qodef_content_bottom_sidebar_custom_display', $id)) {
                $parameters['content_bottom_area_sidebar'] = startit_qode_get_meta_field_intersect('qodef_content_bottom_sidebar_custom_display');
            }
			else {
                $parameters['content_bottom_area_sidebar'] = startit_qode_options()->getOptionValue('content_bottom_sidebar_custom_display');
            }
			//Content bottom area in grid
            if( startit_qode_get_meta_field_intersect('qodef_content_bottom_in_grid', $id)) {
                $parameters['content_bottom_area_in_grid'] = startit_qode_get_meta_field_intersect('qodef_content_bottom_in_grid');
            }
            else {
                $parameters['content_bottom_area_in_grid'] = startit_qode_options()->getOptionValue('content_bottom_in_grid');
            }
			//Content bottom area background color
            if( startit_qode_get_meta_field_intersect('qodef_content_bottom_background_color', $id)) {
                $parameters['content_bottom_background_color'] = 'background-color: ' . startit_qode_get_meta_field_intersect('qodef_content_bottom_background_color');
            }
            else {
                $parameters['content_bottom_background_color'] = 'background-color: ' . startit_qode_options()->getOptionValue('content_bottom_background_color');
            }
		}

		startit_qode_get_module_template_part('templates/parts/content-bottom-area', 'footer', '', $parameters);

	}

}

if (!function_exists( 'startit_qode_get_footer_top' )) {
	/**
	 * Return footer top HTML
	 */
	function startit_qode_get_footer_top() {

		$parameters = array();

		$parameters['footer_top_border'] = startit_qode_get_footer_top_border();
		$parameters['footer_top_border_in_grid'] = ( startit_qode_options()->getOptionValue('footer_top_border_in_grid') == 'yes') ? 'qodef-in-grid' : '';
		$parameters['footer_in_grid'] = ( startit_qode_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
		$parameters['footer_top_classes'] = ( startit_qode_options()->getOptionValue('footer_in_grid') == 'yes') ? '' : 'qodef-footer-top-full';
		$parameters['footer_top_columns'] = startit_qode_options()->getOptionValue('footer_top_columns');

		startit_qode_get_module_template_part('templates/parts/footer-top', 'footer', '', $parameters);

	}
	
}

if (!function_exists( 'startit_qode_get_footer_bottom' )) {
	/**
	 * Return footer bottom HTML
	 */
	function startit_qode_get_footer_bottom() {

		$parameters = array();

		$parameters['footer_bottom_border'] = startit_qode_get_footer_bottom_border();
		$parameters['footer_bottom_border_in_grid'] = ( startit_qode_options()->getOptionValue('footer_bottom_border_in_grid') == 'yes') ? 'qodef-in-grid' : '';
		$parameters['footer_in_grid'] = ( startit_qode_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
		$parameters['footer_bottom_columns'] = startit_qode_options()->getOptionValue('footer_bottom_columns');
		$parameters['footer_bottom_border_bottom'] = qode_startit_get_footer_bottom_bottom_border();

		startit_qode_get_module_template_part('templates/parts/footer-bottom', 'footer', '', $parameters);

	}

}

//Functions for loading sidebars

if (!function_exists( 'startit_qode_get_footer_sidebar_25_25_50' )) {

	function startit_qode_get_footer_sidebar_25_25_50() {
		startit_qode_get_module_template_part('templates/sidebars/sidebar-three-columns-25-25-50', 'footer');
	}

}

if (!function_exists( 'startit_qode_get_footer_sidebar_50_25_25' )) {

	function startit_qode_get_footer_sidebar_50_25_25() {
		startit_qode_get_module_template_part('templates/sidebars/sidebar-three-columns-50-25-25', 'footer');
	}

}

if (!function_exists( 'startit_qode_get_footer_sidebar_four_columns' )) {

	function startit_qode_get_footer_sidebar_four_columns() {
		startit_qode_get_module_template_part('templates/sidebars/sidebar-four-columns', 'footer');
	}

}

if (!function_exists( 'startit_qode_get_footer_sidebar_three_columns' )) {

	function startit_qode_get_footer_sidebar_three_columns() {
		startit_qode_get_module_template_part('templates/sidebars/sidebar-three-columns', 'footer');
	}

}

if (!function_exists( 'startit_qode_get_footer_sidebar_two_columns' )) {

	function startit_qode_get_footer_sidebar_two_columns() {
		startit_qode_get_module_template_part('templates/sidebars/sidebar-two-columns', 'footer');
	}

}

if (!function_exists( 'startit_qode_get_footer_sidebar_one_column' )) {

	function startit_qode_get_footer_sidebar_one_column() {
		startit_qode_get_module_template_part('templates/sidebars/sidebar-one-column', 'footer');
	}

}

if (!function_exists( 'startit_qode_get_footer_bottom_sidebar_three_columns' )) {

	function startit_qode_get_footer_bottom_sidebar_three_columns() {
		startit_qode_get_module_template_part('templates/sidebars/sidebar-bottom-three-columns', 'footer');
	}

}

if (!function_exists( 'startit_qode_get_footer_bottom_sidebar_two_columns' )) {

	function startit_qode_get_footer_bottom_sidebar_two_columns() {
		startit_qode_get_module_template_part('templates/sidebars/sidebar-bottom-two-columns', 'footer');
	}

}

if (!function_exists( 'startit_qode_get_footer_bottom_sidebar_one_column' )) {

	function startit_qode_get_footer_bottom_sidebar_one_column() {
		startit_qode_get_module_template_part('templates/sidebars/sidebar-bottom-one-column', 'footer');
	}

}

