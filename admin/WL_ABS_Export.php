<?php
defined( 'ABSPATH' ) or die();

require( WL_ABS_PLUGIN_DIR_PATH . "admin/inc/helper/WL_ABS_Helper.php" );

class WL_ABS_Export {
	public static function abs_data_export() {
		if ( isset( $_POST['customer'] ) && isset( $_POST['pwsix_export_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_POST['pwsix_export_nonce'], 'pwsix_export_nonce' ) ) {
				return;
			}
			ignore_user_abort( true );
			nocache_headers();
			header( 'Content-Type: text/csv' );
			header( 'Content-Disposition: inline; filename="All Customer List-' . date( 'Y-m-d-H-i-s' ) . '.csv"' );
			header( "Expires: 0" );
			$data_value = sanitize_text_field( $_POST['customer'] );
			$results    = WL_ABS_Helper::get_data( $data_value );
			echo "First Name,Last Name,Phone,Skype Id,Email,Notes\r\n";
			if ( count( $results ) ) {
				foreach ( $results as $result ) {
					echo $result->first_name . "," . $result->last_name . "," . $result->phone . "," . $result->skype_id . ", " . $result->email . "," . $result->notes . "\r\n";
				}
			}
			die();
		}
	}

	/* Services data export */
	public static function abs_service_data_export() {
		if ( isset( $_POST['services'] ) && isset( $_POST['services_export_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_POST['services_export_nonce'], 'services_export_nonce' ) ) {
				return;
			}
			header( 'Content-Type: text/csv' );
			header( 'Content-Disposition: inline; filename="All Services List-' . date( 'Y-m-d-H-i-s' ) . '.csv"' );
			header( "Expires: 0" );
			$data_value = sanitize_text_field( $_POST['services'] );
			$results    = WL_ABS_Helper::get_service_data( $data_value );
			echo "Services Name,Icon,Color,Duration,Padding Time Before,Padding After,Service Type,Price,Capacity,Category,Info Message\r\n";
			if ( count( $results ) ) {
				foreach ( $results as $result ) {
					echo $result->name . "," . $result->icon . "," . $result->color . "," . $result->duration . ", " . $result->p_before . "," . $result->p_after . "," . $result->service_type . "," . $result->price . "," . $result->capacity . "," . $result->category . "," . $result->info_message . "\r\n";
				}
				die();
			}
		}
	}

	/* Appointment data export */
	public static function abs_appointment_data_export() {
		if ( isset( $_POST['appointment'] ) && isset( $_POST['appointment_export_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_POST['appointment_export_nonce'], 'appointment_export_nonce' ) ) {
				die( 'Nonce not verified' );
			}
			header( 'Content-Type: text/csv' );
			header( 'Content-Disposition: inline; filename="All Appointment List-' . date( 'Y-m-d-H-i-s' ) . '.csv"' );
			$data_value = sanitize_text_field($_POST['appointment']);
			$results    = WL_ABS_Helper::get_appointment_data( $data_value );
			echo "Client Name,Staff Member,Service Type	,Contact,Booking Date,Start Time,End Time,Status,Client Email,Staff Email,Appointment Unique Id\r\n";
			if ( count( $results ) ) {
				foreach ( $results as $result ) {
					echo $result->client_name . "," . $result->staff_member . "," . $result->service_type . "," . $result->contact . "," . $result->booking_date . "," . $result->start_time . "," . $result->end_time . "," . $result->status . ", " . $result->payment_status . " ," . $result->client_email . "," . $result->staff_email . "," . $result->appt_unique_id . "\r\n";
				}
			}
			die();
		}
	}

	/* Appointment php file export */
	public static function abs_appointment_file_data_export() {
		if ( isset( $_POST['appointment_list_file_nonce'] ) && isset( $_POST['appointment_list_file'] ) ) {
			if ( ! wp_verify_nonce( $_POST['appointment_list_file_nonce'], 'appointment_list_file_nonce' ) ) {
				die( 'Nonce not verified' );
			}
			header( 'Content-Type: text/csv' );
			header( 'Content-Disposition: inline; filename="All Appointment List-' . date( 'Y-m-d-H-i-s' ) . '.csv"' );
			$results = WL_ABS_Helper::get_appointment_list_file_data();
			echo "Booking Id,Appoinment Date,Start Time,End Time,Employee,Customer Name,Service,Status,Contact No\r\n";
			if ( count( $results ) ) {
				foreach ( $results as $result ) {
					echo $result->id . "," . $result->booking_date . "," . $result->start_time . "," . $result->end_time . ", " . $result->staff_member . "," . $result->client_name . "," . $result->service_type . "," . $result->status . ", " . $result->payment_status . "," . $result->contact . "\r\n";
				}
			}
			die();
		}
	}

	/* Appointment csv download individual */
	public static function abs_appointment_individual_download() {
		if ( isset( $_POST['appointment_individual_file_nonce'] ) && isset( $_POST['appointment_individual_file'] ) && isset( $_POST['id'] ) && isset( $_POST['client_name'] ) ) {
			if ( ! wp_verify_nonce( $_POST['appointment_individual_file_nonce'], 'appointment_individual_file_nonce' ) ) {
				die();
			}
			$id          = sanitize_text_field($_POST['id']);
			$client_name = sanitize_text_field($_POST['client_name']);
			header( 'Content-Type: text/csv' );
			header( 'Content-Disposition: inline; filename="' . $client_name . ' Appointment-' . date( 'Y-m-d-H-i-s' ) . '.csv"' );
			$results = WL_ABS_Helper::get_appointment_individual_data( $id );
			echo "Booking Id,Appoinment Date,Start Time,End Time,Employee,Customer Name,Service,Status,Contact No\r\n";
			if ( count( $results ) ) {
				foreach ( $results as $result ) {
					echo $result->id . "," . $result->booking_date . "," . $result->start_time . "," . $result->end_time . ", " . $result->staff_member . "," . $result->client_name . "," . $result->service_type . "," . $result->status . ", " . $result->payment_status . "," . $result->contact . "\r\n";
				}
			}
			die();
		}
	}

	/* Customer tab CSV download all */
	public static function abs_customer_csv_download_all() {
		if ( isset( $_POST['customer_csv_all_nonce'] ) && isset( $_POST['customer_csv_all'] ) ) {
			if ( ! wp_verify_nonce( $_POST['customer_csv_all_nonce'], 'customer_csv_all_nonce' ) ) {
				die();
			}
			$customer_csv_all_nonce = sanitize_text_field($_POST['customer_csv_all_nonce']);
			header( 'Content-Type: text/csv' );
			header( 'Content-Disposition: inline; filename="All Customer List-' . date( 'Y-m-d-H-i-s' ) . '.csv"' );
			$results = WL_ABS_Helper::get_customer_csv_download();
			echo "First Name,Last Name,Phone,Skype Id,Email,Notes\r\n";
			if ( count( $results ) ) {
				foreach ( $results as $result ) {
					echo $result->first_name . "," . $result->last_name . "," . $result->phone . "," . $result->skype_id . ", " . $result->email . "," . $result->notes . "\r\n";
				}
			}
			die();
		}
	}

	/* Customer tab CSV download individual */
	public static function abs_customer_csv_download_individual() {
		if ( isset( $_POST['customer_csv_individual_nonce'] ) && isset( $_POST['customer_csv_individual'] ) && isset( $_POST['id'] ) && isset( $_POST['client_name'] ) ) {
			if ( ! wp_verify_nonce( $_POST['customer_csv_individual_nonce'], 'customer_csv_individual_nonce' ) ) {
				die();
			}
			$id          = sanitize_text_field($_POST['id']);
			$client_name = sanitize_text_field($_POST['client_name']);
			header( 'Content-Type: text/csv' );
			header( 'Content-Disposition: inline; filename="' . $client_name . '-' . date( 'Y-m-d-H-i-s' ) . '.csv"' );
			$results = WL_ABS_Helper::get_customer_csv_download_individual( $id );
			echo "First Name,Last Name,Phone,Skype Id,Email,Notes\r\n";
			if ( count( $results ) ) {
				foreach ( $results as $result ) {
					echo $result->first_name . "," . $result->last_name . "," . $result->phone . "," . $result->skype_id . ", " . $result->email . "," . $result->notes . "\r\n";
				}
			}
			die();
		}
	}
}

?>