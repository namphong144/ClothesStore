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
                                    <img style="height: 150px;" src="{{asset('uploads/product_des/'.$product->image)}}"
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
                            class="col-md-3 text-md-right col-form-label">Quản lý size</label>
                        <div class="col-md-9 col-xl-8">
                            <div class="table-responsive">
                                <div class="container">
                                <table class="table align-middle mb-0 table-border table-hover">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($product->product_size as $prodSize)   
                                        @if ($prodSize->size)                
                                            <tr class="prod-size-tr">
                                                <td>
                                                    @if ($prodSize->size)
                                                    {{$prodSize->size->name}}
                                                    @endif 
                                                </td>
                                                <td>
                                                    {{$prodSize->quantity}}
                                                </td>
                                            </tr>
                                        @else
                                            <h2>Sản phẩm không tồn tại size!</h2>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
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
                        <label for="brand_id"
                            class="col-md-3 text-md-right col-form-label">Nhà sản xuất</label>
                        <div class="col-md-9 col-xl-8">
                            <p> {{$product->manufacturer->name, $product->id}}</p>
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
                            class="col-md-3 text-md-right col-form-label">Giá nhập</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$product->price_origin}}.000 <sup>đ</sup></p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="price"
                            class="col-md-3 text-md-right col-form-label">Giá</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$product->price}}.000 <sup>đ</sup></p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="discount"
                            class="col-md-3 text-md-right col-form-label">Giá khuyến mại</label>
                        <div class="col-md-9 col-xl-8">
                            <p>   
                                @if ($product->discount)
                                {{$product->discount}}.000 <sup>đ</sup>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div class="position-relative row form-group">
                        <label for="sku"
                            class="col-md-3 text-md-right col-form-label">SKU</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$product->sku}}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="tag"
                            class="col-md-3 text-md-right col-form-label">Tag</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$product->tag}}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="featured"
                            class="col-md-3 text-md-right col-form-label">Trending</label>
                        <div class="col-md-9 col-xl-8">
                            <p>  {{$product->featured ? 'No':'Yes'}}</p>
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