<?php

class StartitCoreElementorPricingSlider extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_pricing_slider';
    }

    public function get_title() {
        return esc_html__( 'Select Pricing Slider', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-pricing-slider';
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
		    'unit_name',
		    [
			    'label' => esc_html__( 'Unit name', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Enter singular name of unit you will charge for (ex. unit)'
		    ]
	    );
	
	    $this->add_control(
		    'units_range',
		    [
			    'label' => esc_html__( 'Units range', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Enter maximum number of units you will charge (ex. 1000)'
		    ]
	    );
	
	    $this->add_control(
		    'units_breakpoints',
		    [
			    'label' => esc_html__( 'Units breakpoints', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Enter breakpoint value where price per unit will be reduced (ex. 100)'
		    ]
	    );
	
	    $this->add_control(
		    'price_per_unit',
		    [
			    'label' => esc_html__( 'Price Per Unit', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Enter value of price that will be charged per unit (ex. 5)'
		    ]
	    );
	
	    $this->add_control(
		    'price_reduce_per_breakpoint',
		    [
			    'label' => esc_html__( 'Price Reduce Per Breakpoint', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Enter value for which price will be reduced on each breakpoint (ex. 0.2)'
		    ]
	    );
	
	    $this->add_control(
		    'price_period',
		    [
			    'label' => esc_html__( 'Price Period Button Label', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Enter pricing period you will be charging by (ex. Monthly Pricing)'
		    ]
	    );
	
	    $this->add_control(
		    'extra_period',
		    [
			    'label' => esc_html__( 'Enable Extra Period', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'description' => 'Enable this option if you need extra pricing period (ex. Yearly)'
		    ]
	    );
	
	    $this->end_controls_section();
	    
	    $this->start_controls_section(
		    'extra',
		    [
			    'label' => esc_html__( 'Extra Period', 'select-core' ),
			    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		    ]
	    );
	    
	    $this->add_control(
		    'price_per_unit_extra',
		    [
			    'label' => esc_html__( 'Price Per Unit', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Enter value of price that will be charged per unit (ex. 5)',
			    'condition' => [
			    	'extra_period' => 'yes'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'price_reduce_per_breakpoint_extra',
		    [
			    'label' => esc_html__( 'Price Reduce Per Breakpoint', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Enter value for which price will be reduced on each breakpoint (ex. 0.2)',
			    'condition' => [
				    'extra_period' => 'yes'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'price_period_extra',
		    [
			    'label' => esc_html__( 'Price Period Button Label', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Enter pricing period you will be charging by (ex. Yearly Pricing)',
			    'condition' => [
				    'extra_period' => 'yes'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'extra_initially_active',
		    [
			    'label' => esc_html__( 'Initially Active', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'description' => 'Set extra period to be initially active state',
			    'condition' => [
				    'extra_period' => 'yes'
			    ]
		    ]
	    );
	    
	    $this->end_controls_section();
	    
	    $this->start_controls_section(
		    'pricing_info',
		    [
			    'label' => esc_html__( 'Pricing Info', 'select-core' ),
			    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		    ]
	    );
	
	    $this->add_control(
		    'title',
		    [
			    'label' => esc_html__( 'Title', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => 'Pay what you need'
		    ]
	    );
	
	    $this->add_control(
		    'title_tag',
		    [
			    'label' => esc_html__( 'Title Tag', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_title_tag(),
			    'default' => 'h5'
		    ]
	    );
	
	    $this->add_control(
		    'description',
		    [
			    'label' => esc_html__( 'Description', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXTAREA
		    ]
	    );
	
	    $this->add_control(
		    'currency',
		    [
			    'label' => esc_html__( 'Currency', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => '$',
			    'description' => 'Default mark is $'
		    ]
	    );
	
	    $this->add_control(
		    'price_period_info',
		    [
			    'label' => esc_html__( 'Price Period', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => 'Monthly',
			    'description' => 'Default label is monthly'
		    ]
	    );
	
	    $this->add_control(
		    'show_button',
		    [
			    'label' => esc_html__( 'Show Button', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'no'
		    ]
	    );
	
	    $this->add_control(
		    'button_text',
		    [
			    'label' => esc_html__( 'Button Text', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'condition' => [
				    'show_button' => 'yes'
			    ],
		    ]
	    );
	
	    $this->add_control(
		    'link',
		    [
			    'label' => esc_html__( 'Button Link', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
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
		    'button_text_color',
		    [
			    'label' => esc_html__( 'Button Text Color', 'select-core'),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'unit_text_color',
		    [
			    'label' => esc_html__( 'Unit Text Color', 'select-core'),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
        
	    $params['button_value'] = $this->getButtonData($params);
	    $params['button_value_extra'] = $this->getButtonDataExtra($params);
	    $params['pricing_info_params'] = $this->getPricingInfoParams($params);
	    $params['slider_data'] = $this->getSliderData($params);
	    $params['unit_text_style'] = $this->getStyleForUnitText($params);
	
	    echo qode_core_get_independent_shortcode_module_template_part('templates/pricing-slider', 'pricing-slider', '', $params);
    }
	
	/**
	 * Return data attributes for button
	 *
	 * @param $params
	 * @return array
	 */
	private function getButtonData($params) {
		
		$buttonData = array();
		
		if( $params['price_per_unit'] !== '' ) {
			$buttonData['data-price-per-unit'] = $params['price_per_unit'];
		}
		
		if( $params['price_reduce_per_breakpoint'] !== '' ) {
			$buttonData['data-price-reduce-per-breakpoint'] = $params['price_reduce_per_breakpoint'];
		}
		
		
		return $buttonData;
		
	}
	
	/**
	 * Return data attributes for button
	 *
	 * @param $params
	 * @return array
	 */
	private function getButtonDataExtra($params) {
		
		$buttonData = array();
		
		if( $params['price_per_unit_extra'] !== '' ) {
			$buttonData['data-price-per-unit'] = $params['price_per_unit_extra'];
		}
		
		if( $params['units_breakpoints'] !== '' ) {
			$buttonData['data-price-reduce-per-breakpoint'] = $params['price_reduce_per_breakpoint_extra'];
		}
		
		
		return $buttonData;
		
	}
	
	/**
	 * Return data attributes for slider
	 *
	 * @param $params
	 * @return array
	 */
	private function getSliderData($params) {
		
		$sliderData = array();
		
		if( $params['units_range'] !== '' ) {
			$sliderData['data-units-range'] = $params['units_range'];
		}
		
		if( $params['units_breakpoints'] !== '' ) {
			$sliderData['data-units-breakpoints'] = $params['units_breakpoints'];
		}
		
		if( $params['unit_name'] !== '' ) {
			$sliderData['data-unit-name'] = $params['unit_name'];
		}
		
		
		return $sliderData;
		
	}
	
	/**
	 * Return data attributes for button
	 *
	 * @param $params
	 * @return string
	 */
	private function getPricingInfoParams($params) {
		
		$shortcodeParams = '';
		//$price = $params['extra_initially_active'] === 'yes' ? $params['price_per_unit_extra'] : $params['price_per_unit'];
		//$price_period = $params['extra_initially_active'] === 'yes' ? $params['price_period_extra'] : $params['price_period'];
		
		$shortcodeParams .= ' show_button="' .$params["show_button"] .'" ';
		$shortcodeParams .= ' description="' .$params["description"] .'" ';
		$shortcodeParams .= ' title_tag="' .$params["title_tag"] .'" ';
		$shortcodeParams .= ' title="' .$params["title"] .'" ';
		$shortcodeParams .= ' currency="' .$params["currency"] .'" ';
		$shortcodeParams .= ' price="0"';
		$shortcodeParams .= ' price_period="' . $params['price_period_info'] .'" ';
		$shortcodeParams .= ' button_text="' .$params["button_text"] .'" ';
		$shortcodeParams .= ' link="' .$params["link"] .'" ';
		
		return $shortcodeParams;
	}
	
	/**
	 * Return string with styles for unit text
	 *
	 * @param $params
	 * @return string
	 */
	private function getStyleForUnitText($params) {
		$unitStyle = array();
		
		if($params['unit_text_color'] !== '') {
			$unitStyle[] = "color: " . $params['unit_text_color'];
		}
		
		return implode(';', $unitStyle);
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorPricingSlider() );