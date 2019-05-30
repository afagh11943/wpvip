<?php
function wpvip_zarinpal_request($params = array())
{
    global $wpdb;
    $MerchantID = $params['MerchantID']; //Required
    $Amount = $params['amount'] / 10; //Amount will be based on Toman - Required
    $Description = 'توض?حات تراکنش تست?'; // Required
    $Email = $params['email'];// Optional
    $Mobile = $params['mobile']; // Optional
    $CallbackURL = $params['adrresback']; // Required


    $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

    $result = $client->PaymentRequest(
        [
            'MerchantID' => $MerchantID,
            'Amount' => $Amount,
            'Description' => $Description,
            'Email' => $Email,
            'Mobile' => $Mobile,
            'CallbackURL' => $CallbackURL,
        ]
    );


//Redirect to URL You can do it also by creating a form
    if ($result->Status == 100) {
        $wpdb->insert($wpdb->prefix . 'vip_payment', array(
            'payment_usser_id' => $params['user_id'],
            'payment_amount' => $params['amount'],
            'payment_res_num' => $params['res_num'],
            'payment_date' => date('Y-m-d H:i:s'),

        ), array('%d', '%d', '%s', '%s'));


        Header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);

    } else {
        echo 'ERR: ' . $result->Status;
    }
}

function wpvip_zarinpal_verify($params = array())
{
    $MerchantID = $params['MerchantID'];
    $Amount = $params['amount'] / 10; //Amount will be based on Toman
    $Authority = $params['Authority'];
    global $wpdb;

    if ($params['Status'] == 'OK') {

        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentVerification(
            [
                'MerchantID' => $MerchantID,
                'Authority' => $Authority,
                'Amount' => $Amount,
            ]
        );

        if ($result->Status == 100) {
            $wpdb->update($wpdb->prefix . 'vip_payment', array(
                'payment_ref_num' => $Authority,
                'payment_status' => 1
            ), array('payment_res_num' => $params['resnum']), array(
                '%s', '%d'
            ), array('%s'));
            return array(
                'status' => true,
                'ref_num' => $result->RefID
            );

        } else {
            return array(
                'status' => false,
                'ress_num' => $result->Status
            );


        }
    } else {
        return array(
            'status' => false,
            'cancel_by_user' => true
        );
    }
}

