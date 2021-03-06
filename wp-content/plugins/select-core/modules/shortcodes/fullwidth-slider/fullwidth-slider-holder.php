<?php
namespace QodeStartit\Modules\FullwidthSliderHolder;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class FullwidthSliderHolder implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qodef_fullwidth_slider_holder';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => 'Fullwidth Slider Holder',
                'base' => $this->base,
                'icon' => 'icon-wpb-fullwidth-slider-holder extended-custom-icon',
                'category' => 'by SELECT',
                'as_parent' => array('only' => 'qodef_fullwidth_slider_item'),
                'js_view' => 'VcColumnView',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => 'Interval',
                        'admin_label' => true,
                        'param_name' => 'interval',
                        'value' => '',
                        'description' => esc_html__('Speed of slide interval in miliseconds','select-core')
                    )
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'interval' => ''
        );

        $params = shortcode_atts($args, $atts);
        extract($params);
        
        $interval = esc_attr($interval);

        $data_attr = $this->getDataParams($params);

        $html = '';
        $html .= '<div class="qodef-fullwidth-slider-holder">';
        $html .= '<div class="qodef-fullwidth-slider-slides"' . $data_attr . '>';
        $html .= do_shortcode($content);
        $html.= '</div>';
        $html.= '</div>';

        return $html;
    }

    private function getDataParams($params){
        $data_attr = '';
        if(!empty($params['interval'])){
            $data_attr .= ' data-interval ="' . $params['interval'] . '"';
        }

        return $data_attr;
    }
}