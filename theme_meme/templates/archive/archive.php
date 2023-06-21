<?php
    require_once(get_stylesheet_directory().'/templates/fs_common_theme.php');
    $obj=get_queried_object();
    $id=$obj->term_id;
    if($id==1){
        require_once(get_stylesheet_directory().'/templates/404/404.php');
        die;
    }
    $category_parent=$obj->category_parent;
    $is_old_theme=false;
    if($category_parent==0){
        if($obj->description=='1'||$obj->description=='0'){// cate_1 theme meme
            require_once(get_stylesheet_directory().'/templates/archive/cate_1.php');
        }else{// cate theme cu chuyen ve cate 2
            $is_old_theme=true;
            require_once(get_stylesheet_directory().'/templates/archive/cate_2.php');
        }
    }else{
        $xx=get_the_category($id);
        require_once(get_stylesheet_directory().'/templates/archive/cate_2.php');
    }
?>