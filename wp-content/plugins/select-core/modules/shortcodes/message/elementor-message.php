<?php

class StartitCoreElementorMessage extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_message';
    }

    public function get_title() {
        return esc_html__( "Select Message", 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-message';
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
            'type',
            [
                'label' => esc_html__( "Type", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'normal'    => esc_html__( 'Normal', 'select-core' ),
                    'with_icon' => esc_html__( 'With Icon', 'select-core' ),
                ],
                'default' => 'normal'
            ]
        );
        
	    startit_qode_icon_collections()->getElementorParamsArray($this, array('type' => 'with_icon'), '', true);
	    
	    $this->add_control(
		    'icon_color',
		    [
			    'label' => esc_html__( "Icon Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'condition' => [
				    'type' => 'with_icon'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'icon_background_color',
		    [
			    'label' => esc_html__( "Icon Background Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'condition' => [
				    'type' => 'with_icon'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'close_icon_color',
		    [
			    'label' => esc_html__( "Close Icon Color", 'select-core' ),
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
		    'border_color',
		    [
			    'label' => esc_html__( "Border Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'border_width',
		    [
			    'label' => esc_html__( "Border Width (px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    "description" => esc_html__( "Default value is 0", 'select-core' )
		    ]
	    );
	
	    $this->add_control(
		    'content',
		    [
			    'label' => esc_html__( "Content", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::WYSIWYG,
			    'default' => "<p>".esc_html__( 'I am test text for Message shortcode', 'select-core' )."</p>"
		    ]
	    );
	    
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $params['icon'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $params );
	    
	    $message_classes = '';
	
	    if ($params['type'] == 'with_icon') {
		    $message_classes .= ' qodef-with-icon';
	    }
	    $params['close_icon_styles'] = $this->getClosIconStyle($params);
	    $params['message_classes'] = $message_classes;
	    $params['message_styles'] = $this->getHolderStyle($params);
	    $params['icon_styles'] = $this->getIconStyle($params);
	
	    echo qode_core_get_independent_shortcode_module_template_part('templates/message-holder-template', 'message', '', $params);
    }
	
	/**
	 * Generates message icon styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getIconStyle($params){
		$iconStyles = array();
		
		if(!empty($params['icon_color'])) {
			$iconStyles[] = 'color: '.$params['icon_color'];
		}
		
		if(!empty($params['icon_background_color'])) {
			$iconStyles[] = 'background-color:'.$params['icon_background_color'].'';
		}
		
		$iconStyles['icon_attributes']['style'] = implode(';', $iconStyles);
		
		return $iconStyles;
	}
	/**
	 * Generates message holder styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getHolderStyle($params){
		$holderStyles = array();
		
		if(!empty($params['background_color'])) {
			$holderStyles[] = 'background-color: '.$params['background_color'];
		}
		
		if(!empty($params['border_color'])) {
			$holderStyles[] = 'border-color:'.$params['border_color'].'';
		}
		if(!empty($params['border_width'])) {
			$holderStyles[] = 'border-width:'.$params['border_width'].'px';
		}
		
		return implode(';', $holderStyles);
	}
	
	private function getClosIconStyle($params) {
		
		$closeIconStyles = array();
		
		if(!empty($params['close_icon_color'])) {
			$closeIconStyles[] = 'color: ' . $params['close_icon_color'];
		}
		
		return implode(';', $closeIconStyles);
	}

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorMessage() );