<?php

class StartitCoreElementorProcessHolder extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_process_holder';
    }

    public function get_title() {
        return esc_html__( 'Process Holder', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-process-holder';
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
            'number_of_columns',
            [
                'label' => esc_html__( 'Columns', 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'columns-3' => esc_html__( 'Three', 'select-core' ),
                    'columns-4' => esc_html__( 'Four', 'select-core' ),
                    'columns-5' => esc_html__( 'Five', 'select-core' ),
                ]
            ]
        );
        
        $repeater = new \Elementor\Repeater();
	
	    startit_qode_icon_collections()->getElementorParamsArray($repeater, '', '', true);
        
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        
	    $repeater->add_control(
		    'title_tag',
		    [
			    'label' => esc_html__( 'Title Tag', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_title_tag(),
			    'default' => 'h4',
			    'label_block' => true,
		    ]
	    );
	
	    $repeater->add_control(
		    'text',
		    [
			    'label' => esc_html__( 'Text', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'label_block' => true,
		    ]
	    );
	    
        $this->add_control(
            'process_items',
            [
                'label' => esc_html__( 'Process Items', 'select-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
        
	    $process_holder_class = array();
	    $process_holder_class[] = 'qodef-process-holder';
	    $process_holder_class[] = $params['number_of_columns'];
	    
	    ?>
	    
	    <div <?php echo startit_qode_get_class_attribute($process_holder_class); ?>>
		    <div class="qodef-process-holder-inner">
			    
			    <?php
			    
			    foreach ( $params['process_items'] as $process_item ){
				    $process_item['icon'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $process_item );
				    $process_item['icon_parameters'] = $this->getIconParameters($process_item);
				
				    echo qode_core_get_independent_shortcode_module_template_part('templates/process-item-template', 'process', '', $process_item);
			    }
			    
			    ?>
		    </div>
	    </div>
	    
		<?php
    }
	
	private function getIconParameters($params) {
		$iconPackName = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		
		$params_array['icon_pack']   = $params['icon_pack'];
		$params_array['type']   = 'circle';
		$params_array[$iconPackName] = $params[$iconPackName];
		
		return $params_array;
	}
    
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorProcessHolder() );