<?php
/**
 * Plugin Name:     Dynamic Header Footer
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     dynamic-header-footer
 * Domain Path:     /languages
 * Version:         0.1
 *
 * @package         Dynamic_Header_Footer
 */

require_once 'class-dynamic-header-footer.php';
require_once 'class-dhf-admin-ui.php';

define( 'DHF_VER', '0.1' );
define( 'DHF_DIR', plugin_dir_path( __FILE__ ) );
define( 'DHF_URL', plugins_url( '/', __FILE__ ) );
define( 'DHF_PATH', plugin_basename( __FILE__ ) );

global $dhf;

$dhf = new Dynamic_Header_Footer();

function dhf_get_header() {
	global $dhf;
	$dhf->get_header();
}

function dhf_get_footer() {
	global $dhf;
	$dhf->get_footer();
}