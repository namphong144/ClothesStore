@extends('client.layout.layout')
@section('title', 'Homepage')
@section('body')
         <!--Breadcrumb section-->
         <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <a href="index.html"><i class="fa fa-home"></i>Trang chủ</a>
                            <a href="shop.html">Shop</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <!--Breadcrumb section end-->
           <!-- Register section begin -->
           <div class="register-login-setion spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="register-form">
                            <h2>ĐĂNG KÝ</h2>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="group-input">
                                    <label for="username">Họ & Tên *</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="group-input">
                                    <label for="pass">Email *</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div> 
                                <div class="group-input">
                                    <label for="pass">Mật khẩu *</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="group-input">
                                    <label for="con-pass">Xác thực mật khẩu *</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="group-input">
                                    <label for="pass">Điện thoại *</label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="group-input">
                                    <label for="pass">Điạ chỉ(số nhà, quận, huyện, tỉnh) *</label>
                                    <input id="address" placeholder="Địa chỉ..." type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="site-btn register-btn">ĐĂNG KÝ</button>
                            </form>
                            <div class="switch-login">
                                <a href="{{route('login')}}" class="or-login">hoặc Đăng nhập</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           </div>
            <!-- Register section end -->           
          @endsection