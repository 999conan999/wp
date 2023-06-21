<?php
//  $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
//  require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
 
//  $json = file_get_contents('http://localhost/cofaold/wp-content/themes/danhdev_1/templates/cronZ.php');
//     $data=(json_decode($json));
//     $i=0;
//     foreach($data as $x){
//         $i++;
//         $titleS=$x->titleS;
//         $statusS="publish";
//         $contentS=$x->contentS;     
//         $categoryA=$x->categoryA;     
//         $metaA=$x->metaA;
//         // if($i==1){
//             $my_post = array(
//                 'post_title'    => $titleS,
//                 'post_content'  => $contentS,
//                 'post_status'   => $statusS,
//                 'post_category' => $categoryA,
//                 'meta_input'    =>array("metaA"=>(json_encode($metaA, JSON_UNESCAPED_UNICODE)))
//             );
//             // echo '<br>';
//             // var_dump($my_post);
//             $post_ID=wp_insert_post( $my_post );
//             if($post_ID) echo "ok";
//         // }
//     }
?>