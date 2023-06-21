<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function create_category($nameS,$contentS,$metaA){
    if ( ! function_exists( 'wp_insert_category' ) ) require_once(ABSPATH . 'wp-admin/includes/taxonomy.php'); 
    $my_category= array(
        'cat_name'    => $nameS,
        // 'category_description'  => $contentS,
        // 'category_parent'   => $parentIdN
    );
    $category_ID=wp_insert_category($my_category);
    add_term_meta( $category_ID, 'metaA', $metaA, true);
    $object = new stdClass();
    $object->id=$category_ID;
    $object->name=$nameS;
    $data_metaA=json_decode(stripslashes($metaA['metaA']));
    $object->price=$data_metaA->price;
    $object->img=$data_metaA->thumnail;
    $object->url=get_category_link($category_ID);
    send($object);
}
function update_category($idN,$nameS,$contentS,$metaA){
    if ( ! function_exists( 'wp_insert_category' ) ) require_once(ABSPATH . 'wp-admin/includes/taxonomy.php'); 
    $my_category= array(
        'cat_ID'    => $idN,
        'cat_name'    => $nameS,
        // 'category_description'  => $contentS,
        // 'category_parent'   => $parentIdN
    );
     wp_insert_category($my_category);
     update_term_meta( $idN, 'metaA', $metaA);
    $object = new stdClass();
    $object->id=$idN;
    $object->name=$nameS;
    $data_metaA=json_decode(stripslashes($metaA['metaA']));
    $object->price=$data_metaA->price;
    $object->img=$data_metaA->thumnail;
    $object->url=get_category_link($idN);
    send($object);
}
if(is_user_logged_in()){
    if($_POST){
        $idN=(int)$_POST['idN']; // id =-1 >create || update
        $nameS=$_POST['titleS']; // "tieu de"
        $contentS=$_POST['contentS'];// "noi dung"
        $metaA=($_POST['metaA'])!="null"?$_POST['metaA']:array();//
            if($idN==-1){// create new cate 93
                create_category($nameS,$contentS,$metaA);
            }else{
                update_category($idN,$nameS,$contentS,$metaA);
 
            }

    }else{
        $object = new stdClass();
        $object->status='false';
        send($object);
    }
}
?>