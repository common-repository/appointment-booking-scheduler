<?php
defined( 'ABSPATH' ) or die();

class WL_ABS_Default {

	public static function set_default_settings() {
		self::APPOINT_NotificationSettings();
		self::Appoint_Service_Tips();
		self::Appoint_Time_Tips();
		self::Appoint_Details_Tips();
		self::Appoint_Confirm_Tips();
		self::Appoint_Payment_Tips();
		self::Appoint_Done_Tips();
	}

	public static function APPOINT_NotificationSettings() {

		/* Notify Admin On Pending Appointment */
		$admin_pending_subject = "Hi  [ADMIN_NAME]  : New Appointment Scheduled By [CLIENT_NAME] is [APPOINTMENT_STATUS]";
		$admin_pending_body    = "
		Hi Admin,
			
		Appointment Details:

		Client Name: [CLIENT_NAME]
		Client Email: [CLIENT_EMAIL]
		Appointment For: [SERVICE_NAME]
		Appointment Date: 	[APPOINTMENT_DATE]
		Appointment Time: 	[APPOINTMENT_TIME]
		Appointment Status: 	[APPOINTMENT_STATUS]

		View this appointment at [SITE_URL] dashboard.

		Best Regards 
		[ADMIN_NAME]
		[BLOG_NAME]
		[SITE_URL]
		";

		/* Notify Admin On Approved Appointment */
		$admin_approved_subject = "Hi  [ADMIN_NAME]  : New Appointment Scheduled By [CLIENT_NAME] is [APPOINTMENT_STATUS]";
		$admin_approved_body    = "
		Hi Admin,
			
		Appointment Details:

		Client Name: [CLIENT_NAME]
		Client Email: [CLIENT_EMAIL]
		Appointment For: [SERVICE_NAME]
		Appointment Date: 	[APPOINTMENT_DATE]
		Appointment Time: 	[APPOINTMENT_TIME]
		Appointment Status: 	[APPOINTMENT_STATUS]

		View this appointment at [SITE_URL] dashboard.

		Best Regards 
		[ADMIN_NAME]
		[BLOG_NAME]
		[SITE_URL]
		";

		/* Notify Admin On Cancelled Appointment */
		$admin_cancel_subject = "Hi  [ADMIN_NAME]  : New Appointment Scheduled By [CLIENT_NAME] is [APPOINTMENT_STATUS]";
		$admin_cancel_body    = "
		Hi Admin,
			
		Appointment Details:

		Client Name: [CLIENT_NAME]
		Client Email: [CLIENT_EMAIL]
		Appointment For: [SERVICE_NAME]
		Appointment Date: 	[APPOINTMENT_DATE]
		Appointment Time: 	[APPOINTMENT_TIME]
		Appointment Status: 	[APPOINTMENT_STATUS]

		View this appointment at [SITE_URL] dashboard.

		Best Regards 
		[ADMIN_NAME]
		[BLOG_NAME]
		[SITE_URL]
		";

		/* Notify Client On Pending Appointment */
		$client_pending_subject = "[BLOG_NAME] : Appointment Status.";
		$client_pending_body    = "
		Hi [CLIENT_NAME],

		Your appointment for [SERVICE_NAME] on [APPOINTMENT_DATE] at [APPOINTMENT_TIME] is [APPOINTMENT_STATUS]..

		Thank you for scheduling appointment with [BLOG_NAME].

		Please Dont forget!!!

		Best Regards 
		[ADMIN_NAME]
		[BLOG_NAME]
		[SITE_URL]
		";
		/* Notify Client On Approved Appointment */
		$client_approved_subject = "[BLOG_NAME] : Appointment Status.";
		$client_approved_body    = "
		Hi [CLIENT_NAME],

		Your scheduled appointment for [SERVICE_NAME] on [APPOINTMENT_DATE] from [APPOINTMENT_TIME] has been [APPOINTMENT_STATUS].

		Thank you for scheduling appointment with [BLOG_NAME].

		Please Dont forget!!!

		Best Regards 
		[ADMIN_NAME]
		[BLOG_NAME]
		[SITE_URL]
		";
		/* Notify Client On Cancelled Appointment */
		$client_cancel_subject = "[BLOG_NAME] : Appointment Status.";
		$client_cancel_body    = "
		Hi [CLIENT_NAME],

		Your scheduled appointment for [SERVICE_NAME] on [APPOINTMENT_DATE] from [APPOINTMENT_TIME] has been [APPOINTMENT_STATUS].

		Thank you for scheduling appointment with [BLOG_NAME].


		Best Regards 
		[ADMIN_NAME]
		[BLOG_NAME]
		[SITE_URL]
		";

		/* Notify Staff On Pending Appointment */
		$staff_pending_subject = "[BLOG_NAME].: Appointment Status.";
		$staff_pending_body    = "
		Hi [STAFF_NAME],

		Your appointment for [SERVICE_NAME] with [CLIENT_NAME] on [APPOINTMENT_DATE] at [APPOINTMENT_TIME] is [APPOINTMENT_STATUS].

		Please Dont forget!!!

		Best Regards 
		[ADMIN_NAME]
		[BLOG_NAME]
		[SITE_URL]
		";

		/* Notify Staff On Approved Appointment */
		$staff_approved_subject = "[BLOG_NAME]: Appointment Status.";
		$staff_approved_body    = "
		Hi [STAFF_NAME],

		Your appointment for [SERVICE_NAME] with [CLIENT_NAME] on [APPOINTMENT_DATE] at [APPOINTMENT_TIME] has been [APPOINTMENT_STATUS].

		Please Dont forget!!!

		Best Regards 
		[ADMIN_NAME]
		[BLOG_NAME]
		[SITE_URL]
		";
		/* Notify Staff On Cancelled Appointment */
		$staff_cancelled_subject = "[ADMIN_NAME]: Appointment Status.";
		$staff_cancelled_body    = "
		Hi [STAFF_NAME],

		Your appointment for [SERVICE_NAME] with [CLIENT_NAME] on [APPOINTMENT_DATE] at [APPOINTMENT_TIME] has been [APPOINTMENT_STATUS].

		Please Dont forget!!!

		Best Regards 
		[ADMIN_NAME]
		[BLOG_NAME]
		[SITE_URL]
		";

		$admin_email     = get_option( 'admin_email' );
		$DefaultSettings = array(
			"emailtype"                            => 'phpmail',
			"enable"                               => 'yes',
			"wpemail"                              => '',
			"phpemail"                             => $admin_email,
			"hostname"                             => '',
			"portno"                               => '',
			"smtpemail"                            => '',
			"password"                             => '',
			"send_notification_admin_approved"     => 'yes',
			"subject_admin_approved"               => $admin_approved_subject,
			"admin_body_approved"                  => $admin_approved_body,
			"send_notification_admin_pending"      => 'yes',
			"subject_admin_pending"                => $admin_pending_subject,
			"admin_body_pending"                   => $admin_pending_body,
			"send_notification_admin_cancelled"    => 'yes',
			"subject_admin_cancelled"              => $admin_cancel_subject,
			"admin_body_cancelled"                 => $admin_cancel_body,
			"send_notification_client_approval"    => 'yes',
			"subject_notification_client_approval" => $client_approved_subject,
			"body_notification_client_approval"    => $client_approved_body,
			"send_notification_client_pending"     => 'yes',
			"subject_notification_client_pending"  => $client_pending_subject,
			"body_notification_client_pending"     => $client_pending_body,
			"send_notification_client_cancel"      => 'yes',
			"subject_notification_client_cancel"   => $client_cancel_subject,
			"body_notification_client_cancel"      => $client_cancel_body,
			"send_notification_staff_approval"     => '',
			"subject_notification_staff_approval"  => '',
			"body_notification_staff_approval"     => '',
			"send_notification_staff_pending"      => '',
			"subject_notification_staff_pending"   => '',
			"body_notification_staff_pending"      => '',
			"send_notification_staff_cancel"       => '',
			"subject_notification_staff_cancel"    => '',
			"body_notification_staff_cancel"       => '',
		);
		add_option( "Appoint_notification", $DefaultSettings );
	}

	/* set frontend appointment step by step tips */
	public static function Appoint_Service_Tips() {
		$service_tips    = "
		<b>Follow The Step:</b></center>

		* Select Service.
		* Select Appointment Date.
		";
		$DefaultSettings = $service_tips;
		add_option( "service_tips", $DefaultSettings );
	}

	public static function Appoint_Time_Tips() {
		$time_tips       = "
		<b>Follow The Step:</b>

		* Select Appointment Time.
		";
		$DefaultSettings = $time_tips;
		add_option( "time_tips", $DefaultSettings );
	}

	public static function Appoint_Details_Tips() {
		$detail_tips     = "
		<b>Follow The Step:</b>

		* Sign-Up If You Are New User. 
		* Login If You Are Existing User. 
		";
		$DefaultSettings = $detail_tips;
		add_option( "details_tips", $DefaultSettings );
	}

	public static function Appoint_Confirm_Tips() {
		$confirm_tips    = "
		<b>Follow The Step:</b>

		* Please Check The Appointment Details
		";
		$DefaultSettings = $confirm_tips;
		add_option( "confirm_tips", $DefaultSettings );
	}

	public static function Appoint_Payment_Tips() {
		$payment_tips    = "
		<b>Follow The Step:</b>

		* Select Payment Method.
		";
		$DefaultSettings = $payment_tips;
		add_option( "payment_tips", $DefaultSettings );
	}

	public static function Appoint_Done_Tips() {
		$done_tips       = "
		<b>BOOKING DONE.</b>
		Thank You! Your Booking Is Complete.
		";
		$DefaultSettings = $done_tips;
		add_option( "done_tips", $DefaultSettings );
	}

}

?>