<?php 
    require_once(get_stylesheet_directory().'/templates/search/control.php'); 
?>
<!DOCTYPE html>
<html lang="vi" >
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta property="og:type" content="article">
    <meta name="robots" content="<?php echo $is_show_bot? "index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1":"noindex, follow"; ?>">
    <meta property="og:locale" content="vi_VN">
    <title>Tìm kiếm: <?php  echo  $title; ?> | <?php  echo  $home_name; ?> </title>
    <meta property="og:title" content="<?php  echo  $title; ?> | <?php  echo  $home_name; ?>">
    <meta property="og:site_name" content="<?php echo $home_name; ?>">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="<?php echo $common->header->icon_mini_url; ?>" sizes="192x192">
    <link rel="apple-touch-icon" href="<?php echo $common->header->icon_mini_url; ?>">
    <meta name="msapplication-TileImage" content="<?php echo $common->header->icon_mini_url; ?>">
    <?php
        // gg code header here
        echo $common->code_gg->code_header;
    ?>
    <script type="text/javascript">
      window.data=<?php echo json_encode($data) ?>
    </script>
    <script defer="defer" src="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/search/static/js/main.ce7df725.js"></script>
    <link href="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/search/static/css/main.9a14c9f2.css" rel="stylesheet">
</head>

<body  style="background-color: #deb887;">
<?php
    // gg code body here
    echo $common->code_gg->code_body;
?>
    <div id="root">
        <?php  require_once(get_stylesheet_directory().'/templates/header/header.php'); ?>
        <?php // require_once(get_stylesheet_directory().'/templates/single/server_render_single.php'); ?>
        <?php require_once(get_stylesheet_directory().'/templates/footer/footer.php'); ?>
    </div>
</body>

</html>
