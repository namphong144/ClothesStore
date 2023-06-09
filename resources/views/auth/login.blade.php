{{-- 
@extends('layouts.layout_login')
@section('content')

<div class="h5 modal-title text-center">
    <h4 class="mt-2">
        <div>Welcome back,</div>
        <span>ĐĂNG NHẬP</span>
    </h4>
</div> 
                                      
                                <form method="POST" action="{{ route('login') }}">
                                            @csrf
                    
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="position-relative form-group">
                                                       
                                                              <input id="email" placeholder="Email here..." type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="position-relative form-group">
                                                            <input id="password"  placeholder="Password here..." type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative form-check">
                                                  <input class="form-check-input" type="checkbox" name="remember" id="exampleCheck" {{ old('remember') ? 'checked' : '' }}>
                        
                                                            <label class="form-check-label" for="exampleCheck">
                                                                {{ __('Keep me logged in') }}
                                                            </label>
                                            </div>
                                  
                                </div>
                                <div class="modal-footer clearfix">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Đăng nhập ') }}
                                        </button>
        
                                        {{-- @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif --}}
                                         {{-- @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('register') }}">
                                                {{ __('Bạn chưa có tài khoản? Đăng ký ngay!') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            @endsection --}} 
                
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