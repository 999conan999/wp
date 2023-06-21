<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id'];
        $type=$_POST['type'];
        // delete_post_by_id($idN);
        $rs=false;
        if($type=='page'||$type=='post'){
           $rs= update_post_meta( $id, 'time_cache', '');
        }elseif($type=='category'){
            $rs= update_term_meta( $id, 'time_cache', '');
        }elseif($type=='home'){
            if(get_option('cache_home_meme_theme')==false){
                $rs=false;
            }else{
                // da co roi, chi can update
                $rs=update_option('cache_home_meme_theme','');
            }
        }
        if($rs){
            $object = new stdClass();
            $object->status=true;
            send($object);
        }else{
            $object = new stdClass();
            $object->status=false;
            send($object);
        }
    }else{
        $object = new stdClass();
        $object->status=false;
        send($object);
    }
}
?>