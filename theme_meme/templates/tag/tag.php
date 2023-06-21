<?php 
    $home_url=get_home_url();
    header("Location: ".$home_url,TRUE,301);
    die();
?>