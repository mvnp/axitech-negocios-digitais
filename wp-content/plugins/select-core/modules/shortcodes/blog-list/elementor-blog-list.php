<?php

class StartitCoreElementorBlogList extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_blog_list';
    }

    public function get_title() {
        return esc_html__( 'Select Blog List', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-blog-slider';
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
            'type',
            [
                'label' => esc_html__( "Type", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                "description" => esc_html__( "Default type is Carousel", 'select-core' ),
                'options' => [
                    'boxes'         => esc_html__( 'Boxes', 'select-core' ),
                    'masonry'       => esc_html__( 'Masonry', 'select-core' ),
                    'minimal'       => esc_html__( 'Minimal', 'select-core' ),
                    'image_in_box'  => esc_html__( 'Image in box', 'select-core' )
                ],
                'default' => 'boxes'
            ]
        );
	
	    $this->add_control(
		    'number_of_posts',
		    [
			    'label' => esc_html__( "Number of Posts", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => ''
		    ]
	    );
	
	    $this->add_control(
		    'number_of_columns',
		    [
			    'label' => esc_html__( "Number of Columns", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    "1" => esc_html__("One",'select-core'),
				    "2" => esc_html__("Two",'select-core'),
				    "3" => esc_html__("Three",'select-core'),
				    "4" => esc_html__("Four",'select-core')
			    ],
			    'condition' => [
				    'type' => array('boxes')
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'order_by',
		    [
			    'label' => esc_html__( "Order By", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'title' => esc_html__( 'Title', 'select-core' ),
				    'date' => esc_html__( 'Date', 'select-core' ),
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
				    'ASC' => esc_html__( 'ASC', 'select-core' ),
				    'DESC' => esc_html__( 'DESC', 'select-core' ),
			    ],
			    'default' => 'ASC'
		    ]
	    );
	
	    $this->add_control(
		    'category',
		    [
			    'label' => esc_html__( "Category Slug", 'select-core' ),
			    "description" => esc_html__( "Leave empty for all or use comma for list", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
		    ]
	    );
	
	    $this->add_control(
		    'image_size',
		    [
			    'label' => esc_html__( "Image Size", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'original'  => esc_html__( 'Original', 'select-core' ),
				    'landscape' => esc_html__( 'Landscape', 'select-core' ),
				    'square'    => esc_html__( 'Square', 'select-core' )
			    ],
			    'default' => 'original',
			    'condition' => [
				    'type' => array('boxes')
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'text_length',
		    [
			    'label' => esc_html__( "Text length", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => 'Number of characters'
		    ]
	    );
	
	    $this->add_control(
		    'title_tag',
		    [
			    'label' => esc_html__( "Title Tag", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_title_tag(),
			    'default' => 'h4'
		    ]
	    );
	    
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	
	    $params['holder_classes'] = $this->getBlogHolderClasses($params);
	
	    $queryArray = $this->generateBlogQueryArray($params);
	    $query_result = new \WP_Query($queryArray);
	    $params['query_result'] = $query_result;
	
	
	    $thumbImageSize = $this->generateImageSize($params);
	    $params['thumb_image_size'] = $thumbImageSize;
	    
	    echo qode_core_get_independent_shortcode_module_template_part('templates/blog-list-holder', 'blog-list', '', $params);
    }
	
	/**
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getBlogHolderClasses($params){
		$holderClasses = '';
		
		$columnNumber = $this->getColumnNumberClass($params);
		
		if(!empty($params['type'])){
			switch($params['type']){
				case 'image_in_box':
					$holderClasses = 'qodef-image-in-box';
					break;
				case 'boxes' :
					$holderClasses = 'qodef-boxes';
					break;
				case 'masonry' :
					$holderClasses = 'qodef-masonry';
					break;
				case 'minimal' :
					$holderClasses = 'qodef-minimal';
					break;
				default:
					$holderClasses = 'qodef-boxes';
			}
		}
		
		$holderClasses .= ' '.$columnNumber;
		
		return $holderClasses;
		
	}
	
	/**
	 * Generates column classes for boxes type
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getColumnNumberClass($params){
		
		$columnsNumber = '';
		$type = $params['type'];
		$columns = $params['number_of_columns'];
		
		if ($type == 'boxes') {
			switch ($columns) {
				case 1:
					$columnsNumber = 'qodef-one-column';
					break;
				case 2:
					$columnsNumber = 'qodef-two-columns';
					break;
				case 3:
					$columnsNumber = 'qodef-three-columns';
					break;
				case 4:
					$columnsNumber = 'qodef-four-columns';
					break;
				default:
					$columnsNumber = 'qodef-one-column';
					break;
			}
		}
		return $columnsNumber;
	}
	
	/**
	 * Generates query array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function generateBlogQueryArray($params){
		
		$queryArray = array(
			'orderby' => $params['order_by'],
			'order' => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'category_name' => $params['category']
		);
		return $queryArray;
	}
	
	/**
	 * Generates image size option
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function generateImageSize($params){
		$thumbImageSize = '';
		$imageSize = $params['image_size'];
		
		if ($imageSize !== '' && $imageSize == 'landscape') {
			$thumbImageSize .= 'qode_startit_landscape';
		} else if($imageSize === 'square'){
			$thumbImageSize .= 'qode_startit_square';
		} else if ($imageSize !== '' && $imageSize == 'original') {
			$thumbImageSize .= 'full';
		}
		return $thumbImageSize;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorBlogList() );