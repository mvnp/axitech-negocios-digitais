<?php

if( ! empty( $cf7 ) ){ ?>
    <div class="qodef-contact-form-7 qodef-contact-form-7-<?php echo esc_attr( $counter ); ?>">
    <?php echo do_shortcode('[contact-form-7 id="' . $cf7 . '" html_class="' . $html_class . '"]'); ?>
    </div>
<?php }