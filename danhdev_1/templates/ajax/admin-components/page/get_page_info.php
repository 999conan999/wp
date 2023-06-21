<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_infor_page($id){
    global $wpdb;
    // get infor posst : ID, post_Date, title, content, *url post, status, meta-all
    $table_prefix=$wpdb->prefix .'posts';
    $sql = $wpdb->prepare( "SELECT ID,post_content,post_title,post_status FROM $table_prefix WHERE post_type ='page' AND ID= %s  ",$id);
    $results = $wpdb->get_results( $sql , OBJECT );
    if(count($results)==1){
        $result=$results[0];
        $object = new stdClass();
        $object->title=$result->post_title;
        $object->long_des=$result->post_content;
        $object->status=$result->post_status=="publish"?true:false;
        $metaA=get_post_meta($id,'metaA', true);
        $data_metaA=json_decode($metaA);
        $object->short_des=$data_metaA->short_des;
        $object->thumnail=$data_metaA->thumnail;
        $object->type=$data_metaA->type;
        if(property_exists($data_metaA, 'data_qc')){
            $data_qc=$data_metaA->data_qc;
        }else{
            $data_qc=json_decode('{"sdt":"","zalo":"","fb":"","canonical":"","data_trick":{"is_show":false,"price":0,"sale":0},"dm":[]}');
        }
        $object->data_qc=$data_qc;
        send($object);
    }else{
        $object = new stdClass();
        $object->title='';
        $object->long_des='';
        $object->status=false;
        $object->short_des='';
        $object->thumnail='';
        $object->type='bv';
        $data_qc=json_decode('{"sdt":"","zalo":"","fb":"","canonical":"","data_trick":{"is_show":false,"price":0,"sale":0},"dm":[]}');
        $object->data_qc=$data_qc;
        send($object);
    }
    //   
 
}
// if(is_user_logged_in()){
        $object= new stdClass();
        if($_GET){
            if(isset($_GET['id'])){
                $idN=abs((int)stripslashes(strip_tags( $_GET['id'])));
                get_infor_page($idN);
            }else{
                $object->stautus=false;
                send($object);
             }
        } 
// }
?>