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
                  Nhà cung cấp
                    <div class="page-title-subheading">
                       Xem, tạo, cập nhật, xóa và quản lý
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
                <a href="{{route('manufacturer.create')}}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    Thêm mới
                </a>
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
                @if(!isset($manufacturer))
                    <form method="post" action="{{route('manufacturer.store')}}" enctype="multipart/form-data">
                        @else
                        <form method="post" action="{{route('manufacturer.update',$manufacturer->id)}}" enctype="multipart/form-data">
                            @method('PUT')
                            @endif

                            @csrf
                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên nhà cung cấp</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="name" id="slug" placeholder="..." type="text"
                                    class="form-control" value="{{isset($manufacturer) ? $manufacturer->name : ''}}" onkeyup="ChangeToSlug()">
                                    @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="phone" class="col-md-3 text-md-right col-form-label">Số điện thoại</label>
                            <div class="col-md-9 col-xl-8">
                                <input required name="phone" placeholder="..." type="text"
                                    class="form-control" value="{{ isset($manufacturer) ? $manufacturer->phone : ''}}">
                                    @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="address" class="col-md-3 text-md-right col-form-label">Địa chỉ</label>
                            <div class="col-md-9 col-xl-8">
                                <input required name="address" placeholder="..." type="text"
                                    class="form-control" value="{{ isset($manufacturer) ? $manufacturer->address : ''}}">
                                    @error('address')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                <a href="{{route('manufacturer.index')}}" class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Cancel</span>
                                </a>
                                @if(!isset($manufacturer))
                                <button type="submit"
                                    class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-download fa-w-20"></i>
                                    </span>
                                    <span>Thêm</span>
                                </button>
                               
                            @else
                            <button type="submit"
                            class="btn-shadow btn-hover-shine btn btn-primary">
                            <span class="btn-icon-wrapper pr-2 opacity-8">
                                <i class="fa fa-download fa-w-20"></i>
                            </span>
                            <span>Cập nhật</span>
                        </button>
                            @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection