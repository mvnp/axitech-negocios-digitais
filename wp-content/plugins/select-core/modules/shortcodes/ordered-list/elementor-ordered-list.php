<?php

class StartitCoreElementorOrderedList extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_list_ordered';
    }

    public function get_title() {
        return esc_html__( 'Select List - Ordered', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-ordered-list';
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
		    'content',
		    [
			    'label' => esc_html__( "Content", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::WYSIWYG,
			    'default' => '<ol><li>' . esc_html__( 'Lorem Ipsum', 'select-core' ) . '</li><li>' . esc_html__( 'Lorem Ipsum', 'select-core' ) . '</li><li>' . esc_html__( 'Lorem Ipsum', 'select-core' ) . '</li></ol>'

		    ]
	    );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
        ?>

		<div class= "qodef-ordered-list" ><?php echo do_shortcode($params['content']); ?></div>

		<?php
    }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorOrderedList() );