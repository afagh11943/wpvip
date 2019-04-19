<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

//remove tables from database
global $wpdb;
$vip_bills = $wpdb->prefix.'vip_bills';
$vip_plans = $wpdb->prefix.'vip_plans';
$vip_users = $wpdb->prefix.'vip_users';
$wpdb->query("DROP TABLE IF EXISTS {$vip_bills}");
$wpdb->query("DROP TABLE IF EXISTS {$vip_plans}");
$wpdb->query("DROP TABLE IF EXISTS {$vip_users}");

