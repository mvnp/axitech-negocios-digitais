<?php

class StartitCoreElementorClients extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_clients';
    }

    public function get_title() {
        return esc_html__( 'Clients', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-clients';
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
            'columns',
            [
                'label' => esc_html__( 'Columns', 'select-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'two-columns'   => esc_html__('Two', 'select-core'),
                    'three-columns' => esc_html__('Three', 'select-core'),
                    'four-columns'  => esc_html__('Four', 'select-core'),
                    'five-columns'  => esc_html__('Five', 'select-core'),
                    'six-columns'   => esc_html__('Six', 'select-core'),
                ],
                'default' => 'four-columns'
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
            'hover_image',
            [
                'label' => esc_html__('Hover Image', 'select-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'image!' => ''
                ]
            ]
        );
	
	    $repeater->add_control(
		    'hover_type',
		    [
			    'label' => esc_html__( 'Hover Type', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
		            'fade'      => esc_html__( 'Fade', 'select-core'),
		            'roll-over' => esc_html__( 'Roll Over', 'select-core')
			    ]
		    ]
	    );
	    
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'select-core'),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'link_target',
            [
                'label' => esc_html__( 'Link Target', 'select-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => startit_qode_get_link_target_array(),
                'default' => '_self'
            ]
        );
	
	    $repeater->add_control(
		    'margin_bottom',
		    [
			    'label' => esc_html__( 'Margin Bottom', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );

        $this->add_control(
            'clients',
            [
                'label' => esc_html__( 'Client Items', 'select-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Client Item'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
        
        ?>
	
	    <div class="qodef-clients clearfix qodef-clients-<?php echo esc_attr($params['columns']); ?>">
		    <?php
		
		    foreach ( $params['clients'] as $client ){
			
			    if( ! empty( $client['image'] ) ){
				    $client['image'] = wp_get_attachment_url($client['image']['id']);
				    $client['image_alt'] = esc_attr(get_post_meta(attachment_url_to_postid($client['image']), '_wp_attachment_image_alt', true));
			    }
			
			    if( ! empty( $client['hover_image'] ) ){
				    $client['hover_image'] = wp_get_attachment_url($client['hover_image']['id']);
				    $client['hover_image_alt'] = esc_attr(get_post_meta(attachment_url_to_postid($client['hover_image']), '_wp_attachment_image_alt', true));
			    }
			    
			    if($client['hover_type'] !== '') {
				    $client['class'] = 'qodef-clients-' . $client['hover_type'];
			    } else {
				    $client['class'] = 'qodef-hover-opacity';
			    }
			
			    if($client['link_target'] == ''){
				    $client['link_target'] = '_self';
			    }
			    
			    $client['client_styles'] = $this->getClientStyles($client);
			
			    echo qode_core_get_independent_shortcode_module_template_part('templates/client-template', 'clients', '', $client);
		    }
		
		    ?>
	    </div>
	    
        <?php
    }
	
	private function getClientStyles($params) {
		$clientStyles = array();
		
		if ($params['margin_bottom'] !== '') {
			$clientStyles[] = 'margin-bottom: ' . $params['margin_bottom'] . 'px';
		}
		
		return implode(';', $clientStyles);
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorClients() );