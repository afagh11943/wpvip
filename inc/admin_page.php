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
    $masege = "اطلاعات با موفقیت ذخیره کردید.";
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
            wp_redirect(admin_url('admin.php?page=wpvip_admin_plans'));
            exit();
            break;
        default:
            $plans = $wpdb->get_results("SELECT * FROM  {$tabalname}");

            require_once wpsvip_TPL . 'admin/plans/plans.php';
            break;

    }
}

function mpvip_user_page()
{
    $action = isset($_GET['action']) && !empty($_GET['action']) && ctype_alpha($_GET['action']) ? $_GET['action'] : null;
    $usid = isset($_GET['usid']) && ctype_digit($_GET['usid']) ? intval($_GET['usid']) : null;
    global $wpdb;
    $succsess = false;
    $error = false;
    $masege = "اطلاعات با موفقیت ذخیره کردید.";
    $tabalname = $wpdb->prefix . 'vip_users';

    switch ($action) {
        case'delete':
            if (intval($usid)) {
                $wpdb->delete($tabalname, array('user_id' => $usid), array('%d'));
                wp_redirect(admin_url('admin.php?page=wpvip_admin_users'));
                exit();

            }
            break;

        case'new':
            $users = $wpdb->get_results("SELECT ID,display_name FROM {$wpdb->users}");
            $plans = $wpdb->get_results("SELECT plan_ID,titel FROM {$wpdb->prefix}vip_plans");

            if (isset($_POST['submit'])) {
                $user_id = intval($_POST['user-id']);
                $plans_id = intval($_POST['plan-id']);
                $credit = intval($_POST['credit']);

            }

            if (intval($usid)) {


            } else {
                $wpdb->insert($tabalname, array(
                    'user_id' => $user_id,
                    'plan_id' => $plans_id,
                    'expire_date' => date("Y-m-d H:i:s", strtotime("+ {$credit} days"))
                ), array(
                        '%d',
                        '%d',
                        '%s'
                    )

                );

            }
            require_once wpsvip_TPL . 'admin/users/new.php';
            break;

        default:
            $wp_users = $wpdb->get_results("SELECT u.*,vu.*,vp.titel
 FROM {$wpdb->users} u
 JOIN {$tabalname} vu
 ON u.ID = vu.user_id
 JOIN {$wpdb->prefix}vip_plans vp
 ON vu.plan_ID = vp.plan_ID
 ");

            require_once wpsvip_TPL . 'admin/users/user.php';
            break;
    }
}