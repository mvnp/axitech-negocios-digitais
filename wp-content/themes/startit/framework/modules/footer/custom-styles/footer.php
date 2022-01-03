<?php

if (!function_exists( 'startit_qode_footer_top_columns_alignment_style' )) {
	
	function startit_qode_footer_top_columns_alignment_style()
	{
		
		if ( startit_qode_options()->getOptionValue('footer_top_columns_alignment') !== '') {
			echo startit_qode_dynamic_css('footer .qodef-footer-top .qodef-column-inner', array(
				'text-align' => startit_qode_options()->getOptionValue('footer_top_columns_alignment')
			));
		}
		
	}
	
	add_action('qode_startit_style_dynamic', 'startit_qode_footer_top_columns_alignment_style');
	
}