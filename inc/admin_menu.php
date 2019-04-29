<?php
add_action( 'admin_menu', 'wp_add_admin_menu' );
function wp_add_admin_menu() {
	add_menu_page( 'کار بران ویژه', 'کاربران ویژه ', 'manage_options', 'wpvip_admin', 'mpvip_dashbord', 'dashicons-groups' );
	add_submenu_page( 'wpvip_admin', 'داشبورد', 'داشبورد', 'manage_options', 'wpvip_admin', 'mpvip_dashbord' );
	add_submenu_page( 'wpvip_admin', 'محصولات', 'محصولات', 'manage_options', 'wpvip_admin_plans', 'mpvip_plans_page' );
	add_submenu_page( 'wpvip_admin', 'کاربران', 'کاربران', 'manage_options', 'wpvip_admin_users', 'mpvip_user_page' );
	add_style_css();
}

function add_style_css(){
	wp_register_style('wpsvip_admin_css',wpsvip_CSS.'admin.css');
	wp_enqueue_style('wpsvip_admin_css');
}




