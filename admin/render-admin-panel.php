<?php
/**
 * Render the admin panel for settings.
 *
 * @package bb-header-footer
 */

?>

<div id="fl-bb-header-footer-form" class="fl-settings-form bb-header-footer-fl-settings-form" style="max-width: 550px;">
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
		);

		BB_Admin_UI::wp_dropdown_pages( $args );
		?>
		<p class="description"> <?php _e( 'The page selected here will be replaced by the header of the theme.<br> If your theme adds separate option for menu that can be enabled/disabled from theme options.', 'bb-header-footer' ) ?> </p>

		<h4> <?php _e( 'Transparent Header', 'bb-header-footer' ) ?> </h4>

		<?php $bb_transparent_header = BB_Header_Footer::get_settings( 'bb_transparent_header', 'off' ); ?>
		<label><input type="checkbox" name="bb_transparent_header" <?php checked( $bb_transparent_header, 'on' ); ?>> Enable Transparent Header</label>
		<p class="description"> <?php _e( 'Transparent header will be enabled on pages designed with Beaver Builder.', 'bb-header-footer' ) ?> </p>

		<h4> <?php _e( 'Sticky Header', 'bb-header-footer' ) ?> </h4>

		<?php $bb_sticky_header = BB_Header_Footer::get_settings( 'bb_sticky_header', 'off' ); ?>
		<label><input type="checkbox" name="bb_sticky_header" <?php checked( $bb_sticky_header, 'on' ); ?>> Enable Sticky Header</label>
		<p class="description"> <?php _e( 'Make the current header sticky?', 'bb-header-footer' ) ?> </p>

		<h4> <?php _e( 'Shrink sticky header', 'bb-header-footer' ) ?> </h4>

		<?php $bb_shrink_header = BB_Header_Footer::get_settings( 'bb_shrink_header', 'on' ); ?>
		<label><input type="checkbox" name="bb_shrink_header" <?php checked( $bb_shrink_header, 'on' ); ?>> Shrink the header when it is fixed</label>
		<p class="description"> <?php _e( 'Shrink the sticky header?', 'bb-header-footer' ) ?> </p>

		<h3> <?php _e( 'Footer', 'bb-header-footer' ) ?> </h3>

		<h4 class="field-title"><?php _e( 'Select a page to be used as Footer', 'bb-header-footer' ); ?></h4>

		<?php

		$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id', 0 );

		$args = array(
			'selected'          => $footer_id,
			'name'              => 'bb_footer_id',
			'show_option_none'  => "Theme's Footer",
		);

		BB_Admin_UI::wp_dropdown_pages( $args );
		?>
		<p class="description"> <?php _e( 'The page selected here will be replaced by the footer of the theme.', 'bb-header-footer' ) ?> </p>

		<p class="submit">
			<input type="submit" name="fl-save-bb-header-footer" class="button-primary"
			       value="<?php esc_attr_e( 'Save Settings', 'bb-header-footer' ); ?>"/>

			<?php wp_nonce_field( 'bb-header-footer', 'fl-bb-header-footer-nonce' ); ?>
		</p>
	</form>
	<?php echo BB_Header_Footer::uabb_upsell_message(); ?>
</div>
