<?php

if ( ! function_exists( 'qode_startit_load_shortcode_interface' ) ) {

	function qode_startit_load_shortcode_interface() {

		include_once QODE_CORE_ABS_PATH . '/modules/shortcodes/lib/shortcode-interface.php';

	}

	add_action( 'qode_core_shortcodes_load', 'qode_startit_load_shortcode_interface' );

}

if ( ! function_exists( 'qode_startit_load_shortcodes' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 * and loads load.php file in each. Hooks to qode_startit_after_options_map action
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */
	function qode_startit_load_shortcodes() {
		if( select_core_is_theme_registered() ) {
			foreach ( glob( QODE_CORE_ABS_PATH . '/modules/shortcodes/*/load.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}

			include_once QODE_CORE_ABS_PATH . '/modules/shortcodes/lib/shortcode-loader.inc';
		}
	}

	add_action( 'after_setup_theme', 'qode_startit_load_shortcodes' );
}


if(!function_exists('qode_core_get_independent_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $module name of the module folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 * @return html
	 * @see startit_qode_get_template_part()
	 */
	function qode_core_get_independent_shortcode_module_template_part($template, $module, $slug = '', $params = array()) {

		//HTML Content from template
		$html = '';
		$template_path = QODE_CORE_MODULES_ABS_PATH . '/shortcodes/' . $module;

		$temp = $template_path.'/'.$template;

		if(is_array($params) && count($params)) {
			extract($params);
		}

		$template = '';

		if($temp !== '') {
			if($slug !== ''  && file_exists("{$temp}-{$slug}.php") ) {
				$temp = "{$temp}-{$slug}";
			}
			$template = $temp.'.php';
		}
		if($template) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}

		return $html;
	}
}

//Load Elementor Shortcodes
if( ! function_exists('qode_core_load_elementor_shortcodes') ){
	function qode_core_load_elementor_shortcodes(){
		if( qode_core_is_elementor_installed() && select_core_is_theme_registered() ) {
			foreach (glob(QODE_CORE_MODULES_ABS_PATH . '/shortcodes/*/elementor-*.php') as $shortcode_load) {
				include_once $shortcode_load;
			}
			
			do_action('qode_core_load_elementor_shortcodes_from_plugins');
		}
	}
	
	add_action('init', 'qode_core_load_elementor_shortcodes');
}

if( ! function_exists('qode_core_add_elementor_widget_categories') ) {
	function qode_core_add_elementor_widget_categories($elements_manager) {
		
		$elements_manager->add_category(
			'select',
			[
				'title' => esc_html__('by SELECT', 'select-core'),
				'icon' => 'fa fa-plug',
			]
		);
		
	}
	
	add_action('elementor/elements/categories_registered', 'qode_core_add_elementor_widget_categories');
};

if( ! function_exists('qode_core_elementor_icons_style') ){
	function qode_core_elementor_icons_style(){
		wp_enqueue_style( 'startit-core-elementor', QODE_CORE_URL_PATH . 'modules/shortcodes/lib/assets/css/elementor.css');
	}
	
	add_action( 'elementor/editor/before_enqueue_scripts', 'qode_core_elementor_icons_style' );
}

//function that returns all Elementor saved templates
if( ! function_exists('qode_core_return_elementor_templates') ){
	function qode_core_return_elementor_templates(){
		return Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
	}
}

//function that adds Template Elementor Control
if( ! function_exists('qode_core_generate_elementor_templates_control') ){
	function qode_core_generate_elementor_templates_control( $object, $dependency_array = array() , $control_name = 'template_id' ){
		$templates = qode_core_return_elementor_templates();
		
		if ( ! empty( $templates ) ) {
			$options = [
				'0' => '— ' . esc_html__('Select', 'select-core') . ' —',
			];
			
			$types = [];
			
			foreach ($templates as $template) {
				$options[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
				$types[$template['template_id']] = $template['type'];
			}
			
			$control_options_array = [
				'label' => esc_html__('Choose Template', 'select-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => $options,
				'types' => $types,
				'label_block' => 'true'
			];
			
			if( is_array( $dependency_array ) && count( $dependency_array ) > 0 ){
				$control_options_array['condition'] = $dependency_array;
			}
			
			$object->add_control(
				$control_name, $control_options_array
			);
		};
	}
}

//function that maps "Anchor" option for section
if( ! function_exists('qode_core_map_section_anchor_option') ){
	function qode_core_map_section_anchor_option( $section, $args ){
		$section->start_controls_section(
			'section_qode_anchor',
			[
				'label' => esc_html__( 'Select Anchor', 'select-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);
		
		$section->add_control(
			'anchor_id',
			[
				'label'        => esc_html__( 'Select Anchor ID', 'select-core' ),
				'type'         => Elementor\Controls_Manager::TEXT,
			]
		);
		
		$section->end_controls_section();
	}
	
	add_action('elementor/element/section/_section_responsive/after_section_end', 'qode_core_map_section_anchor_option', 10, 2);
}

//function that renders "Anchor" option for section
if( ! function_exists('qode_core_render_section_anchor_option') ) {
	function qode_core_render_section_anchor_option( $element )   {
		if( 'section' !== $element->get_name() ) {
			return;
		}
		
		$params = $element->get_settings_for_display();
		
		if( ! empty( $params['anchor_id'] ) ){
			$element->add_render_attribute( '_wrapper', 'data-q_id', '#' . $params['anchor_id'] );
		}
	}
	
	add_action( 'elementor/frontend/section/before_render', 'qode_core_render_section_anchor_option');
}


//function that maps "Parallax" option for section
if( ! function_exists('qode_core_map_section_parallax_option') ){
	function qode_core_map_section_parallax_option( $section, $args ){
		$section->start_controls_section(
			'section_qode_parallax',
			[
				'label' => esc_html__( 'Select Parallax', 'select-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);
		
		$section->add_control(
			'qode_enable_parallax',
			[
				'label'        => esc_html__( 'Enable Parallax', 'select-core'),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options' => [
					'no' => esc_html__('No', 'select-core')  ,
					'holder' => esc_html__('Yes', 'select-core')  ,
				],
				'prefix_class' => 'parallax_section_'
			]
		);
		
		$section->add_control(
			'qode_parallax_section_height',
			[
				'label'        => esc_html__( 'Parallax Section Height', 'select-core' ),
				'type'         => Elementor\Controls_Manager::TEXT,
				'condition' => [
					'qode_enable_parallax' => 'holder'
				],
				'selectors' => [
					'{{WRAPPER}}.parallax_section_holder' => 'min-height: {{VALUE}}px !important;'
				]
			]
		);
		
		$section->add_control(
			'qode_parallax_image',
			[
				'label'        => esc_html__( 'Parallax Image', 'select-core' ),
				'type'         => Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'qode_enable_parallax' => 'holder'
				],
				'frontend_available' => true,
				'selectors' => [
					'{{WRAPPER}}.parallax_section_holder' => 'background-image: url("{{URL}}") !important;'
				]
			]
		);
		
		$section->add_control(
			'qode_parallax_speed',
			[
				'label'        => esc_html__( 'Parallax Speed', 'select-core' ),
				'type'         => Elementor\Controls_Manager::TEXT,
				'condition' => [
					'qode_enable_parallax' => 'holder'
				],
				'default' => '0'
			]
		);
		
		$section->end_controls_section();
	}
	
	add_action('elementor/element/section/_section_responsive/after_section_end', 'qode_core_map_section_parallax_option', 10, 2);
}

//function that renders "Anchor" option for section
if( ! function_exists('qode_core_render_section_parallax_option') ) {
	function qode_core_render_section_parallax_option( $element )   {
		if( 'section' !== $element->get_name() ) {
			return;
		}
		
		$params = $element->get_settings_for_display();
		
		if( ! empty( $params['qode_parallax_image']['id'] ) ){
			$parallax_image_src = $params['qode_parallax_image']['url'];
			$parallax_speed = ! empty( $params['qode_parallax_speed'] ) ? $params['qode_parallax_speed'] : '0';
			$parallax_section_height = ! empty( $params['qode_parallax_section_height'] ) ? $params['qode_parallax_section_height'] : '0';
			$parallax_touch_devices = '';
			if (startit_qode_options()->getOptionValue('parallax_on_off') == 'off') {
				$parallax_touch_devices = 'qodef-parallax-section-holder-touch-disabled';
			}
			
			$element->add_render_attribute( '_wrapper', 'style', 'background-image: url(' . $parallax_image_src . '); min-height: ' . $parallax_section_height . 'px');
			$element->add_render_attribute( '_wrapper', 'class', 'qodef-parallax-section-holder '. $parallax_touch_devices);
			$element->add_render_attribute( '_wrapper', 'data-qodef-parallax-speed', $parallax_speed );
		}
	}
	
	add_action( 'elementor/frontend/section/before_render', 'qode_core_render_section_parallax_option');
}

//function that renders helper hidden input for parallax data attribute section
if( ! function_exists('qode_core_generate_parallax_helper') ){
	function qode_core_generate_parallax_helper( $template, $widget ){
		if ( 'section' === $widget->get_name() ) {
			$template_preceding = "
            <# if( settings.qode_enable_parallax == 'holder' ){
		        let parallaxSpeed = settings.qode_parallax_speed !== '' ? settings.qode_parallax_speed : '0'; #>
		        <input type='hidden' class='qodef-parallax-helper-holder' data-speed='{{ parallaxSpeed }}'/>
		    <# } #>";
			$template = $template_preceding . " " . $template;
		}
		
		return $template;
	}
	
	add_action( 'elementor/section/print_template', 'qode_core_generate_parallax_helper', 10, 2 );
}

//function that maps "Full Screen Sections" option for section
if( ! function_exists('qode_core_map_grid_option') ){
	function qode_core_map_grid_option( $section, $args ){
		$section->start_controls_section(
			'section_qode_grid_row',
			[
				'label' => esc_html__( 'Select Grid', 'select-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);
		
		$section->add_control(
			'qode_enable_grid_row',
			[
				'label'        => esc_html__( 'Make this row "In Grid"', 'select-core'),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options' => [
					'no' => esc_html__('No', 'select-core')  ,
					'inner' => esc_html__('Yes', 'select-core')  ,
				],
				'prefix_class' => 'qodef_elementor_container_'
			]
		);
		
		$section->end_controls_section();
	}
	
	add_action('elementor/element/section/_section_responsive/after_section_end', 'qode_core_map_grid_option', 10, 2);
}
