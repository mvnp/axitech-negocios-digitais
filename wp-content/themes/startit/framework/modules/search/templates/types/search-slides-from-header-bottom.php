<form role="search" action="<?php echo esc_url(home_url('/')); ?>" class="qodef-search-slide-header-bottom" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="qodef-container">
		<div class="qodef-container-inner clearfix">
			<?php } ?>
			<div class="qodef-form-holder-outer">
				<div class="qodef-form-holder">
					<input type="text" placeholder="<?php esc_attr_e('Search', 'startit'); ?>" name="s" class="qodef-search-field no-livesearch" autocomplete="off" />
					<a class="qodef-search-submit" href="javascript:void(0)">
						<?php startit_qode_module_part($search_icon) ?>
					</a>
				</div>
			</div>
			<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>