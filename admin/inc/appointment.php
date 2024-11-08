<?php
defined( 'ABSPATH' ) or die();
?>
<script>
    jQuery(document).ready(function () {
        jQuery('#s_price').val('');
        jQuery('#service_name').change(function () {
            jQuery('#s_price').val(jQuery(this).find("option:selected").attr("title"));
        });
    });

    jQuery(document).ready(function () {
        jQuery(document).on("change", '#a_customer', function (event) {
            jQuery('#customer_email').val(jQuery(this).find("option:selected").attr("title"));
        });
    });

    // multiple select checkbox
    jQuery(document).ready(function () {
        jQuery('#select_appointment').click(function (event) {  //on click
            if (this.checked) { // check select status
                jQuery('.checkbox1').each(function () { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"
                });
            } else {
                jQuery('.checkbox1').each(function () { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"
                });
            }
        });
    });

    //insert appointment
    function save_appointment() {
        if (jQuery("#provider_name").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#provider_name_alert").show();
            jQuery("#provider_name").focus();
            return false;
        }

        if (jQuery("#service_name").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#service_name_alert").show();
            jQuery("#service_name").focus();
            return false;
        }

        if (jQuery("#ap_datepicker").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#ap_datepicker_alert").show();
            return false;
        }

        if (jQuery("#start_period").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#start_period_alert").show();
            return false;
        }

        if (jQuery("#end_period").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#end_period_alert").show();
            return false;
        }

        if (jQuery("#a_customer").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#a_customer_alert").show();
            jQuery("#a_customer").focus();
            return false;
        }

        if (jQuery("#status").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#status_alert").show();
            jQuery("#status").focus();
            return false;
        }

        if (jQuery("#p_status").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#p_status_alert").show();
            jQuery("#p_status").focus();
            return false;
        }

        jQuery("#save_appointment_details").prop('disabled', true);
        jQuery('#save_appointment_details').html('<i class="fa fa-spinner fa-spin"></i> <?php _e( "Saving", WL_ABS_SYSTEM ); ?>');

        jQuery.ajax({
            url: location.href,
            type: "POST",
            data: jQuery("form#appoint_form").serialize(),
            dataType: "html",
            /* Do not cache the page */
            cache: false,
            /* success */
            success: function (html) {
                jQuery("#save_appointment_details").prop('disabled', false);
                jQuery('#save_appointment_details').html('<?php _e( "Save", WL_ABS_SYSTEM ); ?>');
                jQuery('form#appoint_form')[0].reset();
                jQuery('div#appoint').modal('hide');
                jQuery(".validation_alert").hide();
                jQuery.notify("<?php _e( "Appointment Created Successfully", WL_ABS_SYSTEM ); ?>", {
                    type: "success",
                    icon: "check",
                    align: "center",
                    verticalAlign: "middle",
                    color: "#3c763d",
                    background: "#dff0d8"
                });
                jQuery('#appointment_example').DataTable().ajax.reload(null, false);
                jQuery('#bootstrapModalFullCalendar').fullCalendar('rerenderEvents');
                jQuery('#bootstrapModalFullCalendar').fullCalendar('refetchEvents');
            }
        });
    }

    jQuery(document).ready(function () {
        var table = jQuery('#appointment_example').DataTable({
            stateSave: true,
            responsive: true,
            ajax: ajaxurl + '?action=fn_my_appointment_dataloader_ajax',
            "aoColumnDefs": [
                {'bSortable': false, className: 'all', 'aTargets': ['nosort'],},
                {className: 'all', orderable: true, targets: ['sh_ow']}],
            "language": {
                "loadingRecords": "<?php _e( 'No Customer Add', WL_ABS_SYSTEM ); ?>"
            },
        });
    });

    /* fetch records on  model */
    jQuery(document).ready(function () {
        jQuery('#update_appoin_model').on('show.bs.modal', function (e) {
            var rowid = jQuery(e.relatedTarget).data('id');
            jQuery.ajax({
                type: 'post',
                url: ajaxurl + '?action=appointment_ajax_request',
                data: 'appoint_info=' + rowid, //Pass $id
                success: function (data) {
                    jQuery('#fetch_appoint_model').html(data);
                    var dateToday = new Date();
                    jQuery(".a_date").datepicker({minDate: dateToday,});
                    jQuery(".phone").intlTelInput();
                }
            });
        });
    });

    /* update appointment */
    function update_appointment() {
        if (jQuery("#u_provider_name").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#u_provider_name_alert").show();
            jQuery("#u_provider_name").focus();
            return false;
        }

        if (jQuery("#u_service_name").val() == "0") {
            jQuery("#u_provider_name_alert").hide();
            jQuery("#u_service_name_alert").show();
            jQuery("#u_service_name").focus();
            return false;
        }

        if (jQuery("#u_datepicker").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#u_datepicker_alert").show();
            return false;
        }

        if (jQuery("#u_start_period").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#u_start_period_alert").show();
            return false;
        }

        if (jQuery("#u_end_period").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#u_end_period_alert").show();
            return false;
        }

        if (jQuery("#u_a_customer").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#u_a_customer_name_alert").show();
            jQuery("#a_customer").focus();
            return false;
        }

        if (jQuery("#u_status").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#u_status_alert").show();
            jQuery("#u_status").focus();
            return false;
        }

        if (jQuery("#u_payment_status").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#u_p_status_alert").show();
            jQuery("#u_payment_status").focus();
            return false;
        }

        jQuery("#update_appointment_details").prop('disabled', true);
        jQuery('#update_appointment_details').html('<i class="fa fa-spinner fa-spin"></i> <?php _e( "Updating", WL_ABS_SYSTEM ); ?>');

        jQuery.ajax({
            url: location.href,
            type: "POST",
            data: jQuery("form#update_appoint_form").serialize(),
            dataType: "html",
            /* Do not cache the page */
            cache: false,
            /* success */
            success: function (html) {
                jQuery("#update_appointment_details").prop('disabled', false);
                jQuery('#update_appointment_details').html('<?php _e( "Update", WL_ABS_SYSTEM ); ?>');
                jQuery('form#update_appoint_form')[0].reset();
                jQuery('div#update_appoin_model').modal('hide');
                jQuery(".validation_alert").hide();
                jQuery.notify("<?php _e( "Appointment Updated Successfully", WL_ABS_SYSTEM ); ?>", {
                    type: "success",
                    icon: "check",
                    align: "center",
                    verticalAlign: "middle",
                    color: "#3c763d",
                    background: "#dff0d8"
                });
                jQuery('#appointment_example').DataTable().ajax.reload(null, false);
                jQuery('#bootstrapModalFullCalendar').fullCalendar('rerenderEvents');
                jQuery('#bootstrapModalFullCalendar').fullCalendar('refetchEvents');
            }
        });
    }

    /* single delete */
    jQuery(document).on("click", '.del_appoint', function (event) {
        var d_id = jQuery(this).attr('href');
        var res = d_id.substring(1);

        jQuery.confirm({
            title: '<?php _e( "Please Confirm", WL_ABS_SYSTEM ); ?>',
            theme: 'black',
            content: '<?php _e( "Are you sure to Delete Appointment", WL_ABS_SYSTEM ); ?>',
            animation: 'rotate',
            closeAnimation: 'rotateXR',
            icon: 'fa fa-check-square-o',
            confirmButton: '<?php _e( "Delete", WL_ABS_SYSTEM ); ?>',
            cancelButton: '<?php _e( "Cancel", WL_ABS_SYSTEM ); ?>',
            confirm: function () {
                jQuery.ajax({
                    data: "appoint_id=" + res,
                    url: location.href,
                    type: "POST",
                    success: function (data) {
                        jQuery.notify("<?php _e( "Appointment Delete Successfully", WL_ABS_SYSTEM ); ?>", {
                            type: "success",
                            icon: "check",
                            align: "center",
                            verticalAlign: "middle",
                            color: "#3c763d",
                            background: "#dff0d8"
                        });
                        jQuery('#appointment_example').DataTable().ajax.reload(null, false);
                    }
                });
            },
        });
    });

    /* multiple delete */
    jQuery(function () {
        jQuery("a.appoint_delete").click(function () {
            ids = new Array();
            a = 0;
            jQuery(".appoint_check:checked").each(function (i) {
                ids[i] = jQuery(this).val();
            });
            if (ids.length == 0) {
                jQuery.notify("<?php _e( 'Please Select At Least One Appointment To Delete', WL_ABS_SYSTEM ); ?>", {
                    type: "success",
                    icon: "check",
                    align: "center",
                    verticalAlign: "middle",
                    color: "#fff",
                    background: "#FF0000"
                });
            }
            else {
                jQuery.confirm({
                    title: '<?php _e( "Please Confirm", WL_ABS_SYSTEM ); ?>',
                    theme: 'black',
                    content: '<?php _e( "Are you sure to Delete Appointment", WL_ABS_SYSTEM ); ?>',
                    animation: 'rotate',
                    closeAnimation: 'rotateXR',
                    icon: 'fa fa-check-square-o',
                    confirmButton: '<?php _e( "Delete", WL_ABS_SYSTEM ); ?>',
                    cancelButton: '<?php _e( "Cancel", WL_ABS_SYSTEM ); ?>',
                    confirm: function () {
                        jQuery(".appoint_delete").prop('disabled', true);
                        jQuery('.appoint_delete').html('<i class="fa fa-spinner fa-spin"></i> <?php _e( "Deleting", WL_ABS_SYSTEM ); ?>');

                        jQuery.ajax({
                            data: "multi_appoint_id=" + ids,
                            url: location.href,
                            type: "POST",
                            success: function (res) {
                                jQuery(".appoint_delete").prop('disabled', false);
                                jQuery('.appoint_delete').html('<?php _e( "Delete", WL_ABS_SYSTEM ); ?>');
                                jQuery.notify("<?php _e( "Appointment Delete Successfully", WL_ABS_SYSTEM ); ?>", {
                                    type: "success",
                                    icon: "check",
                                    align: "center",
                                    verticalAlign: "middle",
                                    color: "#3c763d",
                                    background: "#dff0d8"
                                });
                                jQuery('#appointment_example').DataTable().ajax.reload(null, false);
                                jQuery('input[type=checkbox]').attr('checked', false);
                                if (res == 1) {
                                    jQuery(".appoint_check:checked").each(function () {
                                        jQuery(this).parent.remove();
                                    })
                                }
                            }
                        });
                    },
                });
            }
            return false;
        })
    });

    jQuery(document).on("change", '.payment_status_value', function (event) {
        var status = jQuery(this).val();
        var id = jQuery(this).attr("data-id");
        var apt_client_email = jQuery(this).attr("title");
        var apt_staff_email = jQuery(this).attr("apt_staff_email");

        var apt_client_name = jQuery(this).attr("apt_client_name");
        var apt_time = jQuery(this).attr("apt_time");
        var apt_end_time = jQuery(this).attr("apt_end_time");
        var apt_date = jQuery(this).attr("apt_date");
        var apt_service_name = jQuery(this).attr("apt_service_name");
        var apt_staff_name = jQuery(this).attr("apt_staff_name");

        jQuery.ajax({
            url: location.href,
            type: "POST",
            data: {status: status, id: id},
            dataType: "html",
            /* Do not cache the page */
            cache: false,
            /* success */
            success: function (html) {
            }
        });

        if (status !== "completed") {
            jQuery.confirm({
                title: '<?php _e( "Please Confirm", WL_ABS_SYSTEM ); ?>',
                theme: 'black',
                content: '<?php _e( "Status Updated. Do you want to Send Mail?", WL_ABS_SYSTEM ); ?>',
                animation: 'rotate',
                closeAnimation: 'rotateXR',
                icon: 'fa fa-check-square-o',
                confirmButton: '<?php _e( "Yes", WL_ABS_SYSTEM ); ?>',
                cancelButton: '<?php _e( "No", WL_ABS_SYSTEM ); ?>',
                confirm: function () {
                    jQuery.ajax({
                        url: location.href,
                        type: "POST",
                        data: {
                            status: status,
                            id: id,
                            apt_client_email: apt_client_email,
                            apt_staff_email: apt_staff_email,
                            apt_client_name: apt_client_name,
                            apt_time: apt_time,
                            apt_end_time: apt_end_time,
                            apt_date: apt_date,
                            apt_service_name: apt_service_name,
                            apt_staff_name: apt_staff_name
                        },
                        dataType: "html",
                        /* Do not cache the page */
                        cache: false,
                        /* success */
                        success: function (html) {
                            jQuery.notify("<?php _e( "Mail Sent Successfully", WL_ABS_SYSTEM ); ?>", {
                                type: "success",
                                icon: "check",
                                align: "center",
                                verticalAlign: "middle",
                                color: "#3c763d",
                                background: "#dff0d8"
                            });
                        }
                    });
                },
            });
        } else {
            jQuery.notify("<?php _e( "Status Updated Successfully", WL_ABS_SYSTEM ); ?>", {
                type: "success",
                icon: "check",
                align: "center",
                verticalAlign: "middle",
                color: "#3c763d",
                background: "#dff0d8"
            });
        }
    });
</script>
<?php
//insert appointment
global $wpdb;
$email_settings = get_option( "Appoint_notification" );
$settings_table = $wpdb->prefix . "apt_settings";
$staff_table    = $wpdb->prefix . "apt_staff";

if ( isset( $_REQUEST['status'], $_REQUEST['id'] ) ) {
	$status = sanitize_text_field( $_REQUEST['status'] );
	$id     = sanitize_text_field( $_REQUEST['id'] );
	$wpdb->update(
		$wpdb->prefix . 'apt_appointments',
		array( 'status' => $status ), array( 'id' => $id ) );
	$wpdb->show_errors();
	$wpdb->print_error();
}

if ( isset( $_REQUEST['service_name'] ) && isset( $_POST['appoint_form_nonce'] ) ) {
	if ( ! wp_verify_nonce( $_POST['appoint_form_nonce'], 'appoint_form_nonce' ) ) {
		die();
	}
	$provider_name  = "1";
	$service_name   = sanitize_text_field( $_REQUEST['service_name'] );
	$start_period   = sanitize_text_field( $_REQUEST['start_period'] );
	$end_period     = sanitize_text_field( $_REQUEST['end_period'] );
	$a_customer     = sanitize_text_field( $_REQUEST['a_customer'] );
	$contact_no     = sanitize_text_field( $_REQUEST['contact_no'] );
	$status         = sanitize_text_field( $_REQUEST['status'] );
	$payment_status = sanitize_text_field( $_REQUEST['p_status'] );
	$newDate        = sanitize_text_field( $_REQUEST['ap_datepicker'] );
	$ap_datepicker  = date( "Y-m-d", strtotime( $newDate ) );
	$customer_email = sanitize_text_field( $_REQUEST['customer_email'] );
	$s_price        = sanitize_text_field( $_REQUEST['s_price'] );

	$staff_details = $wpdb->get_col( "SELECT staff_email from $staff_table where id='$provider_name'" );
	$staff_email   = $staff_details[0];

	$staff_name_details = $wpdb->get_col( "SELECT staff_member_name from $staff_table where id='$provider_name'" );
	$staff_member_name  = $staff_name_details[0];

	$settings_payment_currency = $wpdb->get_col( "SELECT currency from $settings_table" );
	$payment_currency          = $settings_payment_currency[0];

	$wpdb->insert(
		$wpdb->prefix . 'apt_appointments', array(
		'client_name'        => $a_customer,
		'staff_member'       => $provider_name,
		'service_type'       => $service_name,
		'contact'            => $contact_no,
		'booking_date'       => $ap_datepicker,
		'start_time'         => $start_period,
		'end_time'           => $end_period,
		'status'             => $status,
		'payment_status'     => $payment_status,
		'client_email'       => $customer_email,
		'staff_email'        => $staff_email,
		'appt_booked_by'     => 'by_admin',
		'repeat_appointment' => 'Non',
		're_days'            => '1',
		're_weeks'           => '1',
		're_months'          => '1',
	) );
	$wpdb->show_errors();
	$wpdb->print_error();

	$wpdb->insert(
		$wpdb->prefix . 'apt_payment', array(
		'payment_type'     => 'Cash',
		'customer'         => $a_customer,
		'customer_email'   => $customer_email,
		'staff'            => $staff_member_name,
		'appointment_date' => $ap_datepicker,
		'service'          => $service_name,
		'amount'           => $s_price . ' ' . $payment_currency,
		'status'           => $payment_status,
	) );
}

//single delete
if ( isset( $_REQUEST['appoint_id'] ) ) {
	$del = sanitize_text_field( $_REQUEST['appoint_id'] );
	$wpdb->delete( $wpdb->prefix . 'apt_appointments', array( 'id' => $del ) );
}

// multi delete
if ( isset( $_REQUEST['multi_appoint_id'] ) ) {
	echo $id_array = sanitize_text_field( $_REQUEST['multi_appoint_id'] );
	$arr = explode( ',', $id_array );
	echo $id_count = count( $arr );
	for ( $i = 0; $i <= $id_count; $i ++ ) {
		$del = $arr[ $i ];
		$wpdb->delete( $wpdb->prefix . 'apt_appointments', array( 'id' => $del ) );
		$wpdb->show_errors();
		$wpdb->print_error();
	}
}

//update appointment
if ( isset( $_REQUEST['u_service_name'] ) && isset( $_POST['update_appoint_form_nonce'] ) ) {
	if ( ! wp_verify_nonce( $_POST['update_appoint_form_nonce'], 'update_appoint_form_nonce' ) ) {
		die();
	}
	$id               = sanitize_text_field( $_REQUEST['id_appoint'] );
	$u_provider_name  = "1";
	$u_service_name   = sanitize_text_field( $_REQUEST['u_service_name'] );
	$u_start_period   = sanitize_text_field( $_REQUEST['u_start_period'] );
	$u_end_period     = sanitize_text_field( $_REQUEST['u_end_period'] );
	$u_a_customer     = sanitize_text_field( $_REQUEST['u_a_customer'] );
	$u_contact_no     = sanitize_text_field( $_REQUEST['u_contact_no'] );
	$u_status         = sanitize_text_field( $_REQUEST['u_status'] );
	$u_payment_status = sanitize_text_field( $_REQUEST['u_payment_status'] );
	$u_newDate        = sanitize_text_field( $_REQUEST['u_datepicker'] );
	$u_datepicker     = date( "Y-m-d", strtotime( $u_newDate ) );

	$wpdb->update(
		$wpdb->prefix . 'apt_appointments',
		array(
			'client_name'    => $u_a_customer,
			'staff_member'   => $u_provider_name,
			'service_type'   => $u_service_name,
			'contact'        => $u_contact_no,
			'booking_date'   => $u_datepicker,
			'start_time'     => $u_start_period,
			'end_time'       => $u_end_period,
			'status'         => $u_status,
			'payment_status' => $u_payment_status,
		),
		array(
			'id' => $id
		) );
	$wpdb->show_errors();
	$wpdb->print_error();
}

if ( isset( $_REQUEST['apt_client_email'] ) ) {
	$client_email = sanitize_text_field( $_REQUEST['apt_client_email'] );
	$staff_email  = sanitize_text_field( $_REQUEST['apt_staff_email'] );
	$status       = sanitize_text_field( $_REQUEST['status'] );

	$client_name         = sanitize_text_field( $_REQUEST['apt_client_name'] );
	$apt_start_time     = sanitize_text_field( $_REQUEST['apt_time'] );
	$ap_booking_end_time = sanitize_text_field( $_REQUEST['apt_end_time'] );
	$apt_date           = sanitize_text_field( $_REQUEST['apt_date'] );
	$service_name        = sanitize_text_field( $_REQUEST['apt_service_name'] );
	$staff_name          = sanitize_text_field( $_REQUEST['apt_staff_name'] );

	$admin_info = get_userdata( 1 );
	$first_name = $admin_info->first_name;
	$last_name  = $admin_info->last_name;
	if ( ! empty( $first_name ) && ! empty( $last_name ) ) {
		$admin_user_login = $admin_info->first_name . " " . $admin_info->last_name;
	} else {
		$admin_user_login = $admin_info->user_login;
	}

	$site_url  = get_site_url();
	$blog_name = get_bloginfo();

	$time_format        = get_option( 'time_format' );
	$temp_ap_start_time = strtotime( $apt_start_time );
	$appt_start_time    = date( $time_format, $temp_ap_start_time );


	$temp_ap_end_time = strtotime( $ap_booking_end_time );
	$appt_end_time    = date( $time_format, $temp_ap_end_time );

	$appointment_time = $appt_start_time . "-" . $appt_end_time;

	$date_format  = get_option( 'date_format' );
	$appoint_date = date( $date_format, strtotime( $apt_date ) );

	$notification_enable    = $email_settings['enable'];
	$notification_emailtype = $email_settings['emailtype'];

	if ( $notification_enable == "yes" ) {
		//PHP MAIL
		if ( $notification_emailtype == "phpmail" ) {
			$notification_admin_php_email = $email_settings['phpemail'];
			if ( $status == "pending" ) {
				$notification_client_pending = $email_settings['send_notification_client_pending'];
				if ( $notification_admin_php_email !== "" ) {
					if ( $notification_client_pending == "yes" ) {
						//CLIENT PENDING
						$temp_notification_subject_client_pending = $email_settings['subject_notification_client_pending'];
						$notification_subject_client_pending      = strtr( $temp_notification_subject_client_pending, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );

						$temp_notification_body_client_pending = $email_settings['body_notification_client_pending'];
						$notification_body_client_pending      = strtr( $temp_notification_body_client_pending, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );
						if ( $notification_subject_client_pending !== "" && $notification_body_client_pending !== "" ) {
							$to_client_email_pending   = $client_email;
							$subject_client_pending    = $notification_subject_client_pending;
							$body_client_pending       = $notification_body_client_pending;
							$from_admin_email          = $notification_admin_php_email;
							$header                    = "From: $admin_user_login <$from_admin_email>" . "\r\n";
							$mail_check_client_pending = mail( $to_client_email_pending, $subject_client_pending, $body_client_pending, $header );
						}
					}

					//ADMIN PENDING							
					$notification_admin_pending = $email_settings['send_notification_admin_pending'];
					if ( $notification_admin_pending == "yes" ) {
						$temp_notification_subject_admin_pending = $email_settings['subject_admin_pending'];
						$notification_subject_admin_pending      = strtr( $temp_notification_subject_admin_pending, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );

						$temp_notification_body_admin_pending = $email_settings['admin_body_pending'];
						$notification_body_admin_pending      = strtr( $temp_notification_body_admin_pending, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );
						if ( $notification_subject_admin_pending !== "" && $notification_body_admin_pending !== "" ) {
							$to_admin_email_pending   = $notification_admin_php_email;
							$subject_admin_pending    = $notification_subject_admin_pending;
							$body_admin_pending       = $notification_body_admin_pending;
							$from_admin_email         = $notification_admin_php_email;
							$header                   = "From: $admin_user_login <$from_admin_email>" . "\r\n";
							$mail_check_admin_pending = mail( $to_admin_email_pending, $subject_admin_pending, $body_admin_pending, $header );
						}
					}
				}
			}

			if ( $status == "approved" ) {
				$notification_client_approved = $email_settings['send_notification_client_approval'];
				if ( $notification_admin_php_email !== "" ) {
					if ( $notification_client_approved == "yes" ) {
						//CLIENT APPROVED
						$temp_notification_subject_client_approved = $email_settings['subject_notification_client_approval'];
						$notification_subject_client_approved      = strtr( $temp_notification_subject_client_approved, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );

						$temp_notification_body_client_approved = $email_settings['body_notification_client_approval'];
						$notification_body_client_approved      = strtr( $temp_notification_body_client_approved, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );
						if ( $notification_subject_client_approved !== "" && $notification_body_client_approved !== "" ) {
							$to_client_email_approved   = $client_email;
							$subject_client_approved    = $notification_subject_client_approved;
							$body_client_approved       = $notification_body_client_approved;
							$from_admin_email           = $notification_admin_php_email;
							$header                     = "From: $admin_user_login <$from_admin_email>" . "\r\n";
							$mail_check_client_approved = mail( $to_client_email_approved, $subject_client_approved, $body_client_approved, $header );
						}
					}

					//ADMIN APPROVED
					$notification_admin_approved = $email_settings['send_notification_admin_approved'];
					if ( $notification_admin_approved == "yes" ) {
						$temp_notification_subject_admin_approved = $email_settings['subject_admin_approved'];
						$notification_subject_admin_approved      = strtr( $temp_notification_subject_admin_approved, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );

						$temp_notification_body_admin_approved = $email_settings['admin_body_approved'];
						$notification_body_admin_approved      = strtr( $temp_notification_body_admin_approved, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );
						if ( $notification_subject_admin_approved !== "" && $notification_body_admin_approved !== "" ) {
							$to_admin_email_approved   = $notification_admin_php_email;
							$subject_admin_approved    = $notification_subject_admin_approved;
							$body_admin_pending        = $notification_body_admin_approved;
							$from_admin_email          = $notification_admin_php_email;
							$header                    = "From: $admin_user_login <$from_admin_email>" . "\r\n";
							$mail_check_admin_approved = mail( $to_admin_email_approved, $subject_admin_approved, $body_admin_pending, $header );
						}
					}
				}
			}

			if ( $status == "cancel" ) {
				$notification_client_cancel = $email_settings['send_notification_client_cancel'];
				if ( $notification_admin_php_email !== "" ) {
					if ( $notification_client_cancel == "yes" ) {
						//CLIENT CANCEL
						$temp_notification_subject_client_cancel = $email_settings['subject_notification_client_cancel'];
						$notification_subject_client_cancel      = strtr( $temp_notification_subject_client_cancel, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );

						$temp_notification_body_client_cancel = $email_settings['body_notification_client_cancel'];
						$notification_body_client_cancel      = strtr( $temp_notification_body_client_cancel, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );
						if ( $notification_subject_client_cancel !== "" && $notification_body_client_cancel !== "" ) {
							$to_client_email_cancel   = $client_email;
							$subject_client_cancel    = $notification_subject_client_cancel;
							$body_client_cancel       = $notification_body_client_cancel;
							$from_admin_email         = $notification_admin_php_email;
							$header                   = "From: $admin_user_login <$from_admin_email>" . "\r\n";
							$mail_check_client_cancel = mail( $to_client_email_cancel, $subject_client_cancel, $body_client_cancel, $header );
						}
					}

					//ADMIN CANCEL
					$notification_admin_cancelled = $email_settings['send_notification_admin_cancelled'];
					if ( $notification_admin_cancelled == "yes" ) {
						$temp_notification_subject_admin_cancel = $email_settings['subject_admin_cancelled'];
						$notification_subject_admin_cancelled   = strtr( $temp_notification_subject_admin_cancel, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );

						$temp_notification_body_admin_cancel = $email_settings['admin_body_cancelled'];
						$notification_body_admin_cancelled   = strtr( $temp_notification_body_admin_cancel, array(
							'[SERVICE_NAME]'       => $service_name,
							'[APPOINTMENT_DATE]'   => $appoint_date,
							'[APPOINTMENT_TIME]'   => $appointment_time,
							'[CLIENT_NAME]'        => $client_name,
							'[CLIENT_EMAIL]'       => $client_email,
							'[BLOG_NAME]'          => $blog_name,
							'[ADMIN_NAME]'         => $admin_user_login,
							'[APPOINTMENT_STATUS]' => $status,
							'[SITE_URL]'           => $site_url
						) );
						if ( $notification_subject_admin_cancelled !== "" && $notification_body_admin_cancelled !== "" ) {
							$to_admin_email_cancel   = $notification_admin_php_email;
							$subject_admin_cancel    = $notification_subject_admin_cancelled;
							$body_admin_cancel       = $notification_body_admin_cancelled;
							$from_admin_email        = $notification_admin_php_email;
							$header                  = "From: $admin_user_login <$from_admin_email>" . "\r\n";
							$mail_check_admin_cancel = mail( $to_admin_email_cancel, $subject_admin_cancel, $body_admin_cancel, $header );
						}
					}
				}
			}
		}
	}
}

$appointment_staff_details   = $wpdb->get_results( "SELECT * from $wpdb->prefix" . "apt_staff" );
$appointment_service_details = $wpdb->get_results( "SELECT * from $wpdb->prefix" . "apt_services" );
$appointment_client_details  = $wpdb->get_results( "SELECT * from $wpdb->prefix" . "apt_clients" );
?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-thumb-tack"></i><span
                class="panel_heading"><?php _e( "Appointments", WL_ABS_SYSTEM ); ?></span>
        <div class="theme-export">
            <form method="post" class="follow">
				<?php wp_nonce_field( 'appointment_list_file_nonce', 'appointment_list_file_nonce' ); ?>
                <input type="hidden" name="appointment_list_file" value="appointment_list_file"/>
				<?php submit_button( __( 'Download All' ), 'secondary', 'submit_appointment_list', false ); ?>
            </form>
        </div>
        <div class="theme-new-customer">
            <button type="button" class="btn theme-customer" data-toggle="modal" data-target="#appoint"><i
                        class="fa fa-plus" aria-hidden="true"></i><?php _e( " New Appointment", WL_ABS_SYSTEM ); ?>
            </button>
            <div class="modal fade" id="appoint" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?php _e( "New Appointment", WL_ABS_SYSTEM ); ?> </h4>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
                            <div class="form-group">
                                <form action="" method="post" id="appoint_form">
									<?php wp_nonce_field( 'appoint_form_nonce', 'appoint_form_nonce' ); ?>
                                    <div class="row cus-reg" id="appoint_service">
                                        <label><?php _e( "Service Name:", WL_ABS_SYSTEM ); ?>  </label>
                                        <select class="a-services form-control" name="service_name" id="service_name">
                                            <option value="0" class=""
                                                    selected="selected"><?php _e( "-- Select a service --", WL_ABS_SYSTEM ); ?> </option>
											<?php foreach ( $appointment_category_details as $appointment_category_single_detail ) { ?>
                                                <optgroup
                                                        label="<?php echo $appointment_category_single_detail->name; ?>">
													<?php $service_table = $wpdb->prefix . "apt_services";
													$appointment_details = $wpdb->get_results( "SELECT * from $service_table where category= '$appointment_category_single_detail->id'" );
													foreach ( $appointment_details as $appointment_single_detail ) { ?>
                                                        <option title="<?php echo $appointment_single_detail->price ?>"
                                                                value="<?php echo $appointment_single_detail->name ?>"><?php echo $appointment_single_detail->name ?></option>
													<?php } ?>

                                                </optgroup>
											<?php } ?>
                                        </select>
                                        <input type="hidden" class="form-control" name="s_price" id="s_price"/>
                                        <span class="validation_alert"
                                              id="service_name_alert"><?php _e( "Please select one", WL_ABS_SYSTEM ); ?></span>
                                    </div>
                                    <div class="row cus-reg">
                                        <label><?php _e( "Date:", WL_ABS_SYSTEM ); ?>  </label>
                                        <input type="text" class="col-md-12 a_date" id="ap_datepicker"
                                               name="ap_datepicker">
                                        <span class="validation_alert"
                                              id="ap_datepicker_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                    </div>
                                    <div class="row cus-reg">
                                        <label> <?php _e( "Start Time:", WL_ABS_SYSTEM ); ?>  </label>
                                        <div class="col-md-12 input-group clockpicker off_use_time"
                                             data-placement="left" data-align="top" data-autoclose="true">
                                            <input required="required" type="text" name="start_period" id="start_period"
                                                   class="field form-control" placeholder="Time">
                                        </div>
                                        <span class="validation_alert"
                                              id="start_period_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                        <label> <?php _e( "End Time:", WL_ABS_SYSTEM ); ?>  </label>
                                        <div class="col-md-12 input-group clockpicker off_use_time"
                                             data-placement="left" data-align="top" data-autoclose="true">
                                            <input required="required" type="text" name="end_period" id="end_period"
                                                   class="field form-control" placeholder="Time">
                                        </div>
                                        <span class="validation_alert"
                                              id="end_period_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                    </div>
                                    <div class="row cus-reg" id="appoint_customer">
                                        <label><?php _e( "Customer:", WL_ABS_SYSTEM ); ?>  </label>
                                        <select name="a_customer" id="a_customer" class="form-control">
                                            <option value="0"> <?php _e( "Select Customer", WL_ABS_SYSTEM ); ?> </option>
											<?php foreach ( $appointment_client_details as $appointment_client_single_detail ) { ?>
                                                <option title="<?php echo $appointment_client_single_detail->email; ?>"
                                                        value="<?php echo $appointment_client_single_detail->first_name; ?> <?php echo $appointment_client_single_detail->last_name; ?>"><?php echo $appointment_client_single_detail->first_name; ?><?php echo $appointment_client_single_detail->last_name; ?></option>
											<?php } ?>
                                        </select>
                                        <input type="hidden" class="form-control" name="customer_email"
                                               id="customer_email"/>
                                        <span class="validation_alert"
                                              id="a_customer_alert"><?php _e( "Please select/create one", WL_ABS_SYSTEM ); ?></span>
                                    </div>
                                    <div class="row cus-reg">
                                        <label> <?php _e( "Contact No.:", WL_ABS_SYSTEM ); ?>  </label>
                                        <input type="tel" name="contact_no" id="contact_no" class="form-control phone">
                                        <span class="validation_alert"
                                              id="contact_no_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                        <span class="validation_alert"
                                              id="number_contact_alert"><?php _e( "This field is required number", WL_ABS_SYSTEM ); ?></span>
                                    </div>
                                    <div class="row cus-reg">
                                        <label> <?php _e( "Status:", WL_ABS_SYSTEM ); ?>  </label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="0"><?php _e( "--- Select Status ---", WL_ABS_SYSTEM ); ?> </option>
                                            <option value="approved"><?php _e( "Approved", WL_ABS_SYSTEM ); ?> </option>
                                            <option value="pending"><?php _e( "Pending", WL_ABS_SYSTEM ); ?> </option>
                                            <option value="cancel"><?php _e( "Cancel", WL_ABS_SYSTEM ); ?> </option>
                                            <option value="completed"><?php _e( "Completed", WL_ABS_SYSTEM ); ?> </option>
                                        </select>
                                        <span class="validation_alert"
                                              id="status_alert"><?php _e( "Please select one", WL_ABS_SYSTEM ); ?></span>
                                    </div>
                                    <div style="display: none;" class="row cus-reg">
                                        <label> <?php _e( "Payment Status:", WL_ABS_SYSTEM ); ?>  </label>
                                        <select name="p_status" id="p_status" class="form-control">
                                            <option value="approved"><?php _e( "Approved", WL_ABS_SYSTEM ); ?> </option>
                                            <option value="pending"><?php _e( "Pending", WL_ABS_SYSTEM ); ?> </option>
                                        </select>
                                        <span class="validation_alert"
                                              id="p_status_alert"><?php _e( "Please select one", WL_ABS_SYSTEM ); ?></span>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" id='save_appointment_details'
                                    onclick="return save_appointment();"><?php _e( "Save", WL_ABS_SYSTEM ); ?> </button>
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal"><?php _e( "Cancel", WL_ABS_SYSTEM ); ?> </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="update_appoin_model" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?php _e( "Edit Appointment", WL_ABS_SYSTEM ); ?> </h4>
                        </div>
                        <div id="fetch_appoint_model">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="mydiv" class="table-responsive">
        <form method="post" id="multi_del_appointment" name="multi_del">
            <table id="appointment_example" class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th style="padding: 10px 12px;" class="nosort"><input type="checkbox" name="select_appointment"
                                                                          id="select_appointment" value=""></th>
                    <th class="sh_ow"><?php _e( "Booking Id", WL_ABS_SYSTEM ); ?> </th>
                    <th><?php _e( "Appoinment Date", WL_ABS_SYSTEM ); ?> </th>
                    <th><?php _e( "Customer Name", WL_ABS_SYSTEM ); ?> </th>
                    <th><?php _e( "Service", WL_ABS_SYSTEM ); ?> </th>
                    <th><?php _e( "Status", WL_ABS_SYSTEM ); ?> </th>
                    <th><?php _e( "Contact No", WL_ABS_SYSTEM ); ?> </th>
                    <th class="nosort"><?php _e( "Action", WL_ABS_SYSTEM ); ?> </th>
                </tr>
                </thead>
            </table>
            <a href="#" class="appoint_delete btn btn-link"><i class="fa fa-trash-o"
                                                               aria-hidden="true"></i><?php _e( " Delete", WL_ABS_SYSTEM ); ?>
            </a></td>
        </form>
    </div>
</div>
<script>
    var dateToday = new Date();
    jQuery(function () {
        jQuery(".a_date").datepicker({
            minDate: dateToday,
            //beforeShowDay: DisableSpecificDates
        });
    });
</script>