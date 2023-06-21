<?php
    $obj=get_queried_object();
    $id=$obj->ID;
    $common= get_common();
    $categorys=get_list_posts_by_categorys_Home();
    $news=get_news_Home(9);
    $page_infor=get_page_infor($id);
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    // echo $common;
    // $current_url=get_permalink($id);
    $data=new stdClass();
    $data->common=$common;
    $v=new stdClass();
    $v->categorys=$categorys;
    $v->news=$news;
    $data->data=$v;
   //
//    var_dump($news);
?>