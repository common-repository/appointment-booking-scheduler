<?php
defined( 'ABSPATH' ) or die();

class WL_ABS_Frontend_Actions {
	public static function time_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "public/inc/time-slot-calculate.php" );
		die();
	}

	public static function details_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "public/inc/details.php" );
		die();
	}

	public static function login_ajax_request() {
		include( WL_ABS_PLUGIN_DIR_PATH . "public/inc/login.php" );
		die();
	}
}

?>