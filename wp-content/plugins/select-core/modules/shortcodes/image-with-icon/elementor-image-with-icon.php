<?php

class StartitCoreElementorImageWithIcon extends \Elementor\Widget_Base{
	public function get_name() {
		return 'qodef_image_with_icon';
	}
	
	public function get_title() {
		return esc_html__( "Image With Icon", 'select-core' );
	}
	
	public function get_icon() {
		return 'startit-elementor-custom-icon startit-elementor-image-with-icon';
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
		
		startit_qode_icon_collections()->getElementorParamsArray($this, '', '', false);
		
		$this->add_control(
			'image',
			[
				'label' => esc_html__( "Image", 'select-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA
			]
		);
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$params = $this->get_settings_for_display();
		
		$params['icon_parameters'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $params );
		
		$params['icon_parameters'] = $this->getIconParameters($params);
		$image_meta = $this->getImageMeta($params);
		$params['image'] = $image_meta['image_src'];
		$params['alt'] = $image_meta['image_alt'];
		
		echo qode_core_get_independent_shortcode_module_template_part('templates/image-with-icon-template', 'image-with-icon', '', $params);
	}
	
	private function getIconParameters($params) {
		$iconPackName = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		
		$params_array['icon_pack']   = $params['icon_pack'];
		$params_array['type']   = 'circle';
		$params_array[$iconPackName] = $params[$iconPackName];
		
		return $params_array;
	}
	
	private function getImageMeta($params) {
		
		if ( !empty($params['image']) ) {
			$image_src               = wp_get_attachment_url( $params['image']['id'] );
			$image_meta['image_src'] = $image_src;
			$image_alt               = get_post_meta( $params['image']['id'], '_wp_attachment_image_alt', true );
			$image_meta['image_alt'] = $image_alt;
		}
		
		return $image_meta;
		
	}
	
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorImageWithIcon() );