<?php
/**
 * Footer template part
 */

startit_qode_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
</div>  <!-- close div.content -->

<footer <?php startit_qode_class_attribute($footer_classes); ?>>
	<div class="qodef-footer-inner clearfix">

		<?php

		if($display_footer_top) {
			startit_qode_get_footer_top();
		}
		if($display_footer_bottom) {
			startit_qode_get_footer_bottom();
		}
		?>

	</div>
</footer>

</div> <!-- close div.qodef-wrapper-inner  -->
</div> <!-- close div.qodef-wrapper -->
<?php wp_footer(); ?>
</body>
</html>