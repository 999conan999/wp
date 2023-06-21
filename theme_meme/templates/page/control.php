<?php

    $common= get_common();//
    $typez='page';
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $metaA=get_post_meta($id,'metaA', true);
    $data_metaA=json_decode($metaA);
    if($data_metaA==NULL){
        header("Location: ".$home_url,TRUE,301);
        die();
    }else{
        if (!property_exists($data_metaA, 'title')) {
            header("Location: ".$home_url,TRUE,301);
            die();
        }
    }
    $current_url=get_permalink($id);
    $category_parent=-1;// khong tac dung gi ca

?>