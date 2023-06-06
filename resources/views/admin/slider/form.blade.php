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
                  Slider
                    <div class="page-title-subheading">
                       Xem, tạo, cập nhật, xóa và quản lý
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
                <a href="{{route('slider.create')}}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
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
                @if(!isset($slider))
                    <form method="post" action="{{route('slider.store')}}" enctype="multipart/form-data">
                        @else
                        <form method="post" action="{{route('slider.update',$slider->id)}}" enctype="multipart/form-data">
                            @method('PUT')
                            @endif

                            @csrf
                        <div class="position-relative row form-group">
                            <label for="title" class="col-md-3 text-md-right col-form-label">Tiêu đề</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="title" id="title" placeholder="Tiêu đề" type="text"
                                    class="form-control" value="{{isset($slider) ? $slider->title : ''}}">
                                    @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Description</label>
                            <div class="col-md-9 col-xl-8">
                                    {!! Form::textarea('description', isset($slider) ? $slider->description : '', 
                                    ['style'=>'resize:none', 'class'=>'form-control','placeholder'=>'...','id'=>'description']) !!}
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="link" class="col-md-3 text-md-right col-form-label">Đường dẫn</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="link" id="link" placeholder="Đường dẫn" type="text"
                                    class="form-control" value="{{isset($slider) ? $slider->link : ''}}">
                                    @error('link')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                            {!! Form::label('status', 'Status') !!}
                        </div>   
                            <div class="col-md-9 col-xl-8">  
                                @if(!isset($slider))         
                                <input type="checkbox" name="status"/>
                                @else
                                <input type="checkbox" name="status" {{$slider->status=='0' ? 'checked':''}}/>
                                @endif
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                            {!! Form::label('image', 'Ảnh slider', []) !!}
                        </div>
                        <div class="col-md-9 col-xl-8">
                            {!! Form::file('image', ['class'=>'form-control']) !!}
                            @if(!isset($slider))
                            @error('image')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        @endif
                            @if(isset($slider))
                              <img class="me-4 border" style="margin:10px;width:200px;height:120px;" src="{{asset('uploads/slider/'.$slider->image)}}">
                            @endif
                        </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                <a href="{{route('slider.index')}}" class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Cancel</span>
                                </a>
                                @if(!isset($slider))
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