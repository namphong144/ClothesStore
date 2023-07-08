@extends('client.layout.layout')
@section('title', $product->name)
@section('body')
    <!--Breadcrumb section-->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{route('homepage')}}"><i class="fa fa-home"></i>Home</a>
                        <a href="{{route('shop')}}">Shop</a>
                        <span>{{$product->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrumb section end-->

    <!-- Product Shop Section Begin-->
    <div class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('client.layout.sidebar')

                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="{{asset('uploads/product/'.$product->productImage[0]->path)}}" alt="">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    @foreach ($product->productImage as $images)
                                        <div class="pt active" data-imgbigurl="{{asset('uploads/product/'.$images->path)}}">
                                            <img src="{{asset('uploads/product/'.$images->path)}}" alt="" height="140px">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <form action="{{route('add-cart')}}" method="POST">
                                @csrf
                                <div class="product-details">
                                    <div class="pd-title">
                                        <span>{{$product->brand->name}}</span>
                                        <h3>{{$product->name}}</h3>
                                        <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                                    </div>
                                    <div class="pd-rating">
                                        @for ($i=1; $i<=5; $i++)
                                            @if ($i <= $avg_rating)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                        <span>({{count($product->productComment)}})</span>
                                    </div>
                                    <div class="pd-desc">
                                        <p></p>
                                        <h4>
                                            {{number_format($product->price).',000'}} <sup>đ</sup>
                                        </h4>
                                    </div>
                                    <div class="pd-size-choose">
                                        @foreach ($product->product_size as $si)
                                            @if ($si->quantity == 0)
                                                <div class="sc-item">
                                                    <input type="radio" name="size_id" value="{{$si->id}}" id="sm-{{$si->size->name}}">
                                                    <label class="sizeSelectLabel" for="sm-{{$si->size->name}}" aria-disabled="true" style="
                                                    color: rgba(0,0,0,.26);
                                                    cursor: not-allowed;">{{$si->size->name}}
                                                    </label>
                                                </div>
                                            @else
                                                <div class="sc-item">
                                                    <input type="radio" name="size_id" value="{{$si->id}}" id="sm-{{$si->size->name}}">
                                                    <label class="sizeSelectLabel" for="sm-{{$si->size->name}}" aria-disabled="false">{{$si->size->name}}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" name="qty" id="" value="1">
                                        </div>
                                        <input type="hidden" name="product_id_hidden" id="" value="{{$product->id}}">

                                        <button type="submit" class="primary-btn pd-card">Thêm vào giỏ hàng</button>

                                    </div>
                                    <ul class="pd-tags">
                                        <li><span>DANH MỤC</span>: {{$product->productCategory->name}}</li>
                                    </ul>
                                    <div class="pd-share">
                                        <div class="p-code">Sku: {{$product->id}}</div>
                                        <div class="pd-social">
                                            <a href="#"><i class="ti-facebook"></i></a>
                                            <a href="#"><i class="ti-twitter-alt"></i></a>
                                            <a href="#"><i class="ti-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li><a class="active" href="#tab-1" data-toggle="tab" role="tab">CHI TIẾT SẢN PHẨM</a></li>
                                <li><a href="#tab-2" data-toggle="tab" role="tab">ĐẶC TẢ SẢN PHẨM</a></li>
                                <li><a href="#tab-3" data-toggle="tab" role="tab">BÌNH LUẬN ({{count($product->productComment)}})</a></li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                {!!$product->description!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                            <tr>
                                                <td class="p-catagory">Đánh giá của khách hàng</td>
                                                <td>
                                                    <div class="pd-rating">
                                                        @for ($i=1; $i<=5; $i++)
                                                            @if ($i <= $avg_rating)
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                        <span>({{count($product->productComment)}})</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Giá</td>
                                                <td>
                                                    <div class="pd-price">
                                                        {{$product->price}}.000 <sup>đ</sup>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Sku</td>
                                                <td>
                                                    <div class="p-code"> {{$product->id}}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <table>
                                                    <tr>
                                                        <td class="p-catagory">Size</td>
                                                        @foreach ($product->product_size as $si)
                                                            <td>
                                                                <div class="p-size">
                                                                    {{$si->size->name}} &nbsp;
                                                                </div>
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="p-catagory">Số lượng sản phẩm</td>
                                                        @foreach ($product->product_size as $si)
                                                            <td>
                                                                <div class="p-stock">
                                                                    {{$si->quantity}} &nbsp;
                                                                </div>
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4>{{count($product->productComment)}} bình luận</h4>
                                        <div class="comment-option">
                                            @foreach ($product->productComment as $com)
                                                <div class="co-item">
                                                    <div class="avatar-pic">
                                                        <img src="front/img/product-single/avatar-1.png" alt="">
                                                    </div>
                                                    <div class="avatar-text">
                                                        <div class="at-rating">
                                                            @for ($i=1; $i<=5; $i++)
                                                                @if ($i <= $com->rating)
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <h5>{{$com->user->name}}<span>{{substr($com->created_at, 0, -9)}}</span></h5>
                                                        <div class="at-reply">{{$com->messages}}</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Shop Section End-->

    <!-- Related Product Section-->
    <div class="related-product spad" style="margin-top: -80px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($related_product as $key=>$related)
                    <div class="col-lg-3 col-sm-6">
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="{{asset('uploads/product/'.$related->productImage[0]->path)}}" alt="" height="290px">
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    <li class="w-icon active"><a href=""><i class="icon_bag_alt"></i></a></li>
                                    <li class="quick-view"><a href="{{route('san-pham', $related->slug)}}">+ Quick View</a></li>
                                    <li class="w-icon"><a href=""><i class="fa fa-random"></i></a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{$related->brand->name}}</div>
                                <a href="{{route('san-pham', $related->slug)}}">
                                    <h5>{{$related->name}}</h5>
                                </a>
                                <div class="product-price">
                                    {{number_format($related->price).',000'}}<sup>đ</sup>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- related Product Section End-->
@endsection

@section('script')

@endsection
