<?php

if ( ! function_exists( 'startit_qode_blog_options_map' ) ) {

	function startit_qode_blog_options_map() {

		startit_qode_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => esc_html__( 'Blog', 'startit' ),
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */

		$custom_sidebars = startit_qode_get_custom_sidebars();

		$panel_blog_lists = startit_qode_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => esc_html__( 'Blog Lists', 'startit' )
			)
		);

		startit_qode_add_admin_field(array(
			'name'        => 'blog_list_type',
			'type'        => 'select',
			'label' => esc_html__( 'Blog Layout for Archive Pages', 'startit' ),
			'description' => esc_html__( 'Choose a default blog layout', 'startit' ),
			'default_value' => 'standard',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'standard'				=> esc_html__('Blog: Standard','startit'),
				'masonry' 				=> esc_html__('Blog: Masonry','startit'),
				'masonry-full-width' 	=> esc_html__('Blog: Masonry Full Width','startit'),
				'standard-whole-post' 	=> esc_html__('Blog: Standard Whole Post','startit'),
				'gallery' 	            => esc_html__('Blog: Gallery','startit')
			)
		));

		startit_qode_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label' => esc_html__( 'Archive and Category Sidebar', 'startit' ),
			'description' => esc_html__( 'Choose a sidebar layout for archived Blog Post Lists and Category Blog Lists', 'startit' ),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'default'			=> esc_html__('No Sidebar','startit'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right','startit'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right','startit'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left','startit'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left','startit')
			)
		));


		if(count($custom_sidebars) > 0) {
			startit_qode_add_admin_field(array(
				'name' => 'blog_custom_sidebar',
				'type' => 'selectblank',
				'label' => esc_html__( 'Sidebar to Display', 'startit' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog Post Lists and Category Blog Lists. Default sidebar is Sidebar Page', 'startit' ),
				'parent' => $panel_blog_lists,
				'options' => startit_qode_get_custom_sidebars()
			));
		}

		startit_qode_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'pagination',
				'default_value' => 'yes',
				'label' => esc_html__( 'Pagination', 'startit' ),
				'parent' => $panel_blog_lists,
				'description' => esc_html__( 'Enabling this option will display pagination links on bottom of Blog Post List', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_qodef_pagination_container'
				)
			)
		);

		$pagination_container = startit_qode_add_admin_container(
			array(
				'name' => 'qodef_pagination_container',
				'hidden_property' => 'pagination',
				'hidden_value' => 'no',
				'parent' => $panel_blog_lists,
			)
		);

		startit_qode_add_admin_field(
			array(
				'parent' => $pagination_container,
				'type' => 'text',
				'name' => 'blog_page_range',
				'default_value' => '',
				'label' => esc_html__( 'Pagination Range limit', 'startit' ),
				'description' => esc_html__( 'Enter a number that will limit pagination to a certain range of links', 'startit' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		startit_qode_add_admin_field(array(
			'name'        => 'pagination_type',
			'type'        => 'select',
			'label' => esc_html__( 'Pagination Type', 'startit' ),
			'description' => esc_html__( 'Choose a type of pagination for Standard Blog List', 'startit' ),
			'parent'      => $pagination_container,
			'options'     => array(
				'standard'	=> esc_html__('Standard Pagination','startit'),
				'navigation'	=> esc_html__('Navigation','startit'),
			),
			'args' => array(
				'col_width' => 3
			)
		));

        startit_qode_add_admin_field(array(
            'name'        => 'gallery_pagination',
            'type'        => 'select',
            'label' => esc_html__( 'Pagination on Gallery', 'startit' ),
            'description' => esc_html__( 'Choose a pagination style for Gallery Blog List', 'startit' ),
            'parent'      => $pagination_container,
            'options'     => array(
                'standard'			=> esc_html__('Standard','startit'),
                'load-more'			=> esc_html__('Load More','startit'),
                'infinite-scroll' 	=> esc_html__('Infinite Scroll','startit')
            ),
            'args' => array(
                'col_width' => 3
            )
        ));

		startit_qode_add_admin_field(array(
			'name'        => 'masonry_pagination',
			'type'        => 'select',
			'label' => esc_html__( 'Pagination on Masonry', 'startit' ),
			'description' => esc_html__( 'Choose a pagination style for Masonry Blog List', 'startit' ),
			'parent'      => $pagination_container,
			'options'     => array(
				'standard'			=> esc_html__('Standard','startit'),
				'load-more'			=> esc_html__('Load More','startit'),
				'infinite-scroll' 	=> esc_html__('Infinite Scroll','startit')
			),
			'args' => array(
				'col_width' => 3
			)
		));


		startit_qode_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'masonry_filter',
				'default_value' => 'no',
				'label' => esc_html__( 'Masonry Filter', 'startit' ),
				'parent' => $panel_blog_lists,
				'description' => esc_html__( 'Enabling this option will display category filter on Masonry and Masonry Full Width Templates', 'startit' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);
		startit_qode_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '',
				'label' => esc_html__( 'Number of Words in Excerpt', 'startit' ),
				'parent' => $panel_blog_lists,
				'description' => esc_html__( 'Enter a number of words in excerpt (article summary)', 'startit' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);
		startit_qode_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'standard_number_of_chars',
				'default_value' => '',
				'label' => esc_html__( 'Standard Number of Words in Excerpt', 'startit' ),
				'parent' => $panel_blog_lists,
				'description' => esc_html__( 'Enter a number of words in excerpt (article summary)', 'startit' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);
		startit_qode_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'masonry_number_of_chars',
				'default_value' => '',
				'label' => esc_html__( 'Masonry Number of Words in Excerpt', 'startit' ),
				'parent' => $panel_blog_lists,
				'description' => esc_html__( 'Enter a number of words in excerpt (article summary)', 'startit' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);
        startit_qode_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'gallery_number_of_chars',
                'default_value' => '',
                'label' => esc_html__( 'Gallery Number of Words in Excerpt', 'startit' ),
                'parent' => $panel_blog_lists,
                'description' => esc_html__( 'Enter a number of words in excerpt (article summary)', 'startit' ),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

		/**
		 * Blog Single
		 */
		$panel_blog_single = startit_qode_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => esc_html__( 'Blog Single', 'startit' )
			)
		);


		startit_qode_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label' => esc_html__( 'Sidebar Layout', 'startit' ),
			'description' => esc_html__( 'Choose a sidebar layout for Blog Single pages', 'startit' ),
			'parent'      => $panel_blog_single,
			'options'     => array(
				'default'			=> esc_html__('No Sidebar','startit'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right','startit'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right','startit'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left','startit'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left','startit')
			)
		));


		if(count($custom_sidebars) > 0) {
			startit_qode_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar',
				'type' => 'selectblank',
				'label' => esc_html__( 'Sidebar to Display', 'startit' ),
				'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is Sidebar','startit'),
				'parent' => $panel_blog_single,
				'options' => startit_qode_get_custom_sidebars()
			));
		}
		startit_qode_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label' => esc_html__( 'Show Comments', 'startit' ),
			'description' => esc_html__( 'Enabling this option will show comments on your page.', 'startit' ),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));
		startit_qode_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_navigation',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable Prev/Next Single Post Navigation Links', 'startit' ),
				'parent' => $panel_blog_single,
				'description' => esc_html__( 'Enable navigation links through the blog posts (left and right arrows will appear)', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_qodef_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = startit_qode_add_admin_container(
			array(
				'name' => 'qodef_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		startit_qode_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable Navigation Only in Current Category', 'startit' ),
				'description' => esc_html__( 'Limit your navigation only through current category', 'startit' ),
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		startit_qode_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_author_info',
				'default_value' => 'no',
				'label' => esc_html__( 'Show Author Info Box', 'startit' ),
				'parent' => $panel_blog_single,
				'description' => esc_html__( 'Enabling this option will display author name and descriptions on Blog Single pages', 'startit' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_qodef_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = startit_qode_add_admin_container(
			array(
				'name' => 'qodef_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		startit_qode_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label' => esc_html__( 'Show Author Email', 'startit' ),
				'description' => esc_html__( 'Enabling this option will show author email', 'startit' ),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

	}

	add_action( 'qode_startit_options_map', 'startit_qode_blog_options_map', 11);

}











