<?php

class StartitCoreElementorCarousel extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_carousel';
    }

    public function get_title() {
        return esc_html__( 'Select Carousel', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-carousel-slider';
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
		    'carousel',
		    [
			    'label' => esc_html__( 'Carousel Slider', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => qode_core_get_carousel_slider_array(),
			    'default' => ''
		    ]
	    );
	
	    $this->add_control(
		    'orderby',
		    [
			    'label' => esc_html__( "Order By", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    ''       =>  '',
				    'title'  => esc_html__( "Title", 'select-core' ),
				    'date'   => esc_html__( "Date", 'select-core' )
			    ],
			    'default' => 'title'
		    ]
	    );
	
	    $this->add_control(
		    'order',
		    [
			    'label' => esc_html__( "Order", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'ASC'  => esc_html__('ASC','select-core' ),
				    'DESC' => esc_html__('DESC','select-core' ),
			    ],
			    'default' => 'ASC'
		    ]
	    );
	
	    $this->add_control(
		    'number_of_items',
		    [
			    'label' => esc_html__( 'Number of items showing', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => array(
				    '3'  => '3',
				    '4'  => '4',
				    '5'  => '5',
				    '6'  => '6',
			    ),
			    'default' => '3'
		    ]
	    );
	
	    $this->add_control(
		    'image_animation',
		    [
			    'label' => esc_html__( 'Image Animation', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => array(
				    'image-change' => esc_html__( 'Image Change', 'select-core' ),
				    'image-zoom'   => esc_html__( 'Image Zoom', 'select-core' )
			    ),
			    'default' => 'image-zoom',
			    'description' => esc_html__( 'Note: Only on "Image Change" zoom image will be used', 'select-core' ),
		    ]
	    );
	
	    $this->add_control(
		    'show_navigation',
		    [
			    'label' => esc_html__( 'Show navigation?', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'yes'
		    ]
	    );
	    
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $params['carousel_data_attributes'] = $this->getCarouselDataAttributes($params);
	
	    $html = '';
	    $carousel_class = '';
	
	    if($params['show_navigation'] != '' && $params['show_navigation'] == 'yes') {
		    $carousel_class = 'with_navigation';
	    }
	
	    if ($params['carousel'] !== '') {
		
		    $html .= '<div class="qodef-carousel-holder ' . esc_attr($carousel_class) .' clearfix">';
		    $html .= '<div class="qodef-carousel" ' . startit_qode_get_inline_attrs($params['carousel_data_attributes']) . '>';
		
		    $args = array(
			    'post_type' => 'carousels',
			    'carousels_category' => $params['carousel'],
			    'orderby' => $params['orderby'],
			    'order' => $params['order'],
			    'posts_per_page' => '-1'
		    );
		
		    $query = new \WP_Query($args);
		
		    if ($query->have_posts()) {
			    while($query->have_posts()) {
				    $query->the_post();
				    $carousel_item = $this->getCarouselItemData(get_the_ID(), $params);
				    $html .= qode_core_get_shortcode_module_template_part('carousels', 'carousel-template', '', $carousel_item);
			    }
		    }
		
		    wp_reset_postdata();
		    
		    $html .= '</div>';
		    $html .= '</div>';
	    }
	    
	    echo startit_qode_get_module_part($html);
    }
	
	/**
	 * Return all data that carousel needs, images, titles, links, etc
	 *
	 * @param $params
	 * @return array
	 */
	private function getCarouselItemData($item_id, $params) {
		
		$carousel_item = array();
		
		if (get_post_meta($item_id, 'qodef_carousel_image', true) !== '') {
			$carousel_item['image'] = get_post_meta($item_id, 'qodef_carousel_image', true);
		} else {
			$carousel_item['image'] = '';
		}
		
		if ($params['image_animation'] == 'image-change' && get_post_meta($item_id, 'qodef_carousel_hover_image', true) !== '') {
			$carousel_item['hover_image'] = get_post_meta($item_id, 'qodef_carousel_hover_image', true);
			$carousel_item['hover_class'] = 'qodef-has-hover-image';
		} else {
			$carousel_item['hover_image'] = '';
			$carousel_item['hover_class'] = '';
		}
		
		if (get_post_meta($item_id, 'qodef_carousel_item_link', true) != '') {
			$carousel_item['link'] = get_post_meta($item_id, 'qodef_carousel_item_link', true);
		} else {
			$carousel_item['link'] = '';
		}
		
		if (get_post_meta($item_id, 'qodef_carousel_item_target', true) != '') {
			$carousel_item['target'] = get_post_meta($item_id, 'qodef_carousel_item_target', true);
		} else {
			$carousel_item['target'] = '_self';
		}
		
		$carousel_item['title'] = get_the_title();
		
		$carousel_item['carousel_image_classes'] = $this->getCarouselImageClasses($params);
		$carousel_item['hover_type'] = $this->getCarouselHoverType($params);
		
		return $carousel_item;
		
	}
	
	/**
	 * Return CSS classes for carousel image
	 *
	 * @param $params
	 * @return array
	 */
	private function getCarouselImageClasses($params) {
		
		$carousel_image_classes = array();
		if($params['image_animation'] !== '') {
			$carousel_image_classes[] = 'qodef-' . $params['image_animation'];
		}
		
		return implode(' ', $carousel_image_classes);
		
	}
	
	/**
	 * Return CSS classes for carousel image
	 *
	 * @param $params
	 * @return array
	 */
	private function getCarouselHoverType($params) {
		
		$type = '';
		if($params['image_animation'] !== '') {
			$type = $params['image_animation'];
		}
		
		return $type;
		
	}
	
	/**
	 * Return data attributes for carousel
	 *
	 * @param $params
	 * @return array
	 */
	private function getCarouselDataAttributes($params) {
		
		$carousel_data = array();
		
		if ($params['number_of_items'] !== '') {
			$carousel_data['data-items'] = $params['number_of_items'];
		}
		if ($params['show_navigation'] !== '') {
			$carousel_data['data-navigation'] = $params['show_navigation'];
		}
		
		return $carousel_data;
		
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorCarousel() );