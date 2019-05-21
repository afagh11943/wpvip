<?php
add_action('add_meta_boxes','mpvip_set_content_plan');
add_action( 'save_post', 'mpvip_set_content_plan_save' );
function mpvip_set_content_plan($post){
    add_meta_box('mpvip_content_plan','انتخاب محتوا برای بخش ویژه','mpvip_content_plan_callback','post');


}
function mpvip_content_plan_callback($post){
    global $wpdb;
    $postid = $post->ID;
    $tabelname_plans =$wpdb->prefix.'vip_plans' ;
    $plans = $wpdb->get_results("SELECT * FROM {$tabelname_plans}");
    $wpvip_cuurent_post_vip = intval(get_post_meta($postid,'plan',true));


require_once wpsvip_TPL.'admin/metaboxes/content_plans.php';



}

    function mpvip_set_content_plan_save($postid){
        if(isset($_POST['mpvip_plane']) ){
            
        }

}
