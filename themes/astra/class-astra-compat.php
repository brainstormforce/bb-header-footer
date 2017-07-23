<?php
/**
 * Astra_Compat setup
 *
 * @package bb-header-footer
 */

/**
 * Astra theme compatibility.
 */
class Astra_Compat {

	/**
	 * Instance of Astra_Compat.
	 *
	 * @var Astra_Compat
	 */
	private static $instance;

	/**
	 *  Initiator
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new Astra_Compat();

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
			add_action( 'template_redirect', array( $this, 'astra_setup_header' ), 10 );
			add_action( 'astra_header', array( $this, 'add_header_markup' ) );
		}

		if ( '' !== $footer_id ) {
			add_action( 'template_redirect', array( $this, 'astra_setup_footer' ), 10 );
			add_action( 'astra_footer', array( $this, 'add_footer_markup' ) );
		}

	}

	/**
	 * Disable header from the theme.
	 */
	public function astra_setup_header() {
		remove_action( 'astra_header', 'astra_header_markup' );
	}

	/**
	 * Display header markup.
	 */
	public function add_header_markup() {
		?>
			<header id="masthead" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
				<p class="main-title bhf-hidden" itemprop="headline"><a href="<?php echo bloginfo( 'url' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php BB_Header_Footer::get_header_content(); ?>
			</header>

		<?php
	}

	/**
	 * Disable footer from the theme.
	 */
	public function astra_setup_footer() {
		remove_action( 'astra_footer', 'astra_footer_markup' );
	}

	/**
	 * Display footer markup.
	 */
	public function add_footer_markup() {

		?>
			<footer itemscope="itemscope" itemtype="http://schema.org/WPFooter">
				<?php BB_Header_Footer::get_footer_content(); ?>
			</footer>
		<?php
	}


}

Astra_Compat::instance();
