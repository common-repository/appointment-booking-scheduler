<?php
defined( 'ABSPATH' ) or die();
?>
<script>
    jQuery(document).ready(function () {
        jQuery('[data-toggle=popover_coupon_used]').popover({
            content: jQuery('#popover_coupon_used').html(),
            html: true
        }).on("mouseenter", function () {
            jQuery(this).popover('show');
        }).on("mouseleave", function () {
            jQuery(this).popover('hide');
        });

        jQuery('[data-toggle=coupon_used_month]').popover({
            content: jQuery('#coupon_used_month').html(),
            html: true
        }).on("mouseenter", function () {
            jQuery(this).popover('show');
        }).on("mouseleave", function () {
            jQuery(this).popover('hide');
        });
    });
</script>
<style>
    .popover-title {
        background-color: white !important;
        color: black !important;
    }
</style>
<?php
global $wpdb;
$appointments_table = $wpdb->prefix . "apt_appointments";
$staff_table        = $wpdb->prefix . "apt_staff";
$clients_table      = $wpdb->prefix . "apt_clients";
$payment_table      = $wpdb->prefix . "apt_payment";
$coupon_table       = $wpdb->prefix . "apt_coupons";
$services_table     = $wpdb->prefix . "apt_services";
?>
<div class="row ap-services-graph">
    <div class="col-md-12 col-sm-12"><h3
                style="padding-left: 0px"><?php _e( 'Appointment Reports', WL_ABS_SYSTEM ) ?></h3></div>
    <div class="col-md-3 col-sm-6">
        <div class="span2" onTablet="span4" onDesktop="span2">
            <div class="circleStatsItemBox green">
                <div class="header dashboard_appt"><?php _e( 'Status', WL_ABS_SYSTEM ) ?></div>
                <span class="percent"><?php _e( 'Approved', WL_ABS_SYSTEM ) ?></span>
                <div class="circleStat">
					<?php
					$approved_appointment_details = $wpdb->get_results( "select * from $appointments_table where status='approved'" );
					$approved_appointments        = count( $approved_appointment_details );
					?>
                    <input type="text" value="<?php echo $approved_appointments; ?>" class="whiteCircle"/>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="span2" onTablet="span4" onDesktop="span2">
            <div class="circleStatsItemBox orange">
                <div class="header dashboard_appt"><?php _e( 'Status', WL_ABS_SYSTEM ) ?></div>
                <span class="percent"><?php _e( 'Pending', WL_ABS_SYSTEM ) ?></span>
                <div class="circleStat">
					<?php
					$pending_appointment_details = $wpdb->get_results( "select * from $appointments_table where status='pending'" );
					$pending_appointments        = count( $pending_appointment_details );
					?>
                    <input type="text" value="<?php echo $pending_appointments; ?>" class="whiteCircle"/>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="span2" onTablet="span4" onDesktop="span2">
            <div class="circleStatsItemBox red">
                <div class="header dashboard_appt"><?php _e( 'Cancelled', WL_ABS_SYSTEM ) ?></div>
                <span class="percent"><?php _e( 'Cancelled', WL_ABS_SYSTEM ) ?></span>
                <div class="circleStat">
					<?php
					$cancelled_appointment_details = $wpdb->get_results( "select * from $appointments_table where status='cancelled'" );
					$cancelled_appointments        = count( $cancelled_appointment_details );
					?>
                    <input type="text" value="<?php echo $cancelled_appointments; ?>" class="whiteCircle"/>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="span2" onTablet="span4" onDesktop="span2">
            <div class="circleStatsItemBox blue">
                <div class="header dashboard_appt"><?php _e( 'Completed', WL_ABS_SYSTEM ) ?></div>
                <span class="percent"><?php _e( 'Completed', WL_ABS_SYSTEM ) ?></span>
                <div class="circleStat">
					<?php
					$completed_appointment_details = $wpdb->get_results( "select * from $appointments_table where status='completed'" );
					$completed_appointments        = count( $completed_appointment_details );
					?>
                    <input type="text" value="<?php echo $completed_appointments; ?>" class="whiteCircle"/>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row ap-services-graph">
    <div class="col-md-12 col-sm-12"><h3 style="padding-left: 0px"><?php _e( 'Overall Report', WL_ABS_SYSTEM ) ?></h3>
    </div>
    <div class="col-md-4 col-sm-4">
        <div class="span2" onTablet="span4" onDesktop="span2">
            <div class="circleStatsItemBox orange">
                <div class="header dashboard_appt"><?php _e( 'Total Customers', WL_ABS_SYSTEM ) ?></div>
                <span class="percent"><?php _e( 'Customers', WL_ABS_SYSTEM ) ?></span>
                <div class="circleStat">
					<?php
					$customer_email_id = $wpdb->get_col( "Select id from $clients_table" );
					$regular_clients   = count( $customer_email_id );
					?>
                    <input type="text" value="<?php echo $regular_clients; ?>" class="whiteCircle"/>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-4">
        <div class="span2" onTablet="span4" onDesktop="span2">
            <div class="circleStatsItemBox purple">
                <div class="header dashboard_appt"><?php _e( 'Total Services', WL_ABS_SYSTEM ) ?></div>
                <span class="percent"><?php _e( 'Services', WL_ABS_SYSTEM ) ?></span>
                <div class="circleStat">
					<?php
					$service_id     = $wpdb->get_col( "Select id from $services_table" );
					$total_services = count( $service_id );
					?>
                    <input type="text" value="<?php echo $total_services; ?>" class="whiteCircle"/>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
        <div class="span2" onTablet="span4" onDesktop="span2">
            <div class="circleStatsItemBox black">
                <div class="header dashboard_appt"><?php _e( 'Total Appointments', WL_ABS_SYSTEM ) ?></div>
                <span class="percent"><?php _e( 'Appointments', WL_ABS_SYSTEM ) ?></span>
                <div class="circleStat">
					<?php
					$appointments       = $wpdb->get_col( "Select id from $appointments_table" );
					$total_appointments = count( $appointments );
					?>
                    <input type="text" value="<?php echo $total_appointments; ?>" class="whiteCircle"/>
                </div>
            </div>
        </div>
    </div>
</div>