<?php

class StartitCoreElementorPieChartWithIcon extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_pie_chart_with_icon';
    }

    public function get_title() {
        return esc_html__( "Select Pie Chart With Icon", 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-pie-chart-with-icon';
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
            'percent',
            [
                'label' => esc_html__( "Percentage", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '25'
            ]
        );
	
	    $this->add_control(
		    'title',
		    [
			    'label' => esc_html__( "Title", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'title_tag',
		    [
			    'label' => esc_html__( "Title Tag", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_title_tag(),
			    'default' => 'h4',
			    'condition' => [
				    'title!' => ''
			    ]
		    ]
	    );
	
	    startit_qode_icon_collections()->getElementorParamsArray($this, '', '', true);
	
	    $this->add_control(
		    'icon_color',
		    [
			    'label' => esc_html__( "Icon Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'condition' => [
				    'icon_pack' => startit_qode_icon_collections()->getIconCollectionsKeys()
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'icon_custom_size',
		    [
			    'label' => esc_html__( "Icon Size (px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'condition' => [
				    'icon_pack' => startit_qode_icon_collections()->getIconCollectionsKeys()
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
	    
	    $this->end_controls_section();
	    
	    $this->start_controls_section(
		    'design',
		    [
			    'label' => esc_html__( 'Design Options', 'select-core' ),
			    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		    ]
	    );
	
	    $this->add_control(
		    'size',
		    [
			    'label' => esc_html__( "Size(px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'margin_below_chart',
		    [
			    'label' => esc_html__( "Margin below chart (px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'active_bar_color',
		    [
			    'label' => esc_html__( "Active Bar Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'inactive_bar_color',
		    [
			    'label' => esc_html__( "Inactive Bar Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $params['icon'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $params );
	
	    $params['title_tag'] = $this->getValidTitleTag($params);
	    $params['pie_chart_data'] = $this->getPieChartData($params);
	    $params['pie_chart_style'] = $this->getPieChartStyle($params);
	    $params['icon'] = $this->getPieChartIcon($params);
	
	    echo qode_core_get_independent_shortcode_module_template_part('templates/pie-chart-with-icon', 'piecharts/piechartwithicon', '', $params);
    }
    
	private function getValidTitleTag($params) {
		
		$headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
		return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : 'h4';
		
	}
	
	/**
	 * Return Pie Chart icon style for icon getPieChartIcon() method
	 *
	 * @param $params
	 * @return string
	 */
	private function getIconStyles($params) {
		
		$iconStyles = array();
		
		if ($params['icon_color'] !== '') {
			$iconStyles[] = 'color: ' . $params['icon_color'];
		}
		
		if ($params['icon_custom_size'] !== '') {
			$iconStyles[] = 'font-size: ' . $params['icon_custom_size'] . 'px';
		}
		
		return implode(';', $iconStyles);
		
	}
	
	/**
	 * Return Pie Chart style
	 *
	 * @param $params
	 * @return array
	 */
	private function getPieChartStyle($params) {
		
		$pieChartStyle = array();
		
		if ($params['margin_below_chart'] !== '') {
			$pieChartStyle[] = 'margin-top: ' . $params['margin_below_chart'] . 'px';
		}
		
		return $pieChartStyle;
		
	}
	
	/**
	 * Return data attributes for Pie Chart
	 *
	 * @param $params
	 * @return array
	 */
	private function getPieChartData($params) {
		
		$pieChartData = array();
		
		if( $params['size'] !== '' ) {
			$pieChartData['data-size'] = $params['size'];
		}
		if( $params['percent'] !== '' ) {
			$pieChartData['data-percent'] = $params['percent'];
		}
		
		if( $params['active_bar_color'] !== '' ) {
			$pieChartData['data-bar-color'] = $params['active_bar_color'];
		}
		else {
			$pieChartData['data-bar-color'] = startit_qode_options()->getOptionValue('first_color');
		}
		
		if( $params['inactive_bar_color'] !== '' ) {
			$pieChartData['data-bar-inactive-color'] = $params['inactive_bar_color'];
		}
		else {
			$pieChartData['data-bar-inactive-color'] = '#f4f4f4';
		}
		
		return $pieChartData;
		
	}
	
	/**
	 * Return Pie Chart Icon
	 *
	 * @param $params
	 * @return mixed
	 */
	private function getPieChartIcon($params) {
		
		$icon = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$iconStyles = array();
		$iconStyles['icon_attributes']['style'] = $this->getIconStyles($params);
		
		$pie_chart_icon = startit_qode_icon_collections()->renderIcon( $params[$icon], $params['icon_pack'], $iconStyles );
		
		return $pie_chart_icon;
		
	}

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorPieChartWithIcon() );