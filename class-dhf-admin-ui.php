<?php

/**
 *
 */
class DHF_Admin_UI {

	function __construct() {
		add_action( 'admin_menu', array( $this, 'dhf_add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'dhf_settings_init' ) );
	}


	function dhf_add_admin_menu() {

		add_options_page( 'Dynamic Header Footer', 'Dynamic Header Footer', 'manage_options', 'dynamic_header_footer', array(
			$this,
			'dhf_options_page'
		) );

	}

	function dhf_options_page() {

		?>
		<form action='options.php' method='post'>

			<h2>Dynamic Header Footer</h2>

			<?php
			settings_fields( 'pluginPage' );
			do_settings_sections( 'pluginPage' );
			submit_button();
			?>

		</form>
		<?php

	}


	function dhf_settings_init() {

		register_setting( 'pluginPage', 'dhf_settings' );

		add_settings_section(
			'dhf_pluginPage_section',
			__( 'Select pages to be displayed', 'dynamic-header-footer' ),
			array( $this, 'dhf_settings_section_callback' ),
			'pluginPage'
		);

		add_settings_field(
			'dhf_select_field_1',
			__( 'Select Page to be displayed as Header', 'dynamic-header-footer' ),
			array( $this, 'dhf_select_field_1_render' ),
			'pluginPage',
			'dhf_pluginPage_section'
		);

		add_settings_field(
			'dhf_select_field_2',
			__( 'Select Page to be displayed as Footer', 'dynamic-header-footer' ),
			array( $this, 'dhf_select_field_2_render' ),
			'pluginPage',
			'dhf_pluginPage_section'
		);
	}

	function dhf_select_field_1_render() {

		$options = get_option( 'dhf_settings' );
		$header_id = isset( $options['dhf_header_id'] ) ? $options['dhf_header_id'] : '';

		$args = array(
					'selected' => $header_id,
					'name'     => 'dhf_settings[dhf_header_id]'
				);

		wp_dropdown_pages( $args );
	}

	function dhf_select_field_2_render() {

		$options = get_option( 'dhf_settings' );
		$footer_id = isset( $options['dhf_footer_id'] ) ? $options['dhf_footer_id'] : '';

		$args = array(
					'selected' => $footer_id,
					'name'     => 'dhf_settings[dhf_footer_id]'
				);

		wp_dropdown_pages( $args );
	}


	function dhf_settings_section_callback() {

		echo __( 'This section description', 'dynamic-header-footer' );

	}

}

new DHF_Admin_UI();