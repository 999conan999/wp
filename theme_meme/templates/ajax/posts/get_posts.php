<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_all_posts($quantity,$page){
    // $list_post_org=get_all_posts($quantity,$page);
   global $wpdb;
   $table_prefix=$wpdb->prefix .'posts';
   $offset=$page*$quantity;
   $sql = $wpdb->prepare( "SELECT ID,post_title,post_status FROM $table_prefix WHERE post_type ='post' AND  post_status <> 'trash' AND post_status <> 'auto-draft' ORDER BY post_date DESC LIMIT %d OFFSET %d ",$quantity,$offset);
   $results = $wpdb->get_results( $sql , OBJECT );
   $rs=array();
   foreach($results as $x){
       $object = new stdClass();
       $object->id=$x->ID;
       $object->status=$x->post_status;
       $object->title=$x->post_title;
       $object->link=get_permalink($x->ID);
       $metaA=get_post_meta($x->ID,'metaA', true);
       $time_cache=get_post_meta($x->ID,'time_cache', true);//
       if($metaA!=""){
        $data_metaA=json_decode($metaA);
        if (property_exists($data_metaA, 'parent_Category')) {
            $object->thumnail=$data_metaA->thumnail;
            $object->short_des=$data_metaA->short_des;
            $object->long_des=$data_metaA->long_des;
            if (property_exists($data_metaA, 'shop_adress')) {
                $object->shop_adress=$data_metaA->shop_adress;
            }
            $object->parent_Category=$data_metaA->parent_Category;
            if($time_cache!=""){ //
                $object->time_catche=(int)$time_cache;
                // $object->time_catche=time();
            }
            //  $object->time_catche=time()-36000;//
            array_push($rs,$object);

        }
       }
    }
    send($rs);
}
function get_posts_by_category_id($id_category,$quantity,$page){
    $offset=$page*$quantity;
    $list_childrent=(get_term_children($id_category,'category'));
    $args = array('cat' => $id_category, 'post_status' => 'any', 'orderby' => 'post_date', 'order' =>'DESC', 'posts_per_page' => $quantity,'offset' => $offset,'category__not_in' =>$list_childrent);
    $results =query_posts($args);
    $rs=array();  

    foreach($results as $x){
        $object = new stdClass();
        $object->id=$x->ID;
        $object->status=$x->post_status;
        $object->title=$x->post_title;
        $object->link=get_permalink($x->ID);
        $metaA=get_post_meta($x->ID,'metaA', true);
        $time_cache=get_post_meta($x->ID,'time_cache', true);//
        if($metaA!=""){
         $data_metaA=json_decode($metaA);
         if (property_exists($data_metaA, 'parent_Category')) {
             $object->thumnail=$data_metaA->thumnail;
             $object->short_des=$data_metaA->short_des;
             $object->long_des=$data_metaA->long_des;
            if (property_exists($data_metaA, 'shop_adress')) {
            $object->shop_adress=$data_metaA->shop_adress;
            }
            if (property_exists($data_metaA, 'is_show_ads')) {
            $object->is_show_ads=$data_metaA->is_show_ads;
            }
             $object->parent_Category=$data_metaA->parent_Category;
             if($time_cache!=""){ //
                $object->time_catche=(int)$time_cache;
                // $object->time_catche=time();
            }
            //  $object->time_catche=time()-36000;//
             array_push($rs,$object);
 
         }
        }
    }
    send($rs);

}
if(is_user_logged_in()){
      if($_GET){
        $quantity=25;
            if(isset($_GET['page'])){
                $page=((int)stripslashes(strip_tags( $_GET['page'])));
                $category_id=((int)stripslashes(strip_tags( $_GET['category_id'])));
                if($category_id==-1){// get all
                    get_all_posts($quantity,$page);
                }else{// get by category id
                   get_posts_by_category_id($category_id,$quantity,$page);
                }
            }else{
                send(array());
             }
        }else{
            send(array());
         }
      //
}
 
 
 
 
 
 
 
 
 ?>