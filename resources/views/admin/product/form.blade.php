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

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @if ($errors->all())
            <li>Hãy kiểm tra lại dữ liệu của bạn!</li> 
            @endif
        </ul>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                @if(!isset($product))
                    {!! Form::open(['route'=>'product.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                @else
                    {!! Form::open(['route'=>['product.update',$product->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                @endif

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Sản phẩm</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Mô tả</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Hình ảnh </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="size-tab" data-bs-toggle="tab" data-bs-target="#size" type="button" role="tab" aria-controls="size" aria-selected="false">Size</button>
                      </li>
                  </ul>

                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p></p>
                        <p></p>
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
                            {!! Form::label('Manufacturer', 'Nhà sản xuất', []) !!} 
                            </div>
                            <div class="col-md-9 col-xl-8">
                            {!! Form::select('manufacturer_id', $manufacturer, isset($product) ? $product->manufacturer_id : '', ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                            {!! Form::label('name', 'Tên sản phẩm', []) !!}
                        </div>
                        <div class="col-md-9 col-xl-8">
                            {!! Form::text('name', isset($product) ? $product->name : '', ['class'=>'form-control','placeholder'=>'...','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        </div>
                        <div class="position-relative row form-group">
                            {!! Form::hidden('slug', isset($product) ? $product->slug : '', ['class'=>'form-control','placeholder'=>'...','id'=>'convert_slug', 'readonly']) !!}
                        </div>
    
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                            {!! Form::label('price_origin', 'Giá nhập', []) !!}
                            </div>  
                            <div class="col-md-9 col-xl-8">
                            {!! Form::number('price_origin', isset($product) ? $product->price_origin : '', ['class'=>'form-control','placeholder'=>'...','min'=>'0']) !!}
                            @error('price_origin')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
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
                            {!! Form::label('discount', 'Giá khuyến mại', []) !!}
                            </div>
                            <div class="col-md-9 col-xl-8">
                            {!! Form::number('discount', isset($product) ? $product->discount : '', ['class'=>'form-control','placeholder'=>'...','min'=>'0']) !!}
                        </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                            {!! Form::label('sku', 'Sku', []) !!}
                        </div>
                        <div class="col-md-9 col-xl-8">
                            {!! Form::text('sku', isset($product) ? $product->sku : '', ['class'=>'form-control','placeholder'=>'...']) !!}
                            @error('sku')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                            {!! Form::label('tag', 'Tag', []) !!}
                        </div>
                        <div class="col-md-9 col-xl-8">
                            {!! Form::text('tag', isset($product) ? $product->tag : '', ['class'=>'form-control','placeholder'=>'...']) !!}
                            @error('tag')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        </div>
                       
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                            {!! Form::label('featured', 'Featured') !!}
                        </div>
                            <div class="col-md-9 col-xl-8">  
                                @if(!isset($product))         
                                <input type="checkbox" name="featured"/>
                                @else
                                <input type="checkbox" name="featured" {{$product->featured=='0' ? 'checked':''}}/> 
                                @endif
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                            {!! Form::label('status', 'Status') !!}
                        </div>
                            <div class="col-md-9 col-xl-8">  
                                @if(!isset($product))         
                                <input type="checkbox" name="status"/>
                                @else
                                <input type="checkbox" name="status" {{$product->status=='1' ? 'checked':''}}/> <small>Check:ẩn</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p></p>
                        <p></p>
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
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <p></p>
                        <p></p>
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                            {!! Form::label('Image', 'Ảnh mô tả', []) !!}
                        </div>
                        <div class="col-md-9 col-xl-8">
                            {!! Form::file('image', ['class'=>'form-control']) !!}
                            @if(!isset($product))
                            @error('image')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        @endif
                            @if(isset($product))
                              <img class="me-4 border" style="margin:10px;width:130px;height:150px;" src="{{asset('uploads/product_des/'.$product->image)}}">
                            @endif
                        </div>
                        </div>
    
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                            {!! Form::label('images', 'Ảnh sản phẩm (nhiều)', []) !!}
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
                    </div>
                    <div class="tab-pane fade" id="size" role="tabpanel" aria-labelledby="size-tab">
                        <p></p>
                        <p></p>
                        <div class="position-relative row form-group">
                            @if(!isset($product))   
                            <div class="col-md-3 text-md-left col-form-label">
                                <label for="size" class="col-md-12 text-md-left col-form-label" style="font-weight: bold;">Chọn size:</label>
                            </div>
 
                            <div class="container">
                            <div class="row">  
                                @forelse ($size as $sizeitem)
                                <div class="col-md-3">
                                    <div class="p-2 border mb-3">
                                        Size: <input type="checkbox" name="size[{{$sizeitem->id}}]" value="{{$sizeitem->id}}">
                                        {{$sizeitem->name}}
                                        <br>
                                        Số lượng:  <input type="number" name="sizequantity[{{$sizeitem->id}}]" style="width: 70px; border:1px solid">
                                     </div>
                                </div>  
                                @error('size')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                                @empty
                                <div class="col-md-12">
                                    <h2>Không tìm thấy size</h2>
                                 </div> 
                                </div> 
                            </div> 
                                @endforelse
                              @else
                              <div class="col-md-3 text-md-left col-form-label">
                                <h4>Thêm size mới</h4>
                                <label for="size" class="col-md-12 text-md-left col-form-label" style="font-weight: bold;">Chọn size:</label>
                            </div>
 
                            <div class="container">
                            <div class="row">  
                              @forelse ($sizes as $sizeitem)
                              <div class="col-md-3">
                                  <div class="p-2 border mb-3">
                                      Size: <input type="checkbox" name="size[{{$sizeitem->id}}]" value="{{$sizeitem->id}}">
                                      {{$sizeitem->name}}
                                      <br>
                                      Số lượng:  <input type="number" name="sizequantity[{{$sizeitem->id}}]" style="width: 70px; border:1px solid">
                                   </div>
                              </div>  
                              @empty
                              <div class="col-md-12">
                                  <h2>Không tìm thấy size</h2>
                               </div> 
                              @endforelse
                             
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="container">
                            <table class="table align-middle mb-0 table-border">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Size</th>
                                        <th>Số lượng</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->product_size as $prodSize)                   
                                   <tr class="prod-size-tr">
                                    <td>
                                        @if ($prodSize->size)
                                        {{$prodSize->size->name}}
                                        @else
                                        <h2>Không tìm thấy size</h2>
                                        @endif 
                                    </td>
                                    <td>
                                        <div class="input-group mb-3" style="width: 150px;">
                                            <input type="text" value="{{$prodSize->quantity}}" class="productQuantitySize form-control form-control-sm">
                                            <button type="button" value="{{$prodSize->id}}" class=" updateProductSizeBtn btn btn-primary btn-sm text-white">Cập nhật</button>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" value="{{$prodSize->id}}" class="deleteProductSizeBtn btn btn-danger btn-sm text-white">Xóa</button>
                                    </td>
                                   </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                        @endif
                        </div>

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
                            {!! Form::submit ('Thêm', ['class'=>'btn btn-primary btn-shadow btn-hover-shine']) !!}
                            @else
                            {!! Form::submit('Cập nhật', ['class'=>'btn btn-primary btn-shadow btn-hover-shine']) !!}
                             @endif
                        </div>
                    </div>

                {!! Form::close() !!}
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

@if(isset($product))   
@section('script')

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.updateProductSizeBtn', function(){
            var product_id = "{{$product->id}}";
            var prod_size_id = $(this).val();
            var qty = $(this).closest('.prod-size-tr').find('.productQuantitySize').val();
           // alert(prod_size_id);

           if(qty <= 0){
            alert('Size cần được nhập số lượng!');
            return false;
           }

           var data = {
                'product_id': product_id,
                'prod_size_id': prod_size_id,
                'qty': qty
              };
            
              $.ajax({
              url: "/admin/product-size/"+prod_size_id,
              method: "POST",
              data: data,
              success: function(response) {
                  alert(response.message);
              }
          });

        });

        $(document).on('click', '.deleteProductSizeBtn', function(){
            var prod_size_id = $(this).val();
            var thisClick = $(this);

              $.ajax({
              url: "/admin/product-size/"+prod_size_id+"/delete",
              type: "GET",
              success: function(response) {
                thisClick.closest('.prod-size-tr').remove();
                alert(response.message);
              }
          });

        });
    });
</script>
@endsection
@endif