<?php
    $obj=get_queried_object();
    $id=$obj->term_id;
    $common= get_common();//
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $post_infor=get_category_infor($id);//
    $current_url=$post_infor->phu->category_link;
 
    $data=new stdClass();
    $data->common=$common;
    $data->data=$post_infor;
// //    var_dump(($post_infor->contents));
?>