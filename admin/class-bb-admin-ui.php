<?php

/**
 *
 */
class BB_Admin_UI {

	function __construct() {

		// Add settings to BB's options panel
		add_filter( 'fl_builder_admin_settings_nav_items', array( $this, 'settings_nav_item' ) );
		add_action( 'fl_builder_admin_settings_render_forms', array( $this, 'settings_nav_form' ) );

		// Save settings
		add_action( 'fl_builder_admin_settings_save', array( $this, 'bbhf_save' ) );
	}

	function settings_nav_item( $items ) {

		$items['bb-header-footer'] = array(
			'title' 	=> __( 'BB Header Footer', 'bb-header-footer' ),
			'show'		=> true,
			'priority'	=> 550
		);

		return $items;
	}

	function settings_nav_form() {
		require_once BBHF_DIR . 'admin/render-admin-panel.php';
	}

	function bbhf_save() {

		if ( isset( $_POST['fl-bb-header-footer-nonce'] ) && 
			wp_verify_nonce( $_POST['fl-bb-header-footer-nonce'], 'bb-header-footer' ) ) {

			$bbhf_header = isset(  $_POST['bb_header_id'] ) ? esc_attr( $_POST['bb_header_id'] ) : '';
			$bbhf_footer = isset(  $_POST['bb_footer_id'] ) ? esc_attr( $_POST['bb_footer_id'] ) : '';

			$bbhf_settings['bb_header_id'] = $bbhf_header;
			$bbhf_settings['bb_footer_id'] = $bbhf_footer;

			update_option( 'bbhf_settings', $bbhf_settings );
		}

	}

}

new BB_Admin_UI();