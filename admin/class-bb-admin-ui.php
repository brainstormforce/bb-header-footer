<?php
/**
 * Helper functions for the admin ui.
 *
 * @package  bb-header-footer
 */

/**
 * Helper functions for generating admin ui.
 */
class BB_Admin_UI {

	/**
	 * Loads the required actions and filters.
	 */
	function __construct() {

		// Add settings to BB's options panel.
		add_filter( 'fl_builder_admin_settings_nav_items', array( $this, 'settings_nav_item' ) );
		add_action( 'fl_builder_admin_settings_render_forms', array( $this, 'settings_nav_form' ) );

		// Save settings.
		add_action( 'fl_builder_admin_settings_save', array( $this, 'bbhf_save' ) );
	}

	/**
	 * Adds navigation menu in Beaver Builder admin panel.
	 *
	 * @param  Array $items Menu items in BB Admin Panel.
	 * @return Array
	 */
	function settings_nav_item( $items ) {

		$items['bb-header-footer'] = array(
			'title' 	=> __( 'BB Header Footer', 'bb-header-footer' ),
			'show'		=> true,
			'priority'	=> 550,
		);

		return $items;
	}

	/**
	 * Loads the view for the admin panel.
	 */
	function settings_nav_form() {
		require_once BBHF_DIR . 'admin/render-admin-panel.php';
	}

	/**
	 * Saves the values from the admin panel.
	 */
	function bbhf_save() {

		if ( isset( $_POST['fl-bb-header-footer-nonce'] ) &&
			wp_verify_nonce( $_POST['fl-bb-header-footer-nonce'], 'bb-header-footer' ) ) {

			$bbhf_header           = isset( $_POST['bb_header_id'] ) ? esc_attr( $_POST['bb_header_id'] ) : '';
			$bbhf_footer           = isset( $_POST['bb_footer_id'] ) ? esc_attr( $_POST['bb_footer_id'] ) : '';
			$bb_transparent_header = isset( $_POST['bb_transparent_header'] ) ? esc_attr( $_POST['bb_transparent_header'] ) : 'off';
			$bb_sticky_header      = isset( $_POST['bb_sticky_header'] ) ? esc_attr( $_POST['bb_sticky_header'] ) : 'off';
			$bb_shrink_header      = isset( $_POST['bb_shrink_header'] ) ? esc_attr( $_POST['bb_shrink_header'] ) : 'off';

			$bbhf_settings['bb_header_id']          = $bbhf_header;
			$bbhf_settings['bb_footer_id']          = $bbhf_footer;
			$bbhf_settings['bb_transparent_header'] = $bb_transparent_header;
			$bbhf_settings['bb_sticky_header']      = $bb_sticky_header;
			$bbhf_settings['bb_shrink_header']      = $bb_shrink_header;

			update_option( 'bbhf_settings', $bbhf_settings );
		}

	}

	/**
	 * Generates a dropdown list of WordPress pages and Beaver Builder templates, echos the generated HTMl markup.
	 *
	 * @param  Array $args Parameters for the select field.
	 *
	 *         $args[name] => 'name' of the select field, this will be used as the key to be saved in database.
	 *         $args[selected] => default value of the select field.
	 *         $args[show_option_none] => Value of the option 'none'.
	 */
	public static function wp_dropdown_pages( $args ) {

		$all_posts = array();

		$atts = array(
			'post_type'      => array(
				'fl-builder-template',
				'page',
			),
			'posts_per_page' => 200,
			'cache_results'  => true,
		);

		$query = new WP_Query( $atts );

		if ( $query->have_posts() ) {

			while ( $query->have_posts() ) {
				$query->the_post();
				$title = get_the_title();
				$id    = get_the_id();

				$all_posts[ get_post_type() ][ $id ] = $title;
			}
		}

		echo '<select name="' . $args['name'] . '">';
		echo '<option value="">' . $args['show_option_none'] . '</option>';

		foreach ( $all_posts as $post_type => $posts ) {
			echo '<optgroup label="' . ucwords( str_replace( '-', ' ', $post_type ) ) . '">';

			foreach ( $posts as $id => $post_name ) {
				echo '<option value="' . $id . '" ' . selected( $id, $args['selected'] ) . ' >' . $post_name . '</option>';
			}

			echo '</optgroup>';
		}

		echo '</select>';
	}

}

new BB_Admin_UI();
