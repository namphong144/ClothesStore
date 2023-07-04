@extends('layouts.layout_admin')

@section('title', 'Đơn hàng')
@section('main')

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Đơn hàng
                    <div class="page-title-subheading">
                        Xem, tạo, cập nhật, xóa và quản lý.
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{route('order-filter')}}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Lọc theo ngày</label>
                        <input type="date" name="date" value="{{Request::get('date')}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Lọc theo trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="">---Chọn---</option>
                            <option value="0" {{Request::get('status') == '0' ? 'selected':''}}>Chờ xác nhận</option>
                            <option value="1" {{Request::get('status') == '1' ? 'selected':''}}>Đã xác nhận</option>
                            <option value="2" {{Request::get('status') == '2' ? 'selected':''}}>Đang vận chuyển</option>
                            <option value="3" {{Request::get('status') == '3' ? 'selected':''}}>Đã hoàn thành</option>
                            <option value="4" {{Request::get('status') == '4' ? 'selected':''}}>Đã huỷ</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <button type="submit" class="btn btn-primary">Lọc kết quả</button>
                    </div>
                </div>
            </form>
            <div class="main-card mb-3 card" style="margin-top: 40px">
                <div class="table-responsive">
                    <table  id="myTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th class="text-center">Mã đơn hàng</th>
                                <th>Khách hàng</th>
                                <th class="text-center">Địa chỉ</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Ngày đặt hàng</th>
                                <th class="text-center">Hình thức thanh toán</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $key=>$order)
                            <tr>
                                <td class="text-center text-muted">{{$order->order_code}}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{$order->user->name}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{$order->user->address}}
                                </td>

                                <td class="text-center">
                                    @if ($order->order_status == 4)
                                    <div class="badge badge-dark mt-2">Đã hủy</div>
                                    @elseif ($order->order_status == 3)
                                    <div class="badge badge-success mt-2">Đã hoàn thành</div>
                                    @else
                                    <select name="" id="{{$order->id}}" class="orderst_choose">
                                        @if ($order->order_status == 0)
                                        <option selected value="0"> 
                                        Chờ xác nhận</option>
                                        <option value="1">
                                            Đã xác nhận</option>
                                        <option value="2">
                                                Đang vận chuyển</option>
                                        
                                    @elseif ($order->order_status == 1)
                                        <option selected value="1">
                                            Đã xác nhận</option>
                                        <option value="2">
                                                Đang vận chuyển</option>
                                            
                                    @else
                                        <option selected value="2">
                                                Đang vận chuyển</option>
                                        @endif
                                    </select>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{$order->created_at}}
                                </td>
                                <td class="text-center">
                                    {{$order->payment->payment_method}}
                                </td>
                                <td class="text-center">
                                    <a href="{{route('order.show', $order->id)}}"
                                        class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                    Chi tiết
                                    </a> /
                                    <form class="d-inline" action="{{route('order.update', $order->id)}}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                            type="submit" data-toggle="tooltip"
                                            data-placement="bottom"
                                            onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                        Hủy
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
@endsection
