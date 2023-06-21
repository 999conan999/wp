<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;


if(is_user_logged_in()){

    if($_GET){
        if(isset($_GET['name'])){
            $name_optipon=(stripslashes(strip_tags( $_GET['name'])));
            $value=get_option($name_optipon);
            $object = new stdClass();
            if($value!=false){
                $object->status=true;
                $data=json_decode(stripslashes($value));
                $object->data=$data;
                send($object);
            }else{
                $object->status=false;
                send($object);
            }
        }
    }
}

?>