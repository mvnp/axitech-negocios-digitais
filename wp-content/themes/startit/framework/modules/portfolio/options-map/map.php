<?php

if ( ! function_exists( 'startit_qode_portfolio_options_map' ) ) {

	function startit_qode_portfolio_options_map() {

		startit_qode_add_admin_page(array(
			'slug'  => '_portfolio',
			'title' => esc_html__( 'Portfolio', 'startit' ),
			'icon'  => 'fa fa-camera-retro'
		));

		$panel = startit_qode_add_admin_panel(array(
			'title' => esc_html__( 'Portfolio Single', 'startit' ),
			'name'  => 'panel_portfolio_single',
			'page'  => '_portfolio'
		));

		startit_qode_add_admin_field(array(
			'name'        => 'portfolio_single_template',
			'type'        => 'select',
			'label' => esc_html__( 'Portfolio Type', 'startit' ),
			'default_value'	=> 'small-images',
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'startit' ),
			'parent'      => $panel,
			'options'     => array(
				'small-images' => 'Portfolio small images',
				'small-slider' => 'Portfolio small slider',
				'big-images' => 'Portfolio big images',
				'big-slider' => 'Portfolio big slider',
				'custom' => 'Portfolio custom',
				'full-width-custom' => 'Portfolio full width custom',
				'gallery' => 'Portfolio gallery'
			)
		));

		startit_qode_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_images',
			'type'          => 'yesno',
			'label' => esc_html__( 'Lightbox for Images', 'startit' ),
			'description' => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images.', 'startit' ),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		startit_qode_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_videos',
			'type'          => 'yesno',
			'label' => esc_html__( 'Lightbox for Videos', 'startit' ),
			'description' => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects.', 'startit' ),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		startit_qode_add_admin_field(array(
			'name'          => 'portfolio_single_hide_categories',
			'type'          => 'yesno',
			'label' => esc_html__( 'Hide Categories', 'startit' ),
			'description' => esc_html__( 'Enabling this option will disable category meta description on Single Projects.', 'startit' ),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		startit_qode_add_admin_field(array(
			'name'          => 'portfolio_single_hide_date',
			'type'          => 'yesno',
			'label' => esc_html__( 'Hide Date', 'startit' ),
			'description' => esc_html__( 'Enabling this option will disable date meta on Single Projects.', 'startit' ),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		startit_qode_add_admin_field(array(
			'name'          => 'portfolio_single_comments',
			'type'          => 'yesno',
			'label' => esc_html__( 'Show Comments', 'startit' ),
			'description' => esc_html__( 'Enabling this option will show comments on your page.', 'startit' ),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		startit_qode_add_admin_field(array(
			'name'          => 'portfolio_single_sticky_sidebar',
			'type'          => 'yesno',
			'label' => esc_html__( 'Sticky Side Text', 'startit' ),
			'description' => esc_html__( 'Enabling this option will make side text sticky on Single Project pages', 'startit' ),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		startit_qode_add_admin_field(array(
			'name'          => 'portfolio_single_hide_pagination',
			'type'          => 'yesno',
			'label' => esc_html__( 'Hide Pagination', 'startit' ),
			'description' => esc_html__( 'Enabling this option will turn off portfolio pagination functionality.', 'startit' ),
			'parent'        => $panel,
			'default_value' => 'no',
			'args' => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '#qodef_navigate_same_category_container'
			)
		));

		$container_navigate_category = startit_qode_add_admin_container(array(
			'name'            => 'navigate_same_category_container',
			'parent'          => $panel,
			'hidden_property' => 'portfolio_single_hide_pagination',
			'hidden_value'    => 'yes'
		));

		startit_qode_add_admin_field(array(
			'name'            => 'portfolio_single_nav_same_category',
			'type'            => 'yesno',
			'label' => esc_html__( 'Enable Pagination Through Same Category', 'startit' ),
			'description' => esc_html__( 'Enabling this option will make portfolio pagination sort through current category.', 'startit' ),
			'parent'          => $container_navigate_category,
			'default_value'   => 'no'
		));

		startit_qode_add_admin_field(array(
			'name'        => 'portfolio_single_numb_columns',
			'type'        => 'select',
			'label' => esc_html__( 'Number of Columns', 'startit' ),
			'default_value' => 'three-columns',
			'description' => esc_html__( 'Enter the number of columns for Portfolio Gallery type', 'startit' ),
			'parent'      => $panel,
			'options'     => array(
				'two-columns' => '2 columns',
				'three-columns' => '3 columns',
				'four-columns' => '4 columns'
			)
		));

		startit_qode_add_admin_field(array(
			'name'        => 'portfolio_single_slug',
			'type'        => 'text',
			'label' => esc_html__( 'Portfolio Single Slug', 'startit' ),
			'description' => esc_html__('Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)','startit'),
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));

	}

	add_action( 'qode_startit_options_map', 'startit_qode_portfolio_options_map', 12);

}