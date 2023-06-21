<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function create_post($titleS,$contentS,$statusS,$categoryA,$metaA){
    $my_post = array(
        'post_title'    => $titleS,
        'post_content'  => $contentS,
        'post_status'   => $statusS,
        'post_category' => array($categoryA),
        'post_type'   => 'post',
        'meta_input'    =>array("metaA"=>$metaA,"data_cache"=>'','time_cache'=>''),
    );
    $post_ID=wp_insert_post( $my_post );

}

// var_dump(json_decode(stripslashes($_POST['metaA']['metaA'])));

if(is_user_logged_in()){
    if($_POST){
            $data=json_decode(stripslashes($_POST['data']));

            foreach($data as $x){
                $title=$x->title;
                $content='';
                $status='publish';
                $categoryA=$x->parent_Category;
                $metaA=$x->metaA;
                create_post($title,$content,$status,$categoryA,$metaA);
            }
            $object = new stdClass();
            $object->status=true;
            send($object);
    }else{
        $object = new stdClass();
        send($object);
    }


}











?>