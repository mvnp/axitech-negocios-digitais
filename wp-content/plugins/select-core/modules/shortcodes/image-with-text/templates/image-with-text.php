<div class="qodef-image-with-text-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="qodef-iwt-image-holder">
        <div class="qodef-iwt-image">
            <?php if(is_array($image_size) && count($image_size)) : ?>
                <?php echo startit_qode_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
            <?php else: ?>
                <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
            <?php endif; ?>
        </div>
        <div class="qodef-iwt-image-overlay">
            <div class="qodef-iwt-image-overlay-inner">
                <div class="qodef-iwt-title-holder">
                    <?php if(!empty($title)) { ?>
                    <<?php echo esc_attr($title_tag); ?> class="qodef-iwt-title" <?php echo startit_qode_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
                    <?php } ?>
                </div>
                <div class="qodef-iwt-links-holder">
                    <?php if (!empty($link_one) && !empty($link_one_text)) : ?>
                        <a itemprop="url" href="<?php echo esc_url($link_one); ?>" target="<?php echo esc_attr($custom_link_target); ?>"><?php echo esc_html($link_one_text); ?></a>
                    <?php endif; ?>
                    <?php if (!empty($link_two) && !empty($link_two_text)) : ?>
                        <a itemprop="url" href="<?php echo esc_url($link_two); ?>" target="<?php echo esc_attr($custom_link_target); ?>"><?php echo esc_html($link_two_text); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>