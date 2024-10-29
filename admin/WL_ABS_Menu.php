<?php
defined( 'ABSPATH' ) or die();

class WL_ABS_Menu {

	/* Create menu */
	public static function create_menu() {
		$dashboard = add_menu_page( __( 'Appointment Booking Scheduler', WL_ABS_SYSTEM ), __( 'Appointment Booking Scheduler', WL_ABS_SYSTEM ), 'manage_options', 'abs_system', array(
			'WL_ABS_Menu',
			'dashboard'
		), 'dashicons-calendar-alt', '10' );
		add_action( 'admin_print_styles-' . $dashboard, array( 'WL_ABS_Menu', 'dashboard_assets' ) );
	}

	/* Dashboard menu/submenu callback */
	public static function dashboard() {
		require_once( 'inc/wl_abs_dashboard.php' );
	}

	/* Dashboard menu assets */
	public static function dashboard_assets() {
		self::enqueue_libraries();
	}

	/* Enqueue libraries */
	public static function enqueue_libraries() {

		wp_enqueue_style( 'ap_bootstrap_min', WEBLIZAR_A_B_SYSTEM . 'assets/bootstrap/css/bootstrap.min.css', array(), true );
		wp_enqueue_style( 'ap_dataTables_bootstrap', WEBLIZAR_A_B_SYSTEM . 'assets/css/dataTables.bootstrap.min.css', array(), true );
		wp_enqueue_style( 'ap_bootstrap-table', WEBLIZAR_A_B_SYSTEM . 'assets/css/bootstrap-table.css', array(), true );
		wp_enqueue_style( 'ap_font_awesome', WEBLIZAR_A_B_SYSTEM . 'assets/css/font-awesome.min.css', array(), true );
		wp_enqueue_style( 'ap_animate_css', WEBLIZAR_A_B_SYSTEM . 'assets/css/animate.css', array(), true );
		wp_enqueue_style( 'ap_animate', WEBLIZAR_A_B_SYSTEM . 'assets/css/animate.min.css', array(), true );
		wp_enqueue_style( 'ap_icon_picker', WEBLIZAR_A_B_SYSTEM . 'assets/css/icon-picker.css', array(), true );
		wp_enqueue_style( 'ap_genericons_css', WEBLIZAR_A_B_SYSTEM . 'assets/css/genericons.css', array(), true );
		wp_enqueue_style( 'ap_style', WEBLIZAR_A_B_SYSTEM . 'assets/css/ap_style.css', array(), true );
		wp_enqueue_style( 'ap_style_css_2', WEBLIZAR_A_B_SYSTEM . 'assets/css/style_2.css', array(), true );
		wp_enqueue_style( 'responsive_dataTables', WEBLIZAR_A_B_SYSTEM . 'assets/css/responsive.dataTables.min.css', array(), true );

		wp_enqueue_style( 'cal_themes', WEBLIZAR_A_B_SYSTEM . 'assets/calender/jquery-ui.min.css', array(), true );
		wp_enqueue_style( 'fullcalendarcss', WEBLIZAR_A_B_SYSTEM . 'assets/calender/fullcalendar.css', array(), true );
		wp_enqueue_script( 'moment_min_js', WEBLIZAR_A_B_SYSTEM . 'assets/calender/moment_min.js', true );
		wp_enqueue_script( 'jquery_ui_custom_min', WEBLIZAR_A_B_SYSTEM . 'assets/calender/jquery_ui_custom_min.js', true );
		wp_enqueue_script( 'fullcalendar_min', WEBLIZAR_A_B_SYSTEM . 'assets/calender/fullcalendar_min.js', true );
		wp_enqueue_style( 'bootstrap-year-calendar_css', WEBLIZAR_A_B_SYSTEM . 'assets/calender/bootstrap-year-calendar.css', array(), true );
		wp_enqueue_script( 'bootstrap-year-calendar_js', WEBLIZAR_A_B_SYSTEM . 'assets/calender/bootstrap-year-calendar.js', true );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

		wp_enqueue_script( 'date_picker_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/date_picker.js', array( 'jquery' ) );
		wp_enqueue_script( 'custom_script_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/custom-script.js', array( 'wp-color-picker' ) );

		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_script( 'ap_upload_media_widget', WEBLIZAR_A_B_SYSTEM . 'assets/js/upload-media.js', array( 'jquery' ) );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'ap_bootstrap_js', WEBLIZAR_A_B_SYSTEM . 'assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'ap_dataTables_min', WEBLIZAR_A_B_SYSTEM . 'assets/js/jquery.dataTables.min.js', array( 'jquery' ) );
		wp_enqueue_style( 'data_table_css', WEBLIZAR_A_B_SYSTEM . 'assets/css/jquery.dataTables.min.css', array(), true );
		wp_enqueue_script( 'ap_bootstrap_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/dataTables.bootstrap.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'ap_bootstrap_table', WEBLIZAR_A_B_SYSTEM . 'assets/js/bootstrap-table.js', array( 'jquery' ) );
		wp_enqueue_script( 'ap_icon_picker_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/icon-picker.js', array( 'jquery' ) );
		wp_enqueue_script( 'ap_fullcalendar_min_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/fullcalendar.min.js', array( 'jquery' ) );


		wp_enqueue_script( 'ap_jquery_flot', WEBLIZAR_A_B_SYSTEM . 'assets/js/jquery.flot.js', array( 'jquery' ) );
		wp_enqueue_script( 'ap_jquery_knob', WEBLIZAR_A_B_SYSTEM . 'assets/js/jquery.knob.modified.js', array( 'jquery' ) );
		wp_enqueue_script( 'ap_jquery_sparkline', WEBLIZAR_A_B_SYSTEM . 'assets/js/jquery.sparkline.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'ap_counter_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/counter.js', array( 'jquery' ) );
		wp_enqueue_script( 'ap_custom_custom_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/custom.js', array( 'jquery' ) );
		wp_enqueue_script( 'dataTables_responsive', WEBLIZAR_A_B_SYSTEM . 'assets/js/dataTables.responsive.min.js', array( 'jquery' ) );

		wp_enqueue_style( 'ap_tel_css', WEBLIZAR_A_B_SYSTEM . 'assets/js/contact/intlTelInput.css', array(), true );
		wp_enqueue_script( 'ap_tel_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/contact/intlTelInput.js', array( 'jquery' ) );
		wp_enqueue_script( 'data-table-js', WEBLIZAR_A_B_SYSTEM . 'assets/js/jquery.dataTables.min.js', true );
		wp_enqueue_script( 'jquery.flot.pie-js', WEBLIZAR_A_B_SYSTEM . 'assets/js/jquery.flot.pie.js', true );
		wp_enqueue_style( 'font_family_css', WEBLIZAR_A_B_SYSTEM . 'assets/css/googleapis.css', array(), true );
		wp_enqueue_style( 'ap_style_css', WEBLIZAR_A_B_SYSTEM . 'assets/css/style.css', array(), true );
		wp_enqueue_style( 'ap_media_screen', WEBLIZAR_A_B_SYSTEM . 'assets/css/media-screen.css', array(), true );
		wp_enqueue_script( 'notify_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/alertbox/notify.js', array( 'jquery' ) );
		wp_enqueue_style( 'alert_css', WEBLIZAR_A_B_SYSTEM . 'assets/js/alertbox/notify.css', array(), true );
		wp_enqueue_script( 'confirmation_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/confirmation/jquery-confirm.min.js', true );
		wp_enqueue_style( 'confirmation_css', WEBLIZAR_A_B_SYSTEM . 'assets/js/confirmation/jquery-confirm.min.css', array(), true );
		wp_enqueue_script( 'multidatespicker_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/multidatespicker/jquery-ui.multidatespicker.js', true );
		wp_enqueue_style( 'ap_multiselect_css', WEBLIZAR_A_B_SYSTEM . 'assets/js/multi-select/jquery.multiselect.css', array(), true );
		wp_enqueue_script( 'ap_multiselect_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/multi-select/jquery.multiselect.js', array( 'jquery' ), true );
		wp_enqueue_style( 'clockpicker_css', WEBLIZAR_A_B_SYSTEM . 'assets/js/timepicker_assets/clockpicker.css', array(), true );
		wp_enqueue_script( 'clockpicker_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/timepicker_assets/clockpicker.js', array( 'jquery' ), true );
		wp_enqueue_style( 'preloader_css', WEBLIZAR_A_B_SYSTEM . 'assets/js/preloader/examples.css', array(), true );
		wp_enqueue_script( 'preloader_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/preloader/jquery.preloader.min.js', array( 'jquery' ), true );
		wp_enqueue_style( 'timepicker_css', WEBLIZAR_A_B_SYSTEM . 'assets/js/timepicker_assets/wickedpicker.min.css', array(), true );
		wp_enqueue_script( 'timepicker_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/timepicker_assets/wickedpicker.js', array( 'jquery' ), true );
	}
	
	public static function banner_message() {		
		if ( isset( $_GET['page'] ) && $_GET['page'] == "abs_system" ) { 
		?>
		<style>	
			#wl_abs_banner .wl_abs_banner_row{
				/*padding: 20px 20px 0px;*/
				margin: 20px 0px;
				background: linear-gradient(-67deg, #e53637 57%, rgba(4, 4, 4, 0.74) 39%), url( <?php echo WEBLIZAR_A_B_SYSTEM ."assets/images/bg-1.jpg"; ?>);
				border: 1px solid #ccc;
			}
			#wl_abs_banner .wl_abs_features {
				padding-top: 20px;
				padding-left: 25px;
			}
			#wl_abs_banner .wl_abs_features ul li {				
				padding: 2.5px 5px;
				font-size: 14px;
				font-weight: bold;
				line-height: 1.5;
				color: #FFFFFF;
			}
			
			#wl_abs_banner .wl_abs_features ul {
				margin-top: 20px;        
			}			
			#wl_abs_banner .wl_abs_features ul li:before {
				content: "\f00c";
				font-family: FontAwesome;
				display: inline-block;
				margin-left: -1.3em;
				width: 1.3em;
				color: #FFFFFF;
			}
			#wl_abs_banner .wl_banner_heading{
				color: #FFFFFF;
				font-weight: bold;
				text-align: center;
			}

			#wl_abs_banner .button-primary {
				background: #4CAF50;
				border-color: #0073aa #006799 #006799;
				box-shadow: 0 4px 6px #0000002e;
				color: #fff;
				border-radius: 4px;
				text-decoration: none;
				border: 0;
				text-shadow: none;
				width: 42%;
				text-align: center;
				font-size: 18px;
				height: 47px;
				padding: 10px;
				margin-left: 15px;
				margin-right: 15px;
				margin-top: 10px;
				transition: 0.4s;
			}
		</style>		
			<div id="wl_abs_banner" class="container-fluid notice is-dismissible">
				<div class="row wl_abs_banner_row">
					<div class="col-md-6 wl_banner_image">          
						<h3 class="wl_banner_heading"><?php _e( 'Appointment Scheduler Pro Features', WL_ABS_SYSTEM ); ?></h3>
						<img src="<?php echo WEBLIZAR_A_B_SYSTEM . "assets/images/apointment_image_or_web_542x542.jpg"; ?>" class="img-fluid"/>
					</div>
					<div class="col-md-6 wl_abs_features">
						<div class="row">           
							  <div class="col-md-6">
								<ul>
								  <li><?php _e( 'Appointment Management', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Appointment Sync with Google Calendar', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Multi Location', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Secure Payment Gateway', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Unlimited Bookings', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Unlimited Services', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Unlimited Staff', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Free Bookings', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Premium Booking', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Notification', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Admin Notification', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Customer Notification', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Statistical Administrator Dashboard', WL_ABS_SYSTEM ); ?></li>
								</ul>
							  </div>
							  <div class="col-md-6">
								<ul>
								  <li><?php _e( 'Staff Notification', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Social Media', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Staff Appointment Management', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Staff Time Schedule', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Calendar View', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Reminders', WL_ABS_SYSTEM ); ?></li>               
								  <li><?php _e( 'Export Appointment List', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Export Client & Customers List', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Business Hours Widget', WL_ABS_SYSTEM ); ?></li>                       
								  <li><?php _e( 'Mobile Friendly', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Best Booking System', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Fast & Friendly Support', WL_ABS_SYSTEM ); ?></li>
								  <li><?php _e( 'Payment Gateway: PayPal, Stripe, Razorpay', WL_ABS_SYSTEM ); ?></li>
								</ul>
							  </div>
						</div>
						<div class="row">
						  <div class="col-md-12">
							<a class="button-primary button-hero" href="http://demo.weblizar.com/appointment-scheduler-pro/" target="_blank"><?php _e('View Demo', WL_ABS_SYSTEM ); ?></a>
							<a class="button-primary button-hero" href="https://weblizar.com/plugins/appointment-scheduler-pro/" target="_blank"><?php _e('Buy Now', WL_ABS_SYSTEM ); ?> $40</a>
						  </div>
						</div>
					</div>
				</div>
			</div>		
		<?php		
		}	
		
	}
}