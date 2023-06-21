<?php
 
    $title= stripslashes(strip_tags($_GET['s']));
    $sp=get_data_search($title);
    $common= get_common();//
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $data_metaA=new stdClass();
    $current_url=$home_url;
    $data_metaA->title=$title;
    $id=-1;
    $category_parent=-1;
    $data_metaA->short_des='Kết quả tìm kiếm cho: '.$title;
    // $data_metaA->thumnail
?>
<?php

 

?>