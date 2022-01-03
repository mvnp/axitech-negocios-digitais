<?php

if ( ! function_exists( 'startit_qode_search_options_map' ) ) {

	function startit_qode_search_options_map() {

		startit_qode_add_admin_page(
			array(
				'slug' => '_search_page',
				'title' => esc_html__( 'Search', 'startit' ),
				'icon' => 'fa fa-search'
			)
		);

		$search_panel = startit_qode_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'startit' ),
				'name' => 'search',
				'page' => '_search_page'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_type',
				'default_value'	=> 'search-covers-header',
				'label' => esc_html__( 'Select Search Type', 'startit' ),
				'description' => esc_html__( "Choose a type of Select search bar", 'startit' ),
				'options' 		=> array(
					'search-covers-header' => 'Search Covers Header',
					'fullscreen-search' => 'Fullscreen Search',
					'search-slides-from-window-top' => 'Slide from Window Top'
				),
				'args'			=> array(
					'dependence'=> true,
					'hide'		=> array(
						'search-covers-header' => '#qodef_search_height_container, #qodef_search_animation_container',
						'fullscreen-search' => '#qodef_search_height_container',
						'search-slides-from-window-top' => '#qodef_search_height_container, #qodef_search_animation_container'
					),
					'show'		=> array(
						'search-covers-header' => '',
						'fullscreen-search' => '#qodef_search_animation_container',
						'search-slides-from-window-top' => ''
					)
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_icon_pack',
				'default_value'	=> 'font_awesome',
				'label' => esc_html__( 'Search Icon Pack', 'startit' ),
				'description' => esc_html__( 'Choose icon pack for search icon', 'startit' ),
				'options'		=> startit_qode_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'simple_line_icons', 'dripicons'))
			)
		);

		$search_height_container = startit_qode_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'search_height_container',
				'hidden_property'	=> 'search_type',
				'hidden_value'		=> '',
				'hidden_values'		=> array(
					'search-covers-header',
					'fullscreen-search',
					'search-slides-from-window-top'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_height_container,
				'type'			=> 'text',
				'name'			=> 'search_height',
				'default_value'	=> '',
				'label' => esc_html__( 'Search bar height', 'startit' ),
				'description' => esc_html__( 'Set search bar height', 'startit' ),
				'args'			=> array(
					'col_width' => 3,
					'suffix'	=> 'px'
				)
			)
		);

		$search_animation_container = startit_qode_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'search_animation_container',
				'hidden_property'	=> 'search_type',
				'hidden_value'		=> '',
				'hidden_values'		=> array(
					'search-covers-header',
					'search-slides-from-window-top'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_animation_container,
				'type'			=> 'select',
				'name'			=> 'search_animation',
				'default_value'	=> 'search-fade',
				'label' => esc_html__( 'Fullscreen Search Overlay Animation', 'startit' ),
				'description' => esc_html__( 'Choose animation for fullscreen search overlay', 'startit' ),
				'options'		=> array(
					'search-fade'			=> esc_html__('Fade', 'startit')
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'yesno',
				'name'			=> 'search_in_grid',
				'default_value'	=> 'yes',
				'label' => esc_html__( 'Search area in grid', 'startit' ),
				'description' => esc_html__( 'Set search area to be in grid', 'startit' ),
			)
		);

		startit_qode_add_admin_section_title(
			array(
				'parent' 	=> $search_panel,
				'name'		=> 'initial_header_icon_title',
				'title' => esc_html__( 'Initial Search Icon in Header', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'text',
				'name'			=> 'header_search_icon_size',
				'default_value'	=> '',
				'label' => esc_html__( 'Icon Size', 'startit' ),
				'description' => esc_html__( 'Set size for icon', 'startit' ),
				'args'			=> array(
					'col_width' => 3,
					'suffix'	=> 'px'
				)
			)
		);

		$search_icon_color_group = startit_qode_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title' => esc_html__( 'Icon Colors', 'startit' ),
				'description' => esc_html__( 'Define color style for icon', 'startit' ),
				'name'		=> 'search_icon_color_group'
			)
		);

		$search_icon_color_row = startit_qode_add_admin_row(
			array(
				'parent'	=> $search_icon_color_group,
				'name'		=> 'search_icon_color_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'	=> $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_color',
				'label' => esc_html__( 'Color', 'startit' )
			)
		);
		startit_qode_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_hover_color',
				'label' => esc_html__( 'Hover Color', 'startit' )
			)
		);
		startit_qode_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_light_search_icon_color',
				'label' => esc_html__( 'Light Header Icon Color', 'startit' )
			)
		);
		startit_qode_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_light_search_icon_hover_color',
				'label' => esc_html__( 'Light Header Icon Hover Color', 'startit' )
			)
		);

		$search_icon_color_row2 = startit_qode_add_admin_row(
			array(
				'parent'	=> $search_icon_color_group,
				'name'		=> 'search_icon_color_row2',
				'next'		=> true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $search_icon_color_row2,
				'type'		=> 'colorsimple',
				'name'		=> 'header_dark_search_icon_color',
				'label' => esc_html__( 'Dark Header Icon Color', 'startit' )
			)
		);
		startit_qode_add_admin_field(
			array(
				'parent' => $search_icon_color_row2,
				'type'		=> 'colorsimple',
				'name'		=> 'header_dark_search_icon_hover_color',
				'label' => esc_html__( 'Dark Header Icon Hover Color', 'startit' )
			)
		);


		$search_icon_background_group = startit_qode_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title' => esc_html__( 'Icon Background Style', 'startit' ),
				'description' => esc_html__( 'Define background style for icon', 'startit' ),
				'name'		=> 'search_icon_background_group'
			)
		);

		$search_icon_background_row = startit_qode_add_admin_row(
			array(
				'parent'	=> $search_icon_background_group,
				'name'		=> 'search_icon_background_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_icon_background_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_background_color',
				'default_value'	=> '',
				'label' => esc_html__( 'Background Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_icon_background_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_background_hover_color',
				'default_value'	=> '',
				'label' => esc_html__( 'Background Hover Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'yesno',
				'name'			=> 'enable_search_icon_text',
				'default_value'	=> 'no',
				'label' => esc_html__( 'Enable Search Icon Text', 'startit' ),
				'description'	=> esc_html__("Enable this option to show 'Search' text next to search icon in header", 'startit'),
				'args'			=> array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_search_icon_text_container'
				)
			)
		);

		$enable_search_icon_text_container = startit_qode_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'enable_search_icon_text_container',
				'hidden_property'	=> 'enable_search_icon_text',
				'hidden_value'		=> 'no'
			)
		);

		$enable_search_icon_text_group = startit_qode_add_admin_group(
			array(
				'parent'	=> $enable_search_icon_text_container,
				'title' => esc_html__( 'Search Icon Text', 'startit' ),
				'name'		=> 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define Style for Search Icon Text', 'startit' )
			)
		);

		$enable_search_icon_text_row = startit_qode_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color',
				'label' => esc_html__( 'Text Color', 'startit' ),
				'default_value'	=> ''
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color_hover',
				'label' => esc_html__( 'Text Hover Color', 'startit' ),
				'default_value'	=> ''
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_fontsize',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_lineheight',
				'label' => esc_html__( 'Line Height', 'startit' ),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		$enable_search_icon_text_row2 = startit_qode_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row2',
				'next'		=> true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_texttransform',
				'label' => esc_html__( 'Text Transform', 'startit' ),
				'default_value'	=> '',
				'options'		=> startit_qode_get_text_transform_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'search_icon_text_google_fonts',
				'label' => esc_html__( 'Font Family', 'startit' ),
				'default_value'	=> '-1',
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_fontstyle',
				'label' => esc_html__( 'Font Style', 'startit' ),
				'default_value'	=> '',
				'options'		=> startit_qode_get_font_style_array(),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_fontweight',
				'label' => esc_html__( 'Font Weight', 'startit' ),
				'default_value'	=> '',
				'options'		=> startit_qode_get_font_weight_array(),
			)
		);

		$enable_search_icon_text_row3 = startit_qode_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row3',
				'next'		=> true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row3,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_letterspacing',
				'label' => esc_html__( 'Letter Spacing', 'startit' ),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		$search_icon_spacing_group = startit_qode_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title' => esc_html__( 'Icon Spacing', 'startit' ),
				'description' => esc_html__( 'Define padding and margins for Search icon', 'startit' ),
				'name'		=> 'search_icon_spacing_group'
			)
		);

		$search_icon_spacing_row = startit_qode_add_admin_row(
			array(
				'parent'	=> $search_icon_spacing_group,
				'name'		=> 'search_icon_spacing_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_padding_left',
				'default_value'	=> '',
				'label' => esc_html__( 'Padding Left', 'startit' ),
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_padding_right',
				'default_value'	=> '',
				'label' => esc_html__( 'Padding Right', 'startit' ),
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_margin_left',
				'default_value'	=> '',
				'label' => esc_html__( 'Margin Left', 'startit' ),
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_margin_right',
				'default_value'	=> '',
				'label' => esc_html__( 'Margin Right', 'startit' ),
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		startit_qode_add_admin_section_title(
			array(
				'parent' 	=> $search_panel,
				'name'		=> 'search_form_title',
				'title' => esc_html__( 'Search Bar', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'color',
				'name'			=> 'search_background_color',
				'default_value'	=> '',
				'label' => esc_html__( 'Background Color', 'startit' ),
				'description' => esc_html__( 'Choose a background color for Select search bar', 'startit' )
			)
		);

		$search_input_text_group = startit_qode_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title' => esc_html__( 'Search Input Text', 'startit' ),
				'description' => esc_html__( 'Define style for search text', 'startit' ),
				'name'		=> 'search_input_text_group'
			)
		);

		$search_input_text_row = startit_qode_add_admin_row(
			array(
				'parent'	=> $search_input_text_group,
				'name'		=> 'search_input_text_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_input_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_text_color',
				'default_value'	=> '',
				'label' => esc_html__( 'Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_input_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_text_disabled_color',
				'default_value'	=> '',
				'label' => esc_html__( 'Disabled Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_input_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_text_fontsize',
				'default_value'	=> '',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'args'			=> array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_input_text_row,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_text_texttransform',
				'default_value'	=> '',
				'label' => esc_html__( 'Text Transform', 'startit' ),
				'options'		=> startit_qode_get_text_transform_array()
			)
		);

		$search_input_text_row2 = startit_qode_add_admin_row(
			array(
				'parent'	=> $search_input_text_group,
				'name'		=> 'search_input_text_row2'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_input_text_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'search_text_google_fonts',
				'default_value'	=> '-1',
				'label' => esc_html__( 'Font Family', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_input_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_text_fontstyle',
				'default_value'	=> '',
				'label' => esc_html__( 'Font Style', 'startit' ),
				'options'		=> startit_qode_get_font_style_array(),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_input_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_text_fontweight',
				'default_value'	=> '',
				'label' => esc_html__( 'Font Weight', 'startit' ),
				'options'		=> startit_qode_get_font_weight_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_input_text_row2,
				'type'			=> 'textsimple',
				'name'			=> 'search_text_letterspacing',
				'default_value'	=> '',
				'label' => esc_html__( 'Letter Spacing', 'startit' ),
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		$search_label_text_group = startit_qode_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title' => esc_html__( 'Search Label Text', 'startit' ),
				'description' => esc_html__( 'Define style for search label text', 'startit' ),
				'name'		=> 'search_label_text_group'
			)
		);

		$search_label_text_row = startit_qode_add_admin_row(
			array(
				'parent'	=> $search_label_text_group,
				'name'		=> 'search_label_text_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_label_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_label_text_color',
				'default_value'	=> '',
				'label' => esc_html__( 'Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_label_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_label_text_fontsize',
				'default_value'	=> '',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_label_text_row,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_label_text_texttransform',
				'default_value'	=> '',
				'label' => esc_html__( 'Text Transform', 'startit' ),
				'options'		=> startit_qode_get_text_transform_array()
			)
		);

		$search_label_text_row2 = startit_qode_add_admin_row(
			array(
				'parent'	=> $search_label_text_group,
				'name'		=> 'search_label_text_row2',
				'next'		=> true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_label_text_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'search_label_text_google_fonts',
				'default_value'	=> '-1',
				'label' => esc_html__( 'Font Family', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_label_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_label_text_fontstyle',
				'default_value'	=> '',
				'label' => esc_html__( 'Font Style', 'startit' ),
				'options'		=> startit_qode_get_font_style_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_label_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_label_text_fontweight',
				'default_value'	=> '',
				'label' => esc_html__( 'Font Weight', 'startit' ),
				'options'		=> startit_qode_get_font_weight_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_label_text_row2,
				'type'			=> 'textsimple',
				'name'			=> 'search_label_text_letterspacing',
				'default_value'	=> '',
				'label' => esc_html__( 'Letter Spacing', 'startit' ),
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		$search_icon_group = startit_qode_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title' => esc_html__( 'Search Icon', 'startit' ),
				'description' => esc_html__( 'Define style for search icon', 'startit' ),
				'name'		=> 'search_icon_group'
			)
		);

		$search_icon_row = startit_qode_add_admin_row(
			array(
				'parent'	=> $search_icon_group,
				'name'		=> 'search_icon_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_icon_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_color',
				'default_value'	=> '',
				'label' => esc_html__( 'Icon Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_icon_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_hover_color',
				'default_value'	=> '',
				'label' => esc_html__( 'Icon Hover Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_icon_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_disabled_color',
				'default_value'	=> '',
				'label' => esc_html__( 'Icon Disabled Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_icon_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_size',
				'default_value'	=> '',
				'label' => esc_html__( 'Icon Size', 'startit' ),
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		$search_close_icon_group = startit_qode_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title' => esc_html__( 'Search Close', 'startit' ),
				'description' => esc_html__( 'Define style for search close icon', 'startit' ),
				'name'		=> 'search_close_icon_group'
			)
		);

		$search_close_icon_row = startit_qode_add_admin_row(
			array(
				'parent'	=> $search_close_icon_group,
				'name'		=> 'search_icon_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_close_icon_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_close_color',
				'label' => esc_html__( 'Icon Color', 'startit' ),
				'default_value'	=> ''
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_close_icon_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_close_hover_color',
				'label' => esc_html__( 'Icon Hover Color', 'startit' ),
				'default_value'	=> ''
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_close_icon_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_close_size',
				'label' => esc_html__( 'Icon Size', 'startit' ),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		$search_bottom_border_group = startit_qode_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title' => esc_html__( 'Search Bottom Border', 'startit' ),
				'description' => esc_html__( 'Define style for Search text input bottom border (for Fullscreen search type)', 'startit' ),
				'name'		=> 'search_bottom_border_group'
			)
		);

		$search_bottom_border_row = startit_qode_add_admin_row(
			array(
				'parent'	=> $search_bottom_border_group,
				'name'		=> 'search_icon_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_bottom_border_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_border_color',
				'label' => esc_html__( 'Border Color', 'startit' ),
				'default_value'	=> ''
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent'		=> $search_bottom_border_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_border_focus_color',
				'label' => esc_html__( 'Border Focus Color', 'startit' ),
				'default_value'	=> ''
			)
		);

	}

	add_action('qode_startit_options_map', 'startit_qode_search_options_map', 13);

}