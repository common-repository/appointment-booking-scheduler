<?php
defined( 'ABSPATH' ) or die();
?>
<script type="text/javascript">
    jQuery(window).on('load', function () {
        jQuery("#ap_main_div").show();
        jQuery("#wpfooter").show();
        jQuery('#bootstrapModalFullCalendar').fullCalendar('render');
    });

    jQuery(document).ready(function () {
        jQuery('a.ap_main_side_bar').on('show.bs.tab', function (e) {
            localStorage.setItem('activeTab', jQuery(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            jQuery('#myTab a[href="' + activeTab + '"]').tab('show');
        }
    });

    jQuery(window).load(function () {
        jQuery("container-fluid").hide();
        jQuery(window).preloader({});
    });

    jQuery(function () {
        var calendarInit = false;
        jQuery('a#calendarTab ').on('shown.bs.tab', function (e) {
            if (jQuery(e.target).attr('href') == '#calendars' && !calendarInit) {
                jQuery('#bootstrapModalFullCalendar').fullCalendar('render');
                jQuery('#bootstrapModalFullCalendar').fullCalendar('rerenderEvents');
                jQuery('#bootstrapModalFullCalendar').fullCalendar('refetchEvents');
            }
        });

        jQuery('a#dashboardTab ').on('shown.bs.tab', function (e) {
            jQuery.ajax({
                data: "dash_show",
                url: ajaxurl + '?action=dashboard_fetch_ajax_request',
                type: "POST",
                success: function (data) {
                    // console.log(data);
                    jQuery("#dashboard_div").empty();
                    jQuery('#dashboard_div').html(data);
                    circle_progess();
                }
            });
        });
    });
</script>
<style>
    #wpfooter {
        display: none;
    }

    /* panel */  

    .wl_abs_admin_topmenu span.panel_heading {       
        font-size: 14px;
    }

    .wl_abs_admin_topmenu .theme-link i {
        font-size: 14px;
        color: #4ba3cb;
    }

    .wl_abs_admin_topmenu .theme-link li.active i {
        font-size: 14px;
        color: #FFFFFF;
    }

    .theme-sidemenu .nav-tabs li, .theme-sidemenu .nav-tabs li:hover {
        width: 100%;
    }

    .theme-sidemenu .nav-tabs li:hover a i,
    .theme-sidemenu .nav-tabs li.active a i{
        color: #FFFFFF;
    }   

    .services-table tbody td {
        width: 10%;
    }		
</style>
<!--Preloader element -->
<div id="preloader">
    <div id="preloader-inner">
    </div>
</div>

<div class="wrapper" id="ap_main_div" style="display:none;">		
    <!-- Home Start -->
    <div class="container-fluid ap-home theme-menu">
        <div class="row wl_abs_admin_topmenu">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 theme-sidemenu">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a id="dashboardTab" data-toggle="tab" class="theme-link ap_main_side_bar"
                                          href="#dashboard"><i class="fa fa-home"></i><span
                                    class="panel_heading"><?php _e( 'Dashboard', WL_ABS_SYSTEM ); ?> </span></a></li>
                    <li><a id="calendarTab" data-toggle="tab" class="theme-link ap_main_side_bar" href="#calendars"><i
                                    class="fa fa-calendar"></i><span
                                    class="panel_heading"><?php _e( 'Calendar', WL_ABS_SYSTEM ); ?> </span></a></li>
                    <li><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#service"><i
                                    class="fa fa-server"></i><span
                                    class="panel_heading"><?php _e( 'Services', WL_ABS_SYSTEM ); ?></span></a></li>
                    <li><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#customer"><i
                                    class="fa fa-users"></i><span
                                    class="panel_heading"><?php _e( 'Customers', WL_ABS_SYSTEM ); ?> </span></a></li>
                    <li><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#appointment"><i
                                    class="fa fa-thumb-tack"></i><span
                                    class="panel_heading"><?php _e( 'Appointment', WL_ABS_SYSTEM ); ?> </span></a></li>
                    <li><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#appearance"><i
                                    class="fa fa-paint-brush"></i><span
                                    class="panel_heading"><?php _e( 'Appearance', WL_ABS_SYSTEM ); ?> </span></a></li>
                    <li><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#email-notification"><i
                                    class="fa fa-bell"></i><span
                                    class="panel_heading"><?php _e( 'Notification', WL_ABS_SYSTEM ); ?></span></a>
                    </li>
                    <li><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#holiday"><i
                                    class="fa fa-coffee"></i><span
                                    class="panel_heading"><?php _e( 'Holiday', WL_ABS_SYSTEM ); ?></span></a></li>
                    <li><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#settings"><i
                                    class="fa fa-cog"></i><span
                                    class="panel_heading"><?php _e( 'Settings', WL_ABS_SYSTEM ); ?></span></a></li>
                    <li><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#details"><i
                                    class="fa fa-share-square-o"></i><span
                                    class="panel_heading"><?php _e( 'Plugin Info', WL_ABS_SYSTEM ); ?></span></a></li>
					<li><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#get_pro"><i
                                    class="fa fa-toggle-off"></i><span
                                    class="panel_heading"><?php _e( 'Get Pro', WL_ABS_SYSTEM ); ?></span></a></li>
                    <!--<li><a data-toggle="tab" class="theme-link ap_main_side_bar" href="#our_product"><i
                                    class="fa fa-gift"></i><span
                                    class="panel_heading"><?php //_e( 'Our Products', WL_ABS_SYSTEM ); ?></span></a></li> -->
                </ul>
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 theme-side-details">
                <div class="tab-content">
                    <!-- Index -->
                    <div id="dashboard" class="tab-pane fade in active theme-home">
						<?php include( "dashboard.php" ); ?>
                    </div>
                    <!-- Index -->

                    <!-- calendar -->
                    <div id="calendars" class="tab-pane fade theme-calendar">
						<?php include( "calendar.php" ); ?>
                    </div>
                    <!-- calendar -->

                    <!-- service -->
                    <div id="service" class="tab-pane fade theme-services">
						<?php include( "service.php" ); ?>
                    </div>
                    <!-- service -->

                    <!-- appointment -->
                    <div id="appointment" class="tab-pane fade theme-appoint">
						<?php include( "appointment.php" ); ?>
                    </div>
                    <!-- appointment -->

                    <!-- customer -->
                    <div id="customer" class="tab-pane fade theme-customer">
						<?php include( "customer.php" ); ?>
                    </div>
                    <!-- customer -->

                    <!-- email-notification -->
                    <div id="email-notification" class="tab-pane fade theme-notification">
						<?php include( "email-notification.php" ); ?>
                    </div>
                    <!-- email-notification -->

                    <!-- holiday -->
                    <div id="holiday" class="tab-pane fade theme-payment">
						<?php include( "holiday.php" ); ?>
                    </div>
                    <!-- payment -->

                    <!-- appearance -->
                    <div id="appearance" class="tab-pane fade theme-apperance ">
						<?php include( "appearance.php" ); ?>
                    </div>
                    <!-- appearance -->

                    <!-- settings -->
                    <div id="settings" class="tab-pane fade theme-settings">
						<?php include( "setting.php" ); ?>
                    </div>
                    <!-- settings -->

                    <!-- details -->
                    <div id="details" class="tab-pane fade theme-settings">
						<?php include( "appt_details.php" ); ?>
                    </div>
					<!-- get pro -->
                    <div id="get_pro" class="tab-pane fade theme-settings">
                        <?php include( "get_pro.php" ); ?>
                    </div>

                    <!-- our products -->
                    <div id="our_product" class="tab-pane fade theme-settings">
                        <?php include( "our_product.php" ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Home End -->
</div>