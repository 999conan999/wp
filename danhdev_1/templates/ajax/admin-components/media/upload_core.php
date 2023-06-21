<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
    //**** */ kiểm tra login ở đây
    // var_dump(is_user_logged_in());

    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }
    if ( ! function_exists( 'wp_crop_image' ) ) {
        include( ABSPATH . 'wp-admin/includes/image.php' );
    }

    function uploade_core($file_arr=array(),$title,$optimize=false){    
        $arr_result=array();
        if(count($file_arr)>0){
            foreach($file_arr as $file){
                $uploadedfile = $file;
            
                $upload_overrides = array(
                    'test_form' => false
                );
                
                $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
                // var_dump( $movefile);
                if ( $movefile && ! isset( $movefile['error'] ) ) {
                    // var_dump( $movefile );
                    $attachment = array(
                        'post_mime_type' => $movefile['type'],
                        'post_title' => $title,
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );

                    $id = wp_insert_attachment( $attachment, $movefile['url'] );
                    if (!is_wp_error($id) && $optimize) {
                        wp_update_attachment_metadata($id, wp_generate_attachment_metadata($id, $movefile['file']));
                        // Save file ID in meta field
                    }
                    $objects = new stdClass();
                    $objects->id=$id;
                    $objects->img=$movefile['url'];
                    array_push($arr_result,$objects);
                    // return 
                } else {
                    /*
                    * Error generated by _wp_handle_upload()
                    * @see _wp_handle_upload() in wp-admin/includes/file.php
                    */
                    // echo $movefile['error'];
                }
            }
        }
        return $arr_result;
    }
    if(is_user_logged_in()){
        if(count($_FILES)>0){
            $result=uploade_core($_FILES,'',false);
            send($result);
        }else{
            send(array());
        }
    }
 




















?>