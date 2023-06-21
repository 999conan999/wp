<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
    function get_images($quantity,$page){
        $query_images_args = array(
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'post_status'    => 'inherit',
            'posts_per_page' => $quantity,
            'offset'=>$page,
            'order'=> 'DESC'
        );
        
        $query_images = new WP_Query( $query_images_args);            
        $myArray = array();
        foreach ( $query_images->posts as $image ) {
            $myArray[] = (object) ['id' => $image->ID,'img'=>wp_get_attachment_url( $image->ID )];
        }
        return($myArray);
    }

    if(is_user_logged_in()){
        $quantity=30;
        $page=abs((int)stripslashes(strip_tags($_GET['page']))*$quantity);
        send(get_images($quantity,$page));
    }