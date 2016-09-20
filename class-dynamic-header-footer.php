<?php

/**
 *
 */
class Dynamic_Header_Footer {

	private $supported_themes = array();

	private $templates;
	private $template_dir;
	private $template_file = array();

	function __construct() {

		$this->supported_themes = array(
			'bb-theme',
			'generatepress'
		);

		if ( get_template() == 'genesis' ) {

			require DHF_DIR . 'themes/genesis/class-genesis-compat.php';
		} elseif ( get_template() == 'bb-theme' ) {
			
			require DHF_DIR . 'themes/bb-theme/class-bb-theme-compat.php';
		} elseif ( get_template() == 'generatepress' ) {
			
			require DHF_DIR . 'themes/generatepress/generatepress-compat.php';
		} else {

			add_action( 'admin_notices', array( $this, 'unsupported_theme' ) );
			add_action( 'network_admin_notices', array( $this, 'unsupported_theme' ) );
		}

		// Scripts and styles
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'body_class', array( $this, 'body_class' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'dhf-style', DHF_URL . 'assets/css/style.css', array(), '1.0' );
	}

	public function body_class( $classes ) {

		$header_id = Dynamic_Header_Footer::get_settings( 'dhf_header_id', '' );
		$footer_id = Dynamic_Header_Footer::get_settings( 'dhf_footer_id', '' );

		if ( $header_id !== '' ) {
			$classes[] = 'dhf-header';
		}

		if ( $footer_id !== '' ) {
			$classes[] = 'dhf-footer';
		}

		$classes[] = 'dhf-template-'	. get_template();
		$classes[] = 'dhf-stylesheet-'	. get_stylesheet();

		return $classes;
	}

	public function unsupported_theme() {
		$class = 'notice notice-error';
		$message = __( 'Your are using an unsupported theme.', 'dynamic-header-footer' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
	}


	public static function get_header_content() {

		$header_id = Dynamic_Header_Footer::get_settings( 'dhf_header_id', '' );
		echo do_shortcode( '[fl_builder_insert_layout id="' . $header_id . '"]' );
	}

	public static function get_footer_content() {

		$footer_id = Dynamic_Header_Footer::get_settings( 'dhf_footer_id', '' );
		echo "<div class='footer-width-fixer'>";
		echo do_shortcode( '[fl_builder_insert_layout id="' . $footer_id . '"]' );
		echo "</div>";
	}

	public static function get_settings( $setting = '', $default = '' ) {

		$options = get_option( 'dhf_settings' );

		if ( isset( $options[ $setting ] ) ) {
			return $options[ $setting ];
		}

		return $default;
	}

}