<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function orderstatus_choose(Request $request)
     {
         $data = $request->all();
         $order = Order::find($data['order_id']);
         $order->order_status = $data['orderst_val'];
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
            $list = Order::with('orderDetail', 'user', 'payment')->where('order_status', $request->status)->orderBy('id','ASC')->get();
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