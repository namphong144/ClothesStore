@extends('layouts.layout_admin')
@section('title', 'Blog')
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

            <div class="page-title-actions">
                <a href="{{route('blog.create')}}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
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

                <div class="card-header">

                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="btn btn-focus">This week</button>
                            <button class="active btn btn-focus">Anytime</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <div class="container-fluid">
                    <table id="myTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th class="text-center">ID</th>
                                <th>Ảnh</th>
                                <th>Tiêu đề</th>
                                <th>Author</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $key=>$cate)
                            <tr>
                                <td class="text-center text-muted"  scope="row">{{$key+1}}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                          
                                                <div class="widget-content-left">
                                                    <img style="height: 120px;width:200px"
                                                        data-toggle="tooltip" title="Image"
                                                        data-placement="bottom"
                                                        src="{{asset('uploads/blog/'.$cate->image_cover)}}" alt="">
                                                </div>
                                          
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{$cate->title}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div>{{$cate->user->name}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-left">
                                    <div class="badge badge-success">
                                        {{$cate->status ? 'Ẩn':'Hiển thị'}}
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div>{{$cate->created_at}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div>{{$cate->updated_at}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('blog.edit', $cate->id)}}" data-toggle="tooltip" title="Edit"
                                        data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                        <span class="btn-icon-wrapper opacity-8">
                                            <i class="fa fa-edit fa-w-20"></i>
                                        </span>
                                    </a>
                                    <form class="d-inline" action="{{route('blog.destroy', $cate->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                            type="submit" data-toggle="tooltip" title="Delete"
                                            data-placement="bottom"
                                            onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                </div>
             
            </div>
        </div>
    </div>
</div>
@endsection