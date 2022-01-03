<?php

class StartitCoreElementorButton extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_button';
    }

    public function get_title() {
        return esc_html__( 'Button', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-button';
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
            'size',
            [
                'label' => esc_html__( "Size", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''          => esc_html__( 'Default', 'select-core' ),
                    'small'     => esc_html__( 'Small', 'select-core' ),
                    'medium'    => esc_html__( 'Medium', 'select-core' ),
                    'large'     => esc_html__( 'Large', 'select-core' ),
                    'huge'      => esc_html__( 'Extra Large', 'select-core' ),
                    'huge-full-width' => esc_html__( 'Extra Large Full Width', 'select-core' ),
                ],
                'default' => ''
            ]
        );
	
	    $this->add_control(
		    'type',
		    [
			    'label' => esc_html__( "Type", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    ''         => esc_html__( 'Default', 'select-core' ),
				    'outline'  => esc_html__( 'Outline', 'select-core' ),
				    'solid'    => esc_html__( 'Solid', 'select-core' )
			    ],
			    'default' => ''
		    ]
	    );
	
	    $this->add_control(
		    'hover_animation',
		    [
			    'label' => esc_html__( 'Enable Hover Animation', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    '' => esc_html__( 'No', 'select-core' ),
				    'hover-animation' => esc_html__( 'Yes', 'select-core' )
			    ],
			    'default' => '',
			    'condition' => [
			    	'type' => array('', 'solid')
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
		    'link',
		    [
			    'label' => esc_html__( "Link", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'target',
		    [
			    'label' => esc_html__( "Link Target", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    '_self'    => esc_html__( 'Self', 'select-core' ),
				    '_blank'   => esc_html__( 'Blank', 'select-core' )
			    ],
			    'default' => '_self'
		    ]
	    );
	
	    $this->add_control(
		    'custom_class',
		    [
			    'label' => esc_html__('Custom CSS class', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    startit_qode_icon_collections()->getElementorParamsArray($this, '', '', true);
	
	    $this->end_controls_section();
	
	    $this->start_controls_section(
		    'design_options',
		    [
			    'label' => esc_html__( 'Design Options', 'select-core' ),
			    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
		    'hover_color',
		    [
			    'label' => esc_html__( "Hover Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'background_color',
		    [
			    'label' => esc_html__( "Background Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'hover_background_color',
		    [
			    'label' => esc_html__( "Hover Background Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'border_color',
		    [
			    'label' => esc_html__( 'Border Color', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'hover_border_color',
		    [
			    'label' => esc_html__( 'Hover Border Color', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'font_size',
		    [
			    'label' => esc_html__('Font Size (px)', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'font_weight',
		    [
			    'label' => esc_html__( 'Font Weight', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_font_weight_array(true),
			    'default' => ''
		    ]
	    );
	
	    $this->add_control(
		    'margin',
		    [
			    'label' => esc_html__( 'Margin', 'select-core' ),
			    "description" => esc_html__("Insert margin in format: 0px 0px 1px 0px", 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
		
		    ]
	    );
	
	    $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $params['html_type'] = 'anchor';
	
	    if($params['html_type'] !== 'input') {
		    $params['icon'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $params );
	    }
	    
	    $params['size'] = !empty($params['size']) ? $params['size'] : 'medium';
	    $params['type'] = !empty($params['type']) ? $params['type'] : 'default';
	
	
	    $params['link']   = !empty($params['link']) ? $params['link'] : '#';
	    $params['target'] = !empty($params['target']) ? $params['target'] : '_self';
	
	    //prepare params for template
	    $params['button_classes']      = $this->getButtonClasses($params);
	    $params['button_custom_attrs'] = !empty($params['custom_attrs']) ? $params['custom_attrs'] : array();
	    $params['button_styles']       = $this->getButtonStyles($params);
	    $params['button_animation_styles']       = $this->getButtonAnimationStyles($params);
	    $params['button_data']         = $this->getButtonDataAttr($params);
	
	    echo qode_core_get_independent_shortcode_module_template_part('templates/'.$params['html_type'], 'button','', $params);
    }
	
	/**
	 * Returns array of button styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getButtonStyles($params) {
		$styles = array();
		
		if(!empty($params['color'])) {
			$styles[] = 'color: '.$params['color'];
		}
		
		if(!empty($params['background_color'])) {
			$styles[] = 'background-color: '.$params['background_color'];
		}
		
		if(!empty($params['border_color'])) {
			$styles[] = 'border-color: '.$params['border_color'];
		}
		
		if(!empty($params['font_size'])) {
			$styles[] = 'font-size: ' . startit_qode_filter_px($params['font_size']) . 'px';
		}
		
		if(!empty($params['font_weight'])) {
			$styles[] = 'font-weight: '.$params['font_weight'];
		}
		
		if(!empty($params['margin'])) {
			$styles[] = 'margin: '.$params['margin'];
		}
		
		return $styles;
	}
	
	/**
	 * Returns array of button animation overlay styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getButtonAnimationStyles($params) {
		$animation_styles = array();
		
		if(!empty($params['hover_background_color']) && ($params['hover_animation'])=='hover-animation') {
			$animation_styles[] = 'background-color: '.$params['hover_background_color'];
		}
		
		return $animation_styles;
	}
	
	/**
	 *
	 * Returns array of button data attr
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getButtonDataAttr($params) {
		$data = array();
		
		if(!empty($params['hover_background_color']) && ($params['hover_animation'])=='') {
			$data['data-hover-bg-color'] = $params['hover_background_color'];
		}
		
		if(!empty($params['background_color']) && ($params['hover_animation'])=='hover-animation'){
			$data['data-hover-bg-color'] = $params['background_color'];
		}
		
		
		if(!empty($params['hover_color'])) {
			$data['data-hover-color'] = $params['hover_color'];
		}
		
		if(!empty($params['hover_border_color'])) {
			$data['data-hover-border-color'] = $params['hover_border_color'];
		}
		
		return $data;
	}
	
	/**
	 * Returns array of HTML classes for button
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getButtonClasses($params) {
		$buttonClasses = array(
			'qodef-btn',
			'qodef-btn-'.$params['size'],
			'qodef-btn-'.$params['type']
		);
		
		if(!empty($params['hover_background_color'])) {
			$buttonClasses[] = 'qodef-btn-custom-hover-bg';
		}
		
		if(!empty($params['hover_border_color'])) {
			$buttonClasses[] = 'qodef-btn-custom-border-hover';
		}
		
		if(!empty($params['hover_color'])) {
			$buttonClasses[] = 'qodef-btn-custom-hover-color';
		}
		
		if(!empty($params['icon'])) {
			$buttonClasses[] = 'qodef-btn-icon';
		}
		
		if(!empty($params['custom_class'])) {
			$buttonClasses[] = $params['custom_class'];
		}
		
		if(!empty($params['hover_animation'])) {
			$buttonClasses[] = 'qodef-btn-'.$params['hover_animation'];
		}
		
		return $buttonClasses;
	}

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorButton() );