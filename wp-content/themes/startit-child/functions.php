<?php

// enqueue the child theme stylesheet

if ( ! function_exists( 'startit_qode_child_theme_enqueue_scripts' ) ) {

	Function startit_qode_child_theme_enqueue_scripts() {

		$parent_style = 'startit-qode-default-style';

		wp_enqueue_style( 'startit-qode-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}

	add_action( 'wp_enqueue_scripts', 'startit_qode_child_theme_enqueue_scripts' );
}