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
                @if(!isset($product))
                    <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                        @else
                        <form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
                            @method('PUT')
                            @endif

                            @csrf
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Tên</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name" id="slug" placeholder="Tên sản phẩm" type="text"
                                        class="form-control" value="{{isset($product) ? $product->name : ''}}" onkeyup="ChangeToSlug()">
                                        @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                    <input type="hidden" required name="slug" id="convert_slug" placeholder="Slug" type="text"
                                        class="form-control" readonly value="{{ isset($product) ? $product->slug : ''}}">
                            </div>

                            <div class="position-relative row form-group">
                                <div class="col-md-3 text-md-right col-form-label">
                                    {!! Form::label('Brand', 'Thương hiệu', []) !!} 
                                </div>
                                <div class="col-md-9 col-xl-8">
                                    {!! Form::select('brand_id', $brand, isset($product) ? $product->brand_id : '', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <div class="col-md-3 text-md-right col-form-label">
                                    {!! Form::label('Category', 'Danh mục', []) !!}
                                </div>
                                 <div class="col-md-9 col-xl-8">
                                    {!! Form::select('category_id', $category, isset($product) ? $product->category_id : '', ['class'=>'form-control']) !!}
                                </div>
                             </div>

                             <div class="position-relative row form-group">
                                <div class="col-md-3 text-md-right col-form-label">
                                    {!! Form::label('price', 'Giá', []) !!}
                                </div>  
                                <div class="col-md-9 col-xl-8">
                                    {!! Form::number('price', isset($product) ? $product->price : '', ['class'=>'form-control','placeholder'=>'...','min'=>'0']) !!}
                                    @error('price')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                 </div>
                            </div>

                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                                {!! Form::label('status', 'Trạng thái', []) !!}
                            </div>
                            <div class="col-md-9 col-xl-8">
                                {!! Form::select('status', ['0'=>'Hiển thị','1'=>'Không hiển thị'], isset($product) ? $product->status : '', ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                                 {!! Form::label('images', 'Ảnh sản phẩm', []) !!}
                            </div>
                            <div class="col-md-9 col-xl-8">
                                <input type="file" name="images[]" multiple class="form-control">
                                @if(isset($product))
                                    @if($product->productImage)
                                    <div class="row">
                                        @foreach ($product->productImage as $image)
                                        <div class="col-md-2">
                                            <img class="me-4 border" style="margin:10px;width:150px;height:150px;" src="{{asset('uploads/product/'.$image->path)}}">
                                            <a href="{{url('admin/product-image/'.$image->id.'/delete')}}" class="d-block">Xóa ảnh</a>
                                        </div>  
                                        @endforeach
                                    </div>
                                        @else
                                        <h5>This product no image!</h5>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                                {!! Form::label('description', 'Mô tả sản phẩm', []) !!}
                            </div>
                            <div class="col-md-9 col-xl-8">
                                {!! Form::textarea('description', isset($product) ? $product->description : '', ['style'=>'resize:none', 'class'=>'form-control','placeholder'=>'...','id'=>'description']) !!}
                                 @error('description')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                <a href="{{route('product.index')}}" class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Cancel</span>
                                </a>
                                @if(!isset($product))
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

{{-- CK Editor --}}
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<script>
   CKEDITOR.replace('description');
</script>
@endsection