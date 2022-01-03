<?php

class StartitCoreElementorServiceTable extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_service_table';
    }

    public function get_title() {
        return esc_html__( 'Select Service Table', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-service-table';
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
		    'feature_column_title',
		    [
			    'label' => esc_html__( "Feature Column Title", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    for ($x = 1; $x <= 3; $x++) {
		
		    $this->add_control(
			    'service_'.$x.'_enabled',
			    [
				    'label' => esc_html__( "Service ", 'select-core' ) . $x . esc_html__( " Enabled", 'select-core' ),
				    'type'  => \Elementor\Controls_Manager::SELECT,
				    'options' => startit_qode_get_yes_no_select_array()
			    ]
		    );
		
		    $this->add_control(
			    'service_'.$x.'_title',
			    [
				    'label' => esc_html__( "Service ", 'select-core' ) . $x . esc_html__( " Title", 'select-core' ),
				    'type'  => \Elementor\Controls_Manager::TEXT,
				    'condition' => [
					    'service_'.$x.'_enabled' => array('yes')
				    ]
			    ]
		    );
	    }
	
	    $this->end_controls_section();
	
	    $this->start_controls_section(
		    'features',
		    [
			    'label' => esc_html__( 'Features', 'select-core' ),
			    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		    ]
	    );
	
	    for ($y = 1; $y <= 8 ; $y++) {
		
		    $this->add_control(
			    'feature_' . $y . '_title',
			    [
				    'label' => esc_html__( "Feature ", 'select-core' ) . $y . esc_html__( " Title", 'select-core' ),
				    'type'  => \Elementor\Controls_Manager::TEXT
			    ]
		    );
		
	    }
	
	    $this->end_controls_section();
	
	    for ($x = 1; $x <= 3; $x++) {
		
		    $this->start_controls_section(
			    'features_' . $x,
			    [
				    'label' => esc_html__( 'Service ' . $x, 'select-core' ),
				    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			    ]
		    );
		
		    for ($y = 1; $y <= 8; $y++) {
			
			    $this->add_control(
				    'feature_' . $y . '_' . $x . '_enabled',
				    [
					    'label' => esc_html__( "Feature ", 'select-core' ) . $y . esc_html__( " Enabled", 'select-core' ),
					    'type'  => \Elementor\Controls_Manager::SELECT,
					    'options' => startit_qode_get_yes_no_select_array(),
					    'condition' => [
						    'feature_'.$y.'_title!' => ''
					    ]
				    ]
			    );
			
		    }
		
		    $this->end_controls_section();
		
	    }
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $service_count = 3;
	    $features_count = 8;
	    $feature_fields = array();
	    $service_fields = array();
	    $service_feature_fields = array();
	
	    for($y = 1; $y <= $features_count; $y++) {
		    $feature_fields['feature_' . $y . '_title'] = '';
	    }
	
	    for ($x = 1; $x <= $service_count; $x++) {
		    for ($y = 1; $y <= $features_count; $y++) {
			    $service_feature_fields['feature_' . $y . '_' . $x . '_enabled'] = '';
		    }
		
		    $service_fields['service_'.$x.'_enabled'] = '';
		    $service_fields['service_'.$x.'_title'] = '';
		
	    }
	    
	    $params['service_count'] = $service_count;
	    $params['features_count'] = $features_count;
	
	    $params['table_titles'] = $this->getTableTitles($params);
	    $params['table_rows'] = $this->getTableRows($params);
	    $cols = $this->getColNumber($params);
	    
	    ?>
	    
	    <div class="qodef-service-table qodef-cols-<?php echo esc_attr($cols); ?>">
	        <div class="qodef-service-table-inner">
	            <table class="qodef-service-table-holder">
			        <?php echo qode_core_get_independent_shortcode_module_template_part('templates/service-table-template','service-table', '', $params); ?>
	            </table>
	        </div>
	    </div>
	    

		<?php
    }
	
	private function getTableTitles($params) {
		
		extract($params);
		$titles = array();
		
		$titles[] = $params['feature_column_title'];
		
		for ( $i = 1; $i <= $service_count; $i++ ) {
			if($params['service_'.$i.'_enabled'] == 'yes') {
				$titles[] = ${'service_' . $i . '_title'};
			}
		}
		
		return $titles;
		
	}
	
	private function getColNumber($params) {
		
		extract($params);
		$cols = 0;
		
		for ( $i = 1; $i <= $service_count; $i++ ) {
			if($params['service_'.$i.'_enabled'] == 'yes') {
				$cols++;
			}
		}
		
		return $cols;
		
	}
	
	private function getTableRows($params) {
		
		extract($params);
		$features = array();
		
		for ( $i = 1; $i <= $features_count; $i++ ) {
			if($params['feature_' . $i . '_title'] != '') {
				$feature_title = ${'feature_' . $i . '_title'};
				$feature_enabled = array();
				for ( $j = 1; $j <= $service_count; $j++ ) {
					if($params['service_'.$j.'_enabled'] == 'yes') {
						$feature_enabled[] = $params['feature_' . $i . '_' . $j . '_enabled'];
					}
				}
				
				$feature['title'] = $feature_title;
				$feature['features_enabled'] = $feature_enabled;
				
				$features[] = $feature;
			}
		}
		
		return $features;
		
	}

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorServiceTable() );