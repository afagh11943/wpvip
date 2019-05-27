<?php
if (!function_exists('dd')) {
    function dd($data)
    {

        echo '<pre>';
        var_dump($data);
        echo '</pre>';


    }
}
function wpvip_persian_date($date)
{
    if (!function_exists('parsidate'))
        return $date;
    return parsidate("Y/m/d", $date, 'per');
}

function wpvip_send_email($params = array())
{
    $headers = array();
    // $headers[] = 'From: 7learn.com <info@7learn.com>';
    // $headers[] = 'Content-Type: text/html; charset=UTF-8';
    wp_mail($params['to'], $params['subject'], $params['message'], $headers);
}

function wpvip_send_sms($params = array())
{
    !class_exists('farapayamak') ? require_once WPVIP_LIBS . 'farapayamak.class.php' : null;
    $fp = new farapayamak();
    $fp->user = "5689452";
    $fp->pass = "6546554";
    $fp->from = "100020003000";
    $fp->to = $params['to'];
    $fp->msg = $params['msg'];
    $fp->send_sms();
}

//users
function wpvip_get_user_wallet($userID)
{
    if (intval($userID) > 0) {
        return intval(get_user_meta($userID, 'wallet', true));
    }
}

function wpvip_update_user_wallet($userID, $amount, $type)

{

    if (intval($userID) > 0) {
        $wallet = wpvip_get_user_wallet($userID);
        $new_wallet = null;
        if (intval($type == 1)) {
            $new_wallet = $wallet + intval($amount);
        }
        if (intval($type == 2)) {
            $new_wallet = $wallet - intval($amount);
        }

        if ($new_wallet >= 0) {
            update_user_meta($userID, 'wallet', intval($new_wallet));
        }


        return intval($new_wallet);
    }
}

function wpvip_is_user_vip($userID = null)

{
    $current_user = wp_get_current_user();
    $userID = intval($userID) ? $userID : $current_user->ID;

    if (!intval($current_user->ID)) {
        return false;
    }

    global $wpdb;
    $result = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->prefix}vip_users
                                               WHERE user_id= %d", $userID));
    return intval($result) ? true : false;


}

function wpvip_add_user_to_vip($planid, $userid = null)
{
    global $wpdb;

    $current_user = wp_get_current_user();
    $userid = intval($userid) ? $userid : $current_user->ID;
    $tabalname = $wpdb->prefix . 'vip_users';


    if (!intval($current_user->ID)) {
        return false;
    }
    if (!intval($planid)) {
        return false;
    }

    $plan = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}vip_plans
                                WHERE 	plan_ID = %d
                                LIMIT 1", $planid));
    if (intval($plan)) {
        $plan_expir_date = $plan->credit;
        $current_date = new DateTime();
        $expir_date = $current_date->add(new DateInterval('P' . $plan_expir_date . 'D'));
        $wpdb->insert($tabalname, array(
            'plan_id' => $planid,
            'user_id' => $userid,
            'expire_date' => $expir_date->format('Y-m-d  H:i:s')
        ), array(
                '%d',
                '%d',
                '%s'
            )

        );

    }

}

function wpvip_get_post_plan($postid)
{
    if (!intval($postid)) {
        return false;
    }
    return intval(get_post_meta($postid, 'plan', true));
}

function wpvip_user_can_you_post($postid, $userid)
{
    global $wpdb;
    $post_plans = wpvip_get_post_plan($postid);
    if ($post_plans) {

        $user_plans = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->prefix}vip_users
                                                       WHERE user_id = %d AND plan_id = %d  LIMIT 1 ", $userid, $post_plans));
        return intval($user_plans) ? true : false;

    }
    return true;
}

function mpvip_shortcod_viwe_content($planid)
{
    $cuurent_user = wp_get_current_user();
    global $wpdb;
    if (!intval($planid) || !intval($cuurent_user->ID) || intval($cuurent_user->ID) == 0) {
        return false;
    }
    $has_plans = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->prefix}vip_users
                                                WHERE user_id = %d AND plan_id = %d  LIMIT 1 ", $cuurent_user->ID, $planid));
    return $has_plans ? true : false;
}

//reagister style
add_action('wp_enqueue_scripts', 'wpvip_add_user_style');
function wpvip_add_user_style()
{
    wp_register_style('wp_enqueue_scripts', wpsvip_CSS . 'user.css');
    wp_enqueue_style('wp_enqueue_scripts');
}

//message error and ok
function wpvip_flash_mas($type = null, $message = null)
{
    if (isset($type) && isset($message)) {
        $_SESSION['mpvip']['flash']['type'] = $type;
        $_SESSION['mpvip']['flash']['message'] = $message;


    } else {
        if (isset($_SESSION['mpvip']['flash']['type']) && isset($_SESSION['mpvip']['flash']['message'])) {
            $type = $_SESSION['mpvip']['flash']['type'];
            $message = $_SESSION['mpvip']['flash']['message'];
            echo '<div class="' . $type . '"><p>' . $message . '</p></div>';

            unset($_SESSION['mpvip']);

            //     $_SESSION['mpvip']['flash'] = array();

        }
    }


}

//fillter
add_filter('the_content', 'wpvip_filter_contents_plans');
function wpvip_filter_contents_plans($content)
{
    global $post;
    $cuurent_user = wp_get_current_user();
    $can_viwe_post = wpvip_user_can_you_post($post->ID, $cuurent_user->ID);
    if ($can_viwe_post == true) {
        return $content;
    } else {
        return 'شما ثادر به دیدن این پست نیستید';
    }

}
//files
function wpvip_show_file_size($size){
    if($size == 0 || $size < 1024)
        return $size .' Byte';
    if($size < 1024 * 1024 )
        return ceil($size / 1024)  .' KB ';
    if($size > 1024 * 1024 && $size < 1024 * 1024 * 1024 )
        return ceil($size / 1024 * 1024) .' MB';

}







