<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function taa_account_tabs( $atts, $content = null ) {
  if ( !isset( $atts['style'] ) ){
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
  $output = '';
  $tab_content = '';
  if ( 'default' == $atts[ 'style' ] ) {
    wp_enqueue_style( 'taa-tab-style' );
  }
  if ( 'left' == $atts[ 'style' ] ) {
    wp_enqueue_style( 'taa-tab-left-style' );
  }
  if ( 'right' == $atts[ 'style' ] ) {
    wp_enqueue_style( 'taa-tab-right-style' );
  }
  if ( 'custom' == $atts[ 'style' ] ){
    wp_enqueue_style( 'taa-tab-custom-style', get_stylesheet_directory_uri() . '/css/taa.css' );
  }
  if ( isset( $_GET[ 'tab' ] ) && isset( $atts[ 'affiliate_area' ] ) ){
    //we need to pass the affiliate tab order number to the script so the active tab is affiliates on the page reload.
    wp_localize_script( 'taa-account-tabs', 'taa_tab_number', array( 
        'affiliate_tab' => array_search( 'affiliate_area', array_keys( $atts ) ),
      )
    );
  } else {
    wp_localize_script( 'taa-account-tabs', 'taa_tab_number', array( 
        'affiliate_tab' => 'none',
      )
    );
  }
  if ( !is_user_logged_in() ) {
    $output .= do_shortcode( '[edd_login]' );
  } else {
    $output = '<div id="taa-account-tab-wrap">';
    $output .= '<ul class="taa-account-tabs">';

    foreach ( $atts as $key => $value ){
      if ( ( 'style' ) != $key ){
        if ( 'false' != $value ){
          $output .= '<li><a href="#' . $key . '">' . $value . '</a></li>';
          $tab_content .= '<div id="' . $key . '">';
          $tab_content .= '<div id="' . $key . '_title">' . $value . '</div>';
          $tab_content .= do_shortcode( '[' . $key . ']' );
          $tab_content .= '</div>';
					if ( $key == 'affiliate_area' ){
						if ( affwp_is_recaptcha_enabled() && 'true' != wp_script_is( 'affwp-recaptcha', 'enqueued' && defined( 'AFFILIATEWP_VERSION' ) ) ) {
							wp_enqueue_script( 'taa_recaptcha', 'https://www.google.com/recaptcha/api.js', array(), AFFILIATEWP_VERSION );
						}
					}
        }
      }
    }

    $output .= '</ul>'; //.taa-account-tabs
    $output .= '<div class="taa-tab-content">';
    $output .= $tab_content;
    $output .= '</div>'; //#taa-tab-content
    $output .= '</div>'; //#taa-account-tab-wrap
  }
  return $output;
}
add_shortcode('account_tabs', 'taa_account_tabs');

function taa_account_area_hidden_content( $atts, $content = null ) {
	if ( !is_user_logged_in() ) {
		return false;
	} else {
		return do_shortcode( $content );
	}
}
add_shortcode( 'hidden_content', 'taa_account_area_hidden_content' );
