<?php

class StartitCoreElementorCounter extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_counter';
    }

    public function get_title() {
        return esc_html__( "Select Counter", 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-counter';
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
                    'zero'   => esc_html__( 'Zero Counter', 'select-core' ),
                    'random' => esc_html__( 'Random Counter', 'select-core' ),
                ],
                'default' => 'zero'
            ]
        );
	
	    $this->add_control(
		    'position',
		    [
			    'label' => esc_html__( "Position", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'left'   => esc_html__( 'Left', 'select-core' ),
				    'right'  => esc_html__( 'Right', 'select-core' ),
				    'center' => esc_html__( 'Center', 'select-core' ),
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'digit',
		    [
			    'label' => esc_html__( "Digit", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => '100'
		    ]
	    );
	
	    $this->add_control(
		    'title',
		    [
			    'label' => esc_html__( "Title", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
		    ]
	    );
	
	    $this->add_control(
		    'title_tag',
		    [
			    'label' => esc_html__( "Title Tag", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_title_tag()
		    ]
	    );
	
	    $this->add_control(
		    'text',
		    [
			    'label' => esc_html__( "Text", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
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
		    'font_size',
		    [
			    'label' => esc_html__( "Digit Font Size (px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
		    ]
	    );
	
	    $this->add_control(
		    'digit_color',
		    [
			    'label' => esc_html__( "Digit and Icon color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'default' => '#999'
		    ]
	    );
	
	    $this->add_control(
		    'title_color',
		    [
			    'label' => esc_html__( "Title Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR,
		    ]
	    );
	
	    $this->add_control(
		    'padding_bottom',
		    [
			    'label' => esc_html__( "Padding Bottom(px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    //get correct heading value. If provided heading isn't valid get the default one
	    $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
	    $params['title_tag'] = (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : 'h4';
	
	    $params['counter_holder_styles'] = $this->getCounterHolderStyle($params);
	    $params['counter_styles'] = $this->getCounterStyle($params);
	    $params['counter_title_styles'] = $this->getCounterTitleStyle($params);
	    $params['icon'] = $this->getCounterIcon($params);
	
	    //Get HTML from template
	    echo qode_core_get_independent_shortcode_module_template_part('templates/counter-template', 'counter', '', $params);
    }
	
	/**
	 * Return Counter holder styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getCounterHolderStyle($params) {
		$counterHolderStyle = array();
		
		if ($params['padding_bottom'] !== '') {
			$counterHolderStyle[] = 'padding-bottom: ' . $params['padding_bottom'] . 'px';
		}
		
		return implode(';', $counterHolderStyle);
	}
	
	/**
	 * Return Counter styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getCounterStyle($params) {
		$counterStyle = array();
		
		if ($params['font_size'] !== '') {
			$counterStyle[] = 'font-size: ' . $params['font_size'] . 'px';
		}
		
		if ($params['digit_color'] !== '') {
			$counterStyle[] = 'color: ' . $params['digit_color'];
		}
		
		return implode(';', $counterStyle);
	}
	
	/**
	 * Return Counter Title styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getCounterTitleStyle($params) {
		$counterTitleStyle = array();
		
		if ($params['title_color'] !== '') {
			$counterTitleStyle[] = 'color: ' . $params['title_color'];
		}
		
		return implode(';', $counterTitleStyle);
	}
	
	private function getCounterIcon($params) {
		
		$icon = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		
		$counter_icon = startit_qode_icon_collections()->renderIcon( $params[$icon], $params['icon_pack']);
		
		return $counter_icon;
		
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorCounter() );