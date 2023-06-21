<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
 
    function is_table_created($name_table){
        global $wpdb;
        $name_table=$wpdb->prefix .$name_table;
        $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $name_table ) );
        if ( $wpdb->get_var( $query ) === $name_table ) {
            return true;
        }else{
            return false;
        }
    }
    function create_orderz_table(){
        global $wpdb;
        $name_table=$wpdb->prefix .'orderz';
        $charsetCollate = $wpdb->get_charset_collate();
        $createTable = "CREATE TABLE IF NOT EXISTS `{$name_table}` (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `value` longtext NULL,
            `datez` timestamp NOT NULL,
            PRIMARY KEY (`id`)
        ) {$charsetCollate};";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $createTable );
    }
    function create_form($value){
        $data = array(
            'value'=> $value,
            'datez' => current_time('mysql'),
        );
        global $wpdb;
        $table = $wpdb->prefix . 'orderz';
        $rs=$wpdb->insert(
            $table,
            $data
        );
    }
    $object = new stdClass();
    $object->status=false;
    if(isset($_POST['data'])){
        $data=stripslashes(strip_tags($_POST['data']));
        if($data!=''){
            $object->status=true;
            if(!is_table_created('orderz')){
                create_orderz_table();
            }
            // ghi order
            create_form($data);
            send($object);
        }else{
            $object->status=false;
            send($object);
        }
    }else{
        $object->status=false;
        send($object);
    }
 

    

    

?>