<?php
   $dm_param=$_GET['dm'];
   $dt_param=$_GET['dt'];
   foreach($data_qc->dm as $dm){
        if($dm->id==$dm_param){
            foreach($dm->list_sp as $list_sp){
                if($list_sp->id==$dt_param){
?>

    
    <div class="container bbz">
        <header id="header" class="header row">
            <div class="col-2 backz">
                <a  style=" cursor: pointer; "  onclick="history.back()">
                    Quay lại
                </a>
            </div>
            <div class="col-8 titlez" >
                <span><?php echo $list_sp->title; ?></span>
            </div>
        </header>
        <main>
            <?php
                foreach($list_sp->img_list as $img_list){
            ?>
            <div class="wrapz">
                <div class="danhdev-product">
                    <img class="imgz zz lazyload"
                    data-srcset="<?php echo  $img_list->img; ?>"
                        width="100%"
                    >
                </div>
                <div class="wrap-contents">
                    <div class="textz">
                        <?php 
                        if($img_list->price_og!=0&&$img_list->price_og!=''){
                        ?>
                            <p>Giá: <b style="color:#2196f3;"><?php echo number_format($img_list->price_og,0,'.','.'); ?> đ</b></p>
                        <?php 
                        }  
                        if($img_list->kt!=''){
                        ?>
                            <p>Kích thước: <b style="color:#2196f3;"><?php echo $img_list->kt; ?></b></p>
                        <?php } 
                            echo $img_list->mt;
                        ?>
                        <div class="divz"></div>
                    </div>
                    <?php
                        if($img_list->is_show_btn_buy==true){
                    ?>
                    <div class="orderz row">
                        <div class="col-5 pdr-3">
                            <a rel="nofollow" target="_blank" href="https://zalo.me/<?php echo $zalo; ?>" class="lhzl">
                                <span class="lh1">Liên hệ zalo</span>
                                <span style=" font-size: 15px; ">Đặt theo yêu cầu</span>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="<?php echo $url_og; ?>?p=order" style="text-decoration: none;"
                            onclick='setdata(`{"img":"<?php echo $img_list->img; ?>","title":"<?php echo $list_sp->title; ?>","size":"<?php echo $img_list->kt; ?>","price":"<?php echo $img_list->price_sale; ?>","sl":"1","url":"<?php echo $url_og; ?>"}`)'

                            >
                                <button id="order" class="ordery" >
                                    <span class="mh2">Mua sản phẩm này</span>
                                    <span style=" font-size: 16px; ">giá: <b style="color: #ffc107;"><?php echo number_format($img_list->price_sale,0,'.','.'); ?> đ</b></span>
                                </button>
                            </a>
                        </div>
                        <div class="divz"></div>
                    </div>
                    <?php } ?>
                    <div class="shiperx">
                    <?php echo $img_list->dv; ?>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </main>
    </div>

<?php
                break;
            }
        }
        break;
    }
}
?>