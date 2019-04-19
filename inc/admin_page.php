<?php
function mpvip_dashbord(){
include wpsvip_TPL.'admin/dashboard/dashboard.php';
}
function mpvip_plans_page(){
	$action =isset($_GET['action'])&&!empty($_GET['action']) && ctype_alpha($_GET['action'])?$_GET['action']:null;
	switch ($action){
		case 'edit':
			include wpsvip_TPL.'admin/plans/edit.php';
			break;

		default:
			include wpsvip_TPL.'admin/plans/plans.php';
			break;
	}
}