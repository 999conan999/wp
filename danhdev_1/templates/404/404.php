<?php
   $common= get_common();
   $home_url=get_home_url();
   $home_name=str_replace('https://', '', $home_url);
   $home_name=str_replace('http://', '', $home_name);
   $data=new stdClass();
   $data->common=$common;
   $data->data=$home_url;
?>
<!DOCTYPE html>
<html lang="vi" class=" w-mod-ix">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:title" content="404">
    <meta property="og:site_name" content="<?php echo $home_name; ?>">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="<?php echo $common->header->icon_mini_url; ?>" sizes="192x192">
    <link rel="apple-touch-icon" href="<?php echo $common->header->icon_mini_url; ?>">
    <meta name="msapplication-TileImage" content="<?php echo $common->header->icon_mini_url; ?>">
    <script type="text/javascript">
      window.data=<?php echo json_encode($data) ?>
    </script>
    <script defer="defer" src="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/404/static/js/main.7b14f002.js"></script>
    <link href="<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/404/static/css/main.c0624bf2.css" rel="stylesheet">
    <?php
        // gg code header here
        echo $common->code_gg->code_header;
    ?>
</head>

<body  style="background-color: #deb887;" >
    <?php
        // gg code body here
        echo $common->code_gg->code_body;
    ?>
    <div id="root">
        <?php require_once(get_stylesheet_directory().'/templates/header/header.php'); ?>
        <main class="mainz"><section class="page_404"><div class="container"><div class="row"><div class="col-sm-12 "><div class="col-sm-10 col-sm-offset-1  text-center"><div class="four_zero_four_bg" style="background-image: url(&quot;/wp-content/themes/danhdev_1/templates/404/static/media/hh.181c5a6430bcb77324b1.gif&quot;);"><h1 class="text-center ">404</h1></div><div class="contant_box_404"><h3 class="h2">Trang này không có!</h3><p>Hình như có sự nhầm lẫn gì rồi!</p><a href="http://localhost/cofanew" class="link_404">Quay lại trang chủ!</a></div></div></div></div></div></section></main>
        <?php require_once(get_stylesheet_directory().'/templates/footer/footer.php'); ?>
    </div>
</body>

</html>
