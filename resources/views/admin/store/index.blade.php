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
                   Thông tin cửa hàng
                    <div class="page-title-subheading">
                       Quản lý cửa hàng
                    </div>
                </div>
            </div>

        </div>
    </div>

    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a href="{{route('store.edit', $store->id)}}" class="nav-link">
                <span class="btn-icon-wrapper pr-2 opacity-8">
                    <i class="fa fa-edit fa-w-20"></i>
                </span>
                <span>Edit</span>
            </a>
        </li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body display_data">
                    <div class="position-relative row form-group">
                        <label for="image" class="col-md-3 text-md-right col-form-label">Logo</label>
                        <div class="col-md-9 col-xl-8">
                            <p>
                                <img style="height: 80px;weight:110px" data-toggle="tooltip"
                                    title="Logo" data-placement="bottom"
                                    src="{{asset('uploads/logo/'.$store->logo)}}" alt="Logo">
                            </p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="name" class="col-md-3 text-md-right col-form-label">
                          Tên cửa hàng
                        </label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$store->name}}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$store->email}}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="company_name" class="col-md-3 text-md-right col-form-label">
                           Địa chỉ
                        </label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$store->address}}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="country"
                            class="col-md-3 text-md-right col-form-label">Điện thoại</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$store->phone}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection