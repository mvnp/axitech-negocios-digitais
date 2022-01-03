<?php

class StartitCoreElementorUnorderedList extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_unordered_list';
    }

    public function get_title() {
        return esc_html__( 'Select List - Unordered', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-unordered-list';
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
		    'style',
		    [
			    'label' => esc_html__( 'Style', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => array(
				    'circle'  => esc_html__( 'Circle', 'select-core' ),
				    'line'    => esc_html__( 'Line', 'select-core' )
			    ),
			    'default' => 'circle'
		    ]
	    );
	    
	    $this->add_control(
		    'animate',
		    [
			    'label' => esc_html__( 'Animate List', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'no'
		    ]
	    );

	    $this->add_control(
		    'font_weight',
		    [
			    'label' => esc_html__( 'Font Weight', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => array(
				    ''          => esc_html__( 'Default', 'select-core' ),
				    'light'     => esc_html__( 'Light', 'select-core' ),
				    'normal'    => esc_html__( 'Normal', 'select-core' ),
				    'bold'      => esc_html__( 'Bold', 'select-core' )
			    )
		    ]
	    );
	
	    $this->add_control(
		    'padding_left',
		    [
			    'label' => esc_html__( 'Padding left (px)', 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );

	    $this->add_control(
		    'content',
		    [
			    'label' => esc_html__( "Content", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::WYSIWYG,
			    'default' => '<ul><li>' . esc_html__( 'Lorem Ipsum', 'select-core' ) . '</li><li>' . esc_html__( 'Lorem Ipsum', 'select-core' ) . '</li><li>' . esc_html__( 'Lorem Ipsum', 'select-core' ) . '</li></ul>'

		    ]
	    );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $list_item_classes = "";
	
	    if ($params['style'] != '') {
		    if($params['style'] == 'circle'){
			    $list_item_classes .= ' qodef-circle';
		    }elseif ($params['style'] == 'line') {
			    $list_item_classes .= ' qodef-line';
		    }
	    }
	
	    if ($params['animate'] == 'yes') {
		    $list_item_classes .= ' qodef-animate-list';
	    }
	
	    $list_style = '';
	    if($params['padding_left'] != '') {
		    $list_style .= 'padding-left: ' . $params['padding_left'] .'px;';
	    }
	
	    ?>
	
	    <div class="qodef-unordered-list <?php echo $list_item_classes; ?>" <?php echo startit_qode_get_inline_style($list_style); ?>>
		    <?php echo do_shortcode($params['content']); ?>
	    </div>
	
	    <?php
    
    }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorUnorderedList() );