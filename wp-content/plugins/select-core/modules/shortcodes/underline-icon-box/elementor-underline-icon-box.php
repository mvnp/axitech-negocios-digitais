<?php

class StartitCoreElementorUnderlineIconBox extends \Elementor\Widget_Base{
	public function get_name() {
		return 'qodef_underline_icon_box';
	}
	
	public function get_title() {
		return esc_html__( "Select Underline Icon Box", 'select-core' );
	}
	
	public function get_icon() {
		return 'startit-elementor-custom-icon startit-elementor-underline-icon-box';
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
		
		startit_qode_icon_collections()->getElementorParamsArray($this, '', '', false);
		
		$this->add_control(
			'alignment',
			[
				'label' => esc_html__( "Alignment", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'left'     => esc_html__( 'Left', 'select-core' ),
					'right'    => esc_html__( 'Right', 'select-core' ),
					'center'   => esc_html__( 'Center', 'select-core' )
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
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_title_tag(),
				'default' => 'h4'
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
			'enable_border',
			[
				'label' => esc_html__( "Enable border", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_yes_no_select_array(),
				'default' => 'no'
			]
		);
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$params = $this->get_settings_for_display();
		
		$params['icon'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $params );
		
		$params['icon_parameters'] = $this->getIconParameters($params);
		$params['holder_classes']  = $this->getHolderClasses($params);
		
		//get correct heading value. If provided heading isn't valid get the default one
		$headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
		$params['title_tag'] = (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : 'h4';
		
		//Get HTML from template
		echo qode_core_get_independent_shortcode_module_template_part('templates/underline-icon-box-template', 'underline-icon-box', '', $params);
	}
	
	private function getIconParameters($params) {
		$iconPackName = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		
		$params_array['icon_pack']   = $params['icon_pack'];
		$params_array[$iconPackName] = $params[$iconPackName];
		
		return $params_array;
	}
	
	private function getHolderClasses($params) {
		$classes = array('qodef-underline-icon-box-holder');
		
		$classes[] = $params['alignment'];
		
		if($params['enable_border'] == 'yes') {
			$classes[] = 'qodef-with-border';
			$classes[] = 'qodef-background-animation';
		}
		else {
			$classes[] = 'qodef-underline-animation';
		}
		
		return $classes;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorUnderlineIconBox() );