<?php
/**
 * Plugin Name:     BB Header Footer
 * Plugin URI:      http://www.nikhilchavan.com/
 * Description:     Create Header and Footer for your site using Beaver Builder.
 * Author:          Nikhil Chavan, Brainstorm Force
 * Author URI:      http://www.nikhilchavan.com/
 * Text Domain:     bb-header-footer
 * Domain Path:     /languages
 * Version:         1.0
 *
 * @package         BB_Header_Footer
 */

require_once 'class-bb-header-footer.php';

define( 'BBHF_VER', '1.0' );
define( 'BBHF_DIR', plugin_dir_path( __FILE__ ) );
define( 'BBHF_URL', plugins_url( '/', __FILE__ ) );
define( 'BBHF_PATH', plugin_basename( __FILE__ ) );

function bb_header_footer_init() {
	new BB_Header_Footer();	
}

add_action( 'plugins_loaded', 'bb_header_footer_init' );
