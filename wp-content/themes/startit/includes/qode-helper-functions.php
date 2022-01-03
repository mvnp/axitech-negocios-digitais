<?php

//defined content width variable
if ( ! isset( $content_width ) ) {
	$content_width = 1100;
}
//$qode_startit_toolbar = true;

if ( ! function_exists( 'startit_qode_return_global_options' ) ) {
	function startit_qode_return_global_options() {
		global $qode_startit_options;

		return $qode_startit_options;
	}
}


if ( ! function_exists( 'startit_qode_return_framework' ) ) {
	function startit_qode_return_framework() {
		global $qode_startit_Framework;

		return $qode_startit_Framework;
	}
}


if ( ! function_exists( 'startit_qode_return_icon_collection' ) ) {
	function startit_qode_return_icon_collection() {
		global $qode_startit_IconCollections;

		return $qode_startit_IconCollections;
	}
}

if ( ! function_exists( 'startit_qode_return_toolbar' ) ) {
	function startit_qode_return_toolbar() {
		global $qode_startit_toolbar;

		return $qode_startit_toolbar;
	}
}

if ( ! function_exists( 'startit_qode_return_woocommerce' ) ) {
	function startit_qode_return_woocommerce() {
		global $woocommerce;

		return $woocommerce;
	}
}

if ( ! function_exists( 'startit_qode_return_use_live_search' ) ) {
	function startit_qode_return_use_live_search() {
		global $use_live_search;

		return $use_live_search;
	}
}

if ( ! function_exists( 'startit_qode_get_module_part' ) ) {
	function startit_qode_get_module_part( $module ) {
		return $module;
	}
}

if ( ! function_exists( 'startit_qode_module_part' ) ) {
	function startit_qode_module_part( $module ) {
		print startit_qode_get_module_part( $module );
	}
}

if ( ! function_exists( 'startit_qode_get_blog_query' ) ) {
	/**
	 * Function which create query for blog lists
	 *
	 * @return wp query object
	 */
	function startit_qode_get_blog_query() {
		$id                       = startit_qode_get_page_id();
		$category = get_post_meta($id, "qodef_blog_category_meta", true);

		$number_of_posts_per_page = get_post_meta( $id, 'qodef_show_posts_per_page_meta', true );
		$post_number              = ! empty( $number_of_posts_per_page ) ? esc_attr( $number_of_posts_per_page ) : 10;

		$paged = startit_qode_paged();

		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'paged'          => $paged,
			'cat'            => $category,
			'posts_per_page' => $post_number
		);

		$blog_query = new WP_Query( $query_array );
		if ( is_archive() ) {
			global $wp_query;
			$blog_query = $wp_query;
		}

		return $blog_query;
	}
}


if(!function_exists( 'startit_qode_rgba_color' )) {
	/**
	 * Function that generates rgba part of css color property
	 *
	 * @param $color string hex color
	 * @param $transparency float transparency value between 0 and 1
	 *
	 * @return string generated rgba string
	 */
	function startit_qode_rgba_color($color, $transparency) {
		if($color !== '' && $transparency !== '') {
			$rgba_color = '';

			$rgb_color_array = startit_qode_hex2rgb($color);
			$rgba_color .= 'rgba('.implode(', ', $rgb_color_array).', '.$transparency.')';

			return $rgba_color;
		}
	}
}

if(!function_exists( 'startit_qode_wp_title_text' )) {
	/**
	 * Function that sets page's title. Hooks to wp_title filter
	 *
	 * @param $title string current page title
	 * @param $sep string title separator
	 *
	 * @return string changed title text if SEO plugins aren't installed
	 */
	function startit_qode_wp_title_text($title, $sep) {

		//is SEO plugin installed?
		if(startit_qode_seo_plugin_installed()) {
			//don't do anything, seo plugin will take care of it
		} else {
			//get current post id
			$id           = startit_qode_get_page_id();
			$sep          = ' | ';
			$title_prefix = get_bloginfo('name');
			$title_suffix = '';

			//is WooCommerce installed and is current page shop page?
			if( startit_qode_is_woocommerce_installed() && startit_qode_is_woocommerce_shop()) {
				//get shop page id
				$id = startit_qode_get_woo_shop_page_id();
			}

			//is WP 4.1 at least?
			if(function_exists('_wp_render_title_tag')) {
				//set unchanged title variable so we can use it later
				$title_array     = explode($sep, $title);
				$unchanged_title = array_shift($title_array);
			} //pre 4.1 version of WP
			else {
				//set unchanged title variable so we can use it later
				$unchanged_title = $title;
			}

			//is qode seo enabled?
			if( startit_qode_options()->getOptionValue('disable_seo') !== 'yes') {
				//get current post seo title
				$seo_title = esc_attr(get_post_meta($id, "qodef_meta_title_meta", true));

				//is current post seo title set?
				if($seo_title !== '') {
					$title_suffix = $seo_title;
				}
			}

			//title suffix is empty, which means that it wasn't set by qode seo
			if(empty($title_suffix)) {
				//if current page is front page append site description, else take original title string
				$title_suffix = is_front_page() ? get_bloginfo('description') : $unchanged_title;
			}

			//concatenate title string
			$title = $title_prefix.$sep.$title_suffix;

			//return generated title string
			return $title;
		}
	}

	add_filter('wp_title', 'startit_qode_wp_title_text', 10, 2);
}

if(!function_exists( 'wp_seo_title' )) {
	/**
	 * Function that outputs title tag. It checks if _wp_render_title_tag function exists
	 * and if it does'nt it generates output. Compatible with versions of WP prior to 4.1
	 */
	function wp_seo_title() {
		//get current post id
		$id           = startit_qode_get_page_id();
		$seo_title    = get_post_meta($id, "qodef_meta_title_meta", true);
		$seo_enabled  = startit_qode_options()->getOptionValue('disable_seo') !== 'yes';

		if ( $seo_enabled && $seo_title !== '') {
			remove_action('wp_head', '_wp_render_title_tag', 1);

			if ( ! current_theme_supports( 'title-tag' ) ) {
				return;
			}

			echo '<title>' . _wp_get_document_seo_title($seo_title, '') . '</title>' . "\n";
		}
	}
}

if(!function_exists( '_wp_get_document_seo_title' )) {
	function _wp_get_document_seo_title()	{

		/**
		 * Filters the document title before it is generated.
		 *
		 * Passing a non-empty value will short-circuit wp_get_document_title(),
		 * returning that value instead.
		 *
		 * @since 4.4.0
		 *
		 * @param string $title The document title. Default empty string.
		 */

		//is qode seo enabled?
		$title = startit_qode_wp_title_text('', '');

		if (!empty($title)) {
			return $title;
		}

		global $page, $paged;

		$title = array(
			'title' => '',
		);

		// If it's a 404 page, use a "Page not found" title.
		if (is_404()) {
			$title['title'] = __('Page not found');

			// If it's a search, use a dynamic search results title.
		} elseif (is_search()) {
			/* translators: %s: search phrase */
			$title['title'] = sprintf(__('Search Results for &#8220;%s&#8221;'), get_search_query());

			// If on the front page, use the site title.
		} elseif (is_front_page()) {
			$title['title'] = get_bloginfo('name', 'display');

			// If on a post type archive, use the post type archive title.
		} elseif (is_post_type_archive()) {
			$title['title'] = post_type_archive_title('', false);

			// If on a taxonomy archive, use the term title.
		} elseif (is_tax()) {
			$title['title'] = single_term_title('', false);

			/*
			* If we're on the blog page that is not the homepage or
			* a single post of any post type, use the post title.
			*/
		} elseif (is_home() || is_singular()) {
			$title['title'] = single_post_title('', false);

			// If on a category or tag archive, use the term title.
		} elseif (is_category() || is_tag()) {
			$title['title'] = single_term_title('', false);

			// If on an author archive, use the author's display name.
		} elseif (is_author() && $author = get_queried_object()) {
			$title['title'] = $author->display_name;

			// If it's a date archive, use the date as the title.
		} elseif (is_year()) {
			$title['title'] = get_the_date(_x('Y', 'yearly archives date format'));

		} elseif (is_month()) {
			$title['title'] = get_the_date(_x('F Y', 'monthly archives date format'));

		} elseif (is_day()) {
			$title['title'] = get_the_date();
		}

		// Add a page number if necessary.
		if (($paged >= 2 || $page >= 2) && !is_404()) {
			$title['page'] = sprintf(__('Page %s'), max($paged, $page));
		}

		// Append the description or site title to give context.
		if (is_front_page()) {
			$title['tagline'] = get_bloginfo('description', 'display');
		} else {
			$title['site'] = get_bloginfo('name', 'display');
		}

		/**
		 * Filters the separator for the document title.
		 *
		 * @since 4.4.0
		 *
		 * @param string $sep Document title separator. Default '-'.
		 */
		$sep = apply_filters('document_title_separator', '-');

		/**
		 * Filters the parts of the document title.
		 *
		 * @since 4.4.0
		 *
		 * @param array $title {
		 *     The document title parts.
		 *
		 * @type string $title Title of the viewed page.
		 * @type string $page Optional. Page number if paginated.
		 * @type string $tagline Optional. Site description when on home page.
		 * @type string $site Optional. Site title when not on home page.
		 * }
		 */
		$title = apply_filters('document_title_parts', $title);

		$title = implode(" $sep ", array_filter($title));
		$title = wptexturize($title);
		$title = convert_chars($title);
		$title = esc_html($title);
		$title = capital_P_dangit($title);

		return $title;
	}
}

if(!function_exists( 'startit_qode_wp_title' )) {
	/**
	 * Function that outputs title tag. It checks if _wp_render_title_tag function exists
	 * and if it does'nt it generates output. Compatible with versions of WP prior to 4.1
	 */
	function startit_qode_wp_title() {
		if(!function_exists('_wp_render_title_tag')) { ?>
			<title><?php wp_title(''); ?></title>
		<?php }	else {
			wp_seo_title();
		}
	}
}

if(!function_exists( 'startit_qode_header_meta' )) {
	/**
	 * Function that echoes meta data if our seo is enabled
	 */
	function startit_qode_header_meta() {

		if( startit_qode_is_seo_enabled() && !startit_qode_seo_plugin_installed()) {
			$seo_description = startit_qode_get_meta_field_intersect('qodef_meta_description');
			$seo_keywords    = startit_qode_get_meta_field_intersect('qodef_meta_keywords');
			?>

			<?php if($seo_description) { ?>
				<meta name="description" content="<?php echo esc_html($seo_description); ?>">
			<?php } ?>

			<?php if($seo_keywords) { ?>
				<meta name="keywords" content="<?php echo esc_html($seo_keywords); ?>">
			<?php }
		} ?>

		<meta charset="<?php bloginfo('charset'); ?>"/>
		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
	<?php }

	add_action('qode_startit_header_meta', 'startit_qode_header_meta');
}

if(!function_exists( 'startit_qode_user_scalable_meta' )) {
	/**
	 * Function that outputs user scalable meta if responsiveness is turned on
	 * Hooked to qode_startit_header_meta action
	 */
	function startit_qode_user_scalable_meta() {
		//is responsiveness option is chosen?
		if(startit_qode_is_responsive_on()) { ?>
			<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
		<?php } else { ?>
			<meta name="viewport" content="width=1200,user-scalable=no">
		<?php }
	}

	add_action('qode_startit_header_meta', 'startit_qode_user_scalable_meta');
}

if(!function_exists( 'startit_qode_get_page_id' )) {
	/**
	 * Function that returns current page / post id.
	 * Checks if current page is woocommerce page and returns that id if it is.
	 * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
	 * page that is created in WP admin.
	 *
	 * @return int
	 *
	 * @version 0.1
	 *
	 * @see startit_qode_is_woocommerce_installed()
	 * @see startit_qode_is_woocommerce_shop()
	 */
	function startit_qode_get_page_id() {
		if( startit_qode_is_woocommerce_installed() && startit_qode_is_woocommerce_shop()) {
			return startit_qode_get_woo_shop_page_id();
		}

		if ( startit_qode_is_default_wp_template() ) {
			return -1;
		}

		return get_queried_object_id();
	}
}


if(!function_exists( 'startit_qode_is_default_wp_template' )) {
	/**
	 * Function that checks if current page archive page, search, 404 or default home blog page
	 * @return bool
	 *
	 * @see is_archive()
	 * @see is_search()
	 * @see is_404()
	 * @see is_front_page()
	 * @see is_home()
	 */
	function startit_qode_is_default_wp_template() {
		return is_archive() || is_search() || is_404() || (is_front_page() && is_home());
	}
}

if(!function_exists( 'startit_qode_get_page_template_name' )) {
	/**
	 * Returns current template file name without extension
	 * @return string name of current template file
	 */
	function startit_qode_get_page_template_name() {
		$file_name = '';

		if(!startit_qode_is_default_wp_template()) {
			$file_name_without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename(get_page_template()));

			if($file_name_without_ext !== '') {
				$file_name = $file_name_without_ext;
			}
		}

		return $file_name;
	}
}

if(!function_exists( 'startit_qode_has_shortcode' )) {
	/**
	 * Function that checks whether shortcode exists on current page / post
	 *
	 * @param string shortcode to find
	 * @param string content to check. If isn't passed current post content will be used
	 *
	 * @return bool whether content has shortcode or not
	 */
	function startit_qode_has_shortcode($shortcode, $content = '') {
		$has_shortcode = false;

		if($shortcode) {
			//if content variable isn't past
			if($content == '') {
				//take content from current post
				$page_id = startit_qode_get_page_id();
				if(!empty($page_id)) {
					$current_post = get_post($page_id);

					if(is_object($current_post) && property_exists($current_post, 'post_content')) {
						$content = $current_post->post_content;
					}
				}
			}

			//does content has shortcode added?
			if(stripos($content, '['.$shortcode) !== false) {
				$has_shortcode = true;
			}
		}

		return $has_shortcode;
	}
}

if(!function_exists( 'startit_qode_rewrite_rules_on_theme_activation' )) {
	/**
	 * Function that flushes rewrite rules on deactivation
	 */
	function startit_qode_rewrite_rules_on_theme_activation() {
		flush_rewrite_rules();
	}

	add_action('after_switch_theme', 'startit_qode_rewrite_rules_on_theme_activation');
}

if(!function_exists( 'startit_qode_get_dynamic_sidebar' )) {
	/**
	 * Return Custom Widget Area content
	 *
	 * @return string
	 */
	function startit_qode_get_dynamic_sidebar($index = 1) {
		ob_start();
		dynamic_sidebar($index);
		$sidebar_contents = ob_get_clean();

		return $sidebar_contents;
	}
}

if(!function_exists( 'startit_qode_get_sidebar' )) {
	/**
	 * Return Sidebar
	 *
	 * @return string
	 */
	function startit_qode_get_sidebar() {

		$id = startit_qode_get_page_id();

		$sidebar = "sidebar";

		if (get_post_meta($id, 'qodef_custom_sidebar_meta', true) != '') {
			$sidebar = get_post_meta($id, 'qodef_custom_sidebar_meta', true);
		} else {
			if ( is_single() && startit_qode_options()->getOptionValue('blog_single_custom_sidebar') != '') {
				$sidebar = esc_attr(startit_qode_options()->getOptionValue('blog_single_custom_sidebar'));
			}elseif( ( startit_qode_is_product_category() || startit_qode_is_product_tag()) && startit_qode_get_woo_shop_page_id()) {
				$shop_id = startit_qode_get_woo_shop_page_id();
				if(get_post_meta($shop_id, 'qodef_custom_sidebar_meta', true) != '') {
					$sidebar = esc_attr(get_post_meta($shop_id, 'qodef_custom_sidebar_meta', true));
				}
			} elseif ( (is_archive() || (is_home() && is_front_page())) && startit_qode_options()->getOptionValue('blog_custom_sidebar') != '') {
				$sidebar = esc_attr(startit_qode_options()->getOptionValue('blog_custom_sidebar'));
			} elseif ( is_page() && startit_qode_options()->getOptionValue('page_custom_sidebar') != '') {
				$sidebar = esc_attr(startit_qode_options()->getOptionValue('page_custom_sidebar'));
			}
		}

		return $sidebar;
	}
}



if( !function_exists( 'startit_qode_sidebar_columns_class' ) ) {

	/**
	 * Return classes for columns holder when sidebar is active
	 *
	 * @return array
	 */

	function startit_qode_sidebar_columns_class() {

		$sidebar_class = array();
		$sidebar_layout = startit_qode_sidebar_layout();

		switch($sidebar_layout):
			case 'sidebar-33-right':
				$sidebar_class[] = 'qodef-two-columns-66-33';
				break;
			case 'sidebar-25-right':
				$sidebar_class[] = 'qodef-two-columns-75-25';
				break;
			case 'sidebar-33-left':
				$sidebar_class[] = 'qodef-two-columns-33-66';
				break;
			case 'sidebar-25-left':
				$sidebar_class[] = 'qodef-two-columns-25-75';
				break;

		endswitch;

		$sidebar_class[] = 'qodef-content-has-sidebar  clearfix';

		return startit_qode_class_attribute($sidebar_class);

	}

}


if( !function_exists( 'startit_qode_sidebar_layout' ) ) {

	/**
	 * Function that check is sidebar is enabled and return type of sidebar layout
	 */

	function startit_qode_sidebar_layout() {

		$sidebar_layout = '';
		$page_id = startit_qode_get_page_id();

		$page_sidebar_meta = get_post_meta($page_id, 'qodef_sidebar_meta', true);

		if ( ($page_sidebar_meta !== '' && get_post_meta(startit_qode_get_page_id(), "qodef_sidebar_meta", true) != 'default') && $page_id !== -1) {
			if ($page_sidebar_meta == 'no-sidebar') {
				$sidebar_layout = '';
			} else {
				$sidebar_layout = $page_sidebar_meta;
			}
		} else {
			if ( is_single() && startit_qode_options()->getOptionValue('blog_single_sidebar_layout')) {
				$sidebar_layout = esc_attr(startit_qode_options()->getOptionValue('blog_single_sidebar_layout'));
			} elseif ( ( startit_qode_is_product_category() || startit_qode_is_product_tag()) && startit_qode_get_woo_shop_page_id()) {
				$shop_id = startit_qode_get_woo_shop_page_id();
				if (get_post_meta($shop_id, 'qodef_sidebar_meta', true) != '') {
					$sidebar_layout = esc_attr(get_post_meta($shop_id, 'qodef_sidebar_meta', true));
				}
			} elseif ( (is_archive() || (is_home() && is_front_page())) && startit_qode_options()->getOptionValue('archive_sidebar_layout')) {
				$sidebar_layout = esc_attr(startit_qode_options()->getOptionValue('archive_sidebar_layout'));
			} elseif ( is_page() && startit_qode_options()->getOptionValue('page_sidebar_layout')) {
				$sidebar_layout = esc_attr(startit_qode_options()->getOptionValue('page_sidebar_layout'));
			}
		}

		return $sidebar_layout;
	}

}


if( !function_exists( 'startit_qode_page_custom_style' ) ) {

	/**
	 * Function that print custom page style
	 */

	function startit_qode_page_custom_style() {
		$style = '';
		$html = '';
		$style = apply_filters('qode_startit_add_page_custom_style', $style);
		if($style !== '') {
			$html .= '<style type="text/css">';
			$html .= $style;
			$html .= '</style>';
		}
		startit_qode_module_part( $html );
	}

	add_action('wp_head', 'startit_qode_page_custom_style');
}


if( !function_exists( 'startit_qode_container_style' ) ) {

	/**
	 * Function that return container style
	 */

	function startit_qode_container_style($style) {

		$id = startit_qode_get_page_id();

		$container_selector = array(
			'.page-id-' . $id . ' .qodef-content .qodef-content-inner > .qodef-container',
			'.page-id-' . $id . ' .qodef-content .qodef-content-inner > .qodef-full-width'
		);
		$container_class = array();

		$page_backgorund_color = get_post_meta($id, "qodef_page_background_color_meta", true);

		if($page_backgorund_color){
			$container_class['background-color'] = $page_backgorund_color;
		}

		$current_style = startit_qode_dynamic_css($container_selector, $container_class);

		$current_style = $current_style . $style;

		return $current_style;

	}
	add_filter('qode_startit_add_page_custom_style', 'startit_qode_container_style');
}

if(!function_exists( 'startit_qode_print_custom_css' )) {
	/**
	 * Prints out custom css from theme options
	 */
	function startit_qode_print_custom_css() {
		$custom_css = startit_qode_options()->getOptionValue('custom_css');
		$output = '';

		if($custom_css !== '') {
			$output .= '<style type="text/css" id="qode_startit-custom-css">';
			$output .= $custom_css;
			$output .= '</style>';
		}

		startit_qode_module_part( $output );
	}

	add_action('wp_head', 'startit_qode_print_custom_css', 1000);
}

if(!function_exists( 'startit_qode_print_custom_js' )) {
	/**
	 * Prints out custom css from theme options
	 */
	function startit_qode_print_custom_js() {
		$custom_js = startit_qode_options()->getOptionValue('custom_js');
		$output = '';

		if($custom_js !== '') {
			$output .= '<script type="text/javascript" id="qode_startit-custom-js">';
			$output .= '(function($) {';
			$output .= $custom_js;
			$output .= '})(jQuery)';
			$output .= '</script>';
		}

		startit_qode_module_part( $output );
	}

	add_action('wp_footer', 'startit_qode_print_custom_js', 1000);
}


if(!function_exists( 'startit_qode_content_elem_style_attr' )) {
	/**
	 * Defines filter for adding custom styles to content HTML element
	 */
	function startit_qode_content_elem_style_attr() {
		$styles = apply_filters('qode_startit_content_elem_style_attr', array());

		startit_qode_inline_style($styles);
	}
}

if(!function_exists( 'startit_qode_is_woocommerce_installed' )) {
	/**
	 * Function that checks if woocommerce is installed
	 * @return bool
	 */
	function startit_qode_is_woocommerce_installed() {
		return function_exists('is_woocommerce');
	}
}

if(!function_exists( 'startit_qode_visual_composer_installed' )) {
	/**
	 * Function that checks if visual composer installed
	 * @return bool
	 */
	function startit_qode_visual_composer_installed() {
		//is Visual Composer installed?
		if(class_exists('WPBakeryVisualComposerAbstract')) {
			return true;
		}

		return false;
	}
}

if(!function_exists( 'startit_qode_seo_plugin_installed' )) {
	/**
	 * Function that checks if popular seo plugins are installed
	 * @return bool
	 */
	function startit_qode_seo_plugin_installed() {
		//is 'YOAST' or 'All in One SEO' installed?
		if(defined('WPSEO_VERSION') || class_exists('All_in_One_SEO_Pack')) {
			return true;
		}

		return false;
	}
}

if(!function_exists( 'startit_qode_contact_form_7_installed' )) {
	/**
	 * Function that checks if contact form 7 installed
	 * @return bool
	 */
	function startit_qode_contact_form_7_installed() {
		//is Contact Form 7 installed?
		if(defined('WPCF7_VERSION')) {
			return true;
		}

		return false;
	}
}

if(!function_exists( 'startit_qode_is_wpml_installed' )) {
	/**
	 * Function that checks if WPML plugin is installed
	 * @return bool
	 *
	 * @version 0.1
	 */
	function startit_qode_is_wpml_installed() {
		return defined('ICL_SITEPRESS_VERSION');
	}
}


if(!function_exists( 'startit_qode_is_live_search_installed' )) {
	/**
	 * Function that checks if Dave's WordPress Live Search plugin is installed
	 * @return bool
	 *
	 * @version 0.1
	 */
	function startit_qode_is_live_search_installed() {
		return function_exists('daves_wp_live_search_init');
	}
}

if(!function_exists( 'starit_qode_remove_admin_menu_items' )) {
	function starit_qode_remove_admin_menu_items() {
		if (startit_qode_is_live_search_installed()) {
			remove_submenu_page("options-general.php", "daves-wordpress-live-search/class-daves-wordpress-live-search.php");
		}
	}

	add_action('admin_menu', 'starit_qode_remove_admin_menu_items', 999);
}


if ( ! function_exists( 'startit_qode_gutenberg_css' ) ) {
	/**
	 * Function that checks if Gutenberg plugin installed
	 */
	function startit_qode_gutenberg_css() {
		if ( startit_qode_is_gutenberg_installed() ) {
			if ( is_admin() ) {
				wp_enqueue_style( 'gutenberg-fix', get_template_directory_uri() . '/css/gutenberg.css', array(), '1.0' );
			}
		}
	}

	add_action( 'admin_enqueue_scripts', 'startit_qode_gutenberg_css' );
}

if ( ! function_exists( 'startit_qode_enqueue_editor_customizer_styles' ) ) {
	/**
	 * Enqueue supplemental block editor styles
	 */

	function startit_qode_enqueue_editor_customizer_styles() {
		$protocol = is_ssl() ? 'https:' : 'http:';
		//include default google font that theme is using
		$default_fonts_args   = array(
			'family' => urlencode( 'Open Sans:300,400,600,700' ),
			'subset' => urlencode( 'latin-ext' ),
		);
		$startit_global_fonts = add_query_arg( $default_fonts_args, $protocol . '//fonts.googleapis.com/css' );
		wp_enqueue_style( 'startit-editor-google-fonts', esc_url_raw( $startit_global_fonts ) );

		wp_enqueue_style( 'startit-editor-customizer-style', QODE_ROOT . '/framework/admin/assets/css/editor-customizer-style.css' );
		wp_enqueue_style( 'startit-editor-blocks-style', QODE_ROOT . '/framework/admin/assets/css/editor-blocks-style.css' );
	}

	add_action( 'enqueue_block_editor_assets', 'startit_qode_enqueue_editor_customizer_styles' );
}

if ( ! function_exists( 'startit_qode_is_plugin_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param $plugin string
	 *
	 * @return bool
	 */
	function startit_qode_is_plugin_installed( $plugin ) {
		switch ( $plugin ) {
			case 'core':
				return defined( 'QODE_CORE_VERSION' );
				break;
            case 'twitter-feed':
				return defined( 'QODEF_TWITTER_FEED_VERSION' );
				break;
			case 'woocommerce':
				return function_exists( 'is_woocommerce' );
				break;
			case 'visual-composer':
				return class_exists( 'WPBakeryVisualComposerAbstract' );
				break;
			case 'revolution-slider':
				return class_exists( 'RevSliderFront' );
				break;
			case 'layerslider':
				return defined( 'LS_PLUGIN_VERSION' );
				break;
			case 'contact-form-7':
				return defined( 'WPCF7_VERSION' );
				break;
			case 'wpml':
				return defined( 'ICL_SITEPRESS_VERSION' );
				break;
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
				break;
			case 'gutenberg-plugin':
				return function_exists( 'is_gutenberg_page' ) && is_gutenberg_page();
				break;
			case 'yoast':
				return defined( 'WPSEO_VERSION' );
				break;
			default:
				return false;
				break;
		}
	}
}


/*=================================================================================
 * #Gutenberg helper functions
 *=================================================================================*/

if ( ! function_exists( 'startit_qode_is_gutenberg_installed' ) ) {
	/**
	 * Function that checks if Gutenberg plugin installed
	 * @return bool
	 */
	function startit_qode_is_gutenberg_installed() {
		if ( startit_qode_is_plugin_installed( 'gutenberg-plugin' ) ) {
			return true;
		}

		return false;
	}
}



