<?php
/**
 * Infobox shortcode template
 */
?>
<div <?php startit_qode_class_attribute($holder_classes); ?>>

	<div class="qodef-info-box-font-side <?php echo esc_attr($front_style);?>" <?php startit_qode_inline_style($front_bkg);?>>
		<div class="qodef-info-box-front-side-inner">
			<div class="qodef-info-box-icon-holder" <?php startit_qode_inline_style($image_style);?>>
				<?php if(!empty($custom_icon)) : ?>
					<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
				<?php endif; ?>
			</div>
			<?php if($title != '') : ?>
				<div class="qodef-info-box-title">
					<<?php echo esc_attr($title_tag); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
				</div>
			<?php endif; ?>
			<?php if($text != '') : ?>
				<div class="qodef-info-box-text">
					<p><?php echo esc_html($text); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if($enable_animation == 'yes') : ?>
		<div class="qodef-info-box-back-side <?php echo esc_attr($back_style);?>" <?php startit_qode_inline_style($back_bkg);?>>
			<div class="qodef-info-box-back-side-inner">
				<?php if($back_text != '') : ?>
					<div class="qodef-info-box-text">
						<p><?php echo esc_html($back_text); ?></p>
					</div>
				<?php endif; ?>
				<?php if($show_button == 'yes') : ?>
					<div class="qodef-info-box-button">
						<?php echo startit_qode_get_button_html($button_parameters); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

</div>