<?php
if (!function_exists('dd')) {
    function dd($data)
    {

        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        exit();

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

//message error and ok
function wpvip_flash_mas($type = null, $message = null)
{
    if (isset($type) && isset($message)) {
        $_SESSION['mpvip']['flash']['type'] = $type;
        $_SESSION['mpvip']['flash']['message'] = $message;


    }else{
        if(isset( $_SESSION['mpvip']['flash']['type']) && isset($_SESSION['mpvip']['flash']['message'])){
            $type = $_SESSION['mpvip']['flash']['type'];
            $message = $_SESSION['mpvip']['flash']['message'];
           echo '<div class="'.$type.'"><p>'.$message.'</p></div>';

$_SESSION['mpvip']['flash'] = array();

        }
    }


}





