<?php

class StartitCoreElementorTestimonials extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_testimonials';
    }

    public function get_title() {
        return esc_html__( 'Testimonials', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-testimonials';
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
		    'layout',
		    [
			    'label' => esc_html__( 'Layout', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => array(
				    'cards_carousel'     => esc_html__( 'Cards Carousel', 'select-core' ),
				    'standard_carousel'  => esc_html__( 'Standard Carousel', 'select-core' )
			    ),
			    'default' => 'cards_carousel'
		    ]
	    );
	
	    $this->add_control(
		    'category',
		    [
			    'label' => esc_html__( 'Category', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__('Category Slug (leave empty for all)', 'select-core')
		    ]
	    );
	
	    $this->add_control(
		    'number',
		    [
			    'label' => esc_html__( 'Number', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__('Number of Testimonials', 'select-core')
		    ]
	    );
	    
	    $this->add_control(
		    'type',
		    [
			    'label' => esc_html__( 'Type', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => array(
				    'transparent'  => esc_html__( 'Transparent', 'select-core' ),
				    'filled'       => esc_html__( 'Filled', 'select-core' ),
				    'dark'         => esc_html__( 'Dark', 'select-core' )
			    ),
			    'default' => 'transparent',
			    'condition' => [
			    	'layout' => array('cards_carousel')
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'show_title',
		    [
			    'label' => esc_html__( 'Show Title', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'yes',
		    ]
	    );

	    $this->add_control(
		    'show_author',
		    [
			    'label' => esc_html__( 'Show Author', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'yes',
		    ]
	    );
	
	    $this->add_control(
		    'show_position',
		    [
			    'label' => esc_html__( 'Show Author Job Position', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'yes',
			    'condition' => [
			    	'show_author' => array('yes')
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'animation_speed',
		    [
			    'label' => esc_html__( 'Animation speed', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__( 'Speed of slide animation in miliseconds', 'select-core' )
		    ]
	    );
	    
	    $this->add_control(
		    'show_navigation_arrows',
		    [
			    'label' => esc_html__( 'Show Navigation Arrows', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'yes',
			    'condition' => [
				    'layout' => array('cards_carousel')
			    ]
		    ]
	    );
	    
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $data_attr = $this->getDataParams($params);
	    $query_args = $this->getQueryParams($params);
	
	    $testimonial_classes = array();
	    $testimonial_classes[] = $params['type'];
	    $testimonial_classes[] = $params['layout'];
	    $testimonial_classes =  implode(' ', $testimonial_classes);
	
	    $html = '';
	    $html .= '<div class="qodef-testimonials-holder qodef-grid-section clearfix">';
	    if($params['layout'] == 'cards_carousel') {
		    $html .= '<div class="qodef-testimonials qodef-section-inner ' . $testimonial_classes . '" ' . $data_attr . '>';
	    }
	    else if($params['layout'] == 'standard_carousel') {
		    $html .= '<div class="qodef-testimonials ' . $testimonial_classes . '" ' . $data_attr . '>';
	    }
	    $i = 0;
	    $opened = false;
	    query_posts($query_args);
	    if (have_posts()) :
		    while (have_posts()) : the_post();
			    $i++;
			    $author = get_post_meta(get_the_ID(), 'qodef_testimonial_author', true);
			    $text = get_post_meta(get_the_ID(), 'qodef_testimonial_text', true);
			    $title = get_post_meta(get_the_ID(), 'qodef_testimonial_title', true);
			    $job = get_post_meta(get_the_ID(), 'qodef_testimonial_author_position', true);
			
			    $params['author'] = $author;
			    $params['text'] = $text;
			    $params['title'] = $title;
			    $params['job'] = $job;
			    $params['current_id'] = get_the_ID();
			    if($params['layout'] == 'cards_carousel') {
				    if($i%3 == 1){
					    $html .= '<div class="qodef-testimonials-slider-item">';
					    $opened = true;
				    }
				
				    $html .= qode_core_get_shortcode_module_template_part('testimonials','testimonials-template', 'cards', $params);
				
				    if($i%3 == 0) {
					    $html .= '</div>';
					    $opened = false;
				    }
			    }
			    else if($params['layout'] == 'standard_carousel') {
				    $html .= '<div class="qodef-testimonials-slider-item">';
				    $html .= qode_core_get_shortcode_module_template_part('testimonials','testimonials-template', 'standard', $params);
				    $html .= '</div>';
			    }
		
		    endwhile;
	    else:
		    $html .= __('Sorry, no posts matched your criteria.', 'select-core');
	    endif;
	
	    wp_reset_query();
	    if($opened && $params['layout'] == 'cards_carousel') {
		    $html .= '</div>';
	    }
	    $html .= '</div>';
	    if($params['layout'] == 'cards_carousel' && $params['show_navigation_arrows'] == 'yes') {
		    $html .= '<div class="owl-buttons">';
		    $html .= '<div class="owl-prev"><span class="qodef-prev-icon"><i class="fa fa-chevron-left"></i></span></div>';
		    $html .= '<div class="owl-next"><span class="qodef-next-icon"><i class="fa fa-chevron-right"></i></span></div>';
		    $html .= '</div>';
	    }
	    $html .= '</div>';
	
	    echo startit_qode_get_module_part($html);
    }
	
	/**
	 * Generates testimonial data attribute array
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getDataParams($params){
		$data_attr = '';
		
		if(!empty($params['animation_speed'])){
			$data_attr .= ' data-animation-speed ="' . $params['animation_speed'] . '"';
		}
		
		if(!empty($params['layout'])){
			$data_attr .= ' data-layout ="' . $params['layout'] . '"';
		}
		
		return $data_attr;
	}
	/**
	 * Generates testimonials query attribute array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getQueryParams($params){
		
		$args = array(
			'post_type' => 'testimonials',
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => $params['number']
		);
		
		if ($params['category'] != '') {
			$args['testimonials_category'] = $params['category'];
		}
		return $args;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorTestimonials() );