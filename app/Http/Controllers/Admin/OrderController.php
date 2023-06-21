<?php

namespace App\Http\Controllers\Admin;

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

    public function index()
    {
        //
        $list = Order::with('orderDetail', 'user', 'payment')->orderBy('order_status','ASC')->get();
        $countlist = Order::count('id');
        $choxn = Order::with('orderDetail', 'user', 'payment')->where('order_status', 0)->orderBy('id','DESC')->get();
        $counchoxn = Order::where('order_status', 0)->count('id');
        $daxn = Order::with('orderDetail', 'user', 'payment')->where('order_status', 1)->orderBy('id','DESC')->get();
        $countdaxn = Order::where('order_status', 1)->count('id');
        $dangvc = Order::with('orderDetail', 'user', 'payment')->where('order_status', 2)->orderBy('id','DESC')->get();
        $countdangvc = Order::where('order_status', 2)->count('id');
        $daht = Order::with('orderDetail', 'user', 'payment')->where('order_status', 3)->orderBy('id','DESC')->get();
        $countdaht = Order::where('order_status', 3)->count('id');
        $dahuy = Order::with('orderDetail', 'user', 'payment')->where('order_status', 4)->orderBy('id','DESC')->get();
        $countdahuy = Order::where('order_status', 4)->count('id');
        return view('admin.order.index', compact('list', 'choxn', 'daxn', 'dangvc', 'daht', 'dahuy', 'countlist', 'counchoxn',
    'countdaxn', 'countdangvc', 'countdaht', 'countdahuy'));
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