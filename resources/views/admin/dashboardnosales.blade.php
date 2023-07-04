@extends('layouts.layout_admin')
@section('title', 'Dashboard')

<style>
h4, h5, h6,
h1, h2, h3 {margin: 0;}
ul, ol {margin: 0;}
p {margin: 0;}

html, body{
	font-family: 'Roboto', sans-serif;
    font-size: 100%;
    overflow-x: hidden;
    background: url(../images/bg.jpg) no-repeat 0px 0px;
	background-size:cover;
}
body a{
	transition: 0.5s all ease;
	-webkit-transition: 0.5s all ease;
	-moz-transition: 0.5s all ease;
	-o-transition: 0.5s all ease;
	-ms-transition: 0.5s all ease;
	text-decoration:none;
}
h1,h2,h3,h4,h5,h6{
	margin:0;			   
}
p{
	margin:0;
}
ul,label{
	margin:0;
	padding:0;
}
body a:hover{
	text-decoration:none;
}
.wrapper {
    display:inline-block;
    margin-top:10px;
    padding:15px;
    width:100%;
}
/*--market--*/
.market-updates{
    display: flex;
    margin: 1.5em 0;
}
.market-update-block {
    padding: 2em 2em;
    background: #999;
    height: 180px;
}
.market-update-block h3 {
    color: #fff;
    font-size: 2em;
}
.market-update-block h4 {
	font-size: 1.2em;
    color: #fff;
    margin: 0.3em 0em;
}
.market-update-block p {
    color: #fff;
    font-size: 0.8em;
    line-height: 1.8em;
}
.market-update-block.clr-block-1 {
    background: #53d769;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    transition: 0.5s all;
  -webkit-transition: 0.5s all;
  -moz-transition: 0.5s all;
  -o-transition: 0.5s all;
}
.market-update-block.clr-block-2 {
    background:#fc3158;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    transition: 0.5s all;
  -webkit-transition: 0.5s all;
  -moz-transition: 0.5s all;
  -o-transition: 0.5s all;
}
.market-update-block.clr-block-3 {
    background:#147efb;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    transition: 0.5s all;
  -webkit-transition: 0.5s all;
  -moz-transition: 0.5s all;
  -o-transition: 0.5s all;
}
.market-update-block.clr-block-4 {
    background:#2a2727;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    transition: 0.5s all;
  -webkit-transition: 0.5s all;
  -moz-transition: 0.5s all;
  -o-transition: 0.5s all;
}
.market-update-block.clr-block-1:hover {
    background: #8b5c7e;
   transition: 0.5s all;
  -webkit-transition: 0.5s all;
  -moz-transition: 0.5s all;
  -o-transition: 0.5s all;
}
.market-update-block.clr-block-2:hover {
    background: #8b5c7e;
   transition: 0.5s all;
  -webkit-transition: 0.5s all;
  -moz-transition: 0.5s all;
  -o-transition: 0.5s all;
}
.market-update-block.clr-block-3:hover {
    background:#8b5c7e;
    transition: 0.5s all;
  -webkit-transition: 0.5s all;
  -moz-transition: 0.5s all;
  -o-transition: 0.5s all;
}
.market-update-block.clr-block-4:hover {
    background:#8b5c7e;
    transition: 0.5s all;
  -webkit-transition: 0.5s all;
  -moz-transition: 0.5s all;
  -o-transition: 0.5s all;
}
.market-update-right i.fa.fa-users {
    font-size: 3em;
    color:#fff;
   text-align: left;
}
.market-update-right i.fa.fa-eye {
     font-size: 3em;
    color:#fff;
   text-align: left;
}
.market-update-right i.fa.fa-usd {
     font-size:3em;
    color:#fff;
    text-align: left;
}
.market-update-right i.fa.fa-shopping-cart{
     font-size:3em;
    color:#fff;
    text-align: left;
}
.market-update-left {
    padding: 0px;
}
.market-update-right {
    padding-left: 0;
}
.market-update-gd {
    float: left;
    width: 50%;
    margin: 1em 0;
}

.title_thongke{
    text-align: center;
    font-size: 30px;
    font-weight: bold;
}
/*--market--*/
</style>
@section('main')
<section id="main-content">
	<section class="wrapper">
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					 <div class="col-md-8 market-update-left">
                      <h4>Đơn hàng</h4> 
                      <h3>{{$order_ht}}</h3>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
                        <i class="fas fa-tshirt"style='font-size:48px;color:rgb(255, 255, 255)'></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Sản phẩm</h4>
					<h3>{{$product}}</h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
                        <i class='fas fa-coins' style='font-size:48px;color:rgb(255, 255, 255)'></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Doanh thu hôm nay</h4>
                        <h3>{{number_format(0)}}<sup>đ</sup></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
                        <i class="fa fa-eye"> </i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Lợi nhuận hôm nay</h4>
                        <h3>{{number_format(0)}}<sup>đ</sup></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
    <section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <p class="title_thongke">Thống kê doanh số</p>
                 <form autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                        </div>
                        <div class="col-md-2">
                            <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                        </div>

                        <div class="col-md-2">
                            <p>
                                Lọc theo:
                                <select class="dashboard-filter form-control" name="" id="">
                                    <option>---Chọn---</option>
                                    <option value="7ngay">7 ngày qua</option>
                                    <option value="thangtruoc">Tháng trước</option>
                                    <option value="thangnay">Tháng này</option>
                                    <option value="365ngayqua">365 ngày qua</option>
                                </select>
                            </p>
                        </div>
                    </div>
                </form>

                <div class="col-md-12">
                    <div id="myfirstchart" style="height: 250px;"></div>
                </div>
            </div>
            <div class="row" style="margin: 30px 0px 30px 0px">
                <div class="col-md-4 col-xs-12">
                    <p class="title_thongke" style=" font-size: 20px;">Thống kê tổng sản phẩm bài viết đơn hàng</p>
                    <div id="donut"></div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <p class="title_thongke" style=" font-size: 20px;">Bài viết xem nhiều</p>
                    <ul class="list_view">
                        <li><a target="_blank" href=""></a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-xs-12">
                    <p class="title_thongke" style=" font-size: 20px;">Sản phẩm xem nhiều</p>
                    <ul class="list_view">
                        <li><a target="_blank" href=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

<section style="margin-top: 40px">
    <div class="panel panel-defalt">
        <div class="panel-heading"><h2>Đơn hàng mới</h2></div>
    </div>
    <div class="table-responsive">
        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
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
                @foreach ($ordernew as $key=>$order)
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
</section>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
                var colorDanger = "#FF1744";
        Morris.Donut({
        element: 'donut',
        resize: true,
        colors: [
            '#d94155',
            '#B2EBF2',
            '#30f083',
            '#e4f065',
        ],

        data: [
            {label:"Sản phẩm", value:<?php echo $product ?>, color:colorDanger},
            {label:"Bài viết", value:<?php echo $blog ?>},
            {label:"Đơn hàng", value:<?php echo $order_ht ?>},
            {label:"Khách hàng", value:<?php echo $user ?>}
        ]
        });

    });
</script>
@endsection
