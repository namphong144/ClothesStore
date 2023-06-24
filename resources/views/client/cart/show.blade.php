@extends('client.layout.layout')
@section('title', 'Homepage')
@section('body')
         <!--Breadcrumb section-->
         <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <a href="{{route('homepage')}}"><i class="fa fa-home"></i>Home</a>
                            <a href="{{route('shop')}}">Shop</a>
                            <span>Giỏ hàng</span>
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
                    <div class="cart-table">
                      
                            <table>
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th class="p-name">Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th></th>
                                        <th>Tổng tiền</th>
                                        <th>   <form action="{{route('clear-all-cart')}}" method="POST">
                                            @csrf
                                            <button
                                            type="submit">
                                                <i class="ti-close"></i>
                                        </button>
                                            </form>
                                       </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cart as $item)
                                    <tr>
                                        <td class="cart-pic first-row">
                                            <a href="{{route('san-pham', $item->attributes->slug)}}">
                                                 <img src="{{asset('uploads/product/'.$item->attributes->image)}}" alt="" style="width:100px;height: 120px;">
                                            </a>
                                        </td>
                                        <td class="cart-title first-row">
                                            <h5>{{$item->name}}</h5>
                                            <h5>Size: <b>{{$item->attributes->size}}</b></h5>
                                        </td>
                                        <td class="p-price first-row">{{number_format($item->price).',000'}} <sup>đ</sup></td>
                                        <form action="{{route('update-cart')}}" method="POST">
                                            @csrf
                                        <td class="qua-col first-row">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{$item->quantity}}" name="quantity" id="">
                                                </div>
                                            </div>
                                        </td>
                                            <input type="hidden" value="{{ $item->id }}" name="id">
                                            <input type="hidden" value="{{ $item->attributes->size_id }}" name="size_id">
                                            <td class="close-td first-row">
                                            <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                type="submit" data-toggle="tooltip"
                                                data-placement="bottom">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-refresh"></i>
                                                </span>
                                            </button>
                                            </td>
                                        </form>
                                        <td class="total-price first-row">{{number_format($item->quantity * $item->price).',000'}} <sup>đ</sup></td>
                                        <form class="d-inline" action="{{route('delete-cart')}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="id">
                                            <td class="close-td first-row">
                                            <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                type="submit" data-toggle="tooltip" title="Delete"
                                                data-placement="bottom">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="ti-close"></i>
                                                </span>
                                            </button>
                                            </td>
                                        </form>
                                    </tr>
                                    @empty
                                    <tr>  <th colspan="6"><h4>Không có sản phẩm nào trong giỏ hàng của bạn!</h4></th></tr>
                                    @endforelse
                                </tbody>
                            </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="{{route('shop')}}" class="primary-btn up-cart">Tiếp tục dạo shop</a>
                            </div>
                            <div class="discount-coupon">
                                <h4>Discount Code</h4>
                                <form action="#" class="coupon-form">
                                    <input type="text" name="" id="" placeholder="Enter Your Codes">
                                    <button type="button" class="site-btn coupon-btn">Apply</button>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>{{number_format(Cart::getTotal()).',000'}} <sup>đ</sup></span></li>
                                    <li class="cart-total"> Total <span>{{number_format(Cart::getSubTotal()).',000'}} <sup>đ</sup></span></span></li>
                                </ul>
                                <a href="{{route('check-out')}}" class="proceed-btn">THANH TOÁN</a>
                            </div>
                        </div>
                    </div>
               </form>
            </div>
        </div>
    </div>
</div>
<!-- Shopping cart  Section End-->

@endsection