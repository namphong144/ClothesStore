@extends('client.layout.layout')
@section('title', 'Tài khoản của bạn')
@section('body')
         <!--Breadcrumb section-->
         <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <a href="{{route('homepage')}}"><i class="fa fa-home"></i>Home</a>
                            <a href="{{route('shop')}}">Shop</a>
                            <span>Chi tiết đơn hàng</span>
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
            <div class="col-lg-3">
                   
                <h4>Thông tin mua hàng:</h4>
                <div class="row">
                   <div class="col-lg-12">
                    <label for="fir">Tên người nhận:</label>
                   <h5><i>{{Auth::user()->name}}</i></h5>
                   </div>
                   <div class="col-lg-12">
                    <label for="last">Email:</label>
                    <h5><i>{{Auth::user()->email}}</i></h5>
                   </div>
                   <div class="col-lg-12">
                    <label for="cun-name">Số điện thoại:</label>
                    <h5><i>{{Auth::user()->phone}}</i></h5>
                   </div>
                   <div class="col-lg-12">
                    <label for="cun">Địa chỉ nhận hàng: </label>
                    <h5><i>{{Auth::user()->address}}</i></h5>
                   </div>
                </div>
            </div>
            <div class="col-lg-9">
                <h4 style="text-transform: uppercase"><b>Lịch sử mua hàng:</b></h4>
                <p><i>Qúy khách chỉ được hủy đơn khi đơn hàng ở trạng thái chờ xác nhận.
                    Và qúy khách vui lòng xác nhận đơn hàng khi đã nhận được hàng.</i></p>
                <p></p>
                <p></p>
                    <div class="cart-table">
                      
                            <table>
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th class="p-name">Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Tổng</th>
                                        <th>Đánh giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orderdetail as $key=>$item)
                                    <tr>
                                        <td class="cart-pic first-row">
                                            <a href="{{route('san-pham', $item->product->slug)}}">
                                                 <img src="{{asset('uploads/product/'.$item->product->productImage[0]->path)}}" alt="" style="width:100px;height: 120px;">
                                            </a>
                                        </td>
                                        <td class="cart-title first-row">
                                            <h5>{{$item->product->name}}</h5>
                                            <h5>Size: <b>{{$item->size}}</b></h5>
                                        </td>
                                       
                                        <td class="qua-col first-row">
                                                    {{$item->sell_quantity}}
                                        </td>

                                        <td class="p-price first-row">
                                            {{number_format($item->product->price).',000'}} <sup>đ</sup>
                                        </td>
                                        <td class="p-price first-row">{{number_format($item->sell_total).',000'}} <sup>đ</sup></td>
                                        @if ($order->order_status == 3)
                                        <td class="first-row"> 
                                            @if ($item->comment == 0)
                                            <a href="{{route('danh-gia', $item->id)}}">
                                                <button class="btn btn-primary">Đánh giá sản phẩm</button>
                                            </a>
                                            @else
                                            <button class="btn btn-success">Đã đánh giá sản phẩm</button>
                                            @endif
                                        </td>
                                        @else
                                        <td></td>
                                        @endif
                                     
                                    </tr>
                                    @empty
                                    <tr>  <th colspan="6"><h4>Không có sản phẩm!</h4></th></tr>
                                    @endforelse
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>TỔNG TIỀN:</td>
                                        <td>  <div class="badge badge-danger">{{number_format($total_order)}},000 <sup>đ</sup></div></td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="{{route('shop')}}" class="primary-btn up-cart">Tiếp tục dạo shop</a>
                                {{-- <a href="{{}}" class="primary-btn up-cart">Update Cart</a> --}}
                                {{-- <button type="submit" class="primary-btn up-cart">Cập nhật giỏ hàng</button> --}}
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