<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Statistic;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function da_giao(Request $request, $id)
     {
        $data = $request->all();
        $order =  Order::find($id);
        $order->order_status = '5';
        $order->order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->save();

        $order_date = $order->order_date;
        $statistic = Statistic::where('order_date', $order_date)->get();
        if($statistic){
            $statistic_count = $statistic->count();
        }else{
            $statistic_count = 0;
        }

        //update db statistic
        if($statistic_count > 0){
            $statistic_update = Statistic::where('order_date', $order_date)->first();
            $statistic_update->sales = $statistic_update->sales + $order->sales*1000;
            $statistic_update->profit = $statistic_update->profit + $order->profit*1000;
            $statistic_update->total_order += 1;
            $statistic_update->save();
        }else{
            $statistic_new = new Statistic();
            $statistic_new->order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $statistic_new->sales = $order->sales*1000;
            $statistic_new->profit = $order->profit*1000;
            $statistic_new->total_order = '1';
            $statistic_new->save();
        }
        toastr()->success('Thành công', 'Xác nhận giao hàng thành công.');
        return redirect()->back();
     }

     public function orderstatus_choose(Request $request)
     {
         $data = $request->all();
         $order = Order::find($data['order_id']);
         $order->order_status = $data['orderst_val'];
        $order->admin_id = Auth::user()->id;
         $order->save();
     } 

     public function filter(Request $request)
     {
        $todayDate = Carbon::now()->format('Y-m-d');
        $date = $request->date;
        if(isset($request->date)){
            $list = Order::with('orderDetail', 'user', 'payment')->whereDate('created_at', $date)->orderBy('id','ASC')->get();
        }
        if(isset($request->status)){
            $list = Order::with('orderDetail', 'user', 'payment')->where('order_status', $request->status)->orderBy('created_at','ASC')->get();
        }
        if($request->date && $request->status){
                $list = Order::with('orderDetail', 'user', 'payment')->whereDate('created_at', $request->date)->where('order_status', $request->status)->orderBy('id','ASC')->get();
            }
        $countlist = Order::count('id');
        return view('admin.order.index', compact('list', 'countlist'));
     }
    public function index(Request $request)
    {
        //
        $list = Order::with('orderDetail', 'user', 'payment')->orderBy('order_status','ASC')->get();
        $countlist = Order::count('id');
        return view('admin.order.index', compact('list', 'countlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order = Order::with('payment', 'user')->find($id);
        $order_detail = OrderDetails::with('order', 'product')->where('order_id', $id)->orderBy('created_at', 'DESC')->get();
        $total_order = OrderDetails::with('order')->where('order_id', $id)->sum('sell_total');
        //dd($total_order);
        return view('admin.order.show', compact('order', 'order_detail', 'total_order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        $order =  Order::find($id);
        if($request->xacnhan == 1){
            $order->order_status = '1';
            $order->save();
            toastr()->info('Thành công', 'Xác nhận đơn hàng thành công.');
            return redirect()->back();
        }
        $order->order_status = '4';
        $order->save();

        $order_detail = OrderDetails::with('order', 'product')->where('order_id', $id)->get();
        foreach($order_detail as $items){
            $sell_quantity = $items->sell_quantity;

            //cong so luong sp da huy vao kho
            $qty = ProductDetail::where('id', $items->product_detail_id)->increment('quantity', $sell_quantity);
        };
        
        toastr()->info('Thành công', 'Hủy đơn hàng thành công.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}