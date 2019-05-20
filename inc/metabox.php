<?php
add_action('add_meta_boxes','mpvip_set_content_plan');
function mpvip_set_content_plan($post){
    add_meta_box('mpvip_content_plan','انتخاب محتوا برای بخش ویژه','mpvip_content_plan_callback','post');


}
function mpvip_content_plan_callback($post){

require_once wpsvip_TPL.'admin/metaboxes/content_plans.php';



}
