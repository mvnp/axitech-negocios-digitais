<?php

class StartitCoreElementorPricingTables extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_pricing_tables';
    }

    public function get_title() {
        return esc_html__( 'Select Pricing Tables', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-pricing-tables';
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
            'columns',
            [
                'label' => esc_html__( 'Columns', 'select-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'qodef-two-columns'   => esc_html__('Two', 'select-core'),
                    'qodef-three-columns' => esc_html__('Three', 'select-core'),
                    'qodef-four-columns'  => esc_html__('Four', 'select-core'),
                ],
                'default' => 'four_columns'
            ]
        );

        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__("Basic Plan", "select-core"),
            ]
        );
	
	    $repeater->add_control(
		    'price',
		    [
			    'label' => esc_html__( 'Price', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__( 'Default value is 100', 'select-core'),
			    'default' => '100'
		    ]
	    );
	
	    $repeater->add_control(
		    'currency',
		    [
			    'label' => esc_html__( 'Currency', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__( 'Default mark is $', 'select-core'),
			    'default' => esc_html__('$', 'select-core')
		    ]
	    );
	
	    $repeater->add_control(
		    'price_period',
		    [
			    'label' => esc_html__( 'Price Period', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__( 'Default label is monthly', 'select-core'),
			    'default' => 'Monthly'
		    ]
	    );
	    
        $repeater->add_control(
            'show_button',
            [
                'label' => esc_html__( 'Show Button', 'select-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => startit_qode_get_yes_no_select_array(),
                'default' => 'yes'
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'select-core'),
                "description" => esc_html__( 'Default label is Purchase', 'select-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('button', 'select-core'),
                'condition' => [
                    'show_button' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Button Link', 'select-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'show_button' => 'yes'
                ]
            ]
        );
        
        $repeater->add_control(
            'active',
            [
                'label' => esc_html__( 'Active', 'select-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => startit_qode_get_yes_no_select_array(),
                'default' => 'no'
            ]
        );

        $repeater->add_control(
            'active_text',
            [
                'label' => esc_html__( 'Active text', 'select-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Best choice', 'select-core'),
                'condition' => [
                    'active' => 'yes'
                ]
                
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'select-core'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => "<li>" . esc_html__('content content content', 'select-core') . "</li><li>" . esc_html__('content content content', 'select-core') . "</li><li>" . esc_html__('content content content', 'select-core') . "</li>"
            ]
        );

        $this->add_control(
            'pricing_tables',
            [
                'label' => esc_html__( 'Pricing Table', 'select-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls()
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();

        ?>
	
	
	    <div class="qodef-pricing-tables clearfix <?php echo esc_attr($params['columns']); ?>">
		    
	        <?php
	
	        foreach ($params['pricing_tables'] as $pricing_table){
		
		        $pricing_table_clasess		= '';
		
		        if($pricing_table['active'] == 'yes') {
			        $pricing_table_clasess .= ' qodef-active';
		        }
		
		        $pricing_table['pricing_table_classes'] = $pricing_table_clasess;
		        
	            echo qode_core_get_independent_shortcode_module_template_part('templates/pricing-table-template','pricing-table', '', $pricing_table);
	        }
	
	        ?>

        </div>

        <?php

    }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorPricingTables() );