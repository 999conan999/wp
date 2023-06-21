<?php
    require_once(get_stylesheet_directory().'/templates/home/control_home.php');
?>
<!DOCTYPE html>
<html lang="vi" >
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $page_infor->contents->title; ?> | <?php echo $home_name; ?> </title>
    <meta name="description" content="<?php echo $page_infor->contents->short_des; ?>">
    <link rel="canonical" href="<?php echo  $home_url;?>">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $page_infor->contents->title; ?>">
    <meta property="og:description" content="<?php echo $page_infor->contents->short_des; ?>">
    <meta property="og:url" content="<?php echo  $home_url;?>">
    <meta property="og:site_name" content="<?php echo $home_name; ?>">
    <meta property="og:image" content="<?php echo $page_infor->phu->thumnail; ?>">
    <meta property="og:image:width" content="640">
    <meta property="og:image:height" content="360">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="<?php echo $common->header->icon_mini_url; ?>" sizes="192x192">
    <link rel="apple-touch-icon" href="<?php echo $common->header->icon_mini_url; ?>">
    <meta name="msapplication-TileImage" content="<?php echo $common->header->icon_mini_url; ?>">
    <script type="application/ld+json">{
        "@context": "https://schema.org/",
        "@type": "Organization",
        "name": "<?php echo $page_infor->contents->title; ?>",
        "url": "<?php echo  $home_url;?>",
        "description": "<?php echo $page_infor->contents->short_des; ?>",
        "sameAs" :[] ,
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "<?php echo $common->lien_he->sdt_hotline; ?>",
            "contactType": "customer service",
            "areaServed": "VN"
        } 
    }</script>
    <script type="application/ld+json">{
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "<?php echo $page_infor->contents->title; ?>",
        "image":"<?php echo $page_infor->phu->thumnail; ?>",
        "description":"<?php echo $page_infor->contents->short_des; ?>",
        "url": "<?php echo  $home_url;?>"
    }</script>
    <script type="application/ld+json">{
        "@context":"http://schema.org",
        "@type":"FurnitureStore",
        "additionaltype":[
            "https://en.wikipedia.org/wiki/Online_shopping",
            "https://en.wikipedia.org/wiki/Household_goods"
        ],
        "@id":"<?php echo  $home_url;?>",
        "url":"<?php echo  $home_url;?>",
        "image":"<?php echo $page_infor->phu->thumnail; ?>",
        "logo":{
            "@type":"ImageObject",
            "url":"<?php echo $common->header->logo; ?>",
            "width":{
                "@type":"QuantitativeValue",
                "value": 203        },
            "height":{
                "@type":"QuantitativeValue",
                "value": 48        }
        },
        "priceRange":"10000VND - 10000000VND",
        "description":"<?php echo $page_infor->contents->short_des; ?>",
        "name":"<?php echo $home_name; ?>",
        "telephone":"<?php echo $common->lien_he->sdt_hotline; ?>",
        "openingHoursSpecification":[
            {
                "@type":"OpeningHoursSpecification",
                "dayOfWeek":[
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday"
                ],
                "opens":"8:00",
                "closes":"18:00"
            },
            {
                "@type":"OpeningHoursSpecification",
                "dayOfWeek":[
                    "Sunday"
                ],
                "opens":"8:30",
                "closes":"19:00"
            }
        ],
        "potentialAction":{
            "@type":"ReserveAction",
            "target":{
                "@type":"EntryPoint",
                "urlTemplate":"<?php echo  $home_url;?>",
                "inLanguage":"vn",
                "actionPlatform":[
                    "http://schema.org/DesktopWebPlatform",
                    "http://schema.org/IOSPlatform",
                    "http://schema.org/AndroidPlatform"
                ]
            },
            "result":{
                "@type":"Reservation",
                "name":"LIÊN HỆ"
            }
        },
    }</script>
    <?php
        // gg code header here
        echo $common->code_gg->code_header;
    ?>
    <script type="text/javascript">
      window.data=<?php echo json_encode($data) ?>
    </script>
    <script defer="defer" src="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/home/static/js/main.855fc4b7.js"></script>
    <link href="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/home/static/css/main.50b4f00d.css" rel="stylesheet">
</head>
<body  style="background-color: #deb887;">
    <?php
        // gg code body here
        echo $common->code_gg->code_body;
    ?>
    <div id="root">
        <?php require_once(get_stylesheet_directory().'/templates/header/header.php'); ?>
        <?php require_once(get_stylesheet_directory().'/templates/home/server_render_home.php'); ?>
        <?php require_once(get_stylesheet_directory().'/templates/footer/footer.php'); ?>
    </div>
</body>

</html>