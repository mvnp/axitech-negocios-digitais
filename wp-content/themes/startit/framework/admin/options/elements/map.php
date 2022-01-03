<?php

if ( ! function_exists( 'startit_qode_elements_map' ) ) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function startit_qode_elements_map() {

		startit_qode_add_admin_page(
			array(
				'slug' => '_elements_page',
				'title' => 'Elements',
				'icon' => 'fa fa-diamond'
			)
		);

		//accordion

		$panel = startit_qode_add_admin_panel(array(
           'title' => 'Accordions',
           'name'  => 'panel_accordions',
           'page'  => '_elements_page'
       ));

       //Typography options
       startit_qode_add_admin_section_title(array(
           'name' => 'typography_section_title',
           'title' => 'Typography',			
           'parent' => $panel
       ));

       $typography_group = startit_qode_add_admin_group(array(
           'name' => 'typography_group',
           'title' => 'Typography',
			'description' => 'Setup typography for accordions navigation',
           'parent' => $panel
       ));

       $typography_row = startit_qode_add_admin_row(array(
           'name' => 'typography_row',
           'next' => true,
           'parent' => $typography_group
       ));

       startit_qode_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'fontsimple',
           'name'          => 'accordions_font_family',
           'default_value' => '',
           'label'         => 'Font Family',
       ));

       startit_qode_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'selectsimple',
           'name'          => 'accordions_text_transform',
           'default_value' => '',
           'label'         => 'Text Transform',
           'options'       => startit_qode_get_text_transform_array()
       ));

       startit_qode_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'selectsimple',
           'name'          => 'accordions_font_style',
           'default_value' => '',
           'label'         => 'Font Style',
           'options'       => startit_qode_get_font_style_array()
       ));

       startit_qode_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'textsimple',
           'name'          => 'accordions_letter_spacing',
           'default_value' => '',
           'label'         => 'Letter Spacing',
           'args'          => array(
               'suffix' => 'px'
           )
       ));

       $typography_row2 = startit_qode_add_admin_row(array(
           'name' => 'typography_row2',
           'next' => true,
           'parent' => $typography_group
       ));		
		
       startit_qode_add_admin_field(array(
           'parent'        => $typography_row2,
           'type'          => 'selectsimple',
           'name'          => 'accordions_font_weight',
           'default_value' => '',
           'label'         => 'Font Weight',
           'options'       => startit_qode_get_font_weight_array()
       ));
		
		//Initial Accordion Color Styles
		
		startit_qode_add_admin_section_title(array(
           'name' => 'accordion_color_section_title',
           'title' => 'Basic Accordions Color Styles',			
           'parent' => $panel
       ));
		
		$accordions_color_group = startit_qode_add_admin_group(array(
           'name' => 'accordions_color_group',
           'title' => 'Accordion Color Styles',
			'description' => 'Set color styles for accordion title',
           'parent' => $panel
       ));
		$accordions_color_row = startit_qode_add_admin_row(array(
           'name' => 'accordions_color_row',
           'next' => true,
           'parent' => $accordions_color_group
       ));
		startit_qode_add_admin_field(array(
           'parent'        => $accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_title_color',
           'default_value' => '',
           'label'         => 'Title Color'
       ));
		startit_qode_add_admin_field(array(
           'parent'        => $accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_icon_color',
           'default_value' => '',
           'label'         => 'Icon Color'
       ));
		startit_qode_add_admin_field(array(
           'parent'        => $accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_icon_back_color',
           'default_value' => '',
           'label'         => 'Icon Background Color'
       ));
		
		$active_accordions_color_group = startit_qode_add_admin_group(array(
           'name' => 'active_accordions_color_group',
           'title' => 'Active and Hover Accordion Color Styles',
			'description' => 'Set color styles for active and hover accordions',
           'parent' => $panel
       ));
		$active_accordions_color_row = startit_qode_add_admin_row(array(
           'name' => 'active_accordions_color_row',
           'next' => true,
           'parent' => $active_accordions_color_group
       ));
		startit_qode_add_admin_field(array(
           'parent'        => $active_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_title_color_active',
           'default_value' => '',
           'label'         => 'Title Color'
       ));
		startit_qode_add_admin_field(array(
           'parent'        => $active_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_icon_color_active',
           'default_value' => '',
           'label'         => 'Icon Color'
       ));
		startit_qode_add_admin_field(array(
           'parent'        => $active_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_icon_back_color_active',
           'default_value' => '',
           'label'         => 'Icon Background Color'
       ));
		
		//Boxed Accordion Color Styles
		
		startit_qode_add_admin_section_title(array(
           'name' => 'boxed_accordion_color_section_title',
           'title' => 'Boxed Accordion Title Color Styles',			
           'parent' => $panel
       ));
		$boxed_accordions_color_group = startit_qode_add_admin_group(array(
           'name' => 'boxed_accordions_color_group',
           'title' => 'Boxed Accordion Title Color Styles',
			'description' => 'Set color styles for boxed accordion title',
           'parent' => $panel
       ));
		$boxed_accordions_color_row = startit_qode_add_admin_row(array(
           'name' => 'boxed_accordions_color_row',
           'next' => true,
           'parent' => $boxed_accordions_color_group
       ));

       startit_qode_add_admin_field(array(
           'parent'        => $boxed_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'boxed_accordions_color',
           'default_value' => '',
           'label'         => 'Color'
       ));
		startit_qode_add_admin_field(array(
           'parent'        => $boxed_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'boxed_accordions_back_color',
           'default_value' => '',
           'label'         => 'Background Color'
       ));
		startit_qode_add_admin_field(array(
           'parent'        => $boxed_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'boxed_accordions_border_color',
           'default_value' => '',
           'label'         => 'Border Color'
       ));
		
		//Active Boxed Accordion Color Styles
		
      $active_boxed_accordions_color_group = startit_qode_add_admin_group(array(
           'name' => 'active_boxed_accordions_color_group',
           'title' => 'Active and Hover Title Color Styles',
			'description' => 'Set color styles for active and hover accordions',
           'parent' => $panel
       ));
		$active_boxed_accordions_color_row = startit_qode_add_admin_row(array(
           'name' => 'active_boxed_accordions_color_row',
           'next' => true,
           'parent' => $active_boxed_accordions_color_group
       ));

       startit_qode_add_admin_field(array(
           'parent'        => $active_boxed_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'boxed_accordions_color_active',
           'default_value' => '',
           'label'         => 'Color'
       ));
		startit_qode_add_admin_field(array(
           'parent'        => $active_boxed_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'boxed_accordions_back_color_active',
           'default_value' => '',
           'label'         => 'Background Color'
       ));
		startit_qode_add_admin_field(array(
           'parent'        => $active_boxed_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'boxed_accordions_border_color_active',
           'default_value' => '',
           'label'         => 'Border Color'
       ));

	   //button

	   $panel = startit_qode_add_admin_panel(array(
            'title' => 'Button',
            'name'  => 'panel_button',
            'page'  => '_elements_page'
        ));

        //Typography options
        startit_qode_add_admin_section_title(array(
            'name' => 'typography_section_title',
            'title' => 'Typography',
            'parent' => $panel
        ));

        $typography_group = startit_qode_add_admin_group(array(
            'name' => 'typography_group',
            'title' => 'Typography',
            'description' => 'Setup typography for all button types',
            'parent' => $panel
        ));

        $typography_row = startit_qode_add_admin_row(array(
            'name' => 'typography_row',
            'next' => true,
            'parent' => $typography_group
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'fontsimple',
            'name'          => 'button_font_family',
            'default_value' => '',
            'label'         => 'Font Family',
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'selectsimple',
            'name'          => 'button_text_transform',
            'default_value' => '',
            'label'         => 'Text Transform',
            'options'       => startit_qode_get_text_transform_array()
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'selectsimple',
            'name'          => 'button_font_style',
            'default_value' => '',
            'label'         => 'Font Style',
            'options'       => startit_qode_get_font_style_array()
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'textsimple',
            'name'          => 'button_letter_spacing',
            'default_value' => '',
            'label'         => 'Letter Spacing',
            'args'          => array(
                'suffix' => 'px'
            )
        ));

        $typography_row2 = startit_qode_add_admin_row(array(
            'name' => 'typography_row2',
            'next' => true,
            'parent' => $typography_group
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $typography_row2,
            'type'          => 'selectsimple',
            'name'          => 'button_font_weight',
            'default_value' => '',
            'label'         => 'Font Weight',
            'options'       => startit_qode_get_font_weight_array()
        ));

        //Outline type options
        startit_qode_add_admin_section_title(array(
            'name' => 'type_section_title',
            'title' => 'Types',
            'parent' => $panel
        ));

        $outline_group = startit_qode_add_admin_group(array(
            'name' => 'outline_group',
            'title' => 'Outline Type',
            'description' => 'Setup outline button type',
            'parent' => $panel
        ));

        $outline_row = startit_qode_add_admin_row(array(
            'name' => 'outline_row',
            'next' => true,
            'parent' => $outline_group
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $outline_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_outline_text_color',
            'default_value' => '',
            'label'         => 'Text Color',
            'description'   => ''
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $outline_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_outline_hover_text_color',
            'default_value' => '',
            'label'         => 'Text Hover Color',
            'description'   => ''
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $outline_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_outline_hover_bg_color',
            'default_value' => '',
            'label'         => 'Hover Background Color',
            'description'   => ''
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $outline_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_outline_border_color',
            'default_value' => '',
            'label'         => 'Border Color',
            'description'   => ''
        ));

        $outline_row2 = startit_qode_add_admin_row(array(
            'name' => 'outline_row2',
            'next' => true,
            'parent' => $outline_group
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $outline_row2,
            'type'          => 'colorsimple',
            'name'          => 'btn_outline_hover_border_color',
            'default_value' => '',
            'label'         => 'Hover Border Color',
            'description'   => ''
        ));

        //Solid type options
        $solid_group = startit_qode_add_admin_group(array(
            'name' => 'solid_group',
            'title' => 'Solid Type',
            'description' => 'Setup solid button type',
            'parent' => $panel
        ));

        $solid_row = startit_qode_add_admin_row(array(
            'name' => 'solid_row',
            'next' => true,
            'parent' => $solid_group
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $solid_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_solid_text_color',
            'default_value' => '',
            'label'         => 'Text Color',
            'description'   => ''
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $solid_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_solid_hover_text_color',
            'default_value' => '',
            'label'         => 'Text Hover Color',
            'description'   => ''
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $solid_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_solid_bg_color',
            'default_value' => '',
            'label'         => 'Background Color',
            'description'   => ''
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $solid_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_solid_hover_bg_color',
            'default_value' => '',
            'label'         => 'Hover Background Color',
            'description'   => ''
        ));

        $solid_row2 = startit_qode_add_admin_row(array(
            'name' => 'solid_row2',
            'next' => true,
            'parent' => $solid_group
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $solid_row2,
            'type'          => 'colorsimple',
            'name'          => 'btn_solid_border_color',
            'default_value' => '',
            'label'         => 'Border Color',
            'description'   => ''
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $solid_row2,
            'type'          => 'colorsimple',
            'name'          => 'btn_solid_hover_border_color',
            'default_value' => '',
            'label'         => 'Hover Border Color',
            'description'   => ''
        ));

		//tabs

		$panel = startit_qode_add_admin_panel(array(
            'title' => 'Tabs',
            'name'  => 'panel_tabs',
            'page'  => '_elements_page'
        ));

        //Typography options
        startit_qode_add_admin_section_title(array(
            'name' => 'typography_section_title',
            'title' => 'Tabs Navigation Typography',			
            'parent' => $panel
        ));

        $typography_group = startit_qode_add_admin_group(array(
            'name' => 'typography_group',
            'title' => 'Tabs Navigation Typography',
			'description' => 'Setup typography for tabs navigation',
            'parent' => $panel
        ));

        $typography_row = startit_qode_add_admin_row(array(
            'name' => 'typography_row',
            'next' => true,
            'parent' => $typography_group
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'fontsimple',
            'name'          => 'tabs_font_family',
            'default_value' => '',
            'label'         => 'Font Family',
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'selectsimple',
            'name'          => 'tabs_text_transform',
            'default_value' => '',
            'label'         => 'Text Transform',
            'options'       => startit_qode_get_text_transform_array()
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'selectsimple',
            'name'          => 'tabs_font_style',
            'default_value' => '',
            'label'         => 'Font Style',
            'options'       => startit_qode_get_font_style_array()
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'textsimple',
            'name'          => 'tabs_letter_spacing',
            'default_value' => '',
            'label'         => 'Letter Spacing',
            'args'          => array(
                'suffix' => 'px'
            )
        ));

        $typography_row2 = startit_qode_add_admin_row(array(
            'name' => 'typography_row2',
            'next' => true,
            'parent' => $typography_group
        ));		
		
        startit_qode_add_admin_field(array(
            'parent'        => $typography_row2,
            'type'          => 'selectsimple',
            'name'          => 'tabs_font_weight',
            'default_value' => '',
            'label'         => 'Font Weight',
            'options'       => startit_qode_get_font_weight_array()
        ));
		
		//Initial Tab Color Styles
		
		startit_qode_add_admin_section_title(array(
            'name' => 'tab_color_section_title',
            'title' => 'Tab Navigation Color Styles',			
            'parent' => $panel
        ));
		$tabs_color_group = startit_qode_add_admin_group(array(
            'name' => 'tabs_color_group',
            'title' => 'Tab Navigation Color Styles',
			'description' => 'Set color styles for tab navigation',
            'parent' => $panel
        ));
		$tabs_color_row = startit_qode_add_admin_row(array(
            'name' => 'tabs_color_row',
            'next' => true,
            'parent' => $tabs_color_group
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_color',
            'default_value' => '',
            'label'         => 'Color'
        ));
		startit_qode_add_admin_field(array(
            'parent'        => $tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_back_color',
            'default_value' => '',
            'label'         => 'Background Color'
        ));
		startit_qode_add_admin_field(array(
            'parent'        => $tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_border_color',
            'default_value' => '',
            'label'         => 'Border Color'
        ));
		
		//Active Tab Color Styles
		
		$active_tabs_color_group = startit_qode_add_admin_group(array(
            'name' => 'active_tabs_color_group',
            'title' => 'Active and Hover Navigation Color Styles',
			'description' => 'Set color styles for active and hover tabs',
            'parent' => $panel
        ));
		$active_tabs_color_row = startit_qode_add_admin_row(array(
            'name' => 'active_tabs_color_row',
            'next' => true,
            'parent' => $active_tabs_color_group
        ));

        startit_qode_add_admin_field(array(
            'parent'        => $active_tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_color_active',
            'default_value' => '',
            'label'         => 'Color'
        ));
		startit_qode_add_admin_field(array(
            'parent'        => $active_tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_back_color_active',
            'default_value' => '',
            'label'         => 'Background Color'
        ));
		startit_qode_add_admin_field(array(
            'parent'        => $active_tabs_color_row,
            'type'          => 'colorsimple',
            'name'          => 'tabs_border_color_active',
            'default_value' => '',
            'label'         => 'Border Color'
        ));
	}

	add_action('qode_startit_options_map', 'startit_qode_elements_map', 8);

}