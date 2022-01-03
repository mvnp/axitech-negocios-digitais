<?php

class StartitCoreElementorImageWithText extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_image_with_text';
    }

    public function get_title() {
        return esc_html__( 'Image With Text', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-image-with-text';
    }

    public function get_categories() {
        return [ 'select' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'select-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'label'       => esc_html__( 'Custom CSS Class', 'select-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'select-core' )
            ]
        );

        $this->add_control(
            'image',
            [
                'label'       => esc_html__( 'Image', 'select-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Select image from media library', 'select-core' )
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'       => esc_html__( 'Image Size', 'select-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'select-core' ),
                'default'     => 'full'
            ]

        );

        $this->add_control(
            'link_one',
            [
                'label'     => esc_html__( 'Link One', 'select-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'link_one_text',
            [
                'label'     => esc_html__( 'Link One Text', 'select-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'link_one!' => ''
                ],
            ]
        );

        $this->add_control(
            'link_two',
            [
                'label'     => esc_html__( 'Link Two', 'select-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'link_two_text',
            [
                'label'     => esc_html__( 'Link Two Text', 'select-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'link_two!' => ''
                ],
            ]
        );

        $this->add_control(
            'custom_link_target',
            [
                'label'     => esc_html__( 'Link Target', 'select-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => startit_qode_get_link_target_array()
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'select-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__( 'Title Tag', 'select-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => startit_qode_get_title_tag( true ) ,
                'condition' => [
                    'title!' => ''
                ],
                'default'   => 'h5'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'select-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'title!' => ''
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        if ( ! empty( $params['image'] ) ) {
            $params['image'] = $params['image']['id'];
        }

        $params['holder_classes']     = $this->getHolderClasses( $params );
        $params['image']              = $this->getImage( $params );
        $params['image_size']         = $this->getImageSize( $params['image_size'] );
        $params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : '_self';
        $params['title_tag']          = ! empty( $params['title_tag'] ) ? $params['title_tag'] : 'h4';
        $params['title_styles']       = $this->getTitleStyles( $params );

        echo qode_core_get_independent_shortcode_module_template_part( 'templates/image-with-text', 'image-with-text', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

        return implode( ' ', $holderClasses );
    }

    private function getImage( $params ) {
        $image = array();

        if ( ! empty( $params['image'] ) ) {
            $id = $params['image'];

            $image['image_id'] = $id;
            $image_original    = wp_get_attachment_image_src( $id, 'full' );
            $image['url']      = $image_original[0];
            $image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
        }

        return $image;
    }

    private function getImageSize( $image_size ) {
        $image_size = trim( $image_size );
        //Find digits
        preg_match_all( '/\d+/', $image_size, $matches );
        if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
            return $image_size;
        } elseif ( ! empty( $matches[0] ) ) {
            return array(
                $matches[0][0],
                $matches[0][1]
            );
        } else {
            return 'thumbnail';
        }
    }

    private function getTitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['title_color'] ) ) {
            $styles[] = 'color: ' . $params['title_color'];
        }

        return implode( ';', $styles );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorImageWithText() );