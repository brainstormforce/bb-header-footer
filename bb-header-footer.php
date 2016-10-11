<?php
/**
 * Plugin Name:     BB Header Footer
 * Plugin URI:      https://github.com/Nikschavan/bb-header-footer/
 * Description:     Create Header and Footer for your site using Beaver Builder.
 * Author:          Brainstorm Force, Nikhil Chavan
 * Author URI:      https://www.brainstormforce.com/
 * Text Domain:     bb-header-footer
 * Domain Path:     /languages
 * Version:         1.0.1
 *
 * @package         BB_Header_Footer
 */

require_once 'class-bb-header-footer.php';

define( 'BBHF_VER', '1.0.2' );
define( 'BBHF_DIR', plugin_dir_path( __FILE__ ) );
define( 'BBHF_URL', plugins_url( '/', __FILE__ ) );
define( 'BBHF_PATH', plugin_basename( __FILE__ ) );

function bb_header_footer_init() {
	new BB_Header_Footer();
}

add_action( 'plugins_loaded', 'bb_header_footer_init' );


register_activation_hook( __FILE__, 'bhf_migrate_data' );

function bhf_migrate_data() {

	$bbhf_settings = get_option( 'bbhf_settings' );
	$header_id = isset( $bbhf_settings['bb_header_id'] ) ? $bbhf_settings['bb_header_id'] : 0;
	$footer_id = isset( $bbhf_settings['bb_footer_id'] ) ? $bbhf_settings['bb_footer_id'] : 0;

	if( get_theme_mod( 'bb_header_id') == false ) {
		set_theme_mod( 'bb_header_id', $header_id );
	}

	if( get_theme_mod( 'bb_footer_id') == false ) {
		set_theme_mod( 'bb_footer_id', $footer_id );
	}
}