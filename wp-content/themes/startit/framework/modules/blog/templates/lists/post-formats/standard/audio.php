<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<?php startit_qode_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
		<?php startit_qode_get_module_template_part('templates/parts/audio', 'blog'); ?>
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner">
				<?php startit_qode_get_module_template_part('templates/lists/parts/date', 'blog'); ?>
				<div class="qodef-blog-standard-info-holder">
					<?php startit_qode_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
					<div class="qodef-post-info">
						<?php startit_qode_post_info(array( 'date' => 'no', 'author' => 'yes', 'category' => 'yes', 'comments' => 'yes', 'share' => 'no', 'like' => 'no')) ?>
					</div>
				</div>
				<?php
					if($type != '' && $type =='standard-whole-post') {
						the_content();
					}
					else {
						startit_qode_excerpt($excerpt_length);
						startit_qode_read_more_button();
					}
				?>
			</div>
		</div>
	</div>
</article>