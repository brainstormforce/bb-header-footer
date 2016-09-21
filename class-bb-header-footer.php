<?php

/**
 *
 */
class BB_Header_Footer {

	function __construct() {

		if ( class_exists( 'FLBuilder' ) ) {

			if ( get_template() == 'genesis' ) {

				require BBHF_DIR . 'themes/genesis/class-genesis-compat.php';
			} elseif ( get_template() == 'bb-theme' ) {

				require BBHF_DIR . 'themes/bb-theme/class-bb-theme-compat.php';
			} elseif ( get_template() == 'generatepress' ) {

				require BBHF_DIR . 'themes/generatepress/generatepress-compat.php';
			} else {

				add_action( 'admin_notices', array( $this, 'unsupported_theme' ) );
				add_action( 'network_admin_notices', array( $this, 'unsupported_theme' ) );
			}

			$this->includes();
			$this->load_textdomain();

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
		echo "<p>The <strong>BB Header Footer</strong> " . __( 'plugin requires', 'bb-header-footer' ) . " <strong><a href='" . $url . "'>Beaver Builder</strong></a>" . __( ' plugin installed & activated.', 'bb-header-footer' ) . "</p>";
		echo '</div>';
	}

	public function includes() {
		require_once BBHF_DIR . 'admin/class-bb-admin-ui.php';
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'bb-header-footer' );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'dhf-style', BBHF_URL . 'assets/css/style.css', array(), BBHF_VER );
	}

	public function body_class( $classes ) {

		$header_id = BB_Header_Footer::get_settings( 'bb_header_id', '' );
		$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', '' );

		if ( $header_id !== '' ) {
			$classes[] = 'dhf-header';
		}

		if ( $footer_id !== '' ) {
			$classes[] = 'dhf-footer';
		}

		$classes[] = 'dhf-template-' . get_template();
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