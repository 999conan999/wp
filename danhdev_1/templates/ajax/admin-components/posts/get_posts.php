<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_all_posts($quantity,$offset){
    // $list_post_org=get_all_posts($quantity,$page);
   global $wpdb;
   $table_prefix=$wpdb->prefix .'posts';
   $sql = $wpdb->prepare( "SELECT ID,post_title,post_status FROM $table_prefix WHERE post_type ='post' AND  post_status <> 'trash' AND post_status <> 'auto-draft' ORDER BY post_date DESC LIMIT %d OFFSET %d ",$quantity,$offset);
   $results = $wpdb->get_results( $sql , OBJECT );
   $rs=array();
   foreach($results as $x){
       $object = new stdClass();
       $object->id=$x->ID;
       $object->status=$x->post_status;
       $metaA=get_post_meta($x->ID,'metaA', true);
       $data_metaA=json_decode($metaA);
       $object->price=$data_metaA->price;
       $object->img=$data_metaA->thumnail;
       $object->title=$x->post_title;
       $star=get_post_meta($x->ID,'star', true);
       $object->star=$star==""?false:($star=="true"?true:false);
       $object->url=get_permalink($x->ID);
       //
       $post_categories=(wp_get_post_categories($x->ID));
       $categorys_list=array();
       foreach($post_categories as $c){
           $oj=new stdClass();
           $cat = get_category( $c );
           $oj->name=$cat->name;
           $oj->url=get_category_link($cat->term_id);
           array_push($categorys_list,$oj);
       }
       $object->categorys=$categorys_list;
       array_push($rs,$object);
    }
    send($rs);
}
function get_posts_by_category_id($id_category,$quantity,$offset){
    $list_childrent=(get_term_children($id_category,'category'));
    $args = array('cat' => $id_category, 'post_status' => 'any', 'orderby' => 'post_date', 'order' =>'DESC', 'posts_per_page' => $quantity,'offset' => $offset,'category__not_in' =>$list_childrent);
    $results =query_posts($args);
    $rs=array();    
    foreach($results as $x){
        $object = new stdClass();
        $object->id=$x->ID;
        $object->status=$x->post_status;
        $object->star=$x->post_excerpt==""?false:($x->post_excerpt=="true"?true:false);
        $metaA=get_post_meta($x->ID,'metaA', true);
        $data_metaA=json_decode($metaA);
        $object->price=$data_metaA->price;
        $object->img=$data_metaA->thumnail;
        $object->title=$x->post_title;
        $star=get_post_meta($x->ID,'star', true);
        $object->star=$star==""?false:($star=="true"?true:false);
        $object->url=get_permalink($x->ID);
        //
        $post_categories=(wp_get_post_categories($x->ID));
        $categorys_list=array();
        foreach($post_categories as $c){
            $oj=new stdClass();
            $cat = get_category( $c );
            $oj->name=$cat->name;
            $oj->url=get_category_link($cat->term_id);
            array_push($categorys_list,$oj);
        }
        $object->categorys=$categorys_list;
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
                $category_id=-1;
                if(isset($_GET['category_id'])) $category_id=abs((int)stripslashes(strip_tags($_GET['category_id'])));
                if($category_id==-1){// get all
                    //http://localhost/cofanew/wp-content/themes/danhdev_1/templates/ajax/admin-components/posts/get_posts.php?page=1
                    get_all_posts($quantity,$page);
                }else{// get by category id
                    //http://localhost/cofanew/wp-content/themes/danhdev_1/templates/ajax/admin-components/posts/get_posts.php?page=1&cate=-1
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