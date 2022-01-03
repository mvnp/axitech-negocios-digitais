<?php

if ( ! function_exists( 'startit_qode_mobile_header_options_map' ) ) {

	function startit_qode_mobile_header_options_map() {

		startit_qode_add_admin_page(array(
			'slug'  => '_mobile_header',
			'title' => esc_html__( 'Mobile Header', 'startit' ),
			'icon'  => 'fa fa-mobile'
		));

		$panel_mobile_header = startit_qode_add_admin_panel(array(
			'title' => esc_html__( 'Mobile header', 'startit' ),
			'name'  => 'panel_mobile_header',
			'page'  => '_mobile_header'
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_header_height',
			'type'        => 'text',
			'label' => esc_html__( 'Mobile Header Height', 'startit' ),
			'description' => esc_html__( 'Enter height for mobile header in pixels', 'startit' ),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_header_background_color',
			'type'        => 'color',
			'label' => esc_html__( 'Mobile Header Background Color', 'startit' ),
			'description' => esc_html__( 'Choose color for mobile header', 'startit' ),
			'parent'      => $panel_mobile_header
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_menu_background_color',
			'type'        => 'color',
			'label' => esc_html__( 'Mobile Menu Background Color', 'startit' ),
			'description' => esc_html__( 'Choose color for mobile menu', 'startit' ),
			'parent'      => $panel_mobile_header
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_menu_separator_color',
			'type'        => 'color',
			'label' => esc_html__( 'Mobile Menu Item Separator Color', 'startit' ),
			'description' => esc_html__( 'Choose color for mobile menu horizontal separators', 'startit' ),
			'parent'      => $panel_mobile_header
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_logo_height',
			'type'        => 'text',
			'label' => esc_html__( 'Logo Height For Mobile Header', 'startit' ),
			'description' => esc_html__( 'Define logo height for screen size smaller than 1000px', 'startit' ),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_logo_height_phones',
			'type'        => 'text',
			'label' => esc_html__( 'Logo Height For Mobile Devices', 'startit' ),
			'description' => esc_html__( 'Define logo height for screen size smaller than 480px', 'startit' ),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		startit_qode_add_admin_section_title(array(
			'parent' => $panel_mobile_header,
			'name'   => 'mobile_header_fonts_title',
			'title' => esc_html__( 'Typography', 'startit' )
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_text_color',
			'type'        => 'color',
			'label' => esc_html__( 'Navigation Text Color', 'startit' ),
			'description' => esc_html__( 'Define color for mobile navigation text', 'startit' ),
			'parent'      => $panel_mobile_header
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_text_hover_color',
			'type'        => 'color',
			'label' => esc_html__( 'Navigation Hover/Active Color', 'startit' ),
			'description' => esc_html__( 'Define hover/active color for mobile navigation text', 'startit' ),
			'parent'      => $panel_mobile_header
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_font_family',
			'type'        => 'font',
			'label' => esc_html__( 'Navigation Font Family', 'startit' ),
			'description' => esc_html__( 'Define font family for mobile navigation text', 'startit' ),
			'parent'      => $panel_mobile_header
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_font_size',
			'type'        => 'text',
			'label' => esc_html__( 'Navigation Font Size', 'startit' ),
			'description' => esc_html__( 'Define font size for mobile navigation text', 'startit' ),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_line_height',
			'type'        => 'text',
			'label' => esc_html__( 'Navigation Line Height', 'startit' ),
			'description' => esc_html__( 'Define line height for mobile navigation text', 'startit' ),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_text_transform',
			'type'        => 'select',
			'label' => esc_html__( 'Navigation Text Transform', 'startit' ),
			'description' => esc_html__( 'Define text transform for mobile navigation text', 'startit' ),
			'parent'      => $panel_mobile_header,
			'options'     => startit_qode_get_text_transform_array(true)
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_font_style',
			'type'        => 'select',
			'label' => esc_html__( 'Navigation Font Style', 'startit' ),
			'description' => esc_html__( 'Define font style for mobile navigation text', 'startit' ),
			'parent'      => $panel_mobile_header,
			'options'     => startit_qode_get_font_style_array(true)
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_font_weight',
			'type'        => 'select',
			'label' => esc_html__( 'Navigation Font Weight', 'startit' ),
			'description' => esc_html__( 'Define font weight for mobile navigation text', 'startit' ),
			'parent'      => $panel_mobile_header,
			'options'     => startit_qode_get_font_weight_array(true)
		));

		startit_qode_add_admin_section_title(array(
			'name' => 'mobile_opener_panel',
			'parent' => $panel_mobile_header,
			'title' => esc_html__( 'Mobile Menu Opener', 'startit' )
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_icon_pack',
			'type'        => 'select',
			'label' => esc_html__( 'Mobile Navigation Icon Pack', 'startit' ),
			'default_value' => 'font_awesome',
			'description' => esc_html__( 'Choose icon pack for mobile navigation icon', 'startit' ),
			'parent'      => $panel_mobile_header,
			'options'     => startit_qode_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'simple_line_icons'))
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_icon_color',
			'type'        => 'color',
			'label' => esc_html__( 'Mobile Navigation Icon Color', 'startit' ),
			'description' => esc_html__( 'Choose color for icon header', 'startit' ),
			'parent'      => $panel_mobile_header
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_icon_hover_color',
			'type'        => 'color',
			'label' => esc_html__( 'Mobile Navigation Icon Hover Color', 'startit' ),
			'description' => esc_html__( 'Choose hover color for mobile navigation icon ', 'startit' ),
			'parent'      => $panel_mobile_header
		));

		startit_qode_add_admin_field(array(
			'name'        => 'mobile_icon_size',
			'type'        => 'text',
			'label' => esc_html__( 'Mobile Navigation Icon size', 'startit' ),
			'description' => esc_html__( 'Choose size for mobile navigation icon ', 'startit' ),
			'parent'      => $panel_mobile_header,
			'args' => array(
				'col_width' => 3,
				'suffix' => 'px'
			)
		));

	}

	add_action( 'qode_startit_options_map', 'startit_qode_mobile_header_options_map', 4);

}