<?php
/*
Plugin Name: Tabbed Account Area for Easy Digital Downloads
Description: Creates tabbed content for your account area on Easy Digital Downloads
Plugin URI: https://amplifyplugins.com
Author: AMP-MODE
Author URI: https://scottdeluzio.com
Version: 1.2.0
Text Domain: tabbed-account-area
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action('plugins_loaded', 'tabbed_account_area_edd_plugin_init');
function tabbed_account_area_edd_plugin_init() {
	load_plugin_textdomain( 'tabbed-account-area', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
}
/* Check if EDD is Installed
--------------------------------------------- */
function taa_require() {
	$files = array(
		'taa'
	); //array for future use

	foreach( $files as $file ) {
		require plugin_dir_path( __FILE__ ) . 'lib/' . $file . '.php';
	}
  $taa = new Tabbed_Account_Area();
  $taa->taa_run();
}
add_action( 'admin_init', 'taa_require' );
/*
 * Includes for our Plugin
 */
 if ( ! defined( 'TAA_PLUGIN' ) ) {
   define( 'TAA_PLUGIN', __FILE__ );
 }
 if( ! defined( 'TAA_PLUGIN_DIR' ) ) {
  	define( 'TAA_PLUGIN_DIR', dirname( __FILE__ ) );
 }
 if( ! defined( 'TAA_PLUGIN_URL' ) ) {
	define( 'TAA_PLUGIN_URL', plugins_url( '', __FILE__ ) );
}
/* Account Page Tabbed Content */
include( TAA_PLUGIN_DIR . '/includes/account-page-tabs.php' );
/* Shortcodes */
include( TAA_PLUGIN_DIR . '/includes/shortcodes.php' );
