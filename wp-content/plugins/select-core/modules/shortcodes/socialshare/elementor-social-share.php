<?php

class StartitCoreElementorSocialShare extends \Elementor\Widget_Base{
    public function get_name() {
        return 'social_share';
    }

    public function get_title() {
        return esc_html__( 'Social Share', 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-social-share';
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
				'label' => esc_html__( "Type", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__('Choose type of Social Share','select-core' ),
				'options' => [
					'list'     => esc_html__( "List", 'select-core' ),
					'dropdown' => esc_html__( "Dropdown", 'select-core' ),
				]
			]
		);
		
		$this->add_control(
			'icon_type',
			[
				'label' => esc_html__( "Icons Type", 'select-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__('Choose type of Icons','select-core' ),
				'options' => [
					'normal'  => esc_html__( "Normal", 'select-core' ),
					'circle'  => esc_html__( "Circle", 'select-core' ),
				]
			]
		);
		
		$this->end_controls_section();
	}

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    //Is social share enabled
	    $params['enable_social_share'] = ( startit_qode_options()->getOptionValue('enable_social_share') == 'yes') ? true : false;
	
	    //Is social share enabled for post type
	    $post_type = get_post_type();
	    $params['enabled'] = (startit_qode_options()->getOptionValue( 'enable_social_share_on_' . $post_type)) ? true : false;
	
	    //Social Networks Data
	    $params['networks'] = $this->getSocialNetworksParams($params);
	    
	    if ($params['enable_social_share']) {
		    if ($params['enabled']) {
			    echo qode_core_get_independent_shortcode_module_template_part('templates/' . $params['type'], 'socialshare', '', $params);
		    }
	    }
    }
	
	/**
	 * Get Social Networks data to display
	 * @return array
	 */
	private function getSocialNetworksParams($params) {
		
		$networks = array();
		$icons_type = $params['icon_type'];
		
		$socialNetworks = array(
			'facebook',
			'twitter',
			'linkedin',
			'tumblr',
			'pinterest',
			'vk'
		);
		
		foreach ($socialNetworks as $net) {
			
			$html = '';
			if ( startit_qode_options()->getOptionValue( 'enable_' . $net . '_share') == 'yes') {
				
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				$params = array(
					'name' => $net
				);
				$params['link'] = $this->getSocialNetworkShareLink($net, $image);
				$params['icon'] = $this->getSocialNetworkIcon($net, $icons_type);
				$params['custom_icon'] = (startit_qode_options()->getOptionValue( $net . '_icon')) ? startit_qode_options()->getOptionValue( $net . '_icon') : '';
				$html = qode_core_get_independent_shortcode_module_template_part('templates/parts/network', 'socialshare', '', $params);
				
			}
			
			$networks[$net] = $html;
			
		}
		
		return $networks;
		
	}
	
	/**
	 * Get share link for networks
	 *
	 * @param $net
	 * @param $image
	 * @return string
	 */
	private function getSocialNetworkShareLink($net, $image) {
		
		switch ($net) {
			case 'facebook':
				if (wp_is_mobile()) {
					$link = 'window.open(\'https://m.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '\');';
				} else {
					$link = 'window.open(\'https://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
				}
				break;
			case 'twitter':
				$count_char = (isset($_SERVER['https'])) ? 23 : 22;
				$twitter_via = ( startit_qode_options()->getOptionValue('twitter_via') !== '') ? ' via ' . startit_qode_options()->getOptionValue('twitter_via') . ' ' : '';
				$link        = 'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode( qode_startit_the_excerpt_max_charlength( $count_char ) . $twitter_via ) . ' ' . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
				break;
			case 'linkedin':
				$link = 'popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'tumblr':
				$link = 'popUp=window.open(\'http://www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'pinterest':
				$link = 'popUp=window.open(\'http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . startit_qode_addslashes(get_the_title()) . '&amp;media=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'vk':
				$link = 'popUp=window.open(\'http://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '&amp;image=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			default:
				$link = '';
		}
		
		return $link;
		
	}
	
	private function getSocialNetworkIcon($net, $type) {
		
		switch ($net) {
			case 'facebook':
				$icon = ( $type == 'circle' ) ? 'social_facebook_circle' : 'social_facebook';
				break;
			case 'twitter':
				$icon = ( $type == 'circle' ) ? 'social_twitter_circle' : 'social_twitter';
				break;
			case 'linkedin':
				$icon = ( $type == 'circle' ) ? 'social_linkedin_circle' : 'social_linkedin';
				break;
			case 'tumblr':
				$icon = ( $type == 'circle' ) ? 'social_tumblr_circle' : 'social_tumblr';
				break;
			case 'pinterest':
				$icon = ( $type == 'circle' ) ? 'social_pinterest_circle' : 'social_pinterest';
				break;
			case 'vk':
				$icon = 'fa fa-vk';
				break;
			default:
				$icon = '';
		}
		
		return $icon;
		
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorSocialShare() );