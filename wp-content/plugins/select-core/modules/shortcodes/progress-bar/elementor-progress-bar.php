<?php

class StartitCoreElementorProgressBar extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_progress_bar';
    }

    public function get_title() {
        return esc_html__( 'Select Progress Bar', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-progress-bar';
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
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( 'Title Tag', 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_title_tag(),
				'default' => 'h4'
			]
		);
	
	    $this->add_control(
		    'percent',
		    [
			    'label' => esc_html__( 'Percentage', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => '100'
		    ]
	    );
	
	    $this->add_control(
		    'percentage_type',
		    [
			    'label' => esc_html__( 'Percentage Type', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    "floating"  => esc_html__( "Floating", 'select-core' ),
				    "static"    => esc_html__( "Static", 'select-core' )
			    ],
			    'default' => 'floating',
			    'condition' => [
				    'percent!' => ''
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'floating_type',
		    [
			    'label' => esc_html__( 'Floating Type', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    "floating_outside"  => esc_html__( "Outside Floating", 'select-core' ),
				    "floating_inside"   => esc_html__( "Inside Floating", 'select-core' )
			    ],
			    'default' => 'floating_outside',
			    'condition' => [
				    'percentage_type' => 'floating'
			    ]
		    ]
	    );
	    
		$this->add_control(
			'progress_bar_color',
			[
				'label' => esc_html__( 'Progress Bar Color', 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR
			]
		);
	
	    $this->add_control(
		    'progress_bar_active_color',
		    [
			    'label' => esc_html__( 'Progress Bar Active Color', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	    
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
        
	    $params['percentage_classes'] = $this->getPercentageClasses($params);
	    $params['bar_style'] = $this->getBarStyle($params);
	    $params['bar_active_style'] = $this->getActiveBarStyle($params);
	
	    //init variables
	    echo qode_core_get_independent_shortcode_module_template_part('templates/progress-bar-template', 'progress-bar', '', $params);
    }
	
	/**
	 * Generates css classes for progress bar
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getPercentageClasses($params){
		
		$percentClassesArray = array();
		
		if(!empty($params['percentage_type']) !=''){
			
			if($params['percentage_type'] == 'floating'){
				
				$percentClassesArray[]= 'qodef-floating';
				
				if($params['floating_type'] == 'floating_outside'){
					
					$percentClassesArray[] = 'qodef-floating-outside';
					
				}
				
				elseif($params['floating_type'] == 'floating_inside'){
					
					$percentClassesArray[] = 'qodef-floating-inside';
				}
				
			}
			elseif($params['percentage_type'] == 'static'){
				
				$percentClassesArray[] = 'qodef-static';
				
			}
		}
		return implode(' ', $percentClassesArray);
	}
	
	private function getBarStyle($params){
		$barStyleArray = array();
		if(!empty($params['progress_bar_color'])) {
			$barStyleArray[] = 'background-color:' . $params['progress_bar_color'];
		}
		
		return implode(';', $barStyleArray);
	}
	
	private function getActiveBarStyle($params){
		$barActiveStyleArray = array();
		if(!empty($params['progress_bar_active_color'])) {
			$barActiveStyleArray[] = 'background-color:' . $params['progress_bar_active_color'];
		}
		
		return implode(';', $barActiveStyleArray);
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorProgressBar() );