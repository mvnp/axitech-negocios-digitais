<?php

class StartitCoreElementorSearch extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_search';
    }

    public function get_title() {
        return esc_html__( 'Search', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-search';
    }

    public function get_categories() {
        return [ 'select' ];
    }

    protected function _register_controls(){
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'select-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'label' => esc_html__('Custom CSS Class', 'select-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS', 'select-core'),
                'default' => ''
            ]
        );

        $this->add_control(
            'enable_live_search',
            [
                'label' => esc_html__('Enable Live Search', 'select-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => startit_qode_get_yes_no_select_array(),
                'default' => 'no'
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){

        $params = $this->get_settings_for_display();
        $output = '';

        $output = '<div class="wp_search ' . esc_attr( $params['custom_class'] ) . (($params['enable_live_search'] === 'yes') ? ' qodef-search-element qodef-live-search-enabled' : ' qodef-search-element') . '">';
        $type = 'WP_Widget_Search';
        $args = array();
        global $wp_widget_factory, $use_live_search;
// to avoid unwanted warnings let's check before using widget
        if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
            ob_start();
            if ($params['enable_live_search'] === 'yes') {
                $use_live_search = true;
            }
            the_widget( $type, '', $args );
            $output .= ob_get_clean();
            $use_live_search = false;

            $output .= '</div>';

            echo startit_qode_get_module_part($output);
        } else {
            echo startit_qode_get_module_part($this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : wp_search' ));
        }
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorSearch() );