<?php
//FORM
add_shortcode('footag', 'mpvip_order_form');
function mpvip_order_form()
{
    global $post;
    global $wpdb;
    $plan_order = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}vip_plans ");
    $current_user = wp_get_current_user();
    $current_user_wallet = get_user_meta($current_user->ID, 'wallet', true);
    $adressuirl = add_query_arg(array('gateway' => 'paymant'), get_permalink($post->ID));


    if (isset($_POST['mpvip_submitfrm'])) {

if(isset($_POST['online_pay'])){
    $paymant = $_POST['online_pay'];
}

        $plan = intval($_POST['plan']);


        if (intval($plan)) {

            if (wpvip_is_user_vip()) {


                wpvip_flash_mas('error', 'شما قبلا یک طرح ویژه خرید کردید ...');


            } else {
                $plan_Detalis = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}vip_plans WHERE plan_ID =  %d ", $plan));
                if (isset($paymant) && $paymant == 'account') {
                    if ($plan_Detalis->price < $current_user_wallet) {

                        wpvip_add_user_to_vip(intval($_POST['plan']));
                        $new_wallet = wpvip_update_user_wallet($current_user->ID, $plan_Detalis->price, 2);
                        $tabelbill = $wpdb->prefix . 'vip_bills';
                        $wpdb->insert($tabelbill, array(
                            'user_id' => $current_user->ID,
                            'type' => 2,
                            'amount' => $plan_Detalis->price,
                            'date' => date("Y-m-d  h:i:s"),
                            'balance' => $new_wallet,
                            'description' => 'خرید پنل توسط کاربر'),
                            array(
                                '%d',
                                '%d',
                                '%d',
                                '%s',
                                '%d',
                                '%s',
                            ));


                    } else {
                        wpvip_flash_mas('error', 'موجودی حستب شما کافی نمی باشد');

                    }

                } elseif (isset($paymant) && $paymant == 'online') {
                    $paymant_rus_number = time() . $current_user->ID;
                    $_SESSION['rus_number'] = $paymant_rus_number;
                    $paymant_online = array(
                        'MerchantID' => '6030dc72-6a31-11e7-845b-000c295eb8fc',
                        'amount' => intval($plan_Detalis->price),
                        'adrresback' => $adressuirl,
                        'res_num' => $paymant_rus_number,
                        'email' => '',
                        'Mobile' => '',
                        'user_id' => $current_user->ID
                    );
                    wpvip_zarinpal_request($paymant_online);


                }

            }


        } else {

            wpvip_flash_mas('error', 'لطفا یک طرح را انتخاب کنید ...');

        }


    }

    if (isset($_GET['gateway']) && !empty($_GET['gateway']) && isset($_GET['Authority'])) {
        if ($_GET['gateway'] == 'paymant') {
            $res_num = $_SESSION['rus_number'];
            $paymant_detalis = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}vip_payment
                                                               WHERE payment_res_num=%s", $res_num));


            $param_verfy = array(
                'MerchantID' => '6030dc72-6a31-11e7-845b-000c295eb8fc',
                'amount' => intval($paymant_detalis->payment_amount),
                'Authority' => $_GET['Authority'],
                'Status' => $_GET['Status'],
                'resnum' => $res_num

            );

            $res_ver = wpvip_zarinpal_verify($param_verfy);
            if ($res_ver) {
                echo 'پرداخت شما با موفقیت انجام شد.';
                echo 'شماره پیگری شما ' . $res_ver['ref_num'];
            } else {
                echo 'پرداخت شما ناموفق بود';
                echo 'کد خطا' . $res_ver['ress_num'];
            }

        }


    }


    require_once wpsvip_TPL . 'users/userform.php';
}

//FILTER CONTENT
add_shortcode('plan_viwe', 'mpvip_viwe_content_plan');
function mpvip_viwe_content_plan($atts, $content)
{
    $arrg = shortcode_atts(array(
        'plan' => 0,

    ), $atts);
    $has_palen_viwe = mpvip_shortcod_viwe_content($arrg['plan']);
    if ($has_palen_viwe) {

        return do_shortcode($content);
    } else {
        return "شما مجاز به دسترسی به این مطلب نمی باشید";
    }


}

//DOWNLOAD
add_shortcode('wpvip_file_dl', 'mpvip_download_file_shortcode');
function mpvip_download_file_shortcode($atts, $contents)
{
    global $wpdb;
    $arrg = shortcode_atts(array(
        'id' => 0,
    ), $atts);
    $file_id = intval($arrg['id']);

    $file_item = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}vip_file
                                   WHERE ID=%d ", $file_id));
    if (!$file_item || !$file_id) {
        return 'فایل معتبر نمی باشد';
    }

    $contents = '<div><p>
<a  href="download/file/' . $file_item->hash_code . ' ">refdttrtrt</a></p></div>';

    return $contents;


}

