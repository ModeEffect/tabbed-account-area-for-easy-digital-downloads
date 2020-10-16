<?php
class Tabbed_Account_Area {

	public function taa_run() {
		if( !function_exists( 'EDD' ) ) {
			add_action( 'admin_init', array( $this, 'taa_deactivate' ), 5 );
			add_action( 'admin_notices', array( $this, 'taa_error_message' ) );
			return;
		}
	}
	/**
	 * deactivates the plugin if EDD isn't running
	 *
	 * @since  1.0.0
	 *
	 */
	public function taa_deactivate() {
    deactivate_plugins( plugin_basename( dirname( dirname( __FILE__ ) ) ) . '/tabbed-account-area.php' );
	}

	/**
	 * error message if we're not using  EDD
	 *
	 * @since  1.0.0
	 *
	 */
	public function taa_error_message() {
    $url = 'https://easydigitaldownloads.com/?ref=4599';
	  $error = sprintf( wp_kses( __( 'Sorry, Tabbed Account Area requires <a href="%s">Easy Digital Downloads</a>. It has been deactivated.', 'tabbed-account-area' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );

		echo '<div id="message" class="error"><p>' . $error . '</p></div>';

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	}
}
