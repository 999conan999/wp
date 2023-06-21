<?php
    $typez='cate_2';
    $time_cache=get_term_meta($id,'time_cache', true);//
    $data_setup_cache_meme_theme=get_setup_cache_meme_theme();
    $is_action_cache=true;
    if($time_cache!=""&&$data_setup_cache_meme_theme->is_turn_cache){
        // co data cache
        $denta_time=time()-(int)$time_cache;
        
        if($denta_time<(int)$data_setup_cache_meme_theme->time_cache){
            $time_cache=get_term_meta($id,'data_cache', true);//
            $is_action_cache=false;
            echo $time_cache;
        }
    }  

if($is_action_cache){
    require_once(get_stylesheet_directory().'/templates/archive/control.php');
    require_once(get_stylesheet_directory().'/templates/header/header.php');
    require_once(get_stylesheet_directory().'/templates/footer/footer.php');

        $rs='';
        $rs.='<!DOCTYPE html>';
        $rs.='<html lang="vi">';
            $rs.='<head>';
                $rs.='<meta name="viewport" content="width=device-width, initial-scale=1">';
                $rs.='<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">';
                $rs.='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
                $rs.='<title>'.$data_metaA->title.' | '.$home_name.' </title>';
                $rs.='<meta name="description" content="'.$data_metaA->short_des.'">';
                $rs.='<link rel="canonical" href="'.$current_url.'">';
                $rs.='<meta property="og:locale" content="vi_VN">';
                $rs.='<meta property="og:type" content="website">';
                $rs.='<meta property="og:title" content="'.$data_metaA->title.'">';
                $rs.='<meta property="og:description" content="'.$data_metaA->short_des.'">';
                $rs.='<meta property="og:url" content="'.$current_url.'">';
                $rs.='<meta property="og:site_name" content="'.$home_name.'">';
                $rs.='<meta property="og:image" content="'.$data_metaA->thumnail.'">';
                $rs.='<meta property="og:image:width" content="640">';
                $rs.='<meta property="og:image:height" content="640">';
                $rs.='<meta name="twitter:card" content="summary_large_image">';
                $rs.='<link rel="icon" href="'.$common->mini_icon.'" sizes="192x192">';
                $rs.='<link rel="apple-touch-icon" href="'.$common->mini_icon.'">';
                $rs.='<meta name="msapplication-TileImage" content="'.$common->mini_icon.'">';
                $rs.='<link href="'.$home_url.'/wp-content/themes/theme_meme/templates/src/style-home.css" rel="stylesheet">';
                $rs.='<script defer="defer" src="'.$home_url.'/wp-content/themes/theme_meme/templates/src/lazyload.js"></script>';
                $rs.=$common->code_header;
            $rs.='</head>';
            $rs.='<body style="background-color: #deb887;">';
                $rs.=$common->code_body;
                $rs.= $header;
                //
                $rs.='<main class="mainz">';
                    $rs.='<div class="container gt1 wrapcontentHome">';
                        $rs.='<div class="breakcrum">';
                            $rs.='<img src="'.$home_url.'/wp-content/themes/theme_meme/templates/src/home.svg">';
                            $rs.='<div class="h1zz fsx"  itemscope itemtype="https://schema.org/BreadcrumbList">';
                                $rs.='<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item"  href="'.$home_url.'" target="_blank" title="'.$home_name.'"><i itemprop="name">'.$home_name.'</i></a><meta itemprop="position" content="1"></span>';
                                $rs.=$menu_breacrum->breakcrum;
                                $rs.=' / <span class="fsx" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item"  href="'.$current_url.'" target="_blank" title="'.$data_metaA->title.'"><i itemprop="name">'.$data_metaA->title.'</i></a><meta itemprop="position" content="3"></span>';
                            $rs.='</div>';
                        $rs.='</div>';
                        //
                        $rs.='<div class="sty">';
                            $rs.='<div class="wrap-list">';
                                $rs.='<div class="lis-category">';
                                    $rs.='<div class="wraptt"><h2 class="title3z"><a href="'.$current_url.'" title="'.$data_metaA->title.'">'.$data_metaA->title.'</a></h2></div>';
                                    $rs.='<div class="wza">';
                                        $rs.='<ul class="cart-w row">';
                                            $list_bv=get_posts_by_id_cate_2($id);
                                            $rs.=$list_bv;
                                        $rs.='</ul>';
                                    $rs.='</div>';
                                $rs.='</div>';
                            $rs.='</div>';
                        $rs.='</div>';
                        // $rs.='<div class="container">';
                        //     $rs.='<span class="hes">* Bài viết: '.$data_metaA->title.'</span>';
                        //     $rs.='<ul class="row lit">';
                        //         $list_bv=get_posts_by_id_cate($id);
                        //         $rs.=$list_bv;
                        //     $rs.='</ul>';
                        // $rs.='</div>';
                    $rs.='</div>';
                $rs.='</main>';
                //
                $rs.= $footer;
                $rs.='<script type="text/javascript"> document.getElementById("menu-mb").addEventListener("click", () => { document.getElementById("set-menu").classList.remove("hide-menu"); document.getElementById("set-menu").classList.add("show-menu"); }); function hide_menu() { document.getElementById("set-menu").classList.add("hide-menu"); document.getElementById("set-menu").classList.remove("show-menu"); } let ww = document.getElementsByClassName("danhdev-product")[0].offsetWidth; var imgElements = document.querySelectorAll(".zz"); imgElements.forEach(e => { e.style.height = (ww - 2) + "px"; }); let wz = document.getElementById("cccx").offsetWidth; var uu = document.getElementById("ccck").style.height = wz + "px"; </script>';
                $rs.=$common->code_footer;
            $rs.='</body>';
        $rs.='</html>';
        if($data_setup_cache_meme_theme->is_turn_cache){
            $time_cache=time();
            update_term_meta( $id, 'time_cache', $time_cache);
            update_term_meta( $id, 'data_cache', $rs);
        }
        echo $rs;
}

?>