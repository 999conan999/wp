<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
 
function delete_contact_by_id($id){// search phone or email ~~ '' => get all
     global $wpdb;
     $table = $wpdb->prefix . 'orderz';
     $delete = $wpdb->delete(
     $table,
     array( 'id' => $id ),
     array( '%d' )
     );
}
     $object = new stdClass();
     $object->status=false;
          if(isset($_POST['id'])){
               $id=(int)stripslashes(strip_tags($_POST['id']));
               delete_contact_by_id($id);
               $object->status=true;
          }
     send($object);
 ?>