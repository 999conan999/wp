<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function create_post($titleS,$contentS,$statusS,$categoryA,$metaA){
    $my_post = array(
        'post_title'    => $titleS,
        'post_content'  => $contentS,
        'post_status'   => $statusS,
        'post_category' => array($categoryA),
        'meta_input'    =>array("metaA"=>$metaA,"data_cache"=>'','time_cache'=>''),
    );
    $post_ID=wp_insert_post( $my_post );
    $object = new stdClass();
    $object->id=$post_ID;
    $object->title=$titleS;
    $object->link=get_permalink($post_ID);
    $object->status=$statusS;
    $object->parent_Category=$categoryA;
    $data_metaA=json_decode(stripslashes($metaA));
    $object->thumnail=$data_metaA->thumnail;
    $object->short_des=$data_metaA->short_des;
    $object->long_des=$data_metaA->long_des;
    $object->shop_adress=$data_metaA->shop_adress;
    $object->is_show_ads=$data_metaA->is_show_ads;
    send($object);

}
function update_post($idN,$titleS,$contentS,$statusS,$categoryA,$metaA){
    $my_post = array(
        'ID'            =>$idN,
        'post_title'    => $titleS,
        'post_content'  => $contentS,
        'post_status'   => $statusS,
        'post_type'   => 'post',
        'post_category' => array($categoryA),
        // 'tags_input' => array(),
        'meta_input'    =>array("metaA"=>$metaA,"data_cache"=>'','time_cache'=>''),
    );
    // update_post_meta( $idN, $meta_key, $meta_value);
    $post_ID=wp_update_post( $my_post );
    $object = new stdClass();
    $object->id=$post_ID;
    $object->title=$titleS;
    $object->link=get_permalink($post_ID);
    $object->status=$statusS;
    $object->parent_Category=$categoryA;
    $data_metaA=json_decode(stripslashes($metaA));
    $object->thumnail=$data_metaA->thumnail;
    $object->short_des=$data_metaA->short_des;
    $object->long_des=$data_metaA->long_des;
    $object->shop_adress=$data_metaA->shop_adress;
    $object->is_show_ads=$data_metaA->is_show_ads;
    send($object);
}

// var_dump(json_decode(stripslashes($_POST['metaA']['metaA'])));

if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id']; // id =-1 >create || update
        $title=$_POST['title']; // "tieu de"
        $content='';// "noi dung"
        $status=$_POST['status'];//'publish'
        $parent_Category=(int)($_POST['parent_Category']);//'publish'
        $metaA=$_POST['metaA'];//
            if($id==-1){// create new post 93
                create_post($title,$content,$status,$parent_Category,$metaA);
            }else{
                update_post($id,$title,$content,$status,$parent_Category,$metaA);
            }

    }else{
        $object = new stdClass();
        send($object);
    }


}











?>