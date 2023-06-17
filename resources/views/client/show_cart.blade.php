@extends('client.layout.layout')
@section('title', 'Cart')
@section('body')
    <!--Breadcrumb section-->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index.html"><i class="fa fa-home"></i>Home</a>
                        <a href="shop.html">Shop</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrumb section end-->

    <!--Shopping cart Section Begin-->
    <div class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
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
                        <form action="{{asset('/update-cart')}}" method="POST">
                            @csrf
                        <table>
                            <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th class="p-name">Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th><i class="ti-close"></i></th>
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
                                    <div class="quantity">

                                        <div class="pro-qty" style="align-items: center;align-content: center; margin-left: 29px;" >

                                            <input class style=" text-align: center" type="text" min="1" value="{{$cart['product_qty']}}" name="cart_qty[{{$cart['session_id']}}]">

                                        </div>

                                    </div>
                                </td>
                                <td class="total-price first-row">{{number_format($subtotal,0,',','.')}}đ</td>
                                <td class="close-td first-row"><a href="{{asset('/delete-product/'.$cart['session_id'])}}"><i class="ti-close"></i></a></td>
                            </tr>
                            @endforeach

                            <tr>
                                <td>
                                    <input type="submit" value="Cập nhật" style="background-color: #0b0c0d" name="update_qty" class="primary-btn up-cart">
                                </td>
                                <td><a href="{{asset('delete-all-product')}}" class="primary-btn up-cart">Xóa tất cả</a></td>
                                <div class="proceed-checkout text-center">
                                        <ul>
                                            <li class="cart-total ">
                                                <p style="color: red; font-weight: bold" > Tổng tiền: {{number_format($total,0,',','.')}}đ</p>
                                            </li>
                                            <li class="proceed-checkout">
                                                @if(\Illuminate\Support\Facades\Auth::user())
                                                    <a href="{{asset('/checkout')}}" class="proceed-btn">Thanh toán</a>
                                                @else
                                                    <a href="{{ route('login') }}" class="proceed-btn">Thanh toán</a>
                                                @endif
                                            </li>
                                        </ul>

                                </div>
                            </tr>

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
                        </form>
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="discount-coupon">--}}
{{--                                <h4>Mã giảm giá</h4>--}}
{{--                                <br>--}}
{{--                                <form method="POST" action="{{asset('/check-coupon')}}" class="coupon-form">--}}
{{--                                    @csrf--}}
{{--                                    <input type="text" class="form-control" name="coupon" id="" placeholder="Nhập mã giảm giá">--}}
{{--                                    <button type="submit" class="site-btn coupon-btn check_coupon" name="check_coupon">Nhập</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Shopping cart  Section End-->

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
