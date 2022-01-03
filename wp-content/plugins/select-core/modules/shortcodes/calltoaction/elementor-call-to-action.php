<?php

class StartitCoreElementorCallToAction extends \Elementor\Widget_Base{
	public function get_name() {
		return 'qodef_call_to_action';
	}
	
	public function get_title() {
		return esc_html__( 'Select Call to Action', 'select-core' );
	}
	
	public function get_icon() {
		return 'startit-elementor-custom-icon startit-elementor-call-to-action';
	}
	
	public function get_categories() {
		return [ 'select' ];
	}
	
	protected function _register_controls(){
		
		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'select-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'full_width',
			[
				'label' => esc_html__( 'Full Width', 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_yes_no_select_array(),
			]
		);
		
		$this->add_control(
			'content_in_grid',
			[
				'label' => esc_html__( 'Content in grid', 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_yes_no_select_array(),
				'condition' => [
					'full_width' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'grid_size',
			[
				'label' => esc_html__( 'Grid size', 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'75' => '75/25',
					'50' => '50/50',
					'66' => '66/33'
				],
				'condition' => [
					'content_in_grid' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'type',
			[
				'label' => esc_html__( 'Type', 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'normal'    => esc_html__( 'Normal', 'select-core' ),
					'with-icon' => esc_html__( 'With Icon', 'select-core' )
				]
			]
		);
		
		startit_qode_icon_collections()->getElementorParamsArray($this, array( 'type' => 'with-icon'), '', true);
		
		$this->add_control(
			'show_button',
			[
				'label' => esc_html__( 'Show Button', 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_yes_no_select_array()
			]
		);
		
		$this->add_control(
			'button_position',
			[
				'label' => esc_html__( 'Button Position', 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''         => esc_html__('Default/right', 'select-core'),
					'center'   => esc_html__('Center', 'select-core'),
					'left'     => esc_html__('Left', 'select-core'),
				],
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( "Button Text", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => 'Default text is "button"',
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'button_link',
			[
				'label' => esc_html__( "Button Link", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'button_target',
			[
				'label' => esc_html__( "Button Target", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => startit_qode_get_link_target_array(),
				'default' => '_self',
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'button_icon_pack',
			[
				'label' => esc_html__( 'Button Icon Pack', 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array_merge(array('' => esc_html__('No Icon', 'select-core')),startit_qode_icon_collections()->getIconCollectionsElementor()),
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$call_to_action_button_IconCollections = startit_qode_icon_collections()->iconCollections;
		
		foreach($call_to_action_button_IconCollections as $collection_key => $collection) {
			
			$this->add_control(
				'button_'.$collection->param,
				[
					'label' => esc_html__( 'Button Icon', 'select-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'' => 'test',
					'options' => $collection->getIconsArray(),
					'condition' => [
						'button_icon_pack' => $collection_key
					]
				]
			);
		}
		
		$this->add_control(
			'content',
			[
				'label' => esc_html__( "Content", 'select-core' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => "<p>".esc_html__( 'I am test text for Call to action.', 'select-core' )."</p>"
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
			'icon_size',
			[
				'label' => esc_html__( "Icon Size (px)", 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type' => 'with-icon'
				]
			]
		);
		
		$this->add_control(
			'box_padding',
			[
				'label' => esc_html__( 'Box Padding (top right bottom left) px', 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default padding is 20px on all sides', 'select-core' ),
				'default' => '20px'
			]
		);
		
		$this->add_control(
			'text_size',
			[
				'label' => esc_html__( 'Default Text Font Size (px)', 'select-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Font size for p tag', 'select-core' )
			]
		);
		
		$this->add_control(
			'button_size',
			[
				'label' => esc_html__( "Button Size", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''          => esc_html__( 'Default', 'select-core' ),
					'small'     => esc_html__( 'Small', 'select-core' ),
					'medium'    => esc_html__( 'Medium', 'select-core' ),
					'large'     => esc_html__( 'Large', 'select-core' ),
					'big_large' => esc_html__( 'Extra Large', 'select-core' )
				],
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'button_type',
			[
				'label' => esc_html__( "Button Type", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''          => esc_html__( 'Default', 'select-core' ),
					'outline'   => esc_html__( 'Outline', 'select-core' ),
					'solid'     => esc_html__( 'Solid', 'select-core' ),
				],
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__( "Enable Hover Animation", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''                  => esc_html__( 'No', 'select-core' ),
					'hover-animation'   => esc_html__( 'Yes', 'select-core' )
				],
				'condition' => [
					'button_type' => array('', 'solid')
				]
			]
		);
		
		$this->add_control(
			'color',
			[
				'label' => esc_html__( "Color", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'hover_color',
			[
				'label' => esc_html__( "Hover Color", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'background_color',
			[
				'label' => esc_html__( "Background Color", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'hover_background_color',
			[
				'label' => esc_html__( "Hover Background Color", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( "Border Color", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'hover_border_color',
			[
				'label' => esc_html__( "Hover Border Color", 'select-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$params = $this->get_settings_for_display();
		
		$call_to_action_icons_form_fields = array();
		
		foreach (startit_qode_icon_collections()->iconCollections as $collection_key => $collection) {
			$call_to_action_icons_form_fields['button_' . $collection->param ] = '';
		}
		
		$params['text_wrapper_classes'] = $this->getTextWrapperClasses($params);
		$params['content_styles'] = $this->getContentStyles($params);
		$params['call_to_action_styles'] = $this->getCallToActionStyles($params);
		$params['icon'] = $this->getCallToActionIcon($params);
		$params['button_parameters'] = $this->getButtonParameters($params);
		
		//Get HTML from template
		echo qode_core_get_independent_shortcode_module_template_part('templates/call-to-action-template', 'calltoaction', '', $params);
	}
	
	/**
	 * Return Classes for Call To Action text wrapper
	 *
	 * @param $params
	 * @return string
	 */
	private function getTextWrapperClasses($params) {
		return ( $params['show_button'] == 'yes') ? 'qodef-call-to-action-column1 qodef-call-to-action-cell' : '';
	}
	
	/**
	 * Return CSS styles for Call To Action Icon
	 *
	 * @param $params
	 * @return string
	 */
	private function getIconStyles($params) {
		$icon_style = array();
		
		if ($params['icon_size'] !== '') {
			$icon_style[] = 'font-size: ' . $params['icon_size'] . 'px';
		}
		
		return implode(';', $icon_style);
	}
	
	/**
	 * Return CSS styles for Call To Action Content
	 *
	 * @param $params
	 * @return string
	 */
	private function getContentStyles($params) {
		$content_styles = array();
		
		if ($params['text_size'] !== '') {
			$content_styles[] = 'font-size: ' . $params['text_size'] . 'px';
		}
		
		return implode(';', $content_styles);
	}
	
	/**
	 * Return CSS styles for Call To Action shortcode
	 *
	 * @param $params
	 * @return string
	 */
	private function getCallToActionStyles($params) {
		$call_to_action_styles = array();
		
		if ($params['box_padding'] != '') {
			$call_to_action_styles[] = 'padding: ' . $params['box_padding'] . ';';
		}
		
		return implode(';', $call_to_action_styles);
	}
	
	/**
	 * Return Icon for Call To Action Shortcode
	 *
	 * @param $params
	 * @return mixed
	 */
	private function getCallToActionIcon($params) {
		
		$icon = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$iconStyles = array();
		$iconStyles['icon_attributes']['style'] = $this->getIconStyles($params);
		$call_to_action_icon = '';
		if(!empty($params[$icon])){
			$call_to_action_icon = startit_qode_icon_collections()->renderIcon( $params[$icon], $params['icon_pack'], $iconStyles );
		}
		return $call_to_action_icon;
		
	}
	
	private function getButtonParameters($params) {
		$button_params_array = array();
		
		if(!empty($params['button_link'])) {
			$button_params_array['link'] = $params['button_link'];
		}
		
		if(!empty($params['button_size'])) {
			$button_params_array['size'] = $params['button_size'];
		}
		
		if(!empty($params['button_type'])) {
			$button_params_array['type'] = $params['button_type'];
		}
		
		if(!empty($params['button_hover_animation'])) {
			$button_params_array['hover_animation'] = $params['button_hover_animation'];
		}
		
		if(!empty($params['color'])) {
			$button_params_array['color'] = $params['color'];
		}
		
		if(!empty($params['hover_color'])) {
			$button_params_array['hover_color'] = $params['hover_color'];
		}
		
		if(!empty($params['background_color'])) {
			$button_params_array['background_color'] = $params['background_color'];
		}
		
		if(!empty($params['hover_background_color'])) {
			$button_params_array['hover_background_color'] = $params['hover_background_color'];
		}
		
		if(!empty($params['border_color'])) {
			$button_params_array['border_color'] = $params['border_color'];
		}
		
		if(!empty($params['hover_border_color'])) {
			$button_params_array['hover_border_color'] = $params['hover_border_color'];
		}
		
		if(!empty($params['button_icon_pack'])) {
			$button_params_array['icon_pack'] = $params['button_icon_pack'];
			$iconPackName = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['button_icon_pack']);
			$button_params_array[$iconPackName] = $params['button_'.$iconPackName];
		}
		
		if(!empty($params['button_target'])) {
			$button_params_array['target'] = $params['button_target'];
		}
		
		if(!empty($params['button_text'])) {
			$button_params_array['text'] = $params['button_text'];
		}
		
		return $button_params_array;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorCallToAction() );