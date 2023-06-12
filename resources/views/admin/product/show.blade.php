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
                    Sản phẩm
                    <div class="page-title-subheading">
                       Xem, tạo, cập nhật, xóa và quản lý
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
                <a href="{{route('product.create')}}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    Thêm mới
                </a>
            </div>
        </div>
    </div>

    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a href="{{route('product.edit', $product->id)}}" class="nav-link">
                <span class="btn-icon-wrapper pr-2 opacity-8">
                    <i class="fa fa-edit fa-w-20"></i>
                </span>
                <span>Edit</span>
            </a>
        </li>
        <li class="nav-item delete">
            <form action="{{route('product.destroy', $product->id)}}" method="post">
                @method('DELETE')
                @csrf
                <button class="nav-link btn" type="submit"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                    <span class="btn-icon-wrapper pr-2 opacity-8">
                        <i class="fa fa-trash fa-w-20"></i>
                    </span>
                    <span>Delete</span>
                </button>
            </form>
        </li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body display_data">

                    <div class="position-relative row form-group">
                        <label for="" class="col-md-3 text-md-right col-form-label">Ảnh sản phẩm</label>
                        <div class="col-md-9 col-xl-8">
                            <ul class="text-nowrap overflow-auto" id="images">
                                <li class="d-inline-block mr-1" style="position: relative;">
                                    <img style="height: 150px;" src="{{asset('uploads/product/'.$product->productImage[0]->path)}}"
                                        alt="Image">
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="brand_id"
                            class="col-md-3 text-md-right col-form-label">Quản lý ảnh</label>
                        <div class="col-md-9 col-xl-8">
                            <p><a href="/admin/product/{{$product->id}}/image">Quản lý ảnh</a></p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="brand_id"
                            class="col-md-3 text-md-right col-form-label">Quản lý chi tiết</label>
                        <div class="col-md-9 col-xl-8">
                            <p><a href="/admin/product/{{$product->id}}/detail">Quản lý chi tiết</a></p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="brand_id"
                            class="col-md-3 text-md-right col-form-label">Thương hiệu</label>
                        <div class="col-md-9 col-xl-8">
                            <p> {{$product->brand->name, $product->id}}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="product_category_id"
                            class="col-md-3 text-md-right col-form-label">Danh mục</label>
                        <div class="col-md-9 col-xl-8">
                            <p> {{$product->productCategory->name, $product->id}}</p>
                        </div>
                    </div>

                
                    <div class="position-relative row form-group">
                        <label for="name" class="col-md-3 text-md-right col-form-label">Tên sản phẩm</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$product->name}}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="price"
                            class="col-md-3 text-md-right col-form-label">Giá</label>
                        <div class="col-md-9 col-xl-8">
                            <div class="badge badge-danger mt-2">
                                <p>{{$product->price}}.000 <sup>đ</sup></p>
                            </div>
                        </div>
                    </div>


                    <div class="position-relative row form-group">
                        <label for="description"
                            class="col-md-3 text-md-right col-form-label">Mô tả sản phẩm</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{!! $product->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection