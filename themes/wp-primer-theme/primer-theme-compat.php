<?php
/**
 * Primer_Compat setup
 *
 * @since 1.1.0.4
 */

class Primer_Compat {

	private static $instance;

	/**
	 *  Initiator
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new Primer_Compat();

			self::$instance->hooks();
		}

		return self::$instance;
	}

	public function hooks() {

		$header_id = BB_Header_Footer::get_settings( 'bb_header_id', '' );
		$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', '' );

		if ( $header_id !== '' ) {
			add_action( 'wp', array( $this, 'primer_setup_header' ), 10 );
			add_action( 'primer_header', array( 'BB_Header_Footer', 'get_header_content' ), 20 );
		}

		if ( $footer_id !== '' ) {
			add_action( 'wp', array( $this, 'primer_setup_footer' ), 10 );
			add_action( 'primer_footer', array( 'BB_Header_Footer', 'get_footer_content' ), 30 );
		}

	}

	public function primer_setup_header() {

		for ( $priority = 0; $priority < 15; $priority++ ) {
			remove_all_actions( 'primer_header', $priority );
			remove_all_actions( 'primer_after_header', $priority );
		}

	}

	public function primer_setup_footer() {
		remove_action( 'primer_footer', 'primer_add_footer_widgets' );
		remove_action( 'primer_after_footer', 'primer_add_site_info' );
	}

}

$Primer_Compat = Primer_Compat::instance();
