<?php 
    // Remove Parent Category from Child Category URL
    add_filter('term_link', 'devvn_no_category_parents', 1000, 3);
    function devvn_no_category_parents($url, $term, $taxonomy) {
    if($taxonomy == 'category'){
        $term_nicename = $term->slug;
        $url = trailingslashit(get_option( 'home' )) . user_trailingslashit( $term_nicename, 'category' );
    }
    return $url;
    }
    // Rewrite url new
    function devvn_no_category_parents_rewrite_rules($flash = false) {
    $terms = get_terms( array(
        'taxonomy' => 'category',
        'post_type' => 'post',
        'hide_empty' => false,
    ));
    if($terms && !is_wp_error($terms)){
        foreach ($terms as $term){
            $term_slug = $term->slug;
            add_rewrite_rule($term_slug.'/?$', 'index.php?category_name='.$term_slug,'top');
            add_rewrite_rule($term_slug.'/page/([0-9]{1,})/?$', 'index.php?category_name='.$term_slug.'&paged=$matches[1]','top');
            add_rewrite_rule($term_slug.'/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?category_name='.$term_slug.'&feed=$matches[1]','top');
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
    }
    add_action('init', 'devvn_no_category_parents_rewrite_rules');

    /*fix error category 404*/
    function devvn_new_category_edit_success() {
    devvn_no_category_parents_rewrite_rules(true);
    }
    add_action('created_category','devvn_new_category_edit_success');
    add_action('edited_category','devvn_new_category_edit_success');
    add_action('delete_category','devvn_new_category_edit_success');

// if (!function_exists('send')) {
//     function send($data){
//         header('Cache-Control: no-cache, must-revalidate');
//         header('Content-type: application/json');
//         echo json_encode($data);
//     }
// }
// //

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
//     $sql = $wpdb->prepare( "SELECT term_id,parent FROM $table_prefix WHERE taxonomy ='category' ORDER BY term_id DESC");
//     $results = $wpdb->get_results( $sql , OBJECT );
//     $categorys=array();
//     $id_default_category= get_option('default_category');
//     foreach($results as $x){
//         $id=$x->term_id;
//         if($id!=20&&$id!=21){
//             if($id_default_category!=$id){
//                 // echo get_cat_name($id);
//                 $obj= new stdClass();
//                 $obj->title=get_cat_name($id);
//                 $obj->link=get_category_link($id);
//                 $obj->sp= get_posts_star_by_category_id_Home($id);
//                 array_push($categorys,$obj);
//             }
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
//         $object = new stdClass();
//         $object->title=$x->post_title;
//         $metaA=get_post_meta($x->ID,'metaA', true);
//         $data_metaA=json_decode($metaA);
//         $object->img=isset($data_metaA->thumnail)?$data_metaA->thumnail:"";
//         $object->link=get_permalink($x->ID);
//         array_push($list_news,$object);
//     }
//     return($list_news); 
// }
// // get_news_Home(9);
// function get_common(){
//     $common=get_option('setup_meme_theme');
//     if($common){
//         $rs= json_decode(stripslashes($common));
//         return $rs;
//     }else{
//         return false;
//     }
// }
// function get_menu($type){
//     if($type=='is_on_menu'){
//         global $wpdb;
//         $table_prefix=$wpdb->prefix .'term_taxonomy';
//         $sql = $wpdb->prepare( "SELECT term_id FROM $table_prefix WHERE taxonomy ='category' AND description = '1' ORDER BY term_id ASC");
//         $results = $wpdb->get_results( $sql , OBJECT );
//         $rs=array();
//         foreach($results as $x){
//             $id=$x->term_id;
//             $cat = get_category( $id );
//             $obj= new stdClass();
//             $obj->title=$cat->name;
//             $obj->link=get_category_link($id);
//             array_push($rs,$obj);
//         }
//         return($rs);
//     }
// }
// if (!function_exists('create_qc_img_table')) {
//     function create_qc_img_table(){
//         global $wpdb;
//         $name_table=$wpdb->prefix .'qc_img';
//         $charsetCollate = $wpdb->get_charset_collate();
//         $createTable = "CREATE TABLE IF NOT EXISTS `{$name_table}` (
//             `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
//             `alt` varchar(200) NULL,
//             `url` varchar(200) NULL,
//             `date_create` timestamp NOT NULL,
//             PRIMARY KEY (`id`)
//         ) {$charsetCollate};";
//         require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//         dbDelta( $createTable );
//     }
// }
// add_action("after_switch_theme", "mytheme_do_something");
// function wp_register_theme_activation_hook($code, $function) {
//     create_qc_img_table();
// }
// //  get_common();
 
// /////////////////////////////////////////////
// function get_category_infor($id){
 
//     // get infor posst : ID, post_Date, title, content, *url post, status, meta-all
//     $cat = get_category( $id);
//     //contents
//     $contents = new stdClass();
//     $contents->title=$cat->name;
//     $contents->price_del='';
//     $metaA=get_term_meta($id,'metaA', true);
//     $data_metaA=json_decode($metaA["metaA"]);
//     $contents->price_ins=$data_metaA->price;
//     $contents->short_des=$data_metaA->short_des;
//     $contents->long_des=$data_metaA->long_des;
//     $contents->note='';
//     // data phu
//     $phu = new stdClass();
//     $phu->thumnail=$data_metaA->thumnail;
//     $phu->slide_sort=$data_metaA->slide_sort;
//     $phu->show_slide=true;
//     $phu->rating='5';
//     //category
//     // $c=(wp_get_post_categories($id))[0];
//     $phu->category_name=$cat->name;
//     $phu->category_link=get_category_link($id);
//     //related_posts
//     $args = array('cat' => $id, 'post_status' => 'any', 'orderby' => 'post_date', 'order' =>'DESC', 'posts_per_page' => 50,'offset' => 0 );
//     $results =query_posts($args);
//     $related_posts=array();    
//     foreach($results as $x){
//         $object = new stdClass();
//         $object->title=$x->post_title;
//         $object->link=get_permalink($x->ID);
//         array_push($related_posts,$object);
//     }
//     // cart_sp
//     $cart_sp=$data_metaA->cart_sp;  
  
//     //rs
//     $rs = new stdClass();
//     $rs->contents=$contents;
//     $rs->phu=$phu;
//     $rs->related_posts=$related_posts;
//     $rs->cart_sp=$cart_sp;
//     return($rs);

// }
// //
// // Category_ Post _ product
// function get_post_infor($id){
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
//     // var_dump($data_metaA);
//     $contents->price_ins=$data_metaA->price;
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
//     $args = array('cat' => $c, 'post_status' => 'any', 'orderby' => 'post_date', 'order' =>'DESC', 'posts_per_page' => 25,'offset' => 0 );
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
// //
// function get_page_infor($id){
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
//     $contents->price_ins='';
//     $contents->short_des=$data_metaA->short_des;
//     $contents->long_des=$x->post_content;
//     $contents->note='';
//     // data phu
//     $phu = new stdClass();
//     $phu->thumnail=$data_metaA->thumnail;
//     $phu->slide_sort=array();
//     $phu->show_slide=false;
//     $phu->rating='5';
//     //category
//     $phu->category_name='';
//     $phu->category_link='';
//     //rs
//     $rs = new stdClass();
//     $rs->contents=$contents;
//     $rs->phu=$phu;
//     $rs->related_posts=array();
//     $rs->cart_sp=array();
//     return($rs);

// }
// // send(get_page_infor(61));
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
//     return($rs);
// }
// // get_data_search('Tiêu');

?>