<?php


if ( ! function_exists( 'startit_qode_options_font_style' ) ) {
	function startit_qode_options_font_style() { //startit_select_options_font_style()
		return array(
			"normal" => "normal",
			"italic" => "italic"
		);
	}
}

if ( ! function_exists( 'startit_qode_options_font_weight' ) ) {
	function startit_qode_options_font_weight() { //startit_select_options_font_weight()
		return array(
			"100" => "100",
			"200" => "200",
			"300" => "300",
			"400" => "400",
			"500" => "500",
			"600" => "600",
			"700" => "700",
			"800" => "800",
			"900" => "900"
		);
	}
}

if ( ! function_exists( 'startit_qode_options_text_transform' ) ) {
	function startit_qode_options_text_transform() { //startit_select_options_text_transform()
		return array(
			"none"       => "None",
			"capitalize" => "Capitalize",
			"uppercase"  => "Uppercase",
			"lowercase"  => "Lowercase"
		);
	}
}

if ( ! function_exists( 'startit_qode_options_font_decoration' ) ) {
	function startit_qode_options_font_decoration() { // startit_select_options_font_decoration()
		return array(
			"none"      => "none",
			"underline" => "underline"
		);
	}
}

if ( ! function_exists( 'startit_qode_options_double_arrows_type' ) ) {
	function startit_qode_options_double_arrows_type() { // $qode_startit_options_double_arrows_type
		return array(
			'fa fa-angle-double-' => 'fa-angle-double',
			'arrow_carrot-2' => 'arrow_carrot-2',
			'arrow_carrot-2left_alt2' => 'arrow_carrot 2 alt2',
			'icon-arrows-left-double-32' => 'icon-arrows double',
			'icon-arrows-move-' => 'icon-arrows-move',
			'ion-ios-fastforward' => 'ion-ios fastforward/rewind',
			'ion-ios-fastforward-outline' => 'ion-ios fastforward/rewind outline',
			'ion-ios-skipbackward' => 'ion-ios skipbackward/skipforward',
			'ion-ios-skipbackward-outline' => 'ion-ios skipbackward/skipforward outline',
			);
	}
}