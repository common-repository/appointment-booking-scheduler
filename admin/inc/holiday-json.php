<?php
defined( 'ABSPATH' ) or die();

global $wpdb;
$ap_fecth = $wpdb->get_results( "select * from $wpdb->prefix" . "apt_holidays" );
$num_rows = count( $ap_fecth );
if ( $num_rows !== 0 ) {
	foreach ( $ap_fecth as $value ) {
		//$status_show ="Upcoming" ;	
		$status      = date( "m/d/Y" );
		$all_off     = $value->all_off;
		$id          = $value->id;
		$name        = $value->name;
		$start_date  = $value->start_date;
		$end_date    = $value->end_date;
		$all_day_off = "";
		if ( $all_off == "1" ) {
			$start_time  = "12:00am";
			$end_time    = "11:59pm";
			$all_day_off = __( 'Full Day Off', WL_ABS_SYSTEM );
		} else {
			$start_time = $value->start_time;
			$end_time   = $value->end_time;
		}

		$repeat = $value->repeat_value;
		if ( $repeat == "p_d" ) {
			$date = array( $start_date . " To " . $end_date );
			if ( $status == $end_date ) {
				$status_show = __( 'Running', WL_ABS_SYSTEM );
			}
			if ( $status > $end_date ) {
				$status_show = __( 'Gone', WL_ABS_SYSTEM );
			}
			if ( $status < $end_date ) {
				$status_show = __( 'Upcoming', WL_ABS_SYSTEM );
			}
		} else {
			$date = $value->holiday_date;
			if ( $status == $date ) {
				$status_show = __( 'Running', WL_ABS_SYSTEM );
			}
			if ( $status > $date ) {
				$status_show = __( 'Gone', WL_ABS_SYSTEM );
			}
			if ( $status < $date ) {
				$status_show = __( 'Upcoming', WL_ABS_SYSTEM );
			}
		}

		if ( $repeat == "no" ) {
			$show_repeat = __( 'No Repeat', WL_ABS_SYSTEM );
		}

		if ( $repeat == "p_d" ) {
			$show_repeat = __( 'Particular Date(s)', WL_ABS_SYSTEM );
		}

		if ( $repeat == "daily" ) {
			$show_repeat = __( 'Daily', WL_ABS_SYSTEM );
		}

		if ( $repeat == "weekly" ) {
			$show_repeat = __( 'Weekly', WL_ABS_SYSTEM );
		}
		if ( $repeat == "bi_weekly" ) {
			$show_repeat = __( 'Bi-Weekly', WL_ABS_SYSTEM );
		}
		if ( $repeat == "monthly" ) {
			$show_repeat = __( 'Monthly', WL_ABS_SYSTEM );
		}
		$notes             = $value->notes;
		$results["data"][] = array(
			'<input type="checkbox" name="check[]" id="my_check_holiday" class="checkbox_1" value="' . $id . '"/>',
			$name,
			$date,
			array( $start_time . " To " . $end_time ),
			array( $show_repeat . " " . $all_day_off ),
			$status_show,
			array( '<a style="margin-right: 5px;" href="#holi_day_update"  data-backdrop="true" data-toggle="modal" data-id="' . $id . '"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp <a href="#' . $id . '" class="del_holi_day">  <i class="glyphicon glyphicon-trash"></i></a>' )
		);
	}
} else {
	$results["data"][] = array( null, null, null, __( 'No Holiday Add', WL_ABS_SYSTEM ), null, null, null );
}

if ( $results != null ) {
	wp_send_json( $results ); // encode and send response
} else {
	wp_send_json_error(); // {"success":false}
}
?>