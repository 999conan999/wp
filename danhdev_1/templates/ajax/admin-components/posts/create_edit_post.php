<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function create_post($titleS,$contentS,$statusS,$categoryA,$metaA){
    $my_post = array(
        'post_title'    => $titleS,
        'post_content'  => $contentS,
        'post_status'   => $statusS,
        'post_category' => $categoryA,
        'meta_input'    =>$metaA
    );
    $post_ID=wp_insert_post( $my_post );
    $object = new stdClass();
    $object->id=$post_ID;
    $object->status=$statusS;
    $data_metaA=json_decode(stripslashes($metaA['metaA']));
    $object->price=$data_metaA->price;
    $object->img=$data_metaA->thumnail;
    $object->title=$titleS;
    $object->url=get_permalink($post_ID);
    //
    $post_categories=(wp_get_post_categories($post_ID));
    $categorys_list=array();
    foreach($post_categories as $c){
        $oj=new stdClass();
        $cat = get_category( $c );
        $oj->name=$cat->name;
        $oj->url=get_category_link($cat->term_id);
        array_push($categorys_list,$oj);
    }
    $object->categorys=$categorys_list;
    //
    send($object);

}
function update_post($idN,$titleS,$contentS,$statusS,$categoryA,$metaA){
    $my_post = array(
        'ID'            =>$idN,
        'post_title'    => $titleS,
        'post_content'  => $contentS,
        'post_status'   => $statusS,
        'post_type'   => 'post',
        'post_category' => $categoryA,
        'tags_input' => array(),
        'meta_input'    =>$metaA
    );
    $post_ID=wp_update_post( $my_post );
    $object = new stdClass();
    $object->id=$idN;
    $object->status=$statusS;
    $data_metaA=json_decode(stripslashes($metaA['metaA']));
    $object->price=$data_metaA->price;
    $object->img=$data_metaA->thumnail;
    $star=get_post_meta($idN,'star', true);
    $object->star=$star==""?false:($star=="true"?true:false);
    $object->title=$titleS;
    $object->url=get_permalink($idN);
    //
    $post_categories=(wp_get_post_categories($idN));
    $categorys_list=array();
    foreach($post_categories as $c){
        $oj=new stdClass();
        $cat = get_category( $c );
        $oj->name=$cat->name;
        $oj->url=get_category_link($cat->term_id);
        array_push($categorys_list,$oj);
    }
    $object->categorys=$categorys_list;
    //
    send($object);
}

// var_dump(json_decode(stripslashes($_POST['metaA']['metaA'])));

if(is_user_logged_in()){
    if($_POST){
        $idN=(int)$_POST['idN']; // id =-1 >create || update
        $titleS=$_POST['titleS']; // "tieu de"
        $contentS=$_POST['contentS'];// "noi dung"
        $statusS=$_POST['statusS'];//'publish'
        $categoryA=($_POST['categoryA'])!="null"?$_POST['categoryA']:array();// '3,4'
        $metaA=($_POST['metaA'])!="null"?$_POST['metaA']:array();//
        
            if($idN==-1){// create new post 93
                create_post($titleS,$contentS,$statusS,$categoryA,$metaA);
            }else{
                update_post($idN,$titleS,$contentS,$statusS,$categoryA,$metaA);
            }

    }else{
        $object = new stdClass();
        send($object);
    }


}











?>