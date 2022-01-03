<?php

class StartitCoreElementorPortfolioSlider extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_portfolio_slider';
    }

    public function get_title() {
        return esc_html__( "Portfolio Slider", 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-portfolio-slider';
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
			    'label' => esc_html__( "Portfolio Slider Template", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'standard' => esc_html__( 'Standard', 'select-core' ),
				    'gallery' => esc_html__( 'Gallery', 'select-core' )
			    ],
			    'default' => 'standard'
		    ]
	    );
	
	    $this->add_control(
		    'image_size',
		    [
			    'label' => esc_html__( "Image size", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    ''          => esc_html__( 'Default', 'select-core' ),
				    'full'      => esc_html__( 'Original Size', 'select-core' ),
				    'square'    => esc_html__( 'Square', 'select-core' ),
				    'landscape' => esc_html__( 'Landscape', 'select-core' ),
				    'portrait'  => esc_html__( 'Portrait', 'select-core' ),
			    ],
			    'default' => 'full'
		    ]
	    );
	    
        $this->add_control(
            'order_by',
            [
                'label' => esc_html__( "Order By", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => '',
                    'menu_order' => esc_html__( 'Menu Order', 'select-core' ),
                    'title'      => esc_html__( 'Title', 'select-core' ),
                    'date'       => esc_html__( 'Date', 'select-core' )
                ],
                'default' => 'date'
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( "Order", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
	                '' => '',
	                'ASC' => 'ASC',
	                'DESC' => 'DESC',
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => esc_html__( "Number", 'select-core' ),
                "description" => esc_html__( "Number of portolios on page (-1 is all)", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '-1'
            ]
        );
	
	    $this->add_control(
		    'portfolios_shown',
		    [
			    'label' => esc_html__( "Number of Portfolios Shown", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    '' => '',
				    '3' => '3',
				    '4' => '4',
				    '5' => '5',
				    '6' => '6'
			    ],
			    'default' => '3',
			    'description' => esc_html__('Number of portfolios that are showing at the same time in full width (on smaller screens is responsive so there will be less items shown)','select-core' ),
		
		    ]
	    );
	    
        $this->add_control(
            'category',
            [
                'label' => esc_html__( "Category", 'select-core' ),
                "description" => esc_html__( "Category Slug (leave empty for all)", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'selected_projects',
            [
                'label' => esc_html__( "Selected Projects", 'select-core' ),
                "description" => esc_html__( "Selected Projects (leave empty for all, delimit by comma)", 'select-core' ),
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
        
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
        
        $params['portfolio_slider'] = 'yes';
        $params['show_load_more'] = 'no';
        
        echo startit_qode_execute_shortcode('qodef_portfolio_list', $params);
    }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorPortfolioSlider() );