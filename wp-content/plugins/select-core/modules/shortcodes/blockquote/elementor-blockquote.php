<?php

class StartitCoreElementorBlockquote extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_blockquote';
    }

    public function get_title() {
        return esc_html__( 'Select Blockquote', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-blockquote';
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
		    'text',
		    [
			    'label' => esc_html__( 'Text', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXTAREA,
			    'default' => esc_html__( 'Blockquote text', 'select-core' ),
		    ]
	    );
	
	    $this->add_control(
		    'title_tag',
		    [
			    'label'		=> esc_html__( 'Title tag', 'select-core' ),
			    'type'		=> \Elementor\Controls_Manager::SELECT,
			    'options'	=> startit_qode_get_title_tag(),
			    'default'	=> 'h4'
		    ]
	    );
	
	    $this->add_control(
		    'width',
		    [
			    'label' => esc_html__( 'Width (%)', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	    
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $params['blockquote_style'] = $this->getBlockquoteStyle($params);
	    $params['blockquote_title_tag'] = $this->getBlockquoteTitleTag($params);
	
	    //Get HTML from template
	    echo qode_core_get_independent_shortcode_module_template_part('templates/blockquote-template', 'blockquote', '', $params);
    }
	
	/**
	 * Return Style for Blockquote
	 *
	 * @param $params
	 * @return string
	 */
	private function getBlockquoteStyle($params) {
		$blockquote_style = array();
		
		if ($params['width'] !== '') {
			$width = strstr($params['width'], '%') ? $params['width'] : $params['width'].'%';
			$blockquote_style[] = 'width: '.$width;
		}
		
		return implode(';', $blockquote_style);
	}
	
	/**
	 * Return Blockquote Title Tag. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @return string
	 */
	private function getBlockquoteTitleTag($params) {
		$headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
		return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : 'h4';
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorBlockquote() );