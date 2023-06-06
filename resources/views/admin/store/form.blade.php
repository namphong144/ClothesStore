@extends('layouts.layout_admin')

@section('main')
<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                  Thông tin của hàng
                    <div class="page-title-subheading">
                        Quản lý cửa hàng
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                @if($errors->any())
                <div class="alert alert-danger"><ul>
                    @if ($errors->all())
                    <li>Hãy kiểm tra lại dữ liệu của bạn!</li> 
                    @endif
                    </ul>
                </div>
                @endif
                <div class="card-body">
                    <form method="post" action="{{route('store.update',$store->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="position-relative row form-group">
                            <label for="image"
                                class="col-md-3 text-md-right col-form-label">Logo</label>
                            <div class="col-md-9 col-xl-8">
                                <img style="height: 80px;weight:110px; cursor: pointer;"
                                class="thumbnail" data-toggle="tooltip"
                                title="Click to change the image" data-placement="bottom"
                                src="{{asset('uploads/logo/'.$store->logo)}}" alt="Avatar">
                            <input name="image" type="file" onchange="changeImg(this)"
                                class="image form-control-file" style="display: none;" value="">
                            <input type="hidden" name="image_old" value="">
                            <small class="form-text text-muted">
                                Click on the image to change (required)
                            </small>
                                @error('logo')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên cửa hàng</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="name" id="name" type="text"
                                    class="form-control" value="{{$store->name}}">
                                    @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="email"
                                class="col-md-3 text-md-right col-form-label">Email</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="email" id="email" type="text"
                                    class="form-control" value="{{$store->email}}">
                                    @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="address"
                                class="col-md-3 text-md-right col-form-label">Địa chỉ</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="address" id="address" type="text"
                                    class="form-control" value="{{$store->address}}">
                                    @error('address')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="phone"
                                class="col-md-3 text-md-right col-form-label">Điện thoại</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="phone" id="phone" type="text"
                                    class="form-control" value="{{$store->phone}}">
                                    @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                <a href="{{route('store.show', $store->id)}}" class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Cancel</span>
                                </a>

                                <button type="submit"
                                class="btn-shadow btn-hover-shine btn btn-primary">
                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                    <i class="fa fa-download fa-w-20"></i>
                                </span>
                                <span>Cập nhật</span>
                            </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection