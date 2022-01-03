<?php

class StartitCoreElementorInfoBox extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_info_box';
    }

    public function get_title() {
        return esc_html__( "Select Info Box", 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-info-box';
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
		    'custom_icon',
		    [
			    'label' => esc_html__( "Custom Icon", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::MEDIA
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
			    'default' => 'h6',
			    'condition' => [
			    	'title!' => ''
			    ]
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
		    'enable_animation',
		    [
			    'label' => esc_html__( "Enable Rotating Animation", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'no'
		    ]
	    );
	
	    $this->add_control(
		    'back_text',
		    [
			    'label' => esc_html__( "Back Side Text", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'condition' => [
			    	'enable_animation' => 'yes'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'show_button',
		    [
			    'label' => esc_html__( "Show Button", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'no',
			    'condition' => [
			    	'enable_animation' => 'yes'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'button_text',
		    [
			    'label' => esc_html__( "Button Text", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Default text is "button"',
			    'condition' => [
				    'show_button' => 'yes'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'button_link',
		    [
			    'label' => esc_html__( "Button Link", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Default text is "button"',
			    'condition' => [
				    'show_button' => 'yes'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'button_target',
		    [
			    'label' => esc_html__( "Button Target", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_link_target_array(),
			    'default' => '_self',
			    'condition' => [
				    'show_button' => 'yes'
			    ]
		    ]
	    );
	
	    $this->end_controls_section();
	
	    $this->start_controls_section(
		    'design',
		    [
			    'label' => esc_html__( 'Design Options', 'select-core' ),
			    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		    ]
	    );
	
	    $this->add_control(
		    'enable_border',
		    [
			    'label' => esc_html__( "Enable Front Side Border", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => '_self',
			    'condition' => [
				    'show_button' => 'yes'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'background_color',
		    [
			    'label' => esc_html__( "Front Side Background Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'front_side_style',
		    [
			    'label' => esc_html__( "Front Side Style", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
			    	'dark'  => esc_html__( "Dark", 'select-core' ),
			    	'light' => esc_html__( "Light", 'select-core' ),
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'back_background_color',
		    [
			    'label' => esc_html__( "Back Side Background Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'condition' => [
			    	'enable_animation' => 'yes'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'back_side_style',
		    [
			    'label' => esc_html__( "Back Side Style", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'light' => esc_html__( "Light", 'select-core' ),
				    'dark'  => esc_html__( "Dark", 'select-core' )
			    ],
			    'condition' => [
				    'enable_animation' => 'yes'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'image_padding_bottom',
		    [
			    'label' => esc_html__( "Image Padding Bottom (px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    if( ! empty( $params['custom_icon'] ) ){
		    $params['custom_icon'] = $params['custom_icon']['id'];
	    }
	
	    $params['holder_classes']  = $this->getHolderClasses($params);
	    $params['button_parameters'] = $this->getButtonParameters($params);
	    $params['front_bkg'] = $this->getFrontBackground($params);
	    $params['back_bkg'] = $this->getBackBackground($params);
	    $params['front_style'] = $this->getFrontStyle($params);
	    $params['back_style'] = $this->getBackStyle($params);
	    $params['image_style'] = $this->getImageStyle($params);
	
	    //get correct heading value. If provided heading isn't valid get the default one
	    $headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
	    $params['title_tag'] = (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : 'h6';
	
	    //Get HTML from template
	    echo qode_core_get_independent_shortcode_module_template_part('templates/info-box-template', 'info-box', '', $params);
    }
	
	private function getHolderClasses($params) {
		
		$classes = array('qodef-info-box');
		
		if($params['enable_border'] == 'yes') {
			$classes[] = 'qodef-with-border';
		}
		
		if($params['enable_animation'] == 'yes') {
			$classes[] = 'qodef-animate';
		}
		
		if($params['enable_animation'] == 'yes' && $params['show_button'] == 'yes' && $params['back_text'] !=='') {
			$classes[] = 'qodef-back-margin';
		}
		
		return $classes;
	}
	
	private function getButtonParameters($params) {
		$button_params_array = array();
		
		if(!empty($params['button_link'])) {
			$button_params_array['link'] = $params['button_link'];
		}
		
		if(!empty($params['button_target'])) {
			$button_params_array['target'] = $params['button_target'];
		}
		
		if(!empty($params['button_text'])) {
			$button_params_array['text'] = $params['button_text'];
		}
		
		$button_params_array['type'] = 'outline';
		
		return $button_params_array;
	}
	
	private function getFrontBackground($params){
		
		$front_bkg= array();
		
		if(!empty($params['background_color'])) {
			$front_bkg[] = 'background-color: '.$params['background_color'];
		}
		
		return $front_bkg;
		
	}
	
	private function getBackBackground($params){
		
		$back_bkg= array();
		
		if(!empty($params['back_background_color'])) {
			$back_bkg[] = 'background-color: '.$params['back_background_color'];
		}
		
		return $back_bkg;
		
	}
	
	private function getFrontStyle($params){
		return ($params['front_side_style'] !== '') ? 'qodef-'.$params['front_side_style'] : '';
	}
	
	private function getBackStyle($params){
		return ($params['back_side_style'] !== '') ? 'qodef-'.$params['back_side_style'] : '';
	}
	
	private function getImageStyle($params){
		
		$image_style = array();
		
		if(!empty($params['image_padding_bottom'])) {
			$image_style[] = 'padding-bottom: '.$params['image_padding_bottom'] . 'px';
		}
		
		return $image_style;
		
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorInfoBox() );