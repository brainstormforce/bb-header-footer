<?php
/**
 * Plugin Name:     BB Header Footer
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     bb-header-footer
 * Domain Path:     /languages
 * Version:         0.2
 *
 * @package         BB_Header_Footer
 */

require_once 'class-bb-header-footer.php';
require_once 'class-bb-admin-ui.php';

define( 'BBHF_VER', '0.2' );
define( 'BBHF_DIR', plugin_dir_path( __FILE__ ) );
define( 'BBHF_URL', plugins_url( '/', __FILE__ ) );
define( 'BBHF_PATH', plugin_basename( __FILE__ ) );

function bb_header_footer_init() {
	new BB_Header_Footer();	
}

add_action( 'plugins_loaded', 'bb_header_footer_init' );
