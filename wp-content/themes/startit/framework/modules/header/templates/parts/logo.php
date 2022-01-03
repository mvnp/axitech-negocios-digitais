<?php do_action('qode_startit_before_site_logo'); ?>

<div class="qodef-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php startit_qode_inline_style($logo_styles); ?>>
        <img class="qodef-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php echo esc_attr_e('logo', 'startit'); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img class="qodef-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php echo esc_attr_e('dark logo','startit'); ?>"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img class="qodef-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php echo esc_attr_e('light logo','startit'); ?>"/><?php } ?>
    </a>
</div>

<?php do_action('qode_startit_after_site_logo'); ?>