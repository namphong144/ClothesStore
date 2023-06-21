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
                   Blog
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
                @if(!isset($blog))
                    <form method="post" action="{{route('blog.store')}}" enctype="multipart/form-data">
                        @else
                        <form method="post" action="{{route('blog.update',$blog->id)}}" enctype="multipart/form-data">
                            @method('PUT')
                            @endif
                            @csrf
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                                {!! Form::label('title', 'Tiêu đề', []) !!}
                            </div>
                            <div class="col-md-9 col-xl-8">
                                {!! Form::text('title', isset($blog) ? $blog->title : '', ['class'=>'form-control','placeholder'=>'...','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                                @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            {!! Form::hidden('slug', isset($blog) ? $blog->slug : '', ['class'=>'form-control','placeholder'=>'...','id'=>'convert_slug', 'readonly']) !!}
                        </div>

                        <div class="position-relative row form-group">
                            <label for="sub_title" class="col-md-3 text-md-right col-form-label">Tiêu đề phụ</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="sub_title" id="sub_title" placeholder="..." type="text"
                                    class="form-control" value="{{isset($blog) ? $blog->sub_title : ''}}">
                                    @error('sub_title')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="content" class="col-md-3 text-md-right col-form-label">Nội dung</label>
                            <div class="col-md-9 col-xl-8">
                                    {!! Form::textarea('content', isset($blog) ? $blog->content : '', 
                                    ['style'=>'resize:none', 'class'=>'form-control','placeholder'=>'...','id'=>'content']) !!}
                                    @error('content')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
        
                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                            {!! Form::label('image', 'Ảnh blog', []) !!}
                        </div>
                        <div class="col-md-9 col-xl-8">
                            {!! Form::file('image_cover', ['class'=>'form-control']) !!}
                            @if(!isset($blog))
                            @error('image_cover')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        @endif
                            @if(isset($blog))
                              <img class="me-4 border" style="margin:10px;width:200px;height:120px;" src="{{asset('uploads/blog/'.$blog->image_cover)}}">
                            @endif
                        </div>
                        </div>

                        <div class="position-relative row form-group">
                            <div class="col-md-3 text-md-right col-form-label">
                                {!! Form::label('status', 'Trạng thái', []) !!}
                            </div>
                            <div class="col-md-9 col-xl-8">
                                {!! Form::select('status', ['0'=>'Hiển thị','1'=>'Không hiển thị'], isset($blog) ? $blog->status : '', ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                <a href="{{route('blog.index')}}" class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Cancel</span>
                                </a>
                                @if(!isset($blog))
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
   CKEDITOR.replace('content');
</script>
@endsection