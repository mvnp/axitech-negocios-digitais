<?php

if ( ! function_exists( 'startit_qode_title_options_map' ) ) {

	function startit_qode_title_options_map() {

		startit_qode_add_admin_page(
			array(
				'slug' => '_title_page',
				'title' => esc_html__( 'Title', 'startit' ),
				'icon' => 'fa fa-list-alt'
			)
		);

		$panel_title = startit_qode_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title',
				'title' => esc_html__( 'Title Settings', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'show_title_area',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => esc_html__( 'Show Title Area', 'startit' ),
				'description' => esc_html__( 'This option will enable/disable Title Area', 'startit' ),
				'parent' => $panel_title,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#qodef_show_title_area_container"
				)
			)
		);

		$show_title_area_container = startit_qode_add_admin_container(
			array(
				'parent' => $panel_title,
				'name' => 'show_title_area_container',
				'hidden_property' => 'show_title_area',
				'hidden_value' => 'no'
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'title_area_type',
				'type' => 'select',
				'default_value' => 'standard',
				'label' => esc_html__( 'Title Area Type', 'startit' ),
				'description' => esc_html__( 'Choose title type', 'startit' ),
				'parent' => $show_title_area_container,
				'options' => array(
					'standard' => esc_html__('Standard','startit'),
					'breadcrumb' => esc_html__('Breadcrumb','startit' )
				),
				'args' => array(
					"dependence" => true,
					"hide" => array(
						"standard" => "",
						"breadcrumb" => "#qodef_title_area_type_container"
					),
					"show" => array(
						"standard" => "#qodef_title_area_type_container",
						"breadcrumb" => ""
					)
				)
			)
		);

		$title_area_type_container = startit_qode_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_type_container',
				'hidden_property' => 'title_area_type',
				'hidden_value' => '',
				'hidden_values' => array('breadcrumb'),
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'title_area_enable_breadcrumbs',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable Breadcrumbs', 'startit' ),
				'description' => esc_html__( 'This option will display Breadcrumbs in Title Area', 'startit' ),
				'parent' => $title_area_type_container,
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'title_area_animation',
				'type' => 'select',
				'default_value' => 'no',
				'label' => esc_html__( 'Animations', 'startit' ),
				'description' => esc_html__( 'Choose an animation for Title Area', 'startit' ),
				'parent' => $show_title_area_container,
				'options' => array(
					'no' => esc_html__('No Animation','startit' ),
					'right-left' => esc_html__('Text right to left','startit' ),
					'left-right' => esc_html__('Text left to right','startit' )
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'title_area_vertial_alignment',
				'type' => 'select',
				'default_value' => 'header_bottom',
				'label' => esc_html__( 'Vertical Alignment', 'startit' ),
				'description' => esc_html__( 'Specify title vertical alignment', 'startit' ),
				'parent' => $show_title_area_container,
				'options' => array(
					'header_bottom' => esc_html__('From Bottom of Header','startit' ),
					'window_top' => esc_html__('From Window Top','startit' ),
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'title_area_content_alignment',
				'type' => 'select',
				'default_value' => 'left',
				'label' => esc_html__( 'Horizontal Alignment', 'startit' ),
				'description' => esc_html__( 'Specify title content alignment', 'startit' ),
				'parent' => $show_title_area_container,
				'options' => array(
					'left' => esc_html__('Left','startit' ),
					'center' => esc_html__('Center','startit' ),
					'right' => esc_html__('Right','startit' ),
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'title_area_background_color',
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'startit' ),
				'description' => esc_html__( 'Choose a background color for Title Area', 'startit' ),
				'parent' => $show_title_area_container
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'title_area_background_image',
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'startit' ),
				'description' => esc_html__( 'Choose an Image for Title Area', 'startit' ),
				'parent' => $show_title_area_container
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'title_area_background_image_responsive',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__( 'Background Responsive Image', 'startit' ),
				'description' => esc_html__( 'Enabling this option will make Title background image responsive', 'startit' ),
				'parent' => $show_title_area_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#qodef_title_area_background_image_responsive_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$title_area_background_image_responsive_container = startit_qode_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_background_image_responsive_container',
				'hidden_property' => 'title_area_background_image_responsive',
				'hidden_value' => 'yes'
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'title_area_background_image_parallax',
				'type' => 'select',
				'default_value' => 'no',
				'label' => esc_html__( 'Background Image in Parallax', 'startit' ),
				'description' => esc_html__( 'Enabling this option will make Title background image parallax', 'startit' ),
				'parent' => $title_area_background_image_responsive_container,
				'options' => array(
					'no' => esc_html__('No','startit' ),
					'yes' => esc_html__('Yes','startit' ),
					'yes_zoom' => esc_html__('Yes, with zoom out','startit' ),
				)
			)
		);

		startit_qode_add_admin_field(array(
			'name' => 'title_area_height',
			'type' => 'text',
			'label' => esc_html__( 'Height', 'startit' ),
			'description' => esc_html__( 'Set a height for Title Area', 'startit' ),
			'parent' => $title_area_background_image_responsive_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));


		$panel_typography = startit_qode_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title_typography',
				'title' => esc_html__( 'Typography', 'startit' )
			)
		);

		$group_page_title_styles = startit_qode_add_admin_group(array(
			'name'			=> 'group_page_title_styles',
			'title' => esc_html__( 'Title', 'startit' ),
			'description' => esc_html__( 'Define styles for page title', 'startit' ),
			'parent'		=> $panel_typography
		));

		$row_page_title_styles_1 = startit_qode_add_admin_row(array(
			'name'		=> 'row_page_title_styles_1',
			'parent'	=> $group_page_title_styles
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_title_color',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Color', 'startit' ),
			'parent'		=> $row_page_title_styles_1
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_fontsize',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Size', 'startit' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_1
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_lineheight',
			'default_value'	=> '',
			'label' => esc_html__( 'Line Height', 'startit' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_1
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_texttransform',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Transform', 'startit' ),
			'options'		=> startit_qode_get_text_transform_array(),
			'parent'		=> $row_page_title_styles_1
		));

		$row_page_title_styles_2 = startit_qode_add_admin_row(array(
			'name'		=> 'row_page_title_styles_2',
			'parent'	=> $group_page_title_styles,
			'next'		=> true
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_title_google_fonts',
			'default_value'	=> '-1',
			'label' => esc_html__( 'Font Family', 'startit' ),
			'parent'		=> $row_page_title_styles_2
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_fontstyle',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Style', 'startit' ),
			'options'		=> startit_qode_get_font_style_array(),
			'parent'		=> $row_page_title_styles_2
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_fontweight',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Weight', 'startit' ),
			'options'		=> startit_qode_get_font_weight_array(),
			'parent'		=> $row_page_title_styles_2
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_letter_spacing',
			'default_value'	=> '',
			'label' => esc_html__( 'Letter Spacing', 'startit' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_2
		));

		$group_page_subtitle_styles = startit_qode_add_admin_group(array(
			'name'			=> 'group_page_subtitle_styles',
			'title' => esc_html__( 'Subtitle', 'startit' ),
			'description' => esc_html__( 'Define styles for page subtitle', 'startit' ),
			'parent'		=> $panel_typography
		));

		$row_page_subtitle_styles_1 = startit_qode_add_admin_row(array(
			'name'		=> 'row_page_subtitle_styles_1',
			'parent'	=> $group_page_subtitle_styles
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_subtitle_color',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Color', 'startit' ),
			'parent'		=> $row_page_subtitle_styles_1
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_fontsize',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Size', 'startit' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_1
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_lineheight',
			'default_value'	=> '',
			'label' => esc_html__( 'Line Height', 'startit' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_1
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_texttransform',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Transform', 'startit' ),
			'options'		=> startit_qode_get_text_transform_array(),
			'parent'		=> $row_page_subtitle_styles_1
		));

		$row_page_subtitle_styles_2 = startit_qode_add_admin_row(array(
			'name'		=> 'row_page_subtitle_styles_2',
			'parent'	=> $group_page_subtitle_styles,
			'next'		=> true
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_subtitle_google_fonts',
			'default_value'	=> '-1',
			'label' => esc_html__( 'Font Family', 'startit' ),
			'parent'		=> $row_page_subtitle_styles_2
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_fontstyle',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Style', 'startit' ),
			'options'		=> startit_qode_get_font_style_array(),
			'parent'		=> $row_page_subtitle_styles_2
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_fontweight',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Weight', 'startit' ),
			'options'		=> startit_qode_get_font_weight_array(),
			'parent'		=> $row_page_subtitle_styles_2
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_letter_spacing',
			'default_value'	=> '',
			'label' => esc_html__( 'Letter Spacing', 'startit' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_2
		));

		$group_page_breadcrumbs_styles = startit_qode_add_admin_group(array(
			'name'			=> 'group_page_breadcrumbs_styles',
			'title' => esc_html__( 'Breadcrumbs', 'startit' ),
			'description' => esc_html__( 'Define styles for page breadcrumbs', 'startit' ),
			'parent'		=> $panel_typography
		));

		$row_page_breadcrumbs_styles_1 = startit_qode_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_1',
			'parent'	=> $group_page_breadcrumbs_styles
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_breadcrumb_color',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Color', 'startit' ),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_fontsize',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Size', 'startit' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_lineheight',
			'default_value'	=> '',
			'label' => esc_html__( 'Line Height', 'startit' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_texttransform',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Transform', 'startit' ),
			'options'		=> startit_qode_get_text_transform_array(),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		$row_page_breadcrumbs_styles_2 = startit_qode_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_2',
			'parent'	=> $group_page_breadcrumbs_styles,
			'next'		=> true
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_breadcrumb_google_fonts',
			'default_value'	=> '-1',
			'label' => esc_html__( 'Font Family', 'startit' ),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_fontstyle',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Style', 'startit' ),
			'options'		=> startit_qode_get_font_style_array(),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_fontweight',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Weight', 'startit' ),
			'options'		=> startit_qode_get_font_weight_array(),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_letter_spacing',
			'default_value'	=> '',
			'label' => esc_html__( 'Letter Spacing', 'startit' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		$row_page_breadcrumbs_styles_3 = startit_qode_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_3',
			'parent'	=> $group_page_breadcrumbs_styles,
			'next'		=> true
		));

		startit_qode_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_breadcrumb_hovercolor',
			'default_value'	=> '',
			'label' => esc_html__( 'Hover/Active Color', 'startit' ),
			'parent'		=> $row_page_breadcrumbs_styles_3
		));

	}

	add_action( 'qode_startit_options_map', 'startit_qode_title_options_map', 6);

}