<?php

class StartitCoreElementorVideoButton extends \Elementor\Widget_Base{
	public function get_name() {
		return 'qodef_video_button';
	}
	
	public function get_title() {
		return esc_html__( "Select Video Button", 'select-core' );
	}
	
	public function get_icon() {
		return 'startit-elementor-custom-icon startit-elementor-video-button';
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
			'video_link',
			[
				'label' => esc_html__( "Video Link", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'button_size',
			[
				'label' => esc_html__( "Play Button Size (px)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'video_link!' => ''
				]
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_title_tag(),
				'default' => 'h6',
				'condition' => [
					'title!' => ''
				]
			]
		);
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$params = $this->get_settings_for_display();
		
		$params['button_style'] = $this->getButtonStyle($params);
		$params['video_title_tag'] = $this->getVideoButtonTitleTag($params);
		
		//Get HTML from template
		echo qode_core_get_independent_shortcode_module_template_part('templates/video-button-template', 'videobutton', '', $params);
	}
	
	/**
	 * Return Style for Button
	 *
	 * @param $params
	 * @return string
	 */
	private function getButtonStyle($params) {
		$button_style = array();
		
		if ($params['button_size'] !== '') {
			$button_size = strstr($params['button_size'], 'px') ? $params['button_size'] : $params['button_size'].'px';
			$button_style[] = 'width: '.$button_size;
			$button_style[] = 'height: '.$button_size;
			$button_style[] = 'font-size: '. intval($button_size)*0.8 .'px';
		}
		
		return implode(';', $button_style);
	}
	
	/**
	 * Return Title Tag. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @return string
	 */
	private function getVideoButtonTitleTag($params) {
		$headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
		return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : 'h6';
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorVideoButton() );