<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
 
    

 
    function telegram($msg,$telegrambot,$telegramchatid) {
        $url='https://api.telegram.org/bot'.$telegrambot.'/sendMessage';
        $data=array('chat_id'=>$telegramchatid,'text'=>$msg,'parse_mode'=>'html');
        $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
        $context=stream_context_create($options);
        $result=file_get_contents($url,false,$context);
        return $result;
    }

    if(isset($_POST['data'])){
        $data=json_decode(stripslashes(strip_tags($_POST['data'])));
            //text telegram here
            $API_telegram='5494055405:AAFK_qCVCmv33SUjE9-TdnQF0KBai4VDuzY';
            $Telegram_chat_id='1497494659';
 
                if($Telegram_chat_id!=''&&$API_telegram!=''){
                    $mss='';
                    $mss.='+ '.$data->name.' - <b>'.$data->kt.'</b> - <b>'.$data->g.'</b>'."\n";
                    $mss.='+ Số lượng : <b>'.$data->sl.'</b>'. "\n";
                    $mss.='+ Tổng tiền : <b>'.number_format((int)($data->sl)*(int)($data->g),0,",",".").' đ</b>'. "\n";
                    $mss.='+ Tên : <b>'.$data->z_name.'</b>'. "\n";
                    $mss.='+ Địa chỉ : <b>'.$data->z_address.'</b>'. "\n";
                    $mss.='+ Điện thoại : <b>'.$data->z_phone.'</b>'. "\n";
                    $mss.='+ Ghi chú : <b>'.$data->z_note.'</b>'. "\n";
                    $mss.='================'."\n";
                    $mss.='<pre>'.$data->url_sp.'</pre>'."\n";
                    $mss.=$data->img. "\n";
                    telegram($mss,$API_telegram,$Telegram_chat_id);
                }
            // 
    }
    
    

?>