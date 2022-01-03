<?php

class StartitCoreElementorFullwidthSlider extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_fullwidth_slider';
    }

    public function get_title() {
        return esc_html__( 'Fullwidth Slider', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-fullwidth-slider';
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
            'interval',
            [
                'label' => esc_html__( 'Interval', 'select-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Speed of slide interval in miliseconds','select-core')
            ]
        );
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'select-core'),
                'type' => \Elementor\Controls_Manager::MEDIA
            ]
        );
	
	    $repeater->add_control(
		    'title',
		    [
			    'label' => esc_html__( 'Title', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $repeater->add_control(
		    'title_tag',
		    [
			    'label' => esc_html__( 'Title Tag', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_title_tag(),
			    'default' => 'h4'
		    ]
	    );
	
	    $repeater->add_control(
		    'subtitle',
		    [
			    'label' => esc_html__( 'Subtitle', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $repeater->add_control(
		    'subtitle_tag',
		    [
			    'label' => esc_html__( 'Subtitle Tag', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_title_tag(),
			    'default' => 'h4'
		    ]
	    );
	    
	    $repeater->add_control(
		    'text',
		    [
			    'label' => esc_html__( 'Text', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $repeater->add_control(
		    'show_button',
		    [
			    'label' => esc_html__( 'Show Button', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array()
		    ]
	    );
	    
	    $repeater->add_control(
		    'button_size',
		    [
			    'label' => esc_html__( 'Button Size', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    ''          => esc_html__( 'Default', 'select-core'),
				    'small'     => esc_html__( 'Small', 'select-core'),
				    'medium'    => esc_html__( 'Medium', 'select-core'),
				    'large'     => esc_html__( 'Large', 'select-core'),
				    'big_large' => esc_html__( 'Extra Large', 'select-core'),
			    ],
			    'condition' => [
		            'show_button' => array('yes')
			    ]
		    ]
	    );
	
	    $repeater->add_control(
		    'button_type',
		    [
			    'label' => esc_html__( 'Button Type', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    ''         => esc_html__( 'Default', 'select-core'),
				    'outline'  => esc_html__( 'Outline', 'select-core'),
				    'solid'    => esc_html__( 'Solid', 'select-core')
			    ],
			    'condition' => [
				    'show_button' => array('yes')
			    ]
		    ]
	    );
	
	    $repeater->add_control(
		    'button_text',
		    [
			    'label' => esc_html__( 'Button Text', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__( 'Default text is "button"','select-core'),
			    'condition' => [
				    'show_button' => array('yes')
			    ]
		    ]
	    );
	
	    $repeater->add_control(
		    'button_link',
		    [
			    'label' => esc_html__( 'Button Link', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'condition' => [
				    'show_button' => array('yes')
			    ]
		    ]
	    );
	
	    $repeater->add_control(
		    'button_target',
		    [
			    'label' => esc_html__( 'Button Target', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_link_target_array(),
			    'condition' => [
				    'show_button' => array('yes')
			    ]
		    ]
	    );
	
	    $repeater->add_control(
		    'button_icon',
		    [
			    'label' => esc_html__( 'Show Button Icon', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'condition' => [
				    'show_button' => array('yes')
			    ]
		    ]
	    );
	
	    startit_qode_icon_collections()->getElementorParamsArray($repeater, array('button_icon' => array('yes')), '', true);
	    
	    $this->add_control(
            'slider_items',
            [
                'label' => esc_html__( 'Slider Items', 'select-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Slider Item'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $data_attr = $this->getDataParams($params);
	    
        ?>
	    
	    <div class="qodef-fullwidth-slider-holder">
		    <div class="qodef-fullwidth-slider-slides" <?php echo esc_attr($data_attr); ?> >
		        <?php
	
	                foreach ( $params['slider_items'] as $slider_item ){
		
		                $slider_item['button_parameters'] = $this->getButtonParameters($slider_item);
		                $slider_item['image'] = $this->getImageSrc($slider_item);
		                $slider_item['slide_holder_style'] = $this->getSlideHolderStyle($slider_item);
		                $process_item['icon'] = startit_qode_icon_collections()->getElementorIconFromIconPack( $slider_item );
		
		                echo qode_core_get_independent_shortcode_module_template_part('templates/fullwidth-slider-item-template', 'fullwidth-slider', '', $slider_item);
	                }
		        
		        ?>
		    </div>
	    </div>
	    
        <?php
    }
	
	private function getDataParams($params){
		$data_attr = '';
		if(!empty($params['interval'])){
			$data_attr .= ' data-interval ="' . $params['interval'] . '"';
		}
		
		return $data_attr;
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
		
		if($params['button_icon'] == 'yes') {
			$iconPackName = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
			
			$button_params_array['icon_pack'] = $params['icon_pack'];
			$button_params_array[$iconPackName] = $params[$iconPackName];
		}
		
		if(!empty($params['button_target'])) {
			$button_params_array['target'] = $params['button_target'];
		}
		
		if(!empty($params['button_text'])) {
			$button_params_array['text'] = $params['button_text'];
		}
		
		return $button_params_array;
	}
	
	private function getImageSrc($params) {
  
		if (!empty($params['image'])) {
			$image_src = $params['image']['url'];
		}
		
		return $image_src;
	}
	
	private function getSlideHolderStyle($params) {
		
		$slide_holder_style = array();
		
		if (is_numeric($params['image'])) {
			$slide_holder_style[] = 'background-image: url(' . wp_get_attachment_url($params['image']['id']) . ')';
		}
		else {
			$slide_holder_style[] = 'background-image: url(' . $params['image'] . ')';
		}
		
		return implode(';', $slide_holder_style);
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorFullwidthSlider() );