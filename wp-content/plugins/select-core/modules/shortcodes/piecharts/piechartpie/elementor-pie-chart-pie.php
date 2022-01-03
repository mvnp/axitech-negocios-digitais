<?php

class StartitCoreElementorPieChartPie extends \Elementor\Widget_Base{
	
	private $chartFields = 10;
	
    public function get_name() {
        return 'qodef_pie_chart_pie';
    }

    public function get_title() {
        return esc_html__( "Select Pie Chart 2 (Pie)", 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-pie-chart3';
    }

    public function get_categories() {
        return [ 'select' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'select-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT
            ]
        );
	
	    $this->add_control(
		    'width',
		    [
			    'label' => esc_html__( "Width", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => '150'
		    ]
	    );
	
	    $this->add_control(
		    'height',
		    [
			    'label' => esc_html__( "Height", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => '150'
		    ]
	    );
	
	    for ($i = 1; $i <= $this->chartFields; $i++) {
		
		    $this->add_control(
			    "chart_value_" . $i,
			    [
				    'label' => esc_html__( 'Chart Value ', 'select-core' ) . $i,
				    'type' => \Elementor\Controls_Manager::TEXT
			    ]
		    );
		
		    $this->add_control(
			    "chart_color_" . $i,
			    [
				    'label' => esc_html__( 'Chart Color ', 'select-core' ) . $i,
				    'type' => \Elementor\Controls_Manager::COLOR
			    ]
		    );
		
		    $this->add_control(
			    "chart_legend_" . $i,
			    [
				    'label' => esc_html__( 'Chart Legend ', 'select-core' ) . $i,
				    'type' => \Elementor\Controls_Manager::TEXT
			    ]
		    );
	    }
	    
	    $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $chart_fields = array();
	    for ($i = 1; $i <= $this->chartFields; $i++) {
		
		    $chart_fields['chart_value_' . $i] = '';
		    $chart_fields['chart_color_' . $i] = '';
		    $chart_fields['chart_legend_' . $i] = '';
		
	    }
	    
	    $params['id'] = mt_rand(1000, 9999);
	    $params['pie_chart_data'] = $this->getPieChartData($params);
	    $params['legend_data'] = $this->getPieChartLegendData($params);
	
	    echo qode_core_get_independent_shortcode_module_template_part('templates/pie-chart-pie', 'piecharts/piechartpie', '', $params);
    }
	
	/**
	 * Return data attributes for Pie Chart
	 *
	 * @param $params
	 * @return array
	 */
	private function getPieChartData($params) {
		
		$pieChartData = array();
		
		for ( $i = 1; $i <= $this->chartFields; $i++ ) {
			
			if ( isset($params['chart_value_' . $i]) && $params['chart_value_' . $i] !== '' ) {
				$pieChartData['data-value-' . $i] = $params['chart_value_' . $i];
			}
			if ( isset($params['chart_color_' . $i]) && $params['chart_color_' . $i] !== '' ) {
				$pieChartData['data-color-' . $i] = $params['chart_color_' . $i];
			}
			if ( isset($params['chart_legend_' . $i]) && $params['chart_legend_' . $i] !== '' ) {
				$pieChartData['data-legend-' . $i] = $params['chart_legend_' . $i];
			}
			
		}
		
		return $pieChartData;
		
	}
	
	private function getPieChartLegendData($params) {
		
		$legendData = array();
		$legendItem = array();
		
		for ( $i = 1; $i <= $this->chartFields; $i++ ) {
			
			if ( isset($params['chart_color_' . $i]) && $params['chart_color_' . $i] !== '' ) {
				$legendItem['color'] = 'background-color: '. $params['chart_color_' . $i];
			}
			if ( isset($params['chart_legend_' . $i]) && $params['chart_legend_' . $i] !== '' ) {
				$legendItem['legend'] = $params['chart_legend_' . $i];
			}
			
			if (!empty($legendItem)) {
				$legendData[] = $legendItem;
				unset($legendItem);
			}
			
		}
		
		return $legendData;
		
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorPieChartPie() );