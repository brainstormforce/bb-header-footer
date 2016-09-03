<?php
/**
 * Plugin Name:     Dynamic Header Footer
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     dynamic-header-footer
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Dynamic_Header_Footer
 */

require_once 'class-dynamic-header-footer.php';

define( 'DHF_VER', '0.1.0' );
define( 'DHF_DIR', plugin_dir_path( __FILE__ ) );
define( 'DHF_URL', plugins_url( '/', __FILE__ ) );
define( 'DHF_PATH', plugin_basename( __FILE__ ) );

new Dynamic_Header_Footer();

function dhf_get_header() {
	Dynamic_Header_Footer::get_header();
}

function dhf_get_footer() {
	Dynamic_Header_Footer::get_footer();
}