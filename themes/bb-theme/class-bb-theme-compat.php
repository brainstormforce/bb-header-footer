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
			add_action( 'fl_before_header', array( $this, 'get_header_content' ) );
		}

		if ( $footer_id !== '' ) {
			add_filter( 'fl_footer_enabled', array( $this, 'disable_bb_theme_footer' ) );
			add_action( 'fl_after_content', array( $this, 'get_footer_content' ) );
		}

	}

	public function disable_bb_theme_header() {
		return false;
	}

	public function disable_bb_theme_footer() {
		return false;
	}

	public function get_header_content() {

		$header_layout  = FLTheme::get_setting( 'fl-header-layout' );

		if ( $header_layout == 'none' || is_page_template( 'tpl-no-header-footer.php' ) ) {
			return;
		}

		?>
			<header id="masthead" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
				<p class="main-title bhf-hidden" itemprop="headline"><a href="<?php echo bloginfo('url'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php BB_Header_Footer::get_header_content(); ?>
			</header>
		<?php
	}

	public function get_footer_content() {

		if ( is_page_template( 'tpl-no-header-footer.php' ) ) {
			return;
		}

		?>
			<footer itemscope="itemscope" itemtype="http://schema.org/WPFooter">
				<?php BB_Header_Footer::get_footer_content(); ?>
			</footer>
		<?php
	}
 
}
 
$bb_theme = BB_Theme_Compat::instance();