<?php
function mpvip_dashbord()
{
    include wpsvip_TPL . 'admin/dashboard/dashboard.php';
}

function mpvip_plans_page()
{
    $action = isset($_GET['action']) && !empty($_GET['action']) && ctype_alpha($_GET['action']) ? $_GET['action'] : null;
    global $wpdb;

    switch ($action) {
        case 'edit':
            if (isset($_POST['submit'])) {
                $titel = sanitize_text_field($_POST['titel']);
                $price = intval($_POST['price']);
                $cerdit = intval($_POST['cerdit']);

             $nb =   $wpdb->insert($wpdb->prefix.'vip_plans', array(
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

            include wpsvip_TPL . 'admin/plans/edit.php';
            break;
        case 'asl':
            include wpsvip_TPL . 'admin/plans/plans.php';
            break;

        default:
            include wpsvip_TPL . 'admin/plans/plans.php';

    }
}