<?php

add_shortcode('footag', 'mpvip_order_form');
function mpvip_order_form()
{

    global $wpdb;
    $plan_order = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}vip_plans ");


    if (isset($_POST[mpvip_submitfrm])) {
        $plan = intval($_POST['plan']);
        if ($plan) {

            if (wpvip_is_user_vip(8)) {

                wpvip_flash_mas('error', 'شما قبلا یک طرح ویژه خرید کردید ...');
            } else {
                wpvip_add_user_to_vip(intval($_POST['plan']));
            }


        } else {

            wpvip_flash_mas('error', 'لطفا یک طرح را انتخاب کنید ...');

        }


    }


//wpvip_is_user_vip(1);
    require_once wpsvip_TPL . 'users/userform.php';
}