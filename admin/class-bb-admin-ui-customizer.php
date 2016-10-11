<?php

/**
 * BHF_Admin_UI setup
 *
 * @since 1.0
 */
class BHF_Admin_UI {

	private static $instance;

	/**
	 *  Initiator
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new BHF_Admin_UI();
			
			self::$instance->hooks();
		}

		return self::$instance;
	}

	public function hooks() {
		add_action( 'customize_register', array( $this, 'register_customizer' ) );
	}

	public function register_customizer( $wp_customize ) {

		$wp_customize->add_section( 'bhf-header-section', array(
			'title'       => __( 'BB Header Footer', 'bb-header-footer' ),
			'description' => __( 'Select the Page or Beaver Builder template to be used as the header and footer.', 'bb-header-footer' ),
			'priority'    => 100,
		) );

		$wp_customize->add_setting( 'bb_header_id', array(
			'default' => ''
		) );

		$wp_customize->add_control( new BHF_Customize_Select( $wp_customize, 'bb_header_id', array(
			'label'            => __( 'Select Page as Header', 'bb-header-footer' ),
			'section'          => 'bhf-header-section',
			'show_option_none' => 'Theme Header',
			'name'             => 'bb_header_id',
			'settings'         => 'bb_header_id',
			'description'      => __( 'Select a page or a beaver builder template as to be used as a header.', 'bb-header-footer' ),
		) ) );

		$wp_customize->add_setting( 'bb_footer_id', array(
			'default' => ''
		) );

		$wp_customize->add_control( new BHF_Customize_Select( $wp_customize, 'bb_footer_id', array(
			'label'            => __( 'Select Page as Footer', 'bb-header-footer' ),
			'section'          => 'bhf-header-section',
			'show_option_none' => 'Theme Header',
			'name'             => 'bb_footer_id',
			'settings'         => 'bb_footer_id',
			'description'      => __( 'Select a page or a beaver builder template as to be used as a footer.', 'bb-header-footer' ),
		) ) );

	}

}

$bhf_admin_ui = BHF_Admin_UI::instance();