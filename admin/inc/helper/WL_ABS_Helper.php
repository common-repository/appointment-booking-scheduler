<?php
defined( 'ABSPATH' ) or die();

class WL_ABS_Helper {
	public static function get_data( $field_name ) {
		global $wpdb;
		$results = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "apt_clients" );

		return $results;
	}

	public static function get_service_data( $field_name ) {
		global $wpdb;
		$results = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "apt_services" );

		return $results;
	}

	public static function get_appointment_data( $field_name ) {
		global $wpdb;
		$results = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "apt_appointments" );

		return $results;
	}

	public static function get_appointment_list_file_data() {
		global $wpdb;

		return $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "apt_appointments" );
	}

	public static function get_appointment_individual_data( $id ) {
		global $wpdb;

		return $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "apt_appointments WHERE id =$id" );
	}

	public static function get_customer_csv_download() {
		global $wpdb;

		return $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "apt_clients" );
	}

	public static function get_customer_csv_download_individual( $id ) {
		global $wpdb;

		return $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "apt_clients WHERE id =$id" );
	}
}

?>