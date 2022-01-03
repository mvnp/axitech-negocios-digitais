<?php

if ( ! function_exists( 'startit_qode_header_options_map' ) ) {

	function startit_qode_header_options_map() {

		startit_qode_add_admin_page(
			array(
				'slug' => '_header_page',
				'title' => esc_html__( 'Header', 'startit' ),
				'icon' => 'fa fa-header'
			)
		);

		$panel_header = startit_qode_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header',
				'title' => esc_html__( 'Header', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_type',
				'default_value' => 'header-standard',
				'label' => esc_html__( 'Choose Header Type', 'startit' ),
				'description' => esc_html__( 'Select the type of header you would like to use', 'startit' ),
				'options' => array(
					'header-standard' => esc_html__('Header Standard','startit' ),
                    'header-vertical' => esc_html__('Header Vertical','startit' ),
					'header-overlapping' => esc_html__('Header Overlapping','startit' ),
					'header-full-screen' => esc_html__('Header Full Screen','startit' )
				),
				'args' => array(
					'use_images' => true,
					'hide_labels' => true,
					'dependence' => true,
					'show' => array(
						'header-standard' => '#qodef_panel_header_standard,#qodef_header_behaviour,#qodef_panel_fixed_header,#qodef_panel_sticky_header,#qodef_panel_main_menu',
                        'header-vertical' => '#qodef_panel_header_vertical,#qodef_panel_vertical_main_menu',
						'header-overlapping' => '#qodef_panel_header_overlapping,#qodef_header_behaviour,#qodef_panel_fixed_header,#qodef_panel_sticky_header,#qodef_panel_main_menu',
						'header-full-screen' => '#qodef_panel_header_full_screen,#qodef_header_behaviour,#qodef_panel_sticky_header,#qodef_panel_fixed_header'
					),
					'hide' => array(
						'header-standard' => '#qodef_panel_header_overlapping,#qodef_panel_header_full_screen,#qodef_panel_header_vertical,#qodef_panel_vertical_main_menu',
                        'header-vertical' => '#qodef_panel_header_overlapping,#qodef_panel_header_full_screen,#qodef_panel_header_standard,#qodef_header_behaviour,#qodef_panel_fixed_header,#qodef_panel_sticky_header,#qodef_panel_main_menu',
						'header-overlapping' => '#qodef_panel_header_standard,#qodef_panel_header_full_screen,#qodef_panel_header_vertical,#qodef_panel_vertical_main_menu',
						'header-full-screen' => '#qodef_panel_header_overlapping,#qodef_panel_header_standard,#qodef_panel_main_menu,#qodef_panel_header_vertical,#qodef_panel_vertical_main_menu'
					)
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_behaviour',
				'default_value' => 'sticky-header-on-scroll-up',
				'label' => esc_html__( 'Choose Header behaviour', 'startit' ),
				'description' => esc_html__( 'Select the behaviour of header when you scroll down to page', 'startit' ),
				'options' => array(
					'sticky-header-on-scroll-up' => esc_html__('Sticky on scrol up','startit' ),
					'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scrol up/down','startit' ),
					'fixed-on-scroll' => esc_html__('Fixed on scroll','startit' ),
				),
                'hidden_property' => 'header_type',
                'hidden_value' => '',
                'hidden_values' => array(
					'header-vertical'
				),
				'args' => array(
					'dependence' => true,
					'show' => array(
						'sticky-header-on-scroll-up' => '#qodef_panel_sticky_header',
						'sticky-header-on-scroll-down-up' => '#qodef_panel_sticky_header',
						'fixed-on-scroll' => '#qodef_panel_fixed_header'
					),
					'hide' => array(
						'sticky-header-on-scroll-up' => '#qodef_panel_fixed_header',
						'sticky-header-on-scroll-down-up' => '#qodef_panel_fixed_header',
						'fixed-on-scroll' => '#qodef_panel_sticky_header',
					)
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'top_bar',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__( 'Top Bar', 'startit' ),
				'description' => esc_html__( 'Enabling this option will show top bar area', 'startit' ),
				'parent' => $panel_header,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#qodef_top_bar_container"
				)
			)
		);

		$top_bar_container = startit_qode_add_admin_container(array(
			'name' => 'top_bar_container',
			'parent' => $panel_header,
			'hidden_property' => 'top_bar',
			'hidden_value' => 'no'
		));

		startit_qode_add_admin_field(
			array(
				'parent' => $top_bar_container,
				'type' => 'select',
				'name' => 'top_bar_layout',
				'default_value' => 'three-columns',
				'label' => esc_html__( 'Choose top bar layout', 'startit' ),
				'description' => esc_html__( 'Select the layout for top bar', 'startit' ),
				'options' => array(
					'two-columns' => esc_html__('Two columns','startit' ),
					'three-columns' => esc_html__('Three columns','startit' )
				),
				'args' => array(
					"dependence" => true,
					"hide" => array(
						"two-columns" => "#qodef_top_bar_layout_container",
						"three-columns" => ""
					),
					"show" => array(
						"two-columns" => "",
						"three-columns" => "#qodef_top_bar_layout_container"
					)
				)
			)
		);

		$top_bar_layout_container = startit_qode_add_admin_container(array(
			'name' => 'top_bar_layout_container',
			'parent' => $top_bar_container,
			'hidden_property' => 'top_bar_layout',
			'hidden_value' => '',
			'hidden_values' => array("two-columns"),
		));

		startit_qode_add_admin_field(
			array(
				'parent' => $top_bar_layout_container,
				'type' => 'select',
				'name' => 'top_bar_column_widths',
				'default_value' => '30-30-30',
				'label' => esc_html__( 'Choose column widths', 'startit' ),
				'description' => esc_html__( '', 'startit' ),
				'options' => array(
					'30-30-30' => esc_html__('33% - 33% - 33%','startit' ),
					'25-50-25' => esc_html__('25% - 50% - 25%','startit' ),
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'top_bar_in_grid',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => esc_html__( 'Top Bar in grid', 'startit' ),
				'description' => esc_html__( 'Set top bar content to be in grid', 'startit' ),
				'parent' => $top_bar_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#qodef_top_bar_in_grid_container"
				)
			)
		);

		$top_bar_in_grid_container = startit_qode_add_admin_container(array(
			'name' => 'top_bar_in_grid_container',
			'parent' => $top_bar_container,
			'hidden_property' => 'top_bar_in_grid',
			'hidden_value' => 'no'
		));

		startit_qode_add_admin_field(array(
			'name' => 'top_bar_grid_background_color',
			'type' => 'color',
			'label' => esc_html__( 'Grid Background Color', 'startit' ),
			'description' => esc_html__( 'Set grid background color for top bar', 'startit' ),
			'parent' => $top_bar_container
		));


		startit_qode_add_admin_field(array(
			'name' => 'top_bar_grid_background_transparency',
			'type' => 'text',
			'label' => esc_html__( 'Grid Background Transparency', 'startit' ),
			'description' => esc_html__( 'Set grid background transparency for top bar', 'startit' ),
			'parent' => $top_bar_container,
			'args' => array('col_width' => 3)
		));

		startit_qode_add_admin_field(array(
			'name' => 'top_bar_background_color',
			'type' => 'color',
			'label' => esc_html__( 'Background Color', 'startit' ),
			'description' => esc_html__( 'Set background color for top bar', 'startit' ),
			'parent' => $top_bar_container
		));

		startit_qode_add_admin_field(array(
			'name' => 'top_bar_background_transparency',
			'type' => 'text',
			'label' => esc_html__( 'Background Transparency', 'startit' ),
			'description' => esc_html__( 'Set background transparency for top bar', 'startit' ),
			'parent' => $top_bar_container,
			'args' => array('col_width' => 3)
		));

		startit_qode_add_admin_field(array(
			'name' => 'top_bar_height',
			'type' => 'text',
			'label' => esc_html__( 'Top bar height', 'startit' ),
			'description' => esc_html__( 'Enter top bar height (Default is 40px)', 'startit' ),
			'parent' => $top_bar_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		startit_qode_add_admin_field(
			array(
				'name' => 'show_top_bar_mobile_header',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => esc_html__( 'Show Top bar in Mobile Header', 'startit' ),
				'description' => esc_html__( 'Disable this option and hide header top bar in mobile header', 'startit' ),
				'parent' => $top_bar_container
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_style',
				'default_value' => '',
				'label' => esc_html__( 'Header Skin', 'startit' ),
				'description' => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'startit' ),
				'options' => array(
					'' => esc_html__('Default','startit'),
					'light-header' => esc_html__('Light','startit' ),
					'dark-header' => esc_html__('Dark','startit' ),
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'yesno',
				'name' => 'enable_header_style_on_scroll',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable Header Style on Scroll', 'startit' ),
				'description' => esc_html__( 'Enabling this option, header will change style depending on row settings for dark/light style', 'startit' ),
			)
		);

		$panel_header_standard = startit_qode_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header_standard',
				'title' => esc_html__( 'Header Standard', 'startit' ),
				'hidden_property' => 'header_type',
				'hidden_value' => '',
				'hidden_values' => array(
                    'header-vertical',
					'header-overlapping',
					'header-full-screen'
				)
			)
		);

		startit_qode_add_admin_section_title(
			array(
				'parent' => $panel_header_standard,
				'name' => 'menu_area_title',
				'title' => esc_html__( 'Menu Area', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'yesno',
				'name' => 'menu_area_in_grid_header_standard',
				'default_value' => 'yes',
				'label' => esc_html__( 'Header in grid', 'startit' ),
				'description' => esc_html__( 'Set header content to be in grid', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_menu_area_in_grid_header_standard_container'
				)
			)
		);

		$menu_area_in_grid_header_standard_container = startit_qode_add_admin_container(
			array(
				'parent' => $panel_header_standard,
				'name' => 'menu_area_in_grid_header_standard_container',
				'hidden_property' => 'menu_area_in_grid_header_standard',
				'hidden_value' => 'no'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $menu_area_in_grid_header_standard_container,
				'type' => 'color',
				'name' => 'menu_area_grid_background_color_header_standard',
				'default_value' => '',
				'label' => esc_html__( 'Grid Background color', 'startit' ),
				'description' => esc_html__( 'Set grid background color for header area', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $menu_area_in_grid_header_standard_container,
				'type' => 'text',
				'name' => 'menu_area_grid_background_transparency_header_standard',
				'default_value' => '',
				'label' => esc_html__( 'Grid background transparency', 'startit' ),
				'description' => esc_html__( 'Set grid background transparency for header', 'startit' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'color',
				'name' => 'menu_area_background_color_header_standard',
				'default_value' => '',
				'label' => esc_html__( 'Background color', 'startit' ),
				'description' => esc_html__( 'Set background color for header', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'text',
				'name' => 'menu_area_background_transparency_header_standard',
				'default_value' => '',
				'label' => esc_html__( 'Background transparency', 'startit' ),
				'description' => esc_html__( 'Set background transparency for header', 'startit' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'text',
				'name' => 'menu_area_height_header_standard',
				'default_value' => '',
				'label' => esc_html__( 'Height', 'startit' ),
				'description' => esc_html__( 'Enter header height (default is 100px)', 'startit' ),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

        $panel_header_vertical = startit_qode_add_admin_panel(
            array(
                'page' => '_header_page',
                'name' => 'panel_header_vertical',
                'title' => esc_html__( 'Header Vertical', 'startit' ),
                'hidden_property' => 'header_type',
                'hidden_value' => '',
                'hidden_values' => array(
                    'header-standard',
					'header-overlapping',
					'header-full-screen'
                )
            )
        );

            startit_qode_add_admin_field(array(
                'name' => 'vertical_header_background_color',
                'type' => 'color',
                'label' => esc_html__( 'Background Color', 'startit' ),
                'description' => esc_html__( 'Set background color for vertical menu', 'startit' ),
                'parent' => $panel_header_vertical
            ));

            startit_qode_add_admin_field(array(
                'name' => 'vertical_header_transparency',
                'type' => 'text',
                'label' => esc_html__( 'Transparency', 'startit' ),
                'description' => esc_html__( 'Enter transparency for vertical menu (value from 0 to 1)', 'startit' ),
                'parent' => $panel_header_vertical,
                'args' => array(
                    'col_width' => 1
                )
            ));

            startit_qode_add_admin_field(
                array(
                    'name' => 'vertical_header_background_image',
                    'type' => 'image',
                    'default_value' => '',
                    'label' => esc_html__( 'Background Image', 'startit' ),
                    'description' => esc_html__( 'Set background image for vertical menu', 'startit' ),
                    'parent' => $panel_header_vertical
                )
            );



		$panel_header_full_screen = startit_qode_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header_full_screen',
				'title' => esc_html__( 'Header Full Screen', 'startit' ),
				'hidden_property' => 'header_type',
				'hidden_value' => '',
				'hidden_values' => array(
					'header-standard',
					'header-overlapping',
					'header-vertical'
				)
			)
		);


		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_full_screen,
				'type' => 'yesno',
				'name' => 'menu_area_in_grid_header_full_screen',
				'default_value' => 'no',
				'label' => esc_html__( 'Header in grid', 'startit' ),
				'description' => esc_html__( 'Set header content to be in grid', 'startit' )
			)
		);



		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_full_screen,
				'type' => 'color',
				'name' => 'menu_area_background_color_header_full_screen',
				'default_value' => '',
				'label' => esc_html__( 'Background color', 'startit' ),
				'description' => esc_html__( 'Set background color for header', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_full_screen,
				'type' => 'text',
				'name' => 'menu_area_background_transparency_header_full_screen',
				'default_value' => '',
				'label' => esc_html__( 'Background transparency', 'startit' ),
				'description' => esc_html__( 'Set background transparency for header', 'startit' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_full_screen,
				'type' => 'text',
				'name' => 'menu_area_height_header_full_screen',
				'default_value' => '',
				'label' => esc_html__( 'Height', 'startit' ),
				'description' => esc_html__( 'Enter header height (default is 100px)', 'startit' ),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);


		$panel_header_overlapping = startit_qode_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header_overlapping',
				'title' => esc_html__( 'Header Overlapping', 'startit' ),
				'hidden_property' => 'header_type',
				'hidden_value' => '',
				'hidden_values' => array(
					'header-vertical',
					'header-standard',
					'header-full-screen'
				)
			)
		);

		startit_qode_add_admin_section_title(
			array(
				'parent' => $panel_header_overlapping,
				'name' => 'menu_area_title',
				'title' => esc_html__( 'Menu Area', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_overlapping,
				'type' => 'yesno',
				'name' => 'menu_area_in_grid_header_overlapping',
				'default_value' => 'yes',
				'label' => esc_html__( 'Header in grid', 'startit' ),
				'description' => esc_html__( 'Set header content to be in grid', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_menu_area_in_grid_header_overlapping_container'
				)
			)
		);


		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_overlapping,
				'type' => 'color',
				'name' => 'menu_area_background_color_header_overlapping',
				'default_value' => '',
				'label' => esc_html__( 'Wrapper Background Color', 'startit' ),
				'description' => esc_html__( 'Set background color for header wrapper', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_overlapping,
				'type' => 'text',
				'name' => 'menu_area_background_transparency_header_overlapping',
				'default_value' => '',
				'label' => esc_html__( 'Wrapper Background Transparency', 'startit' ),
				'description' => esc_html__( 'Set background transparency for header wrapper', 'startit' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_overlapping,
				'type' => 'color',
				'name' => 'menu_area_background_color_bottom_header_overlapping',
				'default_value' => '',
				'label' => esc_html__( 'Overlapping Menu Background Color', 'startit' ),
				'description' => esc_html__( 'Set background color for overlapped menu area', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_overlapping,
				'type' => 'text',
				'name' => 'menu_area_background_transparency_bottom_header_overlapping',
				'default_value' => '',
				'label' => esc_html__( 'Overlapping Menu Background Transparency', 'startit' ),
				'description' => esc_html__( 'Set background transparency for overlapped menu area', 'startit' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);


		startit_qode_add_admin_field(
			array(
				'parent' => $panel_header_overlapping,
				'type' => 'text',
				'name' => 'menu_area_height_header_overlapping',
				'default_value' => '',
				'label' => esc_html__( 'Height', 'startit' ),
				'description' => esc_html__( 'Enter header height (default is 100px)', 'startit' ),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);


		$panel_sticky_header = startit_qode_add_admin_panel(
			array(
				'title' => esc_html__( 'Sticky Header', 'startit' ),
				'name' => 'panel_sticky_header',
				'page' => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values' => array(
					'fixed-on-scroll'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'scroll_amount_for_sticky',
				'type' => 'text',
				'label' => esc_html__( 'Scroll Amount for Sticky', 'startit' ),
				'description' => esc_html__( 'Enter scroll amount for Sticky Menu to appear (deafult is header height)', 'startit' ),
				'parent' => $panel_sticky_header,
				'args' => array(
					'col_width' => 2,
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'name' => 'sticky_header_in_grid',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => esc_html__( 'Sticky Header in grid', 'startit' ),
				'description' => esc_html__( 'Set sticky header content to be in grid', 'startit' ),
				'parent' => $panel_sticky_header,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#qodef_sticky_header_in_grid_container"
				)
			)
		);

		$sticky_header_in_grid_container = startit_qode_add_admin_container(array(
			'name' => 'sticky_header_in_grid_container',
			'parent' => $panel_sticky_header,
			'hidden_property' => 'sticky_header_in_grid',
			'hidden_value' => 'no'
		));

		startit_qode_add_admin_field(array(
			'name' => 'sticky_header_grid_background_color',
			'type' => 'color',
			'label' => esc_html__( 'Grid Background Color', 'startit' ),
			'description' => esc_html__( 'Set grid background color for sticky header', 'startit' ),
			'parent' => $sticky_header_in_grid_container
		));

		startit_qode_add_admin_field(array(
			'name' => 'sticky_header_grid_transparency',
			'type' => 'text',
			'label' => esc_html__( 'Sticky Header Grid Transparency', 'startit' ),
			'description' => esc_html__( 'Enter transparency for sticky header grid (value from 0 to 1)', 'startit' ),
			'parent' => $sticky_header_in_grid_container,
			'args' => array(
				'col_width' => 1
			)
		));

		startit_qode_add_admin_field(array(
			'name' => 'sticky_header_background_color',
			'type' => 'color',
			'label' => esc_html__( 'Background Color', 'startit' ),
			'description' => esc_html__( 'Set background color for sticky header', 'startit' ),
			'parent' => $panel_sticky_header
		));

		startit_qode_add_admin_field(array(
			'name' => 'sticky_header_transparency',
			'type' => 'text',
			'label' => esc_html__( 'Sticky Header Transparency', 'startit' ),
			'description' => esc_html__( 'Enter transparency for sticky header (value from 0 to 1)', 'startit' ),
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 1
			)
		));

		startit_qode_add_admin_field(array(
			'name' => 'sticky_header_height',
			'type' => 'text',
			'label' => esc_html__( 'Sticky Header Height', 'startit' ),
			'description' => esc_html__( 'Enter height for sticky header (default is 60px)', 'startit' ),
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		$group_sticky_header_menu = startit_qode_add_admin_group(array(
			'title' => esc_html__( 'Sticky Header Menu', 'startit' ),
			'name' => 'group_sticky_header_menu',
			'parent' => $panel_sticky_header,
			'description' => esc_html__( 'Define styles for sticky menu items', 'startit' ),
		));

		$row1_sticky_header_menu = startit_qode_add_admin_row(array(
			'name' => 'row1',
			'parent' => $group_sticky_header_menu
		));

		startit_qode_add_admin_field(array(
			'name' => 'sticky_color',
			'type' => 'colorsimple',
			'label' => esc_html__( 'Text Color', 'startit' ),
			'description' => esc_html__( '', 'startit' ),
			'parent' => $row1_sticky_header_menu
		));

		startit_qode_add_admin_field(array(
			'name' => 'sticky_hovercolor',
			'type' => 'colorsimple',
			'label' => esc_html__( 'Hover/Active color', 'startit' ),
			'description' => esc_html__( '', 'startit' ),
			'parent' => $row1_sticky_header_menu
		));

		$row2_sticky_header_menu = startit_qode_add_admin_row(array(
			'name' => 'row2',
			'parent' => $group_sticky_header_menu
		));

		startit_qode_add_admin_field(
			array(
				'name' => 'sticky_google_fonts',
				'type' => 'fontsimple',
				'label' => esc_html__( 'Font Family', 'startit' ),
				'default_value' => '-1',
				'parent' => $row2_sticky_header_menu,
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_fontsize',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'default_value' => '',
				'parent' => $row2_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_lineheight',
				'label' => esc_html__( 'Line height', 'startit' ),
				'default_value' => '',
				'parent' => $row2_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_texttransform',
				'label' => esc_html__( 'Text transform', 'startit' ),
				'default_value' => '',
				'options' => startit_qode_get_text_transform_array(),
				'parent' => $row2_sticky_header_menu
			)
		);

		$row3_sticky_header_menu = startit_qode_add_admin_row(array(
			'name' => 'row3',
			'parent' => $group_sticky_header_menu
		));

		startit_qode_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_fontstyle',
				'default_value' => '',
				'label' => esc_html__( 'Font Style', 'startit' ),
				'options' => startit_qode_get_font_style_array(),
				'parent' => $row3_sticky_header_menu
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_fontweight',
				'default_value' => '',
				'label' => esc_html__( 'Font Weight', 'startit' ),
				'options' => startit_qode_get_font_weight_array(),
				'parent' => $row3_sticky_header_menu
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_letterspacing',
				'label' => esc_html__( 'Letter Spacing', 'startit' ),
				'default_value' => '',
				'parent' => $row3_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$panel_fixed_header = startit_qode_add_admin_panel(
			array(
				'title' => esc_html__( 'Fixed Header', 'startit' ),
				'name' => 'panel_fixed_header',
				'page' => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values' => array('sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up')
			)
		);

		startit_qode_add_admin_field(array(
			'name' => 'fixed_header_grid_background_color',
			'type' => 'color',
			'default_value' => '',
			'label' => esc_html__( 'Grid Background Color', 'startit' ),
			'description' => esc_html__( 'Set grid background color for fixed header', 'startit' ),
			'parent' => $panel_fixed_header
		));

		startit_qode_add_admin_field(array(
			'name' => 'fixed_header_grid_transparency',
			'type' => 'text',
			'default_value' => '',
			'label' => esc_html__( 'Header Transparency Grid', 'startit' ),
			'description' => esc_html__( 'Enter transparency for fixed header grid (value from 0 to 1)', 'startit' ),
			'parent' => $panel_fixed_header,
			'args' => array(
				'col_width' => 1
			)
		));

		startit_qode_add_admin_field(array(
			'name' => 'fixed_header_background_color',
			'type' => 'color',
			'default_value' => '',
			'label' => esc_html__( 'Background Color', 'startit' ),
			'description' => esc_html__( 'Set background color for fixed header', 'startit' ),
			'parent' => $panel_fixed_header
		));

		startit_qode_add_admin_field(array(
			'name' => 'fixed_header_transparency',
			'type' => 'text',
			'label' => esc_html__( 'Header Transparency', 'startit' ),
			'description' => esc_html__( 'Enter transparency for fixed header (value from 0 to 1)', 'startit' ),
			'parent' => $panel_fixed_header,
			'args' => array(
				'col_width' => 1
			)
		));


		$panel_main_menu = startit_qode_add_admin_panel(
			array(
				'title' => esc_html__( 'Main Menu', 'startit' ),
				'name' => 'panel_main_menu',
				'page' => '_header_page',
                'hidden_property' => 'header_type',
                'hidden_values' => array(
					'header-vertical',
					'header-full-screen'
				)
			)
		);

		startit_qode_add_admin_section_title(
			array(
				'parent' => $panel_main_menu,
				'name' => 'main_menu_area_title',
				'title' => esc_html__( 'Main Menu General Settings', 'startit' )
			)
		);


		startit_qode_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'select',
				'name' => 'menu_item_icon_position',
				'default_value' => 'left',
				'label' => esc_html__( 'Icon Position in 1st Level Menu', 'startit' ),
				'description' => esc_html__( 'Choose position of icon selected in Appearance->Menu->Menu Structure', 'startit' ),
				'options' => array(
					'left' => esc_html__('Left','startit' ),
					'top' => esc_html__('Top','startit' ),
				),
				'args' => array(
					'dependence' => true,
					'hide' => array(
						'left' => '#qodef_menu_item_icon_position_container'
					),
					'show' => array(
						'top' => '#qodef_menu_item_icon_position_container'
					)
				)
			)
		);

		$menu_item_icon_position_container = startit_qode_add_admin_container(
			array(
				'parent' => $panel_main_menu,
				'name' => 'menu_item_icon_position_container',
				'hidden_property' => 'menu_item_icon_position',
				'hidden_value' => 'left'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $menu_item_icon_position_container,
				'type' => 'text',
				'name' => 'menu_item_icon_size',
				'default_value' => '',
				'label' => esc_html__( 'Icon Size', 'startit' ),
				'description' => esc_html__( 'Choose position of icon selected in Appearance->Menu->Menu Structure', 'startit' ),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'select',
				'name' => 'menu_item_style',
				'default_value' => 'small_item',
				'label' => esc_html__( 'Item Height in 1st Level Menu', 'startit' ),
				'description' => esc_html__( 'Choose menu item height', 'startit' ),
				'options' => array(
					'small_item' => esc_html__('Small','startit' ),
					'large_item' => esc_html__('Big','startit' ),
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'yesno',
				'name' => 'enable_manu_item_border',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable 1st Level Menu Item Borders', 'startit' ),
				'description' => esc_html__( 'Enabling this option will display border around menu items', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_menu_item_border_container'
				)
			)
		);

		$menu_item_border_container = startit_qode_add_admin_container(
			array(
				'parent' => $panel_main_menu,
				'name' => 'menu_item_border_container',
				'hidden_property' => 'enable_manu_item_border',
				'hidden_value' => 'no'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $menu_item_border_container,
				'type' => 'select',
				'name' => 'menu_item_border_style',
				'default_value' => '',
				'label' => esc_html__( 'Menu Item Border', 'startit' ),
				'description' => esc_html__( 'Visible only if border width and one of the border color fields are filled.', 'startit' ),
				'options' => array(
					'all_borders' => esc_html__('All Borders','startit' ),
					'top_bottom_borders' => esc_html__('Top/Bottom Borders','startit' ),
					'right_border' => esc_html__('Right Border','startit' ),
					'bottom_border' => esc_html__('Bottom Border','startit' ),
					'bottom_border_double' => esc_html__('Bottom Double Borders','startit' )
				),
				'args' => array(
					'dependence' => true,
					'hide' => array(
						'bottom_border_double' => '#qodef_menu_item_border_width_container'
					),
					'show' => array(
						'all_borders' => '#qodef_menu_item_border_width_container',
						'top_bottom_borders' => '#qodef_menu_item_border_width_container',
						'right_border' => '#qodef_menu_item_border_width_container',
						'bottom_border' => '#qodef_menu_item_border_width_container'
					)
				)
			)
		);

		$menu_item_border_width_container = startit_qode_add_admin_container(
			array(
				'parent' => $menu_item_border_container,
				'name' => 'menu_item_border_style',
				'hidden_property' => 'enable_manu_item_border',
				'hidden_value' => 'bottom_border_double'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $menu_item_border_width_container,
				'type' => 'text',
				'name' => 'menu_item_border_width',
				'default_value' => '',
				'label' => esc_html__( 'Border Width', 'startit' ),
				'description' => esc_html__( 'Enter border width', 'startit' ),
				'args' => array(
					'suffix' => 'px',
					'col_width' => 3
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $menu_item_border_width_container,
				'type' => 'text',
				'name' => 'menu_item_border_radius',
				'default_value' => '',
				'label' => esc_html__( 'Border Radius', 'startit' ),
				'description' => esc_html__( 'Enter border radius', 'startit' ),
				'args' => array(
					'suffix' => 'px',
					'col_width' => 3
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $menu_item_border_width_container,
				'type' => 'select',
				'name' => 'menu_item_border_style_style',
				'default_value' => 'solid',
				'label' => esc_html__( 'Border Style', 'startit' ),
				'description' => esc_html__( 'Choose border style', 'startit' ),
				'options' => array(
					'solid' => esc_html__('Solid','startit' ),
					'dotted' => esc_html__('Dotted','startit' ),
					'dashed' => esc_html__('Dashed','startit' ),
				)
			)
		);

		$border_color_group = startit_qode_add_admin_group(
			array(
				'parent' => $menu_item_border_container,
				'name' => 'group_border_color',
				'title' => esc_html__( 'Border Color', 'startit' ),
				'description' => esc_html__( 'Choose a color for border', 'startit' )
			)
		);

		$border_color_row = startit_qode_add_admin_row(
			array(
				'parent' => $border_color_group,
				'name' => 'border_color_row'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $border_color_row,
				'type' => 'colorsimple',
				'name' => 'menu_item_border_color',
				'default_value' => '',
				'label' => esc_html__( 'Border Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $border_color_row,
				'type' => 'colorsimple',
				'name' => 'menu_item_hover_border_color',
				'default_value' => '',
				'label' => esc_html__( 'Border Hover Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $border_color_row,
				'type' => 'colorsimple',
				'name' => 'menu_item_active_border_color',
				'default_value' => '',
				'label' => esc_html__( 'Border Active Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'yesno',
				'name' => 'enable_menu_item_separators',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable 1st Level Menu Item Separators', 'startit' ),
				'description' => esc_html__( 'Enabling this option will display separators between menu items', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_menu_item_separators_container'
				)
			)
		);

		$menu_item_separators_container = startit_qode_add_admin_container(
			array(
				'parent' => $panel_main_menu,
				'name' => 'menu_item_separators_container',
				'hidden_property' => 'enable_menu_item_separators',
				'hidden_value' => 'no'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $menu_item_separators_container,
				'type' => 'color',
				'name' => 'menu_item_separators_color',
				'default_value' => '',
				'label' => esc_html__( 'Separators Color', 'startit' ),
				'description' => esc_html__( 'Enter separators color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'yesno',
				'name' => 'enable_menu_item_text_decoration',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable 1st Level Menu Item Text Decoration', 'startit' ),
				'description' => esc_html__( 'Enable this option and choose a text decoration for menu items in first level', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_menu_item_text_decoration_container'
				)
			)
		);

		$menu_item_text_decoration_container = startit_qode_add_admin_container(
			array(
				'parent' => $panel_main_menu,
				'name' => 'menu_item_text_decoration_container',
				'hidden_property' => 'enable_menu_item_text_decoration',
				'hidden_value' => 'no'
			)
		);

		$text_decoration_group = startit_qode_add_admin_group(
			array(
				'parent' => $menu_item_text_decoration_container,
				'name' => 'group_text_decoration',
				'title' => esc_html__( 'Menu Item Text Decoration', 'startit' ),
			)
		);

		$text_decoration_row = startit_qode_add_admin_row(
			array(
				'parent' => $text_decoration_group,
				'name' => 'text_decoration_row',
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $text_decoration_row,
				'type' => 'selectsimple',
				'name' => 'menu_item_text_decoration_style',
				'default_value' => 'none',
				'label' => esc_html__( 'Hover Item Text Decoration', 'startit' ),
				'description' => esc_html__( 'Choose text decoration type for hover menu items', 'startit' ),
				'options' => array(
					'none' => esc_html__('None','startit' ),
					'underline' => esc_html__('Underline','startit' ),
					'line-through' => esc_html__('Line-through','startit' ),
					'overline' => esc_html__('Overline','startit' ),
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $text_decoration_row,
				'type' => 'selectsimple',
				'name' => 'menu_item_active_text_decoration_style',
				'default_value' => 'none',
				'label' => esc_html__( 'Active Item Text Decoration', 'startit' ),
				'description' => esc_html__( 'Choose text decoration type for active menu items', 'startit' ),
				'options' => array(
					'none' => esc_html__('None','startit' ),
					'underline' => esc_html__('Underline','startit' ),
					'line-through' => esc_html__('Line-through','startit' ),
					'overline' => esc_html__('Overline','startit' )
				)
			)
		);

		$drop_down_group = startit_qode_add_admin_group(
			array(
				'parent' => $panel_main_menu,
				'name' => 'drop_down_group',
				'title' => esc_html__( 'Main Dropdown Menu', 'startit' ),
				'description' => esc_html__( 'Choose a color and transparency for the main menu background (0 = fully transparent, 1 = opaque)', 'startit' )
			)
		);

		$drop_down_row1 = startit_qode_add_admin_row(
			array(
				'parent' => $drop_down_group,
				'name' => 'drop_down_row1',
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $drop_down_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_background_color',
				'default_value' => '',
				'label' => esc_html__( 'Background Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $drop_down_row1,
				'type' => 'textsimple',
				'name' => 'dropdown_background_transparency',
				'default_value' => '',
				'label' => esc_html__( 'Transparency', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $drop_down_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_separator_color',
				'default_value' => '',
				'label' => esc_html__( 'Item Bottom Separator Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $drop_down_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_vertical_separator_color',
				'default_value' => '',
				'label' => esc_html__( 'Item Vertical Separator Color', 'startit' ),
			)
		);

		$drop_down_row2 = startit_qode_add_admin_row(
			array(
				'parent' => $drop_down_group,
				'name' => 'drop_down_row2',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $drop_down_row2,
				'type' => 'yesnosimple',
				'name' => 'enable_dropdown_separator_full_width',
				'default_value' => 'no',
				'label' => esc_html__( 'Item Separator Full Width', 'startit' ),
			)
		);

		$drop_down_padding_group = startit_qode_add_admin_group(
			array(
				'parent' => $panel_main_menu,
				'name' => 'drop_down_padding_group',
				'title' => esc_html__( 'Main Dropdown Menu Padding', 'startit' ),
				'description' => esc_html__( 'Choose a top/bottom padding for dropdown menu', 'startit' )
			)
		);

		$drop_down_padding_row = startit_qode_add_admin_row(
			array(
				'parent' => $drop_down_padding_group,
				'name' => 'drop_down_padding_row',
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $drop_down_padding_row,
				'type' => 'textsimple',
				'name' => 'dropdown_top_padding',
				'default_value' => '',
				'label' => esc_html__( 'Top Padding', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $drop_down_padding_row,
				'type' => 'textsimple',
				'name' => 'dropdown_bottom_padding',
				'default_value' => '',
				'label' => esc_html__( 'Bottom Padding', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'select',
				'name' => 'menu_dropdown_appearance',
				'default_value' => 'default',
				'label' => esc_html__( 'Main Dropdown Menu Appearance', 'startit' ),
				'description' => esc_html__( 'Choose appearance for dropdown menu', 'startit' ),
				'options' => array(
					'dropdown-default' => esc_html__('Default','startit' ),
					'dropdown-slide-from-bottom' => esc_html__('Slide From Bottom','startit' ),
					'dropdown-slide-from-top' => esc_html__('Slide From Top','startit' ),
					'dropdown-animate-height' => esc_html__('Animate Height','startit' ),
					'dropdown-slide-from-left' => esc_html__('Slide From Left','startit' ),
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'text',
				'name' => 'dropdown_top_position',
				'default_value' => '',
				'label' => esc_html__( 'Dropdown position', 'startit' ),
				'description' => esc_html__( 'Enter value in percentage of entire header height', 'startit' ),
				'args' => array(
					'col_width' => 3,
					'suffix' => '%'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'yesno',
				'name' => 'enable_dropdown_menu_item_icon',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable Arrow Icon for Dropdown Menu', 'startit' ),
				'description' => esc_html__( 'Enabling this option will display an arrow icon for 1st level menu items which have a dropdown menu', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'yesno',
				'name' => 'enable_dropdown_top_separator',
				'default_value' => 'yes',
				'label' => esc_html__( 'Enable Dropdown Top Separator', 'startit' ),
				'description' => esc_html__( 'Enabling this option will display top separator for second level in dropdown menu', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_dropdown_top_separator_container'
				)
			)
		);

		$enable_dropdown_top_separator_container = startit_qode_add_admin_container(
			array(
				'parent' => $panel_main_menu,
				'name' => 'enable_dropdown_top_separator_container',
				'hidden_property' => 'enable_dropdown_top_separator',
				'hidden_value' => 'no'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $enable_dropdown_top_separator_container,
				'type' => 'color',
				'name' => 'dropdown_top_separator_color',
				'default_value' => '',
				'label' => esc_html__( 'Dropdown Top Separator Color', 'startit' ),
				'description' => esc_html__( 'Choose color for top separator', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'yesno',
				'name' => 'dropdown_border_around',
				'default_value' => 'yes',
				'label' => esc_html__( 'Enable Dropdown Menu Border', 'startit' ),
				'description' => esc_html__( 'Enabling this option will display border around dropdown menu', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_dropdown_border_around_container'
				)
			)
		);

		$enable_dropdown_top_separator_container = startit_qode_add_admin_container(
			array(
				'parent' => $panel_main_menu,
				'name' => 'dropdown_border_around_container',
				'hidden_property' => 'dropdown_border_around',
				'hidden_value' => 'no'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $enable_dropdown_top_separator_container,
				'type' => 'color',
				'name' => 'dropdown_border_around_color',
				'default_value' => '',
				'label' => esc_html__( 'Dropdown Border Color', 'startit' ),
				'description' => esc_html__( 'Choose a color for border around dropdown menu', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'yesno',
				'name' => 'enable_wide_manu_background',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable Full Width Background for Wide Dropdown Type', 'startit' ),
				'description' => esc_html__( 'Enabling this option will show full width background  for wide dropdown type', 'startit' ),
			)
		);

		$first_level_group = startit_qode_add_admin_group(
			array(
				'parent' => $panel_main_menu,
				'name' => 'first_level_group',
				'title' => esc_html__( '1st Level Menu', 'startit' ),
				'description' => esc_html__( 'Define styles for 1st level in Top Navigation Menu', 'startit' )
			)
		);

		$first_level_row1 = startit_qode_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row1'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row1,
				'type' => 'colorsimple',
				'name' => 'menu_color',
				'default_value' => '',
				'label' => esc_html__( 'Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row1,
				'type' => 'colorsimple',
				'name' => 'menu_hovercolor',
				'default_value' => '',
				'label' => esc_html__( 'Hover Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row1,
				'type' => 'colorsimple',
				'name' => 'menu_activecolor',
				'default_value' => '',
				'label' => esc_html__( 'Active Text Color', 'startit' ),
			)
		);

		$first_level_row2 = startit_qode_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row2',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row2,
				'type' => 'colorsimple',
				'name' => 'menu_text_background_color',
				'default_value' => '',
				'label' => esc_html__( 'Text Background Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row2,
				'type' => 'colorsimple',
				'name' => 'menu_hover_background_color',
				'default_value' => '',
				'label' => esc_html__( 'Hover Text Background Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row2,
				'type' => 'colorsimple',
				'name' => 'menu_active_background_color',
				'default_value' => '',
				'label' => esc_html__( 'Active Text Background Color', 'startit' ),
			)
		);

		$first_level_row3 = startit_qode_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row3',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row3,
				'type' => 'colorsimple',
				'name' => 'menu_light_hovercolor',
				'default_value' => '',
				'label' => esc_html__( 'Light Menu Hover Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row3,
				'type' => 'colorsimple',
				'name' => 'menu_light_activecolor',
				'default_value' => '',
				'label' => esc_html__( 'Light Menu Active Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row3,
				'type' => 'colorsimple',
				'name' => 'menu_light_border_color',
				'default_value' => '',
				'label' => esc_html__( 'Light Menu Border Hover/Active Color', 'startit' ),
			)
		);

		$first_level_row4 = startit_qode_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row4',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row4,
				'type' => 'colorsimple',
				'name' => 'menu_dark_hovercolor',
				'default_value' => '',
				'label' => esc_html__( 'Dark Menu Hover Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row4,
				'type' => 'colorsimple',
				'name' => 'menu_dark_activecolor',
				'default_value' => '',
				'label' => esc_html__( 'Dark Menu Active Text Color', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row4,
				'type' => 'colorsimple',
				'name' => 'menu_dark_border_color',
				'default_value' => '',
				'label' => esc_html__( 'Dark Menu Border Hover/Active Color', 'startit' ),
			)
		);

		$first_level_row5 = startit_qode_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row5',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row5,
				'type' => 'fontsimple',
				'name' => 'menu_google_fonts',
				'default_value' => '-1',
				'label' => esc_html__( 'Font Family', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row5,
				'type' => 'textsimple',
				'name' => 'menu_fontsize',
				'default_value' => '',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row5,
				'type' => 'textsimple',
				'name' => 'menu_hover_background_color_transparency',
				'default_value' => '',
				'label' => esc_html__( 'Hover Background Color Transparency', 'startit' ),
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row5,
				'type' => 'textsimple',
				'name' => 'menu_active_background_color_transparency',
				'default_value' => '',
				'label' => esc_html__( 'Active Background Color Transparency', 'startit' ),
			)
		);

		$first_level_row6 = startit_qode_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row6',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row6,
				'type' => 'selectblanksimple',
				'name' => 'menu_fontstyle',
				'default_value' => '',
				'label' => esc_html__( 'Font Style', 'startit' ),
				'options' => startit_qode_get_font_style_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row6,
				'type' => 'selectblanksimple',
				'name' => 'menu_fontweight',
				'default_value' => '',
				'label' => esc_html__( 'Font Weight', 'startit' ),
				'options' => startit_qode_get_font_weight_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row6,
				'type' => 'textsimple',
				'name' => 'menu_letterspacing',
				'default_value' => '',
				'label' => esc_html__( 'Letter Spacing', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row6,
				'type' => 'selectblanksimple',
				'name' => 'menu_texttransform',
				'default_value' => '',
				'label' => esc_html__( 'Text Transform', 'startit' ),
				'options' => startit_qode_get_text_transform_array()
			)
		);

		$first_level_row7 = startit_qode_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row7',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row7,
				'type' => 'textsimple',
				'name' => 'menu_lineheight',
				'default_value' => '',
				'label' => esc_html__( 'Line Height', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row7,
				'type' => 'textsimple',
				'name' => 'menu_padding_left_right',
				'default_value' => '',
				'label' => esc_html__( 'Padding Left/Right', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $first_level_row7,
				'type' => 'textsimple',
				'name' => 'menu_margin_left_right',
				'default_value' => '',
				'label' => esc_html__( 'Margin Left/Right', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_group = startit_qode_add_admin_group(
			array(
				'parent' => $panel_main_menu,
				'name' => 'second_level_group',
				'title' => esc_html__( '2nd Level Menu', 'startit' ),
				'description' => esc_html__( 'Define styles for 2nd level in Top Navigation Menu', 'startit' )
			)
		);

		$second_level_row1 = startit_qode_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row1'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_color',
				'default_value' => '',
				'label' => esc_html__( 'Text Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_hovercolor',
				'default_value' => '',
				'label' => esc_html__( 'Hover/Active Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_background_hovercolor',
				'default_value' => '',
				'label' => esc_html__( 'Hover/Active Background Color', 'startit' )
			)
		);

		$second_level_row2 = startit_qode_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row2',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_row2,
				'type' => 'fontsimple',
				'name' => 'dropdown_google_fonts',
				'default_value' => '-1',
				'label' => esc_html__( 'Font Family', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_row2,
				'type' => 'textsimple',
				'name' => 'dropdown_fontsize',
				'default_value' => '',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_row2,
				'type' => 'textsimple',
				'name' => 'dropdown_lineheight',
				'default_value' => '',
				'label' => esc_html__( 'Line Height', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_row2,
				'type' => 'textsimple',
				'name' => 'dropdown_padding_top_bottom',
				'default_value' => '',
				'label' => esc_html__( 'Padding Top/Bottom', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_row3 = startit_qode_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row3',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_fontstyle',
				'default_value' => '',
				'label' => esc_html__( 'Font style', 'startit' ),
				'options' => startit_qode_get_font_style_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_fontweight',
				'default_value' => '',
				'label' => esc_html__( 'Font weight', 'startit' ),
				'options' => startit_qode_get_font_weight_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_row3,
				'type' => 'textsimple',
				'name' => 'dropdown_letterspacing',
				'default_value' => '',
				'label' => esc_html__( 'Letter spacing', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_texttransform',
				'default_value' => '',
				'label' => esc_html__( 'Text Transform', 'startit' ),
				'options' => startit_qode_get_text_transform_array()
			)
		);

		$second_level_wide_group = startit_qode_add_admin_group(
			array(
				'parent' => $panel_main_menu,
				'name' => 'second_level_wide_group',
				'title' => esc_html__( '2nd Level Wide Menu', 'startit' ),
				'description' => esc_html__( 'Define styles for 2nd level in Wide Menu', 'startit' )
			)
		);

		$second_level_wide_row1 = startit_qode_add_admin_row(
			array(
				'parent' => $second_level_wide_group,
				'name' => 'second_level_wide_row1'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_wide_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_wide_color',
				'default_value' => '',
				'label' => esc_html__( 'Text Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_wide_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_wide_hovercolor',
				'default_value' => '',
				'label' => esc_html__( 'Hover/Active Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_wide_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_wide_background_hovercolor',
				'default_value' => '',
				'label' => esc_html__( 'Hover/Active Background Color', 'startit' )
			)
		);

		$second_level_wide_row2 = startit_qode_add_admin_row(
			array(
				'parent' => $second_level_wide_group,
				'name' => 'second_level_wide_row2',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_wide_row2,
				'type' => 'fontsimple',
				'name' => 'dropdown_wide_google_fonts',
				'default_value' => '-1',
				'label' => esc_html__( 'Font Family', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_wide_row2,
				'type' => 'textsimple',
				'name' => 'dropdown_wide_fontsize',
				'default_value' => '',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_wide_row2,
				'type' => 'textsimple',
				'name' => 'dropdown_wide_lineheight',
				'default_value' => '',
				'label' => esc_html__( 'Line Height', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_wide_row2,
				'type' => 'textsimple',
				'name' => 'dropdown_wide_padding_top_bottom',
				'default_value' => '',
				'label' => esc_html__( 'Padding Top/Bottom', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_wide_row3 = startit_qode_add_admin_row(
			array(
				'parent' => $second_level_wide_group,
				'name' => 'second_level_wide_row3',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_wide_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_wide_fontstyle',
				'default_value' => '',
				'label' => esc_html__( 'Font style', 'startit' ),
				'options' => startit_qode_get_font_style_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_wide_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_wide_fontweight',
				'default_value' => '',
				'label' => esc_html__( 'Font weight', 'startit' ),
				'options' => startit_qode_get_font_weight_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_wide_row3,
				'type' => 'textsimple',
				'name' => 'dropdown_wide_letterspacing',
				'default_value' => '',
				'label' => esc_html__( 'Letter spacing', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $second_level_wide_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_wide_texttransform',
				'default_value' => '',
				'label' => esc_html__( 'Text Transform', 'startit' ),
				'options' => startit_qode_get_text_transform_array()
			)
		);

		$third_level_group = startit_qode_add_admin_group(
			array(
				'parent' => $panel_main_menu,
				'name' => 'third_level_group',
				'title' => esc_html__( '3nd Level Menu', 'startit' ),
				'description' => esc_html__( 'Define styles for 3nd level in Top Navigation Menu', 'startit' )
			)
		);

		$third_level_row1 = startit_qode_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name' => 'third_level_row1'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_color_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Text Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_hovercolor_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Hover/Active Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_background_hovercolor_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Hover/Active Background Color', 'startit' )
			)
		);

		$third_level_row2 = startit_qode_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name' => 'third_level_row2',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_row2,
				'type' => 'fontsimple',
				'name' => 'dropdown_google_fonts_thirdlvl',
				'default_value' => '-1',
				'label' => esc_html__( 'Font Family', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_row2,
				'type' => 'textsimple',
				'name' => 'dropdown_fontsize_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_row2,
				'type' => 'textsimple',
				'name' => 'dropdown_lineheight_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Line Height', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_row3 = startit_qode_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name' => 'third_level_row3',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_fontstyle_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Font style', 'startit' ),
				'options' => startit_qode_get_font_style_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_fontweight_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Font weight', 'startit' ),
				'options' => startit_qode_get_font_weight_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_row3,
				'type' => 'textsimple',
				'name' => 'dropdown_letterspacing_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Letter spacing', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_texttransform_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Text Transform', 'startit' ),
				'options' => startit_qode_get_text_transform_array()
			)
		);


		/***********************************************************/
		$third_level_wide_group = startit_qode_add_admin_group(
			array(
				'parent' => $panel_main_menu,
				'name' => 'third_level_wide_group',
				'title' => esc_html__( '3rd Level Wide Menu', 'startit' ),
				'description' => esc_html__( 'Define styles for 3rd level in Wide Menu', 'startit' )
			)
		);

		$third_level_wide_row1 = startit_qode_add_admin_row(
			array(
				'parent' => $third_level_wide_group,
				'name' => 'third_level_wide_row1'
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_wide_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_wide_color_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Text Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_wide_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_wide_hovercolor_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Hover/Active Color', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_wide_row1,
				'type' => 'colorsimple',
				'name' => 'dropdown_wide_background_hovercolor_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Hover/Active Background Color', 'startit' )
			)
		);

		$third_level_wide_row2 = startit_qode_add_admin_row(
			array(
				'parent' => $third_level_wide_group,
				'name' => 'third_level_wide_row2',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_wide_row2,
				'type' => 'fontsimple',
				'name' => 'dropdown_wide_google_fonts_thirdlvl',
				'default_value' => '-1',
				'label' => esc_html__( 'Font Family', 'startit' )
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_wide_row2,
				'type' => 'textsimple',
				'name' => 'dropdown_wide_fontsize_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Font Size', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_wide_row2,
				'type' => 'textsimple',
				'name' => 'dropdown_wide_lineheight_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Line Height', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_wide_row3 = startit_qode_add_admin_row(
			array(
				'parent' => $third_level_wide_group,
				'name' => 'third_level_wide_row3',
				'next' => true
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_wide_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_wide_fontstyle_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Font style', 'startit' ),
				'options' => startit_qode_get_font_style_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_wide_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_wide_fontweight_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Font weight', 'startit' ),
				'options' => startit_qode_get_font_weight_array()
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_wide_row3,
				'type' => 'textsimple',
				'name' => 'dropdown_wide_letterspacing_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Letter spacing', 'startit' ),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $third_level_wide_row3,
				'type' => 'selectblanksimple',
				'name' => 'dropdown_wide_texttransform_thirdlvl',
				'default_value' => '',
				'label' => esc_html__( 'Text Transform', 'startit' ),
				'options' => startit_qode_get_text_transform_array()
			)
		);

        $panel_vertical_main_menu = startit_qode_add_admin_panel(
            array(
                'title' => esc_html__( 'Vertical Main Menu', 'startit' ),
                'name' => 'panel_vertical_main_menu',
                'page' => '_header_page',
                'hidden_property' => 'header_type',
                'hidden_values' => array(
					'header-standard',
					'header-overlapping',
					'header-full-screen'
				)
            )
        );

        $drop_down_group = startit_qode_add_admin_group(
            array(
                'parent' => $panel_vertical_main_menu,
                'name' => 'vertical_drop_down_group',
                'title' => esc_html__( 'Main Dropdown Menu', 'startit' ),
                'description' => esc_html__( 'Set a style for dropdown menu', 'startit' )
            )
        );

        $vertical_drop_down_row1 = startit_qode_add_admin_row(
            array(
                'parent' => $drop_down_group,
                'name' => 'qodef_drop_down_row1',
            )
        );

        startit_qode_add_admin_field(
            array(
                'parent' => $vertical_drop_down_row1,
                'type' => 'colorsimple',
                'name' => 'vertical_dropdown_background_color',
                'default_value' => '',
                'label' => esc_html__( 'Background Color', 'startit' ),
            )
        );

        startit_qode_add_admin_field(
            array(
                'name' => 'vertical_dropdown_disable_expanding_icons',
                'type' => 'yesnosimple',
                'default_value' => 'no',
                'label' => esc_html__( 'Disable "+/-" Signs in Vertical Menu','startit'),
                'description' => esc_html__( 'Disable +/- signs for vertical menu in all levels.','startit'),
                'parent' => $vertical_drop_down_row1
            )
        );

        $vertical_drop_down_row2 = startit_qode_add_admin_row(
            array(
                'parent' => $drop_down_group,
                'name' => 'qodef_drop_down_row2',
            )
        );

        startit_qode_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'vertical_dropdown_padding_tb',
            'default_value'	=> '',
            'label' => esc_html__( 'Padding Top/Bottom', 'startit' ),
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $vertical_drop_down_row2
        ));

        startit_qode_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'vertical_dropdown_padding_lr',
            'default_value'	=> '',
            'label' => esc_html__( 'Padding Left/Right', 'startit' ),
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $vertical_drop_down_row2
        ));

        $group_vertical_first_level = startit_qode_add_admin_group(array(
            'name'			=> 'group_vertical_first_level',
            'title' => esc_html__( '1st level', 'startit' ),
            'description' => esc_html__( 'Define styles for 1st level menu', 'startit' ),
            'parent'		=> $panel_vertical_main_menu
        ));

            $row_vertical_first_level_1 = startit_qode_add_admin_row(array(
                'name'		=> 'row_vertical_first_level_1',
                'parent'	=> $group_vertical_first_level
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'colorsimple',
                'name'			=> 'vertical_menu_1st_color',
                'default_value'	=> '',
                'label' => esc_html__( 'Text Color', 'startit' ),
                'parent'		=> $row_vertical_first_level_1
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'colorsimple',
                'name'			=> 'vertical_menu_1st_hover_color',
                'default_value'	=> '',
                'label' => esc_html__( 'Hover/Active Color', 'startit' ),
                'parent'		=> $row_vertical_first_level_1
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_1st_fontsize',
                'default_value'	=> '',
                'label' => esc_html__( 'Font Size', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_first_level_1
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_1st_lineheight',
                'default_value'	=> '',
                'label' => esc_html__( 'Line Height', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_first_level_1
            ));

            $row_vertical_first_level_2 = startit_qode_add_admin_row(array(
                'name'		=> 'row_vertical_first_level_2',
                'parent'	=> $group_vertical_first_level,
                'next'		=> true
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'selectblanksimple',
                'name'			=> 'vertical_menu_1st_texttransform',
                'default_value'	=> '',
                'label' => esc_html__( 'Text Transform', 'startit' ),
                'options'		=> startit_qode_get_text_transform_array(),
                'parent'		=> $row_vertical_first_level_2
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'fontsimple',
                'name'			=> 'vertical_menu_1st_google_fonts',
                'default_value'	=> '-1',
                'label' => esc_html__( 'Font Family', 'startit' ),
                'parent'		=> $row_vertical_first_level_2
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'selectblanksimple',
                'name'			=> 'vertical_menu_1st_fontstyle',
                'default_value'	=> '',
                'label' => esc_html__( 'Font Style', 'startit' ),
                'options'		=> startit_qode_get_font_style_array(),
                'parent'		=> $row_vertical_first_level_2
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'selectblanksimple',
                'name'			=> 'vertical_menu_1st_fontweight',
                'default_value'	=> '',
                'label' => esc_html__( 'Font Weight', 'startit' ),
                'options'		=> startit_qode_get_font_weight_array(),
                'parent'		=> $row_vertical_first_level_2
            ));

            $row_vertical_first_level_3 = startit_qode_add_admin_row(array(
                'name'		=> 'row_vertical_first_level_3',
                'parent'	=> $group_vertical_first_level,
                'next'		=> true
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_1st_letter_spacing',
                'default_value'	=> '',
                'label' => esc_html__( 'Letter Spacing', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_first_level_3
            ));

        $group_vertical_second_level = startit_qode_add_admin_group(array(
            'name'			=> 'group_vertical_second_level',
            'title' => esc_html__( '2nd level', 'startit' ),
            'description' => esc_html__( 'Define styles for 2nd level menu', 'startit' ),
            'parent'		=> $panel_vertical_main_menu
        ));

            $row_vertical_second_level_1 = startit_qode_add_admin_row(array(
                'name'		=> 'row_vertical_second_level_1',
                'parent'	=> $group_vertical_second_level
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'colorsimple',
                'name'			=> 'vertical_menu_2nd_color',
                'default_value'	=> '',
                'label' => esc_html__( 'Text Color', 'startit' ),
                'parent'		=> $row_vertical_second_level_1
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'colorsimple',
                'name'			=> 'vertical_menu_2nd_hover_color',
                'default_value'	=> '',
                'label' => esc_html__( 'Hover/Active Color', 'startit' ),
                'parent'		=> $row_vertical_second_level_1
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_2nd_fontsize',
                'default_value'	=> '',
                'label' => esc_html__( 'Font Size', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_second_level_1
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_2nd_lineheight',
                'default_value'	=> '',
                'label' => esc_html__( 'Line Height', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_second_level_1
            ));

            $row_vertical_second_level_2 = startit_qode_add_admin_row(array(
                'name'		=> 'row_vertical_second_level_2',
                'parent'	=> $group_vertical_second_level,
                'next'		=> true
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'selectblanksimple',
                'name'			=> 'vertical_menu_2nd_texttransform',
                'default_value'	=> '',
                'label' => esc_html__( 'Text Transform', 'startit' ),
                'options'		=> startit_qode_get_text_transform_array(),
                'parent'		=> $row_vertical_second_level_2
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'fontsimple',
                'name'			=> 'vertical_menu_2nd_google_fonts',
                'default_value'	=> '-1',
                'label' => esc_html__( 'Font Family', 'startit' ),
                'parent'		=> $row_vertical_second_level_2
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'selectblanksimple',
                'name'			=> 'vertical_menu_2nd_fontstyle',
                'default_value'	=> '',
                'label' => esc_html__( 'Font Style', 'startit' ),
                'options'		=> startit_qode_get_font_style_array(),
                'parent'		=> $row_vertical_second_level_2
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'selectblanksimple',
                'name'			=> 'vertical_menu_2nd_fontweight',
                'default_value'	=> '',
                'label' => esc_html__( 'Font Weight', 'startit' ),
                'options'		=> startit_qode_get_font_weight_array(),
                'parent'		=> $row_vertical_second_level_2
            ));

            $row_vertical_second_level_3 = startit_qode_add_admin_row(array(
                'name'		=> 'row_vertical_second_level_3',
                'parent'	=> $group_vertical_second_level,
                'next'		=> true
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_2nd_letter_spacing',
                'default_value'	=> '',
                'label' => esc_html__( 'Letter Spacing', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_second_level_3
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_2nd_padding_tb',
                'default_value'	=> '',
                'label' => esc_html__( 'Padding Top/Bottom', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_second_level_3
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_2nd_padding_lr',
                'default_value'	=> '',
                'label' => esc_html__( 'Padding Left/Right', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_second_level_3
            ));

        $group_vertical_third_level = startit_qode_add_admin_group(array(
            'name'			=> 'group_vertical_third_level',
            'title' => esc_html__( '3rd level', 'startit' ),
            'description' => esc_html__( 'Define styles for 3rd level menu', 'startit' ),
            'parent'		=> $panel_vertical_main_menu
        ));

            $row_vertical_third_level_1 = startit_qode_add_admin_row(array(
                'name'		=> 'row_vertical_third_level_1',
                'parent'	=> $group_vertical_third_level
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'colorsimple',
                'name'			=> 'vertical_menu_3rd_color',
                'default_value'	=> '',
                'label' => esc_html__( 'Text Color', 'startit' ),
                'parent'		=> $row_vertical_third_level_1
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'colorsimple',
                'name'			=> 'vertical_menu_3rd_hover_color',
                'default_value'	=> '',
                'label' => esc_html__( 'Hover/Active Color', 'startit' ),
                'parent'		=> $row_vertical_third_level_1
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_3rd_fontsize',
                'default_value'	=> '',
                'label' => esc_html__( 'Font Size', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_third_level_1
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_3rd_lineheight',
                'default_value'	=> '',
                'label' => esc_html__( 'Line Height', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_third_level_1
            ));

            $row_vertical_third_level_2 = startit_qode_add_admin_row(array(
                'name'		=> 'row_vertical_third_level_2',
                'parent'	=> $group_vertical_third_level,
                'next'		=> true
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'selectblanksimple',
                'name'			=> 'vertical_menu_3rd_texttransform',
                'default_value'	=> '',
                'label' => esc_html__( 'Text Transform', 'startit' ),
                'options'		=> startit_qode_get_text_transform_array(),
                'parent'		=> $row_vertical_third_level_2
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'fontsimple',
                'name'			=> 'vertical_menu_3rd_google_fonts',
                'default_value'	=> '-1',
                'label' => esc_html__( 'Font Family', 'startit' ),
                'parent'		=> $row_vertical_third_level_2
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'selectblanksimple',
                'name'			=> 'vertical_menu_3rd_fontstyle',
                'default_value'	=> '',
                'label' => esc_html__( 'Font Style', 'startit' ),
                'options'		=> startit_qode_get_font_style_array(),
                'parent'		=> $row_vertical_third_level_2
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'selectblanksimple',
                'name'			=> 'vertical_menu_3rd_fontweight',
                'default_value'	=> '',
                'label' => esc_html__( 'Font Weight', 'startit' ),
                'options'		=> startit_qode_get_font_weight_array(),
                'parent'		=> $row_vertical_third_level_2
            ));

            $row_vertical_third_level_3 = startit_qode_add_admin_row(array(
                'name'		=> 'row_vertical_third_level_3',
                'parent'	=> $group_vertical_third_level,
                'next'		=> true
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_3rd_letter_spacing',
                'default_value'	=> '',
                'label' => esc_html__( 'Letter Spacing', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_third_level_3
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_3rd_padding_tb',
                'default_value'	=> '',
                'label' => esc_html__( 'Padding Top/Bottom', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_third_level_3
            ));

            startit_qode_add_admin_field(array(
                'type'			=> 'textsimple',
                'name'			=> 'vertical_menu_3rd_padding_lr',
                'default_value'	=> '',
                'label' => esc_html__( 'Padding Left/Right', 'startit' ),
                'args'			=> array(
                    'suffix'	=> 'px'
                ),
                'parent'		=> $row_vertical_third_level_3
            ));
	}

	add_action( 'qode_startit_options_map', 'startit_qode_header_options_map', 3);

}