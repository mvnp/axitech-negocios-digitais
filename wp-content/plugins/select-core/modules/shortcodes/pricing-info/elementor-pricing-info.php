<?php

class StartitCoreElementorPricingInfo extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_pricing_info';
    }

    public function get_title() {
        return esc_html__( 'Select Pricing Info', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-pricing-info';
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
		    'title',
		    [
			    'label' => esc_html__( 'Title', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => esc_html__("Basic", "select-core"),
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
		    'price',
		    [
			    'label' => esc_html__( 'Price', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => '100',
			    'description' => 'Default value is 100'
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
		    'price_period',
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
	
	    $this->add_control(
		    'active',
		    [
			    'label' => esc_html__( 'Active', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'no'
		    ]
	    );
	
	    $this->add_control(
		    'active_text',
		    [
			    'label' => esc_html__( 'Active Text', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'condition' => [
				    'active' => 'yes'
			    ]
		    ]
	    );
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $pricing_info_clasess		= '';
	    if($params['active'] == 'yes') {
		    $pricing_info_clasess .= ' qodef-active';
	    }
	
	    $params['pricing_info_classes'] = $pricing_info_clasess;
	
	    echo qode_core_get_independent_shortcode_module_template_part('templates/pricing-info', 'pricing-info', '', $params);
    }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorPricingInfo() );