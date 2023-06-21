<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_all_pages(){
    // $list_post_org=get_all_posts($quantity,$page);
   global $wpdb;
   $table_prefix=$wpdb->prefix .'posts';
   $sql = $wpdb->prepare( "SELECT ID,post_title,post_status FROM $table_prefix WHERE post_type ='page' AND  post_status <> 'trash' AND post_status <> 'auto-draft' ORDER BY post_date DESC");
   $results = $wpdb->get_results( $sql , OBJECT );
   $rs=array();
   foreach($results as $x){
        $object = new stdClass();
        $object->id=$x->ID;
        $object->status=$x->post_status;
        $metaA=get_post_meta($x->ID,'metaA', true);
        $time_cache=get_post_meta($x->ID,'time_cache', true);//
        if($metaA!=""){
            $data_metaA=json_decode($metaA);
            if (property_exists($data_metaA, 'short_des')) {
                $object->thumnail=$data_metaA->thumnail;
                $object->title=$x->post_title;
                $object->link=get_permalink($x->ID);
                $object->short_des=$data_metaA->short_des;
                $object->long_des=$data_metaA->long_des;
                if($time_cache!=""){ //
                    $object->time_catche=(int)$time_cache;
                    // $object->time_catche=time();
                }
                //  $object->time_catche=time()-3600;//
                array_push($rs,$object);
            }
        }
    }
    send($rs);
}
 
if(is_user_logged_in()){
    get_all_pages();
}
 
 
 
 
 
 
 
 ?>