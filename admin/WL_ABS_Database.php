<?php
defined( 'ABSPATH' ) or die();

class WL_ABS_Database {

	public static function activation() {
		global $wpdb;

		/* 1. create apt_appointments table (table not in database. Create new table) */
		$appointments_table = $wpdb->prefix . 'apt_appointments';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$appointments_table'" ) != $appointments_table ) {
			$AppointmentsManagerTable     = $wpdb->prefix . "apt_appointments";
			$AppointmentsManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$AppointmentsManagerTable` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`client_name` varchar(500) NOT NULL,
				`staff_member` varchar(500) NOT NULL,
				`service_type` varchar(500) NOT NULL,
				`contact` varchar(500) NOT NULL,
				`booking_date` varchar(100) NOT NULL,
				`start_time` varchar(100) NOT NULL,
				`end_time` varchar(100) NOT NULL,
				`status` varchar(100) NOT NULL,
				`payment_status` varchar(100) NOT NULL,
				`client_email` varchar(100) NOT NULL,
				`staff_email` varchar(100) NOT NULL,
				`appt_unique_id` varchar(100) NOT NULL,
				`repeat_appointment` varchar(100) NOT NULL,
				`re_days` varchar(100) NOT NULL,
				`re_weeks` varchar(100) NOT NULL,
				`re_months` varchar(100) NOT NULL,
				`re_start_date` varchar(100) NOT NULL,
				`re_end_date` varchar(100) NOT NULL,
				`appt_booked_by` varchar(100) NOT NULL,
				PRIMARY KEY (`id`)
			)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

			$wpdb->query( $AppointmentsManagerTable_sql );
		}

		/* 2. create apt_staff table */
		$staff_table = $wpdb->prefix . 'apt_staff';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$staff_table'" ) != $staff_table ) {
			$StaffManagerTableName = $wpdb->prefix . "apt_staff";
			$StaffTableManager_sql = "CREATE TABLE IF NOT EXISTS `$StaffManagerTableName` (
			`id` int(30) NOT NULL AUTO_INCREMENT,
			`staff_member_name` varchar(500) NOT NULL,
			`staff_icon` varchar(100) NOT NULL,
			`staff_member_image` varchar(1000) NOT NULL,
			`staff_email` varchar(50) NOT NULL,
			`staff_skype_id` varchar(50) NOT NULL,
			`staff_contact` varchar(50) NOT NULL,
			`staff_info` varchar(500) NOT NULL,
			`staff_services` varchar(5000) NOT NULL,
			`staff_service_category` varchar(1000) NOT NULL,
			`schedule_sunday` varchar(1000) NOT NULL,
			`schedule_monday` varchar(1000) NOT NULL,
			`schedule_tuesday` varchar(1000) NOT NULL,
			`schedule_wednesday` varchar(1000) NOT NULL,
			`schedule_thursday` varchar(1000) NOT NULL,
			`schedule_friday` varchar(1000) NOT NULL,
			`schedule_saturday` varchar(1000) NOT NULL,
			`sun_all_off` varchar(100) NOT NULL,
			`mon_all_off` varchar(100) NOT NULL,
			`tue_all_off` varchar(100) NOT NULL,
			`wed_all_off` varchar(100) NOT NULL,
			`thu_all_off` varchar(100) NOT NULL,
			`fri_all_off` varchar(100) NOT NULL,
			`sat_all_off` varchar(100) NOT NULL,
			PRIMARY KEY (`id`)
			)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
			$wpdb->query( $StaffTableManager_sql );
			$sunday_staff[]    = array(
				'start_time'  => "10:00",
				'end_time'    => "18:00",
				'break_start' => "14:30",
				'break_end'   => "15:00"
			);
			$monday_staff[]    = array(
				'start_time'  => "10:00",
				'end_time'    => "18:00",
				'break_start' => "14:30",
				'break_end'   => "15:00"
			);
			$tuesday_staff[]   = array(
				'start_time'  => "10:00",
				'end_time'    => "18:00",
				'break_start' => "14:30",
				'break_end'   => "15:00"
			);
			$wednesday_staff[] = array(
				'start_time'  => "10:00",
				'end_time'    => "18:00",
				'break_start' => "14:30",
				'break_end'   => "15:00"
			);
			$thursday_staff[]  = array(
				'start_time'  => "10:00",
				'end_time'    => "18:00",
				'break_start' => "14:30",
				'break_end'   => "15:00"
			);
			$friday_staff[]    = array(
				'start_time'  => "10:00",
				'end_time'    => "18:00",
				'break_start' => "14:30",
				'break_end'   => "15:00"
			);
			$saturday_staff[]  = array(
				'start_time'  => "10:00",
				'end_time'    => "18:00",
				'break_start' => "14:30",
				'break_end'   => "15:00"
			);
			$wpdb->insert( $wpdb->prefix . 'apt_staff', array(
				'id'                     => "1",
				'schedule_sunday'        => serialize( $sunday_staff ),
				'schedule_monday'        => serialize( $monday_staff ),
				'schedule_tuesday'       => serialize( $tuesday_staff ),
				'schedule_wednesday'     => serialize( $wednesday_staff ),
				'schedule_thursday'      => serialize( $thursday_staff ),
				'schedule_friday'        => serialize( $friday_staff ),
				'schedule_saturday'      => serialize( $saturday_staff ),
				'staff_member_name'      => "Demo staff",
				'staff_email'            => "xyz@mail.com",
				'staff_icon'             => "fa fa-briefcase",
				'staff_skype_id'         => "123456789",
				'staff_contact'          => "+1 9876543210",
				'staff_info'             => "This is Demo Staff",
				'staff_services'         => "1",
				'staff_service_category' => "1"
			) );

			//REFISTER DEMO STAFF AS SUBSCRIBER
			$user_data = array(
				'user_pass'  => 'xyz@mail.com',
				'user_email' => 'xyz@mail.com',
				'user_login' => 'xyz@mail.com',
				'role'       => 'subscriber' // Use default role or another role, e.g. 'editor'
			);
			$user_id   = wp_insert_user( $user_data );
			add_action( 'admin_init', 'wp_insert_user' );
		}

		/* 3. create apt_services table */
		$service_table = $wpdb->prefix . 'apt_services';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$service_table'" ) != $service_table ) {
			$ServiceManagerTable     = $wpdb->prefix . "apt_services";
			$ServiceManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$ServiceManagerTable` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(100) NOT NULL,
			`icon` varchar(100) NOT NULL,
			`color` varchar(100) NOT NULL,
			`duration` varchar(100) NOT NULL,
			`p_before` varchar(100) NOT NULL,
			`p_after` varchar(100) NOT NULL,
			`service_type` varchar(100) NOT NULL,
			`price` varchar(100) NOT NULL,
			`capacity` varchar(100) NOT NULL,
			`category` varchar(100) NOT NULL,
			`info_message` varchar(100) NOT NULL,
			PRIMARY KEY (`id`)
			)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
			$wpdb->query( $ServiceManagerTable_sql );
			$wpdb->insert( $wpdb->prefix . 'apt_services', array(
				'name'         => "Demo Service",
				'icon'         => "fa fa-adjust",
				'color'        => "#dd9933",
				'duration'     => "30",
				'p_before'     => "0",
				'p_after'      => '0',
				'service_type' => 'paid_service',
				'price'        => "10.00",
				'capacity'     => "0",
				'category'     => "1",
				'info_message' => "It is demo category"
			) );
		}

		/* 4. create apt_clients table */
		$clients_table = $wpdb->prefix . 'apt_clients';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$clients_table'" ) != $clients_table ) {
			$ClientsManagerTable     = $wpdb->prefix . "apt_clients";
			$ClientsManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$ClientsManagerTable` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`first_name` varchar(100) NOT NULL,
			`last_name` varchar(100) NOT NULL,
			`phone` varchar(30) NOT NULL,
			`skype_id` varchar(30) NOT NULL,
			`email` varchar(100) NOT NULL,
			`notes` varchar(3000) NOT NULL,
			PRIMARY KEY (`id`)
			)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
			$wpdb->query( $ClientsManagerTable_sql );
		}

		/* 5. create apt_payment table */
		$payment_table = $wpdb->prefix . 'apt_payment';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$payment_table'" ) != $payment_table ) {
			$PaymentManagerTable     = $wpdb->prefix . "apt_payment";
			$PaymentManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$PaymentManagerTable` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`payment_type` varchar(1000) NOT NULL,
			`customer` varchar(500) NOT NULL,
			`customer_email` varchar(1000) NOT NULL,
			`staff` varchar(1000) NOT NULL,
			`appointment_date` varchar(1000) NOT NULL,
			`service` varchar(1000) NOT NULL,
			`coupon_code_applied` varchar(1000) NOT NULL,
			`amount_after_discount` varchar(1000) NOT NULL,
			`amount` varchar(1000) NOT NULL,
			`status` varchar(1000) NOT NULL,
			`appt_unique_id` varchar(1000) NOT NULL,
			PRIMARY KEY (`id`)
			)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
			$wpdb->query( $PaymentManagerTable_sql );
		}

		/* 6. create apt_appearence table */
		$appearence_table = $wpdb->prefix . 'apt_appearence';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$appearence_table'" ) != $appearence_table ) {
			$AppearenceManagerTable     = $wpdb->prefix . "apt_appearence";
			$AppearenceManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$AppearenceManagerTable` (
			`id` bigint(11) NOT NULL AUTO_INCREMENT,
			`ap_bg_color` varchar(10) NOT NULL,
			`ap_progress_bar` varchar(10) NOT NULL,
			`ap_show_logo` varchar(10) NOT NULL,
			`ap_logo` text NOT NULL,
			`ap_logo_width` varchar(5) NOT NULL,
			`ap_logo_height` varchar(5) NOT NULL,
			`ap_show_phone_no` varchar(30) NOT NULL,
			`ap_phone_no` varchar(30) NOT NULL,
			`ap_phone_icon` varchar(100) NOT NULL,
			`ap_show_email` varchar(100) NOT NULL,
			`ap_email` varchar(100) NOT NULL,
			`ap_email_icon` varchar(100) NOT NULL,
			`ap_social_link1` varchar(100) NOT NULL,
			`ap_social_link2` varchar(100) NOT NULL,
			`ap_social_link3` varchar(100) NOT NULL,
			`ap_social_link4` varchar(100) NOT NULL,
			`ap_social_link5` varchar(100) NOT NULL,
			`ap_social_icon1` varchar(100) NOT NULL,
			`ap_social_icon2` varchar(100) NOT NULL,
			`ap_social_icon3` varchar(100) NOT NULL,
			`ap_social_icon4` varchar(100) NOT NULL,
			`ap_social_icon5` varchar(100) NOT NULL,
			`service_navigation_text` varchar(100) NOT NULL,
			`time_navigation_text_backward` varchar(100) NOT NULL,
			`time_navigation_text_forward` varchar(100) NOT NULL,
			`details_navigation_text_backward` varchar(100) NOT NULL,
			`details_navigation_text_forward` varchar(100) NOT NULL,
			`confirm_navigation_text_backward` varchar(100) NOT NULL,
			`confirm_navigation_text_forward` varchar(100) NOT NULL,
			`payment_navigation_text_forward` varchar(100) NOT NULL,
			`done_page_icon` varchar(100) NOT NULL,
			PRIMARY KEY (`id`)
			)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
			$wpdb->query( $AppearenceManagerTable_sql );

			$appt_logo         = plugin_dir_url( __FILE__ ) . "../assets/images/logo.png";
			$Insert_Appearance = "INSERT INTO `$appearence_table`(`id`,`ap_bg_color`,`ap_progress_bar` , `ap_show_logo`, `ap_logo` ,`ap_logo_width` ,`ap_logo_height` ,`ap_show_phone_no` ,`ap_phone_no` ,`ap_phone_icon` ,`ap_show_email` ,`ap_email` ,`ap_email_icon` ,
			`ap_social_link1` ,`ap_social_link2` ,`ap_social_link3` ,`ap_social_link4` ,`ap_social_link5` ,`service_navigation_text` ,`ap_social_icon1` ,`ap_social_icon2` ,`ap_social_icon3` ,`ap_social_icon4` ,`ap_social_icon5` ,`time_navigation_text_backward` ,
			`time_navigation_text_forward` ,`details_navigation_text_backward` ,`details_navigation_text_forward` ,`confirm_navigation_text_backward` ,`confirm_navigation_text_forward` ,`payment_navigation_text_forward` ,`done_page_icon` ) 
			VALUES ( '1',  '#2bb7bf','yes', 'yes', '$appt_logo', '150', '150', 'yes', '+1 1234567890', 'fa fa-phone', 'yes', 'example@gmail.com', 'fa fa-envelope', 'http://facebook.com', 'http://google.com', 'http://twitter.com', 'http://pinterest.com', 'http://instagram.com',
			'Next', 'fa fa-facebook', 'fa fa-google-plus', 'fa fa-twitter', 'fa fa-pinterest', 'fa fa-instagram', 'Back', 'Next', 'Back', 'Next', 'Back', 'Next', 'Next', 'fa fa-thumbs-up');";
			$wpdb->query( $Insert_Appearance );
		}

		/* 7. create apt_holidays table */
		$holidays_table = $wpdb->prefix . 'apt_holidays';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$holidays_table'" ) != $holidays_table ) {
			$HolidaysManagerTable     = $wpdb->prefix . "apt_holidays";
			$HolidaysManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$HolidaysManagerTable` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`all_off` varchar(30) NOT NULL,
			`name` varchar(100) NOT NULL,
			`start_time` varchar(100) NOT NULL,
			`end_time` varchar(100) NOT NULL,
			`holiday_date` varchar(100) NOT NULL,
			`repeat_value` varchar(100) NOT NULL,
			`repeat_days` varchar(100) NOT NULL,
			`repeat_weeks` varchar(100) NOT NULL,
			`repeat_bi_weeks` varchar(100) NOT NULL,
			`repeat_month` varchar(100) NOT NULL,
			`start_date` varchar(100) NOT NULL,
			`end_date` varchar(100) NOT NULL,
			`notes` varchar(100) NOT NULL,

			PRIMARY KEY (`id`)
			)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
			$wpdb->query( $HolidaysManagerTable_sql );
		}

		/* 8. create apt_coupons table */
		$coupons_table = $wpdb->prefix . 'apt_coupons';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$coupons_table'" ) != $coupons_table ) {
			$CouponsManagerTable     = $wpdb->prefix . "apt_coupons";
			$CouponsManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$CouponsManagerTable` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`coupon_code` varchar(100) NOT NULL,
			`service_name` varchar(500) NOT NULL,
			`time_limit` varchar(100) NOT NULL,
			`per_user_limit` varchar(30) NOT NULL,
			`discount_type` varchar(100) NOT NULL,
			`discount_method` varchar(100) NOT NULL,
			`coupon_start_date` varchar(30) NOT NULL,
			`coupon_end_date` varchar(30) NOT NULL,
			PRIMARY KEY (`id`)
			)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
			$wpdb->query( $CouponsManagerTable_sql );
		}

		/* 9. create apt_settings table */
		$settings_table = $wpdb->prefix . 'apt_settings';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$settings_table'" ) != $settings_table ) {
			$SettingManagerTable     = $wpdb->prefix . "apt_settings";
			$SettingManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$SettingManagerTable` (
			`id` int(11) NOT NULL ,
			`time_zone` varchar(300) NOT NULL,
			`currency` varchar(30) NOT NULL,
			`ap_theme_color` varchar(30) NOT NULL,
			`time_slots` varchar(30) NOT NULL,
			`custom_slot` varchar(30) NOT NULL,
			`service_duration_type` varchar(30) NOT NULL,
			`appt_status` varchar(30) NOT NULL,
			`accept_payment` varchar(30) NOT NULL,
			`ap_mintime` varchar(30) NOT NULL,
			`b_name` varchar(30) NOT NULL,
			`b_owner` varchar(30) NOT NULL,
			`b_phone` varchar(30) NOT NULL,
			`b_fax` varchar(30) NOT NULL,
			`b_email` varchar(30) NOT NULL,
			`b_blog_url` varchar(30) NOT NULL,
			`b_postal_code` varchar(30) NOT NULL,
			`b_address` varchar(30) NOT NULL,
			`b_website` varchar(30) NOT NULL,
			`bh_sunday` varchar(1000) NOT NULL,
			`bh_monday` varchar(1000) NOT NULL,
			`bh_tuesday` varchar(1000) NOT NULL,
			`bh_wednesday` varchar(1000) NOT NULL,
			`bh_thursday` varchar(1000) NOT NULL,
			`bh_friday` varchar(1000) NOT NULL,
			`bh_saturday` varchar(1000) NOT NULL,
			`staff_weekly_off` varchar(1000) NOT NULL,
			`payment_currency` varchar(30) NOT NULL,
			`checkout` varchar(30) NOT NULL,
			`api_username` varchar(30) NOT NULL,
			`api_password` varchar(30) NOT NULL,
			`api_signature` varchar(30) NOT NULL,
			`checkout_sandbox_mode` varchar(30) NOT NULL,
			`paypal_checkout` varchar(30) NOT NULL,
			`paypal_email` varchar(30) NOT NULL,
			`payment_mode` varchar(30) NOT NULL,
			`razorpay_checkout` varchar(30) NOT NULL,
			`razorpay_api_key` varchar(30) NOT NULL,
			`razorpay_name` varchar(30) NOT NULL,
			`razorpay_description` varchar(30) NOT NULL,
			`razorpay_currency` varchar(30) NOT NULL,
			`razorpay_logo` varchar(1000) NOT NULL,
			`razorpay_theme_color` varchar(30) NOT NULL,
			`cal_theme_style` varchar(100) NOT NULL,
			`cal_date_format` varchar(30) NOT NULL,
			`cal_time_format` varchar(30) NOT NULL,
			`cal_view` varchar(30) NOT NULL,
			`cal_first_day` varchar(30) NOT NULL,
			`cal_pending_color` varchar(30) NOT NULL,
			`cal_approved_color` varchar(30) NOT NULL,
			`cal_cancelled_color` varchar(30) NOT NULL,
			`cal_completed_color` varchar(30) NOT NULL,
			`cal_off_time_color` varchar(30) NOT NULL,
			`cal_font_style` varchar(30) NOT NULL,
			`advance_booking_time` varchar(30) NOT NULL,
			`advance_cancel_time` varchar(30) NOT NULL,
			`enable_reminder` varchar(30) NOT NULL,
			`reminder_time` varchar(30) NOT NULL,
			`staff_service` varchar(500) NOT NULL,
			`staff_id` varchar(500) NOT NULL,
			`staff_date` varchar(500) NOT NULL,
			`custom_css` text NOT NULL,
			PRIMARY KEY (`id`)
			)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
			$wpdb->query( $SettingManagerTable_sql );
			$sunday[]    = array( 'start_time' => "10:00", 'end_time' => "18:00" );
			$monday[]    = array( 'start_time' => "10:00", 'end_time' => "18:00" );
			$tuesday[]   = array( 'start_time' => "10:00", 'end_time' => "18:00" );
			$wednesday[] = array( 'start_time' => "10:00", 'end_time' => "18:00" );
			$thursday[]  = array( 'start_time' => "10:00", 'end_time' => "18:00" );
			$friday[]    = array( 'start_time' => "10:00", 'end_time' => "18:00" );
			$saturday[]  = array( 'start_time' => "10:00", 'end_time' => "18:00" );
			$wpdb->insert( $wpdb->prefix . 'apt_settings', array(
				'id'                    => "1",
				'currency'              => "INR",
				'ap_theme_color'        => "#1e8cbecc",
				'time_slots'            => "custom_slots",
				'custom_slot'           => "5",
				'service_duration_type' => "sd",
				'appt_status'           => "pending",
				'accept_payment'        => "yes",
				'bh_sunday'             => serialize( $sunday ),
				'bh_monday'             => serialize( $monday ),
				'bh_tuesday'            => serialize( $tuesday ),
				'bh_wednesday'          => serialize( $wednesday ),
				'bh_thursday'           => serialize( $thursday ),
				'bh_friday'             => serialize( $friday ),
				'bh_saturday'           => serialize( $saturday ),
				'payment_currency'      => 'USD',
				'razorpay_currency'     => 'USD',
				'razorpay_theme_color'  => '#ffb904',
				'payment_mode'          => 'direct_paypal_mode',
				'cal_theme_style'       => 'theme_01',
				'cal_date_format'       => 'd-m-Y',
				'cal_time_format'       => 'H:i',
				'cal_view'              => 'month',
				'cal_first_day'         => '0',
				'cal_pending_color'     => '#e9cb31',
				'cal_approved_color'    => 'green',
				'cal_cancelled_color'   => 'red',
				'cal_completed_color'   => '#337ab7',
				'cal_off_time_color'    => '#676778',
				'cal_font_style'        => 'Arial black',
				'enable_reminder'       => 'yes',
				'reminder_time'         => '1'
			) );
		}

		/* 10. Create apt_category table */
		$category_table = $wpdb->prefix . 'apt_category';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$category_table'" ) != $category_table ) {
			$CategoryManagerTable     = $wpdb->prefix . "apt_category";
			$CategoryManagerTable_sql = "CREATE TABLE IF NOT EXISTS `$CategoryManagerTable` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(100) NOT NULL,
			`icon` varchar(100) NOT NULL,
			PRIMARY KEY (`id`)
			)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
			$wpdb->query( $CategoryManagerTable_sql );
			$wpdb->insert( $wpdb->prefix . 'apt_category', array(
				'name' => "Demo Category",
				'icon' => "dashicons dashicons-category"
			) );
		}
	}

	/* Remove database */
	public static function database_remove() {
		if ( isset( $_POST['appointment_remove_database_nonce'] ) && isset( $_POST['remove_database'] ) ) {
			if ( ! wp_verify_nonce( $_POST['appointment_remove_database_nonce'], 'appointment_remove_database_nonce' ) ) {
				die();
			}
			global $wpdb;

			/* 1. Delete apt_appointments table*/
			$AppointmentsManagerTable = $wpdb->prefix . "apt_appointments";
			$DropAppointments         = "DROP TABLE `$AppointmentsManagerTable`";
			$wpdb->query( $DropAppointments );

			/* 2. Delete apt_staff table*/
			$DropStaffManagerTableName = $wpdb->prefix . "apt_staff";
			$DropStaff                 = "DROP TABLE `$DropStaffManagerTableName`";
			$wpdb->query( $DropStaff );

			/* 3. Delete apt_services table*/
			$DropServiceManagerTable = $wpdb->prefix . "apt_services";
			$DropService             = "DROP TABLE `$DropServiceManagerTable`";
			$wpdb->query( $DropService );

			/* 4. Delete apt_clients table*/
			$DropClientsManagerTable = $wpdb->prefix . "apt_clients";
			$DropClients             = "DROP TABLE `$DropClientsManagerTable`";
			$wpdb->query( $DropClients );

			/* 5. Delete apt_payment table*/
			$DropPaymentManagerTable = $wpdb->prefix . "apt_payment";
			$DropPayment             = "DROP TABLE `$DropPaymentManagerTable`";
			$wpdb->query( $DropPayment );

			/* 6. Delete apt_appearence table*/
			$DropAppearenceManagerTable = $wpdb->prefix . "apt_appearence";
			$DropAppearence             = "DROP TABLE `$DropAppearenceManagerTable`";
			$wpdb->query( $DropAppearence );

			/* 7. Delete apt_holidays table*/
			$DropHolidaysManagerTable = $wpdb->prefix . "apt_holidays";
			$DropHolidays             = "DROP TABLE `$DropHolidaysManagerTable`";
			$wpdb->query( $DropHolidays );

			/* 8. Delete apt_coupons table*/
			$DropCouponsManagerTable = $wpdb->prefix . "apt_coupons";
			$DropCoupons             = "DROP TABLE `$DropCouponsManagerTable`";
			$wpdb->query( $DropCoupons );

			/* 9. Delete apt_settings table*/
			$DropSettingManagerTable = $wpdb->prefix . "apt_settings";
			$DropSetting             = "DROP TABLE `$DropSettingManagerTable`";
			$wpdb->query( $DropSetting );

			/* 10. Delete Category table */
			$DropCategoryManagerTable = $wpdb->prefix . "apt_category";
			$DropCategory             = "DROP TABLE `$DropCategoryManagerTable`";
			$wpdb->query( $DropCategory );


			/* 11. DELETE NOTIFICTION OPTION*/
			delete_option( 'Appoint_notification' );
			delete_option( 'service_tips' );
			delete_option( 'time_tips' );
			delete_option( 'details_tips' );
			delete_option( 'confirm_tips' );
			delete_option( 'payment_tips' );
			delete_option( 'done_tips' );

			deactivate_plugins( 'appointment-booking-scheduler/appointment-booking-scheduler.php', true );
			$url = admin_url( 'plugins.php?deactivate=true' );
			header( "Location: $url" );
			die();
		}
	}
}

?>