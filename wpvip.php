<?php
/*
Plugin Name: افزونه عضویت ویژه کاربران
Plugin URI: http://amin.com
Description: پلاگینی جهت ایجاد عضویت ویژه برای کاربران سایت
Author: aminkhalili
Version: 1.0.0
Author URI:  http://amin.com
*/
//const path & url
defined( 'ABSPATH' ) || exit( 'NO ACCESS' );
define( 'wpsvip_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'wpsvip_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'wpsvip_INC', trailingslashit( wpsvip_DIR . 'inc' ) );
define( 'wpsvip_TPL', trailingslashit( wpsvip_DIR . 'tpl' ) );
define('WPVIP_LIBS',trailingslashit(wpsvip_INC.'libs'));
define( 'wpsvip_CSS', trailingslashit( wpsvip_URL . 'assets' . '/' . 'css' ) );
define( 'wpsvip_JS', trailingslashit( wpsvip_URL . 'assets' . '/' . 'js' ) );
define( 'wpsvip_IMAGES', trailingslashit( wpsvip_URL . 'assets' . '/' . 'images' ) );
define( 'wpsvip_FONTS', trailingslashit( wpsvip_URL . 'assets' . '/' . 'fonts' ) );
define( 'wpsvip_DB_VERSION', 1 );




add_action('init','wpwip_bufer');

function wpwip_bufer(){
	ob_start();
}



//activate & deactivation hook
function wpsvip_activate() {

}

function wpsvip_deactivate() {
}

register_activation_hook( __FILE__, 'wpsvip_activate' );
register_deactivation_hook( __FILE__, 'wpsvip_deactivate' );



require_once wpsvip_INC . "front_end.php";
require_once wpsvip_INC . "shortecodes.php";
if ( is_admin() ) {
	require_once wpsvip_INC . "admin_menu.php";
	require_once wpsvip_INC . "admin_page.php";
	require_once wpsvip_INC . "back_end.php";
}