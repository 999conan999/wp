<?php
    $obj=get_queried_object();
    $id=$obj->ID;
    $common= get_common();//
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $post_infor=get_post_infor($id);//
    $current_url=get_permalink($id);

    // $categorys=get_list_posts_by_categorys_Home();
    // $news=get_news_Home(9);
    // $page_infor=get_page_infor($id);


    // // $current_url=get_permalink($id);
    $data=new stdClass();
    $data->common=$common;
    $data->data=$post_infor;
    // $v=new stdClass();
    // $v->categorys=$categorys;
    // $v->news=$news;
    // $data->data=$v;
   //
//    var_dump(($post_infor->contents));
?>