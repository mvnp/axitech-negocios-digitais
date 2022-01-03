<?php

class StartitCoreElementorIcon extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_icon';
    }

    public function get_title() {
        return esc_html__( "Icon", 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-icon';
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
            'size',
            [
                'label' => esc_html__( "Size", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'qodef-icon-tiny'   => esc_html__( 'Tiny', 'select-core' ),
                    'qodef-icon-small'  => esc_html__( 'Small', 'select-core' ),
                    'qodef-icon-medium' => esc_html__( 'Medium', 'select-core' ),
                    'qodef-icon-large'  => esc_html__( 'Large', 'select-core' ),
                    'qodef-icon-huge'   => esc_html__( 'Very Large', 'select-core' ),
                ],
                'default' => 'qodef-icon-medium'
            ]
        );
	
	    $this->add_control(
		    'custom_size',
		    [
			    'label' => esc_html__( "Custom Size (px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
		    ]
	    );

        $this->add_control(
            'type',
            [
                'label' => esc_html__( "Type", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'normal' => esc_html__( 'Normal', 'select-core' ),
                    'circle' => esc_html__( 'Circle', 'select-core' ),
                    'square' => esc_html__( 'Square', 'select-core' ),
                    'circle checked' => esc_html__( 'Circle checked', 'select-core' ),
                ],
                'default' => 'normal'
            ]
        );
	
	    $this->add_control(
		    'border_radius',
		    [
			    'label' => esc_html__( "Border radius", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__( "Please insert border radius(Rounded corners) in px.", 'select-core' ),
			    'condition' => [
				    'type' => 'square'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'shape_size',
		    [
			    'label' => esc_html__( "Shape Size (px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'condition' => [
				    'type' => array('circle', 'square', 'circle checked')
			    ]
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
		    'border_color',
		    [
			    'label' => esc_html__( "Border Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'condition' => [
				    'type' => array('circle', 'square', 'circle checked')
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'border_width',
		    [
			    'label' => esc_html__( "Border Width (px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__( "Enter just number. Omit pixels", 'select-core' ),
			    'condition' => [
				    'type' => array('circle', 'square', 'circle checked')
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'background_color',
		    [
			    'label' => esc_html__( "Background Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'condition' => [
				    'type' => array('circle', 'square', 'circle checked')
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'hover_icon_color',
		    [
			    'label' => esc_html__( "Hover Icon Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'hover_border_color',
		    [
			    'label' => esc_html__( "Hover Border Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'condition' => [
				    'type' => array('circle', 'square', 'circle checked')
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'hover_background_color',
		    [
			    'label' => esc_html__( "Hover Background Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'condition' => [
				    'type' => array('circle', 'square', 'circle checked')
			    ]
		    ]
	    );
	    
        $this->add_control(
            'margin',
            [
                'label' => esc_html__( "Margin", 'select-core' ),
                "description" => esc_html__( "Margin (top right bottom left)", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'icon_animation',
            [
                'label' => esc_html__( "Icon Animation", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'No', 'select-core' ),
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
            'link',
            [
                'label' => esc_html__( "Link", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );
	
	    $this->add_control(
		    'anchor_icon',
		    [
			    'label' => esc_html__( "Use this icon as Anchor?", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SWITCHER,
			    'description' => 'Check this box to use icon as anchor link (eg. #contact)',
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
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	    $params['icon'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $params );
	
	    //generate icon holder classes
	    $iconHolderClasses = array('qodef-icon-shortcode', $params['type']);
	
	    if($params['icon_animation'] == 'yes') {
		    $iconHolderClasses[] = 'qodef-icon-animation';
	    }
	
	    if($params['custom_size'] == '') {
		    $iconHolderClasses[] = $params['size'];
	    }
	
	    //prepare params for template
	    
	    $params['icon_holder_classes']   = $iconHolderClasses;
	    $params['icon_holder_styles']    = $this->generateIconHolderStyles($params);
	    $params['icon_holder_data']      = $this->generateIconHolderData($params);
	    $params['icon_params']           = $this->generateIconParams($params);
	    $params['icon_animation_holder'] = isset($params['icon_animation']) && $params['icon_animation'] == 'yes';
	    $params['icon_animation_holder_styles'] = $this->generateIconAnimationHolderStyles($params);
	    $params['link_class'] = $this->getLinkClass($params);
	
	    echo qode_core_get_independent_shortcode_module_template_part('templates/icon', 'icon', '', $params);
    }
	
	/**
	 * Generates icon parameters array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function generateIconParams($params) {
		$iconParams = array('icon_attributes' => array());
		
		$iconParams['icon_attributes']['style'] = $this->generateIconStyles($params);
		$iconParams['icon_attributes']['class'] = 'qodef-icon-element';
		
		return $iconParams;
	}
	
	/**
	 * Generates icon styles array
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function generateIconStyles($params) {
		$iconStyles = array();
		
		if(!empty($params['icon_color'])) {
			$iconStyles[] = 'color: '.$params['icon_color'];
		}
		
		if(($params['type'] !== 'normal' && !empty($params['shape_size'])) ||
		   ($params['type'] == 'normal')
		) {
			if(!empty($params['custom_size'])) {
				$iconStyles[] = 'font-size:' . startit_qode_filter_px($params['custom_size']) . 'px';
			}
		}
		
		return implode(';', $iconStyles);
	}
	
	/**
	 * Generates icon holder styles for circle and square icon type
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function generateIconHolderStyles($params) {
		$iconHolderStyles = array();
		
		//generate styles attribute only if type isn't normal
		if(isset($params['type'])) {
			if(isset($params['margin']) && $params['margin'] !== '') {
				$iconHolderStyles[] = 'margin: '.$params['margin'];
			}
			
			$shapeSize = '';
			if(!empty($params['shape_size'])) {
				$shapeSize = $params['shape_size'];
			} elseif(!empty($params['custom_size'])) {
				$shapeSize = $params['custom_size'];
			}
			
			if(!empty($shapeSize)) {
				$iconHolderStyles[] = 'width: ' . startit_qode_filter_px($shapeSize) . 'px';
				$iconHolderStyles[] = 'height: ' . startit_qode_filter_px($shapeSize) . 'px';
				$iconHolderStyles[] = 'line-height: ' . startit_qode_filter_px($shapeSize) . 'px';
			}
			
			if(!empty($params['background_color'])) {
				$iconHolderStyles[] = 'background-color: '.$params['background_color'];
			}
			
			if(!empty($params['border_color']) && (isset($params['border_width']) && $params['border_width'] !== '')) {
				$iconHolderStyles[] = 'border-style: solid';
				$iconHolderStyles[] = 'border-color: '.$params['border_color'];
				$iconHolderStyles[] = 'border-width: ' . startit_qode_filter_px($params['border_width']) . 'px';
			} else if(isset($params['border_width']) && $params['border_width'] !== ''){
				$iconHolderStyles[] = 'border-style: solid';
				$iconHolderStyles[] = 'border-width: ' . startit_qode_filter_px($params['border_width']) . 'px';
			} else if(!empty($params['border_color'])){
				$iconHolderStyles[] = 'border-style: solid';
				$iconHolderStyles[] = 'border-width: 1px';
				$iconHolderStyles[] = 'border-color: '.$params['border_color'];
			}
			
			if($params['type'] == 'square') {
				if(isset($params['border_radius']) && $params['border_radius'] !== '') {
					$iconHolderStyles[] = 'border-radius: ' . startit_qode_filter_px($params['border_radius']) . 'px';
				}
			}
		}
		
		return $iconHolderStyles;
	}
	
	/**
	 * Generates icon holder data attribute array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function generateIconHolderData($params) {
		$iconHolderData = array();
		
		if(isset($params['type']) && $params['type'] !== 'normal') {
			if(!empty($params['hover_border_color'])) {
				$iconHolderData['data-hover-border-color'] = $params['hover_border_color'];
			}
			
			if(!empty($params['hover_background_color'])) {
				$iconHolderData['data-hover-background-color'] = $params['hover_background_color'];
			}
		}
		
		if((isset($params['icon_animation']) && $params['icon_animation'] == 'yes')
		   && (isset($params['icon_animation_delay']) && $params['icon_animation_delay'] !== '')
		) {
			$iconHolderData['data-animation-delay'] = $params['icon_animation_delay'];
		}
		
		if(!empty($params['hover_icon_color'])) {
			$iconHolderData['data-hover-color'] = $params['hover_icon_color'];
		}
		
		if(!empty($params['icon_color'])) {
			$iconHolderData['data-color'] = $params['icon_color'];
		}
		
		return $iconHolderData;
	}
	
	private function generateIconAnimationHolderStyles($params) {
		$styles = array();
		
		if((isset($params['icon_animation']) && $params['icon_animation'] == 'yes')
		   && (isset($params['icon_animation_delay']) && $params['icon_animation_delay'] !== '')
		) {
			$styles[] = 'transition-delay: '.$params['icon_animation_delay'].'ms';
			$styles[] = '-webkit-transition-delay: '.$params['icon_animation_delay'].'ms';
			$styles[] = '-moz-transition-delay: '.$params['icon_animation_delay'].'ms';
			$styles[] = '-ms-transition-delay: '.$params['icon_animation_delay'].'ms';
		}
		
		return $styles;
	}
	
	private function getLinkClass($params) {
		$class = '';
		
		if($params['anchor_icon'] != '' && $params['anchor_icon'] == 'yes') {
			$class .= 'qodef-anchor';
		}
		
		return $class;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorIcon() );