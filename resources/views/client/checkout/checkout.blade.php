@extends('client.layout.layout')
@section('title', 'Thanh toán')
@section('body')
 <!--Breadcrumb section-->
 <div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{route('homepage')}}"><i class="fa fa-home"></i>Home</a>
                    <a href="{{route('shop')}}">Shop</a>
                    <span> Thanh toán</span>
                </div>
            </div>
        </div>
    </div>
</div>
  <!--Breadcrumb section end-->
   <!--Check out Section Begin-->
   <div class="checkout-section spad">
    <div class="container">
        <form action="{{route('check-out-process')}}" method="POST" class="checkout-form">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <h4>Thông tin nhận hàng</h4>
                    <div class="row">
                       <div class="col-lg-12">
                        <label for="cun-name">Tên người nhận <span>*</span></label>
                        <input required type="text" name="recipient" id="cun-name" value="{{Auth::user()->name}}">
                       </div>
                       <div class="col-lg-12">
                        <label for="email">Địa chỉ <span>*</span></label>
                        <input required type="text" name="address" id="email" value="{{Auth::user()->address}}">
                       </div>
                       <div class="col-lg-12">
                        <label for="phone">Điện thoại <span>*</span></label>
                        <input required type="text" name="phone" id="phone" value="{{Auth::user()->phone}}">
                       </div>
                    </div>
                </div>

                <div class="col-lg-6"> 
                    <div class="place-order">
                        <h4>Sản phẩm của bạn</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Sản phẩm <span>Tổng</span></li>
                                @php
                                $tongtien=0;
                                @endphp
                                @foreach ($cart as $item)
                                <input type="hidden" value="{{$item->quantity}}" name="qty">
                                <input type="hidden" value="{{$item->attributes->price_origin * $item->quantity}}" name="thanhtien">
                                     <li class="fw-normal">
                                        {{-- <img src="{{asset('uploads/product/'.$item->attributes->image)}}" alt="" width="60px" height="60px"> --}}
                                        {{$item->name}} x {{$item->quantity}} 
                                        <br>Size: <b>{{$item->attributes->size}}</b>
                                        <span>{{number_format($item->quantity * $item->price).',000'}} <sup>đ</sup></span>
                                    </li>
                                    @php
                                 
                                    $tongtien += $item->attributes->price_origin * $item->quantity;
                                @endphp
                                @endforeach
                                <input type="hidden" value="{{Cart::getTotal() - $tongtien}}" name="loinhuan">
                                <li class="fw-normal">Subtotal <span>{{number_format(Cart::getTotal()).',000'}} <sup>đ</sup></span></li>
                                <li class="total-price">Total<span>{{number_format(Cart::getSubTotal()).',000'}} <sup>đ</sup></span></li>
                            </ul>
                            <div class="payment-check">
                            </div>
                            <div class="order-btn">
                                <button type="submit" class="site-btn place-btn">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
       
        <div class="row" style="margin: 20px">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-8">
                <form action="{{route('vnpay')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{Cart::getTotal() - $tongtien}}" name="loinhuan">
                    <input type="hidden" name="total" value="{{Cart::getSubTotal()}}">
                    <button type="submit" name="redirect" class="site-btn place-btn">Thanh toán VNPay</button>
                </form>
            </div>
        </div>
</div>
 <!--Check out Section End-->
@endsection