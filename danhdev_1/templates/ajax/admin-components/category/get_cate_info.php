<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_infor_category($id){
    $id=(int)$id;
    $cat = get_category( $id);
    $object = new stdClass();
    $object->id=$id;
    $object->title=$cat->name;
    $metaA=get_term_meta($id,'metaA', true);
    if($metaA!=''){
        $data_metaA=json_decode($metaA["metaA"]);
        $object->long_des=$data_metaA->long_des;
        $object->price=$data_metaA->price;
        $object->thumnail=$data_metaA->thumnail;
        $object->cart_sp=$data_metaA->cart_sp;
        $object->slide_sort=$data_metaA->slide_sort;
        $object->short_des=$data_metaA->short_des;
       }else{
        $object->price='0';
        $object->long_des='';
        $object->img='';
        $object->cart_sp=array();
        $object->slide_sort=array();
        $object->short_des='';
       }
       send($object);
 
}
if(is_user_logged_in()){
        if($_GET){
            if(isset($_GET['id'])){
                $id=abs((int)stripslashes(strip_tags( $_GET['id'])));
                   get_infor_category($id);
            }else{
                $object = new stdClass();
                send($object);
             }
        }
}



?>