<div class="qodef-blog-holder qodef-blog-type-standard">
	<?php
	$blog_query = startit_qode_get_blog_query();
		if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			startit_qode_get_post_format_html($blog_type);
		endwhile;
		else:
			startit_qode_get_module_template_part('templates/parts/no-posts', 'blog');
		endif;
	?>
	<?php
		if( startit_qode_options()->getOptionValue('pagination') == 'yes') {
			if ( startit_qode_options()->getOptionValue('pagination_type') == 'navigation') {
				?>
				<div class="qodef-pagination">
					<ul>
						<li class='qodef-pagination-prev'><?php echo wp_kses_post(get_previous_posts_link('<i class="pagination_arrow arrow_carrot-left"></i>')); ?></li>
						<li class='qodef-pagination-next'><?php echo wp_kses_post(get_next_posts_link('<i class="pagination_arrow arrow_carrot-right"></i>', $blog_page_range)); ?></li>
					</ul>
				</div>
				<?php
			} else {
				startit_qode_pagination($blog_query);
			}
		}
	?>
</div>
