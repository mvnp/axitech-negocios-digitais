<?php
namespace QodeCore\CPT\Portfolio\Shortcodes;

use QodeCore\Lib;

/**
 * Class PortfolioSlider
 * @package QodeCore\CPT\Portfolio\Shortcodes
 */
class PortfolioSlider implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'qodef_portfolio_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }


    /**
     * Maps shortcode to Visual Composer
     *
     * @see vc_map()
     */
    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map( array(
                'name' => 'Portfolio Slider',
                'base' => $this->base,
                'category' => 'by SELECT',
                'icon' => 'icon-wpb-portfolio-slider extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Portfolio Slider Template',
                        'param_name' => 'type',
                        'value' => array(
							'Standard' => 'standard',
                            'Gallery' => 'gallery'                           
                        ),
						'save_always' => true,
						'admin_label' => true,
                        'description' => '',
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Image size',
                        'param_name' => 'image_size',
                        'value' => array(
                            'Default' => '',
                            'Original Size' => 'full',
                            'Square' => 'square',
                            'Landscape' => 'landscape',
                            'Portrait' => 'portrait'
                        ),
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        
                        'heading' => 'Order By',
                        'param_name' => 'order_by',
                        'value' => array(
                            '' => '',
                            'Menu Order' => 'menu_order',
                            'Title' => 'title',
                            'Date' => 'date'
                        ),
						'admin_label' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',                        
                        'heading' => 'Order',
                        'param_name' => 'order',
                        'value' => array(
                            '' => '',
                            'ASC' => 'ASC',
                            'DESC' => 'DESC',
                        ),
						'admin_label' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'textfield',                        
                        'heading' => 'Number',
                        'param_name' => 'number',
                        'value' => '-1',
						'admin_label' => true,
                        'description' => 'Number of portolios on page (-1 is all)'
                    ),
                    array(
                        'type' => 'dropdown',                        
                        'heading' => 'Number of Portfolios Shown',
                        'param_name' => 'portfolios_shown',
						'admin_label' => true,
                        'value' => array(
                            '' => '',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6'
                        ),
                        'description' => 'Number of portfolios that are showing at the same time in full width (on smaller screens is responsive so there will be less items shown)',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => 'Category',
                        'param_name' => 'category',
                        'value' => '',
						'admin_label' => true,
                        'description' => 'Category Slug (leave empty for all)'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => 'Selected Projects',
                        'param_name' => 'selected_projects',
                        'value' => '',
						'admin_label' => true,
                        'description' => 'Selected Projects (leave empty for all, delimit by comma)'
                    ),
                    array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => 'Title Tag',
                        'param_name' => 'title_tag',
                        'value' => array(
                            ''   => '',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                        ),
                        'description' => ''
                    )
                )
            ) );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'type' => 'standard',
            'image_size' => 'full',
            'order_by' => 'date',
            'order' => 'ASC',
            'number' => '-1',
            'category' => '',
            'selected_projects' => '',
            'title_tag' => 'h4',
			'portfolios_shown' => '3',
			'portfolio_slider' => 'yes',
            'show_load_more' => 'no'
        );

        $args = array_merge($args, startit_qode_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);
		
		extract($params);
		
		$html ='';
		$html .= startit_qode_execute_shortcode('qodef_portfolio_list', $params);
        return $html;
    }
	
	
}