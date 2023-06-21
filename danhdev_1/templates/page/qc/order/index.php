    <div class="container bbz">
        <header id="header" class="header row">
            <div class="col-3 backz">
                <a style=" cursor: pointer; "  onclick="history.back()">
                    Quay lại
                </a>
            </div>
            <div class="col-7 titlez">
                <span class="tttt">Trang thanh toán</span>
            </div>
        </header>
        <main class="mainz">
            <div class="rowz" style=" padding-top: 16px; ">
                <div class="col-md-4">
                    <div>
                        <h2
                            style=" font-size: 16px; color: #4267b2; line-height: 30px; text-transform: uppercase; font-weight: bold; display: block; ">
                            Thông tin đơn hàng</h2>
                    </div>
                    <div id="chechout-wrap"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.2), 0 1px 1px rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12);background: #e8eaf6!important;padding: 12px 5px 0px 2px;margin-top: 5px;margin-bottom: 8px;border: 0.5px solid #9e9797;">
                        <div id="data"
                            style=" padding-bottom: 10px; border-bottom: dotted 0.5px #d4cdcd; margin-bottom: 10px; ">
                            <div class="item" style=" display: flex; ">
                                <div class="img-small"
                                    style=" width: 60px; height: 60px; overflow: hidden; margin-left: 2px; display: inline-block; ">
                                    <img id="thum" style=" width: 100%; "
                                        src="">
                                </div>
                                <div id="titlez" class="title" style=" display: inline-block; width: 100%; margin-left: 2px; ">
               
                                </div>
                            </div>
                            <div class="sl">
                                <div style=" margin: auto; display: table;padding: 2px; ">
                                    <span id="de" class="tru mouse-pointer"
                                        style="padding: 0px 9px;font-size: 17px;font-weight: 600;background-color: #da5454;border-radius: 5px;color: white;cursor: pointer;">-
                                    </span><span id="num" class="num" style=" padding: 0px 20px; "></span>
                                    <span id="en" class="cong mouse-pointer"
                                        style="padding: 0px 9px;font-size: 17px;font-weight: 600;background-color: #da5454;border-radius: 5px;color: white;cursor: pointer;">+</span>

                                </div>
                            </div>
                            <div class="upsale-sp">

                            </div>
                        </div>
                    </div>
                    <div class="tong-tien">
                        <p style="text-align: center;margin-bottom: 14px;">
                            <span style="font-weight: 600;">Tổng tiền : </span>
                            <span id="sump" style=" color: blue; font-weight: 700; "></span>
                        </p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div>
                        <h2
                            style=" font-size: 16px; color: #4267b2; line-height: 30px; text-transform: uppercase; font-weight: bold; display: block; ">
                            Thông tin người nhận</h2>
                        <div class="danhdev-name">
                            <label for="billing_first_name" class="">Tên&nbsp;*<i id="note1"
                                    style="color:red;display:none;"> (Bạn điền thiếu thông tin này)*</i></label>
                            <span class="danhdev-input-name">
                                <input  type="text" class="input-text " name="billing_first_name" id="billing_first_name"
                                    placeholder="" value="" autocomplete="off"
                                    title="Có thể bạn chưa biết: Nhập tên chính xác giúp tỉ lệ đơn hàng vận chuyển thành công lên đến 95%.">
                            </span>
                        </div>
                        <div class="danhdev-phone">
                            <label for="billing_phone" class="">Số điện thoại&nbsp;*<i id="note2"
                                    style="color:red;display:none;"> (Bạn điền sai hoặc thiếu thông tin
                                    này)*</i></label>
                            <span class="danhdev-phone-input">
                                <input type="tel" class="input-text " name="billing_phone" id="billing_phone"
                                    placeholder="" value="" autocomplete="off"
                                    title="Nhân viên  Shop sẽ liên lạc qua số điện thoại của khách hàng để xác nhận đơn hàng.">
                            </span>
                        </div>

                        <div class="danhdev-address">
                            <label for="billing_address_1" class="">Địa chỉ&nbsp;*<span>(Vui lòng điền rõ địa chỉ để
                                    được nhận hàng nhanh hơn)<i id="note3" style="color:red;display:none;"> (Bạn điền
                                        thiếu thông tin này)*</i></span></label>
                            <span class="danhdev-address-input">
                                <input type="text" class="input-text " value="" autocomplete="off" id="billing_address_1"
                                    data-placeholder="Địa chỉ">
                            </span>
                        </div>
                        <div class="note-order">
                            <label for="order_comments" class="">Ghi chú đơn hàng&nbsp;<span class="optional">(tuỳ
                                    chọn)</span></label>
                            <span class="danhdev-note-order">
                                <textarea name="order_comments" class="input-text " id="order_comments"
                                    placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."
                                    rows="2" cols="5"></textarea>
                            </span>
                        </div>
                        <div class="danhdev-payment">
                            <div id="payment" class="woocommerce-checkout-payment">
                                <div class="button-dat-hang">
                                    <button id="tien-hanh-dat-hang" url-home="https://anbinhnew.com"
                                        style="height:42px;margin-bottom: 20px;margin-top: 12px;">
                                        <span class="icon-cart-plus"
                                            style=" font-size: 16px; margin-right: 2px; "></span> Đặt Hàng
                                    </button>
                                </div>
                                <div id="test"></div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </main>
        <div id="loading" style="display: none;">
            <div
                style=" position: fixed; width: 100%; height: 100%; background-color: #0e0e0ed6; top: 0px; left: 0px; z-index: 99;">
                <div style=" position: absolute; top: 46%; left: 42.5%; color: white; ">Đang xử lý...</div>
            </div>
        </div>
        <div id="order_ok" style="display: none;">
            <div
                style=" overflow-y: scroll;position: fixed; width: 100%; height: 100%; background-color: #0e0e0ed6; top: 0px; left: 0px; z-index: 99;">
                <div class="container">
                    <div class="row" style=" margin: 40px -8px; ">
                        <div class="wrap-pp col-sm-8 col-md-6 col-lg-7">
                            <div class="header-pp">
                                <div class="check">
                                    <svg class="icon-check" style="margin: auto;font-size: 70px;fill: #33a938;"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z" />
                                    </svg>
                                    
                                </div>
                                <div>
                                    <p style="
                                        font-size: 22px; margin-top: 12px; font-weight: 600; margin-left:
                                        12px; ">Đặt Hàng Thành Công!</p>
                                </div>
                            </div>
                            <div class=" body-pp">
                                <p style=" text-align: left; margin-bottom: 8px; color: currentColor; ">Thông
                                    tin đơn hàng :</p>
                                <table style=" border-collapse: collapse; width: 100%; ">
                                    <tbody>
                                        <tr style=" background-color: burlywood; ">
                                            <th>Tên sản phẩm</th>
                                            <th>Giá thành</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                        <tr id="sp">
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td style=" font-weight: 600; ">Tổng tiền: </td>
                                            <td id="sum-price" style="font-weight: 600; color: blue;">2.300.000đ</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div id="guess"></div>

                            </div>
                            <div class="footer-pp"><a id="backz" href="">
                                    <p class="bnt-home"
                                        style=" margin: auto; width: 162px; padding: 14px; border: 1px solid green; border-radius: 10px; font-size: 15px; font-weight: 600; color: green; ">
                                        Quay lại trang chủ</p>
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>