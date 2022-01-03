<?php

if ( ! function_exists( 'startit_qode_logo_options_map' ) ) {

	function startit_qode_logo_options_map() {

		startit_qode_add_admin_page(
			array(
				'slug' => '_logo_page',
				'title' => esc_html__( 'Logo', 'startit' ),
				'icon' => 'fa fa-coffee'
			)
		);

		$panel_logo = startit_qode_add_admin_panel(
			array(
				'page' => '_logo_page',
				'name' => 'panel_logo',
				'title' => esc_html__( 'Logo', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_logo,
				'type' => 'yesno',
				'name' => 'hide_logo',
				'default_value' => 'no',
				'label' => esc_html__( 'Hide Logo', 'startit' ),
				'description' => esc_html__( 'Enabling this option will hide logo image', 'startit' ),
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#qodef_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$hide_logo_container = startit_qode_add_admin_container(
			array(
				'parent' => $panel_logo,
				'name' => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value' => 'yes'
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'logo_image',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__( 'Logo Image - Default', 'startit' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'startit' ),
				'parent' => $hide_logo_container
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'logo_image_dark',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__( 'Logo Image - Dark', 'startit' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'startit' ),
				'parent' => $hide_logo_container
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'logo_image_light',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__( 'Logo Image - Light', 'startit' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'startit' ),
				'parent' => $hide_logo_container
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'logo_image_sticky',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__( 'Logo Image - Sticky', 'startit' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'startit' ),
				'parent' => $hide_logo_container
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'logo_image_mobile',
				'type' => 'image',
				'default_value' => QODE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__( 'Logo Image - Mobile', 'startit' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'startit' ),
				'parent' => $hide_logo_container
			)
		);

	}

	add_action( 'qode_startit_options_map', 'startit_qode_logo_options_map', 2);

}