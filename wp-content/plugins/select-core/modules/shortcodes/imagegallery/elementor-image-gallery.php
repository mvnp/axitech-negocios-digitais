<?php

class StartitCoreElementorImageGallery extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_image_gallery';
    }

    public function get_title() {
        return esc_html__( "Select Image Gallery", 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-image-gallery';
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
		    'images',
		    [
			    'label' => esc_html__( "Images", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::GALLERY,
			    'description'	=> 'Select images from media library'
		    ]
	    );
	
	    $this->add_control(
		    'image_size',
		    [
			    'label' => esc_html__( "Image Size", 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description'	=> 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size'
		    ]
	    );
	
	    $this->add_control(
		    'type',
		    [
			    'label' => esc_html__( "Gallery Type", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'slider'     => esc_html__( 'Slider', 'select-core' ),
				    'image_grid' => esc_html__( 'Image Grid', 'select-core' )
			    ],
			    'default' => 'slider'
		    ]
	    );
	
	    $this->add_control(
		    'image_frame',
		    [
			    'label' => esc_html__( "Image Frame", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'no',
			    'description' => 'Adds frame around image slider',
			    'condition' => [
			    	'type' => 'slider'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'image_space',
		    [
			    'label' => esc_html__( "Image Space", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'no',
			    'condition' => [
				    'type' => 'image_grid'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'autoplay',
		    [
			    'label' => esc_html__( "Slide duration", 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    '3'		  => '3',
				    '5'		  => '5',
				    '10'      => '10',
				    'disable' => esc_html__('Disable', 'select-core'),
			    ],
			    'default' => '5',
			    'description' => 'Auto rotate slides each X seconds',
			    'condition' => [
				    'type' => 'slider'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'slide_animation',
		    [
			    'label' => esc_html__( "Slide Animation", 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'slide'     => esc_html__('Slide', 'select-core'),
				    'fade'      => esc_html__('Fade', 'select-core'),
				    'fadeUp'    => esc_html__('Fade Up', 'select-core'),
				    'backSlide' => esc_html__('Back Slide', 'select-core'),
				    'goDown'    => esc_html__('Go Down', 'select-core')
			    ],
			    'default' => 'slide',
			    'condition' => [
				    'type' => 'slider'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'column_number',
		    [
			    'label' => esc_html__( 'Column Number', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    '2' => '2',
				    '3' => '3',
				    '4' => '4',
				    '5' => '5',
			    ],
			    'default' => '3',
			    'condition' => [
				    'type' => 'image_grid'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'pretty_photo',
		    [
			    'label' => esc_html__( "Open PrettyPhoto on click", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array()
		    ]
	    );
	
	    $this->add_control(
		    'grayscale',
		    [
			    'label' => esc_html__( 'Grayscale Images', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'no',
			    'condition' => [
				    'type' => 'image_grid'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'navigation',
		    [
			    'label' => esc_html__( "Show Navigation Arrows", 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'yes',
			    'condition' => [
				    'type' => 'slider'
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'pagination',
		    [
			    'label' => esc_html__( "Show Pagination", 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'yes',
			    'condition' => [
				    'type' => 'slider'
			    ]
		    ]
	    );
	    
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $params['slider_data'] = $this->getSliderData($params);
	    $params['image_size'] = $this->getImageSize($params['image_size']);
	    $params['images'] = $this->getGalleryImages($params);
	    $params['pretty_photo'] = ($params['pretty_photo'] == 'yes') ? true : false;
	    $params['columns'] = 'qodef-gallery-columns-' . $params['column_number'];
	    $params['gallery_classes'] = ($params['grayscale'] == 'yes') ? 'qodef-grayscale' : '';
	    $params['gallery_classes'] = ($params['image_space'] == 'no') ? 'qodef-no-space' : '';
	    $params['slider_gallery_classes'] = $this->getGalleryClasses($params);
	
	    if ($params['type'] == 'image_grid') {
		    $template = 'gallery-grid';
	    } elseif ($params['type'] == 'slider') {
		    $template = 'gallery-slider';
	    }
	
	    echo qode_core_get_independent_shortcode_module_template_part('templates/' . $template, 'imagegallery', '', $params);
    }
	
	/**
	 * Return images for gallery
	 *
	 * @param $params
	 * @return array
	 */
	private function getGalleryImages($params) {
		
		$images = array();
		
		if ($params['images'] !== '') {

			$size = $params['image_size'];

			foreach ($params['images'] as $image) {

				$img = wp_get_attachment_image_src($image['id'], $size);

				$image['url'] = $img[0];
				$image['width'] = $img[1];
				$image['height'] = $img[2];
				$image['title'] = get_the_title($image['id']);

				$images[] = $image;
			}
		}
		
		return $images;
		
	}
	
	/**
	 * Return image size or custom image size array
	 *
	 * @param $image_size
	 * @return array
	 */
	private function getImageSize($image_size) {
		
		//Remove whitespaces
		$image_size = trim($image_size);
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( !empty($matches[0]) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} elseif ( in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full') )) {
			return $image_size;
		} else {
			return 'thumbnail';
		}
		
	}
	
	/**
	 * Return all configuration data for slider
	 *
	 * @param $params
	 * @return array
	 */
	private function getSliderData($params) {
		
		$slider_data = array();
		
		$slider_data['data-autoplay'] = ($params['autoplay'] !== '') ? $params['autoplay'] : '';
		$slider_data['data-animation'] = ($params['slide_animation'] !== '') ? $params['slide_animation'] : '';
		$slider_data['data-navigation'] = ($params['navigation'] !== '') ? $params['navigation'] : '';
		$slider_data['data-pagination'] = ($params['pagination'] !== '') ? $params['pagination'] : '';
		
		return $slider_data;
		
	}
	
	/**
	 * Return classes for gallery
	 *
	 * @param $params
	 * @return string
	 */
	private function getGalleryClasses($params) {
		
		$classes = '';
		
		
		
		if ($params['image_frame'] == 'yes') {
			
			$classes .= ' qodef-image-frame qodef-frame-5';
		}
		
		return $classes;
		
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorImageGallery() );