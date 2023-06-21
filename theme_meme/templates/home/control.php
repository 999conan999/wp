<?php

    $common= get_common();//
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $metaA=get_post_meta($id,'metaA', true);
    $data_metaA=json_decode($metaA);
    $current_url=get_permalink($id);
    $category_parent=-1;// khong tac dung gi ca

?>