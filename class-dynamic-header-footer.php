<?php

/**
 *
 */
class Dynamic_Header_Footer {

	private $templates;
	private $template_file = array();

	function __construct() {

		$this->template_file = DHF_DIR . '/template-page-builder.php';

		$this->templates = array(
			'template-page-builder.php' => 'Page Builder Template'
		);

		// Check where we want to force the page template
		$this->check_forced_template();

		// Add a filter to the attributes metabox to inject template into the cache.
		add_filter( 'page_attributes_dropdown_pages_args', array( $this, 'dhf_register_project_templates' ) );

		// Add a filter to the save post to inject out template into the page cache
		add_filter( 'wp_insert_post_data', array( $this, 'dhf_register_project_templates' ) );

		add_filter( 'template_include', array( $this, 'dhf_view_project_template' ) );
	}

	function check_forced_template() {
		add_filter( 'page_template', array( $this, 'force_page_template' ) );
		add_filter( 'single_template', array( $this, 'force_page_template' ) );
		add_filter( 'archive_template', array( $this, 'force_page_template' ) );
	}

	function force_page_template( $page_template ) {

		// if ( is_page( 10885 ) ) {
		$page_template = $this->template_file;
		// }

		return $page_template;
	}

	function dhf_register_project_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}

		wp_cache_delete( $cache_key, 'themes' );

		$templates = array_merge( $templates, $this->templates );
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;
	}

	function dhf_view_project_template( $template ) {

		global $post;

		if ( ! isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {

			return $template;
		}

		$file = DHF_DIR . get_post_meta( $post->ID, '_wp_page_template', true );

		// Just to be safe, we check if the file exist first
		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}

		return $template;
	}

	public static function get_header() {
		?>

		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">

			<?php wp_head(); ?>
		</head>

		<body <?php body_class(); ?>>
		<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_s' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
			<?php Dynamic_Header_Footer::get_header_content(); ?>
		</header>
		<!-- #masthead -->

		<div id="content" class="site-content">

		<?php

	}

	public static function get_footer() {

		?>
		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php Dynamic_Header_Footer::get_footer_content(); ?>

		</footer><!-- #colophon -->
		</div><!-- #page -->

		<?php wp_footer(); ?>

		</body>
		</html>

		<?php

	}

	public static function get_header_content() {

		$header_id = Dynamic_Header_Footer::get_settings( 'dhf_header_id', '' );

		if ( $header_id !== '' ) {
			echo do_shortcode( '[fl_builder_insert_layout id="' .$header_id. '"]' );
		} else {
			wp_head();
		}
	}

	public static function get_footer_content() {

		$footer_id = Dynamic_Header_Footer::get_settings( 'dhf_footer_id', '' );

		if ( $footer_id !== '' ) {
			echo do_shortcode( '[fl_builder_insert_layout id="' .$footer_id. '"]' );
		} else {
			wp_footer();
		}
	}

	public static function get_settings( $setting = '', $default = '' ) {

		$options = get_option( 'dhf_settings' );

		if ( isset( $options[ $setting ] ) ) {
			return $options[ $setting ];
		}

		return $default;
	}

}
