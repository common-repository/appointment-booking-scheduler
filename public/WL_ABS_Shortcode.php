<?php
defined( 'ABSPATH' ) or die();

class WL_ABS_Shortcode {
	public static function enqueue_frontend_assest() {
		wp_enqueue_script( 'confirmation_js', WEBLIZAR_A_B_SYSTEM . 'assets/js/confirmation/jquery-confirm.min.js', array('jquery'), true );
		wp_enqueue_style( 'confirmation_css', WEBLIZAR_A_B_SYSTEM . 'assets/js/confirmation/jquery-confirm.min.css', array(), true );
		wp_enqueue_script( 'ajax_custom_script', WEBLIZAR_A_B_SYSTEM . 'public/frontend/js/jquery-migrate-1.4.1.min.js', array( 'jquery' ) );
		wp_localize_script( 'ajax_custom_script', 'frontendajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'swiper_js', WEBLIZAR_A_B_SYSTEM . 'public/frontend/swiper.min.js', true );
		wp_enqueue_style( 'media_screen_css', WEBLIZAR_A_B_SYSTEM . 'public/frontend/media_screen.css', array(), true );
		wp_enqueue_style( 'swiper_css', WEBLIZAR_A_B_SYSTEM . 'public/frontend/swiper.min.css', array(), true );
		wp_enqueue_style( 'font_awesome_css', WEBLIZAR_A_B_SYSTEM . 'public/frontend/font-awesome.min.css', array(), true );
		wp_enqueue_style( 'bootstrap_css', WEBLIZAR_A_B_SYSTEM . 'public/frontend/bootstrap.css', array(), true );
		wp_enqueue_script( 'bootstrap_js', WEBLIZAR_A_B_SYSTEM . 'public/frontend/bootstrap.min.js', true );
		wp_enqueue_script( 'preloader_js', WEBLIZAR_A_B_SYSTEM . 'public/frontend/jquery.preloader.min.js', array( 'jquery' ), true );
		wp_enqueue_script( 'date_picker_js', WEBLIZAR_A_B_SYSTEM . 'public/frontend/date_picker.js', array( 'jquery' ), true );
		wp_enqueue_style( 'datepicker_smoothness_css', WEBLIZAR_A_B_SYSTEM . 'public/frontend/datepicker_smoothness.css', array(), true );
		wp_enqueue_script( 'notify_js', WEBLIZAR_A_B_SYSTEM . 'public/frontend/alertbox/notify.js', true );
		wp_enqueue_style( 'notify_css', WEBLIZAR_A_B_SYSTEM . 'public/frontend/alertbox/notify.css', array(), true );
		wp_enqueue_style( 'examples_css', WEBLIZAR_A_B_SYSTEM . 'public/frontend/examples.css', array(), true );
		wp_enqueue_style( 'style_03_css', WEBLIZAR_A_B_SYSTEM . 'public/frontend/style_03.css', array(), true );
		wp_enqueue_style( 'media_css', WEBLIZAR_A_B_SYSTEM . 'public/frontend/media_screen.css', array(), true );
		wp_enqueue_style( 'ap_tel', WEBLIZAR_A_B_SYSTEM . 'public/frontend/contact/intlTelInput.css', array(), true );
		wp_enqueue_script( 'ap_tel', WEBLIZAR_A_B_SYSTEM . 'public/frontend/contact/intlTelInput.js', array( 'jquery' ) );
		wp_enqueue_script( 'custom-script_js', WEBLIZAR_A_B_SYSTEM . 'public/frontend/custom-script.js', array( 'jquery' ), true );
	}

	/* Create frontend */
	public static function ap_system() {
		ob_start();
		include( "inc/appointment.php" );

		return ob_get_clean();
	}
}

?>