<?php
/**
 * Plugin Name:     Header Footer for Beaver Builder
 * Plugin URI:      https://github.com/Nikschavan/bb-header-footer/
 * Description:     An easy-to-use Beaver Builder addon to import pages or templates as a header or a footer across a Beaver Builder website.
 * Author:          Brainstorm Force
 * Author URI:      https://www.brainstormforce.com/
 * Text Domain:     bb-header-footer
 * Domain Path:     /languages
 * Version:         1.1.8
 *
 * @package         BB_Header_Footer
 */

/**
 * Load the class loader.
 */
require_once 'class-bb-header-footer.php';

define( 'BBHF_VER', '1.1.8' );
define( 'BBHF_DIR', plugin_dir_path( __FILE__ ) );
define( 'BBHF_URL', plugins_url( '/', __FILE__ ) );
define( 'BBHF_PATH', plugin_basename( __FILE__ ) );

/**
 * Load the Plugin Class.
 */
function bb_header_footer_init() {
	new BB_Header_Footer();
}

add_action( 'plugins_loaded', 'bb_header_footer_init' );
