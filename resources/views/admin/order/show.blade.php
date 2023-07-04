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

    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        @if ($order->order_status != 4 && $order->order_status != 3)
        <li class="nav-item delete">
            <form action="{{route('order.update', $order->id)}}" method="post">
                @method('PUT')
                @csrf
                <button class="nav-link btn" type="submit"
                    onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                    <span class="btn-icon-wrapper pr-2 opacity-8">
                        <i class="fa fa-trash fa-w-20"></i>
                    </span>
                    <span>Hủy</span>
                </button>
            </form>
        </li>
        @endif
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body display_data">

                    <div class="table-responsive">
                        <h2 class="text-center">Danh sánh sản phẩm</h2>
                        <hr>
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Đơn giá</th>
                                    <th class="text-center">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_detail as $item)
                                <tr>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img style="height: 60px;"
                                                            data-toggle="tooltip" title="Image"
                                                            data-placement="bottom"
                                                            src="{{asset('uploads/product/'.$item->product->productImage[0]->path)}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{$item->product->name}}
                                                        <br> <i>Size: {{$item->size}}</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{$item->sell_quantity}}
                                    </td>
                                    <td class="text-center"> 
                                        {{number_format($item->product->price).',000'}} <sup>đ</sup>
                                    </td>
                                    <td class="text-center">
                                        {{$item->sell_total}}.000 <sup>đ</sup>
                                    </td>
                                </tr>  
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>TỔNG TIỀN:</b></td>
                                    <td>  <div class="badge badge-success mt-2">{{$total_order}}.000 <sup>đ</sup></div></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>



                    <h2 class="text-center mt-5">Thông tin đơn hàng</h2>
                        <hr>
                    <div class="position-relative row form-group">
                        <label for="name" class="col-md-3 text-md-right col-form-label">
                          Tên người nhận
                        </label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$order->user->name}}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$order->user->email}}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="phone" class="col-md-3 text-md-right col-form-label">Điện thoại</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$order->user->phone}}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="street_address" class="col-md-3 text-md-right col-form-label">
                           Địa chỉ</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$order->user->address}}</p>
                        </div>
                    </div>


                    <div class="position-relative row form-group">
                        <label for="payment_type" class="col-md-3 text-md-right col-form-label">Phương thức thanh toán</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$order->payment->payment_method}}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="order_status" class="col-md-3 text-md-right col-form-label">Trạng thái</label>
                        <div class="col-md-9 col-xl-8">
                            <div class="badge badge-dark mt-2">
                             @if($order->order_status == 0)
                                Chờ xác nhận
                            @elseif($order->order_status == 1)
                               Đã xác nhận
                            @elseif($order->order_status == 2)
                               Đang vận chuyển
                             @elseif($order->order_status == 3)
                             Hoàn thành
                            @else
                                Hủy
                             @endif
                            </div>
                        </div>
                    </div>

                    @if ($order->order_status == 0)
                    <div class="justify-content-end">
                        <form action="{{route('order.update', $order->id)}}" method="post">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="xacnhan" value="1">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary" type="submit">
                               Xác nhận đơn hàng
                            </button>
                        </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection