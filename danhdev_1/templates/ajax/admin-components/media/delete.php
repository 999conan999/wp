<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );

    function delete_img_by_id($id){
        $name= explode("uploads",get_post_meta( $id, '_wp_attached_file', true ));
        $uploads = wp_get_upload_dir();
        $file = $uploads['basedir'] . $name[1];
        wp_delete_file($file);
        $rs_delete_attach= wp_delete_attachment($id,false);
        if($rs_delete_attach!=NULL){
            $object = new stdClass();
            $object->status=true;
            $object->id=$id;
            return $object;
        }else{
            $object = new stdClass();
            $object->status=false;
            $object->id=$id;
            return $object;
        }
 
    }
    if(is_user_logged_in()){
        if($_POST){
            $idN=(int)$_POST['idN'];
            send(delete_img_by_id($idN));
        }
    }