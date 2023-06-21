<?php
    $title= stripslashes(strip_tags($_GET['s']));
    $sp=get_data_search($title);
    $is_show_bot=count($sp)>5?true:false;
    $common= get_common();//
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $obj=new stdClass();
    $obj->sp=$sp;
    $obj->title=$title;
    $data=new stdClass();
    $data->common=$common;
    $data->data=$obj;
?>