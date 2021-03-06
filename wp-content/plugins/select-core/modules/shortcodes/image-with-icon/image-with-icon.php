<?php
namespace QodeStartit\Modules\Shortcodes\ImageWithIcon;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ImageWithIcon
 * @package QodeStartit\Modules\Shortcodes\ImageWithIcon
 */
class ImageWithIcon implements ShortcodeInterface {

    /**
     * @var string
     */
    private $base;

    /**
     *
     */
    public function __construct() {
        $this->base = 'qodef_image_with_icon';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     *
     */

    public function vcMap()
    {
        vc_map(array(
                'name' => 'Image With Icon',
                'base' => $this->base,
                'icon' => 'icon-wpb-image-with-icon extended-custom-icon',
                'category' => 'by SELECT',
                'allowed_container_element' => 'vc_row',
                'params' => array_merge(
                    startit_qode_icon_collections()->getVCParamsArray(),
                    array(
                        array(
                            'type'       => 'attach_image',
                            'heading'    => 'Image',
                            'param_name' => 'image'
                        ),
                    )
                )
            )
        );
    }

    /**
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'image' => ''
        );

        $default_atts = array_merge($default_atts, startit_qode_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        $params['icon_parameters'] = $this->getIconParameters($params);
        $image_meta = $this->getImageMeta($params);
		$params['image'] = $image_meta['image_src'];
		$params['alt'] = $image_meta['image_alt'];

		$html = qode_core_get_independent_shortcode_module_template_part('templates/image-with-icon-template', 'image-with-icon', '', $params);

        return $html;
    }

    private function getIconParameters($params) {
        $iconPackName = startit_qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        $params_array['icon_pack']   = $params['icon_pack'];
        $params_array['type']   = 'circle';
        $params_array[$iconPackName] = $params[$iconPackName];

        return $params_array;
    }

    private function getImageMeta($params) {

        if (is_numeric($params['image'])) {
            $image_src = wp_get_attachment_url($params['image']);
			$image_meta['image_src'] = $image_src;
			$image_alt = get_post_meta($params['image'], '_wp_attachment_image_alt', true);
			$image_meta['image_alt'] = $image_alt;

		} else {
            $image_src = $params['image'];
			$image_meta['image_src'] = $image_src;
			$image_meta['image_alt'] = 'alt';
        }

        return $image_meta;

    }


}