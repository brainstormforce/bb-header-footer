<div id="fl-bb-header-footer-form" class="fl-settings-form bb-header-footer-fl-settings-form">
	<h3>BB header Footer</h3>

	<form id="bb-header-footer-form" action="<?php FLBuilderAdminSettings::render_form_action( 'bb-header-footer' ); ?>"
	      method="post">

		<h4 class="field-title"><?php _e( 'Select a page to be used as Header', 'bb-header-footer' ); ?></h4>

		<?php

		$bbhf_settings = get_option( 'bbhf_settings' );
		$header_id = isset( $bbhf_settings['bb_header_id'] ) ? $bbhf_settings['bb_header_id'] : 0;

		$args = array(
			'selected'          => $header_id,
			'name'              => 'bb_header_id',
			'show_option_none'  => "Theme's Header",
			'option_none_value' => ''
		);

		BB_Admin_UI::wp_dropdown_pages( $args );
		?>

		<h4 class="field-title"><?php _e( 'Select a page to be used as Footer', 'bb-header-footer' ); ?></h4>

		<?php		
		$footer_id = isset( $bbhf_settings['bb_footer_id'] ) ? $bbhf_settings['bb_footer_id'] : 0;

		$args = array(
			'selected'          => $footer_id,
			'name'              => 'bb_footer_id',
			'show_option_none'  => "Theme's Footer",
			'option_none_value' => ''
		);

		BB_Admin_UI::wp_dropdown_pages( $args );
		?>


		<p class="submit">
			<input type="submit" name="fl-save-bb-header-footer" class="button-primary"
			       value="<?php esc_attr_e( 'Save Settings', 'bb-header-footer' ); ?>"/>

			<?php wp_nonce_field( 'bb-header-footer', 'fl-bb-header-footer-nonce' ); ?>
		</p>
	</form>
</div>