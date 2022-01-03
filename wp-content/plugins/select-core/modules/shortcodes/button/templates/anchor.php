<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php startit_qode_inline_style($button_styles); ?> <?php startit_qode_class_attribute($button_classes); ?> <?php echo startit_qode_get_inline_attrs($button_data); ?> <?php echo startit_qode_get_inline_attrs($button_custom_attrs); ?>>
    <?php if($params['hover_animation']!=''){ ?>
        <div class="qodef-animation-overlay-holder">
            <span  <?php startit_qode_inline_style($button_animation_styles); ?>  class="qodef-animation-overlay"></span>
        </div>
    <?php }?>
    <span class="qodef-btn-text"><?php echo esc_html($text); ?></span>
    <span class="qodef-btn-text-icon"><?php echo startit_qode_icon_collections()->renderIcon($icon, $icon_pack); ?></span>
</a>