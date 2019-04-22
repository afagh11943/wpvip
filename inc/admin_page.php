<?php
function mpvip_dashbord()
{
    require_once wpsvip_TPL . 'admin/dashboard/dashboard.php';
}

function mpvip_plans_page()
{
    $action = isset($_GET['action']) && !empty($_GET['action']) && ctype_alpha($_GET['action']) ? $_GET['action'] : null;
    $item_id = isset($_GET['item-id']) && ctype_digit($_GET['item-id']) ? intval($_GET['item-id']) : null;
    global $wpdb;

    $tabalname = $wpdb->prefix . 'vip_plans';
    switch ($action) {
        case 'edit':
if($item_id){
    $plan_edit = $wpdb->get_row($wpdb->prepare("SELECT *  FROM {$tabalname} WHERE plan_ID=%d",$item_id));

}
            if (isset($_POST['submit'])) {
                $titel = sanitize_text_field($_POST['titel']);
                $price = intval($_POST['price']);
                $cerdit = intval($_POST['cerdit']);

                $nb = $wpdb->insert($tabalname, array(
                    'titel' => $titel,
                    'price' => $price,
                    'credit' => $cerdit
                ), array(
                        '%s',
                        '%d',
                        '%d'
                    )

                );

            }

            require_once wpsvip_TPL . 'admin/plans/edit.php';
            break;

        default:
            $plans = $wpdb->get_results("SELECT * FROM  {$tabalname}");

            require_once wpsvip_TPL . 'admin/plans/plans.php';
            break;

    }
}