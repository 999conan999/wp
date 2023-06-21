<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
function delete_post_by_id($id){
    wp_delete_post($id,false);
    $object = new stdClass();
    $object->status=true;
    send($object);
}

if(is_user_logged_in()){
    if($_POST){
        $idN=(int)$_POST['id'];
        delete_post_by_id($idN);
    }else{
        $object = new stdClass();
        $object->status=false;
        send($object);
    }
}
?>