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
    <meta property="og:image:height" content="640">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="<?php echo $common->header->icon_mini_url; ?>" sizes="192x192">
    <link rel="apple-touch-icon" href="<?php echo $common->header->icon_mini_url; ?>">
    <meta name="msapplication-TileImage" content="<?php echo $common->header->icon_mini_url; ?>">
    <script defer="defer" src="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/page/qc/home/lazyload.js"></script>
    <link href="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/page/qc/home/style.css" rel="stylesheet">
    <?php
        // gg code header here
        echo $common->code_gg->code_header;
    ?>
</head>
<body style="background-color: #deb887;">
    <?php
        // gg code body here
        echo $common->code_gg->code_body;
    ?>
    <?php 
       require_once(get_stylesheet_directory().'/templates/page/qc/home/index.php');
    ?>
</body>
</html>