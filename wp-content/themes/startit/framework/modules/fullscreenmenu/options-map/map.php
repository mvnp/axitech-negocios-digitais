<?php

if ( ! function_exists('qode_startit_fullscreen_menu_options_map')) {

	function qode_startit_fullscreen_menu_options_map() {

		startit_qode_add_admin_page(
			array(
				'slug' => '_fullscreen_menu_page',
				'title' => 'Fullscreen Menu',
				'icon' => 'fa fa-arrows-alt'
			)
		);

		$fullscreen_panel = startit_qode_add_admin_panel(
			array(
				'title' => 'Fullscreen Menu',
				'name' => 'fullscreen_menu',
				'page' => '_fullscreen_menu_page'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'select',
				'name' => 'fullscreen_menu_animation_style',
				'default_value' => 'fade-push-text-right',
				'label' => esc_html__( 'Fullscreen Menu Overlay Animation', 'startit' ),
				'description' => esc_html__( 'Choose animation type for fullscreen menu overlay', 'startit' ),
				'options' => array(
					'fade-push-text-right' => esc_html__('Fade Push Text Right','startit'),
					'fade-push-text-top' => esc_html__('Fade Push Text Top','startit'),
					'fade-text-scaledown' => esc_html__('Fade Text Scaledown','startit'),
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_logo',
				'default_value' => '',
				'label' => esc_html__( 'Logo in Fullscreen Menu Overlay', 'startit' ),
				'description' => esc_html__( 'Place logo in top left corner of fullscreen menu overlay', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'yesno',
				'name' => 'fullscreen_in_grid',
				'default_value' => 'no',
				'label' => esc_html__( 'Fullscreen Menu in Grid', 'startit' ),
				'description' => esc_html__( 'Enabling this option will put fullscreen menu content in grid', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'selectblank',
				'name' => 'fullscreen_alignment',
				'default_value' => '',
				'label' => esc_html__( 'Fullscreen Menu Alignment', 'startit' ),
				'description' => esc_html__( 'Choose alignment for fullscreen menu content', 'startit' ),
				'options' => array(
					"left" => esc_html__("Left",'startit'),
					"center" => esc_html__("Center",'startit'),
					"right" => esc_html__("Right",'startit'),
				)
			)
		);

		$background_group = startit_qode_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'background_group',
				'title' => esc_html__( 'Background', 'startit' ),
				'description' => esc_html__( 'Select a background color and transparency for Fullscreen Menu (0 = fully transparent, 1 = opaque)', 'startit' )

			)
		);

		$background_group_row = startit_qode_add_admin_row(
			array(
				'parent' => $background_group,
				'name' => 'background_group_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_background_color',
				'default_value' => '',
				'label' => esc_html__( 'Background Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_background_transparency',
				'default_value' => '',
				'label' => esc_html__( 'Transparency (values:0-1)', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_background_image',
				'default_value' => '',
				'label' => esc_html__( 'Background Image', 'startit' ),
				'description' => esc_html__( 'Choose a background image for Fullscreen Menu background', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_pattern_image',
				'default_value' => '',
				'label' => esc_html__( 'Pattern Background Image', 'startit' ),
				'description' => esc_html__( 'Choose a pattern image for Fullscreen Menu background', 'startit' )
			)
		);

//1st level style group
		$first_level_style_group = startit_qode_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'first_level_style_group',
				'title' => esc_html__( '1st Level Style', 'startit' ),
				'description' => esc_html__( 'Define styles for 1st level in Fullscreen Menu', 'startit' )
			)
		);

		$first_level_style_row1 = startit_qode_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row1'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color',
				'default_value' => '',
				'label' => esc_html__( 'Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color',
				'default_value' => '',
				'label' => esc_html__( 'Hover Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_active_color',
				'default_value' => '',
				'label' => esc_html__( 'Active Text Color', 'startit' ),
			)
		);

		$first_level_style_row2 = startit_qode_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row2'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row2,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_background_color',
				'default_value' => '',
				'label' => esc_html__( 'Background Hover Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row2,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_active_background_color',
				'default_value' => '',
				'label' => esc_html__( 'Background Active Color', 'startit' ),
			)
		);

		$first_level_style_row3 = startit_qode_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row3'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts',
				'default_value' => '-1',
				'label' => esc_html__( 'Font Family', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_fontsize',
				'default_value' => '',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_lineheight',
				'default_value' => '',
				'label' => esc_html__( 'Line Height', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$first_level_style_row4 = startit_qode_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row4'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontstyle',
				'default_value' => '',
				'label' => esc_html__( 'Font Style', 'startit' ),
				'options' => startit_qode_get_font_style_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontweight',
				'default_value' => '',
				'label' => esc_html__( 'Font Weight', 'startit' ),
				'options' => startit_qode_get_font_weight_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letterspacing',
				'default_value' => '',
				'label' => esc_html__( 'Letter Spacing', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_texttransform',
				'default_value' => '',
				'label' => esc_html__( 'Text Transform', 'startit' ),
				'options' => startit_qode_get_text_transform_array()
			)
		);

//2nd level style group
		$second_level_style_group = startit_qode_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'second_level_style_group',
				'title' => esc_html__( '2nd Level Style', 'startit' ),
				'description' => esc_html__( 'Define styles for 2nd level in Fullscreen Menu', 'startit' )
			)
		);

		$second_level_style_row1 = startit_qode_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row1'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_2nd',
				'default_value' => '',
				'label' => esc_html__( 'Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_2nd',
				'default_value' => '',
				'label' => esc_html__( 'Hover Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_background_color_2nd',
				'default_value' => '',
				'label' => esc_html__( 'Background Hover Color', 'startit' ),
			)
		);

		$second_level_style_row2 = startit_qode_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_2nd',
				'default_value' => '-1',
				'label' => esc_html__( 'Font Family', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_fontsize_2nd',
				'default_value' => '',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_lineheight_2nd',
				'default_value' => '',
				'label' => esc_html__( 'Line Height', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_style_row3 = startit_qode_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontstyle_2nd',
				'default_value' => '',
				'label' => esc_html__( 'Font Style', 'startit' ),
				'options' => startit_qode_get_font_style_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontweight_2nd',
				'default_value' => '',
				'label' => esc_html__( 'Font Weight', 'startit' ),
				'options' => startit_qode_get_font_weight_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letterspacing_2nd',
				'default_value' => '',
				'label' => esc_html__( 'Letter Spacing', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_texttransform_2nd',
				'default_value' => '',
				'label' => esc_html__( 'Text Transform', 'startit' ),
				'options' => startit_qode_get_text_transform_array()
			)
		);

		$third_level_style_group = startit_qode_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'third_level_style_group',
				'title' => esc_html__( '3rd Level Style', 'startit' ),
				'description' => esc_html__( 'Define styles for 3rd level in Fullscreen Menu', 'startit' )
			)
		);

		$third_level_style_row1 = startit_qode_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'third_level_style_row1'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_3rd',
				'default_value' => '',
				'label' => esc_html__( 'Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_3rd',
				'default_value' => '',
				'label' => esc_html__( 'Hover Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_background_color_3rd',
				'default_value' => '',
				'label' => esc_html__( 'Background Hover Color', 'startit' ),
			)
		);

		$third_level_style_row2 = startit_qode_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_3rd',
				'default_value' => '-1',
				'label' => esc_html__( 'Font Family', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_fontsize_3rd',
				'default_value' => '',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_lineheight_3rd',
				'default_value' => '',
				'label' => esc_html__( 'Line Height', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_style_row3 = startit_qode_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontstyle_3rd',
				'default_value' => '',
				'label' => esc_html__( 'Font Style', 'startit' ),
				'options' => startit_qode_get_font_style_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontweight_3rd',
				'default_value' => '',
				'label' => esc_html__( 'Font Weight', 'startit' ),
				'options' => startit_qode_get_font_weight_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letterspacing_3rd',
				'default_value' => '',
				'label' => esc_html__( 'Letter Spacing', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_texttransform_3rd',
				'default_value' => '',
				'label' => esc_html__( 'Text Transform', 'startit' ),
				'options' => startit_qode_get_text_transform_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'select',
				'name' => 'fullscreen_menu_icon_size',
				'label' => esc_html__( 'Fullscreen Menu Icon Size', 'startit' ),
				'description' => esc_html__( 'Choose predefined size for Fullscreen Menu icon', 'startit' ),
				'default_value' => 'normal',
				'options' => array(
					'normal' => esc_html__('Normal','startit'),
					'medium' => esc_html__('Medium','startit'),
					'large' => esc_html__('Large','startit'),
				)

			)
		);

		$icon_colors_group = startit_qode_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'fullscreen_menu_icon_colors_group',
				'title' => esc_html__( 'Full Screen Menu Icon Style', 'startit' ),
				'description' => esc_html__( 'Define styles for Fullscreen Menu Icon', 'startit' )
			)
		);

		$icon_colors_row1 = startit_qode_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row1'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_color',
				'label' => esc_html__( 'Color', 'startit' ),
			)
		);
		startit_qode_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_hover_color',
				'label' => esc_html__( 'Hover Color', 'startit' ),
			)
		);
		$icon_colors_row2 = startit_qode_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row2',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $icon_colors_row2,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_light_icon_color',
				'label' => esc_html__( 'Light Menu Icon Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $icon_colors_row2,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_light_icon_hover_color',
				'label' => esc_html__( 'Light Menu Icon Hover Color', 'startit' ),
			)
		);

		$icon_colors_row3 = startit_qode_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row3',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $icon_colors_row3,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_dark_icon_color',
				'label' => esc_html__( 'Dark Menu Icon Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $icon_colors_row3,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_dark_icon_hover_color',
				'label' => esc_html__( 'Dark Menu Icon Hover Color', 'startit' ),
			)
		);

		$icon_colors_row4 = startit_qode_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row4',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $icon_colors_row4,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_background_color',
				'label' => esc_html__( 'Background Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $icon_colors_row4,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_background_hover_color',
				'label' => esc_html__( 'Background Hover Color', 'startit' ),
			)
		);

		$icon_spacing_group = startit_qode_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'icon_spacing_group',
				'title' => esc_html__( 'Full Screen Menu Icon Spacing', 'startit' ),
				'description' => esc_html__( 'Define padding and margin for full screen menu icon', 'startit' )
			)
		);

		$icon_spacing_row = startit_qode_add_admin_row(
			array(
				'parent' => $icon_spacing_group,
				'name' => 'icon_spacing_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_icon_padding_left',
				'default_value' => '',
				'label' => esc_html__( 'Padding Left', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_icon_padding_right',
				'default_value' => '',
				'label' => esc_html__( 'Padding Right', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_icon_margin_left',
				'default_value' => '',
				'label' => esc_html__( 'Margin Left', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_icon_margin_right',
				'default_value' => '',
				'label' => esc_html__( 'Margin Right', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

	}

	add_action('qode_startit_options_map', 'qode_startit_fullscreen_menu_options_map', 15);

}