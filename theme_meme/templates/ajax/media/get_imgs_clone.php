<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
    function get_images_clone($quantity,$offset){
        global $wpdb;
        $table_prefix=$wpdb->prefix .'qc_img';
             $sql = $wpdb->prepare( "SELECT id,alt,url,date_create FROM $table_prefix ORDER BY date_create DESC LIMIT %d OFFSET %d ",$quantity,$offset);
        $results = $wpdb->get_results( $sql , OBJECT );
        $rs=array();
        $home=home_url();
        foreach($results as $x){
          $object = new stdClass();
          $object->id=$x->id;
          $object->img=$home.'/'.$x->url;
          $object->alt=$x->alt;
          array_push($rs,$object);
        }
        send($rs);
    }

    if(is_user_logged_in()){
        $quantity=30;
        $offset=abs((int)stripslashes(strip_tags($_GET['page']))*$quantity);
        get_images_clone($quantity,$offset);
    }