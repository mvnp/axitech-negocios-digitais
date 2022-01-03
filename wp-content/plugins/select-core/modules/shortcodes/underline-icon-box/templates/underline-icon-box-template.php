<?php
/**
 * Underline icon box shortcode template
 */
?>
<div <?php startit_qode_class_attribute($holder_classes); ?>>
	<div class="qodef-underline-icon-box-holder-inner">
		<div class="qodef-underline-icon-box-icon-holder">
			<?php echo startit_qode_execute_shortcode('qodef_icon', $icon_parameters); ?>
		</div>
		<div class="qodef-underline-icon-box-text-holder">
			<div class="qodef-underline-icon-box-title">
				<<?php echo esc_attr($title_tag); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
			</div>
			<div class="qodef-underline-icon-box-text">
				<p><?php echo esc_html($text); ?></p>
			</div>
		</div>
	</div>
	<div class="qodef-underline-icon-box-underline">
		<span class="qodef-underline-holder"></span>
	</div>
</div>