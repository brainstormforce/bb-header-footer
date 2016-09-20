<?php
/**
 * BB_Theme_Compat setup
 *
 * @since 1.0
 */
class BB_Theme_Compat {
 
	private static $instance;
 
	/**
	*  Initiator
	*/
	public static function instance(){
 
		if ( ! isset( self::$instance ) ) {
			self::$instance = new BB_Theme_Compat();
 
			// self::$instance->includes();
			self::$instance->hooks();
		}
 
		return self::$instance;
	}

	public function hooks() {

		$header_id = BB_Header_Footer::get_settings( 'bb_header_id', '' );
		$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', '' );

		if ( $header_id !== '' ) {
			add_filter( 'fl_header_enabled', array( $this, 'disable_bb_theme_header' ) );
			add_action( 'fl_before_header', array( 'BB_Header_Footer', 'get_header_content' ) );
		}

		if ( $footer_id !== '' ) {
			add_filter( 'fl_footer_enabled', array( $this, 'disable_bb_theme_footer' ) );
			add_action( 'fl_after_content', array( 'BB_Header_Footer', 'get_footer_content' ) );
		}

	}

	public function disable_bb_theme_header() {
		return false;
	}

	public function disable_bb_theme_footer() {
		return false;
	}
 
}
 
$bb_theme = BB_Theme_Compat::instance();