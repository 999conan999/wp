<?php
if (!function_exists('create_qc_img_table')) {
    function create_qc_img_table(){
        global $wpdb;
        $name_table=$wpdb->prefix .'qc_img';
        $charsetCollate = $wpdb->get_charset_collate();
        $createTable = "CREATE TABLE IF NOT EXISTS `{$name_table}` (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `alt` varchar(200) NULL,
            `url` varchar(200) NULL,
            `date_create` timestamp NOT NULL,
            PRIMARY KEY (`id`)
        ) {$charsetCollate};";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $createTable );
    }
}
if(is_user_logged_in()){
    add_action("after_switch_theme", "mytheme_do_something");
    function wp_register_theme_activation_hook($code, $function) {
        create_qc_img_table();
}
}
if (!function_exists('fixForUri')) {
    function fixForUri($strX, $options = array()) {
        $str=delete_all_between("(",")",$strX);
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
        
        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => true,
        );
        
        // Merge options
        $options = array_merge($defaults, $options);
        
        // Lowercase
        if ($options['lowercase']) {
            $str = mb_strtolower($str, 'UTF-8');
        }
        
        $char_map = array(
            // Latin
            'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'đ' => 'd', 'é' => 'e', 'è' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e', 'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y'
        );
        
        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
        
        // Transliterate characters to ASCII
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }
        
        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
        
        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
        
        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
        
        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);
        
        return $str;
    }
}
// xoa tat ca ki tu ben trong 2 truong cho truoc
if (!function_exists('delete_all_between')) {
    function delete_all_between($beginning, $end, $string) {
        $beginningPos = strpos($string, $beginning);
        $endPos = strpos($string, $end);
        if ($beginningPos === false || $endPos === false) {
        return $string;
        }

        $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

        return delete_all_between($beginning, $end, str_replace($textToDelete, '', $string)); // recursion to ensure all occurrences are replaced
    } 
}
function get_common(){
    $common=get_option('setup_meme_theme');
    if($common){
        $rs= json_decode(stripslashes($common));
        return $rs;
    }else{
        return false;
    }
}
function get_setup_cache_meme_theme(){
    $setup_cache=get_option('setup_cache_meme_theme');
    if($setup_cache){
        $rs= json_decode(stripslashes($setup_cache));
        return $rs;
    }else{
        $object = new stdClass();
        $object->is_turn_cache=true;
        $object->time_cache=true;
        return $object;
    }
}
function get_menu_breacrum($type,$id,$category_parent){
    $obj = new stdClass();
    if($type=='page'){
        $obj->breakcrum='';
        $obj->id_category=-1;
        global $wpdb;
        $table_prefix=$wpdb->prefix .'term_taxonomy';
        $sql = $wpdb->prepare( "SELECT term_id FROM $table_prefix WHERE taxonomy ='category' AND description = '1' ORDER BY term_id ASC");
        $results = $wpdb->get_results( $sql , OBJECT );
        $rs='';
        foreach($results as $x){
            $id=$x->term_id;
            $cat = get_category( $id );
            $title=$cat->name;
            $link=get_category_link($id);
            $rs.='<li><a onclick="hide_menu()" href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';
        }
        $obj->menu=$rs;
        return($obj);
    }elseif($type=='post'){
        $xx=get_the_category($id);
        $id_cate_parent=$xx[0]->category_parent;
        $rs='';
        $breakcrum='';
        if($id_cate_parent!=0){// danh cho meme theme
            $cat = get_category( $id_cate_parent );
            $title=$cat->name;
            $link=get_category_link($id_cate_parent);
            $rs.='<li><a onclick="hide_menu()" href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';
            $breakcrum.=' / <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item"  href="'.$link.'" target="_blank"><i itemprop="name">'.$title.'</i></a><meta itemprop="position" content="2" ></span>';
        }
            $title=$xx[0]->name;
            $link=get_category_link($xx[0]->term_id);
            $breakcrum.=' / <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item"  href="'.$link.'" target="_blank"><i itemprop="name">'.$title.'</i></a><meta itemprop="position" content="3" ></span>';
            global $wpdb;
            $table_prefix=$wpdb->prefix .'term_taxonomy';
            $sql = $wpdb->prepare( "SELECT term_id FROM $table_prefix WHERE taxonomy ='category' AND parent= %d ORDER BY term_id ASC",$id_cate_parent);
            $results = $wpdb->get_results( $sql , OBJECT );
            foreach($results as $x){
                $id=$x->term_id;
                $cat = get_category( $id );
                if($id_cate_parent!=0){// danh cho meme theme
                    $title=$cat->name;
                    $link=get_category_link($id);
                    $rs.='<li><a onclick="hide_menu()" href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';
                }else{// danh cho theme cu
                    if($cat->count>0){
                        $title=$cat->name;
                        $link=get_category_link($id);
                        $rs.='<li><a onclick="hide_menu()" href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';
                    }
                }
            }
        // }else{ // danh cho theme cu
        //     $cat = get_category( $xx[0]->term_id );
        //     $title=$cat->name;
        //     $link=get_category_link($xx[0]->term_id);
        //     $rs.='<li><a onclick="hide_menu()" href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';
        //     $breakcrum.=' / <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item"  href="'.$link.'" target="_blank"><i itemprop="name">'.$title.'</i></a><meta itemprop="position" content="2" ></span>';
        // }
        $obj->menu=$rs;
        $obj->breakcrum=$breakcrum;
        $obj->id_category=$xx[0]->term_id;
        return $obj;
    }elseif($type=='cate_2'){
        $rs='';
        $breakcrum='';
        $cat = get_category( $category_parent );
        $title=$cat->name;
        $link=get_category_link($category_parent);
        $rs.='<li><a onclick="hide_menu()" href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';
        $breakcrum.=' / <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item"  href="'.$link.'" target="_blank"><i itemprop="name">'.$title.'</i></a><meta itemprop="position" content="2"></span>';
        global $wpdb;
        $table_prefix=$wpdb->prefix .'term_taxonomy';
        $sql = $wpdb->prepare( "SELECT term_id FROM $table_prefix WHERE taxonomy ='category' AND parent= %d ORDER BY term_id ASC",$category_parent);
        $results = $wpdb->get_results( $sql , OBJECT );
        foreach($results as $x){
            $id=$x->term_id;
            $cat = get_category( $id );
            $title=$cat->name;
            $link=get_category_link($id);
            $rs.='<li><a onclick="hide_menu()" href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';
        }
        $obj->menu=$rs;
        $obj->breakcrum=$breakcrum;
        $obj->id_category=$category_parent;
        return $obj;
    }elseif($type=='cate_1'){
        $rs='';
        $breakcrum='';
        $cat = get_category( $id );
        $title=$cat->name;
        $link=get_category_link($id);
        $rs.='<li><a onclick="hide_menu()" href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';
        $breakcrum.=' / <h1 class="fsx" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item"  href="'.$link.'" target="_blank"><i itemprop="name">'.$title.'</i></a><meta itemprop="position" content="2"></h1>';
        global $wpdb;
        $table_prefix=$wpdb->prefix .'term_taxonomy';
        $sql = $wpdb->prepare( "SELECT term_id FROM $table_prefix WHERE taxonomy ='category' AND parent= %d ORDER BY term_id ASC",$id);
        $results = $wpdb->get_results( $sql , OBJECT );
        foreach($results as $x){
            $id=$x->term_id;
            $cat = get_category( $id );
            $title=$cat->name;
            $link=get_category_link($id);
            $rs.='<li><a onclick="hide_menu()" href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';
        }
        $obj->menu=$rs;
        $obj->breakcrum=$breakcrum;
        $obj->id_category=$category_parent;
        return $obj;
    }elseif($type=='home'||$type=='old_cate'){
        $rs='';
        $list_cate=array();
        global $wpdb;
        $table_prefix=$wpdb->prefix .'term_taxonomy';
        $sql = $wpdb->prepare( "SELECT term_id,parent,description FROM $table_prefix WHERE taxonomy ='category' AND description = '1' AND parent=0 ORDER BY term_id ASC");
        $results = $wpdb->get_results( $sql , OBJECT );
        $rs='';
        foreach($results as $x){
            $id_cat=$x->term_id;
            $cat = get_category( $id_cat );
            // var_dump($cat); echo '<br>';echo '<br>';
            if($cat->count>0||$cat->description=='1'){
                $rs.='<li><a onclick="hide_menu()" href="'.get_category_link($id_cat).'" title="'.$cat->name.'">'.$cat->name.'</a></li>';
                array_push($list_cate,$id_cat);
            }
        }   
        $obj->menu=$rs;
        $obj->breakcrum='';
        $obj->id_category=-1;
        $obj->list_cate=$list_cate;
        return $obj;
    }
}
function get_list_sp($id){
        global $wpdb;
        $table_prefix=$wpdb->prefix .'posts';
        $sql = $wpdb->prepare( "SELECT ID,post_title FROM $table_prefix WHERE post_type ='qc' AND  post_status = 'publish' AND post_content='%d' ORDER BY post_date DESC",$id);
        $results = $wpdb->get_results( $sql , OBJECT );
        $rs='';
        foreach($results as $x){
        $title=$x->post_title;
        $url=get_permalink($x->ID);
        $rs.='<li class="col-12 col-md-3"><a href="'.$url.'" class="spcs" title="'.$title.'">'.$title.'</a></li>';

        }
        return $rs;
}
function get_list_sp_home($home_url,$home_name){
        global $wpdb;
        $table_prefix=$wpdb->prefix .'posts';
        $sql = $wpdb->prepare( "SELECT ID,post_title FROM $table_prefix WHERE post_type ='qc' AND  post_status = 'publish' AND post_content='%d' ORDER BY post_date DESC",-1);
        $results = $wpdb->get_results( $sql , OBJECT );
        $rs='<div class="lis-category"><div class="wraptt"><h2 class="title3z">Sản phẩm bán tại '.$home_name.'</h2></div><div class="wza"><ul class="cart-w row">';
        foreach($results as $x){
            $title=$x->post_title;
            $url=get_permalink($x->ID);
            $metaA=get_post_meta($x->ID,'metaA', true);
            $data_metaA=json_decode($metaA);
            $rs.='<li class="lza col-12 col-md-4 col-xl-3"><a class="card-3" href="'.$url.'" title="'.$title.'"> <div class="imgz-cart danhdev-product"><img class="zz lazyload" data-srcset="'.$data_metaA->thumnail.'" width="100%"></div> <h3>'.$title.'</h3> <div style=" padding-left: 8px; "><ins class="ins-cost costz">'.number_format($data_metaA->data_qc->data_trick->price, 0, '', '.').' đ</ins></div><div class="rating"><span class="star"><img class="lazyload" data-srcset="'.$home_url.'/wp-content/themes/theme_meme/templates/src/gift.svg"></span></div></a></li> ';

        }
        $rs.='</ul></div></div>';
        return $rs;
}
function get_posts_by_id_cate_2($id_cate){
    $args = array('cat' => $id_cate, 'post_status' => 'publish', 'orderby' => 'post_date', 'order' =>'DESC','posts_per_page' => -1);
    $results =query_posts($args);
    $rs='';    
    foreach($results as $x){
        $title=$x->post_title;
        $metaA=get_post_meta($x->ID,'metaA', true);
        $data_metaA=json_decode($metaA);
        $url=get_permalink($x->ID);
        $rs.='<li class="lza col-12 col-md-4 col-xl-3"><div class="card-3">';
        $rs.='<a href="'.$url.'"  title="'.$x->post_title.'"><div class="imgz-cart danhdev-product"><img class="zz lazyload" data-srcset="'.$data_metaA->thumnail.'" width="100%" alt=" Hình ảnh '.$x->post_title.'"></div></a>';
        $rs.='<a href="'.$url.'" title="'.$x->post_title.'"><h3>'.$x->post_title.'</h3></a></div></li>';
    }
    return $rs;
}
function get_posts_by_id_cate($id_cate){
    $args = array('cat' => $id_cate, 'post_status' => 'publish', 'orderby' => 'post_date', 'order' =>'DESC','posts_per_page' => -1);
    $results =query_posts($args);
    $rs='';    
    foreach($results as $x){
        $link=get_permalink($x->ID);
        $rs.='<li class="col-12 col-md-6"><a href="'.$link.'" class="spcs" title="'.$x->post_title.'">'.$x->post_title.'</a></li>';
    }
    return $rs;
}
function get_category_parent_post(){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'term_taxonomy';
    $sql = $wpdb->prepare( "SELECT term_id,parent,description FROM $table_prefix WHERE taxonomy ='category' AND parent=0 ORDER BY term_id ASC");
    $results = $wpdb->get_results( $sql , OBJECT );
    $rs='';
    foreach($results as $x){
        $id=$x->term_id;
        $cat = get_category( $id );

        if($cat->count>0){
            $rs.='<span><a href="'.get_category_link($id).'" class="tagsz" title="'.$cat->name.'">'.$cat->name.'</a></span>';
        }
    }   
    return $rs;
}
function get_list_bv_cate_1($id){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'term_taxonomy';
    $sql = $wpdb->prepare( "SELECT term_id,parent,description FROM $table_prefix WHERE taxonomy ='category' AND parent= %d ORDER BY term_id ASC",$id);
    $results_x = $wpdb->get_results( $sql , OBJECT );
    $rs='';
    foreach($results_x as $x){
        $cat = get_category( $x->term_id );
        if($cat->count>0){
            $rs.='<div class="lis-category"><div class="wraptt"><h2 class="title3z"><a href="'.get_category_link($x->term_id).'">'.$cat->name.'</a></h2></div><div class="wza">';
            // 
            $args = array('cat' => $x->term_id, 'post_status' => 'publish', 'orderby' => 'post_date', 'order' =>'DESC', 'posts_per_page' =>4,'offset' => 0);
            $results_y =query_posts($args);
            $rs.='<ul class="cart-w row">';
            foreach($results_y as $y){
                $metaA=get_post_meta($y->ID,'metaA', true);
                $src='';
                if($metaA!=""){
                    $data_metaA=json_decode($metaA);
                    if (property_exists($data_metaA, 'parent_Category')) {
                        $src=$data_metaA->thumnail;
                    }
                }
                $rs.='<li class="lza col-12 col-md-4 col-xl-3"><a class="card-3" href="'.get_permalink($y->ID).'" title="'.$y->post_title.'"><div class="imgz-cart danhdev-product"><img class="zz lazyload" data-srcset="'.$src.'" width="100%"  alt="'.$y->post_title.'"></div><h3>'.$y->post_title.'</h3></a></li>';
            }
            $rs.='</ul>';
            // 
            $args = array('cat' => $x->term_id, 'post_status' => 'publish', 'orderby' => 'post_date', 'order' =>'DESC', 'posts_per_page' =>16,'offset' => 4);
            $results_y =query_posts($args);
            if(count($results_y)>0){
                $rs.='<div class="wrpa"><ul class="list-posts row">';
                foreach($results_y as $y){
                    $rs.='<li class="col-12 col-md-6"><a href="'.get_permalink($y->ID).'" class="pd-6" title="'.$y->post_title.'">'.$y->post_title.'</a></li>';
                }
                $rs.='</ul></div>';
            }
            $rs.='<div class="frame"> <button class="custom-btn btn-1" onclick="location.replace(`'.get_category_link($x->term_id).'`)">Xem thêm</button> </div>';
            $rs.='</div></div>';

        }
    }
    return $rs;

}
// 
function get_list_bv_cate_home($list_id_parent){
    $rs='';
    foreach($list_id_parent as $x){
        $cat = get_category($x);
        // var_dump($cat); echo '<br>'; echo '<br>';
        // if($cat->count>0){

            // 
            $args = array('cat' => $x, 'post_status' => 'publish', 'orderby' => 'post_date', 'order' =>'DESC', 'posts_per_page' =>4,'offset' => 0);
            $results_y =query_posts($args);
            if(count($results_y)>0){
                $rs.='<div class="lis-category"><div class="wraptt"><h2 class="title3z"><a href="'.get_category_link($x).'">'.$cat->name.'</a></h2></div><div class="wza">';
                $rs.='<ul class="cart-w row">';
                foreach($results_y as $y){
                    $metaA=get_post_meta($y->ID,'metaA', true);

                    $src='';
                    if($metaA!=""){
                            $data_metaA=json_decode($metaA);
                            $src=$data_metaA->thumnail;
                    }
                    $rs.='<li class="lza col-12 col-md-4 col-xl-3"><a class="card-3" href="'.get_permalink($y->ID).'" title="'.$y->post_title.'"><div class="imgz-cart danhdev-product"><img class="zz lazyload" data-srcset="'.$src.'" width="100%"  alt="'.$y->post_title.'"></div><h3>'.$y->post_title.'</h3></a></li>';
                }
                $rs.='</ul>';
                // 
                $args = array('cat' => $x, 'post_status' => 'publish', 'orderby' => 'post_date', 'order' =>'DESC', 'posts_per_page' =>16,'offset' => 4);
                $results_y =query_posts($args);
                if(count($results_y)>0){
                    $rs.='<div class="wrpa"><ul class="list-posts row">';
                    foreach($results_y as $y){
                        $rs.='<li class="col-12 col-md-6"><a href="'.get_permalink($y->ID).'" class="pd-6" title="'.$y->post_title.'">'.$y->post_title.'</a></li>';
                    }
                    $rs.='</ul></div>';
                }
                $rs.='<div class="frame"> <button class="custom-btn btn-1" onclick="location.replace(`'.get_category_link($x).'`)">Xem thêm</button> </div>';
                $rs.='</div></div>';
            }

        // }
    }
    return $rs;

}
// 
if (!function_exists('get_data_search')) {
    function get_data_search($key){
        global $wpdb;
        $table_prefix=$wpdb->prefix .'posts';
        $sql = $wpdb->prepare( "SELECT ID,post_title FROM $table_prefix WHERE post_type ='post' AND  post_status ='publish' AND post_title LIKE %s ORDER BY post_date DESC LIMIT 20 OFFSET 0 ",'%'.$key.'%');
        $results = $wpdb->get_results( $sql , OBJECT );
        $rs='';
        foreach($results as $x){
            $link=get_permalink($x->ID);
            $rs.='<li class="col-12 col-md-6"><a href="'.$link.'" class="spcs" title="'.$x->post_title.'">'.$x->post_title.'</a></li>';
        }
        return($rs);
    }
    //
 
}
function get_metaA_cate_by_id($id_cate){
    $metaA=get_term_meta($id_cate,'metaA', true);
    $obj= new stdClass();
    if($metaA!=''){
        if(!is_array($metaA)){
            $data_metaA=json_decode($metaA);
            if (property_exists($data_metaA, 'ref_url')) {
                $obj->ref_url=$data_metaA->ref_url;
                $obj->ref_title=$data_metaA->ref_title;
            }else{
                $obj->ref_url='';
                $obj->ref_title='';
            }
        }else{
            $obj->ref_url='';
            $obj->ref_title='';
        }
    }else{
        $obj->ref_url='';
        $obj->ref_title='';
    }
    return $obj;
}
?>