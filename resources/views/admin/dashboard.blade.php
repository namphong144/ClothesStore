@extends('layouts.layout_admin')

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
					<h3>23</h3>
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
						<h3>12</h3>
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
						<h3>23000<sup>đ</sup></h3>
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
						<h3>21000<sup>đ</sup></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
    <section>
<section>
  <div class="panel panel-defalt">
    <div class="panel-heading"><h2>Đơn hàng mới</h2></div>
  </div>
  {{-- <div class="table-responsive">
    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
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
            @foreach ($ordernew as $key=>$order)
            <tr>
                <td class="text-center text-muted">{{$order->id}}</td>
                <td>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
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
                    @if ($order->status == 4)
                    <div class="badge badge-dark mt-2">Đã hủy</div>
                    @elseif ($order->status == 3)
                    <div class="badge badge-success mt-2">Đã hoàn thành</div>
                    @else
                    <select name="" id="{{$order->id}}" class="orderst_choose">
                        @if ($order->status == 0)
                        <option selected value="0"> 
                        Chờ xác nhận</option>
                        <option value="1">
                            Đã xác nhận</option>
                        <option value="2">
                                Đang vận chuyển</option>
                        
                    @elseif ($order->status == 1)
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
</div> --}}
@endsection
