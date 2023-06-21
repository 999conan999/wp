<?php
    require_once(get_stylesheet_directory().'/templates/archive/control_archive.php');
?>
 <!DOCTYPE html>
<html lang="vi" >
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $post_infor->contents->title; ?> | <?php echo $home_name; ?> </title>
    <meta name="description" content="<?php echo $post_infor->contents->short_des; ?>">
    <link rel="canonical" href="<?php echo  $current_url;?>">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $post_infor->contents->title; ?>">
    <meta property="og:description" content="<?php echo $post_infor->contents->short_des; ?>">
    <meta property="og:url" content="<?php echo  $current_url;?>">
    <meta property="og:site_name" content="<?php echo $home_name; ?>">
    <meta property="og:image" content="<?php echo $post_infor->phu->thumnail; ?>">
    <meta property="og:image:width" content="640">
    <meta property="og:image:height" content="360">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="<?php echo $common->header->icon_mini_url; ?>" sizes="192x192">
    <link rel="apple-touch-icon" href="<?php echo $common->header->icon_mini_url; ?>">
    <meta name="msapplication-TileImage" content="<?php echo $common->header->icon_mini_url; ?>">
 <script type="application/ld+json">
    {"@context":"https://schema.org","@type":"ItemList","itemListElement":[{"@type":"ListItem","item":{"@type":"Thing","url":"<?php echo $home_url; ?>","@id":"<?php echo $home_url; ?>#1","name":"Trang chủ"},"position":1},{"@type":"ListItem","item":{"@type":"Thing","url":"<?php echo $post_infor->phu->category_link; ?>","@id":"<?php echo $post_infor->phu->category_link; ?>#2","name":"<?php echo $post_infor->phu->category_name; ?>"},"position":2}]} 
</script>
<?php if($post_infor->phu->show_slide==true){?>
    <script type="application/ld+json">
    {
        "@context": "http://schema.org/",
        "@type": "Product",
        "name": "<?php echo $post_infor->contents->title; ?>",
        "image": "<?php echo $post_infor->phu->thumnail; ?>",
        "description": "<?php echo $post_infor->contents->short_des; ?>",
        "url": "<?php echo  $current_url;?>",
        "sku": "BK<?php echo  $id;?>",
        "brand": {
            "@type": "Brand",
            "name": "OEM"
        },
        "mpn": "AB<?php echo  $id;?>",
        "review": {
            "@type": "Review",
            "reviewRating": {
            "@type": "Rating",
            "ratingValue": "<?php echo $post_infor->phu->rating; ?>",
            "bestRating": "5"
            },
            "author": {
            "@type": "Person",
            "name": "<?php echo $home_name; ?>"
            }
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "<?php echo $post_infor->phu->rating; ?>",
            "reviewCount": "<?php echo rand(100,999); ?>"
        },
        "offers": {
            "@type": "Offer",
            "url": "<?php echo  $current_url;?>",
            "priceCurrency": "VND",
            "price": "<?php echo $post_infor->contents->price_ins; ?>",
            "priceValidUntil": "<?php echo date('Y'); ?>-30-12",
            "itemCondition": "https://schema.org/NewCondition",
            "availability": "https://schema.org/InStock",
            "seller": {
            "@type": "Organization",
            "name": "<?php echo $home_name; ?>"
            }
        }
    }
    </script>
<?php }?>
    <?php
        // gg code header here
        echo $common->code_gg->code_header;
    ?>

    <script type="text/javascript">
      window.data=<?php echo json_encode($data) ?>
    </script>
    <script defer="defer" src="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/single/static/js/main.5dad9bad.js"></script>
    <link href="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/single/static/css/main.d506b0c3.css" rel="stylesheet">
</head>
<body  style="background-color: #deb887;">
    <?php
        // gg code body here
        echo $common->code_gg->code_body;
    ?>
    <div id="root">
        <?php  require_once(get_stylesheet_directory().'/templates/header/header.php'); ?>
        <?php  require_once(get_stylesheet_directory().'/templates/single/server_render_single.php'); ?>
        <?php require_once(get_stylesheet_directory().'/templates/footer/footer.php'); ?>
    </div>
</body>
</html>