<?php
    $obj=get_queried_object();
    $id=$obj->ID;
    $common= get_common();//
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $post_infor=get_page_infor($id);//
    $current_url=get_permalink($id);
    $url_og=$current_url;

    $metaA=get_post_meta($id,'metaA', true);
    $data_metaA=json_decode($metaA);
    $is_qc=false;
    if(property_exists($data_metaA, 'data_qc')&&$data_metaA->type=='qc'){
        $is_qc=true;
        $data_qc=$data_metaA->data_qc;
    //
    if($data_qc->canonical!='') $current_url=$data_qc->canonical;
    $sdt=$data_qc->sdt==''?$common->lien_he->sdt_hotline:$data_qc->sdt;
    $zalo=$data_qc->zalo==''?$common->lien_he->sdt_zalo:$data_qc->zalo;
    $fb=$data_qc->fb==''?$common->lien_he->url_fb:$data_qc->fb;
    $phone_show=substr($sdt, -10, -7) . "-" . substr($sdt, -7, -4) . "-" . substr($sdt, -4);
    } 
    if($is_qc==false){
        $data=new stdClass();
        $data->common=$common;
        $data->data=$post_infor;
    }

?>