<?php

if ( ! function_exists( 'startit_qode_footer_options_map' ) ) {
	/**
	 * Add footer options
	 */
	function startit_qode_footer_options_map() {

		startit_qode_add_admin_page(
			array(
				'slug' => '_footer_page',
				'title' => esc_html__( 'Footer', 'startit' ),
				'icon' => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = startit_qode_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'startit' ),
				'name' => 'footer',
				'page' => '_footer_page'
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'uncovering_footer',
				'default_value' => 'no',
				'label' => esc_html__( 'Uncovering Footer', 'startit' ),
				'description' => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'startit' ),
				'parent' => $footer_panel,
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'footer_in_grid',
				'default_value' => 'no',
				'label' => esc_html__( 'Footer in Grid', 'startit' ),
				'description' => esc_html__( 'Enabling this option will place Footer content in grid', 'startit' ),
				'parent' => $footer_panel,
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_top',
				'default_value' => 'yes',
				'label' => esc_html__( 'Show Footer Top', 'startit' ),
				'description' => esc_html__( 'Enabling this option will show Footer Top area', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_show_footer_top_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_top_container = startit_qode_add_admin_container(
			array(
				'name' => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns',
				'default_value' => '4',
				'label' => esc_html__( 'Footer Top Columns', 'startit' ),
				'description' => esc_html__( 'Choose number of columns for Footer Top area', 'startit' ),
				'options' => array(
					'1' => esc_html__('1','startit'),
					'2' => esc_html__('2','startit'),
					'3' => esc_html__('3','startit'),
					'5' => esc_html__('3(25%+25%+50%)','startit'),
					'6' => esc_html__('3(50%+25%+25%)','startit'),
					'4' => esc_html__('4','startit')
				),
				'parent' => $show_footer_top_container,
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns_alignment',
				'default_value' => '',
				'label' => esc_html__( 'Footer Top Columns Alignment', 'startit' ),
				'description' => esc_html__( 'Text Alignment in Footer Columns', 'startit' ),
				'options' => array(
					'inherit' => esc_html__('Default','startit'),
					'left' => esc_html__('Left','startit'),
					'center' => esc_html__('Center','startit'),
					'right' => esc_html__('Right','startit')
				),
				'parent' => $show_footer_top_container,
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_bottom',
				'default_value' => 'no',
				'label' => esc_html__( 'Show Footer Bottom', 'startit' ),
				'description' => esc_html__( 'Enabling this option will show Footer Bottom area', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_show_footer_bottom_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_bottom_container = startit_qode_add_admin_container(
			array(
				'name' => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);


		startit_qode_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_bottom_columns',
				'default_value' => '3',
				'label' => esc_html__( 'Footer Bottom Columns', 'startit' ),
				'description' => esc_html__( 'Choose number of columns for Footer Bottom area', 'startit' ),
				'options' => array(
					'1' => esc_html__('1','startit'),
					'2' => esc_html__('2','startit'),
					'3' => esc_html__('3','startit')
				),
				'parent' => $show_footer_bottom_container,
			)
		);

	}

	add_action( 'qode_startit_options_map', 'startit_qode_footer_options_map', 5);

}