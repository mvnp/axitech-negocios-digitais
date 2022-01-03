<?php

class StartitCoreElementorParticles extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_particles';
    }

    public function get_title() {
        return esc_html__( 'Particles', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-particles';
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
		    'type',
		    [
			    'label' => esc_html__('Type', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'auto'       => esc_html__('Adapt to Content Height', 'select-core'),
				    'fixed'      => esc_html__('Fixed Height (px)', 'select-core'),
				    'fullscreen' => esc_html__('Full Screen Height', 'select-core')
			    ],
			    "description" => esc_html__("Choose the behavior of the particles container.",'select-core'),
			    'default' => 'auto'
		    ]
	    );
     
        
	    $this->add_control(
		    'height',
		    [
			    'label' => esc_html__('Height (px)', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'condition' => [
		            'type' => array('fixed')
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'bgnd_color',
		    [
			    'label' => esc_html__('Background Color', 'select-core'),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'bgnd_image',
		    [
			    'label' => esc_html__('Background Image', 'select-core'),
			    'type' => \Elementor\Controls_Manager::MEDIA
		    ]
	    );
	
	    $this->add_control(
		    'particles_density',
		    [
			    'label' => esc_html__('Particles Density', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'low'    => esc_html__('Low', 'select-core'),
				    'medium' => esc_html__('Medium', 'select-core'),
				    'high'   => esc_html__('High', 'select-core')
			    ],
			    "description" => esc_html__("High density means more particles on the screen.", 'select-core'),
			    'default' => 'accordion'
		    ]
	    );
	
	    $this->add_control(
		    'particles_color',
		    [
			    'label' => esc_html__('Particles Color', 'select-core'),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'particles_opacity',
		    [
			    'label' => esc_html__('Particles Opacity (0-1)', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'particles_size',
		    [
			    'label' => esc_html__('Particles Size (1-100)', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'speed',
		    [
			    'label' => esc_html__('Particles Speed (0 - 10)', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__('Enter "0" to freeze particles.','select-core'),
			    'default' => '5'
		    ]
	    );
	
	    $this->add_control(
		    'show_lines',
		    [
			    'label' => esc_html__('Connect particles with lines', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SWITCHER,
		    ]
	    );
	
	    $this->add_control(
		    'line_length',
		    [
			    'label' => esc_html__('Maximum Line Length (px)', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => '100',
			    'condition' => [
			    	'show_lines' => array('yes')
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'hover',
		    [
			    'label' => esc_html__('Hover Effect', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SWITCHER,
		    ]
	    );
	
	    $this->add_control(
		    'click',
		    [
			    'label' => esc_html__('Click Effect', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SWITCHER,
		    ]
	    );
	    
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'width',
            [
                'label' => esc_html__( 'Width of the Content (%)', 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                "description" => esc_html__("Width in percentage of the Particles width. Leave empty to make the width automatic.",'select-core' ),

            ]
        );
	
	    $repeater->add_control(
		    'margin_top',
		    [
			    'label' => esc_html__( 'Margin Top', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    "description" => esc_html__("Top margin for the content in px or %. Does not have effect if Particles type is set to Full Screen or Fixed Height.",'select-core' ),
		    ]
	    );
	
	    $repeater->add_control(
		    'margin_bottom',
		    [
			    'label' => esc_html__( 'Margin Bottom', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    "description" => esc_html__("Bottom margin for the content in px or %. Does not have effect if Particles type is set to Full Screen or Fixed Height.",'select-core' ),
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
            'particles_content',
            [
                'label' => esc_html__( 'Particles Content', 'select-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Particles Content Item'),
            ]
        );


        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $the_image = wp_get_attachment_image_src($params['bgnd_image']['id'],'full');
	
	    $data_string = ' '.
	                   (!empty($params['particles_density']) ? 'data-particles-density='.$params['particles_density'].' ' : '') .
	                   (!empty($params['particles_color']) ? 'data-particles-color='.$params['particles_color'].' ' : '') .
	                   (!empty($params['particles_opacity']) ? 'data-particles-opacity='.$params['particles_opacity'].' ' : '') .
	                   (!empty($params['particles_size']) ? 'data-particles-size='.$params['particles_size'].' ' : '') .
	                   //(!empty($enable_movement) ? 'data-enable-movement="'.$enable_movement.'" ' : '') .
	                   (!empty($params['speed']) ? 'data-speed='.$params['speed'].' ' : '') .
	                   (!empty($params['show_lines']) ? 'data-show-lines='.$params['show_lines'].' ' : '') .
	                   (!empty($params['line_length']) ? 'data-line-length='.$params['line_length'].' ' : '') .
	                   (!empty($params['hover']) ? 'data-hover='.$params['hover'].' ' : '') .
	                   (!empty($params['click']) ? 'data-click='.$params['click'].' ' : '') .
	                   '';
		$bg_image = isset($the_image[0]) ? $the_image[0] : '';
	    $style_string = ' style="'.
	                    ($params['type'] == 'fixed' && !empty($params['height']) ? 'height: '.(int)$params['height'].'px;' : '') .
	                    (!empty($params['bgnd_color']) ? 'background-color: '.$params['bgnd_color'].';' : '') .
	                    (!empty($params['bgnd_image']) ? 'background-image: url('. $bg_image .');' : '') .
	                    '"';
	    
        
        ?>
	    
	    <div id="qodef-particles" class="<?php echo esc_attr($params['type']); ?>" <?php echo wp_kses_post($style_string); echo esc_attr($data_string); ?>>
	        <div id="qodef-p-particles-container"></div>
            <?php foreach ( $params['particles_content'] as $part_content ) : ?>
	            <div class="qodef-p-content" <?php if(!empty($part_content['width'])) { ?> data-width="<?php echo esc_attr((int)$part_content['width']); } ?>"  <?php if(!empty($part_content['margin_top'])) { ?> data-margin-top="<?php echo esc_attr($part_content['margin_top']); } ?>" <?php if(!empty($part_content['margin_bottom'])) { ?> data-margin-bottom="<?php echo esc_attr($part_content['margin_bottom']); } ?>">
		            <?php
			            if( empty( $part_content['content'] ) ){
				            $part_content['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $part_content['template_id'] );
			            };
			            
			            echo startit_qode_get_module_part($part_content['content']);
		            ?>
	            </div>
             <?php endforeach; ?>
	    </div>

        <?php
    }
	

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorParticles() );