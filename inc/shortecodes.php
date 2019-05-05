<?php

add_shortcode('footag', 'mpvip_order_form');
function mpvip_order_form()
{

    global $wpdb;
    $plan_order = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}vip_plans ");

    if (isset($_POST[mpvip_submitfrm])) {
        $plan = intval($_POST['plan']);
        if ($plan) {
$_SESSION['amin']='alii';
      /*  echo "<pre>";

        var_dump($_SESSION);

        echo "</pre>";*/

        } else {

            wpvip_flash_mas('ggggggggggg','hjuuuiuihig23351');

        }



    }


    /* foreach($mnb->allcaps as $mnbv=>$ncv){
         echo $mnbv."".$ncv."</br>";
     }*/

    require_once wpsvip_TPL . 'users/userform.php';
}