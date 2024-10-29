<?php
/**
 * Plugin Name: Appointment Booking Scheduler
 * Plugin URI: https://wordpress.org/plugins/appointment-booking-scheduler/
 * Description: Appointment Booking Scheduler WordPress plugin can book and manage appointments for you in your WordPress website through very easy steps. It provide the number of options and settings to manage your booking system.
 * Version: 1.6
 * Author: Weblizar
 * Author URI: https://weblizar.com/
 * Text Domain: WL_ABS_SYSTEM
 * Domain Path: /languages
 * License: GPL2
 */

defined( 'ABSPATH' ) or die();

if ( ! defined( 'WEBLIZAR_A_B_SYSTEM' ) ) {
	define( "WEBLIZAR_A_B_SYSTEM", plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WL_ABS_PLUGIN_DIR_PATH' ) ) {
	define( 'WL_ABS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'WL_ABS_SYSTEM' ) ) {
	define( 'WL_ABS_SYSTEM', 'WL_ABS_SYSTEM' );
}

final class WL_ABS_System {
	private static $instance = null;

	private function __construct() {
		$this->initialize_hooks();
		$this->setup_database();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function initialize_hooks() {
		if ( is_admin() ) {
			require_once( 'admin/admin.php' );
		}
		require_once( 'public/public.php' );
	}

	private function setup_database() {
		require_once( 'admin/WL_ABS_Database.php' );
		register_activation_hook( __FILE__, array( 'WL_ABS_Database', 'activation' ) );
	}

	private function setup_default() {
		require_once( 'admin/WL_ABS_Default.php' );
		register_activation_hook( __FILE__, array( 'WL_ABS_Default', 'set_default_settings' ) );
	}
}
WL_ABS_System::get_instance();
?>