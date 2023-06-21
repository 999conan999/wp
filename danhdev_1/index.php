<?php 
if($_GET['p']=='order'){

    $common= get_common();//
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $current_url=$home_url;
    $url_og=$current_url;
    $post_infor= new stdClass();
    $contents= new stdClass();
    $phu= new stdClass();
    $contents->title='Trang đặt hàng, thanh toán đơn hàng.';
    $contents->short_des='Trang đặt hàng.';
    $post_infor->contents=$contents;
    $phu->thumnail=$common->header->logo ;
    $post_infor->phu=$phu;

    require_once(get_stylesheet_directory().'/templates/page/qc/qc_order.php');
}else{
    require_once(get_stylesheet_directory().'/templates/404/404.php'); 
}

?>