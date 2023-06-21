
<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
//
function get_all_categorys(){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'term_taxonomy';
    $sql = $wpdb->prepare( "SELECT term_id,parent FROM $table_prefix WHERE taxonomy ='category' ORDER BY term_id ASC");
    $results = $wpdb->get_results( $sql , OBJECT );
    $rs=array();
    foreach($results as $x){
        $id=$x->term_id;
       $cat = get_category( $id );
       $obj= new stdClass();
       $obj->name=$cat->name;
       $obj->id=$x->term_id;
       $obj->url=get_category_link($id);
       $metaA=get_term_meta($id,'metaA', true);
       if($metaA!=''){
        $data_metaA=json_decode($metaA["metaA"]);
        $obj->price=$data_metaA->price;
        $obj->img=$data_metaA->thumnail;
        $obj->cart_sp=$data_metaA->cart_sp;
       }else{
        $obj->price='0';
        $obj->img='';
        $obj->cart_sp=array();
       }
       array_push($rs,$obj);
    }
    send($rs);
}
if(is_user_logged_in()){
    get_all_categorys();
}
?>