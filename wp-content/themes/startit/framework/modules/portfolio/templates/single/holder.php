<?php if($fullwidth) : ?>
<div class="qodef-full-width">
    <div class="qodef-full-width-inner">
<?php else: ?>
<div class="qodef-container">
    <div class="qodef-container-inner clearfix">
<?php endif; ?>
        <div <?php startit_qode_class_attribute($holder_class); ?>>
            <?php if(post_password_required()) {
                echo get_the_password_form();
            } else {
                //load proper portfolio template
                startit_qode_get_module_template_part('templates/single/single', 'portfolio', $portfolio_template);

                //load portfolio navigation
                startit_qode_get_module_template_part('templates/single/parts/navigation', 'portfolio');

                //load portfolio comments
                startit_qode_get_module_template_part('templates/single/parts/comments', 'portfolio');

            } ?>
        </div>
    </div>
</div>