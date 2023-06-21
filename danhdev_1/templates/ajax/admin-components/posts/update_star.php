<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

 
// var_dump(json_decode(stripslashes($_POST['metaA']['metaA'])));

if(is_user_logged_in()){
    if($_POST){
        $idN=(int)$_POST['id']; // id =-1 >create || update
        $star=stripslashes(strip_tags($_POST['star'])); // "tieu de"
        $rs=update_post_meta($idN, 'star', $star);
        $object = new stdClass();
        if($rs){
            $object->status=true;
        }else{
            $object->status=false;
        }
        send($object);


    }else{
        $object = new stdClass();
        $object->status=false;
        send($object);
    }

}












?>