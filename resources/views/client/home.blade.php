 @extends('client.layout.layout')
@section('title', 'Trang chủ')
@section('body')
          <!-- BODY END-->

      <!-- Hero-->
      <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="front/img/lvbanner.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
{{--                            <span>Bag, kids</span>--}}
                            <h1 style="color: white">PPSTYLE</h1>
                            <p style="color: white">Lấy khách hàng làm mục tiêu, PPSTYLE mong muốn khách hàng tiếp cận nhanh chóng với các sản phẩm thời trang đến từ các thương hiệu trên thế giới.</p>
                                <a href="{{route('shop')}}" class="primary-btn">Mua ngay</a>
                        </div>
                    </div>
{{--                    <div class="off-card">--}}
{{--                        <h2>Sale <span>50%</span></h2>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="front/img/mlb_banner.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            {{--                            <span>Bag, kids</span>--}}
                            <h1 style="color: white">PPSTYLE</h1>
                            <p style="color: white">Lấy khách hàng làm mục tiêu, PPSTYLE mong muốn khách hàng tiếp cận nhanh chóng với các sản phẩm thời trang đến từ các thương hiệu trên thế giới.</p>
                            <a href="{{route('shop')}}" class="primary-btn">Mua ngay</a>
                        </div>
                    </div>
{{--                    <div class="off-card">--}}
{{--                        <h2>Sale <span>50%</span></h2>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
      </section>

      <!-- banner-->
      <div class="banner-section spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="front/img/lv_thumb.jpg" alt="">
{{--                        <div class="inner-text">--}}
{{--                            <h4>Men's</h4>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="front/img/gucci_thumb.jpg" alt="">
{{--                        <div class="inner-text">--}}
{{--                            <h4>Women's</h4>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="front/img/gucci_thumb_2.jpg" alt="">
{{--                        <div class="inner-text">--}}
{{--                            <h4>Kid's</h4>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- End banner-->

    <!-- women bannner section-->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-large set-bg" data-setbg="front/img/products/women-large.jpg">
                        <h2>Women's</h2>
{{--                        <a href="#">Discover more</a>--}}
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="filter-control p-2 text-dark" style="--bs-bg-opacity: .5;background-color: #d9ecf0">
                      <h2>THỜI TRANG NỮ</h2>
                    </div>
                    <div class="product-slider owl-carousel">

                        @foreach ($product_nu as $key=>$nu)
                        <form action="{{route('add-cart')}}" method="POST">
                            @csrf
                                <input type="hidden" value="{{$nu->id}}" name="product_id_hidden">
                                <input type="hidden" value="1" name="qty">
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src={{asset('uploads/product/'.$nu->productImage[0]->path)}} alt="">
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    <li class="quick-view"><a href="{{route('san-pham', $nu->slug)}}">+ Xem chi tiết</a></li>
                                    <li class="w-icon"><a href=""><i class="fa fa-random"></i></a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="category-name">Coat</div>
                                <a href="{{route('san-pham', $nu->slug)}}">
                                    <h5>{{$nu->name}}</h5>
                                </a>
                                <div class="product-price">
                                    {{number_format($nu->price).',000'}} <sup>đ</sup>
                                </div>
                            </div>
                        </div>
                            </form>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
 <!-- end women bannner section-->

    <!-- deal of the week-->
{{--    <section class="deal-of-week set-bg spad" data-setbg="front/img/time-bg.jpg">--}}
{{--        <div class="container">--}}
{{--            <div class="col-lg-6 text-center">--}}
{{--                <div class="section-title">--}}
{{--                    <h2>Deal Of The Week</h2>--}}
{{--                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>--}}
{{--                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
{{--                        <div class="product-price">--}}
{{--                            $35.00--}}
{{--                            <span>HandBag</span>--}}
{{--                        </div>--}}
{{--                </div>--}}
{{--                <div class="countdown-timer" id="countdown">--}}
{{--                    <div class="cd-item">--}}
{{--                        <span>56</span>--}}
{{--                        <p>Days</p>--}}
{{--                    </div>--}}
{{--                    <div class="cd-item">--}}
{{--                        <span>12</span>--}}
{{--                        <p>Hrs</p>--}}
{{--                    </div>--}}
{{--                    <div class="cd-item">--}}
{{--                        <span>40</span>--}}
{{--                        <p>Mins</p>--}}
{{--                    </div>--}}
{{--                    <div class="cd-item">--}}
{{--                        <span>52</span>--}}
{{--                        <p>Secs</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <a href="#" class="primary-btn">Shop Now</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

     <!--men bannner section-->
   <section class="men-banner spad">
        <div class="container-fluid spad">
            <div class="row">
                <div class="col-lg-8">
                    <div class="filter-control p-2 text-dark" style="--bs-bg-opacity: .5;background-color: #d9ecf0">
                      <h2>THỜI TRANG NAM</h2>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach ($product_nam as $key=>$nu)
                        <form action="{{route('add-cart')}}" method="POST">
                            @csrf
                                <input type="hidden" value="{{$nu->id}}" name="product_id_hidden">
                                <input type="hidden" value="1" name="qty">
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src={{asset('uploads/product/'.$nu->productImage[0]->path)}} alt="">
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
{{--                                    <li class="w-icon active">--}}
{{--                                        <button type="submit" class="btn btn-warning add-to-cart">--}}
{{--                                            <i class="icon_bag_alt" ></i>--}}
{{--                                        </button>--}}
{{--                                    </li>--}}
                                    <li class="quick-view"><a href="{{route('san-pham', $nu->slug)}}">+ Xem chi tiết</a></li>
                                    <li class="w-icon"><a href=""><i class="fa fa-random"></i></a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="category-name">{{$nu->brand->name}}</div>
                                <a href="{{route('san-pham', $nu->slug)}}">
                                    <h5>{{$nu->name}}</h5>
                                </a>
                                <div class="product-price">
                                    {{number_format($nu->price).',000'}} <sup>đ</sup>
                                </div>
                            </div>
                        </div>
                    </form>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="product-large set-bg" data-setbg="front/img/products/man-large.jpg">
                        <h2>Men's</h2>
{{--                        <a href="#">Discover more</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!--Instagram section-->
     <div class="instagram-photo">
        <div class="insta-item set-bg" data-setbg="front/img/Louis_Vuitton_logo.png">
{{--            <div class="inside-text">--}}
{{--                <i class="ti-instagram"></i>--}}
{{--                <h5><a href="#">CodeLean Collections</a></h5>--}}
{{--            </div>--}}
        </div>
        <div class="insta-item set-bg" data-setbg="front/img/ysl.jpg">

        </div>
        <div class="insta-item set-bg" data-setbg="front/img/karl.jpg">

        </div>
        <div class="insta-item set-bg" data-setbg="front/img/mlb.jpg">

        </div>
        <div class="insta-item set-bg" data-setbg="front/img/dior.jpg">

        </div>
        <div class="insta-item set-bg" data-setbg="front/img/Gucci.png">

        </div>
     </div>

     <!--Latter blog section-->
     <div class="latest-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Bài Viết</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($blog as $key=>$blg)
                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-blog">
                        <a href="{{route('blog-detail', $blg->slug)}}">
                            <img src="{{asset('uploads/blog/'.$blg->image_cover)}}" alt="blog_image_error" height="280" width="410">
                        </a>
                        <div class="latest-text">
                            <div class="tag-list">
                                <div class="tag-item">
                                    <i class="fa fa-calendar-o"></i>
                                  {{$blg->updated_at}}
                                </div>
                            </div>
                            <a href="{{route('blog-detail', $blg->slug)}}">
                                <h4>{{$blg->title}}</h4>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="benefit-items">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="front/img/icon-1.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Giao hàng toàn quốc</h6>
                                <p>Dù bạn ở nơi đâu</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="front/img/icon-2.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Giao hàng nhanh chóng</h6>
                                <p>Không phải chờ lâu</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="front/img/icon-3.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Bảo mật thanh toán</h6>
                                <p>Giao dịch bảo mật 100%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>

    <!--End Latter blog section-->

        <!-- BODY END-->

  @endsection
