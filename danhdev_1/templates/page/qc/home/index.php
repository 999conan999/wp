
    <div id="root" style="overflow:hidden;">
        <?php  require_once(get_stylesheet_directory().'/templates//page/qc/home/header.php'); ?>
        <main class="mainz">
            <div class="container gt1 wrapcontentHome">
                <div class="sty">
                    <?php 
                        if($data_qc->data_trick->is_show){
                    ?>
                    <div class="mo-ta-ngan row">
                        <div class="col-12 col-md-4 col-xl-4">
                            <div id="cccx">
                                <img id="ccck" class="lazyload" data-srcset="<?php echo $post_infor->phu->thumnail; ?>" width="100%">
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-xl-8">
                            <h3 class="tieude"><?php echo $post_infor->contents->title; ?></h3>
                            <div>
                                <span class="prices"><?php echo number_format($data_qc->data_trick->price,0,'.','.'); ?> đ</span>
                            </div>
                            <div class="mota-z"><?php echo $post_infor->contents->short_des; ?></div>
                            <div><span>Kích thước :</span> <b style=" color: black; "><?php echo $data_qc->data_trick->kt;?></b></div>
                            <div class="buttonzx">
                                <a href="<?php echo $url_og; ?>?p=order" style="text-decoration: none;" onclick='setdata(`{"img":"<?php echo $post_infor->phu->thumnail; ?>","title":"<?php echo $post_infor->contents->title; ?>","size":"<?php echo $data_qc->data_trick->kt;?>","price":"<?php echo $data_qc->data_trick->sale; ?>","sl":"1","url":"<?php echo $url_og; ?>"}`)'>
                                    <button id="order" class="ordery">
                                        <span class="mh2">Mua sản phẩm này</span>
                                        <span style=" font-size: 16px; ">giá: <b style="color: #ffc107;"><?php echo number_format($data_qc->data_trick->sale,0,'.','.'); ?> đ</b></span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="wrap-list">


                        <?php
                            foreach($data_qc->dm as $dm){
                        ?>
                            <div class="lis-category">
                                <div class="wraptt">
                                    <p id="giuong-sat-gia-re-1" class="title3z"><?php echo $dm->name; ?></p>
                                </div>
                                <div class="wza">
                                    <ul class="cart-w row">
                                        
                                            <?php
                                                foreach($dm->list_sp as $list_sp){
                                            ?>
                                                <li class="lza col-12 col-md-4 col-xl-3">
                                                    <a class="card-3"
                                                        href="?dm=<?php echo $dm->id ?>&dt=<?php echo $list_sp->id ?>">
                                                        <div class="imgz-cart danhdev-product">
                                                            <img class="zz lazyload"
                                                                data-srcset="<?php echo $list_sp->img; ?>"
                                                                width="100%">
                                                            
                                                        </div>
                                                        <h3><?php echo $list_sp->title; ?></h3>
                                                        <div><ins class="ins-cost costz"><?php echo number_format($list_sp->price,0,'.','.'); ?> đ</ins></div>
                                                        <div class="rating">
                                                            <span class="star">
                                                                <img class='lazyload' data-srcset='<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/page/qc/home/media/gift.svg'>
                                                            </span>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php
                                                }
                                            ?>
                                        
                                    </ul>

                                </div>
                            </div>
                        <?php
                            }
                        ?>

                    </div>
                </div>
            </div>
        </main>
        <?php  require_once(get_stylesheet_directory().'/templates//page/qc/home/footer.php'); ?>
    </div>
    <div class="fixed-tool">
        <ul class="ulz">
            <li><a href="tel:<?php echo $sdt; ?>"><i class="icon-phone calzs"
                        style="background-image: url('<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/page/qc/home/media/call.svg');"></i></a><span
                    class="aml-text-content aml-tooltiptext">Gọi ngay: <?php echo $phone_show;?></span></li>
            <li><a target="_blank" href="https://zalo.me/<?php echo $zalo; ?>"><i class="icon-zalo"
                        style="background-image: url('<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/page/qc/home/media/zalo.svg');"></i></a><span
                    class="aml-text-content aml-tooltiptext">Chat với chúng tôi qua Zalo</span></li>
            <li><a target="_blank" href="<?php echo $fb; ?>"><i class="icon-messenger"
                        style="background-image: url('<?php echo $home_url; ?>/wp-content/themes/danhdev_1/templates/page/qc/home/media/mess.svg');"></i></a><span
                    class="aml-text-content aml-tooltiptext">Facebook Messenger</span></li>
        </ul>
    </div>
    <script type="text/javascript">
        document.getElementById("menu-mb").addEventListener("click", () => { document.getElementById("set-menu").style.display = "flex"; });
        document.getElementById("dimmer").addEventListener("click", () => { document.getElementById("set-menu").style.display = "none"; });
        let ww=document.getElementsByClassName("danhdev-product")[0].offsetWidth;
        var imgElements = document.querySelectorAll(".zz");
        imgElements.forEach(e => {e.style.height=(ww-2)+"px";});
        let wz=document.getElementById("cccx").offsetWidth;
        var uu=document.getElementById("ccck").style.height=wz+'px';
        function setdata(data){ localStorage.setItem("order",data);}
   </script>
