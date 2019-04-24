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
    $succsess = false;
    $error = false;
    $masege = "اطلاعات با موفقست ذخیره کردید.";
    $tabalname = $wpdb->prefix . 'vip_plans';
    switch ($action) {
        case 'edit':

            if (isset($_POST['submit'])) {
                $titel = sanitize_text_field($_POST['titel']);
                $price = intval($_POST['price']);
                $cerdit = intval($_POST['cerdit']);
                $plan_ID = intval($_POST['plan_ID']);
                if (intval($plan_ID)) {
                    $wpdb->update(
                        $tabalname,
                        array(
                            'titel' => $titel,
                            'price' => $price,
                            'credit' => $cerdit
                        ),
                        array('plan_ID' => $plan_ID),
                        array(
                            '%s',    // value1
                            '%d',    // value2
                            '%d',    // value2
                        ),
                        array('%d')
                    );

                } else {
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
                $succsess = true;
                $masege = "اطلاعات با موفقست ذخیره کردید.";


            }
            if ($item_id) {
                $plan_edit = $wpdb->get_row($wpdb->prepare("SELECT *  FROM {$tabalname} WHERE plan_ID=%d", $item_id));

            }
            require_once wpsvip_TPL . 'admin/plans/edit.php';
            break;
        case 'delete':
            $wpdb->delete($tabalname, array('plan_ID' => $item_id), array('%d'));
            require_once wpsvip_TPL . 'admin/plans/plans.php';
            break;
        default:
            $plans = $wpdb->get_results("SELECT * FROM  {$tabalname}");

            require_once wpsvip_TPL . 'admin/plans/plans.php';
            break;

    }
}