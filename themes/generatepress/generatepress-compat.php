<?php

if ( ! function_exists( 'generate_header_items' ) ) {
	
	function generate_header_items() {

		$header_id = Dynamic_Header_Footer::get_settings( 'dhf_header_id', '' );

		if ( $header_id !== '' ) {

			Dynamic_Header_Footer::get_header_content();
		} else {

			// Header widget
			generate_construct_header_widget();

			// Site title and tagline
			generate_construct_site_title();

			// Site logo
			generate_construct_logo();
		}
	}

}


function dhf_generate_footer_widgets_override( $widgets ) {

	$footer_id = Dynamic_Header_Footer::get_settings( 'dhf_footer_id', '' );

	if ( $footer_id !== '' ) {

		return 0;
	} else {

		return $widgets;
	}
}

add_filter( 'generate_footer_widgets', 'dhf_generate_footer_widgets_override' );

function dhf_generate_add_footer() {
	
	$footer_id = Dynamic_Header_Footer::get_settings( 'dhf_footer_id', '' );

	if ( $footer_id !== '' ) {

		Dynamic_Header_Footer::get_footer_content();
	}
}

add_action( 'generate_before_footer_content', 'dhf_generate_add_footer' );