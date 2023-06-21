
<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
//
function get_all_categorys(){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'term_taxonomy';
    $sql = $wpdb->prepare( "SELECT term_id,parent FROM $table_prefix WHERE taxonomy ='category' AND parent <> 0 ORDER BY term_id ASC");
    $results = $wpdb->get_results( $sql , OBJECT );
    $rs=array();
    // $o= new stdClass();
    // $o->name='Tất cả';
    // $o->id=-1;
    // array_push($rs,$o);
    foreach($results as $x){
        $id=$x->term_id;
       $cat = get_category( $id );
       $obj= new stdClass();
       $obj->name=$cat->name;
       $obj->id=(int)$id;
       array_push($rs,$obj);
    }
    send($rs);
}
if(is_user_logged_in()){
    get_all_categorys();
}
?>