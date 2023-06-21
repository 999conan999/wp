<?php

    $common= get_common();//
    $typez='post';
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $metaA=get_post_meta($id,'metaA', true);
    $data_metaA=json_decode($metaA);
    if($data_metaA==NULL){
        header("Location: ".$home_url,TRUE,301);
        die();
    }
    $current_url=get_permalink($id);
    $category_parent=-1;// khong tac dung gi ca
    if (!property_exists($data_metaA, 'title')) {
        $data_metaA->title=$data_metaA->titleS;
        $data_metaA->long_des=get_post_field('post_content', $id);
    }
    // 
    $year=date("Y");
    $vote= $id+($year-2000)*10+date("m")*2;
    $rate=4+rand(0,9)/10;
    $highPrice=rand(9,12)*100000;
    $schema='<script type="application/ld+json">';
    $schema.='{"@context": "http://schema.org/","@type": "Product","name":"'.$data_metaA->title.'","image":"'.$data_metaA->thumnail.'","description":"'.$data_metaA->short_des.'","url":"'.$current_url.'","sku":"'.$id.'","brand":{"@type": "Brand","name":"OEM"},"mpn":"COFA'.$id.'","review": {"@type": "Review","reviewRating": {"@type": "Rating","ratingValue": "'.$rate.'","bestRating": "5"},"author": {"@type": "Person","name": "'.$home_name.'"}},"aggregateRating": {"@type": "AggregateRating","ratingValue": "'.$rate.'","reviewCount": "'.$vote.'"},"offers": {"@type": "AggregateOffer","url":"'.$current_url.'","offerCount": "'.rand(10,999).'","priceCurrency": "VND","lowPrice": "400000","highPrice": "'.$highPrice.'","priceValidUntil": "'.$year.'-12-12","itemCondition": "https://schema.org/NewCondition","availability": "https://schema.org/InStock","seller": {"@type": "Organization", "name": "'.$home_name.'"}}}';
    $schema.='</script>';
?>