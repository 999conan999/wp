<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_infor_post($id){
    global $wpdb;
    // get infor posst : ID, post_Date, title, content, *url post, status, meta-all
    $table_prefix=$wpdb->prefix .'posts';
    $sql = $wpdb->prepare( "SELECT ID,post_content,post_title,post_status FROM $table_prefix WHERE ID= %s ",$id);
    $results = $wpdb->get_results( $sql , OBJECT );
    $x=$results[0];
    $object = new stdClass();
    $object->status=($x->post_status=="publish"?true:false);
    $object->long_des=$x->post_content;
    $metaA=get_post_meta($id,'metaA', true);
    $data_metaA=json_decode($metaA);
    $object->price=$data_metaA->price;
    $object->short_des=$data_metaA->short_des;
    $object->title=$x->post_title;
    $object->thumnail=$data_metaA->thumnail;
    $object->slide_sort=$data_metaA->slide_sort;
    $object->show_slide=$data_metaA->show_slide;
    $object->rating=$data_metaA->rating;
    $object->message=$data_metaA->message==NULL?'':$data_metaA->message;
    $c=(wp_get_post_categories($x->ID))[0];
    $oj=new stdClass();
    $cat = get_category( $c );
    $oj->name=$cat->name;
    $oj->id=$cat->term_id;
    $object->category=$oj;
    send($object);
}
if(is_user_logged_in()){
    if($_GET){
        if(isset($_GET['id'])){
            $idN=abs((int)stripslashes(strip_tags( $_GET['id'])));
            get_infor_post($idN);

        }else{
            $oj=new stdClass();
            send($oj);
            }
    } 
}
?>