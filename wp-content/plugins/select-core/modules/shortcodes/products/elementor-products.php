<?php

class StartitCoreElementorProducts extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_products';
    }

    public function get_title() {
        return esc_html__( 'Products', 'select-core' );
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
		    'columns',
		    [
			    'label' => esc_html__('Columns', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
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
	
	    $this->add_control(
		    'product_ids',
		    [
			    'label' => esc_html__('Products', 'select-core'),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'description' => esc_html__('Enter List of Products (delimit items by comma)', 'select-core'),
			    'default' => ''
		    ]
	    );
	    
        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
        
	    $products_params['columns'] = isset( $params['columns'] ) && ! empty( $params['columns'] ) ? $params['columns'] : 4;
	    $products_params['orderby'] = isset( $params['order_by'] ) && ! empty( $params['order_by'] ) ? $params['order_by'] : 'date';
	    $products_params['order'] = isset( $params['sort_order'] ) && ! empty( $params['sort_order'] ) ? $params['sort_order'] : 'DESC';
	    $products_params['ids']   = isset( $params['product_ids'] ) && ! empty( $params['product_ids'] ) ? $params['product_ids'] : '';
	
	    $paramsString = '';
	    foreach ($products_params as $Key => $Value) {
		    $paramsString .= $Key . '="' . $Value . '" ';
	    }
	    
	    echo do_shortcode( "[products $paramsString]" );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorProducts() );