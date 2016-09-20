<?php

/**
 *
 */
class BB_Admin_UI {

	function __construct() {
		add_action( 'admin_menu', array( $this, 'bb_add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'bb_settings_init' ) );
	}


	function bb_add_admin_menu() {

		add_options_page( 'BB Header Footer', 'BB Header Footer', 'manage_options', 'bb_header_footer', array(
			$this,
			'bb_options_page'
		) );

	}

	function bb_options_page() {

		?>
		<form action='options.php' method='post'>

			<h2>BB Header Footer</h2>

			<?php
			settings_fields( 'pluginPage' );
			do_settings_sections( 'pluginPage' );
			submit_button();
			?>

		</form>
		<?php

	}


	function bb_settings_init() {

		register_setting( 'pluginPage', 'bb_settings' );

		add_settings_section(
			'bb_pluginPage_section',
			__( 'Select pages to be displayed', 'bb-header-footer' ),
			array( $this, 'bb_settings_section_callback' ),
			'pluginPage'
		);

		add_settings_field(
			'bb_select_field_1',
			__( 'Select Page to be displayed as Header', 'bb-header-footer' ),
			array( $this, 'bb_select_field_1_render' ),
			'pluginPage',
			'bb_pluginPage_section'
		);

		add_settings_field(
			'bb_select_field_2',
			__( 'Select Page to be displayed as Footer', 'bb-header-footer' ),
			array( $this, 'bb_select_field_2_render' ),
			'pluginPage',
			'bb_pluginPage_section'
		);
	}

	function bb_select_field_1_render() {

		$options = get_option( 'bb_settings' );
		$header_id = isset( $options['bb_header_id'] ) ? $options['bb_header_id'] : 0;

		$args = array(
					'selected' => $header_id,
					'name'     => 'bb_settings[bb_header_id]',
					'show_option_none' => 'Select page as Header',
					'option_none_value' => ''
				);

		wp_dropdown_pages( $args );
	}

	function bb_select_field_2_render() {

		$options = get_option( 'bb_settings' );
		$footer_id = isset( $options['bb_footer_id'] ) ? $options['bb_footer_id'] : 0;

		$args = array(
					'selected' => $footer_id,
					'name'     => 'bb_settings[bb_footer_id]',
					'show_option_none' => 'Select page as Footer',
					'option_none_value' => ''
				);

		wp_dropdown_pages( $args );
	}


	function bb_settings_section_callback() {

		echo __( 'This section description', 'bb-header-footer' );

	}

}

new BB_Admin_UI();