<?php
/**
 * Image with icon shortcode template
 */
?>
<div class="qodef-image-with-icon-holder">
    <div class="qodef-image-with-icon-holder-inner">
        <div class="qodef-image-with-icon-holder-icon-wrapper">
            <?php echo startit_qode_execute_shortcode('qodef_icon', $icon_parameters); ?>
        </div>
        <div class="qodef-image-with-icon-holder-image-wrapper">
            <span class="qodef-image-holder">
	            <?php if( !empty($image) ) : ?>
                    <img src="<?php print esc_url($image); ?>" alt="<?php print esc_attr($alt); ?>"/>
	            <?php endif; ?>
            </span>
        </div>
    </div>
</div>