<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function create_category($nameS,$contentS,$metaA,$id_parent){
    if ( ! function_exists( 'wp_insert_category' ) ) require_once(ABSPATH . 'wp-admin/includes/taxonomy.php'); 
    if($id_parent==-1){
        $my_category= array(
            'cat_name'    => $nameS,
            'category_description'  => $contentS,
            // 'category_parent'   => $parentIdN
        );
    }else{
        $my_category= array(
            'cat_name'    => $nameS,
            // 'category_description'  => $contentS,
            'category_parent'   => $id_parent
        );
    }
    $category_ID=wp_insert_category($my_category);
    add_term_meta( $category_ID, 'metaA', $metaA, true);
    add_term_meta( $category_ID, 'data_catche', '', true);
    add_term_meta( $category_ID, 'time_cache', '', true);
    $object = new stdClass();
    $object->id=$category_ID;
    $object->title=$nameS;
    $data_metaA=json_decode(stripslashes($metaA));
    $object->thumnail=$data_metaA->thumnail;
    $object->ref_url=$data_metaA->ref_url;
    $object->ref_title=$data_metaA->ref_title;
    $object->short_des=$data_metaA->short_des;
    $object->long_des=$data_metaA->long_des;
    $object->parent_category=$id_parent;
    $object->is_on_menu=$contentS;
    $object->link=get_category_link($category_ID);
    send($object);
}
function update_category($idN,$nameS,$contentS,$metaA,$id_parent){
    if ( ! function_exists( 'wp_insert_category' ) ) require_once(ABSPATH . 'wp-admin/includes/taxonomy.php'); 
 
    if($id_parent==-1){
        $my_category= array(
            'cat_ID'    => $idN,
            'cat_name'    => $nameS,
            'category_description'  => $contentS,
            // 'category_parent'   => $parentIdN
        );
    }else{
        $my_category= array(
            'cat_ID'    => $idN,
            'cat_name'    => $nameS,
            'category_description'  => $contentS,
            'category_parent'   => $id_parent
        );
    }
     wp_insert_category($my_category);
     update_term_meta( $idN, 'metaA', $metaA);
     update_term_meta( $category_ID, 'data_catche', '', true);
     update_term_meta( $category_ID, 'time_cache', '', true);
    $object = new stdClass();
    $object->id=$idN;
    $object->title=$nameS;
    $data_metaA=json_decode(stripslashes($metaA));
    $object->thumnail=$data_metaA->thumnail;
    $object->ref_url=$data_metaA->ref_url;
    $object->ref_title=$data_metaA->ref_title;
    $object->short_des=$data_metaA->short_des;
    $object->is_on_menu=$contentS;
    $object->long_des=$data_metaA->long_des;
    $object->parent_category=$id_parent;
    $object->link=get_category_link($idN);
    send($object);
}
if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id']; // id =-1 >create || update
        $title=$_POST['title']; // "tieu de"
        $content=$_POST['description'];// "noi dung"
        $metaA=$_POST['metaA'];//
        $id_parent=$_POST['id_parent'];//
            if($id==-1){// create new cate 93
                create_category($title,$content,$metaA,$id_parent);
            }else{
                update_category($id,$title,$content,$metaA,$id_parent);
 
            }

    } 
}
?>