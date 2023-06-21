<?php
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
// để mà chạy được file này thì cần phải thay đổi như sau:
// trong file php.init, active plugin này vào (nghĩa là thêm dòng này vào để nó hoạt động -  kích hoạt)
// extension=php_gd.dll
// hoac extension=gd
// hoac extension=php_gd2.dll
// tuy theo phien ban
    function create_img_qc_img_to_qc_img($alt,$url){
        $data = array(
            'alt'=> $alt,
            'url'=> $url,
            'date_create' => current_time('mysql'),
        );
        global $wpdb;
        $table = $wpdb->prefix . 'qc_img';
        $rs=$wpdb->insert(
            $table,
            $data
        );
        $object = new stdClass();
        if($rs==1){
            $home=home_url();
            $lastid = $wpdb->insert_id;
            $object->id=$lastid;
            $object->img=$home.'/'.$url;
            $object->alt=$alt;
            
        }
        send($object);
        

    }
    function edit_and_save($text,$img_url){
       
            $random_id='AB_'.generateRandomString(4);
            $random_url='-'.generateRandomString(4);
            try{
                $options = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ),
                );
                $image_data = file_get_contents($img_url,false,stream_context_create($options));
                $temp_file = tempnam(sys_get_temp_dir(), 'image');
                file_put_contents($temp_file, $image_data);
                $jpg_image = imagecreatefromjpeg($temp_file);

                if($jpg_image==false) throw new Exception("FF");
                $orig_width = imagesx($jpg_image);
                $orig_height = imagesy($jpg_image);

                // Allocate A Color For The background
                // $bcolor=imagecolorallocate($jpg_image, 0x00, 0xC0, 0xFF);

                //Create background
                // imagefilledrectangle($jpg_image,  0, $orig_height*0.92, $orig_width, $orig_height, $bcolor);

                // Set Path to Font File
                $font_path = realpath(dirname(__FILE__)).'/lib/arial.ttf';

                // Set Text to Be Printed On Image
                // $text = "Võ Thành Danh";

                // Allocate A Color For The Text
                $color = imagecolorallocate($jpg_image, 0, 0, 0);      

                // Print Text On Image
                imagettftext($jpg_image,  20, 0, 10, $orig_height*0.92+40, $color, $font_path, $random_id);
                //
                    // // Set the Content Type
                    // header('Content-type: image/jpg');

                    // // Send Image to Browser
                    // imagejpeg($jpg_image);
                //
                $uniqueId = fixForUri($text).$random_url; // Create unique name for the new image

                $imagePath = wp_upload_dir()['path'] . '/' . $uniqueId . '.jpg';
                imagejpeg($jpg_image,  $imagePath); // Save image in the media folder
                unlink($temp_file);
                imagedestroy($jpg_image);
                preg_match_all('/wp-content(.+?)*/', $imagePath, $matches);
                create_img_qc_img_to_qc_img($text,$matches[0][0]);

                
                
            }
            catch(Exception $e) {
                if($e->getMessage()=="FF"){
                    $myArray[] = (object) [];
                    send($myArray,false);
                }
            }
       
    }
    // edit_and_save("tao nè mày, ngon lành rồi đó","https://cofa.vn/wp-content/uploads/2022/12/ke-tu-de-giay.jpg");
    if(is_user_logged_in()){
        if($_POST){
            $text=$_POST['alt'];
            $img_url=$_POST['img'];
            edit_and_save($text,$img_url);
        }
    }

?>
