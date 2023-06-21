
<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
//
function get_all_categorys(){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'term_taxonomy';
    $sql = $wpdb->prepare( "SELECT term_id,parent,description FROM $table_prefix WHERE taxonomy ='category' ORDER BY term_id ASC");
    $results = $wpdb->get_results( $sql , OBJECT );
    $rs=array();
    foreach($results as $x){
        $id=$x->term_id;
       $cat = get_category( $id );
       $obj= new stdClass();
       $obj->title=$cat->name;
        // echo $cat->name; echo ' ===========>('.$id.')'; echo '<br>';
       $obj->id=(int)($x->term_id);
       $obj->link=get_category_link($id);
       $obj->is_on_menu=$x->description;
       $metaA=get_term_meta($id,'metaA', true);
       $time_cache=get_term_meta($id,'time_cache', true);//
       if($metaA!=''){
        if(!is_array($metaA)){
            $data_metaA=json_decode($metaA);
            if (property_exists($data_metaA, 'title')) {
                $obj->thumnail=$data_metaA->thumnail;
                $obj->short_des=$data_metaA->short_des;
                $obj->long_des=$data_metaA->long_des;
                $obj->parent_category=(int)($x->parent)==0?-1:(int)($x->parent);
                if (property_exists($data_metaA, 'ref_url')) {
                    $obj->ref_url=$data_metaA->ref_url;
                    $obj->ref_title=$data_metaA->ref_title;
                }
                if($time_cache!=""){ //
                    $obj->time_catche=(int)$time_cache;
                    // $object->time_catche=time();
                }
                // $obj->time_catche=time()-3600;//
                array_push($rs,$obj);
            }
        }
       }
    }
    send($rs);
}
if(is_user_logged_in()){
    get_all_categorys();
}

?>