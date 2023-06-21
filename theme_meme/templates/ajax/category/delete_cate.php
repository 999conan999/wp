<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
// function delete_category($id){
//    return wp_delete_category($id);
// }

if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id'];
        $object = new stdClass();
            wp_delete_category($id);
            $object->status=true;
            send($object);
 
    }else{
        $object = new stdClass();
        $object->status=false;
        send($object);
    }
}
?>