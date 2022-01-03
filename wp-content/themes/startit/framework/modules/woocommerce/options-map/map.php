<?php

if ( ! function_exists( 'startit_qode_woocommerce_options_map' ) ) {

	/**
	 * Add Woocommerce options page
	 */
	function startit_qode_woocommerce_options_map() {

		startit_qode_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'startit' ),
				'icon' => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = startit_qode_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'startit' )
			)
		);

		startit_qode_add_admin_field(array(
			'name'        	=> 'qodef_woo_products_list_full_width',
			'type'        	=> 'yesno',
			'label' => esc_html__( 'Enable Full Width Template', 'startit' ),
			'default_value'	=> 'no',
			'description' => esc_html__( 'Enabling this option will enable full width template for shop page', 'startit' ),
			'parent'      	=> $panel_product_list,
		));

		startit_qode_add_admin_field(array(
			'name'        	=> 'qodef_woo_product_list_columns',
			'type'        	=> 'select',
			'label' => esc_html__( 'Product List Columns', 'startit' ),
			'default_value'	=> 'qodef-woocommerce-columns-3',
			'description' => esc_html__( 'Choose number of columns for product listing and related products on single product', 'startit' ),
			'options'		=> array(
				'qodef-woocommerce-columns-3' => esc_html__('3 Columns (2 with sidebar)','startit'),
				'qodef-woocommerce-columns-4' => esc_html__('4 Columns (3 with sidebar)','startit')
			),
			'parent'      	=> $panel_product_list,
		));

		startit_qode_add_admin_field(array(
			'name'        	=> 'qodef_woo_products_per_page',
			'type'        	=> 'text',
			'label' => esc_html__( 'Number of products per page', 'startit' ),
			'default_value'	=> '',
			'description' => esc_html__( 'Set number of products on shop page', 'startit' ),
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		startit_qode_add_admin_field(array(
			'name'        	=> 'qodef_products_list_title_tag',
			'type'        	=> 'select',
			'label' => esc_html__( 'Products Title Tag', 'startit' ),
			'default_value'	=> 'h1',
			'description' => esc_html__( '', 'startit' ),
			'options'		=> array(
				'h1' => esc_html__('h1','startit'),
				'h2' => esc_html__('h2','startit'),
				'h3' => esc_html__('h3','startit'),
				'h4' => esc_html__('h4','startit'),
				'h5' => esc_html__('h5','startit'),
				'h6' => esc_html__('h6','startit')
			),
			'parent'      	=> $panel_product_list,
		));

		/**
		 * Single Product Settings
		 */
		$panel_single_product = startit_qode_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'startit' )
			)
		);

		startit_qode_add_admin_field(array(
			'name'        	=> 'qodef_single_product_title_tag',
			'type'        	=> 'select',
			'label' => esc_html__( 'Single Product Title Tag', 'startit' ),
			'default_value'	=> 'h1',
			'description' => esc_html__( '', 'startit' ),
			'options'		=> array(
				'h1' => esc_html__('h1','startit'),
				'h2' => esc_html__('h2','startit'),
				'h3' => esc_html__('h3','startit'),
				'h4' => esc_html__('h4','startit'),
				'h5' => esc_html__('h5','startit'),
				'h6' => esc_html__('h6','startit')
			),
			'parent'      	=> $panel_single_product,
		));

	}

	add_action( 'qode_startit_options_map', 'startit_qode_woocommerce_options_map', 22);

}