<?php
defined( 'ABSPATH' ) or die();

require_once( 'WL_ABS_Language.php' );
require_once( 'WL_ABS_Shortcode.php' );
require_once( 'WL_ABS_Frontend_Actions.php' );

add_action( 'plugins_loaded', array( 'WL_ABS_Language', 'load_translations' ) );
add_action( 'wp_enqueue_scripts', array( 'WL_ABS_Shortcode', 'enqueue_frontend_assest' ) );
add_shortcode( 'abs_booking', array( 'WL_ABS_Shortcode', 'ap_system' ) );

add_action( 'wp_ajax_time_ajax_request', array( 'WL_ABS_Frontend_Actions', 'time_ajax_request' ) );
add_action( 'wp_ajax_nopriv_time_ajax_request', array( 'WL_ABS_Frontend_Actions', 'time_ajax_request' ) );

add_action( 'wp_ajax_details_ajax_request', array( 'WL_ABS_Frontend_Actions', 'details_ajax_request' ) );
add_action( 'wp_ajax_nopriv_details_ajax_request', array( 'WL_ABS_Frontend_Actions', 'details_ajax_request' ) );

add_action( 'wp_ajax_login_ajax_request', array( 'WL_ABS_Frontend_Actions', 'login_ajax_request' ) );
add_action( 'wp_ajax_nopriv_login_ajax_request', array( 'WL_ABS_Frontend_Actions', 'login_ajax_request' ) );
?>