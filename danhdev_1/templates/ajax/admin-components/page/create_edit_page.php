<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function create_page($titleS,$contentS,$statusS,$metaA){
    $my_post = array(
        'post_title'    => $titleS,
        'post_content'  => $contentS,
        'post_status'   => $statusS,
        'post_type'      => 'page',
        'meta_input'    =>$metaA
    );
    $post_ID=wp_insert_post( $my_post );
    $object = new stdClass();
    $object->id=$post_ID;
    $object->status=$statusS;
    $data_metaA=json_decode(stripslashes($metaA['metaA']));
    $object->img=$data_metaA->thumnail;
    $object->title=$titleS;
    $object->url=get_permalink($post_ID);
    if(property_exists($data_metaA, 'type')){
        $type=$data_metaA->type;
    }else{
        $type='bv';
    }
    $object->type=$type;
    send($object);
}
function update_page($idN,$titleS,$contentS,$statusS,$metaA){
    $my_post = array(
        'ID'            =>$idN,
        'post_title'    => $titleS,
        'post_content'  => $contentS,
        'post_status'   => $statusS,
        'post_type'      => 'page',
        'meta_input'    =>$metaA
    );
    $post_ID=wp_insert_post( $my_post );
    $object = new stdClass();
    $object->id=$post_ID;
    $object->status=$statusS;
    $data_metaA=json_decode(stripslashes($metaA['metaA']));
    $object->img=$data_metaA->thumnail;
    $object->title=$titleS;
    $object->url=get_permalink($post_ID);
    if(property_exists($data_metaA, 'type')){
        $type=$data_metaA->type;
    }else{
        $type='bv';
    }
    $object->type=$type;
    send($object);
}
if(is_user_logged_in()){
    if($_POST){
        $idN=(int)$_POST['idN']; // id =-1 >create || update
        $titleS=$_POST['titleS']; // "tieu de"
        $contentS=$_POST['contentS'];// "noi dung"
        $statusS=$_POST['statusS'];//'publish'
        $metaA=($_POST['metaA'])!="null"?$_POST['metaA']:array();//
            if($idN==-1){// create new post 93
                create_page($titleS,$contentS,$statusS,$metaA);
            }else{
                update_page($idN,$titleS,$contentS,$statusS,$metaA);
            }
 
    }else{
        $object = new stdClass();
        send($object);
    }
 
}













?>