<?php

class StartitCoreElementorIconWithText extends \Elementor\Widget_Base{
	public function get_name() {
		return 'qodef_icon_with_text';
	}
	
	public function get_title() {
		return esc_html__( "Icon With Text", 'select-core' );
	}
	
	public function get_icon() {
		return 'startit-elementor-custom-icon startit-elementor-icon-with-text';
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
		
		startit_qode_icon_collections()->getElementorParamsArray($this, '', '', true);
		
		$this->add_control(
			'custom_icon',
			[
				'label' => esc_html__( "Custom Icon", 'select-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA
			]
		);
		
		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__( "Icon Position", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'top'               => esc_html__( 'Top', 'select-core' ),
					'left'              => esc_html__( 'Left', 'select-core' ),
					'left_from_title'   => esc_html__( 'Left From Title', 'select-core' ),
					'right'             => esc_html__( 'Right', 'select-core' ),
				],
				'default' => 'left'
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'text',
			[
				'label' => esc_html__( "Text", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'link',
			[
				'label' => esc_html__( "Link", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'link_text',
			[
				'label' => esc_html__( "Link Text", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'link!' => ''
				]
			]
		);
		
		$this->add_control(
			'target',
			[
				'label' => esc_html__( "Target", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'_self'    => esc_html__( 'Self', 'select-core' ),
					'_blank'   => esc_html__( 'Blank', 'select-core' )
				],
				'default' => '_self',
				'condition' => [
					'link!' => ''
				]
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'icon_settings',
			[
				'label' => esc_html__( 'Icon Settings', 'select-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'icon_type',
			[
				'label' => esc_html__( "Icon Type", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'normal' => esc_html__( 'Normal', 'select-core' ),
					'circle' => esc_html__( 'Circle', 'select-core' ),
					'square' => esc_html__( 'Square', 'select-core' ),
				],
				"description" => esc_html__( "This attribute doesn't work when Icon Position is Top. In This case Icon Type is Normal", 'select-core' )
			]
		);
		
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( "Icon Size", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'qodef-icon-tiny'   => esc_html__( 'Tiny', 'select-core' ),
					'qodef-icon-small'  => esc_html__( 'Small', 'select-core' ),
					'qodef-icon-medium' => esc_html__( 'Medium', 'select-core' ),
					'qodef-icon-large'  => esc_html__( 'Large', 'select-core' ),
					'qodef-icon-huge'   => esc_html__( 'Very Large', 'select-core' ),
				],
				"description" => esc_html__( "This attribute doesn't work when Icon Position is Top", 'select-core' )
			]
		);
		
		$this->add_control(
			'custom_icon_size',
			[
				'label' => esc_html__( "Custom Icon Size (px)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'icon_animation',
			[
				'label' => esc_html__( "Icon Animation", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''    => esc_html__( 'No', 'select-core' ),
					'yes' => esc_html__( 'Yes', 'select-core' ),
				],
				'default' => ''
			]
		);
		
		$this->add_control(
			'icon_animation_delay',
			[
				'label' => esc_html__( "Icon Animation Delay (ms)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'icon_animation' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'icon_margin',
			[
				'label' => esc_html__( "Icon Margin", 'select-core' ),
				"description" => esc_html__( "Margin should be set in a top right bottom left format", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'shape_size',
			[
				'label' => esc_html__( "Shape Size (px)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( "Icon Color", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR
			]
		);
		
		$this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__( "Icon Hover Color", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR
			]
		);
		
		$this->add_control(
			'icon_background_color',
			[
				'label' => esc_html__( "Icon Background Color", 'select-core' ),
				"description" => esc_html__( "Icon Background Color (only for square and circle icon type)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array( 'square', 'circle' )
				]
			]
		);
		
		$this->add_control(
			'icon_hover_background_color',
			[
				'label' => esc_html__( "Icon Hover Background Color", 'select-core' ),
				"description" => esc_html__( "Icon Hover Background Color (only for square and circle icon type)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array( 'square', 'circle' )
				]
			]
		);
		
		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( "Icon Border Color", 'select-core' ),
				"description" => esc_html__( "Only for Square and Circle type", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array('square','circle')
				]
			]
		);
		
		$this->add_control(
			'icon_border_hover_color',
			[
				'label' => esc_html__( "Icon Border Hover Color", 'select-core' ),
				"description" => esc_html__( "Only for Square and Circle type", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array('square','circle')
				]
			]
		);
		
		$this->add_control(
			'icon_border_width',
			[
				'label' => esc_html__( "Border Width", 'select-core' ),
				"description" => esc_html__( "Only for Square and Circle Icon type", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'icon_type' => array( 'circle', 'square' )
				]
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'text_settings',
			[
				'label' => esc_html__( 'Text Settings', 'select-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_title_tag(),
				'default' => 'h4',
				'condition' => [
					'title!' => array( '' )
				]
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( "Title Color", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'title!' => array( '' )
				]
			]
		);
		
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( "Text Color", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'text!' => array( '' )
				]
			]
		);
		
		$this->add_control(
			'text_left_padding',
			[
				'label' => esc_html__( "Text Left Padding (px)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'icon_position' => 'left'
				]
			]
		);
		
		$this->add_control(
			'text_right_padding',
			[
				'label' => esc_html__( "Text Right Padding (px)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'icon_position' => 'right'
				]
			]
		);
		
		$this->end_controls_section();
		
	}
	
	protected function render(){
		$params = $this->get_settings_for_display();
		
		$params['icon'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $params );
		
		if( ! empty( $params['custom_icon'] ) ){
			$params['custom_icon'] = $params['custom_icon']['id'];
		}
		
		$params['icon_parameters'] = $this->getIconParameters($params);
		$params['holder_classes']  = $this->getHolderClasses($params);
		$params['title_styles']    = $this->getTitleStyles($params);
		$params['content_styles']  = $this->getContentStyles($params);
		$params['text_styles']     = $this->getTextStyles($params);
		
		echo qode_core_get_independent_shortcode_module_template_part('templates/iwt', 'icon-with-text', $params['icon_position'], $params);
	}
	
	private function getIconParameters($params) {
		$params_array = array();
		
		if(empty($params['custom_icon'])) {
			$iconPackName = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
			
			$params_array['icon_pack']   = $params['icon_pack'];
			$params_array[$iconPackName] = $params[$iconPackName];
			
			if(!empty($params['icon_size'])) {
				$params_array['size'] = $params['icon_size'];
			}
			
			if(!empty($params['custom_icon_size'])) {
				$params_array['custom_size'] = $params['custom_icon_size'];
			}
			
			if(!empty($params['icon_type'])) {
				$params_array['type'] = $params['icon_type'];
			}
			
			$params_array['shape_size'] = $params['shape_size'];
			
			if(!empty($params['icon_border_color'])) {
				$params_array['border_color'] = $params['icon_border_color'];
			}
			
			if(!empty($params['icon_border_hover_color'])) {
				$params_array['hover_border_color'] = $params['icon_border_hover_color'];
			}
			
			if(!empty($params['icon_border_width'])) {
				$params_array['border_width'] = $params['icon_border_width'];
			}
			
			if(!empty($params['icon_background_color'])) {
				$params_array['background_color'] = $params['icon_background_color'];
			}
			
			if(!empty($params['icon_hover_background_color'])) {
				$params_array['hover_background_color'] = $params['icon_hover_background_color'];
			}
			
			$params_array['icon_color'] = $params['icon_color'];
			
			if(!empty($params['icon_hover_color'])) {
				$params_array['hover_icon_color'] = $params['icon_hover_color'];
			}
			
			$params_array['icon_animation']       = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
			$params_array['margin']               = $params['icon_margin'];
		}
		
		return $params_array;
	}
	
	/**
	 * Returns array of holder classes
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getHolderClasses($params) {
		$classes = array('qodef-iwt', 'clearfix');
		
		if(!empty($params['icon_position'])) {
			switch($params['icon_position']) {
				case 'top':
					$classes[] = 'qodef-iwt-icon-top';
					break;
				case 'left':
					$classes[] = 'qodef-iwt-icon-left';
					break;
				case 'right':
					$classes[] = 'qodef-iwt-icon-right';
					break;
				case 'left-from-title':
					$classes[] = 'qodef-iwt-left-from-title';
					break;
				default:
					break;
			}
		}
		
		if(!empty($params['icon_size'])) {
			$classes[] = 'qodef-iwt-'.str_replace('qodef-', '', $params['icon_size']);
		}
		
		return $classes;
	}
	
	private function getTitleStyles($params) {
		$styles = array();
		
		if(!empty($params['title_color'])) {
			$styles[] = 'color: '.$params['title_color'];
		}
		
		return $styles;
	}
	
	private function getTextStyles($params) {
		$styles = array();
		
		if(!empty($params['text_color'])) {
			$styles[] = 'color: '.$params['text_color'];
		}
		
		return $styles;
	}
	
	private function getContentStyles($params) {
		$styles = array();
		
		if($params['icon_position'] == 'left' && !empty($params['text_left_padding'])) {
			$styles[] = 'padding-left: ' . startit_qode_filter_px($params['text_left_padding']) . 'px';
		}
		
		if($params['icon_position'] == 'right' && !empty($params['text_right_padding'])) {
			$styles[] = 'padding-right: ' . startit_qode_filter_px($params['text_right_padding']) . 'px';
		}
		
		return $styles;
	}
	
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorIconWithText() );