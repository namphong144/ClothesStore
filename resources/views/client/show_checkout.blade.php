@extends('client.layout.layout')
@section('title', 'Checkout')
@section('body')
    <!--Breadcrumb section-->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{route('homepage')}}"><i class="fa fa-home"></i>Home</a>
                        <a href="{{route('shop')}}">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrumb section end-->

    <!--Check out Section Begin-->
    <div class="checkout-section spad">
        <div class="container">

                <div class="row">
                    <div class="col-lg-4">
{{--                        <div class="checkout-content">--}}
{{--                            <a href="login.html" class="content-btn">Click Here To Login</a>--}}
{{--                        </div>--}}
                        <h4>Billing details</h4>

                        <div class="row">
                            <form method="POST" class="checkout-form">
                                @csrf
                            <div class="col-lg-12">
                                <label for="fir">Họ và tên <span>*</span></label>
                                <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên người nhận" >
                            </div>
                            <div class="col-lg-12">
                                <label for="street">Địa chỉ <span>*</span></label>
                                <input type="text" name="shipping_address"  class="shipping_address" placeholder="Địa chỉ nhận hàng">
                            </div>
                            <div class="col-lg-12">
                                <label for="email">Email <span>*</span></label>
                                <input type="text" name="shipping_email" class="shipping_email"  placeholder="Điền email">
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Số điện thoại <span>*</span></label>
                                <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
                            </div>
                                <div class="col-lg-12">
                                    <label for="note">Ghi chú</label>
                                    <input type="text" name="shipping_notes" class="shipping_notes" placeholder="Ghi chú đơn hàng" >
                                </div>
                                <div class="col-lg-12">
                                    <div class="payment-check">
                                        <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                            <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                                <option value="0">Qua chuyển khoản</option>
                                                <option value="1">Tiền mặt</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-lg-12" style="margin-top: 20px;">
                                    <div class="order-btn">
                                        <input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn primary-btn send_order">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-lg-8">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{session()->get('message')}}
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">
                                {{session()->get('error')}}
                            </div>
                        @endif
                        <div class="cart-table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th class="p-name">Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(\Illuminate\Support\Facades\Session::get('cart') == true)
                                        @php
                                            $total = 0;

                                        @endphp
                                        @foreach(\Illuminate\Support\Facades\Session::get('cart') as $key => $cart)
                                            @php
                                                $subtotal = $cart['product_price'] * $cart['product_qty'];
                                                $total += $subtotal;
                                            @endphp
                                            <tr>
                                                <td class="cart-pic first-row"><img src="{{asset('uploads/product/'.$cart['product_image'])}}" width="200px" alt="{{$cart['product_name']}}"></td>
                                                <td class="cart-title first-row">
                                                    <h5>{{$cart['product_name']}}</h5>
                                                </td>
                                                <td class="p-price first-row">{{number_format($cart['product_price'],0,',','.')}}đ</td>
                                                <td class="qua-col first-row">
                                                    {{$cart['product_qty']}}

                                                </td>
                                                <td class="total-price first-row">{{number_format($subtotal,0,',','.')}}đ</td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5"><center>
                                                    @php
                                                        echo 'Giỏ hàng trống, hãy thêm sản phẩm vào giỏ hàng!'
                                                    @endphp</center>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                        </div>
                    </div>

                </div>


                </div>
            </div>

        </div>
    </div>
    <!--Check out Section End-->

    <!-- Partner Logo Section Begin-->
    <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-1.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-2.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-3.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-4.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partner Logo Section Begin END-->
@endsection
