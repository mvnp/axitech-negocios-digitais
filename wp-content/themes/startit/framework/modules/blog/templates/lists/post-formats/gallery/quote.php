<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-overlay"></div>
        <?php startit_qode_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">
                <?php startit_qode_post_info(array( 'category' => 'yes'), array( 'show_category_label' => 'no', 'show_category_delimiter' => 'no')) ?>
                <h2 class="qodef-post-title">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "qodef_post_quote_text_meta", true)); ?></a>
                    <span class="qodef-quote-author">&ndash; <?php the_title(); ?></span>
                </h2>
                <?php startit_qode_excerpt($excerpt_length); ?>
                <div class="qodef-post-info-bottom">
                    <?php startit_qode_post_info(array( 'date' => 'yes', 'author' => 'yes')) ?>
                </div>
            </div>
        </div>
    </div>
</article>