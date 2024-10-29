<?php
defined( 'ABSPATH' ) or die();

class WL_ABS_Actions {

	public static function service_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/service-ajax.php" );
		die();
	}

	/* Appointment fetch */
	public static function appointment_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/appointment-fetch.php" );
		die();
	}

	/* Customer fetch */
	public static function customer_fetch_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/customer-fetch.php" );
		die();
	}

	/* Full calendar json */
	public static function full_calendar_dataloader_ajax() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/json-events.php" );
		die();
	}

	/* Calendar customer fetch */
	public static function calendar_customer_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/calendar_customer.php" );
		die();
	}

	/* Calendar staff fetch */
	public static function calendar_staff_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/calendar_staff.php" );
		die();
	}

	/* Calendar service fetch */
	public static function calendar_service_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/calendar_service.php" );
		die();
	}

	/* Holiday json */
	public static function holiday_json_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/holiday-json.php" );
		die();
	}

	/* Holiday fetch on model */
	public static function holiday_fetch_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/holiday-fetch.php" );
		die();
	}

	/* Dashboard data fecth */
	public static function dashboard_fetch_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/dashboard-ajax.php" );
		die();
	}

	/* Customer json */
	public static function fn_my_ajaxified_dataloader_ajax() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/customer-json.php" );
		die();
	}

	/* Appointment json	*/
	public static function fn_my_appointment_dataloader_ajax() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/appointment-json.php" );
		die();
	}

	/* Category fetch on model on service modal */
	public static function category_fetch_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/category-fetch.php" );
		die();
	}
}

?>