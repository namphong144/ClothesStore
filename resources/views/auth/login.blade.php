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
                        <div class="login-form">
                            <h2>Đăng nhập</h2>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="group-input">
                                    <label for="username">Địa chỉ email *</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="group-input">
                                    <label for="pass">Mật khẩu *</label>
                                    <input id="password"type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                        
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="group-input gi-check">
                                    <div class="gi-more">
                                        <label for="exampleCheck">
                                           Nhớ mật khẩu
                                            <input class="form-check-input" type="checkbox" name="remember" id="exampleCheck" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                        <a href="{{route('password.request')}}" class="forget-pass">Quên mật khẩu</a>
                                    </div>
                                </div>
                                <button type="submit" class="site-btn login-btn">Đăng nhập</button>
                            </form>
                            <div class="switch-login">
                                <a href="{{route('register')}}" class="or-login">hoặc tạo 1 tài khoản</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           </div>
            <!-- Register section end -->
@endsection
                
            