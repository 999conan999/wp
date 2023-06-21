<?php
    require_once(get_stylesheet_directory().'/templates/fs_common_theme.php');
    $obj=get_queried_object();
    $id=$obj->ID;

    $time_cache=get_post_meta($id,'time_cache', true);//
    $data_setup_cache_meme_theme=get_setup_cache_meme_theme();
    $is_action_cache=true;
    if($time_cache!=""&&$data_setup_cache_meme_theme->is_turn_cache){
        // co data cache
        $denta_time=time()-(int)$time_cache;
        
        if($denta_time<(int)$data_setup_cache_meme_theme->time_cache){
            $time_cache=get_post_meta($id,'data_cache', true);//
            $is_action_cache=false;
            echo $time_cache;
        }
    }

if($is_action_cache){
    require_once(get_stylesheet_directory().'/templates/single/control.php');
    require_once(get_stylesheet_directory().'/templates/header/header.php');
    require_once(get_stylesheet_directory().'/templates/footer/footer.php');
    // add lazy load hinh thu 12  
    $a=explode("src=", $data_metaA->long_des);
    if(count($a)>1){
        $data_metaA->long_des=$a[0];
        for($i=1;$i<count($a);$i++){
            if($i<13){
                $data_metaA->long_des.="src=".$a[$i];
            }else{
                $data_metaA->long_des.='class="lazyload" data-src='.$a[$i];
            }
        }
    }
    // end add lazy load
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
                $rs.='<link href="'.$home_url.'/wp-content/themes/theme_meme/templates/src/style-bv.css" rel="stylesheet">';
                $rs.='<script defer="defer" src="'.$home_url.'/wp-content/themes/theme_meme/templates/src/lazyload.js"></script>';
                $rs.=$schema;
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
                                $rs.='<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item"  href="'.$home_url.'" target="_blank"><i itemprop="name">'.$home_name.'</i></a><meta itemprop="position" content="1"></span>';
                                $rs.=$menu_breacrum->breakcrum;
                            $rs.='</div>';
                        $rs.='</div>';
                        $rs.='<div class="sty">';
                            $rs.='<section class="contents">';
                                $rs.='<h1 class="title">'.$data_metaA->title.'</h1>';
                                // $rs.='<div class="price">Giá : <span class="insz"><ins>1.900.000 đ </ins></span><span style="display: none;">Còn hàng</span></div>';
                                $rs.='<div class="short-des">'.$data_metaA->short_des.'.</div>';
                                $rs.='<div class="long-des">';
                                // ===>
                                $content=$data_metaA->long_des;
                                $content= str_replace('</h2>','</h2>
',$content);// khong duoc dua len tren, neu dua len tren se bi loi
                                preg_match_all('/<h2>(.*)<\/h2>/', $content, $h2_content_arr);
                                $menu='<ul>';
                                $ii=0;
                                foreach ($h2_content_arr[1] as &$h2_content) {
                                    $ii++;
                                    $trip_h2=strip_tags ( $h2_content);
                                    $value1=fixForUri($trip_h2);
                                    $url_ao_0=str_replace(".","",$value1);
                                    $url_ao_1=str_replace("  ","",$url_ao_0);
                                    $url_ao_2=str_replace(" ","_",$url_ao_1);
                                    $content=str_replace('<h2>'.$h2_content.'</h2>','<h2 id="'.$url_ao_2.'">'.$ii.'. '.$h2_content.'</h2>',$content);
                                    $menu .='<li><a href="#'.$url_ao_2.'">'.$ii.'. '.$trip_h2.'</a></li>';
                                }
                                $menu .='</ul>';
                                    $menu ='<div class="toc"><h2>Nội dung chính</h2>'.$menu.'</div>';   
                                // ===>
                                    $rs.=$menu.$content;
                                    $rs.='</div>';
                                    if (property_exists($data_metaA, 'shop_adress')) {
                                        if($data_metaA->shop_adress!=""){
                                            $rs.='<div id="dia-chi" class="show-adress">';
                                            $rs.=$data_metaA->shop_adress;
                                            $rs.='</div>';
                                        }
                                    }
                                    $rs.='</section>';
                                    $rs.='</div>';
                        $rs.='<div class="rum">';
                            $rs.='<h4 class="hes">* Bài viết liên quan</h4>';
                            $rs.='<ul class="row lit">';
                                $a=get_posts_by_id_cate($menu_breacrum->id_category);
                                $rs.=$a;
                            $rs.='</ul>';
                        $rs.='</div>';
                    $rs.='</div>';
                    $a=get_metaA_cate_by_id($menu_breacrum->id_category);
                    if($a->ref_url!=''){
                    $rs.='<div id="scrollTop" class="contactsx"><div class="rap-contanct">👉<a href="'.$a->ref_url.'" class="contacktsx" target="_blank">'.$a->ref_title.'</a></div></div>';
                    }
                $rs.='</main>';
                //
                $rs.= $footer;
                $rs.='<script type="text/javascript"> document.getElementById("menu-mb").addEventListener("click", () => { document.getElementById("set-menu").classList.remove("hide-menu"); document.getElementById("set-menu").classList.add("show-menu"); }); function hide_menu() { document.getElementById("set-menu").classList.add("hide-menu"); document.getElementById("set-menu").classList.remove("show-menu"); } let ww = document.getElementsByClassName("danhdev-product")[0].offsetWidth; var imgElements = document.querySelectorAll(".zz"); imgElements.forEach(e => { e.style.height = (ww - 2) + "px"; }); let wz = document.getElementById("cccx").offsetWidth; var uu = document.getElementById("ccck").style.height = wz + "px";</script>';
                //
                if($a->ref_url!=''){
                    $rs.='<script type="text/javascript">
                    var randomNumber = Math.floor(Math.random() * (8))*1000;
                    var scrollTop = document.querySelector("#scrollTop");
                    window.addEventListener("scroll", function(){
                        if(this.scrollY>randomNumber){
                            scrollTop.style.display = "block";
                        }else{
                            scrollTop.style.display = "none";
                        }
                    })
                    </script>';
                }
                //
                $rs.=$common->code_footer;
            $rs.='</body>';
        $rs.='</html>';
        if($data_setup_cache_meme_theme->is_turn_cache){
            $time_cache=time();
            update_post_meta( $id, 'time_cache', $time_cache);
            update_post_meta( $id, 'data_cache', $rs);
        }
        echo $rs;
}

?>