<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function create_page($titleS,$contentS,$statusS,$metaA){
    $my_post = array(
        'post_title'    => $titleS,
        'post_content'  => $contentS,
        'post_status'   => $statusS,
        'post_type'      => 'page',
        'meta_input'    =>array("metaA"=>$metaA,"time_cache"=>'',"data_cache"=>''),
    );
    $post_ID=wp_insert_post( $my_post );
    $object = new stdClass();

    $object->id=$post_ID;
    $object->status=$statusS;
    $data_metaA=json_decode(stripslashes($metaA));
    $object->thumnail=$data_metaA->thumnail;
    $object->short_des=$data_metaA->short_des;
    $object->long_des=$data_metaA->long_des;
    $object->title=$titleS;
    $object->link=get_permalink($post_ID);
 
    send($object);
}
function update_page($idN,$titleS,$contentS,$statusS,$metaA){
    $my_post = array(
        'ID'            =>$idN,
        'post_title'    => $titleS,
        'post_content'  => $contentS,
        'post_status'   => $statusS,
        'post_type'      => 'page',
        'meta_input'    =>array("metaA"=>$metaA,"time_cache"=>'',"data_cache"=>''),
    );
    $post_ID=wp_insert_post( $my_post );
    $object = new stdClass();

    $object->id=$post_ID;
    $object->status=$statusS;
    $data_metaA=json_decode(stripslashes($metaA));
    $object->thumnail=$data_metaA->thumnail;
    $object->short_des=$data_metaA->short_des;
    $object->long_des=$data_metaA->long_des;
    $object->title=$titleS;
    $object->link=get_permalink($post_ID);
 
    send($object);
}
if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id']; // id =-1 >create || update
        $title=$_POST['title']; // "tieu de"
        $status=$_POST['status'];
        $metaA=$_POST['metaA'];

            if($id==-1){// create new post 93
                create_page($title,'',$status,$metaA);
            }else{
                update_page($id,$title,'',$status,$metaA);
            }
 
    }else{
        $object = new stdClass();
        send($object);
    }
 
}













?>