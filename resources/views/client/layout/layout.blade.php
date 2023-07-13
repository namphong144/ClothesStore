<!DOCTYPE html>
<html lang="zxx">

<head>
    <base href="{{asset('/')}}">
    <meta charset="UTF-8">
    <meta name="description" content="PPSTYLE Store">
    <meta name="keywords" content="clothes, women, men">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PPSTYLE | @yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="front/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="front/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="front/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="front/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/style.css" type="text/css">
    <link rel="stylesheet" href="{{asset('front/css/sweetalert.css')}}" type="text/css">
    <style>
        /* Rating */

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            display: none;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
    </style>

</head>

<body>
<!-- Start coding here -->

<!-- Page preloder -->

<div id="preloder">
    <div class="loader"></div>
</div>

@include('client.layout.header')

@yield('body')
<!-- Partner Logo Section Begin-->
{{--<div class="partner-logo">--}}
{{--    <div class="container">--}}
{{--        <div class="logo-carousel owl-carousel">--}}
{{--            <div class="logo-item">--}}
{{--                <div class="tablecell-inner">--}}
{{--                    <img src="front/img/logo-carousel/logo-1.png" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="logo-item">--}}
{{--                <div class="tablecell-inner">--}}
{{--                    <img src="front/img/logo-carousel/logo-2.png" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="logo-item">--}}
{{--                <div class="tablecell-inner">--}}
{{--                    <img src="front/img/logo-carousel/logo-3.png" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="logo-item">--}}
{{--                <div class="tablecell-inner">--}}
{{--                    <img src="front/img/logo-carousel/logo-4.png" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="logo-item">--}}
{{--                <div class="tablecell-inner">--}}
{{--                    <img src="front/img/logo-carousel/logo-5.png" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Partner Logo Section Begin END-->

@include('client.layout.footer')

<!-- Js Plugins -->
<script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('front/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('front/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('front/js/jquery.zoom.min.js')}}"></script>
<script src="{{asset('front/js/jquery.dd.min.js')}}"></script>
<script src="{{asset('front/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/js/main.js')}}"></script>
<script src="{{asset('front/js/sweetalert.min.js')}}"></script>
{{--<script type="text/javascript">--}}
{{--    $(document).ready(function (){--}}
{{--        $('.send_order').click(function (){--}}
{{--            swal({--}}
{{--                    title: "Xác nhận đơn đặt hàng",--}}
{{--                    text: "Đơn hàng sẽ không được hoàn tác khi đặt, bạn có muốn đặt không?",--}}
{{--                    type: "warning",--}}
{{--                    showCancelButton: true,--}}
{{--                    confirmButtonClass: "btn-danger",--}}
{{--                    confirmButtonText: "Có, đặt hàng",--}}
{{--                    cancelButtonText: "Không, hủy đặt hàng",--}}
{{--                    closeOnConfirm: false,--}}
{{--                    closeOnCancel: false--}}
{{--                },--}}
{{--                function(isConfirm) {--}}
{{--                    if (isConfirm) {--}}
{{--                        var shipping_name = $('.shipping_name').val();--}}
{{--                        var shipping_address = $('.shipping_address').val();--}}
{{--                        var shipping_email = $('.shipping_email').val();--}}
{{--                        var shipping_phone = $('.shipping_phone').val();--}}
{{--                        var shipping_notes = $('.shipping_notes').val();--}}
{{--                        var shipping_payment = $('.payment_select').val();--}}
{{--                        var _token = $('input[name="_token"]').val();--}}
{{--                        $.ajax({--}}
{{--                            url: '{{url('/confirm-order')}}',--}}
{{--                            method: 'POST',--}}
{{--                            data: {--}}
{{--                                shipping_name: shipping_name,--}}
{{--                                shipping_address: shipping_address,--}}
{{--                                shipping_email: shipping_email,--}}
{{--                                shipping_phone: shipping_phone,--}}
{{--                                shipping_notes: shipping_notes,--}}
{{--                                shipping_payment: shipping_payment,--}}
{{--                                _token: _token--}}
{{--                            },--}}
{{--                            success: function () {--}}
{{--                                swal("Đơn hàng", "Đơn hàng của bạn đã đặt thành công.", "success");--}}
{{--                            }--}}
{{--                        });--}}
{{--                        window.setTimeout(function () {--}}
{{--                            location.reload();--}}
{{--                        }, 3000);--}}

{{--                    } else {--}}
{{--                        swal("Đóng", "Đơn hàng chưa được gửi, vui lòng hoàn tất đơn hàng", "error");--}}
{{--                    }--}}
{{--                });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
{{--<script type="text/javascript">--}}
{{--    hover_cart();--}}
{{--    show_cart();--}}
{{--    function hover_cart(){--}}
{{--        $.ajax({--}}
{{--            url: '{{url('/hover-cart')}}',--}}
{{--            method: 'GET',--}}
{{--            success: function (data) {--}}
{{--                $('#giohang-hover').html(data);--}}

{{--            }--}}
{{--        });--}}
{{--    }--}}

{{--    function show_cart() {--}}
{{--        $.ajax({--}}
{{--            url: '{{url('/show-cart')}}',--}}
{{--            method: 'GET',--}}
{{--            success: function (data) {--}}
{{--                $('#show-cart').html(data);--}}

{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--    $(document).ready(function (){--}}
{{--        $('.add-to-cart').click(function (){--}}
{{--            var id= $(this).data('id_product');--}}
{{--            var cart_product_id = $('.cart_product_id_' + id).val();--}}
{{--            var cart_product_name = $('.cart_product_name_' + id).val();--}}
{{--            var cart_product_image = $('.cart_product_image_' + id).val();--}}
{{--            var cart_product_price = $('.cart_product_price_' + id).val();--}}
{{--            var cart_product_qty = $('.cart_product_qty_' + id).val();--}}
{{--            var _token = $('input[name="_token"]').val();--}}
{{--            $.ajax({--}}
{{--                url: '{{url('/add-cart-ajax')}}',--}}
{{--                method: 'POST',--}}
{{--                data:{cart_product_id:cart_product_id, cart_product_name:cart_product_name, cart_product_image:cart_product_image,--}}
{{--                    cart_product_price:cart_product_price, cart_product_qty:cart_product_qty, _token:_token },--}}
{{--                success:function (data){--}}
{{--                    swal({--}}
{{--                            title: "Đã thêm sản phẩm vào giỏ hàng",--}}
{{--                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",--}}
{{--                            showCancelButton: true,--}}
{{--                            cancelButtonText: "Xem tiếp",--}}
{{--                            confirmButtonClass: "btn-success",--}}
{{--                            confirmButtonText: "Đi đến giỏ hàng",--}}
{{--                            closeOnConfirm: false--}}
{{--                        },--}}
{{--                        function() {--}}
{{--                            window.location.href = "{{url('/cart')}}";--}}
{{--                        });--}}
{{--                    show_cart();--}}
{{--                    hover_cart();--}}

{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--    });--}}
{{--</script>--}}

<script type="text/javascript">
    $(document).ready(function(){
        $('#timkiem').keyup(function(){
            $('#result').html('');
            var search = $('#timkiem').val();
            if(search != ''){
                $('#result').css('display', 'inherit');
                var expression = new RegExp(search, "i");
                $.getJSON('/json/product.json', function(data){
                    $.each(data, function(key, value){
                        if(value.name.search(expression) != -1){
                            $('#result').append('<li class="list-group-item" style="cursor:pointer"><img height="30" width="40" src="/uploads/product/'+value.image+'">'+value.name+'</li>');
                        }
                    });
                })
            }else{
                $('#result').css('display', 'none');
            }
        })
        $('#result').on('click', 'li', function(){
            var click_text = $(this).text().split('|');
            $('#timkiem').val($.trim(click_text[0]));
            $('#result').html('');
            $('#result').css('display', 'none');
        });
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#sort').on('change', function(){
            var url = $(this).val();
            //alert(url);
            if(url){
                window.location = url;
            }
            return false;
        })
    });
</script>

<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "104459522089426");
    chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v17.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>


@yield('script')
</body>

</html>
