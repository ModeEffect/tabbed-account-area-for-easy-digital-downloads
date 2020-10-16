<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Handle the [account_tabs] shortcode.
 *
 * @param array       $atts    The shortcode attributes.
 * @param string|null $content The content within the shortcode tags.
 *
 * @return string The shortcode response.
 */
function taa_account_tabs( $atts, $content = null ) {
	if ( ! isset( $atts['style'] ) ) {
		$atts['style'] = 'default';
	}

	wp_enqueue_script( 'taa-account-tabs' );

	/*$display = shortcode_atts( array(
	  'style'               => 'default',
	  'download_history'    => 'false',
	  'purchase_history'    => 'false',
	  'edd_profile_editor'  => 'false',
	  'edd_subscriptions'   => 'false',
	  'download_discounts'  => 'false',
	  'edd_wish_lists_edit' => 'false',
	  'edd_wish_lists'      => 'false',
	  'edd_deposit'         => 'false',
	  'edd_license_keys'    => 'false',
	  'affiliate_area'      => 'false',
	  ), $atts );*/

	if ( 'default' === $atts['style'] ) {
		wp_enqueue_style( 'taa-tab-style' );
	} elseif ( 'left' === $atts['style'] ) {
		wp_enqueue_style( 'taa-tab-left-style' );
	} elseif ( 'right' === $atts['style'] ) {
		wp_enqueue_style( 'taa-tab-right-style' );
	} elseif ( 'custom' === $atts['style'] ) {
		wp_enqueue_style( 'taa-tab-custom-style', get_stylesheet_directory_uri() . '/css/taa.css' );
	}

	if ( isset( $_GET['tab'] ) && isset( $atts['affiliate_area'] ) ) {
		// We need to pass the affiliate tab order number to the script so the active tab is affiliates on the page reload.
		wp_localize_script( 'taa-account-tabs', 'taa_tab_number', [
			'affiliate_tab' => array_search( 'affiliate_area', array_keys( $atts ) ),
		] );
	} else {
		wp_localize_script( 'taa-account-tabs', 'taa_tab_number', [
			'affiliate_tab' => 'none',
		] );
	}

	if ( ! is_user_logged_in() ) {
		return do_shortcode( '[edd_login]' );
	}

	$output = '<div id="taa-account-tab-wrap">';
	$output .= '<ul class="taa-account-tabs">';

	$tab_content = '';

	foreach ( $atts as $key => $value ) {
		if ( 'style' === $key || 'false' === $value ) {
			continue;
		}

		// Skip if shortcode does not exist.
		if ( shortcode_exists( $key ) ) {
			continue;
		}

		$output .= '<li><a href="#' . esc_attr( $key ) . '">' . esc_html( $value ) . '</a></li>';

		$tab_content .= '<div id="' . esc_attr( $key ) . '">';
		$tab_content .= '<div id="' . esc_attr( $key ) . '_title">' . esc_html( $value ) . '</div>';
		$tab_content .= do_shortcode( '[' . $key . ']' );
		$tab_content .= '</div>';

		// Handle affiliate area reCAPTCHA script.
		if (
			'affiliate_area' === $key
			&& function_exists( 'affwp_is_recaptcha_enabled' )
			&& defined( 'AFFILIATEWP_VERSION' )
			&& affwp_is_recaptcha_enabled()
			&& false === wp_script_is( 'affwp-recaptcha', 'enqueued' )
		) {
			wp_enqueue_script( 'taa_recaptcha', 'https://www.google.com/recaptcha/api.js', [], AFFILIATEWP_VERSION );
		}
	}

	$output .= '</ul>'; //.taa-account-tabs
	$output .= '<div class="taa-tab-content">';
	$output .= $tab_content;
	$output .= '</div>'; //#taa-tab-content
	$output .= '</div>'; //#taa-account-tab-wrap

	return $output;
}

add_shortcode( 'account_tabs', 'taa_account_tabs' );

/**
 * Handle the [hidden_content] shortcode.
 *
 * @param array       $atts    The shortcode attributes.
 * @param string|null $content The content within the shortcode tags.
 *
 * @return string The shortcode response.
 */
function taa_account_area_hidden_content( $atts, $content = null ) {
	if ( ! is_user_logged_in() ) {
		// Default the text to a blank string.
		if ( empty( $atts['logged_out_text'] ) ) {
			$atts['logged_out_text'] = '';
		}

		/**
		 * Allow filtering the content shown to someone not logged in.
		 *
		 * @since TBD
		 *
		 * @param string $content The not logged in content (default empty).
		 * @param array  $atts    The shortcode attributes.
		 */
		return apply_filters( 'taa_account_area_hidden_content_not_logged_in_content', $atts['logged_out_text'], $atts );
	}

	return do_shortcode( $content );
}

add_shortcode( 'hidden_content', 'taa_account_area_hidden_content' );
