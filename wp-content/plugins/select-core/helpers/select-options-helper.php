<?php


if(!function_exists('qode_startit_init_theme_options')) {
	/**
	 * Function that sets $qode_startit_options variable if it does'nt exists
	 */
	function qode_startit_init_theme_options() {
		global $qode_startit_options;
		global $qode_startit_Framework;
		if(isset($qode_startit_options['reset_to_defaults'])) {
			if( $qode_startit_options['reset_to_defaults'] == 'yes' ) delete_option( "qode_options_startit");
		}

		if (!get_option("qode_options_startit")) {
			add_option( "qode_options_startit",
				$qode_startit_Framework->qodeOptions->options
			);

			$qode_startit_options = $qode_startit_Framework->qodeOptions->options;
		}
	}
}

if(!function_exists('qode_startit_theme_menu')) {
	/**
	 * Function that generates admin menu for options page.
	 * It generates one admin page per options page.
	 */
	function qode_startit_theme_menu() {
		if( select_core_is_theme_registered() ) {
			global $qode_startit_Framework;
			qode_startit_init_theme_options();

			$page_hook_suffix = add_menu_page(
				'Select Options',                   // The value used to populate the browser's title bar when the menu page is active
				'Select Options',                   // The text of the menu in the administrator's sidebar
				'administrator',                  // What roles are able to access the menu
				'qode_startit_theme_menu',                // The ID used to bind submenu items to this menu
				array($qode_startit_Framework->getSkin(), 'renderOptions'), // The callback function used to render this menu
				$qode_startit_Framework->getSkin()->getMenuIcon('options'),             // Icon For menu Item
				$qode_startit_Framework->getSkin()->getMenuItemPosition('options')            // Position
			);

			foreach ($qode_startit_Framework->qodeOptions->adminPages as $key=>$value ) {
				$slug = "";

				if (!empty($value->slug)) {
					$slug = "_tab".$value->slug;
				}

				$subpage_hook_suffix = add_submenu_page(
					'qode_startit_theme_menu',
					'Select Options - '.$value->title,                   // The value used to populate the browser's title bar when the menu page is active
					$value->title,                   // The text of the menu in the administrator's sidebar
					'administrator',                  // What roles are able to access the menu
					'qode_startit_theme_menu'.$slug,                // The ID used to bind submenu items to this menu
					array($qode_startit_Framework->getSkin(), 'renderOptions')
				);

				add_action('admin_print_scripts-'.$subpage_hook_suffix, 'startit_qode_enqueue_admin_scripts');
				add_action('admin_print_styles-'.$subpage_hook_suffix, 'startit_qode_enqueue_admin_styles');
			};

			add_action('admin_print_scripts-'.$page_hook_suffix, 'startit_qode_enqueue_admin_scripts');
			add_action('admin_print_styles-'.$page_hook_suffix, 'startit_qode_enqueue_admin_styles');
		}
	}

	add_action( 'admin_menu', 'qode_startit_theme_menu');
}

if(!function_exists('qode_startit_register_theme_settings')) {
	/**
	 * Function that registers setting that will be used to store theme options
	 */
	function qode_startit_register_theme_settings() {
		register_setting( 'qode_startit_theme_menu', 'qode_options' );
	}

	add_action('admin_init', 'qode_startit_register_theme_settings');
}

if(!function_exists('qode_startit_meta_box_add')) {
	/**
	 * Function that adds all defined meta boxes.
	 * It loops through array of created meta boxes and adds them
	 */
	function qode_startit_meta_box_add() {
		global $qode_startit_Framework;


		foreach ($qode_startit_Framework->qodeMetaBoxes->metaBoxes as $key=>$box ) {
			$hidden = false;
			if (!empty($box->hidden_property)) {
				foreach ($box->hidden_values as $value) {
					if ( startit_qode_option_get_value($box->hidden_property) == $value)
						$hidden = true;

				}
			}

			if(is_string($box->scope)) {
				$box->scope = array($box->scope);
			}

			if(is_array($box->scope) && count($box->scope)) {
				foreach($box->scope as $screen) {
					add_meta_box(
						'qodef-meta-box-'.$key,
						$box->title, 'startit_qode_render_meta_box',
						$screen,
						'advanced',
						'high',
						array( 'box' => $box)
					);

					if ($hidden) {
						add_filter( 'postbox_classes_'.$screen.'_qodef-meta-box-'.$key, 'startit_qode_meta_box_add_hidden_class');
					}
				}
			}

		}
		
		if ( startit_qode_is_gutenberg_installed() || startit_qode_is_wp_gutenberg_installed() ) {
			startit_qode_enqueue_meta_box_styles();
			startit_qode_enqueue_meta_box_scripts();
		} else {
			add_action('admin_enqueue_scripts', 'startit_qode_enqueue_meta_box_styles');
			add_action('admin_enqueue_scripts', 'startit_qode_enqueue_meta_box_scripts');
		}
	}
	
	if ( class_exists( 'WP_Block_Type' ) && defined( 'QODE_ROOT' ) ) {
		add_action( 'admin_head', 'qode_startit_meta_box_add' );
	} else {
		add_action('add_meta_boxes', 'qode_startit_meta_box_add');
	}
}
