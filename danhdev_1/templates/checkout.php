<?php
/*
Template Name: Trang thanh toán
*/
?>
<?php 
    $obj=get_queried_object();
    $id=$obj->ID;
    $common= get_common();//
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $current_url=get_permalink($id);
?>

<!DOCTYPE html>
<html lang="vi" >
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Thanh toán | <?php echo $home_name; ?> </title>
    <meta name="description" content="Thanh toán cho sản phẩm này, chúng tôi sẽ liên hệ và giao hàng trong vòng 24h">
    <link rel="canonical" href="<?php echo  $current_url;?>">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Trang thanh toán">
    <meta property="og:description" content="Thanh toán cho sản phẩm này, chúng tôi sẽ liên hệ và giao hàng trong vòng 24h">
    <meta property="og:url" content="<?php echo  $current_url;?>">
    <meta property="og:site_name" content="<?php echo $home_name; ?>">
    <link rel="icon" href="<?php echo $common->header->icon_mini_url; ?>" sizes="192x192">
    <link rel="apple-touch-icon" href="<?php echo $common->header->icon_mini_url; ?>">
    <meta name="msapplication-TileImage" content="<?php echo $common->header->icon_mini_url; ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link href="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/page/qc/order/style.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', serif;
            font-size: 15px;
        }
    </style>
    <?php
        // gg code header here
        echo $common->code_gg->code_header;
    ?>
</head>
<body>
    <?php
        // gg code body here
        echo $common->code_gg->code_body;
    ?>
    <?php 
        require_once(get_stylesheet_directory().'/templates/page/qc/order/index.php');
    ?>
    <script type="text/javascript" src="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/page/qc/order/jquery.js"></script>
    <script type="text/javascript" async="" src="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/page/qc/order/script.js"></script>
</body>
</html>