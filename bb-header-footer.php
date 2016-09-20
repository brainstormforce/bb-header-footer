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

define( 'BB_VER', '0.2' );
define( 'BB_DIR', plugin_dir_path( __FILE__ ) );
define( 'BB_URL', plugins_url( '/', __FILE__ ) );
define( 'BB_PATH', plugin_basename( __FILE__ ) );

new BB_Header_Footer();