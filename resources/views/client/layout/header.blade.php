
    <!-- HEADER -->
    <div class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class="fa fa-envelope"></i>
                        huyenha200204@gmail.com
                    </div>
                    <div class="phone-service">
                        <i class="fa fa-phone"></i>
                        +84 54.65.32.431
                    </div>
                </div>
                <div class="ht-right">
                    @if (Auth::user())
                    <a id="navbarDropdown" class="nav-link dropdown-toggle login-panel" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      {{ Auth::user()->name }}

                    </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    @else
                    <a href="{{ route('login') }}" class="login-panel"><i class="fa fa-user"></i> Login</a>
                    @endif
{{--                    <div class="lan-selector">--}}
{{--                        <select class="language_drop" name="countries" id="countries" style="width:300px;">--}}
{{--                        <option value="yt" data-image="front/img/flag-1.jpg" data-imagecss="flag yt"--}}
{{--                        data-title="English">English</option>--}}
{{--                        <option value="yu" data-image="front/img/flag-2.jpg" data-imagecss="flag yu"--}}
{{--                        data-title="Bangladesh">German</option>--}}
{{--                    </select>--}}
{{--                    </div>--}}
{{--                    <div class="top-social">--}}
{{--                        <a href="#"><i class="ti-facebook"></i></a>--}}
{{--                        <a href="#"><i class="ti-twitter-alt"></i></a>--}}
{{--                        <a href="#"><i class="ti-linkedin"></i></a>--}}
{{--                        <a href="#"><i class="ti-pinterest"></i></a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="{{route('homepage')}}">
                                {{-- <img src="front/img/logo.png" height="25" alt=""> --}}
                                <img src="{{asset('dashboard/assets/images/logo1.png')}}" alt="" width="150px" height="50px">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Categories</button>
                            <div class="input-group">
                                <form action="{{route('tim-kiem')}}" method="GET">
                                    <input id="timkiem" type="text" name="search" placeholder="Tìm kiếm..." autocomplete="off" required>
                                    <button type="submit"><i class="ti-search"></i></button>
                                 </form>
                                 <ul class="list-group" id="result" style="display: none; weight:200px;"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 text-right">
                        <ul class="nav-right">
                            <li class="cart-icon">
                                <a href="">
                                    <i class="icon_bag_alt"></i>
                                    <span>{{\Cart::getContent()->count()}}</span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                @forelse (\Cart::getContent() as $item)
                                                <tr>
                                                    <td class="si-pic"><a href="{{route('san-pham', $item->attributes->slug)}}"><img src="{{asset('uploads/product/'.$item->attributes->image)}}" alt="" style="width:70px;height: 50px;"></a></td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p>{{number_format($item->price).',000'}} <sup>đ</sup> x {{$item->quantity}}</p>
                                                            <h6>{{$item->name}}</h6>
                                                        </div>
                                                    </td>
                                                    <form class="d-inline" action="{{route('delete-cart')}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                                        <td class="si-close">
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
                                                <tr>  <th colspan="3"><h4>Không có sản phẩm nào trong giỏ hàng của bạn!</h4></th></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    @if (!\Cart::getContent()->isEmpty())
                                    <div class="select-total">
                                        <span>Tổng:</span>
                                        <h5>{{number_format(Cart::getSubTotal()).',000'}} <sup>đ</sup></h5>
                                    </div>
                                    @endif
                                    <div class="select-button">
                                        <a href="{{route('list-cart')}}" class="primary-btn view-card">Giỏ hàng</a>
                                        <a href="{{route('check-out')}}" class="primary-btn checkout-btn">Thanh toán</a>
                                    </div>
                                </div>
                            </li>
                            @if (!\Cart::getContent()->isEmpty())
                            <li class="cart-price">{{number_format(Cart::getSubTotal()).',000'}} <sup>đ</sup></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>Tất cả sản phẩm</span>
                        <ul class="depart-hover">
                           @foreach ($category as $key=>$cate)
                           <li><a href="{{route('danh-muc', $cate->slug)}}">{{$cate->name}}</a></li>
                           @endforeach
                    </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="{{ request()->is('/', 'home') ? 'active' : '' }}"><a href="{{route('homepage')}}">Trang chủ</a></li>
                        <li class="{{ request()->is('shop', 'shop/*','list-cart', 'check-out', 'history-purchase', 'history-detail/*') ? 'active' : '' }}"><a href="{{route('shop')}}">Shop</a></li>
                        <li class="{{ request()->is('blogs', 'blogs/*') ? 'active' : '' }}"><a href="{{route('blogs')}}">Blog</a></li>
                        <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{route('contact')}}">Liên hệ</a></li>
                        <li><a href="">Trang</a>
                            <ul class="dropdown">
                                <li><a href="{{route('list-cart')}}">Giỏ hàng</a></li>
                                <li><a href="{{route('check-out')}}">Thanh toán</a></li>
                                <li><a href="{{route('history-purchase')}}">Account</a></li>
                                <li><a href="{{route('register')}}">Đăng ký</a></li>
                                @if(!Auth::check())
                                <li><a href="{{route('login')}}">Đăng nhập</a></li>
                                @else
                                <li><a id="navbarDropdown" class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 Đăng xuất
                                </a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                @endif
                    </ul>
                        </li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </div>
    <!-- HEADER END-->
