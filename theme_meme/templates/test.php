<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_all_posts($quantity,$page){
    // $list_post_org=get_all_posts($quantity,$page);
   global $wpdb;
   $table_prefix=$wpdb->prefix .'posts';
   $offset=$page*$quantity;
   $sql = $wpdb->prepare( "SELECT ID,post_title,post_status FROM $table_prefix WHERE post_type ='post' AND  post_status <> 'trash' AND post_status <> 'auto-draft' ORDER BY post_date DESC LIMIT %d OFFSET %d ",$quantity,$offset);
   $products = $wpdb->get_results( $sql , ARRAY_A );
//    $rs=array();
//    foreach($results as $x){
//     var_dump($x["ID"]);
//     //    $object = new stdClass();
//     //    $object->id=$x->ID;
//     //    $object->status=$x->post_status;
//     //    $object->title=$x->post_title;
//     //    $object->link=get_permalink($x->ID);
//     //    array_push($rs,$object);
//     }
    //
    // Mảng phân loại các sản phẩm
$categorizedProducts = [];

// Phân loại các sản phẩm vào mảng phân loại
foreach ($products as $product) {
    $id = $product['ID'];
    $categorizedProducts[$id] = $product; // Thêm sản phẩm vào mảng con tương ứng với ID
}
    send($categorizedProducts);
}
get_all_posts(2,0);
 
 
 
 
 
 
 
// async function fs() {
//     const response = await fetch("http://localhost/cofanew/wp-content/themes/theme_meme/templates/ajax/posts/test.php?page=0");
//     return response.json(); // Chuyển đổi dữ liệu thành đối tượng JSON
// }

// async function show() {
//     let result = await fs();
//     console.log(result); // Hiển thị kết quả trả về
// }

// show();
 
 ?>