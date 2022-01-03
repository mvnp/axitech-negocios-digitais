<?php

class StartitCoreElementorIconListItem extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_icon_list_item';
    }

    public function get_title() {
        return esc_html__( "Select Icon List Item", 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-icon-list-item';
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
	
	    startit_qode_icon_collections()->getElementorParamsArray($this, '', '', true);

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__( "Icon Size (px)", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );
        
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( "Icon Color", 'select-core' ),
                'type' => \Elementor\Controls_Manager::COLOR
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
            'title_size',
            [
                'label' => esc_html__( "Title size (px)", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                	'title!' => ''
                ]
            ]
        );
	
	    $this->add_control(
		    'title_color',
		    [
			    'label' => esc_html__( "Title Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'condition' => [
				    'title!' => ''
			    ]
		    ]
	    );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $params['icon'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $params );
	
	    $iconPackName = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
	    $iconClasses = '';
	
	    //generate icon holder classes
	    $iconClasses .= 'qodef-icon-list-item-icon ';
	    $iconClasses .= $params['icon_pack'];
	
	    $params['icon_classes'] = $iconClasses;
	    $params['icon'] = $params[$iconPackName];
	    $params['icon_attributes']['style'] =  $this->getIconStyle($params);
	    $params['title_style'] =  $this->getTitleStyle($params);
	
	    //Get HTML from template
	    echo qode_core_get_independent_shortcode_module_template_part('templates/icon-list-item-template', 'icon-list-item', '', $params);
    }
	
	/**
	 * Generates icon styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getIconStyle($params){
		$iconStylesArray = array();
		if(!empty($params['icon_color'])) {
			$iconStylesArray[] = 'color:' . $params['icon_color'];
		}
		
		if (!empty($params['icon_size'])) {
			$iconStylesArray[] = 'font-size:' . startit_qode_filter_px( $params['icon_size']) . 'px';
		}
		
		return implode(';', $iconStylesArray);
	}
	/**
	 * Generates title styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getTitleStyle($params){
		$titleStylesArray = array();
		if(!empty($params['title_color'])) {
			$titleStylesArray[] = 'color:' . $params['title_color'];
		}
		
		if (!empty($params['title_size'])) {
			$titleStylesArray[] = 'font-size:' . startit_qode_filter_px( $params['title_size']) . 'px';
		}
		
		return implode(';', $titleStylesArray);
	}

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorIconListItem() );