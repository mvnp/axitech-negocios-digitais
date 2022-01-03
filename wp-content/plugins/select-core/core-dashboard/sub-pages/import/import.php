<?php

if ( ! function_exists( 'add_action' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

class SelectCoreImport {
	/**
	 * @var instance of current class
	 */
	private static $instance;

	/**
	 * Name of folder where revolution slider will stored
	 * @var string
	 */
	private $revSliderFolder;

    /**
     * Name of folder where layer slider will stored
     * @var string
     */
    private $layerSliderFolder;

	/**
	 *
	 * URL where are import files
	 * @var string
	 */
	private $importURI;

	/**
	 * @return SelectCoreImport
	 */
	public static function get_instance() {
		if ( self::$instance === null ) {
			return new self();
		}

		return self::$instance;
	}

	public $message = array();
	public $data    = array();
	public $status;
	public $attachments = false;
	public $imported_posts = array();

	function __construct() {
		$this->revSliderFolder = 'qodef-rev-sliders';

		add_action('admin_init', array(&$this, 'set_import_url'));
		add_action('wp_ajax_import_action', array(&$this, 'import_action'));
		add_action('wp_ajax_populate_single_pages', array(&$this, 'populate_single_pages'));

	}

	public  function set_status($status){
			$this->status = $status;
	}

	public  function get_status(){
		return $this->status;
	}

	public  function set_message($message){
		$this->message = $message;
	}

	public  function get_message(){
		return $this->message;
	}

	public  function set_data($key, $value){
		$this->data[$key] = $value;
	}

	public  function get_data(){
		return $this->data;
	}

	public function set_import_url() {
		$params = SelectCoreDashboard::get_instance()->get_import_params();

		if(is_array($params) && isset($params['url'])) {
			$this->importURI = $params['url'];
		}
	}

	public function import_action() {


			if (isset($_POST) || !empty($_POST) || isset($_POST['options']['demo'])) {

				if ( wp_verify_nonce( $_POST['options']['nonce'], 'qodef_cd_import_nonce' ) ) {
					$demo = trailingslashit($_POST['options']['demo']);

					switch ($_POST['options']['action']):
						case 'widgets':
							$this->import_widgets($demo);
							break;
						case 'options':
							$this->import_options($demo);
							break;
						case 'settings-page':
							$this->import_settings_pages($demo);
							break;
						case 'menu-settings':
							$this->import_menu_settings($demo);
							break;
						case 'rev-slider':
							if (qode_core_is_revolution_slider_installed()) {
								$this->rev_slider_import($demo);
							} else {
								$this->set_status('success');
								$this->set_data('type', 'options');
								$this->set_message(esc_html__('Revolution Slider isn\'t installed', 'qodef-cpt'));
							}
							break;
                        case 'layer-slider':
                            if ( qode_core_is_layer_slider_installed() ) {
                                $this->layer_slider_import($demo);
                            } else {
                                $this->set_status('success');
                                $this->set_data('type', 'options');
                                $this->set_message(esc_html__('Layer Slider isn\'t installed', 'qodef-cpt'));
                            }
                            break;
						case 'content':
							$xml = isset($_POST['options']['xml']) ? $_POST['options']['xml'] : '';
							$attachments = (isset($_POST['options']['images']) && $_POST['options']['images'] == 1) ? true : false;
							$post_id = isset($_POST['options']['post_id']) ? $_POST['options']['post_id'] : '';
							$update_url = isset($_POST['options']['updateURL']) ? $_POST['options']['updateURL'] : false;
							$content_start = isset($_POST['options']['contentStart']) ? $_POST['options']['contentStart'] : false;

							if($content_start) {
								if (!SelectCoreDashboard::get_instance()->check_purchase_code($_POST['options']['demo'])) {
									qode_core_ajax_status('error', esc_html__('Please don\'t try to hack me. Purchase code registered is not valid', 'qodef-cpt'));
									exit;
								}
							}
							$this->import_content($demo, $xml, $attachments, $post_id);

							if($update_url){
								$this->update_meta_fields_after_import($demo);
							}

							break;
					endswitch;

			}

			qode_core_ajax_status($this->get_status(), $this->get_message(), $this->get_data());
		}
		wp_die();
	}

	public function unserialized_content( $file ) {

		$file_content = $this->file_content( $file );

		if ( $file_content ) {
			$unserialized_content = unserialize( base64_decode( $file_content ) );

			if ( $unserialized_content ) {
				return $unserialized_content;
			}
		}

		return false;
	}

	function file_content( $path ) {
		$url      = $this->importURI . $path;
		$response = wp_remote_get( $url );

		if ( is_wp_error( $response ) ) {
			$this->message[] = $response->get_error_message() . ' ' . $path;
			return false;
		}

		$response_code = wp_remote_retrieve_response_code( $response );

		if ( 200 !== intval( $response_code ) ) {
			$this->set_message($response["response"]['message'] . ' ' . esc_html__('Please contact support', 'qodef-cpt'));
			$this->set_status('error');
			return false;
		}

		$body  = wp_remote_retrieve_body( $response );


		return $body;
	}

	public function import_widgets($demo) {
		$widgets         = $demo . 'widgets.txt';
		$custom_sidebars = $demo . 'custom_sidebars.txt';

		$cs_result = $this->import_custom_sidebars( $custom_sidebars );

		$widgets_content = $this->unserialized_content($widgets);
		if($widgets_content) {
			foreach ((array)$widgets_content['widgets'] as $startit_widget_id => $startit_widget_data) {
				update_option('widget_' . $startit_widget_id, $startit_widget_data);
			}
			$ws = $this->import_sidebars_widgets($widgets);
			if($ws) {
				$this->set_message(esc_html__('Widgets are set for proper sidebar', 'qodef-cpt'));
				$this->set_data('type', 'options');
				$this->set_status('success');
			}
		}
	}

	public function import_sidebars_widgets( $file ) {
		$startit_sidebars = get_option( "sidebars_widgets" );
		unset( $startit_sidebars['array_version'] );
		$data = $this->unserialized_content( $file );

		if ( $data && is_array( $data['sidebars'] ) ) {
			$startit_sidebars = array_merge( (array) $startit_sidebars, (array) $data['sidebars'] );
			unset( $startit_sidebars['wp_inactive_widgets'] );
			$startit_sidebars                  = array_merge( array( 'wp_inactive_widgets' => array() ), $startit_sidebars );
			$startit_sidebars['array_version'] = 2;
			wp_set_sidebars_widgets( $startit_sidebars );
			return true;
		} else {
			return false;
		}
	}

	public function import_custom_sidebars( $file ) {
		$options = $this->unserialized_content( $file );

		if($options) {
			$results = update_option('qodef_sidebars', $options);

			if ($results) {
				return $results;
			} else {
				return false;
			}
		}
	}

	public function import_options( $file ) {

		$options_file = $file . 'options.txt';

		$options       = $this->unserialized_content( $options_file );
		$current_options = get_option(QODE_CORE_OPTIONS_NAME);
		if($options){
			if($current_options != $options) {
				$result = update_option(QODE_CORE_OPTIONS_NAME, $options);
				if ($result) {
					$this->update_options_after_import($file);
					$this->set_status('success');
					$this->set_data('type', 'options');
					$this->set_message(esc_html__('Options imported successfully', 'qodef-cpt'));

					$this->update_options_after_import($file);

				} else {
					$this->set_status('error');
					$this->set_message(esc_html__('Problem occurred during options import', 'qodef-cpt'));
				}
			} else {
				$this->set_status('success');
				$this->set_data('type', 'options');
				$this->set_message(esc_html__('Options are already imported', 'qodef-cpt'));
			}
		}

        if(startit_qode_is_elementor_installed()){
            $this->import_elementor_options($file);
        }
	}

    public function import_elementor_options( $file ) {

        $options_file = $file . 'elementor_options.txt';
        $options       = $this->unserialized_content( $options_file );

        if(is_array($options) && count($options) > 0){

            foreach ($options as $options_key => $option){
                update_option('elementor_' . $options_key, $option);
            }
            if(isset($options['disable_typography_schemes'])){
                unset($options['disable_typography_schemes']);
            }
            if(isset($options['disable_color_schemes'])){
                unset($options['disable_color_schemes']);
            }
            update_option('_elementor_general_settings', $options);
        }
    }

    public function import_settings_pages( $file ) {

        $settings_file = $file . 'settingpages.txt';

        $fields = array(
            'show_on_front'		=> get_option( 'show_on_front' ),
            'page_on_front'		=> get_option( 'page_on_front' ),
            'page_for_posts'	=> get_option( 'page_for_posts' )
        );

        $pages = $this->unserialized_content( $settings_file );

        $new_ids = get_transient( '_wilmer_core_imported_posts' );
        $fields_status = true;

        if($pages) {
            if( $pages['show_on_front'] != $fields['show_on_front']) {
                $fields_status = update_option('show_on_front', $pages['show_on_front']);
            }
            if(is_array($new_ids) && count($new_ids) > 0) {
                if ($pages['page_on_front'] != 0 && ($new_ids[$pages['page_on_front']] != $fields['page_on_front'])) {
                    $fields_status = update_option('page_on_front', $new_ids[$pages['page_on_front']]);
                }
                if ($pages['page_for_posts'] != 0 && ($new_ids[$pages['page_for_posts']] != $fields['page_for_posts'])) {
                    $fields_status = update_option('page_for_posts', $new_ids[$pages['page_for_posts']]);
                }
            } else {
                if ($pages['page_on_front'] != 0 && ($pages['page_on_front'] != $fields['page_on_front'])) {
                    $fields_status = update_option('page_on_front', $pages['page_on_front']);
                }
                if ($pages['page_for_posts'] != 0 && ($pages['page_for_posts'] != $fields['page_for_posts'])) {
                    $fields_status = update_option('page_for_posts', $pages['page_for_posts']);
                }
            }

            if (!$fields_status) {
                $this->set_status('error');
                $this->set_message(esc_html__('Problem occurred during settings pages import', 'wilmer-core'));
            } else {
                $this->set_status('success');
                $this->set_data('type', 'options');
                $this->set_message(esc_html__('Settings pages imported successfully', 'wilmer-core'));
            }
        } else {
            $this->set_status('error');
            $this->set_message(esc_html__('File doesn\'t exist', 'wilmer-core'));
        }
    }

	public function import_menu_settings( $file ) {
		global $wpdb;

		$menus_file = $file . 'menus.txt';

		$menus_data = $this->unserialized_content( $menus_file );
		if($menus_data) {
			$menu_array = array();
			$terms_table = $wpdb->prefix . "terms";

			foreach ($menus_data as $registered_menu => $menu_slug) {
				$term_rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$terms_table} where slug=%s", $menu_slug), ARRAY_A);

				if (isset($term_rows[0]['term_id'])) {
					$term_id_by_slug = $term_rows[0]['term_id'];
				} else {
					$term_id_by_slug = null;
				}

				$menu_array[$registered_menu] = $term_id_by_slug;
			}

			set_theme_mod('nav_menu_locations', array_map('absint', $menu_array));

			$this->set_status('success');
			$this->set_data('type', 'options');
			$this->set_message( esc_html__( 'Menus set for proper locations', 'qodef-cpt' ) );
		} else {
			$this->set_status('error');
			$this->set_message( esc_html__( 'Problem during menus location set', 'qodef-cpt' ) );
		}
	}


	public function import_content( $file, $xml, $attachments, $post_id) {
		ob_start();
		require_once( QODE_CORE_ABS_PATH . '/core-dashboard/sub-pages/import/wordpress-importer.php' );


//		if ( $placeholder ) {
//			add_filter( 'wp_import_post_data_raw', array( $this, 'replace_image_with_placeholder' ) );
//		}
//
		if( qode_core_is_woocommerce_installed() ) {
			add_filter('wp_import_posts', array($this, 'proccess_wc_attributes'));
		}


		if(!empty($post_id)){

			add_filter('wp_import_posts', function ($posts) use ($post_id) {

				$single_page = array();
				foreach ($posts as $post) {
					if($post['post_type'] == 'page' && $post['post_id'] == $post_id){
						$single_page[] = $post;
						break;
					}
				}

				return $single_page;
			}, 10, 2);


		}

		$startit_import = new WP_Import();
		set_time_limit( 0 );

		$startit_import->fetch_attachments = $attachments;
		$returned_value                  = $startit_import->import( $file . $xml );


		if ( is_wp_error( $returned_value ) ) {
			$this->set_status('error');
			$this->set_data('type', 'content');
			$this->set_data('xml', $xml);
			$this->set_message( esc_html__( 'An error occurred during content import', 'qodef-cpt' ) );
		} else {
			$this->set_status('success');
			$this->set_data('type', 'content');
			$this->set_data('posts', $this->imported_posts);
			$this->set_message( esc_html__( 'File imported successfully', 'qodef-cpt' ) . ' ' . $xml );

		}

		//$str = ob_get_contents();

		ob_get_clean();

		//return $file;
	}

	public function rev_sliders( $folder ) {
		$rev_sldiers = array(
		    'startit-bakery' => array(
                'angle-slider.zip',
                'app-slider.zip',
                'app-slider-2.zip',
                'seo_home.zip',
                'slider10.zip',
                'wa-home-top-slider.zip',
                'web-agency-home-content.zip',
                'whiteboard.zip'
            ),
            'startit-elementor' => array(
                'angle-slider.zip',
                'app-slider.zip',
                'app-slider-2.zip',
                'seo_home.zip',
                'slider10.zip',
                'wa-home-top-slider.zip',
                'web-agency-home-content.zip',
                'whiteboard.zip'
            ),
            'startit1-bakery' => '',
            'startit1-elementor' => '',
		);

		$folder = str_replace('/', '', $folder);

		return $rev_sldiers[$folder];
	}

    public function rev_slider_pairs() {
        $rev_sldiers = array(
            "1" => "4",
            "4" => "5",
            "5" => "8",
            "6" => "7",
            "7" => "6",
            "9" => "1",
            "10" => "8",
        );

        return $rev_sldiers;
    }

    public function layer_sliders( $folder ) {
        $layer_sliders = array(
            'startit-bakery' => array(
                'layerslider-export.zip'
            ),
            'startit-elementor' => array(
                'layerslider-export.zip'
            ),
            'startit1-bakery' => '',
            'startit1-elementor' => '',
        );

        $folder = str_replace('/', '', $folder);

        return $layer_sliders[$folder];
    }

	public function create_rev_slider_files( $folder ) {
		$rev_list = $this->rev_sliders( $folder );
		$dir_name = $this->revSliderFolder;

		$upload     = wp_upload_dir();
		$upload_dir = $upload['basedir'];
		$upload_dir = $upload_dir . '/' . $dir_name;
		if ( ! is_dir( $upload_dir ) ) {
			mkdir( $upload_dir, 0700 );
		}
		mkdir( $upload_dir . '/' . $folder, 0700 );

		if( is_array( $rev_list ) && count( $rev_list ) > 0 ) {
            foreach ($rev_list as $rev_slider) {

                $file_data = file_get_contents($this->importURI . $folder . '/revslider/' . $rev_slider);

                if ($file_data) {
                    file_put_contents(
                        WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider,
                        $file_data);
                } else {
                    return false;
                }
            }
        }

		return true;
	}

	public function rev_slider_import( $folder ) {
		$files_created = $this->create_rev_slider_files( $folder );

		if($files_created) {
			$rev_sliders = $this->rev_sliders( $folder );
			$dir_name = $this->revSliderFolder;
			$absolute_path = __FILE__;
			$path_to_file = explode('wp-content', $absolute_path);
			$path_to_wp = $path_to_file[0];

			require_once($path_to_wp . '/wp-load.php');
			require_once($path_to_wp . '/wp-includes/functions.php');
			require_once($path_to_wp . '/wp-admin/includes/file.php');


			$rev_slider_instance = new RevSlider();

            if( is_array( $rev_sliders ) && count( $rev_sliders ) > 0 ) {
                foreach ($rev_sliders as $rev_slider) {
                    $nf = WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . $rev_slider;
                    $rev_results = $rev_slider_instance->importSliderFromPost(true, true, $nf);

                    if (!$rev_results['success']) {
                        $this->set_status('error');
                        $this->set_message(esc_html__('Error while importing rev sliders', 'qodef-cpt'));
                        exit;
                    }
                }
            }

            $this->update_rev_slider_in_elementor_after_import();

			$this->set_status('success');
			$this->set_data('type', 'options');
			$this->set_message(esc_html__('Rev sliders imported successfully', 'qodef-cpt'));
		} else {
			$this->set_status('error');
			$this->set_data('type', 'options');
			$this->set_message(esc_html__('Files don\'t exist', 'qodef-cpt'));
		}
	}

    public function create_layer_slider_files($folder) {
        $layer_list = $this->layer_sliders( $folder );
        $dir_name = $this->layerSliderFolder;

        $upload = wp_upload_dir();
        $upload_dir = $upload['basedir'];
        $upload_dir = $upload_dir . '/' . $dir_name;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0700);
        }

        mkdir($upload_dir . '/' . $folder, 0700);

        if( is_array( $layer_list ) && count( $layer_list ) > 0 ) {
            foreach ($layer_list as $layer_slider) {
                $file_data = file_get_contents($this->importURI . '/' . $folder . '/layerslider/' . $layer_slider);

                if ($file_data) {
                    file_put_contents(
                        WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $layer_slider,
                        $file_data);
                } else {
                    return false;
                }

            }
        }

        return true;
    }

    public function layer_slider_import($folder) {
        $files_created = $this->create_layer_slider_files($folder);

        if( $files_created ){

            $layer_sliders = $this->layer_sliders( $folder );
            $dir_name = $this->layerSliderFolder;

            include LS_ROOT_PATH . '/classes/class.ls.importutil.php';

            if( is_array( $layer_sliders ) && count( $layer_sliders ) > 0 ) {
                foreach ($layer_sliders as $layer_slider) {
                    $nf = WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $layer_slider;
                    $import = new LS_ImportUtil($nf);
                }
            }

            $this->set_status('success');
            $this->set_data('type', 'options');
            $this->set_message(esc_html__('Layer sliders imported successfully', 'qodef-cpt'));

        } else{
            $this->set_status('error');
            $this->set_data('type', 'options');
            $this->set_message(esc_html__('Files don\'t exist', 'qodef-cpt'));
        }
    }

	function update_meta_fields_after_import( $folder ) {
		global $wpdb;

		$url       = esc_url( home_url( '/' ) );
		$demo_urls = $this->import_get_demo_urls( $folder );

		foreach ( $demo_urls as $demo_url ) {
			$sql_query   = "SELECT meta_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key LIKE 'qodef%' AND meta_value LIKE '" . esc_url( $demo_url ) . "%';";
			$meta_values = $wpdb->get_results( $sql_query );

			if ( ! empty( $meta_values ) ) {
				foreach ( $meta_values as $meta_value ) {
					$new_value = $this->recalc_serialized_lengths( str_replace( $demo_url, $url, $meta_value->meta_value ) );

					$wpdb->update( $wpdb->postmeta,	array( 'meta_value' => $new_value ), array( 'meta_id' => $meta_value->meta_id )	);
				}
			}

            if (startit_qode_is_elementor_installed()) {
                \Elementor\Utils::replace_urls($demo_url, $url);
            }
		}
	}

    function update_rev_slider_in_elementor_after_import() {
        global $wpdb;

        if(startit_qode_is_elementor_installed()) {

            $rev_pairs    = $this->rev_slider_pairs();

            if(is_array($rev_pairs) && is_array($rev_pairs) && count($rev_pairs) > 0 && count($rev_pairs) > 0) {

                foreach ($rev_pairs as $rev_pair => $value){
                    $slider_meta_values = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key = '_elementor_data' AND meta_value LIKE '%\"rev_slider\":\"". $rev_pair ."\"%'");

                    foreach($slider_meta_values as $slider_meta_value) {

                        $new_value = str_replace('"rev_slider":"' . $rev_pair . '"' , '"rev_slider":"' . $value . '"', $slider_meta_value->meta_value);

                        $wpdb->update(
                            $wpdb->postmeta,
                            array(
                                'meta_value' => $new_value,
                            ),
                            array('meta_id' => $slider_meta_value->meta_id)
                        );

                    }

                }
            }
        }
    }

	function update_options_after_import( $folder ) {
		$url       = esc_url( home_url( '/' ) );
		$demo_urls = $this->import_get_demo_urls( $folder );

		foreach ( $demo_urls as $demo_url ) {
			$global_options    = get_option( QODE_CORE_OPTIONS_NAME );
			$new_global_values = str_replace( $demo_url, $url, $global_options );

			update_option( QODE_CORE_OPTIONS_NAME, $new_global_values );
		}
	}

	function import_get_demo_urls( $folder ) {
		$demo_urls  = array();
        $folder = str_replace('-v2', '', $folder);

		$domain_url = defined( 'QODE_PROFILE_SLUG' ) ? str_replace( '/', '', $folder ) . '.' . QODE_PROFILE_SLUG . '-themes.com/' : '';

		$demo_urls[] = ! empty( $domain_url ) ? 'http://' . $domain_url : '';
		$demo_urls[] = ! empty( $domain_url ) ? 'https://' . $domain_url : '';

		return $demo_urls;
	}

	function recalc_serialized_lengths( $sObject ) {
		$ret = preg_replace_callback( '!s:(\d+):"(.*?)";!', array($this, 'recalc_serialized_lengths_callback'), $sObject );

		return $ret;
	}

	function recalc_serialized_lengths_callback( $matches ) {
		return "s:" . strlen( $matches[2] ) . ":\"$matches[2]\";";
	}

	function replace_image_with_placeholder( $post ) {
		if ( isset( $post['post_type'] ) && 'attachment' == $post['post_type'] ) {
			$post['attachment_url'] = $post['guid'] = $this->get_noimage_url( $post['attachment_url'] );
		}

		return $post;
	}

	function get_noimage_url( $origin_img_url ) {
		switch ( pathinfo( $origin_img_url, PATHINFO_EXTENSION ) ) {
			case 'jpg':
			case 'jpeg':
				$ext = 'jpg';
				break;
			case 'png':
				$ext = 'png';
				break;
			case 'gif':
			default:
				$ext = 'gif';
				break;
		}
		$noimage_fname = 'noimage.' . $ext;

		return QODE_CORE_ASSETS_URL_PATH . '/img/' . $noimage_fname;
	}

	function proccess_wc_attributes( $posts ) {

			foreach ($posts as $post) {
				if ('product' === $post['post_type'] && !empty($post['terms'])) {
					foreach ($post['terms'] as $term) {
						if (strstr($term['domain'], 'pa_')) {
							if (!taxonomy_exists($term['domain'])) {
								$attribute_name = wc_attribute_taxonomy_slug($term['domain']);

								// Create the taxonomy.
								if (!in_array($attribute_name, wc_get_attribute_taxonomies(), true)) {
									wc_create_attribute(
										array(
											'name' => $attribute_name,
											'slug' => $attribute_name,
											'type' => 'select',
											'order_by' => 'menu_order',
											'has_archives' => false,
										)
									);
								}

								// Register the taxonomy now so that the import works!
								register_taxonomy(
									$term['domain'],
									apply_filters('woocommerce_taxonomy_objects_' . $term['domain'], array('product')),
									apply_filters(
										'woocommerce_taxonomy_args_' . $term['domain'],
										array(
											'hierarchical' => true,
											'show_ui' => false,
											'query_var' => true,
											'rewrite' => false,
										)
									)
								);
							}
						}
					}
				}
			}
			return $posts;
	}

	public function populate_single_pages() {

		if ( isset( $_POST ) && !empty( $_POST ) && !empty($_POST['options']['demo']) ) {
			if ( wp_verify_nonce( $_POST['options']['nonce'], 'qodef_cd_import_nonce' ) ) {
				$demo = trailingslashit($_POST['options']['demo']);
				$pages_file = $demo . 'pages.txt';
				$pages = $this->unserialized_content( $pages_file );

				$html = qode_core_get_module_template_part('core-dashboard/sub-pages/import', 'pages-list', '', array('pages' => $pages));

				if($pages){
					qode_core_ajax_status( 'success', '', $html);
				} else {
					qode_core_ajax_status( 'error', esc_html__( 'Pages don\'t exist', 'qodef-cpt' ), '');
				}
			}
		}

		wp_die();
	}


	public function is_ready_to_import() {
		$info = SelectCoreSystemInfoPage::get_instance()->get_system_info();

		if($info['php_memory_limit']['pass'] && $info['php_post_max_size']['pass'] && $info['php_time_limit']['pass'] && $info['php_max_input_vars']['pass'] && $info['max_upload_size']['pass']){
			return true;
		}

		return false;

	}

}
SelectCoreImport::get_instance();
