<?php

require_once QODE_FRAMEWORK_ROOT_DIR."/lib/qode.kses.php";
require_once QODE_FRAMEWORK_ROOT_DIR."/lib/qode.layout.php";
require_once QODE_FRAMEWORK_ROOT_DIR."/lib/qode.optionsapi.php";
require_once QODE_FRAMEWORK_ROOT_DIR."/lib/qode.framework.php";
require_once QODE_FRAMEWORK_ROOT_DIR."/lib/qode.functions.php";
require_once QODE_FRAMEWORK_ROOT_DIR."/lib/qode.common.php";
require_once QODE_FRAMEWORK_ROOT_DIR."/lib/qode.icons/qode.icons.php";
require_once QODE_FRAMEWORK_ROOT_DIR."/admin/options/qode-options-setup.php";
require_once QODE_FRAMEWORK_ROOT_DIR."/admin/meta-boxes/qode-meta-boxes-setup.php";
require_once QODE_FRAMEWORK_ROOT_DIR."/modules/qode-modules-loader.php";

global $qode_startit_Framework;

if(!function_exists( 'startit_qode_admin_scripts_init' )) {
	/**
	 * Function that registers all scripts that are necessary for our back-end
	 */
	function startit_qode_admin_scripts_init() {
		wp_register_style('startit-qodef-jquery-ui', get_template_directory_uri().'/framework/admin/assets/css/jquery-ui/jquery-ui.css');
		wp_register_script('startit-qodef-dependence', get_template_directory_uri().'/framework/admin/assets/js/qodef-ui/qodef-dependence.js');
		wp_register_script('startit-qodef-twitter-connect', get_template_directory_uri().'/framework/admin/assets/js/qodef-twitter-connect.js');

        /**
         * @see QodeSkinAbstract::registerScripts - hooked with 10
         * @see QodeSkinAbstract::registerStyles - hooked with 10
         */
        do_action('startit_qode_admin_scripts_init');
	}

	add_action('admin_init', 'startit_qode_admin_scripts_init');
}

if(!function_exists( 'startit_qode_enqueue_admin_styles' )) {
	/**
	 * Function that enqueues styles for options page
	 */
	function startit_qode_enqueue_admin_styles() {
		wp_enqueue_style('wp-color-picker');

        /**
         * @see QodeSkinAbstract::enqueueStyles - hooked with 10
         */
        do_action('startit_qode_enqueue_admin_styles');
	}
}

if(!function_exists( 'startit_qode_enqueue_admin_scripts' )) {
	/**
	 * Function that enqueues styles for options page
	 */
	function startit_qode_enqueue_admin_scripts() {
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_media();
		wp_enqueue_script('startit-qodef-dependence');
		wp_enqueue_script('startit-qodef-twitter-connect');

        /**
         * @see QodeSkinAbstract::enqueueScripts - hooked with 10
         */
        do_action('startit_qode_enqueue_admin_scripts');
	}
}

if(!function_exists('startit_qode_enqueue_meta_box_styles')) {
	/**
	 * Function that enqueues styles for meta boxes
	 */
	function startit_qode_enqueue_meta_box_styles() {
		wp_enqueue_style( 'wp-color-picker' );

        /**
         * @see QodeSkinAbstract::enqueueStyles - hooked with 10
         */
        do_action('startit_qode_enqueue_meta_box_styles');
	}
}

if(!function_exists('startit_qode_enqueue_meta_box_scripts')) {
	/**
	 * Function that enqueues scripts for meta boxes
	 */
	function startit_qode_enqueue_meta_box_scripts() {
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_media();
		wp_enqueue_script('startit-qodef-dependence');

        /**
         * @see QodeSkinAbstract::enqueueScripts - hooked with 10
         */
        do_action('startit_qode_enqueue_meta_box_scripts');
	}
}

if(!function_exists( 'startit_qode_enqueue_nav_menu_script' )) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 * @param $hook string current page hook to check
	 */
	function startit_qode_enqueue_nav_menu_script($hook) {
		if($hook == 'nav-menus.php') {
			wp_enqueue_script('startit-qodef-nav-menu', get_template_directory_uri().'/framework/admin/assets/js/qodef-nav-menu.js');
			wp_enqueue_style('startit-qodef-nav-menu', get_template_directory_uri().'/framework/admin/assets/css/qodef-nav-menu.css');
		}
	}

	add_action('admin_enqueue_scripts', 'startit_qode_enqueue_nav_menu_script');
}


if(!function_exists( 'startit_qode_enqueue_widgets_admin_script' )) {
	/**
	 * Function that enqueues styles and scripts for admin widgets page.
	 * @param $hook string current page hook to check
	 */
	function startit_qode_enqueue_widgets_admin_script($hook) {
		if($hook == 'widgets.php') {
			wp_enqueue_script('startit-qodef-dependence');
		}
	}

	add_action('admin_enqueue_scripts', 'startit_qode_enqueue_widgets_admin_script');
}


if(!function_exists( 'startit_qode_enqueue_styles_slider_taxonomy' )) {
	/**
	 * Enqueue styles when on slider taxonomy page in admin
	 */
	function startit_qode_enqueue_styles_slider_taxonomy() {
		if(isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'slides_category') {
			startit_qode_enqueue_admin_styles();
		}
	}

	add_action('admin_print_scripts-edit-tags.php', 'startit_qode_enqueue_styles_slider_taxonomy');
}

if(!function_exists( 'startit_qode_init_theme_options_array' )) {
	/**
	 * Function that merges $qode_startit_options and default options array into one array.
	 *
	 * @see array_merge()
	 */
	function startit_qode_init_theme_options_array() {
        global $qode_startit_options;
        $qode_startit_Framework = startit_qode_return_framework();

		$db_options = get_option('qode_options_startit');

		//does qode_options exists in db?
		if(is_array($db_options)) {
			//merge with default options
			$qode_startit_options  = array_merge($qode_startit_Framework->qodeOptions->options, get_option('qode_options_startit'));
		} else {
			//options don't exists in db, take default ones
			$qode_startit_options = $qode_startit_Framework->qodeOptions->options;
		}
	}

	add_action('qode_startit_after_options_map', 'startit_qode_init_theme_options_array', 0);
}

if(!function_exists( 'startit_qode_get_admin_tab' )) {
	/**
	 * Helper function that returns current tab from url.
	 * @return null
	 */
	function startit_qode_get_admin_tab(){
		return isset($_GET['page']) ? startit_qode_strafter($_GET['page'],'tab') : NULL;
	}
}

if(!function_exists( 'startit_qode_strafter' )) {
	/**
	 * Function that returns string that comes after found string
	 * @param $string string where to search
	 * @param $substring string what to search for
	 * @return null|string string that comes after found string
	 */
	function startit_qode_strafter($string, $substring) {
		$pos = strpos($string, $substring);
		if ($pos === false) {
			return NULL;
		}

		return(substr($string, $pos+strlen($substring)));
	}
}

if(!function_exists( 'startit_qode_save_options' )) {
	/**
	 * Function that saves theme options to db.
	 * It hooks to ajax wp_ajax_qodef_save_options action.
	 */
	function startit_qode_save_options() {
		global $qode_startit_options;
		if(current_user_can('edit_theme_options')) {

			$_REQUEST = stripslashes_deep($_REQUEST);

	        unset($_REQUEST['action']);

	        check_ajax_referer('qode_ajax_save_nonce', 'qode_ajax_save_nonce');

			$qode_startit_options = array_merge($qode_startit_options, $_REQUEST);

			update_option( 'qode_options_startit', $qode_startit_options );

			do_action('qode_startit_after_theme_option_save');
			echo "Saved";

			die();
		}
	}

	add_action('wp_ajax_qode_startit_save_options', 'startit_qode_save_options');
}

if(!function_exists( 'startit_qode_meta_box_save' )) {
	/**
	 * Function that saves meta box to postmeta table
	 * @param $post_id int id of post that meta box is being saved
	 * @param $post WP_Post current post object
	 */
	function startit_qode_meta_box_save( $post_id, $post ) {
		$qode_startit_Framework = startit_qode_return_framework();

		$nonces_array = array();
		$meta_boxes = startit_qode_framework()->qodeMetaBoxes->getMetaBoxesByScope($post->post_type);

		if(is_array($meta_boxes) && count($meta_boxes)) {
			foreach($meta_boxes as $meta_box) {
				$nonces_array[] = 'qode_startit_meta_box_'.$meta_box->name.'_save';
			}
		}

		if(is_array($nonces_array) && count($nonces_array)) {
			foreach($nonces_array as $nonce) {
				if(!isset($_POST[$nonce]) || !wp_verify_nonce($_POST[$nonce], $nonce)) {
					return;
				}
			}
		}

		$postTypes = array( "page", "post", "portfolio-item", "testimonials", "slides", "carousels", "masonry_gallery");

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if (!isset( $_POST[ '_wpnonce' ])) {
			return;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		if (!in_array($post->post_type, $postTypes)) {
			return;
		}

		foreach ($qode_startit_Framework->qodeMetaBoxes->options as $key=>$box ) {

			if (isset($_POST[$key]) && trim($_POST[$key] !== '')) {

				$value = $_POST[$key];

				update_post_meta( $post_id, $key, $value );
			} else {
				delete_post_meta( $post_id, $key );
			}
		}

		$portfolios = false;
		if (isset($_POST['optionLabel'])) {
			foreach ($_POST['optionLabel'] as $key => $value) {
				$portfolios_val[$key] = array('optionLabel'=>$value,'optionValue'=>$_POST['optionValue'][$key],'optionUrl'=>$_POST['optionUrl'][$key],'optionlabelordernumber'=>$_POST['optionlabelordernumber'][$key]);
				$portfolios = true;

			}
		}

		if ($portfolios) {
			update_post_meta( $post_id,  'qode_portfolios', $portfolios_val );
		} else {
			delete_post_meta( $post_id, 'qode_portfolios' );
		}

		$portfolio_images = false;
		if (isset($_POST['portfolioimg'])) {
			foreach ($_POST['portfolioimg'] as $key => $value) {
				$portfolio_images_val[$key] = array('portfolioimg'=>$_POST['portfolioimg'][$key],'portfoliotitle'=>$_POST['portfoliotitle'][$key],'portfolioimgordernumber'=>$_POST['portfolioimgordernumber'][$key], 'portfoliovideotype'=>$_POST['portfoliovideotype'][$key], 'portfoliovideoid'=>$_POST['portfoliovideoid'][$key], 'portfoliovideoimage'=>$_POST['portfoliovideoimage'][$key], 'portfoliovideowebm'=>$_POST['portfoliovideowebm'][$key], 'portfoliovideomp4'=>$_POST['portfoliovideomp4'][$key], 'portfoliovideoogv'=>$_POST['portfoliovideoogv'][$key], 'portfolioimgtype'=>$_POST['portfolioimgtype'][$key] );
				$portfolio_images = true;
			}
		}


		if ($portfolio_images) {
			update_post_meta( $post_id,  'qode_portfolio_images', $portfolio_images_val );
		} else {
			delete_post_meta( $post_id,  'qode_portfolio_images' );
		}
	}

	add_action( 'save_post', 'startit_qode_meta_box_save', 1, 2 );
}

if(!function_exists( 'startit_qode_render_meta_box' )) {
	/**
	 * Function that renders meta box
	 * @param $post WP_Post post object
	 * @param $metabox array array of current meta box parameters
	 */
	function startit_qode_render_meta_box($post, $metabox) {?>
		<div class="qodef-meta-box qodef-page">
			<div class="qodef-meta-box-holder">

				<?php $metabox["args"]["box"]->render(); ?>
				<?php wp_nonce_field('qode_startit_meta_box_'.$metabox['args']['box']->name.'_save', 'qode_startit_meta_box_'.$metabox['args']['box']->name.'_save'); ?>

			</div>
		</div>
	<?php
	}
}

if(!function_exists( 'startit_qode_meta_box_add_hidden_class' )) {
	/**
	 * Function that adds class that will initially hide meta box
	 * @param array $classes array of classes
	 * @return array modified array of classes
	 */
	function startit_qode_meta_box_add_hidden_class( $classes=array() ) {
		if( !in_array( 'qodef-meta-box-hidden', $classes ) )
			$classes[] = 'qodef-meta-box-hidden';

		return $classes;
	}

}

if(!function_exists( 'startit_qode_remove_default_custom_fields' )) {
	/**
	 * Function that removes default WordPress custom fields interface
	 */
	function startit_qode_remove_default_custom_fields() {
		foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
			foreach ( array( "page", "post", "portfolio_page", "testimonials", "slides", "carousels" ) as $postType ) {
				remove_meta_box( 'postcustom', $postType, $context );
			}
		}
	}

	add_action('do_meta_boxes', 'startit_qode_remove_default_custom_fields');
}


if(!function_exists( 'startit_qode_get_custom_sidebars' )) {
	/**
	 * Function that returns all custom made sidebars.
	 *
	 * @uses get_option()
	 * @return array array of custom made sidebars where key and value are sidebar name
	 */
	function startit_qode_get_custom_sidebars() {
		$custom_sidebars = get_option('qode_sidebars');
		$formatted_array = array();

		if(is_array($custom_sidebars) && count($custom_sidebars)) {
			foreach ($custom_sidebars as $custom_sidebar) {
				$formatted_array[sanitize_title($custom_sidebar)] = $custom_sidebar;
			}
		}

		return $formatted_array;
	}
}

if(!function_exists( 'startit_qode_generate_icon_pack_options' )) {
    /**
     * Generates options HTML for each icon in given icon pack
     * Hooked to wp_ajax_update_admin_nav_icon_options action
     */
    function startit_qode_generate_icon_pack_options() {
        $qode_startit_IconCollections = startit_qode_return_icon_collection();

        $html = '';
	    check_ajax_referer('update-nav_menu', 'update_nav_menu_nonce');
        $icon_pack = isset($_POST['icon_pack']) ? $_POST['icon_pack'] : '';
        $collections_object = $qode_startit_IconCollections->getIconCollection($icon_pack);

        if($collections_object) {
            $icons = $collections_object->getIconsArray();
            if(is_array($icons) && count($icons)) {
                foreach ($icons as $key => $icon) {
                    $html .= '<option value="'.esc_attr($key).'">'.esc_html($key).'</option>';
                }
            }
        }

	    startit_qode_module_part($html);
    }

    add_action('wp_ajax_update_admin_nav_icon_options', 'startit_qode_generate_icon_pack_options');
}

if(!function_exists( 'startit_qode_admin_notice' )) {
    /**
     * Prints admin notice. It checks if notice has been disabled and if it hasn't then it displays it
     * @param $id string id of notice. It will be used to store notice dismis
     * @param $message string message to show to the user
     * @param $class string HTML class of notice
     * @param bool $is_dismisable whether notice is dismisable or not
     */
    function startit_qode_admin_notice($id, $message, $class, $is_dismisable = true) {
        $is_dismised = get_user_meta(get_current_user_id(), 'dismis_'.$id);

        //if notice isn't dismissed
        if(!$is_dismised && is_admin()) {
            echo '<div style="display: block;" class="'.esc_attr($class).' is-dismissible notice">';
            echo '<p>';

            echo wp_kses_post($message);

            if($is_dismisable) {
                echo '<strong style="display: block; margin-top: 7px;"><a href="'.esc_url(add_query_arg('qode_dismis_notice', $id)).'">'.esc_html__('Dismiss this notice', 'startit').'</a></strong>';
            }

            echo '</p>';

            echo '</div>';
        }

    }
}

if(!function_exists( 'startit_qode_save_dismisable_notice' )) {
    /**
     * Updates user meta with dismisable notice. Hooks to admin_init action
     * in order to check this on every page request in admin
     */
    function startit_qode_save_dismisable_notice() {
        if(is_admin() && !empty($_GET['qode_dismis_notice'])) {
            $notice_id = sanitize_key($_GET['qode_dismis_notice']);
            $current_user_id = get_current_user_id();

            update_user_meta($current_user_id, 'dismis_'.$notice_id, 1);
        }
    }

    add_action('admin_init', 'startit_qode_save_dismisable_notice');
}

if(!function_exists( 'startit_qode_hook_twitter_request_ajax' )) {
    /**
     * Wrapper function for obtaining twitter request token.
     * Hooks to wp_ajax_qode_twitter_obtain_request_token ajax action
     *
     * @see QodefTwitterApi::obtainRequestToken()
     */
    function startit_qode_hook_twitter_request_ajax() {
	    check_ajax_referer('startit_qode_twitter_connect', 'startit_qode_twitter_connect');
        QodefTwitterApi::getInstance()->obtainRequestToken();
    }

    add_action('wp_ajax_qode_twitter_obtain_request_token', 'startit_qode_hook_twitter_request_ajax');
}
?>