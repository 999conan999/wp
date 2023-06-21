<?php
    require_once(get_stylesheet_directory().'/templates/page/control.php');
    if($is_qc){
        require_once(get_stylesheet_directory().'/templates/page/page_qc.php');
    }else{
        require_once(get_stylesheet_directory().'/templates/page/page_bv.php');
    }

?>
 