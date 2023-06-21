<?php
    if($_GET){
        //dm="ID danh muc" && dt="ID bai viet"
        //p="order"
        //else page cate
        // $dm=$_GET['dm'];
        // $dt=$_GET['dt'];
        // $p=$_GET['p']="order;
        if(!empty($_GET['dm'])&&!empty($_GET['dt'])){
            require_once(get_stylesheet_directory().'/templates/page/qc/qc_detail.php');
        }elseif(!empty($_GET['p'])){
            require_once(get_stylesheet_directory().'/templates/page/qc/qc_order.php');
        }else{
            require_once(get_stylesheet_directory().'/templates/page/qc/qc_home.php');
        }

    }else{
        require_once(get_stylesheet_directory().'/templates/page/qc/qc_home.php');
    }
?>
 