<?php

class StartitCoreElementorSeparator extends \Elementor\Widget_Base{
	public function get_name() {
		return 'qodef_separator';
	}
	
	public function get_title() {
		return esc_html__( "Separator", 'select-core' );
	}
	
	public function get_icon() {
		return 'startit-elementor-custom-icon startit-elementor-separator';
	}
	
	public function get_categories() {
		return [ 'select' ];
	}
	
	protected function _register_controls() {
		
		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'select-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'class_name',
			[
				'label' => esc_html__( "Extra class name", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.'
			]
		);
		
		$this->add_control(
			'type',
			[
				'label' => esc_html__( "Type", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'normal'      => esc_html__( 'Normal', 'select-core' ),
					'full-width'  => esc_html__( 'Full Width', 'select-core' )
				],
				'default' => 'normal'
			]
		);
		
		$this->add_control(
			'position',
			[
				'label' => esc_html__( "Position", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'center'  => esc_html__( 'Center', 'select-core' ),
					'left'    => esc_html__( 'Left', 'select-core' ),
					'right'   => esc_html__( 'Right', 'select-core' )
				],
				'default' => 'center'
			]
		);
		
		$this->add_control(
			'color',
			[
				'label' => esc_html__( "Color", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR
			]
		);
		
		$this->add_control(
			'border_style',
			[
				'label' => esc_html__( "Border Style", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''         => esc_html__( 'Default', 'select-core' ),
					'dashed'   => esc_html__( 'Dashed', 'select-core' ),
					'solid'    => esc_html__( 'Solid', 'select-core' ),
					'dotted'   => esc_html__( 'Dotted', 'select-core' )
				],
				'default' => 'dashed'
			]
		);
		
		$this->add_control(
			'width',
			[
				'label' => esc_html__( "Width", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type' => 'normal'
				]
			]
		);
		
		$this->add_control(
			'thickness',
			[
				'label' => esc_html__( "Thickness (px)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'top_margin',
			[
				'label' => esc_html__( "Top Margin", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'bottom_margin',
			[
				'label' => esc_html__( "Bottom Margin", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$params = $this->get_settings_for_display();
		
		$params['separator_class'] = $this->getSeparatorClass($params);
		$params['separator_style'] = $this->getSeparatorStyle($params);
		
		
		echo qode_core_get_independent_shortcode_module_template_part('templates/separator-template', 'separator', '', $params);
	}
	
	/**
	 * Return Separator classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getSeparatorClass($params) {
		
		$separator_class = array();
		
		if ($params['class_name'] !== '') {
			$separator_class[] = $params['class_name'];
		}
		if ($params['position'] !== '') {
			$separator_class[] = 'qodef-separator-'.$params['position'];
		}
		if ($params['type'] !== '') {
			$separator_class[] = 'qodef-separator-'.$params['type'];
		}
		
		return implode(' ', $separator_class);
		
	}
	
	/**
	 * Return Elements Holder Item Content style
	 *
	 * @param $params
	 * @return array
	 */
	private function getSeparatorStyle($params) {
		
		$separator_style = array();
		
		if ($params['color'] !== '') {
			$separator_style[] = 'border-color: ' . $params['color'];
		}
		if ($params['border_style'] !== '') {
			$separator_style[] = 'border-style: ' . $params['border_style'];
		}
		if ($params['width'] !== '') {
			if( qode_startit_string_ends_with($params['width'], '%') || qode_startit_string_ends_with($params['width'], 'px')) {
				$separator_style[] = 'width: ' . $params['width'];
			}else{
				$separator_style[] = 'width: ' . $params['width'] . 'px';
			}
		}
		if ($params['thickness'] !== '') {
			$separator_style[] = 'border-width: ' . $params['thickness'] . 'px';
		}
		if ($params['top_margin'] !== '') {
			if( qode_startit_string_ends_with($params['top_margin'], '%') || qode_startit_string_ends_with($params['top_margin'], 'px')) {
				$separator_style[] = 'margin-top: ' . $params['top_margin'];
			}else{
				$separator_style[] = 'margin-top: ' . $params['top_margin'] . 'px';
			}
		}
		if ($params['bottom_margin'] !== '') {
			if( qode_startit_string_ends_with($params['bottom_margin'], '%') || qode_startit_string_ends_with($params['bottom_margin'], 'px')) {
				$separator_style[] = 'margin-bottom: ' . $params['bottom_margin'];
			}else{
				$separator_style[] = 'margin-bottom: ' . $params['bottom_margin'] . 'px';
			}
		}
		return implode(';', $separator_style);
		
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorSeparator() );