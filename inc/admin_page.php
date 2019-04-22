<?php
function mpvip_dashbord()
{
    require_once wpsvip_TPL . 'admin/dashboard/dashboard.php';
}

function mpvip_plans_page()
{
    $action = isset($_GET['action']) && !empty($_GET['action']) && ctype_alpha($_GET['action']) ? $_GET['action'] : null;
    global $wpdb;
    $tabalname = $wpdb->prefix . 'vip_plans';
    switch ($action) {
        case 'edit':
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