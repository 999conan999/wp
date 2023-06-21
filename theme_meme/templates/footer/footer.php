<?php 
$footer='';
if($typez=="page"||$typez=="post"|| $typez=="cate_1"|| $typez=="cate_2"|| $typez=="old_cate"){
   $sp_qc=get_list_sp(-1);
   $footer.='<footer id="footerz"><div class="container"><span style=" font-size: 20px; display: block; margin-bottom: 11px; color: #993a3a; ">* Sản phẩm của '.$home_name.'</span><ul class="row listzz">';
   $footer.=$sp_qc;
   $footer.='</ul></div><div class="footer-bottom" style=" padding-top: 0px; "><div class="sol textz"><p style="margin: 0px;">'.$common->design_by.'</p></div></div></footer>';
}else{
   $footer.='<footer id="footerz">';
      $footer.='<div class="bg1">';
         $footer.='<img data-src="'.$home_url.'/wp-content/themes/theme_meme/templates/src/footer_bg.svg" class="lazyload">';
      $footer.='</div>';
      $footer.='<div class="content-footer">';
         $footer.='<div class="container"><div class="row">';   
            $footer.='<div class="col-12 col-sm-6 col-lg-3">';
               $footer.='<div class="logoz">';
                  $footer.='<div class="icon-contact">';
                     $footer.='<a href="'.$home_url.'"><img data-src="'.$common->logo_website.'" class="header-logo-dark lazyload" alt="cofa.vn"></a>';
                        $footer.='<ul class="ulicon">';
                           $footer.='<li class="bnb">';
                              $footer.='<a><img data-src="'.$home_url.'/wp-content/themes/theme_meme/templates/src/fb.svg" class="lazyload"></a>';        
                           $footer.='</li>';
                           $footer.='<li class="bnb">';
                              $footer.='<a><img data-src="'.$home_url.'/wp-content/themes/theme_meme/templates/src/inta.svg"class="lazyload"></a>';
                           $footer.='</li>';
                           $footer.='<li class="bnb">';
                              $footer.='<a><img data-src="'.$home_url.'/wp-content/themes/theme_meme/templates/src/youtube.svg"class="lazyload"></a>';
                           $footer.='</li>';
                           $footer.='<li class="bnb">';
                              $footer.='<a><img data-src="'.$home_url.'/wp-content/themes/theme_meme/templates/src/ping.svg" class="lazyload"></a>';
                           $footer.='</li>';
                        $footer.='</ul>';
                  $footer.='</div>';
                  $footer.='<p style="color: rgb(244, 235, 191); font-size: 14px; text-align: center;"><strong>Địa chỉ</strong> : '.$common->dia_chi.'</p>';
               $footer.='</div>';
            $footer.='</div>';
            $footer.='<div class="col-12 col-sm-6 col-lg-3">';
               $footer.='<div class="aboutz">';
                  $footer.='<span class="titlez">Thông tin</span>';
                  $footer.='<ul class="listz">'; 
                     foreach($common->about_footer as $x){
                        $footer.='<li><a href="'.$x->link.'" title="'.$x->name.'">'.$x->name.'</a></li>';
                     }
                  $footer.='</ul>';
                  $footer.='</div>';
               $footer.='</div>';
               $footer.='<div class="col-12 col-sm-6 col-lg-3">';
                  $footer.='<div class="aboutz">';
                     $footer.='<span class="titlez">CHÍNH SÁCH</span>';
                     $footer.='<ul class="listz">';
                        foreach($common->privacy_footer as $x){
                           $footer.='<li><a href="'.$x->link.'" title="'.$x->name.'">'.$x->name.'</a></li>';
                        }
                     $footer.='</ul>';
                  $footer.='</div>';
               $footer.='</div>';
               $footer.='<div class="col-12 col-sm-6 col-lg-3">';
                  $footer.='<div class="aboutz">';
                     $footer.='<span class="titlez">Thông tin liên quan</span>';
                     $footer.='<ul class="listz">';
                        foreach($common->jobs_footer as $x){
                           $footer.='<li><a href="'.$x->link.'" title="'.$x->name.'">'.$x->name.'</a></li>';
                        }
                     $footer.='</ul>';
                  $footer.='</div>';
               $footer.='</div>';
         $footer.='</div></div>';
      $footer.='</div>';
      $footer.='<div class="footer-bottom">';
         $footer.='<div class="sol textz">';
            $footer.='<p style="margin: 0px;">'.$common->design_by.'</p>';
         $footer.='</div>';
      $footer.='</div>';
      $footer.='</footer>';
}
?>