<?php
defined( 'ABSPATH' ) or die();

class WL_ABS_Language {
	public static function load_translations() {
		load_plugin_textdomain( WL_ABS_SYSTEM, false, basename( WL_ABS_PLUGIN_DIR_PATH ) . '/languages/' );
	}
}