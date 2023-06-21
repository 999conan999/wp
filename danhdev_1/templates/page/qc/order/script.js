$(document).ready(function(){

    let product_order=JSON.parse(localStorage.getItem("order"));
    show_product(product_order);
    //
    $("#tien-hanh-dat-hang").click(function(){
        let name=$("#billing_first_name").val();
        let phone=$("#billing_phone").val();
        let adress=$("#billing_address_1").val();
        let note=$("#order_comments").val();
        let is_ok=true;
        if(name.length<1){
            is_ok=false;
            $("#note1").css("display", "contents");
        }else{
            $("#note1").css("display", "none");
        }
        
        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        if (vnf_regex.test(phone) == false) 
        {
            is_ok=false;
            $("#note2").css("display", "contents");
        }else{
            $("#note2").css("display", "none");
        }

        if(adress.length<8){
            is_ok=false;
            $("#note3").css("display", "contents");
        }else{
            $("#note3").css("display", "none");
        }

        if(is_ok){
            $("#loading").css("display", "block");
            const host_url=document.location.origin;
            const url_order=host_url+'/wp-content/themes/danhdev_1/templates/ajax/admin-components/checkout/add_checkout.php';
            const url_telegram=host_url+'/wp-content/themes/danhdev_1/templates/ajax/admin-components/checkout/telegram.php';
            let data=JSON.stringify({
                kt:product_order.size,
                g:product_order.price,
                name:product_order.title,
                msp:'',
                img:product_order.img,
                sl:product_order.sl,
                url_sp:window.location.href,
                z_name:name,
                z_phone:phone,
                z_address:adress,
                z_note:note
            })
            let data_send=new FormData();
            data_send.append('data',data);
           
            $.ajax({
                url: url_order,
                data: data_send,
                processData: false,
                type: 'POST',
                contentType: false,
                success: function ( data ) {
                   if(data.status){
                        $("#loading").css("display", "none");
                        set_data_success(name,phone,adress,note,product_order);
                        $.ajax({
                            url: url_telegram,
                            data: data_send,
                            processData: false,
                            type: 'POST',
                            contentType: false,
                        })
                   }else{
                        alert('Đặt hàng không thành công, xin liên hệ hotline để được tư vấn.')
                   }

                }
            });

        }

    });
    //

    $("#de").click(function(){
        let sl=Number(product_order.sl);
        if(sl>1) sl--;
        product_order.sl=sl;
        show_product(product_order);
    });
    $("#en").click(function(){
        let sl=Number(product_order.sl);
         sl++;
        product_order.sl=sl;
        show_product(product_order);
    });
    function show_product(product_order){
        let show_titlez='<span>'+product_order.title+'</span> - <span style="font-weight: 600;">'+product_order.size+'</span> - <span style="font-weight: 600;color: green;"> '+Number(product_order.price).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'})+' </span>'
        $("#thum").attr("src",product_order.img);
        $("#titlez").html(show_titlez);
        $("#num").html(product_order.sl);
        $("#sump").html((Number(product_order.sl)*Number(product_order.price)).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'}));
    }
    function set_data_success(name,phone,adress,note,product_order){
        let sp='<td><span style="color: #333;">'+product_order.title+'</span></td> <td>'+Number(product_order.price).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'})+'</td> <td>'+product_order.sl+'</td> <td>'+(Number(product_order.sl)*Number(product_order.price)).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'})+'</td>';
        $("#sp").html(sp);
        $("#sum-price").html((Number(product_order.sl)*Number(product_order.price)).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'}));
        let guess='<p style=" text-align: left; margin-bottom: 8px; color: currentColor;margin-top: 6px;"> Thông tin người nhận :</p> <p style="text-align: left;margin-bottom: 8px;color: currentColor;margin-top: 6px;"> Tên : <b>'+name+'</b></p> <p style="text-align: left;margin-bottom: 8px;color: currentColor;margin-top: 6px;"> Địa chỉ : <b>'+adress+'</b></p> <p style="text-align: left;margin-bottom: 8px;color: currentColor;margin-top: 6px;"> Số điện thoại : <b>'+phone+'</b></p> <p style="text-align: left;margin-bottom: 8px;color: currentColor;margin-top: 6px;"> Ghi chú : '+note+'</p> <p style="text-align: left;margin-bottom: 8px;color: currentColor;margin-top: 6px;"> Thanh toán : Trả tiền mặt khi nhận hàng.</p>'
        $("#guess").html(guess);
        $("#backz").attr("href",product_order.url);
        $("#order_ok").css("display", "block");
    }

})