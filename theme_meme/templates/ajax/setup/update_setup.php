<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

if(is_user_logged_in()){
    if($_POST){
        $name=$_POST['name']; // teen option
        $value=$_POST['value']; // teen option
        if(get_option($name)==false){
            // tao moi vi chua co
            $rs=add_option($name,$value,'','no');
            $object = new stdClass();
            $object->status=$rs;
            send($object);
        }else{
            // da co roi, chi can update
            $rs=update_option($name,$value);
            $object = new stdClass();
            $object->status=$rs;
            send($object);
        }
    }
}
?>