<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_all_pages($quantity,$offset){
    // $list_post_org=get_all_posts($quantity,$page);
   global $wpdb;
   $table_prefix=$wpdb->prefix .'posts';
   $sql = $wpdb->prepare( "SELECT ID,post_title,post_status FROM $table_prefix WHERE post_type ='page' AND  post_status <> 'trash' AND post_status <> 'auto-draft' ORDER BY post_date DESC LIMIT %d OFFSET %d ",$quantity,$offset);
   $results = $wpdb->get_results( $sql , OBJECT );
   $rs=array();
   foreach($results as $x){
       $object = new stdClass();
       $object->id=$x->ID;
       $object->status=$x->post_status;
       $metaA=get_post_meta($x->ID,'metaA', true);
       $data_metaA=json_decode($metaA);
       $object->img=$data_metaA->thumnail;
       $object->title=$x->post_title;
       $object->url=get_permalink($x->ID);
       if(property_exists($data_metaA, 'type')){
            $type=$data_metaA->type;
        }else{
            $type='bv';
        }
        $object->type=$type;
       array_push($rs,$object);
    }
    send($rs);
}
 
if(is_user_logged_in()){
    //     // all post
      if($_GET){
        $quantity=25;
            if(isset($_GET['page'])){
                $page=abs((int)stripslashes(strip_tags( $_GET['page']))*$quantity);
                    get_all_pages($quantity,$page);
            }else{
                send(array());
             }
        }else{
            send(array());
         }
      //

}
 
 
 
 
 
 
 
 ?>