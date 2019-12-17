<?php
/**
 * Render the frontend content.
 *
 * @package Copyright Module
 */
?>
<div class="hfbb-copyright-wrap">
	<?php if ( ! empty( $settings->copyright_url ) ) { ?>
		<a href="<?php echo $settings->copyright_url; ?>">
			<span><?php echo $settings->copyright; ?></span>
		</a>
	<?php } else { ?>
		<span><?php echo $settings->copyright; ?></span>
	<?php } ?>
</div>