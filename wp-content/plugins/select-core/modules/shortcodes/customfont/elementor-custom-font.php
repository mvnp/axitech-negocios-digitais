<?php

class StartitCoreElementorCustomFont extends \Elementor\Widget_Base{
	public function get_name() {
		return 'qodef_custom_font';
	}
	
	public function get_title() {
		return esc_html__( "Select Custom Font", 'select-core' );
	}
	
	public function get_icon() {
		return 'startit-elementor-custom-icon startit-elementor-custom-font';
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
			'custom_font_tag',
			[
				'label' => esc_html__( "Custom Font Tag", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					"" => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",
					"h5" => "h5",
					"h6" => "h6",
					"p" => "p",
					"div" => "div",
				],
				'default' => 'p'
			]
		);
		
		$this->add_control(
			'font_family',
			[
				'label' => esc_html__( "Font family", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'font_size',
			[
				'label' => esc_html__( "Font size (px)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '15'
			]
		);
		
		$this->add_control(
			'line_height',
			[
				'label' => esc_html__( "Line height (px)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '26'
			]
		);
		
		$this->add_control(
			'font_style',
			[
				'label' => esc_html__( "Font Style", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_font_style_array(),
				'default' => 'normal'
			]
		);
		
		$this->add_control(
			'font_weight',
			[
				'label' => esc_html__( "Font weight", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_font_weight_array(),
				'default' => '400'
			]
		);
		
		$this->add_control(
			'letter_spacing',
			[
				'label' => esc_html__( "Letter Spacing (px)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'text_transform',
			[
				'label' => esc_html__( "Text transform", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_text_transform_array()
			]
		);
		
		$this->add_control(
			'text_decoration',
			[
				'label' => esc_html__( "Text Decoration", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_text_decorations(),
				'default' => 'none'
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
			'text_align',
			[
				'label' => esc_html__( "Text Align", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''        => '',
					'left'    => esc_html__( 'Left', 'select-core' ),
					'center'  => esc_html__( 'Center', 'select-core' ),
					'right'   => esc_html__( 'Right', 'select-core' ),
					'justify' => esc_html__( 'Justify', 'select-core' )
				],
				'default' => ''
			]
		);
		
		$this->add_control(
			'content_custom_font',
			[
				'label' => esc_html__( "Content", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Custom Font Content'
			]
		);
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$params = $this->get_settings_for_display();
		
		$params['custom_font_style'] = $this->getCustomFontStyle($params);
		$params['custom_font_tag'] = $this->getCustomFontTag($params);
		$params['custom_font_data'] = $this->getCustomFontData($params);
		
		//Get HTML from template
		echo qode_core_get_independent_shortcode_module_template_part('templates/custom-font-template', 'customfont', '', $params);
	}
	
	/**
	 * Return Style for Custom Font
	 *
	 * @param $params
	 * @return string
	 */
	private function getCustomFontStyle($params) {
		$custom_font_style = array();
		
		if ($params['font_family'] !== '') {
			$custom_font_style[] = 'font-family: '.$params['font_family'];
		}
		
		if ($params['font_size'] !== '') {
			$font_size = strstr($params['font_size'], 'px') ? $params['font_size'] : $params['font_size'].'px';
			$custom_font_style[] = 'font-size: '.$font_size;
		}
		
		if ($params['line_height'] !== '') {
			$line_height = strstr($params['line_height'], 'px') ? $params['line_height'] : $params['line_height'].'px';
			$custom_font_style[] = 'line-height: '.$line_height;
		}
		
		if ($params['font_style'] !== '') {
			$custom_font_style[] = 'font-style: '.$params['font_style'];
		}
		
		if ($params['font_weight'] !== '') {
			$custom_font_style[] = 'font-weight: '.$params['font_weight'];
		}
		
		if ($params['letter_spacing'] !== '') {
			$letter_spacing = strstr($params['letter_spacing'], 'px') ? $params['letter_spacing'] : $params['letter_spacing'].'px';
			$custom_font_style[] = 'letter-spacing: '.$letter_spacing;
		}
		
		if ($params['text_transform'] !== '') {
			$custom_font_style[] = 'text-transform: '.$params['text_transform'];
		}
		
		if ($params['text_decoration'] !== '') {
			$custom_font_style[] = 'text-decoration: '.$params['text_decoration'];
		}
		
		if ($params['text_align'] !== '') {
			$custom_font_style[] = 'text-align: '.$params['text_align'];
		}
		
		if ($params['color'] !== '') {
			$custom_font_style[] = 'color: '.$params['color'];
		}
		
		return implode(';', $custom_font_style);
	}
	
	/**
	 * Return Custom Font Tag. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @return string
	 */
	private function getCustomFontTag($params) {
		$tag_array = array('h2', 'h3', 'h4', 'h5', 'h6','p','div');
		return (in_array($params['custom_font_tag'], $tag_array)) ? $params['custom_font_tag'] : 'p';
	}
	
	/**
	 * Return Custom Font Data Attr
	 *
	 * @param $params
	 * @return string
	 */
	private function getCustomFontData($params) {
		$data_array = array();
		
		if ($params['font_size'] !== '') {
			$data_array[] = 'data-font-size= '.$params['font_size'];
		}
		
		if ($params['line_height'] !== '') {
			$data_array[] = 'data-line-height= '.$params['line_height'];
		}
		return implode(' ', $data_array);
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorCustomFont() );