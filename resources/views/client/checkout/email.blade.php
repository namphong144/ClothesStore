<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here"/>
    <title>Thông tin đơn hàng | CodeLean Shop</title>
</head>

<body
    style="background-color: #e7eff8; font-family: trebuchet,sans-serif; margin-top: 0; box-sizing: border-box; line-height: 1.5;">
<div class="container-fluid">
    <div class="container" style="background-color: #e7eff8; width: 600px; margin: auto;">
        <div class="col-12 mx-auto" style="width: 580px;  margin: 0 auto;">

            <div class="row">
                <div class="container-fluid">
                    <div class="row" style="background-color: #e7eff8; height: 10px;">

                    </div>
                </div>
            </div>

            <div class="row"
                 style="height: 100px; padding: 10px 20px; line-height: 90px; background-color: white; box-sizing: border-box;">
                {{--<h1 class="pl-3"
                    style="color: orange; line-height: 00px; float: left; padding-left: 20px; padding-top: 5px;">
                    <img src="{{$message->embed(asset('front/img/logo.png'))}}"
                         height="40" alt="logo">
                </h1>--}}
                <h1 class="pl-2"
                    style="color: orange; line-height: 30px; float: left; padding-left: 20px; font-size: 40px; font-weight: 500;">
                    CodeLean Shop
                </h1>
            </div>

            <div class="row" style="background-color: #00509d; height: 200px; padding: 35px; color: white;">
                <div class="container-fluid">
                    <h3 class="m-0 p-0 mt-4" style="margin-top: 0; font-size: 28px; font-weight: 500;">
                        <strong style="font-size: 32px;">Thông tin đơn hàng</strong>
                    </h3>
                    <div class="row mt-5" style="margin-top: 35px; display: flex;">
                        <div class="col-6"
                             style="margin-bottom: 25px; flex: 0 0 50%; width: 50%; box-sizing: border-box;">
                            <b>{{ $email_to}}</b>
                            <br>
                            <br>
                            <span>{{$phone}}</span>
                        </div>
                        <div class="col-6" style="flex: 0 0 50%; width: 50%; box-sizing: border-box;">
                           
                         
                            <b>Address:</b> {{$address}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2" style="margin-top: 15px;">
                <div class="container-fluid">
                    <div class="row pl-3 py-2" style="background-color: #f4f8fd; padding: 10px 0 10px 20px;">
                        <b>Chi tiết dơn hàng</b>
                    </div>
                    <div class="row pl-3 py-2" style="background-color: #fff; padding: 10px 20px 10px 20px;">
                        <table class="table table-sm table-hover"
                               style="text-align: left;  width: 100%; margin-bottom: 5px; border-collapse: collapse;">
                            <thead>
                            <tr>
                                <th style="padding: 5px 0;">SẢN PHẨM</th>
                                <th style="padding: 5px 20px 5px 0; text-align: right;">TỔNG TIỀN</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($cartitems as $item)
                                <tr>
                                    <td style="border-top: 1px solid #dee2e6; padding: 5px 0;">
                                        {{ $item->name . ' (x' . $item->quantity . ')'}}
                                    </td>
                                    <td style="border-top: 1px solid #dee2e6; padding: 5px 20px 5px 0; text-align: right;">
                                        {{number_format(Cart::getSubTotal()).',000'}} <sup>đ</sup>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row mt-2" style="margin-top: 15px;">
                <div class="container-fluid">
                    <div class="row pl-3 py-2" style="background-color: #f4f8fd; padding: 10px 0 10px 20px;">
                        <b>Chi tiết vận chuyển</b>
                    </div>
                    <div class="row pl-3 py-2"
                         style="background-color: #fff; font-size: 18px; padding: 2px 20px 10px 20px;">
                        <div class="col-12 p-0">
                            <hr style="border-top: 1px solid #0000001a;">
                            <table class="mt-2 w-100"
                                   style="font-size: 16px; width: 100%; text-align: left;  margin-bottom: 5px;">
                                <tr>
                                    <td class="">Phí Ship</td>
                                    <td class="pr-3 text-right" style="text-align: right; padding-right: 20px;">
                                        Miễn phí ship
                                    </td>
                                </tr>
                                <tr>
                                    <td class="">Tạm tính</td>
                                    <td class="pr-3 text-right" style="text-align: right; padding-right: 20px;">
                                        {{number_format(Cart::getSubTotal()).',000'}} <sup>đ</sup>
                                    </td>
                                </tr>
                                <tr style="font-size: 18px;">
                                    <td><b>Tổng</b></td>
                                    <td class="pr-3 text-right" style="text-align: right; padding-right: 20px;">
                                        {{number_format(Cart::getTotal()).',000'}} <sup>đ</sup>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2 mb-4" style="margin-top: 15px; margin-bottom: 25px;">
                <div class="container-fluid">
                    <div class="row pl-3 py-2" style="background-color: #f4f8fd; padding: 10px 0 10px 20px;">
                        <b style="color: #00509d; font-size: 18px;">Thông tin thêm</b>
                    </div>
                    <div class="row pl-3 py-2" style="background-color: #fff; padding: 10px 20px;">
                        <p>Quý khách được kiểm tra hình thức bên ngoài của sản phẩm (nhãn hiệu, kiểu dáng, màu sắc, số lượng,...)
                             trước khi thanh toán và có thể từ chối nhận hàng nếu không hài lòng. Vui lòng không kích hoạt thiết 
                             bị điện-điện tử hoặc dùng thử sản phẩm.</p>

                        <p>Nếu sản phẩm có dấu hiệu hư hỏng/vỡ hoặc không đúng với thông tin trên website, quý khách vui lòng liên hệ
                             với cửa hàng trong vòng 48h kể từ thời điểm nhận hàng để được hỗ trợ.</p>

                        <p>Quý khách vui lòng giữ lại hóa đơn, hộp sản phẩm và phiếu bảo hành (nếu có) để đổi trả hoặc bảo hành khi cần.</p>

                        <p>Bạn có thể tham khảo trang Trung tâm trợ giúp hoặc liên hệ với cửa hàng bằng cách để lại lời nhắn tại trang 
                            Liên hệ hoặc gửi thư tại đây. Hotline 1900 9999 (8:00 - 9:00 cả Thứ 7 và Chủ Nhật).</p>

                        <b>CodeLean thank you very much.</b>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="container-fluid">
                    <div class="row" style="background-color: #e7eff8; height: 10px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>