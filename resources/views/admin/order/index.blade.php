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
            <div class="main-card mb-3 card">
                {{-- <form autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <p>Tu ngay: <input type="text" id="datepicker" class="form-control"></p>
                            <input type="button" id="btn-filter" class="btn btn-primary btn-sm" value="Loc ket qua">
                        </div>
                        <div class="col-md-2">
                            <p>Den ngay: <input type="text" id="datepicker2" class="form-control"></p>
                        </div>
                    </div>
                </form> --}}
                <div class="card-header"> 
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Tất cả ({{$countlist}})</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" 
                          type="button" role="tab" aria-controls="profile" aria-selected="false">Chờ xác nhận ({{$counchoxn}})</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Đã xác nhận ({{$countdaxn}})</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="size-tab" data-bs-toggle="tab" data-bs-target="#size" type="button" role="tab" aria-controls="size" aria-selected="false">Đang vận chuyển ({{$countdangvc}})</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ht-tab" data-bs-toggle="tab" data-bs-target="#ht" type="button" role="tab" aria-controls="ht" aria-selected="false">Đã hoàn thành ({{$countdaht}})</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="huy-tab" data-bs-toggle="tab" data-bs-target="#huy" type="button" role="tab" aria-controls="huy" aria-selected="false">Đã hủy ({{$countdahuy}})</button>
                          </li>
                      </ul>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img style="height: 60px;"
                                                                data-toggle="tooltip" title="Image"
                                                                data-placement="bottom"
                                                                src="assets/images/_default-product.jpg" alt="">
                                                        </div>
                                                    </div>
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
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="table-responsive">
                            <table  id="myTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr class="table-primary">
                                        <th class="text-center">ID</th>
                                        <th>Khách hàng</th>
                                        <th class="text-center">Địa chỉ</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ngày đặt hàng</th>
                                        <th class="text-center">Hình thức thanh toán</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($choxn as $key=>$order)
                                    <tr>
                                        <td class="text-center text-muted">{{$order->id}}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img style="height: 60px;"
                                                                data-toggle="tooltip" title="Image"
                                                                data-placement="bottom"
                                                                src="assets/images/_default-product.jpg" alt="">
                                                        </div>
                                                    </div>
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
                                                <option value="0"> 
                                                Chờ xác nhận</option>
                                                <option selected value="1">
                                                    Đã xác nhận</option>
                                                <option value="2">
                                                        Đang vận chuyển</option>
                                                    
                                            @else
                                                <option value="0"> 
                                                Chờ xác nhận</option>
                                                <option value="1">
                                                    Đã xác nhận</option>
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
                                            {{$order->payment->name}}
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
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="table-responsive">
                            <table  id="myTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr class="table-primary">
                                        <th class="text-center">ID</th>
                                        <th>Khách hàng</th>
                                        <th class="text-center">Địa chỉ</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ngày đặt hàng</th>
                                        <th class="text-center">Hình thức thanh toán</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daxn as $key=>$order)
                                    <tr>
                                        <td class="text-center text-muted">{{$order->id}}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img style="height: 60px;"
                                                                data-toggle="tooltip" title="Image"
                                                                data-placement="bottom"
                                                                src="assets/images/_default-product.jpg" alt="">
                                                        </div>
                                                    </div>
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
                                                <option value="0"> 
                                                Chờ xác nhận</option>
                                                <option selected value="1">
                                                    Đã xác nhận</option>
                                                <option value="2">
                                                        Đang vận chuyển</option>
                                                    
                                            @else
                                                <option value="0"> 
                                                Chờ xác nhận</option>
                                                <option value="1">
                                                    Đã xác nhận</option>
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
                                            {{$order->payment->name}}
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
                    <div class="tab-pane fade" id="size" role="tabpanel" aria-labelledby="size-tab">
                        <div class="table-responsive">
                            <table  id="myTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr class="table-primary">
                                        <th class="text-center">ID</th>
                                        <th>Khách hàng</th>
                                        <th class="text-center">Địa chỉ</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ngày đặt hàng</th>
                                        <th class="text-center">Hình thức thanh toán</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dangvc as $key=>$order)
                                    <tr>
                                        <td class="text-center text-muted">{{$order->id}}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img style="height: 60px;"
                                                                data-toggle="tooltip" title="Image"
                                                                data-placement="bottom"
                                                                src="assets/images/_default-product.jpg" alt="">
                                                        </div>
                                                    </div>
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
                                                <option value="0"> 
                                                Chờ xác nhận</option>
                                                <option selected value="1">
                                                    Đã xác nhận</option>
                                                <option value="2">
                                                        Đang vận chuyển</option>
                                                    
                                            @else
                                                <option value="0"> 
                                                Chờ xác nhận</option>
                                                <option value="1">
                                                    Đã xác nhận</option>
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
                                            {{$order->payment->name}}
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
                    <div class="tab-pane fade" id="ht" role="tabpanel" aria-labelledby="ht-tab">
                        <div class="table-responsive">
                            <table  id="myTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr class="table-primary">
                                        <th class="text-center">ID</th>
                                        <th>Khách hàng</th>
                                        <th class="text-center">Địa chỉ</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ngày đặt hàng</th>
                                        <th class="text-center">Hình thức thanh toán</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daht as $key=>$order)
                                    <tr>
                                        <td class="text-center text-muted">{{$order->id}}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img style="height: 60px;"
                                                                data-toggle="tooltip" title="Image"
                                                                data-placement="bottom"
                                                                src="assets/images/_default-product.jpg" alt="">
                                                        </div>
                                                    </div>
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
                                                <option value="0"> 
                                                Chờ xác nhận</option>
                                                <option selected value="1">
                                                    Đã xác nhận</option>
                                                <option value="2">
                                                        Đang vận chuyển</option>
                                                    
                                            @else
                                                <option value="0"> 
                                                Chờ xác nhận</option>
                                                <option value="1">
                                                    Đã xác nhận</option>
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
                                            {{$order->payment->name}}
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
                    <div class="tab-pane fade" id="huy" role="tabpanel" aria-labelledby="huy-tab">
                        <div class="table-responsive">
                            <table  id="myTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr class="table-primary">
                                        <th class="text-center">ID</th>
                                        <th>Khách hàng</th>
                                        <th class="text-center">Địa chỉ</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ngày đặt hàng</th>
                                        <th class="text-center">Hình thức thanh toán</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dahuy as $key=>$order)
                                    <tr>
                                        <td class="text-center text-muted">{{$order->id}}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img style="height: 60px;"
                                                                data-toggle="tooltip" title="Image"
                                                                data-placement="bottom"
                                                                src="assets/images/_default-product.jpg" alt="">
                                                        </div>
                                                    </div>
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
                                                <option value="0"> 
                                                Chờ xác nhận</option>
                                                <option selected value="1">
                                                    Đã xác nhận</option>
                                                <option value="2">
                                                        Đang vận chuyển</option>
                                                    
                                            @else
                                                <option value="0"> 
                                                Chờ xác nhận</option>
                                                <option value="1">
                                                    Đã xác nhận</option>
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
                                            {{$order->payment->name}}
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
    </div>
</div>
@endsection
