<div id="fl-bb-header-footer-form" class="fl-settings-form bb-header-footer-fl-settings-form">
	<h3>BB header Footer</h3>

	<form id="bb-header-footer-form" action="<?php FLBuilderAdminSettings::render_form_action( 'bb-header-footer' ); ?>"
	      method="post">

	    <h3> <?php _e( 'Header', 'bb-header-footer' ) ?> </h3>

		<h4 class="field-title"><?php _e( 'Select a page to be used as Header', 'bb-header-footer' ); ?></h4>

		<?php

		$header_id = BB_Header_Footer::get_settings( 'bb_header_id', 0 );

		$args = array(
			'selected'          => $header_id,
			'name'              => 'bb_header_id',
			'show_option_none'  => "Theme's Header",
			'option_none_value' => ''
		);

		BB_Admin_UI::wp_dropdown_pages( $args );
		?>

		<h4> <?php _e( 'Transparent Header', 'bb-header-footer' ) ?> </h4>

		<?php $bb_transparent_header = BB_Header_Footer::get_settings( 'bb_transparent_header', 'off' ); ?>
		<label><input type="checkbox" name="bb_transparent_header" <?php checked( $bb_transparent_header, 'on' ); ?>> Enable Transparent Header</label>

		<h3> <?php _e( 'Footer', 'bb-header-footer' ) ?> </h3>

		<h4 class="field-title"><?php _e( 'Select a page to be used as Footer', 'bb-header-footer' ); ?></h4>

		<?php

		$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', 0 );

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
