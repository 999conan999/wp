<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

// // HOME
// function get_posts_star_by_category_id_Home($id){
//     $args = array('cat' => $id,'meta_key' => 'star','meta_value' => 'true', 'post_status' => 'publish', 'orderby' => 'post_date', 'order' =>'DESC', 'posts_per_page' =>8,'offset' => 0);
//     $results =query_posts($args);
//     $rsx=array();    
//     foreach($results as $x){
//         $object = new stdClass();
//         $object->id=$x->ID;
//         $object->title=$x->post_title;
//         $object->link=get_permalink($x->ID);
//         $metaA=get_post_meta($x->ID,'metaA', true);
//         $data_metaA=json_decode($metaA);
//         $object->img=$data_metaA->thumnail;
//         $object->rate=$data_metaA->rating;
//         $object->price_ins=$data_metaA->price;
//         $object->price_del='';
//         $object->message=$data_metaA->message==NULL?'':$data_metaA->message;
//         array_push($rsx,$object);
//     }
//     return $rsx;
// }
// function get_list_posts_by_categorys_Home(){
//     global $wpdb;
//     $table_prefix=$wpdb->prefix .'term_taxonomy';
//     $sql = $wpdb->prepare( "SELECT term_id,parent FROM $table_prefix WHERE taxonomy ='category' ORDER BY term_id ASC");
//     $results = $wpdb->get_results( $sql , OBJECT );
//     $categorys=array();
//     $id_default_category= get_option('default_category');
//     foreach($results as $x){
//         $id=$x->term_id;
//         if($id_default_category!=$id){
//             // echo get_cat_name($id);
//             $obj= new stdClass();
//             $obj->title=get_cat_name($id);
//             $obj->link=get_category_link($id);
//             $obj->sp= get_posts_star_by_category_id_Home($id);
//             array_push($categorys,$obj);
//         }
//     }
//     return($categorys);
  
// }
// // get_list_posts_by_categorys_Home();
// function get_news_Home($quantity){
//     global $wpdb;
//     $table_prefix=$wpdb->prefix .'posts';
//     $sql = $wpdb->prepare( "SELECT ID,post_title FROM $table_prefix WHERE post_type ='post' AND  post_status='publish' ORDER BY post_date DESC LIMIT %d OFFSET 0 ",$quantity );
//     $results = $wpdb->get_results( $sql , OBJECT );
//     $list_news=array();
//     foreach($results as $x){
//         echo $x->post_title;
//         echo '<br>';
//         $object = new stdClass();
//         $object->title=$x->post_title;
//         $metaA=get_post_meta($x->ID,'metaA', true);
//         $data_metaA=json_decode($metaA);
//         $object->img=$data_metaA->thumnail;
//         $object->url=get_permalink($x->ID);
//         array_push($list_news,$object);
//     }
//     return($list_news); 
// }
// // get_news_Home(9);
// function get_common(){
//     $common=get_option('setupsZ');
//     if($common==false){
//         $common=json_decode('{"header":{"icon_mini_url":"","logo":"","chao_mung":"","chao_mung_url":"","menu":[]},"lien_he":{"sdt_zalo":"","sdt_hotline":"","url_fb":"","dia_chi":""},"footer":{"about":[],"privacy":[],"job":[],"design_by":"","bo_cong_thuong":{"name":"","url":""}},"code_gg":{"code_header":"","code_body":""}}');
//     }else{
//         $common=json_decode(stripslashes($common));
//     }
//     return($common);

// }
// //  get_common();
// /////////////////////////////////////////////
// // Category_ Post _ product
// function get_data_post($id){
//     global $wpdb;
//     // get infor posst : ID, post_Date, title, content, *url post, status, meta-all
//     $table_prefix=$wpdb->prefix .'posts';
//     $sql = $wpdb->prepare( "SELECT ID,post_content,post_title FROM $table_prefix WHERE ID= %s ",$id);
//     $results = $wpdb->get_results( $sql , OBJECT );
//     $x=$results[0];
//     //contents
//     $contents = new stdClass();
//     $contents->title=$x->post_title;
//     $contents->price_del='';
//     $metaA=get_post_meta($id,'metaA', true);
//     $data_metaA=json_decode($metaA);
//     $contents->price_ins=$data_metaA->price_ins;
//     $contents->short_des=$data_metaA->short_des;
//     $contents->long_des=$x->post_content;
//     $contents->note=$data_metaA->message==NULL?'':$data_metaA->message;
//     // data phu
//     $phu = new stdClass();
//     $phu->thumnail=$data_metaA->thumnail;
//     $phu->slide_sort=$data_metaA->slide_sort;
//     $phu->show_slide=$data_metaA->show_slide;
//     $phu->rating=$data_metaA->rating;
//     //category
//     $c=(wp_get_post_categories($id))[0];
//     $phu->category_name=get_cat_name($c);
//     $phu->category_link=get_category_link($c);;
//     //related_posts
//     $args = array('cat' => $c, 'post_status' => 'any', 'orderby' => 'post_date', 'order' =>'DESC', 'posts_per_page' => 50,'offset' => 0 );
//     $results =query_posts($args);
//     $related_posts=array();    
//     foreach($results as $x){
//         $object = new stdClass();
//         $object->title=$x->post_title;
//         $object->link=get_permalink($x->ID);
//         array_push($related_posts,$object);
//     }
//     // cart_sp
//     $cart_sp=array();  
//     $metaA=get_term_meta($c,'metaA', true);
//     if($metaA!=''){
//         $data_metaA=json_decode($metaA["metaA"]);
//         $cart_sp=$data_metaA->cart_sp;
//     } 
//     //rs
//     $rs = new stdClass();
//     $rs->contents=$contents;
//     $rs->phu=$phu;
//     $rs->related_posts=$related_posts;
//     $rs->cart_sp=$cart_sp;
//     return($rs);

// }
// //  send(get_data_post(49));
// // search
// function get_data_search($key){
//     global $wpdb;
//     $table_prefix=$wpdb->prefix .'posts';
//     $sql = $wpdb->prepare( "SELECT ID,post_title FROM $table_prefix WHERE post_type ='post' AND  post_status ='publish' AND post_title LIKE %s ORDER BY post_date DESC LIMIT 20 OFFSET 0 ",'%'.$key.'%');
//     $results = $wpdb->get_results( $sql , OBJECT );
//     $rs=array();
//     foreach($results as $x){
//         $object = new stdClass();
//         $object->id=$x->ID;
//         $object->title=$x->post_title;
//         $object->link=get_permalink($x->ID);
//         $metaA=get_post_meta($x->ID,'metaA', true);
//         $data_metaA=json_decode($metaA);
//         $object->img=$data_metaA->thumnail;
//         $object->rate=$data_metaA->rating;
//         $object->price_ins=$data_metaA->price;
//         $object->price_del='';
//         $object->message=$data_metaA->message==NULL?'':$data_metaA->message;
//         array_push($rs,$object);
//     }
//     send($rs);
// }
// // get_data_search('Tiêu');
?>