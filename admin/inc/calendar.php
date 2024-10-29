<?php
defined( 'ABSPATH' ) or die();
?>
<script>
    //SAVE APPOINTMENT
    jQuery(document).ajaxComplete(function () {
        jQuery('#client_email').val('default');
        jQuery('#client_name').change(function () {
            jQuery('#client_email').val(jQuery(this).find("option:selected").attr("title"));
        });
    });
    jQuery(document).ajaxComplete(function () {
        jQuery('#service_price').val('');
        jQuery('#service_type').change(function () {
            jQuery('#service_price').val(jQuery(this).find("option:selected").attr("title"));
        });
    });

    function save_form() {
        if (jQuery("#client_name").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#cal_customer_alert").show();
            jQuery("#client_name").focus();
            return false;
        }

        if (jQuery("#staff_member").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#cal_staff_alert").show();
            jQuery("#staff_member").focus();
            return false;
        }

        if (jQuery("#service_type").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#cal_service_alert").show();
            jQuery("#service_type").focus();
            return false;
        }

        if (jQuery("#start_time_cal").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#cal_start_time_alert").show();
            return false;
        }

        if (jQuery("#end_time_calendar").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#cal_end_time_alert").show();
            return false;
        }

        if (jQuery("#appointment_status").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#cal_status_alert").show();
            jQuery("#appointment_status").focus();
            return false;
        }

        jQuery("#save_cal_details").prop('disabled', true);
        jQuery('#save_cal_details').html('<i class="fa fa-spinner fa-spin"></i> <?php _e( "Saving", WL_ABS_SYSTEM ); ?>');

        jQuery.ajax({
            url: location.href,
            type: "POST",
            data: jQuery("form#admin_book_appointment").serialize(),
            dataType: "html",
            /* Do not cache the page */
            cache: false,
            /* success */
            success: function (html) {
                jQuery("#save_cal_details").prop('disabled', false);
                jQuery('#save_cal_details').html('<?php _e( "Save", WL_ABS_SYSTEM ); ?>');
                jQuery(".validation_alert").hide();
                jQuery('div#fullCalModal').modal('hide');
                jQuery('form#admin_book_appointment')[0].reset();
                jQuery.notify("<?php _e( "Appointment Booked Successfully", WL_ABS_SYSTEM ); ?>", {
                    type: "success",
                    icon: "check",
                    align: "center",
                    verticalAlign: "middle",
                    color: "#3c763d",
                    background: "#dff0d8"
                });
                jQuery('#bootstrapModalFullCalendar').fullCalendar('rerenderEvents');
                jQuery('#bootstrapModalFullCalendar').fullCalendar('refetchEvents');
                jQuery("#client_filter").load(location.href + " #client_filter");
                jQuery("#staff_filter").load(location.href + " #staff_filter");
                jQuery("#date_filter").load(location.href + " #date_filter");
                jQuery("#service_filter").load(location.href + " #service_filter");
                jQuery("#booking_date").prop("disabled", false);
                hideAll();
            }
        });
    }

    /* UPDATE APPOINTMENT */
    function update_cal_appointment() {
        if (jQuery("#edit_client_name").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#edit_cal_customer_alert").show();
            jQuery("#edit_client_name").focus();
            return false;
        }

        if (jQuery("#edit_staff_member").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#edit_cal_staff_alert").show();
            jQuery("#edit_staff_member").focus();
            return false;
        }

        if (jQuery("#edit_service_type").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#edit_cal_service_alert").show();
            jQuery("#edit_service_type").focus();
            return false;
        }

        if (jQuery("#edit_booking_date").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#edit_booking_date_alert").show();
            return false;
        }

        if (jQuery("#edit_start_time").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#edit_cal_start_time_alert").show();
            return false;
        }

        if (jQuery("#edit_end_time").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#edit_cal_end_time_alert").show();
            return false;
        }

        if (jQuery("#edit_status").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#edit_cal_status_alert").show();
            return false;
        }

        jQuery("#update_cal_details").prop('disabled', true);
        jQuery('#update_cal_details').html('<i class="fa fa-spinner fa-spin"></i> Updating');
        jQuery.ajax({
            url: location.href,
            type: "POST",
            data: jQuery("form#admin_edit_appointment").serialize(),
            dataType: "html",
            /* Do not cache the page */
            cache: false,
            /* success */
            success: function (html) {
                jQuery("#update_cal_details").prop('disabled', false);
                jQuery('#update_cal_details').html('Update');
                jQuery('div#eventCalModal').modal('hide');
                jQuery.notify("<?php _e( "Appointment Updated Successfully", WL_ABS_SYSTEM ); ?>", {
                    type: "success",
                    icon: "check",
                    align: "center",
                    verticalAlign: "middle",
                    color: "#3c763d",
                    background: "#dff0d8"
                });
                jQuery('#bootstrapModalFullCalendar').fullCalendar('rerenderEvents');
                jQuery('#bootstrapModalFullCalendar').fullCalendar('refetchEvents');
                jQuery("#client_filter").load(location.href + " #client_filter");
                jQuery("#staff_filter").load(location.href + " #staff_filter");
                jQuery("#date_filter").load(location.href + " #date_filter");
                jQuery("#service_filter").load(location.href + " #service_filter");
                jQuery("#booking_date").prop("disabled", false);
            }
        });
    }

    jQuery(document).ready(function () {
        jQuery('.clockpicker').clockpicker();
    });

    /*  hide all */
    function hideAll() {
        jQuery('.Nclr').css('color', '#FE0000');
        jQuery('.Dclr').css('color', '#000000');
        jQuery('.Wclr').css('color', '#000000');
        jQuery('.Mclr').css('color', '#000000');
        jQuery('.PDclr').css('color', '#000000');

        jQuery('.dailydiv').hide();
        jQuery('.weeklydiv').hide();
        jQuery('.monthlydiv').hide();
        jQuery('.PDdiv').hide();
        jQuery("#booking_date").prop("disabled", false);
    }

    /* show daily div */
    function showdaily() {
        jQuery('.Nclr').css('color', '#000000');
        jQuery('.Dclr').css('color', '#FE0000');
        jQuery('.Wclr').css('color', '#000000');
        jQuery('.Mclr').css('color', '#000000');
        jQuery('.PDclr').css('color', '#000000');

        jQuery('.dailydiv').show();
        jQuery('.weeklydiv').hide();
        jQuery('.monthlydiv').hide();
        jQuery('.PDdiv').hide();
        jQuery("#booking_date").prop("disabled", false);
    }

    /* show weekly div */
    function showweekly() {
        jQuery('.Nclr').css('color', '#000000');
        jQuery('.Dclr').css('color', '#000000');
        jQuery('.Wclr').css('color', '#FE0000');
        jQuery('.Mclr').css('color', '#000000');
        jQuery('.PDclr').css('color', '#000000');
        jQuery('.dailydiv').hide();

        jQuery('.weeklydiv').show();
        jQuery('.monthlydiv').hide();
        jQuery('.PDdiv').hide();
        jQuery("#booking_date").prop("disabled", false);
    }

    /* show month div */
    function showmonthly() {
        jQuery('.Nclr').css('color', '#000000');
        jQuery('.Dclr').css('color', '#000000');
        jQuery('.Wclr').css('color', '#000000');
        jQuery('.Mclr').css('color', '#FE0000');
        jQuery('.PDclr').css('color', '#000000');

        jQuery('.dailydiv').hide();
        jQuery('.weeklydiv').hide();
        jQuery('.monthlydiv').show();
        jQuery('.PDdiv').hide();
        jQuery("#booking_date").prop("disabled", false);
    }

    function showParticularDate() {
        jQuery('.Nclr').css('color', '#000000');
        jQuery('.Dclr').css('color', '#000000');
        jQuery('.Wclr').css('color', '#000000');
        jQuery('.Mclr').css('color', '#000000');
        jQuery('.PDclr').css('color', '#FE0000');

        jQuery('.dailydiv').hide();
        jQuery('.weeklydiv').hide();
        jQuery('.monthlydiv').hide()
        jQuery('.PDdiv').show();
        jQuery("#booking_date").prop("disabled", true);
    }
</script>

<?php
global $wpdb;
$staff_table    = $wpdb->prefix . "apt_staff";
$settings_table = $wpdb->prefix . "apt_settings";
if ( isset( $_REQUEST['client_name'] ) && isset( $_POST['calendar_file_nonce'] ) ) {
	if ( ! wp_verify_nonce( $_POST['calendar_file_nonce'], 'calendar_file_nonce' ) ) {
		die();
	}
	$client_name  = sanitize_text_field( $_REQUEST['client_name'] );
	$staff_member = "1";
	$service_type = sanitize_text_field( $_REQUEST['service_type'] );
	$contact      = sanitize_text_field( $_REQUEST['contact'] );
	if ( isset( $_REQUEST['booking_date'] ) ) {
		$newDate = sanitize_text_field( $_REQUEST['booking_date'] );
		echo $booking_date = date( "Y-m-d", strtotime( $newDate ) );
	} else {
		echo $booking_date = " ";
	}
	$start_time         = sanitize_text_field( $_REQUEST['start_time'] );
	$end_time           = sanitize_text_field( $_REQUEST['end_time'] );
	$client_email       = sanitize_text_field( $_REQUEST['client_email'] );
	$appointment_status = sanitize_text_field( $_REQUEST['appointment_status'] );
	$payment_status     = sanitize_text_field( $_REQUEST['payment_status'] );

	$repeat        = "Non";
	$re_days       = "1";
	$re_weeks      = "1";
	$re_months     = "1";
	$re_start_date = " ";
	$re_end_date   = " ";

	$service_price = sanitize_text_field( $_REQUEST['service_price'] );

	$staff_email_details = $wpdb->get_col( "SELECT staff_email from $staff_table where id='$staff_member'" );
	$staff_email         = $staff_email_details[0];

	$staff_name_details = $wpdb->get_col( "SELECT staff_member_name from $staff_table where id='$staff_member'" );
	$staff_member_name  = $staff_name_details[0];

	$settings_payment_currency = $wpdb->get_col( "SELECT currency from $settings_table" );
	$payment_currency          = $settings_payment_currency[0];

	$wpdb->insert(
		$wpdb->prefix . 'apt_appointments', array(
		'client_name'    => $client_name,
		'staff_member'   => $staff_member,
		'service_type'   => $service_type,
		'contact'        => $contact,
		'booking_date'   => $booking_date,
		'start_time'     => $start_time,
		'end_time'       => $end_time,
		'status'         => $appointment_status,
		'payment_status' => $payment_status,
		'client_email'   => $client_email,

		'repeat_appointment' => $repeat,
		're_days'            => $re_days,
		're_weeks'           => $re_weeks,
		're_months'          => $re_months,
		're_start_date'      => $re_start_date,
		're_end_date'        => $re_end_date,
		'staff_email'        => $staff_email,
		'appt_booked_by'     => 'by_admin',
	) );

	$wpdb->insert(
		$wpdb->prefix . 'apt_payment', array(
		'payment_type'     => 'Cash',
		'customer'         => $client_name,
		'customer_email'   => $client_email,
		'staff'            => $staff_member_name,
		'appointment_date' => $booking_date,
		'service'          => $service_type,
		'amount'           => $service_price . ' ' . $payment_currency,
		'status'           => $payment_status,
	) );
}

if ( isset( $_REQUEST['staff_id'] ) ) {
	$staff_id = sanitize_text_field( $_REQUEST['staff_id'] );
	$wpdb->update( $wpdb->prefix . 'apt_appointments',
		array( 'staff_id' => $staff_id, ),
		array( 'staff_member' => $staff_id )
	);
}

if ( isset( $_REQUEST['staff_service'] ) ) {
	$staff_service = sanitize_text_field( $_REQUEST['staff_service'] );
	$wpdb->update( $wpdb->prefix . 'apt_settings', array( 'staff_service' => $staff_service, ), array( 'id' => 1 ) );
}

if ( isset( $_REQUEST['staff_id'] ) ) {
	$staff_id = sanitize_text_field( $_REQUEST['staff_id'] );
	$wpdb->update( $wpdb->prefix . 'apt_settings', array( 'staff_id' => $staff_id, ), array( 'id' => 1 ) );
}

if ( isset( $_REQUEST['staff_date'] ) ) {
	$staff_date = sanitize_text_field( $_REQUEST['staff_date'] );
	$wpdb->update( $wpdb->prefix . 'apt_settings', array( 'staff_date' => $staff_date, ), array( 'id' => 1 ) );
}

if ( isset( $_REQUEST['delete_id'] ) ) {
	$del = sanitize_text_field( $_REQUEST['delete_id'] );
	$wpdb->delete( $wpdb->prefix . 'apt_appointments', array( 'id' => $del ) );
}

if ( isset( $_REQUEST['edit_client_id'] ) ) {
	$edit_client_id    = sanitize_text_field( $_REQUEST['edit_client_id'] );
	$edit_client_name  = sanitize_text_field( $_REQUEST['edit_client_name'] );
	$edit_staff_member = sanitize_text_field( $_REQUEST['edit_staff_member'] );
	$edit_service_type = sanitize_text_field( $_REQUEST['edit_service_type'] );
	$edit_contact      = sanitize_text_field( $_REQUEST['edit_contact'] );

	if ( isset( $_REQUEST['edit_booking_date'] ) ) {
		$newDate = sanitize_text_field( $_REQUEST['edit_booking_date'] );
		echo $edit_booking_date = date( "Y-m-d", strtotime( $newDate ) );
	} else {
		echo $edit_booking_date = " ";
	}
	$edit_start_time         = sanitize_text_field( $_REQUEST['edit_start_time'] );
	$edit_end_time           = sanitize_text_field( $_REQUEST['edit_end_time'] );
	$edit_appointment_status = sanitize_text_field( $_REQUEST['edit_status'] );
	$edit_payment_status     = sanitize_text_field( $_REQUEST['edit_payment_status'] );

	$repeat_cl        = "Non";
	$re_days_cl       = "1";
	$re_weeks_cl      = "1";
	$re_months_cl     = "1";
	$re_start_date_cl = " ";
	$re_end_date_cl   = " ";

	$staff_details    = $wpdb->get_col( "SELECT staff_email from $staff_table where id='$edit_staff_member'" );
	$edit_staff_email = $staff_details[0];

	$wpdb->update( $wpdb->prefix . 'apt_appointments',
		array(
			'client_name'    => $edit_client_name,
			'staff_member'   => $edit_staff_member,
			'service_type'   => $edit_service_type,
			'contact'        => $edit_contact,
			'booking_date'   => $edit_booking_date,
			'start_time'     => $edit_start_time,
			'end_time'       => $edit_end_time,
			'status'         => $edit_appointment_status,
			'payment_status' => $edit_payment_status,

			'repeat_appointment' => $repeat_cl,
			're_days'            => $re_days_cl,
			're_weeks'           => $re_weeks_cl,
			're_months'          => $re_months_cl,
			're_start_date'      => $re_start_date_cl,
			'staff_email'        => $edit_staff_email,
			're_end_date'        => $re_end_date_cl,
		),
		array( 'id' => $edit_client_id )
	);
}

$appointment_service_details       = $wpdb->get_results( "SELECT * from $wpdb->prefix" . "apt_services" );
$appointment_setting_details       = $wpdb->get_results( "SELECT * from $wpdb->prefix" . "apt_settings" );
$appointment_calender_details      = $wpdb->get_col( "SELECT client_name from $wpdb->prefix" . "apt_appointments" );
$appointment_calender_details      = array_unique( $appointment_calender_details );
$appointment_calender_details_date = $wpdb->get_col( "SELECT booking_date from $wpdb->prefix" . "apt_appointments" );
$appointment_calender_details_date = array_unique( $appointment_calender_details_date );
$appointment_calender_staff_member = $wpdb->get_col( "SELECT staff_member from $wpdb->prefix" . "apt_appointments" );
$appointment_calender_staff_member = array_unique( $appointment_calender_staff_member );
$appointment_calender_service      = $wpdb->get_col( "SELECT service_type from $wpdb->prefix" . "apt_appointments" );
$appointment_calender_service      = array_unique( $appointment_calender_service );
$appointment_category_details      = $wpdb->get_results( "SELECT * from $wpdb->prefix" . "apt_category" );
$appointment_customer_details      = $wpdb->get_results( "SELECT * from $wpdb->prefix" . "apt_clients" );
$appointment_staff_details         = $wpdb->get_results( "select * from $wpdb->prefix" . "apt_staff" );


$appearence_cal_font_style = $wpdb->get_row( "SELECT * from  $wpdb->prefix" . "apt_settings" );
$cal_font_style            = $appearence_cal_font_style->cal_font_style;
$cal_theme_style           = $appearence_cal_font_style->cal_theme_style;
$cal_date_format           = $appearence_cal_font_style->cal_date_format;
$cal_time_format           = $appearence_cal_font_style->cal_time_format;
$cal_view                  = $appearence_cal_font_style->cal_view;
$cal_first_day             = $appearence_cal_font_style->cal_first_day;
$cal_pending_color         = $appearence_cal_font_style->cal_pending_color;
$cal_approved_color        = $appearence_cal_font_style->cal_approved_color;
$cal_off_time_color        = $appearence_cal_font_style->cal_off_time_color;
$cal_font_style            = $appearence_cal_font_style->cal_font_style;

$cal_pending_color   = $appearence_cal_font_style->cal_pending_color;
$cal_approved_color  = $appearence_cal_font_style->cal_approved_color;
$cal_cancelled_color = $appearence_cal_font_style->cal_cancelled_color;
$cal_completed_color = $appearence_cal_font_style->cal_completed_color;
$cal_off_time_color  = $appearence_cal_font_style->cal_off_time_color;

$ap_holiday_fecthes = $wpdb->get_results( "select * from $wpdb->prefix" . "apt_holidays" );
?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-calendar"></i><span
                class="panel_heading"><?php _e( 'Calendar', WL_ABS_SYSTEM ) ?></span></div>
    <div class="panel-body">
        <div class="show_color">
            <span class="color_span"
                  style="background-color: <?php echo $cal_pending_color ?>;"><?php _e( 'Pending', WL_ABS_SYSTEM ) ?></span>
            <span class="color_span"
                  style="background-color: <?php echo $cal_approved_color ?>;"><?php _e( 'Approved', WL_ABS_SYSTEM ) ?></span>
            <span class="color_span"
                  style="background-color: <?php echo $cal_cancelled_color ?>;"><?php _e( 'Cancelled', WL_ABS_SYSTEM ) ?></span>
            <span class="color_span"
                  style="background-color: <?php echo $cal_completed_color ?>;"><?php _e( 'Completed', WL_ABS_SYSTEM ) ?></span>
            <span class="color_span"
                  style="background-color: <?php echo $cal_off_time_color ?>;"><?php _e( 'Time Off', WL_ABS_SYSTEM ) ?></span>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 row">
            <div class="theme-employee-filter">
                <div>
                    <label><?php _e( 'Customer', WL_ABS_SYSTEM ); ?></label>
                </div>
                <div id="client_filter">
                    <select id="client_selecter" class="field form-control">
                        <option value='all'><?php _e( 'All', WL_ABS_SYSTEM ) ?></option>
						<?php foreach ( $appointment_calender_details as $appointment_customer_single_detail ) { ?>
                            <option value="<?php echo $appointment_customer_single_detail; ?>"><?php echo $appointment_customer_single_detail; ?></option>
						<?php } ?>
                    </select>
                </div>
            </div>

            <div class="theme-employee-filter">
                <div>
                    <label><?php _e( 'Service', WL_ABS_SYSTEM ) ?></label>
                </div>
                <div id="service_filter">
                    <select class="form-control" id="service_selecter">
                        <option value='all'><?php _e( 'All', WL_ABS_SYSTEM ) ?></option>
						<?php foreach ( $appointment_calender_service as $appointment_calender_services ) { ?>
                            <option value="<?php echo $appointment_calender_services ?>"><?php echo $appointment_calender_services; ?></option>
						<?php } ?>
                    </select>
                </div>
            </div>

            <div class="theme-employee-filter">
                <div>
                    <label><?php _e( 'Status', WL_ABS_SYSTEM ) ?></label>
                </div>
                <select id="status_selecter" class="form-control">
                    <option value="all"><?php _e( 'All', WL_ABS_SYSTEM ); ?></option>
                    <option value="cancelled"><?php _e( 'Approved', WL_ABS_SYSTEM ); ?></option>
                    <option value="pending"><?php _e( 'Pending', WL_ABS_SYSTEM ); ?></option>
                    <option value="cancelled"><?php _e( 'Cancelled', WL_ABS_SYSTEM ); ?></option>
                    <option value="completed"><?php _e( 'Completed', WL_ABS_SYSTEM ); ?></option>
                </select>
            </div>
        </div>
        <div id="bootstrapModalFullCalendar"></div>
    </div>
</div>

<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <form style="margin-bottom: 0;" action="" method="POST" id="admin_book_appointment"
              name="admin_book_appointment">
			<?php wp_nonce_field( 'calendar_file_nonce', 'calendar_file_nonce' ); ?>
            <div class="modal-content" id="fullCalModal_content">
                <div class="modal-header">
                    <h4 id="modalTitle" class="modal-title"><?php _e( 'Book an Appointment', WL_ABS_SYSTEM ) ?></h4>
                </div>
                <div id="modalBody" class="modal-body">
                    <div class="modal-body">
                        <div class="row" style="padding: 0 15px;">
                            <div class="row ad-ser">
                                <div class="col-md-12">
                                    <label for="client_name"><?php _e( 'Customer Name', WL_ABS_SYSTEM ) ?></label>
                                    <div id="calendar_cust">
                                        <select id="client_name" class="field form-control" name="client_name">
                                            <option value="0"><?php _e( 'Select Customer', WL_ABS_SYSTEM ) ?></option>
											<?php foreach ( $appointment_customer_details as $appointment_client_single_detail ) { ?>
                                                <option title="<?php echo $appointment_client_single_detail->email; ?>"
                                                        value="<?php echo $appointment_client_single_detail->first_name; ?> <?php echo $appointment_client_single_detail->last_name; ?>"><?php echo $appointment_client_single_detail->first_name; ?><?php echo $appointment_client_single_detail->last_name; ?></option>
											<?php } ?>
                                        </select>
                                        <input type="hidden" class="form-control" name="client_email"
                                               id="client_email"/>
                                        <span class="validation_alert"
                                              id="cal_customer_alert"><?php _e( "Please select/create one", WL_ABS_SYSTEM ); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row ad-ser">
                                <div class="col-md-6" id="calendar_ser_vice">
                                    <label for="service_type"><?php _e( 'Service', WL_ABS_SYSTEM ) ?></label>
                                    <select id="service_type" class="field form-control" name="service_type">
                                        <option value="0"><?php _e( 'Select Service', WL_ABS_SYSTEM ) ?></option>
										<?php foreach ( $appointment_category_details as $appointment_category_single_detail ) { ?>
                                            <optgroup label="<?php echo $appointment_category_single_detail->name; ?>">
												<?php $service_table = $wpdb->prefix . "apt_services";
												$appointment_details = $wpdb->get_results( "SELECT * from $service_table where category= '$appointment_category_single_detail->id'" );
												foreach ( $appointment_details as $appointment_single_detail ) { ?>
                                                    <option title="<?php echo $appointment_single_detail->price ?>"
                                                            value="<?php echo $appointment_single_detail->name ?>"><?php echo $appointment_single_detail->name ?></option>
												<?php } ?>
                                            </optgroup>
										<?php } ?>
                                    </select>
                                    <input type="hidden" class="form-control" name="service_price" id="service_price"/>
                                    <span class="validation_alert"
                                          id="cal_service_alert"><?php _e( "Please select one", WL_ABS_SYSTEM ); ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="contact"><?php _e( 'Contact No.', WL_ABS_SYSTEM ) ?></label>
                                    <input id="contact" name="contact" class="phone field form-control" type="tel"
                                           style="width:100%"/>
                                    <span class="validation_alert"
                                          id="cal_contact_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                </div>
                            </div>

                            <div class="row ad-ser">
                                <div class="col-md-6">
                                    <label for="booking_date"><?php _e( 'Date', WL_ABS_SYSTEM ) ?></label>
                                    <input id="booking_date" name="booking_date" class="field form-control" type="text"
                                           style="width:100%"/>
                                    <span class="validation_alert"
                                          id="cal_booking_date_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="start_time"><?php _e( 'Select Start Time', WL_ABS_SYSTEM ) ?></label>
                                    <div class="input-group clockpicker" data-placement="left" data-align="top"
                                         data-autoclose="true">
                                        <input type="text" name="start_time" id="start_time_cal"
                                               class="field form-control"
                                               placeholder="Time">
                                    </div>
                                    <span class="validation_alert"
                                          id="cal_start_time_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                </div>
                            </div>
                            <div class="row ad-ser">
                                <div class="col-md-6">
                                    <label for="end_time_calendar"><?php _e( 'Select End Time', WL_ABS_SYSTEM ) ?></label>
                                    <div class="input-group clockpicker" data-placement="left" data-align="top"
                                         data-autoclose="true">
                                        <input type="text" name="end_time" id="end_time_calendar"
                                               class="field form-control"
                                               placeholder="Time">
                                    </div>
                                    <span class="validation_alert"
                                          id="cal_end_time_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="appointment_status"><?php _e( 'Appointment Status', WL_ABS_SYSTEM ) ?></label>
                                    <select id="appointment_status" class="field form-control"
                                            name="appointment_status">
                                        <option value="0"><?php _e( 'Select Status', 'WL_ABS_SYSTEM ' ) ?></option>
                                        <option value="pending"><?php _e( 'Pending', WL_ABS_SYSTEM ) ?></option>
                                        <option value="approved"><?php _e( 'Approved', WL_ABS_SYSTEM ) ?></option>
                                        <option value="cancelled"><?php _e( 'Cancelled', WL_ABS_SYSTEM ) ?></option>
                                        <option value="completed"><?php _e( 'Completed', WL_ABS_SYSTEM ) ?></option>
                                    </select>
                                    <span class="validation_alert"
                                          id="cal_status_alert"><?php _e( "Please select one", WL_ABS_SYSTEM ); ?></span>
                                </div>
                                <div class="col-md-12" style="display: none">
                                    <label for="payment_status"><?php _e( 'Payment Status', WL_ABS_SYSTEM ) ?></label>
                                    <select id="payment_status" class="field form-control" name="payment_status">
                                        <option value=" "><?php _e( 'Select Status', 'WL_ABS_SYSTEM ' ) ?></option>
                                        <option value="pending"><?php _e( 'Pending', WL_ABS_SYSTEM ) ?></option>
                                        <option value="approved"><?php _e( 'Approved', ' WL_ABS_SYSTEM' ) ?></option>
                                    </select>
                                    <span class="validation_alert"
                                          id="payment_status_alert"><?php _e( "Please select one", WL_ABS_SYSTEM ); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='save_cal_details'
                            onclick="return save_form();"><?php _e( 'Save', WL_ABS_SYSTEM ) ?></button>
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php _e( 'Close', WL_ABS_SYSTEM ) ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php /* UPDATE APPOINTMENT */ ?>
<div id="eventCalModal" class="modal fade">
    <div class="modal-dialog">
        <form style="margin-bottom: 0;" action="" method="POST" id="admin_edit_appointment"
              name="admin_edit_appointment">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="eventTitle" class="modal-title"><?php _e( 'Update Appointment', WL_ABS_SYSTEM ) ?></h4>
                </div>
                <div id="eventBody" class="modal-body">
                    <div class="modal-body">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='update_cal_details'
                            onclick="return update_cal_appointment();"><?php _e( 'Update', WL_ABS_SYSTEM ) ?></button>
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php _e( 'Close', 'WL_ABS_SYSTEM ' ) ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    #payment_hide {
        display: none !important;
    }

    .fc-basic-view .fc-day-number,
    #of_container .group h2,
    .ui-widget button {
        font-family: <?php echo $cal_font_style ; ?> !important;
    }

    .tooltipevent {
        posiotion: fixed !important;
    }

    .fc-row .fc-content-skeleton tbody td {
        word-wrap: break-word !important;
        white-space: normal !important;
    }

    .fc-view-container {
        height: 100% !important;
    }

    #groups, #sub_groups,
    #date_filter {
        height: 43px !important;
    }

    .wickedpicker {
        z-index: 500 !important;
    }

    .fc-event .fc-content {
        z-index: 0 !important;
    }

    .hover_border_remove {
        border-width: 0px !important;
        padding-bottom: 10px !important;
    }

    .fc-custom {
        display: none !important;
    }
</style>
<script>

    //DATEPICKER
    var dateToday = new Date();
    jQuery(function () {
        jQuery("#booking_date,#re_start_date,#re_end_date").datepicker({
            minDate: dateToday,		//DISABLE PREVIOUS DATES
        });
    });

    //FULLCALENDER
    jQuery(document).ready(function () {
        jQuery('#bootstrapModalFullCalendar').fullCalendar({
			<?php if($cal_theme_style == 'theme_02'){ ?>
            theme: true,
			<?php } ?>
            header: {
                left: '',
                center: 'prev title next',
                right: 'month,agendaWeek,agendaDay'
            },
            monthNames: ["<?php _e( "January", WL_ABS_SYSTEM ); ?>", "<?php _e( "February", WL_ABS_SYSTEM ); ?>", "<?php _e( "March", WL_ABS_SYSTEM ); ?>", "<?php _e( "April", WL_ABS_SYSTEM ); ?>", "<?php _e( "May", WL_ABS_SYSTEM ); ?>", "<?php _e( "June", WL_ABS_SYSTEM ); ?>", "<?php _e( "July", WL_ABS_SYSTEM ); ?>", "<?php _e( "August", WL_ABS_SYSTEM ); ?>", "<?php _e( "September", WL_ABS_SYSTEM ); ?>", "<?php _e( "October", WL_ABS_SYSTEM ); ?>", "<?php _e( "November", WL_ABS_SYSTEM ); ?>", "<?php _e( "December", WL_ABS_SYSTEM ); ?>"],
            monthNamesShort: ["<?php _e( "Jan", WL_ABS_SYSTEM ); ?>", "<?php _e( "Feb", WL_ABS_SYSTEM ); ?>", "<?php _e( "Mar", WL_ABS_SYSTEM ); ?>", "<?php _e( "Apr", WL_ABS_SYSTEM ); ?>", "<?php _e( "May", WL_ABS_SYSTEM ); ?>", "<?php _e( "Jun", WL_ABS_SYSTEM ); ?>", "<?php _e( "Jul", WL_ABS_SYSTEM ); ?>", "<?php _e( "Aug", WL_ABS_SYSTEM ); ?>", "<?php _e( "Sept", WL_ABS_SYSTEM ); ?>", "<?php _e( "Oct", WL_ABS_SYSTEM ); ?>", "<?php _e( "nov", WL_ABS_SYSTEM ); ?>", "<?php _e( "Dec", WL_ABS_SYSTEM ); ?>"],
            dayNames: ["<?php _e( "Sunday", WL_ABS_SYSTEM ); ?>", "<?php _e( "Monday", WL_ABS_SYSTEM ); ?>", "<?php _e( "Tuesday", WL_ABS_SYSTEM ); ?>", "<?php _e( "Wednesday", WL_ABS_SYSTEM ); ?>", "<?php _e( "Thursday", WL_ABS_SYSTEM ); ?>", "<?php _e( "Friday", WL_ABS_SYSTEM ); ?>", "<?php _e( "Saturday", WL_ABS_SYSTEM ); ?>"],
            dayNamesShort: ["<?php _e( "Sun", WL_ABS_SYSTEM ); ?>", "<?php _e( "Mon", WL_ABS_SYSTEM ); ?>", "<?php _e( "Tue", WL_ABS_SYSTEM ); ?>", "<?php _e( "Wed", WL_ABS_SYSTEM ); ?>", "<?php _e( "Thus", WL_ABS_SYSTEM ); ?>", "<?php _e( "Fri", WL_ABS_SYSTEM ); ?>", "<?php _e( "Sat", WL_ABS_SYSTEM ); ?>"],
            buttonText: {
                today: "<?php _e( "Today", WL_ABS_SYSTEM ); ?>",
                day: "<?php _e( "Day", WL_ABS_SYSTEM ); ?>",
                week: "<?php _e( "Week", WL_ABS_SYSTEM ); ?>",
                month: "<?php _e( "Month", WL_ABS_SYSTEM ); ?>"
            },
            timeFormat: <?php if ( $cal_time_format == 'h:i' ) {
				echo "'h:mmtt{-h:mmtt }'";
			} else {
				echo "'H:mm{-H:mm }'";
			} ?>,
            axisFormat: <?php if ( $cal_time_format == 'h:i' ) {
				echo "'hh:mm'";
			} else {
				echo "'HH:mm'";
			} ?>,
            firstDay:<?php echo $cal_first_day;  ?>,
            defaultView: '<?php echo $cal_view; ?>',
            selectable: true,
            selectHelper: true,
            dayClick: function (date, jsEvent, view) {
                //MODAL ON DAYCLICK
                jQuery('#fullCalModal').modal();
            },
            editable: false,
            resizable: true,
            events: ajaxurl + '?action=full_calendar_dataloader_ajax',
            eventMouseover: function (calEvent, jsEvent) {						// EVENT DETAILS MOUSE-OVER
                jQuery(this).popover({
                    html: true,
                    title: event.name,
                    placement: 'top',
                    trigger: 'manual',
                    content: calEvent.event_hover,
                    container: '#bootstrapModalFullCalendar'
                }).popover('toggle');
            },
            eventMouseout: function (calEvent, jsEvent) {
                jQuery('.tooltipevent').remove();
                jQuery(this).popover('hide');
            },
            dayRender: function (date, cell) {
				<?php foreach($ap_holiday_fecthes as $val_ues) { ?>
				<?php if($val_ues->repeat_value == "no") {
				$date_format = date( "Y-m-d", strtotime( $val_ues->holiday_date ) );  ?>
                if (date.isSame('<?php echo $date_format;?>')) {
                    cell.css("background-color", "<?php echo $cal_off_time_color; ?>");
                }
				<?php
				}

				if($val_ues->repeat_value == "p_d") {
				$date_start = date( "Y-m-d", strtotime( $val_ues->start_date ) );
				$date_end = date( "Y-m-d", strtotime( $val_ues->end_date ) );
				?>
                if (date.isBetween('<?php echo $date_start?>', '<?php echo $date_end?>', null, '[]')) {
                    cell.css("background-color", "<?php echo $cal_off_time_color; ?>");
                }
				<?php
				}

				if($val_ues->repeat_value == "daily") {
				$dayz = $val_ues->repeat_days;
				for($i = 0;$i <= $dayz;$i ++) {
				$date_format = date( "Y-m-d", strtotime( '+' . $i . ' days', strtotime( $val_ues->holiday_date ) ) );
				$dateTo = $date_format ?>
                if (date.isSame('<?php echo $dateTo;?>')) {
                    cell.css("background-color", "<?php echo $cal_off_time_color; ?>");
                }
				<?php
				}
				}

				if($val_ues->repeat_value == "weekly") {
				$weekz = $val_ues->repeat_weeks;
				for($i = 0;$i <= $weekz;$i ++) {
				$date_format = date( "Y-m-d", strtotime( '+' . $i . ' week', strtotime( $val_ues->holiday_date ) ) );
				$dateTo = $date_format ?>
                if (date.isSame('<?php echo $dateTo;?>')) {
                    cell.css("background-color", "<?php echo $cal_off_time_color; ?>");
                }
				<?php
				}
				}

				if($val_ues->repeat_value == "bi_weekly") {
				$bi_weekz = $val_ues->repeat_bi_weeks;
				$var = $bi_weekz * 2;
				for($i = 0;$i <= $var;$i = $i + 2) {
				$date_format = date( "Y-m-d", strtotime( '+' . $i . ' week', strtotime( $val_ues->holiday_date ) ) );
				$dateTo = $date_format ?>
                if (date.isSame('<?php echo $dateTo;?>')) {
                    cell.css("background-color", "<?php echo $cal_off_time_color; ?>");
                }
				<?php
				}
				}

				if($val_ues->repeat_value == "monthly") {
				$monthz = $val_ues->repeat_month;
				for($i = 0;$i <= $monthz;$i ++) {
				$date_format = date( "Y-m-d", strtotime( '+' . $i . 'months', strtotime( $val_ues->holiday_date ) ) );
				$dateTo = $date_format ?>
                if (date.isSame('<?php echo $dateTo;?>')) {
                    cell.css("background-color", "<?php echo $cal_off_time_color; ?>");
                }
				<?php
				}
				}
				} /* end of foreach */
				?>
            },

            eventRender: function (event, element, view) {
                if (event.event_hover) {
                    element.find(".fc-title").after(jQuery("<span class=\"fc-custom\"></span>").html("<span class='fc-custom'>" + event.event_hover + "</span>"));
                }
                return ['all', event.title].indexOf(jQuery('#client_selecter option:selected').val()) >= 0 && ['all', event.service_type].indexOf(jQuery('#service_selecter option:selected').val()) >= 0 && ['all', event.status].indexOf(jQuery('#status_selecter option:selected').val()) >= 0;
            },

            eventClick: function (event, jsEvent, view) { //MODAL ON EVENT CLICK
                jQuery('#eventTitle').html(event.update);
                jQuery('#eventBody').html(event.details);
                jQuery('#eventCalModal').modal();
                jQuery("#edit_contact").intlTelInput();
                var re = jQuery("#repeat_cl:checked").val();
                if (re == 'daily') {
                    jQuery('.dailydiv').show();
                    jQuery("#edit_booking_date").prop("disabled", false);
                }
                if (re == 'weekly') {
                    jQuery('.weeklydiv').show();
                    jQuery("#edit_booking_date").prop("disabled", false);
                }
                if (re == 'monthly') {
                    jQuery('.monthlydiv').show();
                    jQuery("#edit_booking_date").prop("disabled", false);
                }
                if (re == 'PD') {
                    jQuery('.PDdiv').show();
                    jQuery("#edit_booking_date").prop("disabled", true);
                }
                var dateToday = new Date();
                jQuery("#edit_booking_date,#re_start_date_cl,#re_end_date_cl").datepicker({minDate: dateToday,});
                var options = {
                    twentyFour: true, /* Display 24 hour format, defaults to false */
                    close: 'wickedpicker__close', /* The close class selector to use, for custom CSS */
                    hoverState: 'hover-state', /* The hover state class to use, for custom CSS */
                    title: 'Timepicker', /* The Wickedpicker's title, showSeconds: false, //Whether or not to show seconds, */
                    beforeShow: null, /* A function to be called before the Wickedpicker is shown */
                    show: null, /* A function to be called when the Wickedpicker is shown */
                    clearable: false, /* Make the picker's input clearable (has clickable "x") */
                };
                jQuery('.clockpicker').clockpicker();
                return false;
            },
            timeFormat: 'h(:mm)t',
        });
        jQuery(document).on('change', '#client_selecter,#staff_selecter,#service_selecter,#date_selecter,#status_selecter', function (event) {
            jQuery('#bootstrapModalFullCalendar').fullCalendar('rerenderEvents');
        });
    });
</script>