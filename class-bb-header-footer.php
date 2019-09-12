<?php
/**
 * Entry point for the plugin. Checks if Beaver Builder is installed and activated and loads it's own files and actions.
 *
 * @package  bb-header-footer
 */

/**
 * Class BB_Header_Footer
 */
class BB_Header_Footer {

	/**
	 * Current theme template
	 *
	 * @var String
	 */
	public $template;

	/**
	 * Constructor
	 */
	function __construct() {

		$this->template = get_template();

		if ( class_exists( 'FLBuilder' ) && is_callable( 'FLBuilderShortcodes::insert_layout' ) ) {

			$this->includes();
			$this->load_textdomain();

			// Load themes compatibility.
			add_action( 'init', array( $this, 'themes_compat' ) );

			// Scripts and styles.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_filter( 'body_class', array( $this, 'body_class' ) );

		} else {

			add_action( 'admin_notices', array( $this, 'bb_not_available' ) );
			add_action( 'network_admin_notices', array( $this, 'bb_not_available' ) );
		}
	}

	/**
	 * Themes compatibility
	 */
	public function themes_compat() {
		if ( 'genesis' == $this->template ) {
			// Genesis framework theme compatibility.
			require BBHF_DIR . 'themes/genesis/class-genesis-compat.php';
		} elseif ( 'astra' == $this->template ) {
			// Beaver Builder Theme compatibility.
			require BBHF_DIR . 'themes/astra/class-astra-compat.php';
		} elseif ( 'bb-theme' == $this->template || 'beaver-builder-theme' == $this->template ) {
			// Beaver Builder Theme compatibility.
			$this->template = 'beaver-builder-theme';
			require BBHF_DIR . 'themes/bb-theme/class-bb-theme-compat.php';
		} elseif ( 'generatepress' == $this->template ) {
			// GeneratePress theme compatibility.
			require BBHF_DIR . 'themes/generatepress/class-generatepress-compat.php';
		} elseif ( 'wp-primer-theme' == $this->template || 'primer' == $this->template ) {
			$this->template = 'primer';
			require BBHF_DIR . 'themes/wp-primer-theme/class-bhf-primer-theme-compat.php';
		} elseif ( ! current_theme_supports( 'bb-header-footer' ) ) {
			// If the theme does not support this plugin, display admin notices.
			add_action( 'admin_notices', array( $this, 'unsupported_theme' ) );
			add_action( 'network_admin_notices', array( $this, 'unsupported_theme' ) );
		}
	}

	/**
	 * Prints the admin notics when Beaver Builder is not installed or activated.
	 */
	public function bb_not_available() {

		if ( file_exists( plugin_dir_path( 'bb-plugin-agency/fl-builder.php' ) )
			|| file_exists( plugin_dir_path( 'beaver-builder-lite-version/fl-builder.php' ) )
		) {

			$url = network_admin_url() . 'plugins.php?s=Beaver+Builder+Plugin';
		} else {
			$url = network_admin_url() . 'plugin-install.php?s=billyyoung&tab=search&type=author';
		}

		echo '<div class="notice notice-error">';
		/* Translators: URL to activate/install Beaver Builder lite version */
		echo '<p>' . sprintf( __( 'The <strong>BB Header Footer</strong> plugin requires Latest version of <strong><a href="%s">Beaver Builder</strong></a> plugin installed & activated.', 'bb-header-footer' ) . '</p>', $url );
		echo '</div>';
	}

	/**
	 * Loads the globally required files for the plugin.
	 */
	public function includes() {
		require_once BBHF_DIR . 'admin/class-bb-admin-ui.php';
	}

	/**
	 * Loads textdomain for the plugin.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'bb-header-footer' );
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'bbhf-style', BBHF_URL . 'assets/css/bb-header-footer.css', array(), BBHF_VER );
		wp_register_script( 'bb-header-footer', BBHF_URL . 'assets/js/bb-header-footer.js', array( 'jquery' ), BBHF_VER, true );
		wp_enqueue_script( 'bb-header-footer' );

		if ( is_callable( 'FLBuilder::enqueue_layout_styles_scripts_by_id' ) ) {
			$header_id = BB_Header_Footer::get_settings( 'bb_header_id', '' );
			FLBuilder::enqueue_layout_styles_scripts_by_id( $header_id );

			$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', '' );
			FLBuilder::enqueue_layout_styles_scripts_by_id( $footer_id );
		}
	}

	/**
	 * Adds classes to the body tag conditionally.
	 *
	 * @param  Array $classes array with class names for the body tag.
	 * @return Array          array with class names for the body tag.
	 */
	public function body_class( $classes ) {

		$header_id             = BB_Header_Footer::get_settings( 'bb_header_id', '' );
		$footer_id             = BB_Header_Footer::get_settings( 'bb_footer_id', '' );
		$bb_transparent_header = BB_Header_Footer::get_settings( 'bb_transparent_header', 'off' );
		$bb_sticky_header      = BB_Header_Footer::get_settings( 'bb_sticky_header', 'off' );
		$bb_shrink_header      = BB_Header_Footer::get_settings( 'bb_shrink_header', 'on' );

		if ( '' !== $header_id ) {
			$classes[] = 'dhf-header';
		}

		if ( '' !== $footer_id ) {
			$classes[] = 'dhf-footer';
		}

		if ( '' !== $header_id && 'on' == $bb_transparent_header ) {
			$classes[] = 'bbhf-transparent-header';
		}

		if ( '' !== $header_id && 'on' == $bb_sticky_header ) {
			$classes[] = 'bhf-sticky-header';
		}

		if ( '' !== $header_id && 'on' == $bb_shrink_header ) {
			$classes[] = 'bhf-shrink-header';
		}

		$classes[] = 'dhf-template-' . $this->template;
		$classes[] = 'dhf-stylesheet-' . get_stylesheet();

		return $classes;
	}

	/**
	 * Prints an admin notics oif the currently installed theme is not supported by bb-header-footer.
	 */
	public function unsupported_theme() {
		$class   = 'notice notice-error';
		$message = __( 'Hey, your current theme is not supported by BB Header Footer, click <a href="https://github.com/Nikschavan/bb-header-footer#which-themes-are-supported-by-this-plugin">here</a> to check out the supported themes.', 'bb-header-footer' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
	}

	/**
	 * Prints the Header content.
	 */
	public static function get_header_content() {

		$header_id        = BB_Header_Footer::get_settings( 'bb_header_id', '' );
		$bb_sticky_header = BB_Header_Footer::get_settings( 'bb_sticky_header', 'off' );

		if ( 'on' == $bb_sticky_header ) {
			echo '<div class="bhf-fixed-header">';
		}

		echo self::render_bb_layout( $header_id );

		if ( 'on' == $bb_sticky_header ) {
			echo '</div>';
			echo '<div class="bhf-ffixed-header-fixer" style="display:none;"></div>';
		}
	}

	/**
	 * Prints the Footer content.
	 */
	public static function get_footer_content() {

		$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', '' );
		echo "<div class='footer-width-fixer'>";
		echo self::render_bb_layout( $footer_id );
		echo '</div>';
	}

	/**
	 * Render the Beaver Builder Layout.
	 * If method FLBuilder::render_content_by_id() is available it will be used, This was introduced in v1.10 of beaver builder.
	 * If at all user is on a older version of beaver builder then it will render using the method FLBuilderShortcodes::insert_layout()
	 *
	 * @since  1.1.6
	 *
	 * @param String $post_id post of which is to be rendered.
	 *
	 * @return String Rendered markup of the layout
	 */
	public static function render_bb_layout( $post_id ) {
		return FLBuilderShortcodes::insert_layout(
			array(
				'id' => $post_id,
			)
		);
	}

	/**
	 * Checks if UABB is installed and displays upgrade links if it is not available.
	 */
	public static function uabb_upsell_message() {

		if ( ! is_plugin_active( 'bb-ultimate-addon/bb-ultimate-addon.php' ) ) {
			$html  = '<hr>';
			$html .= '<span class="upsell-uabb">Want more Beaver Builder Addons? Check out <a target="_blank" href="' . self::uabb_purchase_url() . '">Ultimate Addon for Beaver Builder.</a></span>';

			echo $html;
		}

	}

	/**
	 * Returns the UABB purchase URL.
	 *
	 * @return String url
	 */
	public static function uabb_purchase_url() {
		$url = 'https://www.ultimatebeaver.com/pricing/?bsf=162&utm_source=plugin-dashboard&utm_campaign=bb-header-footer-upgrade&utm_medium=upgrade-link';

		return $url;
	}

	/**
	 * Get option for the plugin settings
	 *
	 * @param  mixed $setting Option name.
	 * @param  mixed $default Default value to be received if the option value is not stored in the option.
	 * @return mixed.
	 */
	public static function get_settings( $setting = '', $default = '' ) {

		$value   = $default;
		$options = get_option( 'bbhf_settings' );

		if ( isset( $options[ $setting ] ) ) {
			$value = $options[ $setting ];
		}

		return apply_filters( "bhf_setting_{$setting}", $value );
	}

}
