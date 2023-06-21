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
                            <span>Đánh giá sản phẩm</span>
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
                <h4 style="text-transform: uppercase"><b>ĐÁNH GIÁ SẢN PHẨM:</b></h4>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="cart-pic first-row">
                                            <a href="{{route('san-pham', $orderdetail->product->slug)}}">
                                                 <img src="{{asset('uploads/product/'.$orderdetail->product->productImage[0]->path)}}" alt="" style="width:100px;height: 120px;">
                                            </a>
                                        </td>
                                        <td class="cart-title first-row">
                                            <h5>{{$orderdetail->product->name}}</h5>
                                        </td>
                                        <td class="qua-col first-row">
                                            {{$orderdetail->sell_quantity}}
                                         </td>

                                        <td class="p-price first-row">
                                            {{number_format($orderdetail->product->price).',000'}} <sup>đ</sup>
                                        </td>
                                        <td class="p-price first-row">
                                            {{number_format($orderdetail->sell_total).',000'}} <sup>đ</sup>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    <div class="customer-review-option">                 
                        <div class="leave-comment">
                            <h4>Đánh giá</h4>
                            <form action="{{route('add-rating', $orderdetail->id)}}" class="comment-form" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$orderdetail->product->id}}">
                                <div class="personal-rating">
                                    <h6>Your Rating</h6>
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rating" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rating" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rating" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rating" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rating" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                    @error('rating')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <textarea name="massage" id="" cols="30" rows="10" placeholder="Messages"></textarea>
                                        @error('massage')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                        <button type="submit" class="site-btn">Send messages</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- Shopping cart  Section End-->

@endsection