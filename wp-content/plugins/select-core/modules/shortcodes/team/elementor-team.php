<?php

class StartitCoreElementorTeam extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_team';
    }

    public function get_title() {
        return esc_html__( 'Select Team', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-team';
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
		    'team_type',
		    [
			    'label' => esc_html__( 'Type', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => array(
				    'main-info-on-hover'     => esc_html__( 'Main Info on Hover', 'select-core' ),
				    'main-info-below-image'  => esc_html__( 'Main Info Below Image', 'select-core' )
			    ),
				'default' => 'main-info-on-hover'
		    ]
	    );

	    $this->add_control(
		    'team_image',
		    [
			    'label' => esc_html__( 'Image', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::MEDIA
		    ]
	    );
	
	    $this->add_control(
		    'team_name',
		    [
			    'label' => esc_html__( 'Name', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'team_name_tag',
		    [
			    'label'		=> esc_html__( 'Name Tag', 'select-core' ),
			    'type'		=> \Elementor\Controls_Manager::SELECT,
			    'options'	=> startit_qode_get_title_tag(),
			    'default'	=> 'h5',
			    'condition' => [
				    'team_name!' => ''
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'team_position',
		    [
			    'label' => esc_html__( 'Position', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'team_description',
		    [
			    'label' => esc_html__( 'Description', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXTAREA
		    ]
	    );
	
	    startit_qode_icon_collections()->getElementorParamsArray($this, '', '', true);
	    
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $params['icon'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $params );

		if( ! empty( $params['team_image'] ) ){
			$params['team_image'] = $params['team_image']['id'];
		}
	
	    $params['icon_parameters'] = $this->getIconParameters($params);
	    $params['team_name_tag'] = $this->getTeamNameTag($params);
	    $params['team_image_src'] = $this->getTeamImage($params);
	
	    //Get HTML from template based on type of team
	    echo qode_core_get_independent_shortcode_module_template_part('templates/' . $params['team_type'], 'team', '', $params);
    }
	
	/**
	 * Return correct heading value. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @return mixed
	 */
	private function getTeamNameTag($params) {
		
		$headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
		return (in_array($params['team_name_tag'], $headings_array)) ? $params['team_name_tag'] : 'h5';
		
	}
	
	private function getIconParameters($params) {
		$iconPackName = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		
		$params_array['icon_pack']   = $params['icon_pack'];
		$params_array['type']   = 'circle';
		$params_array[$iconPackName] = $params[$iconPackName];
		
		return $params_array;
	}
	
	/**
	 * Return Team image
	 *
	 * @param $params
	 * @return false|string
	 */
	private function getTeamImage($params) {
		
		if (is_numeric($params['team_image'])) {
			$team_image_src = wp_get_attachment_url($params['team_image']);
		} else {
			$team_image_src = $params['team_image'];
		}
		
		return $team_image_src;
		
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorTeam() );