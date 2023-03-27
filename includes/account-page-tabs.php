<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'wp_enqueue_scripts', 'taa_style_script' );
function taa_style_script() {
	wp_register_style( 'taa-tab-style', TAA_PLUGIN_URL . '/css/account-tabs.css' );
	wp_register_style( 'taa-tab-left-style', TAA_PLUGIN_URL . '/css/account-left-tabs.css' );
	wp_register_style( 'taa-tab-right-style', TAA_PLUGIN_URL . '/css/account-right-tabs.css' );
}
