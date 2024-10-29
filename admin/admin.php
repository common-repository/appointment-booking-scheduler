<?php
defined( 'ABSPATH' ) or die();

require_once( WL_ABS_PLUGIN_DIR_PATH . 'admin/WL_ABS_Menu.php' );
require_once( WL_ABS_PLUGIN_DIR_PATH . 'admin/WL_ABS_Actions.php' );
require_once( WL_ABS_PLUGIN_DIR_PATH . 'admin/WL_ABS_Export.php' );
require_once( WL_ABS_PLUGIN_DIR_PATH . 'admin/WL_ABS_Database.php' );
add_action( 'admin_menu', array( 'WL_ABS_Menu', 'create_menu' ) );

/* Action calling */
add_action( 'wp_ajax_service_ajax_request', array( 'WL_ABS_Actions', 'service_ajax_request' ) );
add_action( 'wp_ajax_appointment_ajax_request', array( 'WL_ABS_Actions', 'appointment_ajax_request' ) );
add_action( 'wp_ajax_example_ajax_request', array( 'WL_ABS_Actions', 'customer_fetch_ajax_request' ) );
add_action( 'wp_ajax_full_calendar_dataloader_ajax', array( 'WL_ABS_Actions', 'full_calendar_dataloader_ajax' ) );
add_action( 'wp_ajax_calendar_staff_ajax_request', array( 'WL_ABS_Actions', 'calendar_staff_ajax_request' ) );
add_action( 'wp_ajax_calendar_service_ajax_request', array( 'WL_ABS_Actions', 'calendar_service_ajax_request' ) );
add_action( 'wp_ajax_holiday_json_ajax_request', array( 'WL_ABS_Actions', 'holiday_json_ajax_request' ) );
add_action( 'wp_ajax_holiday_fetch_ajax_request', array( 'WL_ABS_Actions', 'holiday_fetch_ajax_request' ) );
add_action( 'wp_ajax_dashboard_fetch_ajax_request', array( 'WL_ABS_Actions', 'dashboard_fetch_ajax_request' ) );
add_action( 'wp_ajax_category_fetch_ajax_request', array( 'WL_ABS_Actions', 'category_fetch_ajax_request' ) );
add_action( 'wp_ajax_fn_my_ajaxified_dataloader_ajax', array( 'WL_ABS_Actions', 'fn_my_ajaxified_dataloader_ajax' ) );
add_action( 'wp_ajax_nopriv_fn_my_ajaxified_dataloader_ajax', array(
	'WL_ABS_Actions',
	'fn_my_ajaxified_dataloader_ajax'
) );
add_action( 'wp_ajax_fn_my_appointment_dataloader_ajax', array(
	'WL_ABS_Actions',
	'fn_my_appointment_dataloader_ajax'
) );
add_action( 'wp_ajax_nopriv_fn_my_appointment_dataloader_ajax', array(
	'WL_ABS_Actions',
	'fn_my_appointment_dataloader_ajax'
) );

/* CSV export */
add_action( 'admin_init', array(
	'WL_ABS_Export',
	'abs_data_export'
) );
add_action( 'admin_init', array(
	'WL_ABS_Export',
	'abs_service_data_export'
) );
add_action( 'admin_init', array(
	'WL_ABS_Export',
	'abs_appointment_data_export'
) );
add_action( 'admin_init', array(
	'WL_ABS_Export',
	'abs_appointment_file_data_export'
) );
add_action( 'admin_init', array(
	'WL_ABS_Export',
	'abs_appointment_individual_download'
) );
add_action( 'admin_init', array(
	'WL_ABS_Export',
	'abs_customer_csv_download_all'
) );
add_action( 'admin_init', array(
	'WL_ABS_Export',
	'abs_customer_csv_download_individual'
) );
add_action( 'admin_init', array(
	'WL_ABS_Database',
	'database_remove'
) );

	add_action( 'admin_notices', array( 'WL_ABS_Menu', 'banner_message' ) );	


?>