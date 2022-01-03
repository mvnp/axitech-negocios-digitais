<?php

class StartitCoreElementorMobileShowcase extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_mobile_showcase';
    }

    public function get_title() {
        return esc_html__( '3d Mobile Showcase', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-mobile-showcase';
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
            'number_of_layers',
            [
                'label' => esc_html__( 'Number of Layers', 'select-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layers-1'  => esc_html__('One', 'select-core'),
                    'layers-2'  => esc_html__('Two', 'select-core'),
                    'layers-3'  => esc_html__('Three', 'select-core'),
                    'layers-4'  => esc_html__('Four', 'select-core'),
                    'layers-5'  => esc_html__('Five', 'select-core')
                ],
                'default' => 'layers-2'
            ]
        );
	
	    $this->add_control(
		    'image',
		    [
			    'label' => esc_html__( 'Image', 'select-core'),
			    'type' => \Elementor\Controls_Manager::MEDIA,
			    'description' => esc_html__( 'Upload image to show on devices where 3d animation is not supported', 'select-core'),
		    ]
	    );
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'background_image',
            [
                'label' => esc_html__( 'Image', 'select-core'),
                'type' => \Elementor\Controls_Manager::MEDIA
            ]
        );
        
	    $repeater->add_control(
		    'text',
		    [
			    'label' => esc_html__( 'Text', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );

        $this->add_control(
            'showcase_items',
            [
                'label' => esc_html__( '3d Mobile Showcase Items', 'select-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('3d Mobile Showcase Item'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $process_holder_class = array();
	    $process_holder_class[] = 'qodef-mobile-showcase';
	    $process_holder_class[] = $params['number_of_layers'];
        
        ?>
	
		<div <?php echo startit_qode_get_class_attribute($process_holder_class); ?>>
			<div class="qodef-mobile-wrapper">
				<div class="qodef-mobile-preview-image">
					<?php echo wp_get_attachment_image($params['image']['id'], 'full'); ?>
				</div>
				<div class="qodef-perspective">
					<div class="qodef-device">
						<div class="qodef-object">
							<div class="qodef-front"></div>
						</div>
						<div class="qodef-screens">
							<?php
								foreach ( $params['showcase_items'] as $showcase_item ){
									$showcase_item['mobile_showcase_item_image'] = $this->getMobileShowcaseItemImage($showcase_item);
									echo qode_core_get_independent_shortcode_module_template_part('templates/mobile-showcase-item-template','mobile-showcase', '', $showcase_item);
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	    
        <?php
    }
	
	/**
	 * Return Mobile Showcase Item  Background image
	 *
	 * @param $params
	 * @return array
	 */
	private function getMobileShowcaseItemImage($params) {
		
		$element_item_image = '';
		
		if ($params['background_image'] !== '') {
			$element_item_image = 'background-image: url(' . wp_get_attachment_url($params['background_image']['id']) . ')';
		}
		
		return $element_item_image;
		
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorMobileShowcase() );