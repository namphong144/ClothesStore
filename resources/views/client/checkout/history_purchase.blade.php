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
                            <span>Lịch sử mua hàng</span>
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
                   
                <h4>Thông tin đơn hàng:</h4>
                <p></p>
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
                <p></p>
                <p><i>Qúy khách chỉ được hủy đơn khi đơn hàng ở trạng thái chờ xác nhận.
                    Và qúy khách vui lòng xác nhận đơn hàng khi đã nhận được hàng.</i></p>
                <p></p>
                <p></p>
                    <div class="cart-table">
                      
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Hình thức thanh toán</th>
                                        <th>Tình trạng đơn hàng</th>
                                        <th>Xem chi tiết</th> 
                                        <th>   
                                            
                                       </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $orderitem)
                                    <tr>
                                        <td class="text-center first-row">
                                            {{$orderitem->order_code}} 
                                        </td>
                                        <td class="text-center first-row">
                                            {{$orderitem->created_at}} 
                                        </td>
                                        <td class="text-center first-row">
                                            {{$orderitem->payment->payment_method}} 
                                        </td>
                                        <td class="p-price first-row">
                                           @if ($orderitem->order_status == 0)
                                               Chờ xác nhận
                                               @elseif($orderitem->order_status == 1)
                                               Đã xác nhận
                                               @elseif($orderitem->order_status == 2)
                                               Đang vận chuyển
                                               @elseif($orderitem->order_status == 3)
                                               Đã hoàn thành
                                               @else
                                               Đã hủy
                                           @endif
                                        </td>
                                        <td class="total-price first-row">
                                            <a href="{{route('history-detail', $orderitem->id)}}"class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">Chi tiết</a>
                                          </td>
                                        <td class="first-row">
                                            @if ($orderitem->order_status == 0)
                                                <form action="{{route('client-huy', $orderitem->id)}}" method="post">
                                                    @method('PUT')
                                                    @csrf
                                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')" class="btn btn-danger">Hủy</button>
                                                </form>
                                            @endif
                                            @if($orderitem->order_status == 2)
                                            <form action="{{route('client-nhan-hang', $orderitem->id)}}" method="post">
                                                @method('PUT')
                                                @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Đã nhận được hàng</button>
                                            </form>
                                           

                                        @endif
                                        </td>
                                       
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                    <div style="text-center">
                        {!!$order->links("pagination::bootstrap-4")!!}
                        </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="{{route('shop')}}" class="primary-btn up-cart">Tiếp tục dạo shop</a>
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