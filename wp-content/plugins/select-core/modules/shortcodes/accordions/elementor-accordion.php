<?php

class StartitCoreElementorAccordion extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_accordion';
    }

    public function get_title() {
        return esc_html__( 'Select Accordion', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-accordion';
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
		    'el_class',
		    [
			    'label' => esc_html__('Extra class name', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'select-core' )
		    ]
	    );
	    
        $this->add_control(
            'style',
            [
                'label' => esc_html__('Style', 'select-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'accordion'       => esc_html__('Accordion', 'select-core'),
                    'boxed_accordion' => esc_html__('Boxed Accordion', 'select-core'),
                    'toggle'          => esc_html__('Toggle', 'select-core'),
                    'boxed_toggle'    => esc_html__('Boxed Toggle', 'select-core'),
                ],
                'default' => 'accordion'
            ]
        );

        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'select-core' ),
                'description' => esc_html__( 'Enter accordion section title.', 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Section', 'select-core'),
            ]
        );
	
	    $repeater->add_control(
		    'el_id',
		    [
			    'label' => esc_html__( 'Section ID', 'select-core' ),
			    'description' => sprintf( esc_html__( 'Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'select-core' ), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . esc_html__( 'link', 'select-core' ) . '</a>' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
		    ]
	    );

        $repeater->add_control(
            'title_tag',
            [
                'label' => esc_html__("Title Tag", 'select-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => startit_qode_get_title_tag(),
                'default' => 'h4'
            ]
        );
        
        $repeater->add_control(
            'title_background_color',
            [
                'label' => esc_html__('Title Background Color', 'select-core'),
                'type' => \Elementor\Controls_Manager::COLOR
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
            'accordion_items',
            [
                'label' => esc_html__( 'Accordion Items', 'select-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Accordion Item'),
            ]
        );


        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $acc_class = $this->getAccordionClasses($params);
	    $params['acc_class'] = $acc_class;
        
        ?>

        <div class="qodef-accordion-holder clearfix <?php echo esc_attr($acc_class); ?> ">
            <?php foreach ( $params['accordion_items'] as $accordion_item ) {
	
	            $accordion_item['title_style'] = $this->getTitleStyle($accordion_item);
            	
            	if( empty( $accordion_item['content'] ) ){
                    $accordion_item['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $accordion_item['template_id'] );
                };
            	
	            echo qode_core_get_independent_shortcode_module_template_part('templates/accordion-template','accordions', '',$accordion_item);
            } ?>
        </div>

        <?php
    }
	
	private function getAccordionClasses($params){
		
		$acc_class = '';
		$style = $params['style'];
		switch($style) {
			case 'toggle':
				$acc_class .= 'qodef-toggle qodef-initial';
				break;
			case 'boxed_toggle':
				$acc_class .= 'qodef-toggle qodef-boxed';
				break;
			case 'boxed_accordion':
				$acc_class .= 'qodef-accordion qodef-boxed';
				break;
			default:
				$acc_class = 'qodef-accordion qodef-initial';
		}
		return $acc_class;
	}
	
	private function getTitleStyle($params) {
		
		$title_style = array();
		if($params['title_background_color'] != '') {
			$title_style[] = 'background-color:' . $params['title_background_color'];
			$title_style[] = 'border-color:' . $params['title_background_color'];
		}
		
		return implode(';', $title_style);
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorAccordion() );