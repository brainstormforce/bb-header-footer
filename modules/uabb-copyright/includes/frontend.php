<?php
/**
 * Render the frontend content.
 *
 * @since  1.1.9
 *
 * @package Copyright Module
 */

?>
<div class="hfbb-copyright-wrap">
	<?php if ( ! empty( $settings->copyright_url ) ) { ?>
		<a href="<?php echo esc_url( $settings->copyright_url ); ?>" class="hfbb-copyright-link">
			<span class="hfbb-copyright"><?php echo esc_attr( $settings->copyright ); ?></span>
		</a>
	<?php } else { ?>
		<span class="hfbb-copyright"><?php echo esc_attr( $settings->copyright ); ?></span>
	<?php } ?>
</div>
