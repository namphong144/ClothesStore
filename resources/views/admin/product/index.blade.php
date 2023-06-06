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

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Tất cả ({{$countlist}})</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sắp hết</button>
                        </li>
                      </ul>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="table-responsive">
                            <div class="container-fluid">
                                <table id="myTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                    <thead>
                                        <tr class="table-primary">
                                            <th class="text-center">ID</th>
                                            <th>Sản phẩm / Thương hiệu</th>
                                            <th class="text-center">Giá nhập</th>
                                            <th class="text-center">Giá</th>
                                            <th class="text-center">Trend</th>
                                            <th class="text-center">Trạng thái</th>
                                            <th class="text-center">Hành động</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($list as $key=>$cate)
                                        <tr>
                                            <td class="text-center text-muted">{{$cate->id}}</td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="widget-content-left">
                                                                <img style="height: 60px;"
                                                                    data-toggle="tooltip" title="Image"
                                                                    data-placement="bottom"
                                                                    src="{{asset('uploads/product_des/'.$cate->image)}}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{$cate->name}}</div>
                                                            <div class="widget-subheading opacity-7">
                                                                {{$cate->brand->name}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge badge-dark mt-2">
                                                    {{$cate->price_origin}}.000
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge badge-danger mt-2">
                                                @if ($cate->discount)
                                                {{$cate->discount}}.000 
                                                <div class="badge badge-dark mt-1">
                                                    <i>Sale</i>
                                                </div>
                                                @else
                                                {{$cate->price}}.000
                                                @endif
                                            </div>
                                            </td>
                                            <td class="text-center">
                                                <select name="" id="{{$cate->id}}" class="trend_choose">
                                                    @if ($cate->featured == 0)
                                                    <option value="1">No</option>
                                                    <option selected value="0">Yes</option>
                                                    @else
                                                    <option selected value="1">No</option>
                                                    <option value="0">Yes</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <select name="" id="{{$cate->id}}" class="status_choose">
                                                    @if ($cate->status == 0)
                                                    <option value="1">Không</option>
                                                    <option selected value="0">Hiển thị</option>
                                                    @else
                                                    <option selected value="1">Không</option>
                                                    <option value="0">Hiển thị</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('product.show', $cate->id)}}"
                                                    class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                                Chi tiết
                                                </a>
                                                <br>
                                                <a href="{{route('product.edit', $cate->id)}}" data-toggle="tooltip" title="Edit"
                                                    data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="fa fa-edit fa-w-20"></i>
                                                    </span>
                                                </a>
                                                <form class="d-inline" action="{{route('product.destroy', $cate->id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                        type="submit" data-toggle="tooltip"
                                                        data-placement="bottom"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
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
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="table-responsive">
                            <div class="container-fluid">
                                {{-- <table id="myTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                    <thead>
                                        <tr class="table-primary">
                                            <th class="text-center">ID</th>
                                            <th>Sản phẩm / Thương hiệu</th>
                                            <th class="text-center">Giá nhập</th>
                                            <th class="text-center">Giá</th>
                                            <th class="text-center">Trend</th>
                                            <th class="text-center">Trạng thái</th>
                                            <th class="text-center">Hành động</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($list as $key=>$cate)
                                        <tr>
                                            <td class="text-center text-muted">{{$cate->id}}</td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="widget-content-left">
                                                                <img style="height: 60px;"
                                                                    data-toggle="tooltip" title="Image"
                                                                    data-placement="bottom"
                                                                    src="{{asset('uploads/product_des/'.$cate->image)}}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{$cate->name}}</div>
                                                            <div class="widget-subheading opacity-7">
                                                                {{$cate->brand->name}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge badge-dark mt-2">
                                                    {{$cate->price_origin}}.000
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge badge-danger mt-2">
                                                @if ($cate->discount)
                                                {{$cate->discount}}.000 
                                                <div class="badge badge-dark mt-1">
                                                    <i>Sale</i>
                                                </div>
                                                @else
                                                {{$cate->price}}.000
                                                @endif
                                            </div>
                                            </td>
                                            <td class="text-center">
                                                <select name="" id="{{$cate->id}}" class="trend_choose">
                                                    @if ($cate->featured == 0)
                                                    <option value="1">No</option>
                                                    <option selected value="0">Yes</option>
                                                    @else
                                                    <option selected value="1">No</option>
                                                    <option value="0">Yes</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <select name="" id="{{$cate->id}}" class="status_choose">
                                                    @if ($cate->status == 0)
                                                    <option value="1">Không</option>
                                                    <option selected value="0">Hiển thị</option>
                                                    @else
                                                    <option selected value="1">Không</option>
                                                    <option value="0">Hiển thị</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('product.show', $cate->id)}}"
                                                    class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                                Chi tiết
                                                </a>
                                                <br>
                                                <a href="{{route('product.edit', $cate->id)}}" data-toggle="tooltip" title="Edit"
                                                    data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="fa fa-edit fa-w-20"></i>
                                                    </span>
                                                </a>
                                                <form class="d-inline" action="{{route('product.destroy', $cate->id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                        type="submit" data-toggle="tooltip"
                                                        data-placement="bottom"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                        <span class="btn-icon-wrapper opacity-8">
                                                            <i class="fa fa-trash fa-w-20"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table> --}}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
      $('.trend_choose').change(function(){
        var trend_val = $(this).val();
        var product_id = $(this).attr('id');
        $.ajax({
                url: "{{ route('trend-choose') }}",
                method: "GET",
                data: {
                    trend_val:trend_val,
                    product_id:product_id
                },
                success: function(data) {
                   alert('Thay đổi thành công!');
                }
            });
      })

      $('.status_choose').change(function(){
        var status_val = $(this).val();
        var product_id = $(this).attr('id');
        $.ajax({
                url: "{{ route('product-status-choose') }}",
                method: "GET",
                data: {
                    status_val:status_val,
                    product_id:product_id
                },
                success: function(data) {
                   alert('Thay đổi thành công!');
                }
            });
      })
</script>
@endsection