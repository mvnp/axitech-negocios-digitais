<div class="qodef-post-info-date">
	<?php if(!startit_qode_post_has_title()) { ?>
	<a href="<?php the_permalink() ?>">
		<?php } ?>

		<?php the_time(get_option('date_format')); ?>

		<?php if(!startit_qode_post_has_title()) { ?>
	</a>
<?php } ?>
</div>