<?php

/**
 *
 */
class BB_Header_Footer {

	public $template;

	function __construct() {

		$this->template = get_template();

		if ( class_exists( 'FLBuilder' ) ) {

			$this->includes();
			$this->load_textdomain();

			if ( $this->template == 'genesis' ) {

				require BBHF_DIR . 'themes/genesis/class-genesis-compat.php';
			} elseif ( $this->template == 'bb-theme' || $this->template == 'beaver-builder-theme' ) {

				require BBHF_DIR . 'themes/bb-theme/class-bb-theme-compat.php';
			} elseif ( $this->template == 'generatepress' ) {

				require BBHF_DIR . 'themes/generatepress/generatepress-compat.php';
			} else {

				add_action( 'admin_notices', array( $this, 'unsupported_theme' ) );
				add_action( 'network_admin_notices', array( $this, 'unsupported_theme' ) );
			}

			// Scripts and styles
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_filter( 'body_class', array( $this, 'body_class' ) );

		} else {

			add_action( 'admin_notices', array( $this, 'bb_not_available' ) );
			add_action( 'network_admin_notices', array( $this, 'bb_not_available' ) );
		}
	}

	public function bb_not_available() {

		if ( file_exists( plugin_dir_path( 'bb-plugin-agency/fl-builder.php' ) )
		     || file_exists( plugin_dir_path( 'beaver-builder-lite-version/fl-builder.php' ) )
		) {

			$url = network_admin_url() . 'plugins.php?s=Beaver+Builder+Plugin';
		} else {
			$url = network_admin_url() . 'plugin-install.php?s=billyyoung&tab=search&type=author';
		}

		echo '<div class="notice notice-error">';
        echo "<p>". sprintf( __( 'The <strong>Timeline Module For Beaver Builder</strong> plugin requires <strong><a href="%s">Beaver Builder</strong></a> plugin installed & activated.', 'bb-header-footer' ) . "</p>", $url );
        echo '</div>';
	}

	public function includes() {
		require_once BBHF_DIR . 'admin/class-bb-admin-ui.php';
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'bb-header-footer' );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'bbhf-style', BBHF_URL . 'assets/css/bb-header-footer.css', array(), BBHF_VER );
	}

	public function body_class( $classes ) {

		$header_id = BB_Header_Footer::get_settings( 'bb_header_id', '' );
		$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', '' );
		$bb_transparent_header = BB_Header_Footer::get_settings( 'bb_transparent_header', 'off' );

		if ( $header_id !== '' ) {
			$classes[] = 'dhf-header';
		}

		if ( $footer_id !== '' ) {
			$classes[] = 'dhf-footer';
		}

		if ( $bb_transparent_header == 'on' ) {
			$classes[] = 'bbhf-transparent-header';
		}

		$classes[] = 'dhf-template-' . $this->template;
		$classes[] = 'dhf-stylesheet-' . get_stylesheet();

		return $classes;
	}

	public function unsupported_theme() {
		$class   = 'notice notice-error';
		$message = __( 'Hey, your current theme is not supported by BB Header Footer, click <a href="https://github.com/Nikschavan/bb-header-footer#which-themes-are-supported-by-this-plugin">here</a> to check out the supported themes.', 'bb-header-footer' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
	}


	public static function get_header_content() {

		$header_id = BB_Header_Footer::get_settings( 'bb_header_id', '' );
		echo do_shortcode( '[fl_builder_insert_layout id="' . $header_id . '"]' );
	}

	public static function get_footer_content() {

		$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', '' );
		echo "<div class='footer-width-fixer'>";
		echo do_shortcode( '[fl_builder_insert_layout id="' . $footer_id . '"]' );
		echo "</div>";
	}

	public static function get_settings( $setting = '', $default = '' ) {

		$options = get_option( 'bbhf_settings' );

		if ( isset( $options[ $setting ] ) ) {
			return $options[ $setting ];
		}

		return $default;
	}

}