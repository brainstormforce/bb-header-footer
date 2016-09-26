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

	public static function wp_dropdown_pages( $args ) {

		$all_posts = array();

		$atts = array(
			'post_type'      => array(
				'fl-builder-template',
				'page'
			),
			'posts_per_page' => 200,
			'cache_results'  => true
		);

		$query = new WP_Query( $atts );

		if ( $query->have_posts() ) {

			while ( $query->have_posts() ) {
				$query->the_post();
				$title = get_the_title();
				$ID    = get_the_id();

				$all_posts[ get_post_type() ][ $ID ] = $title;
			}

		}

		echo '<select name="' . $args['name'] . '">';
		echo '<option value="">' . $args['show_option_none'] . '</option>';

		foreach ( $all_posts as $post_type => $posts ) {
			echo '<optgroup label="' . ucwords( str_replace( "-", " ", $post_type ) ) . '">';

			foreach ( $posts as $id => $post_name ) {
				echo '<option value="' . $id . '" ' . selected( $id, $args['selected'] ) . ' >' . $post_name . '</option>';
			}

			echo '</optgroup>';
		}

		echo '</select>';
	}

}

new BB_Admin_UI();