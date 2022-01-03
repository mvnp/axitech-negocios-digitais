<?php

class StartitCoreElementorRecentProducts extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_recent_products';
    }

    public function get_title() {
        return esc_html__( 'Recent Products', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-product-list';
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
            'per_page',
            [
                'label' => esc_html__('Per Page', 'select-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('The "per_page" shortcode determines how many products to show on the page', 'select-core'),
                'default' => '12'
            ]
        );
	
	    $this->add_control(
		    'columns',
		    [
			    'label' => esc_html__('Columns', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__('The columns attribute controls how many columns wide the products should be before wrapping.', 'select-core'),
			    'default' => '4'
		    ]
	    );
	
	    $this->add_control(
		    'order_by',
		    [
			    'label' => esc_html__('Order by', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'date'             => esc_html__( 'Date', 'select-core' ),
				    'ID'               => esc_html__( 'ID', 'select-core' ),
				    'author'           => esc_html__( 'Author', 'select-core' ),
				    'title'            => esc_html__( 'Title', 'select-core' ),
				    'modified'         => esc_html__( 'Modified', 'select-core' ),
				    'rand'             => esc_html__( 'Random', 'select-core' ),
				    'comment_count'    => esc_html__( 'Comment count', 'select-core' ),
				    'menu_order'       => esc_html__( 'Menu order', 'select-core' ),
				    'menu_order title' => esc_html__( 'Menu order & title', 'select-core' ),
				    'include'          => esc_html__( 'Include', 'select-core' ),
			    ],
			    'default' => 'date',
			    'description' => esc_html__('Select how to sort retrieved products', 'select-core'),
		    ]
	    );
	
	    $this->add_control(
		    'sort_order',
		    [
			    'label' => esc_html__('Sort order', 'select-core'),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'DESC' => esc_html__( 'Descending', 'select-core' ),
				    'ASC'  => esc_html__( 'Ascending', 'select-core' ),
			    ],
			    'description' => esc_html__('Designates the ascending or descending order', 'select-core'),
		    ]
	    );
	    
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
        
	    $recent_products_params['per_page'] = isset( $params['per_page'] ) && ! empty( $params['per_page'] ) ? $params['per_page'] : 12;
	    $recent_products_params['columns'] = isset( $params['columns'] ) && ! empty( $params['columns'] ) ? $params['columns'] : 4;
	    $recent_products_params['orderby'] = isset( $params['order_by'] ) && ! empty( $params['order_by'] ) ? $params['order_by'] : 'date';
	    $recent_products_params['order'] = isset( $params['sort_order'] ) && ! empty( $params['sort_order'] ) ? $params['sort_order'] : 'DESC';
	
	    $paramsString = '';
	    foreach ($recent_products_params as $Key => $Value) {
		    $paramsString .= $Key . '="' . $Value . '" ';
	    }
	    
	    echo do_shortcode( "[recent_products $paramsString]" );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorRecentProducts() );