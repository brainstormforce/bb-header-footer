<?php
/**
 * BHF_Primer_Compat setup
 *
 * @package bb-header-footer
 */

/**
 * Primer theme compatibility.
 */
class BHF_Primer_Theme_Compat {

	/**
	 * Instance of Genesis_Compat.
	 *
	 * @var Genesis_Compat
	 */
	private static $instance;

	/**
	 *  Initiator
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new BHF_Primer_Theme_Compat();

			add_action( 'wp', array( self::instance(), 'hooks' ) );
		}

		return self::$instance;
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks() {

		$header_id = BB_Header_Footer::get_settings( 'bb_header_id', '' );
		$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', '' );

		if ( '' !== $header_id ) {
			add_action( 'template_redirect', array( $this, 'primer_setup_header' ), 30 );
			add_action( 'primer_header', array( 'BB_Header_Footer', 'get_header_content' ), 20 );
		}

		if ( '' !== $footer_id ) {
			add_action( 'template_redirect', array( $this, 'primer_setup_footer' ), 30 );
			add_action( 'primer_footer', array( 'BB_Header_Footer', 'get_footer_content' ), 30 );
		}

	}

	/**
	 * Disable header from the theme.
	 */
	public function primer_setup_header() {

		for ( $priority = 0; $priority < 15; $priority++ ) {
			remove_all_actions( 'primer_header', $priority );
			remove_all_actions( 'primer_after_header', $priority );
		}

	}

	/**
	 * Disable footer from the theme.
	 */
	public function primer_setup_footer() {
		remove_action( 'primer_footer', 'primer_add_footer_widgets' );
		remove_action( 'primer_after_footer', 'primer_add_site_info' );
	}

}

BHF_Primer_Theme_Compat::instance();
