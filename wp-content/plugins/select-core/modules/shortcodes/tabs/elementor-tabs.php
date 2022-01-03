<?php

class StartitCoreElementorTabs extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_tabs';
    }

    public function get_title() {
        return esc_html__( 'Select Tabs', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-tabs';
    }

    public function get_categories() {
        return [ 'select' ];
    }

    public static function get_templates() {
        return Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
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
            'style',
            [
                'label' => esc_html__('Style', 'select-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'horizontal_with_text'           => esc_html__('Horizontal With Text', 'select-core'),
                    'horizontal_with_icons'          => esc_html__('Horizontal With Icons', 'select-core'),
                    'horizontal_with_text_and_icons' => esc_html__('Horizontal With Text And Icons', 'select-core'),
                    'vertical_with_text'             => esc_html__('Vertical With Text', 'select-core'),
                    'vertical_with_icons'            => esc_html__('Vertical With Icons', 'select-core'),
                    'vertical_with_text_and_icons'   => esc_html__('Vertical With Text and Icons', 'select-core'),
                ],
                'default' => 'horizontal_with_text'
            ]
        );

        $repeater = new \Elementor\Repeater();
	
	    startit_qode_icon_collections()->getElementorParamsArray($repeater, '', '', true);
        
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Tab', 'select-core'),
            ]
        );
        
        $repeater->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'select-core'),
                'type' => \Elementor\Controls_Manager::WYSIWYG
            ]
        );
	
	    qode_core_generate_elementor_templates_control( $repeater, array('content' => '') );

        $this->add_control(
            'tab_items',
            [
                'label' => esc_html__( 'Tab Items', 'select-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Tab Item'),
            ]
        );


        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $params['tab_class'] = $this->getTabClass($params);
	    ?>
	    
	    <div class="qodef-tabs <?php echo esc_attr($params['tab_class']) ?> clearfix">
		    <ul class="qodef-tabs-nav">
			    <?php  foreach ($params['tab_items'] as $tab_item) {?>
				    <li>
					    <a href="#tab-<?php echo sanitize_title($tab_item['title'])?>">
						    
						    <?php if($params['style'] === 'horizontal_with_icons' || $params['style'] === 'vertical_with_icons') :  ?>
						        <span class="qodef-icon-frame"></span>
						    <?php endif; ?>
						    
						    <?php if($params['style'] === 'horizontal_with_text' || $params['style'] === 'vertical_with_text') :  ?>
							    <?php echo esc_attr($tab_item['title'])?>
						    <?php endif; ?>
						
						    <?php if($params['style'] === 'horizontal_with_text_and_icons' || $params['style'] === 'vertical_with_text_and_icons') :  ?>
							    <span class="qodef-icon-frame"></span>
							    <span class="qodef-tab-text-after-icon">
									<?php echo esc_attr($tab_item['title'])?>
								</span>
						    <?php endif; ?>
						    
					    </a>
				    </li>
			    <?php } ?>
		    </ul>
		    
		    <?php foreach ( $params['tab_items'] as $tab_item ) {
			
			    $tab_item['icon'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $tab_item );
		    	
			    if( empty( $tab_item['content'] ) ){
				    $tab_item['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $tab_item['template_id'] );
			    };
			
			    echo qode_core_get_independent_shortcode_module_template_part('templates/tab_content','tabs', '', $tab_item);
		    } ?>
		    
	    </div>
	    
        <?php
    }
    
	/**
	 * Generates tabs class
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getTabClass($params){
		$tabStyle = $params['style'];
		$tabClass = 'with_text';
		
		switch ($tabStyle) {
			case 'horizontal_with_text':
				$tabClass = 'qodef-horizontal qodef-tab-text';
				break;
			case 'horizontal_with_icons':
				$tabClass = 'qodef-horizontal qodef-tab-icon';
				break;
			case 'horizontal_with_text_and_icons':
				$tabClass = 'qodef-horizontal qodef-tab-text-icon';
				break;
			case 'vertical_with_text':
				$tabClass = 'qodef-vertical qodef-tab-text';
				break;
			case 'vertical_with_icons':
				$tabClass = 'qodef-vertical qodef-tab-icon';
				break;
			case 'vertical_with_text_and_icons':
				$tabClass = 'qodef-vertical qodef-tab-text-icon';
				break;
		}
		return $tabClass;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorTabs() );