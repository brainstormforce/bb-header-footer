<?php

if ( ! function_exists( 'generate_header_items' ) ) {
	
	function generate_header_items() {

		$header_id = BB_Header_Footer::get_settings( 'bb_header_id', '' );

		if ( $header_id !== '' ) {
			?>

			<p class="main-title bhf-hidden" itemprop="headline"><a href="<?php echo bloginfo('url'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php BB_Header_Footer::get_header_content(); ?>
			
			<?php 
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


function bb_generate_footer_widgets_override( $widgets ) {

	$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', '' );

	if ( $footer_id !== '' ) {

		return 0;
	} else {

		return $widgets;
	}
}

add_filter( 'generate_footer_widgets', 'bb_generate_footer_widgets_override' );

function bb_generate_add_footer() {
	
	$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', '' );

	if ( $footer_id !== '' ) {

		BB_Header_Footer::get_footer_content();
	}
}

add_action( 'generate_before_footer_content', 'bb_generate_add_footer' );