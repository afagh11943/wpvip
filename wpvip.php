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
$wpsvip_uploud = wp_upload_dir();


defined('ABSPATH') || exit('NO ACCESS');
define('wpsvip_DIR', trailingslashit(plugin_dir_path(__FILE__)));
define('wpsvip_URL', trailingslashit(plugin_dir_url(__FILE__)));
define('wpsvip_INC', trailingslashit(wpsvip_DIR . 'inc'));
define('wpsvip_TPL', trailingslashit(wpsvip_DIR . 'tpl'));
define('WPVIP_LIBS', trailingslashit(wpsvip_INC . 'libs'));
define('wpsvip_CSS', trailingslashit(wpsvip_URL . 'assets' . '/' . 'css'));
define('wpsvip_JS', trailingslashit(wpsvip_URL . 'assets' . '/' . 'js'));
define('wpsvip_IMAGES', trailingslashit(wpsvip_URL . 'assets' . '/' . 'images'));
define('wpsvip_FONTS', trailingslashit(wpsvip_URL . 'assets' . '/' . 'fonts'));
define('wpsvip_uploud_dir', trailingslashit($wpsvip_uploud['basedir'] . DIRECTORY_SEPARATOR . 'WPVIP'));
define('wpsvip_uploud_url', trailingslashit($wpsvip_uploud['baseurl'] . '/' . 'WPVIP'));


//echo wpsvip_uploud-files;

define('wpsvip_DB_VERSION', 1);

global $post;
var_dump($post);
add_action('init', 'wpwip_bufer');

function wpwip_bufer()
{
    ob_start();
}


//activate & deactivation hook
function wpsvip_activate()
{

}

function wpsvip_deactivate()
{
}

register_activation_hook(__FILE__, 'wpsvip_activate');
register_deactivation_hook(__FILE__, 'wpsvip_deactivate');




require_once wpsvip_INC . "front_end.php";


if (is_admin()) {
    require_once wpsvip_INC . "admin_menu.php";
    require_once wpsvip_INC . "admin_page.php";
    require_once wpsvip_INC . "back_end.php";
    require_once wpsvip_INC . "metabox.php";

} else {
    require_once wpsvip_INC . "shortecodes.php";
}
global $post;



//rewrite_rules
add_action('init', function () {

    add_rewrite_rule( '(.+)?download/file/([^/].+)/?', 'index.php?pagename=$matches[1]&hashfile=$matches[2]', 'top' );
    flush_rewrite_rules();

  if (intval(get_option('wpvip_rewrite_rule')) == 0) {

    update_option('wpvip_rewrite_rule', 1);

    }

});


add_filter('query_vars', function ($vars) {
    $vars[] = "hashfile";
    $vars[] = "pagename";
    return $vars;
});

function change_post_per_page_wpent($query)
{
    if (isset($query->query_vars['hashfile'])) {
        $file_hash_code = $query->query_vars['hashfile'];
        wpvip_handler_download($file_hash_code);
    }

    return $query;
}

add_action('parse_request', 'change_post_per_page_wpent');

function wpvip_handler_download($file_hash_code)
{
    !empty($file_hash_code) || exit;
    global $wpdb;
    $file_item = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}vip_file
                                              WHERE hash_code=%s", $file_hash_code));
    if ($file_item) {
        $file_name = $file_item->file_name;

        $file_patch = wpsvip_uploud_dir . $file_name;


        wpvip_download_file($file_patch, $file_item->ID);

    };

}


