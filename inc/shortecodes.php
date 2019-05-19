<?php

add_shortcode('footag', 'mpvip_order_form');
function mpvip_order_form()
{

    global $wpdb;
    $plan_order = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}vip_plans ");
    $current_user = wp_get_current_user();
    $current_user_wallet = get_user_meta($current_user->ID,'wallet',true);




    if (isset($_POST[mpvip_submitfrm])) {
        $plan = intval($_POST['plan']);
        $paymant = intval($_POST['online']);
        if (intval($plan)) {

            if (wpvip_is_user_vip()) {

                wpvip_flash_mas('error', 'شما قبلا یک طرح ویژه خرید کردید ...');
            } else {
                $plan_Detalis = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}vip_plans WHERE plan_ID =  %d ",$plan));
                if(isset($paymant) && $paymant=='account'){
                    if($plan_Detalis->price < $current_user_wallet){

                        wpvip_add_user_to_vip(intval($_POST['plan']));
                        $new_wallet =     wpvip_update_user_wallet($current_user->ID,$plan_Detalis->price,2);
                        $tabelbill = $wpdb->prefix . 'vip_bills';
                        $wpdb->insert($tabelbill, array(
                            'user_id' => $current_user->ID,
                            'type' => 2,
                            'amount' => $plan_Detalis->price,
                            'date'=>date("Y-m-d  h:i:s"),
                            'balance'=>$new_wallet,
                            'description'=>'خرید پنل توسط کاربر'),
                            array(
                                '%d',
                                '%d',
                                '%d',
                                '%s',
                                '%d',
                                '%s',
                            ) );
                    }else{
                        wpvip_flash_mas('error','موجودی حستب شما کافی نمی باشد');
                    }

                }

            }


        } else {

            wpvip_flash_mas('error', 'لطفا یک طرح را انتخاب کنید ...');

        }


    }


//wpvip_is_user_vip(1);
    require_once wpsvip_TPL . 'users/userform.php';
}