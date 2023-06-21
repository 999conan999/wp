<?php

    $common= get_common();//
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $metaA=get_term_meta($id,'metaA', true);
    if(!$is_old_theme){
        $data_metaA=json_decode($metaA);
    }else{
        $data_metaA=json_decode($metaA["metaA"]);
        $data_metaA->title=$obj->name;
        $typez='old_cate';
    }
    $current_url=get_category_link($id);
  

?>