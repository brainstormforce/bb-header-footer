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
	public static function instance(){

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
			add_action( 'init', array( $this, 'primer_setup_header' ), 10 );
			add_action( 'primer_header', array( 'BB_Header_Footer', 'get_header_content' ), 30 );
		}

		if ( $footer_id !== '' ) {
			add_action( 'init', array( $this, 'primer_setup_footer' ), 10 );
			add_action( 'primer_footer', array( 'BB_Header_Footer', 'get_footer_content' ), 30 );
		}

	}

	public function primer_setup_header() {

		remove_action( 'primer_header', 'primer_add_hero' );
		remove_action( 'primer_header', 'primer_add_site_title'  );
		remove_action( 'primer_site_navigation', 'primer_add_primary_menu' );

	}

	public function primer_setup_footer() {
		remove_action( 'primer_footer', 'primer_add_footer_widgets' );
	}

}
 
$Primer_Compat = Primer_Compat::instance();
