<?php
defined( 'ABSPATH' ) or die();

global $wpdb;
$appointment_customer_details = $wpdb->get_results( "SELECT * from $wpdb->prefix" . "apt_clients" );
?>
<select id="client_name" class="field form-control" name="client_name">
    <option value="0"><?php _e( "Select Customer", WL_ABS_SYSTEM ); ?></option>
	<?php foreach ( $appointment_customer_details as $appointment_client_single_detail ) { ?>
        <option title="<?php echo $appointment_client_single_detail->email; ?>"
                value="<?php echo $appointment_client_single_detail->first_name; ?> <?php echo $appointment_client_single_detail->last_name; ?>"><?php echo $appointment_client_single_detail->first_name; ?><?php echo $appointment_client_single_detail->last_name; ?></option>
	<?php } ?>
</select>
<input type="hidden" class="form-control" name="client_email" id="client_email"/>
<span class="validation_alert" id="cal_customer_alert"><?php _e( "Please select one", WL_ABS_SYSTEM ); ?></span>