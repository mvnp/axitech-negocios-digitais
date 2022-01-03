<?php if($icon_animation_holder) : ?>
    <span class="qodef-icon-animation-holder" <?php startit_qode_inline_style($icon_animation_holder_styles); ?>>
<?php endif; ?>

    <span <?php startit_qode_class_attribute($icon_holder_classes); ?> <?php startit_qode_inline_style($icon_holder_styles); ?> <?php echo startit_qode_get_inline_attrs($icon_holder_data); ?>>
        <?php if($link !== '') : ?>
             <a class="<?php echo esc_attr($link_class) ?>"  href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
        <?php endif; ?>

        <?php echo startit_qode_icon_collections()->renderIcon($icon, $icon_pack, $icon_params); ?>

        <?php if($link !== '') : ?>
            </a>
        <?php endif; ?>
    </span>

<?php if($icon_animation_holder) : ?>
    </span>
<?php endif; ?>
