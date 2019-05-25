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
    $tabalname = $wpdb->prefix . 'vip_users';
    $tabelbill = $wpdb->prefix . 'vip_bills';

    switch ($action) {
        case'delete':
            if (intval($usid)) {
                $wpdb->delete($tabalname, array('ID' => $usid), array('%d'));
                $curent_user = wp_get_current_user();


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
        case'edit':
            if (isset($_POST['submit'])) {
                $type = intval($_POST['type']);
                $credit = intval($_POST['credit']);
                $uid = intval($_POST['uid']);
                $mysql_date_type = $type == 1 ? DATE_ADD : DATE_SUB;
                $wpdb->query($wpdb->prepare("UPDATE {$tabalname}
                                             SET expire_date = {$mysql_date_type}(expire_date,INTERVAL %d DAY)
                                             WHERE ID=%d", $credit, $uid));

                wp_redirect(admin_url('admin.php?page=wpvip_admin_users'));
                exit;

            }
            require_once wpsvip_TPL . 'admin/users/edit.php';
            break;

        case'balanc':

            if (isset($_POST['submit'])) {
                $type = intval($_POST['type']);
                $userid = intval($_POST['uid']);
                $amount = intval($_POST['amount']);
                if (!intval($type)) {
                    break;
                }

                $new_wallet = wpvip_update_user_wallet($userid, $amount, $type);
                if (intval($userid) && $new_wallet >= 0) {


                    $wpdb->insert($tabelbill, array(
                        'user_id' => $userid,
                        'type' => $type,
                        'amount' => $amount,
                        'date' => date('Y-m-d h:i:s'),
                        'balance' => $new_wallet,
                        'description' => 'تغییر موجودی توسط مدیر سایت'),
                        array(
                            '%d',
                            '%d',
                            '%d',
                            '%s',
                            '%d',
                            '%s',
                        ));
                }

            }

            require_once wpsvip_TPL . 'admin/users/balanc.php';
            break;


        default:
            $wp_users = $wpdb->get_results("SELECT U.*, u.ID AS idasli,vu.*,vp.titel
 FROM {$wpdb->users} u
  JOIN {$tabalname} vu
 ON u.ID = vu.user_id
  JOIN {$wpdb->prefix}vip_plans vp
 ON vu.plan_ID = vp.plan_ID
 ");
            /*  echo'<pre>';
              var_dump($wp_users);
              echo'</pre>';*/


            require_once wpsvip_TPL . 'admin/users/user.php';
            break;
    }
}

function mpvip_bills_page()
{
    global $wpdb;
    $pagenum = isset($_GET['pagenum']) ? absint($_GET['pagenum']) : 1;
    $limit = 3; // number of rows in page
    $offset = ($pagenum - 1) * $limit;
    $billo = $wpdb->get_results("SELECT b.*,u.display_name
                         FROM {$wpdb->prefix}vip_bills b
                         JOIN {$wpdb->users} u
                         ON b.user_id=u.ID
                    ");

    $total = count($billo);

    $num_of_pages = ceil($total / $limit);
    $bills = $wpdb->get_results("SELECT b.*,u.display_name
                         FROM {$wpdb->prefix}vip_bills b
                         JOIN {$wpdb->users} u
                         ON b.user_id=u.ID

                       LIMIT  $offset,$limit
                        ");


    require_once wpsvip_TPL . 'admin/bills/bills.php';
}

function mpvip_files_page()
{
    $action = isset($_GET['action']) && !empty($_GET['action']) && ctype_alpha($_GET['action']) ? $_GET['action'] : null;

    switch ($action) {
        case'filenew':
            require_once wpsvip_TPL . 'admin/file/new_file.php';
            break;

        default:
          dd(wp_upload_dir());
            require_once wpsvip_TPL . 'admin/file/files.php';
            break;

    }


}