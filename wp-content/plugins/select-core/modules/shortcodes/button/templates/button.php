<button type="submit" <?php startit_qode_inline_style($button_styles); ?> <?php startit_qode_class_attribute($button_classes); ?> <?php echo startit_qode_get_inline_attrs($button_data); ?> <?php echo startit_qode_get_inline_attrs($button_custom_attrs); ?>>
    <span class="qodef-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo startit_qode_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>