<?php

class StartitCoreElementorPortfolioList extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_portfolio_list';
    }

    public function get_title() {
        return esc_html__( "Portfolio List", 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-portfolio-list';
    }

    public function get_categories() {
        return [ 'select' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'select-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
	
	    $this->add_control(
		    'type',
		    [
			    'label' => esc_html__( "Portfolio List Template", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
			    	'standard'         => esc_html__( 'Standard', 'select-core' ),
			    	'gallery'          => esc_html__( 'Gallery', 'select-core' ),
			    	'gallery-space'    => esc_html__( 'Gallery With Space', 'select-core' )
			    ],
			    'default' => 'standard'
		    ]
	    );
	
	    $this->add_control(
		    'title_tag',
		    [
			    'label' => esc_html__( "Title Tag", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_title_tag(),
			    'default' => 'h5'
		    ]
	    );
	
	    $this->add_control(
		    'image_size',
		    [
			    'label' => esc_html__( "Image Proportions", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'full'      => esc_html__( 'Original', 'select-core' ),
				    'square'    => esc_html__( 'Square', 'select-core' ),
				    'landscape' => esc_html__( 'Landscape', 'select-core' ),
				    'portrait'  => esc_html__( 'Portrait', 'select-core' ),
			    ],
			    'default' => 'full'
		    ]
	    );
	
	    $this->add_control(
		    'show_load_more',
		    [
			    'label' => esc_html__( "Show Load More", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'default' => 'yes',
			    "description" => esc_html__( "Default value is Yes", 'select-core' )
		    ]
	    );
	    
	    $this->end_controls_section();
	
	    $this->start_controls_section(
		    'query',
		    [
			    'label' => esc_html__( 'Query and Layout Options', 'select-core' ),
			    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		    ]
	    );
	
	    $this->add_control(
		    'order_by',
		    [
			    'label' => esc_html__( "Order By", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
			    	'menu_order' => esc_html__( "Menu Order", 'select-core' ),
			    	'title'      => esc_html__( "Title", 'select-core' ),
			    	'date'       => esc_html__( "Date", 'select-core' )
			    ],
			    'default' => 'menu_order'
		    ]
	    );
	
	    $this->add_control(
		    'order',
		    [
			    'label' => esc_html__( "Order", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    'ASC'  => esc_html__('ASC','select-core' ),
				    'DESC' => esc_html__('DESC','select-core' ),
			    ],
			    'default' => 'ASC'
		    ]
	    );
	
	    $this->add_control(
		    'category',
		    [
			    'label' => esc_html__( "One-Category Portfolio List", 'select-core' ),
			    "description" => esc_html__( "Enter one category slug (leave empty for showing all categories)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'number',
		    [
			    'label' => esc_html__( "Number of Portfolios Per Page", 'select-core' ),
			    "description" => esc_html__( "(enter -1 to show all)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'default' => '-1'
		    ]
	    );
	
	    $this->add_control(
		    'columns',
		    [
			    'label' => esc_html__( "Number of Columns", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    ""      => "",
				    "one"   => "One",
				    "two"   => "Two",
				    "three" => "Three",
				    "four"  => "Four",
				    "five"  => "Five",
				    "six"   => "Six",
			    ],
			    'description' => 'Default value is Three',
			    'default' => 'three'
		    ]
	    );
	
	    $this->add_control(
		    'selected_projects',
		    [
			    'label' => esc_html__( "Show Only Projects with Listed IDs", 'select-core' ),
			    "description" => esc_html__( "Delimit ID numbers by comma (leave empty for all)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'filter',
		    [
			    'label' => esc_html__( "Enable Category Filter", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'description' => esc_html__( "Default value is No" ),
			    'default' => 'no'
		    ]
	    );
	
	    $this->add_control(
		    'icons',
		    [
			    'label' => esc_html__( "Enable Icons", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => startit_qode_get_yes_no_select_array(),
			    'description' => esc_html__( "Default value is No" ),
			    'default' => 'no',
			    'condition' => [
			    	'type' => array('standard')
			    ]
		    ]
	    );
	
	    $this->add_control(
		    'filter_order_by',
		    [
			    'label' => esc_html__( "Filter Order By", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'options' => [
				    "name"   => esc_html__("Name",'select-core' ),
				    "count"  => esc_html__("Count",'select-core' ),
				    "id"     => esc_html__("Id",'select-core' ),
				    "slug"   => esc_html__("Slug",'select-core' ),
			    ],
			    'description' => esc_html__('Default value is Name','select-core' ),
			    'default' => 'name',
			    'condition' => [
				    'filter' => array('yes')
			    ]
		    ]
	    );
	
	    $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $query_array = $this->getQueryArray($params);
	    $query_results = new \WP_Query($query_array);
	    $params['query_results'] = $query_results;
	
	    $classes = $this->getPortfolioClasses($params);
	    $data_atts = $this->getDataAtts($params);
	    $data_atts .= 'data-max-num-pages = '.$query_results->max_num_pages;
	    $params['icon_html'] = '';
	
	    $html = '';
	
	
	    $html .= '<div class = "qodef-portfolio-list-holder-outer '.$classes.'" '.$data_atts. '>';
	
	    if($params['filter'] == 'yes'){
		    $params['filter_categories'] = $this->getFilterCategories($params);
		    $html .= qode_core_get_shortcode_module_template_part('portfolio','portfolio-filter', '', $params);
	    }
	
	    $html .= '<div class = "qodef-portfolio-list-holder clearfix" >';
	
	    if($query_results->have_posts()):
		    while ( $query_results->have_posts() ) : $query_results->the_post();
			
			    $params['current_id'] = get_the_ID();
			    $params['thumb_size'] = $this->getImageSize($params);
			
			    if($params['icons']=="yes"){
				    $params['icon_html'] = $this->getPortfolioIconsHtml($params);
			    }
			
			    $params['category_html'] = $this->getItemCategoriesHtml($params);
			    $params['categories'] = $this->getItemCategories($params);
			    $params['item_link'] = $this->getItemLink($params);
			    $params['item_target'] = $this->getItemTarget($params);
			
			    $html .= qode_core_get_shortcode_module_template_part('portfolio',$params['type'], '', $params);
		
		    endwhile;
		
		    $i = 1;
		    $columns_num = 3;
		    $columns = $params['columns'];
		    switch ($columns):
			    case 'one':
				    $columns_num = 1;
				    break;
			    case 'two':
				    $columns_num = 2;
				    break;
			    case 'three':
				    $columns_num = 3;
				    break;
			    case 'four':
				    $columns_num = 4;
				    break;
			    case 'five':
				    $columns_num = 5;
				    break;
			    case 'six':
				    $columns_num = 6;
				    break;
		    endswitch;
		
		    while ($i <= $columns_num) {
			    $i++;
			    if ($columns != 1 && $params['type'] != 'gallery') {
				    $html .= "<div class='qodef-filler'></div>\n";
			    }
		    }
	    else:
		
		    $html .= '<p>'. _e( 'Sorry, no posts matched your criteria.','select-core' ) .'</p>';
	
	    endif;
	    $html .= '</div>'; //close qodef-portfolio-list-holder
	    if($params['show_load_more'] == 'yes'){
		    $html .= qode_core_get_shortcode_module_template_part('portfolio','load-more-template', '', $params);
	    }
	    wp_reset_postdata();
	    $html .= '</div>'; // close qodef-portfolio-list-holder-outer
	    
	    echo startit_qode_get_module_part($html);
    }
	
	/**
	 * Generates portfolio list query attribute array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getQueryArray($params){
		
		$query_array = array();
		
		$query_array = array(
			'post_type' => 'portfolio-item',
			'orderby' =>$params['order_by'],
			'order' => $params['order'],
			'posts_per_page' => $params['number']
		);
		
		if(!empty($params['category'])){
			$query_array['portfolio-category'] = $params['category'];
		}
		
		$project_ids = null;
		if (!empty($params['selected_projects'])) {
			$project_ids = explode(',', $params['selected_projects']);
			$query_array['post__in'] = $project_ids;
		}
		
		$paged = '';
		if(empty($params['next_page'])) {
			if(get_query_var('paged')) {
				$paged = get_query_var('paged');
			} elseif(get_query_var('page')) {
				$paged = get_query_var('page');
			}
		}
		
		if(!empty($params['next_page'])){
			$query_array['paged'] = $params['next_page'];
			
		}else{
			$query_array['paged'] = 1;
		}
		
		return $query_array;
	}
	
	/**
	 * Generates portfolio icons html
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getPortfolioIconsHtml($params){
		
		$html ='';
		$id = $params['current_id'];
		$slug_list_ = 'pretty_photo_gallery';
		$custom_portfolio_link = get_post_meta(get_the_ID(), 'portfolio_external_link', true);
		$portfolio_link = $custom_portfolio_link != "" ? $custom_portfolio_link : get_the_permalink($id);
		$target = $custom_portfolio_link != "" ? '_blank' : '_self';
		
		$featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full'); //original size
		$large_image = $featured_image_array[0];
		
		$html .= '<div class="qodef-item-icons-holder">';
		
		$html .= '<a class="qodef-portfolio-lightbox" title="' . get_the_title($id) . '" href="' . $large_image . '" data-rel="prettyPhoto[' . $slug_list_ . ']"></a>';
		
		if (function_exists('qode_startit_like_portfolio_list')) {
			$html .= qode_startit_like_portfolio_list($id);
		}
		
		$html .= '<a class="qodef-preview" title="Go to Project" href="' . $portfolio_link . '" target="' . $target . '" data-type="portfolio_list"></a>';
		
		$html .= '</div>';
		
		return $html;
		
	}
	
	/**
	 * Generates portfolio item link
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemLink($params){
		$id = $params['current_id'];
		$custom_portfolio_link = get_post_meta(get_the_ID(), 'portfolio_external_link', true);
		$portfolio_link = $custom_portfolio_link != "" ? $custom_portfolio_link : get_the_permalink($id);
		return $portfolio_link;
	}
	
	/**
	 * Generates portfolio item target
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemTarget($params){
		$custom_portfolio_link = get_post_meta(get_the_ID(), 'portfolio_external_link', true);
		$target = $custom_portfolio_link != "" ? '_blank' : '_self';
		return $target;
	}
	
	/**
	 * Generates portfolio classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getPortfolioClasses($params){
		$classes = array();
		$type = $params['type'];
		$columns = $params['columns'];
		switch($type):
			case 'standard':
				$classes[] = 'qodef-ptf-standard';
				break;
			case 'gallery':
				$classes[] = 'qodef-ptf-gallery';
				break;
			case 'gallery-space':
				$classes[] = 'qodef-ptf-gallery qodef-ptf-gallery-space';
				break;
		endswitch;
		
		if(empty($params['portfolio_slider'])){ // portfolio slider mustn't have this classes
			
			
			switch ($columns):
				case 'one':
					$classes[] = 'qodef-ptf-one-column';
					break;
				case 'two':
					$classes[] = 'qodef-ptf-two-columns';
					break;
				case 'three':
					$classes[] = 'qodef-ptf-three-columns';
					break;
				case 'four':
					$classes[] = 'qodef-ptf-four-columns';
					break;
				case 'five':
					$classes[] = 'qodef-ptf-five-columns';
					break;
				case 'six':
					$classes[] = 'qodef-ptf-six-columns';
					break;
			endswitch;
			
			if($params['show_load_more']== 'yes'){
				$classes[] = 'qodef-ptf-load-more';
			}
			
		}
		
		if($params['filter'] == 'yes'){
			$classes[] = 'qodef-ptf-has-filter';
		}
		
		if(!empty($params['portfolio_slider']) && $params['portfolio_slider'] == 'yes'){
			$classes[] = 'qodef-portfolio-slider-holder';
		}
		
		return implode(' ',$classes);
		
	}
	/**
	 * Generates portfolio image size
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getImageSize($params){
		
		$thumb_size = 'full';
		$type = $params['type'];
		
		
		if(!empty($params['image_size'])){
			$image_size = $params['image_size'];
			
			switch ($image_size) {
				case 'landscape':
					$thumb_size = 'qode_startit_landscape';
					break;
				case 'portrait':
					$thumb_size = 'qode_startit_portrait';
					break;
				case 'square':
					$thumb_size = 'qode_startit_square';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
			}
		}
		
		
		
		return $thumb_size;
	}
	/**
	 * Generates portfolio item categories ids.This function is used for filtering
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getItemCategories($params){
		$id = $params['current_id'];
		$category_return_array = array();
		
		$categories = wp_get_post_terms($id, 'portfolio-category');
		
		foreach($categories as $cat){
			$category_return_array[] = 'portfolio_category_'.$cat->term_id;
		}
		return implode(' ', $category_return_array);
	}
	/**
	 * Generates portfolio item categories html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemCategoriesHtml($params){
		$id = $params['current_id'];
		
		$categories = wp_get_post_terms($id, 'portfolio-category');
		$category_html = '<div class="qodef-ptf-category-holder">';
		$k = 1;
		foreach ($categories as $cat) {
			$category_html .= '<span>'.$cat->name.'</span>';
			if (count($categories) != $k) {
				$category_html .= ' <span>/</span> ';
			}
			$k++;
		}
		$category_html .= '</div>';
		return $category_html;
	}
	
	
	/**
	 * Generates filter categories array
	 *
	 * @param $params
	 *
	 
	 *
	 *
	 *
	 * * @return array
	 */
	public function getFilterCategories($params){
		
		$cat_id = 0;
		$top_category = '';
		
		if(!empty($params['category'])){
			
			$top_category = get_term_by('slug', $params['category'], 'portfolio-category');
			if(isset($top_category->term_id)){
				$cat_id = $top_category->term_id;
			}
			
		}
		
		$args = array(
			'child_of' => $cat_id,
			'orderby' => $params['filter_order_by']
		);
		
		$filter_categories = get_terms('portfolio-category',$args);
		
		return $filter_categories;
		
	}
	/**
	 * Generates datta attributes array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getDataAtts($params){
		
		$data_attr = array();
		$data_return_string = '';
		
		if(get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		if(!empty($paged)) {
			$data_attr['data-next-page'] = $paged+1;
		}
		if(!empty($params['type'])){
			$data_attr['data-type'] = $params['type'];
		}
		if(!empty($params['columns'])){
			$data_attr['data-columns'] = $params['columns'];
		}
		
		if(!empty($params['order_by'])){
			$data_attr['data-order-by'] = $params['order_by'];
		}
		if(!empty($params['order'])){
			$data_attr['data-order'] = $params['order'];
		}
		if(!empty($params['number'])){
			$data_attr['data-number'] = $params['number'];
		}
		if(!empty($params['filter'])){
			$data_attr['data-filter'] = $params['filter'];
		}
		if(!empty($params['filter_order_by'])){
			$data_attr['data-filter-order-by'] = $params['filter_order_by'];
		}
		if(!empty($params['category'])){
			$data_attr['data-category'] = $params['category'];
		}
		if(!empty($params['selected_projectes'])){
			$data_attr['data-selected-projects'] = $params['selected_projectes'];
		}
		if(!empty($params['show_load_more'])){
			$data_attr['data-show-load-more'] = $params['show_load_more'];
		}
		if(!empty($params['title_tag'])){
			$data_attr['data-title-tag'] = $params['title_tag'];
		}
		if(!empty($params['portfolio_slider']) && $params['portfolio_slider']=='yes'){
			$data_attr['data-items'] = $params['portfolios_shown'];
		}
		
		foreach($data_attr as $key => $value) {
			if($key !== '') {
				$data_return_string .= $key.'= '.esc_attr($value).' ';
			}
		}
		return $data_return_string;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorPortfolioList() );