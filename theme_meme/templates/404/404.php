
<?php
    require_once(get_stylesheet_directory().'/templates/fs_common_theme.php');
    $data_setup_cache_meme_theme=get_setup_cache_meme_theme();

    $common= get_common();//
    $typez='home';
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $category_parent=-1;// khong tac dung gi ca
    $id=-1;
 
    require_once(get_stylesheet_directory().'/templates/header/header.php');
    require_once(get_stylesheet_directory().'/templates/footer/footer.php');

        $rs='';
        $rs.='<!DOCTYPE html>';
        $rs.='<html lang="vi">';
            $rs.='<head>';
                $rs.='<meta name="viewport" content="width=device-width, initial-scale=1">';
                $rs.='<meta name="robots" content="noindex, nofollow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">';
                $rs.='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
                $rs.='<title>Không tìm thấy: | '.$home_name.' </title>';
                $rs.='<meta property="og:locale" content="vi_VN">';
                $rs.='<meta property="og:type" content="website">';
                $rs.='<meta property="og:title" content="Không tìm thấy:">';
                $rs.='<meta property="og:description" content="Trang không tìm thấy.">';
                $rs.='<meta property="og:site_name" content="'.$home_name.'">';
                $rs.='<meta property="og:image" content="'.$common->logo_website.'">';
                $rs.='<meta property="og:image:width" content="640">';
                $rs.='<meta property="og:image:height" content="640">';
                $rs.='<meta name="twitter:card" content="summary_large_image">';
                $rs.='<link rel="icon" href="'.$common->mini_icon.'" sizes="192x192">';
                $rs.='<link rel="apple-touch-icon" href="'.$common->mini_icon.'">';
                $rs.='<meta name="msapplication-TileImage" content="'.$common->mini_icon.'">';
                $rs.='<link href="'.$home_url.'/wp-content/themes/theme_meme/templates/src/style-bv.css" rel="stylesheet">';
                $rs.='<script defer="defer" src="'.$home_url.'/wp-content/themes/theme_meme/templates/src/lazyload.js"></script>';
            $rs.='</head>';
            $rs.='<body style="background-color: #deb887;">';
                $rs.= $header;
                //
                $rs.='<main class="mainz">';
                    $rs.='<div class="container gt1 wrapcontentHome">';
                        $rs.='<div class="breakcrum">';
                            $rs.='<img src="'.$home_url.'/wp-content/themes/theme_meme/templates/src/home.svg">';
                            $rs.='<div class="h1zz fsx">';
                            $rs.='<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item"  href="'.$home_url.'" target="_blank"><i itemprop="name">'.$home_name.'</i></a><meta itemprop="position" content="1"></span>';
                                // $rs.=' / <span class="fsx"><a href="/">Danh mục cấp 1</a></span>';
                            $rs.='</div>';
                        $rs.='</div>';
                        $rs.='<div class="sty">';
                            $rs.='<h1>404 Not found!</h1>';
                            $rs.='<p>Không có tìm thấy trang này.</p>';
                        $rs.='</div>';
                    $rs.='</div>';
                $rs.='</main>';
                //
                $rs.= $footer;
                $rs.='<script type="text/javascript"> document.getElementById("menu-mb").addEventListener("click", () => { document.getElementById("set-menu").classList.remove("hide-menu"); document.getElementById("set-menu").classList.add("show-menu"); }); function hide_menu() { document.getElementById("set-menu").classList.add("hide-menu"); document.getElementById("set-menu").classList.remove("show-menu"); } let ww = document.getElementsByClassName("danhdev-product")[0].offsetWidth; var imgElements = document.querySelectorAll(".zz"); imgElements.forEach(e => { e.style.height = (ww - 2) + "px"; }); let wz = document.getElementById("cccx").offsetWidth; var uu = document.getElementById("ccck").style.height = wz + "px"; </script>';
            $rs.='</body>';
        $rs.='</html>';
        echo $rs;

?>