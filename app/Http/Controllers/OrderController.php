<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function filter_by_date($list, Request $request)
     {
         $data = $request->all();
         $form_date = $request->datepicker;
         $form_date_moi = date("Y-m-d", strtotime($form_date));  
         $to_date = $request->datepicker2;
         $to_date_moi = date("Y-m-d", strtotime($to_date));  
        // dd($form_date_moi);
         $list = ($form_date != null || $to_date != null) ? $list->whereBetween('created_at',[$form_date_moi, $to_date_moi]) : $list;
         return $list; $form_date; $to_date;
     } 
     public function orderstatus_choose(Request $request)
     {
         $data = $request->all();
         $order = Order::find($data['order_id']);
         $order->status = $data['orderst_val'];
         $order->save();
     } 

    public function index(Request $request)
    {
        //
        $list = Order::with('orderDetail', 'user', 'payment');
        $list = $this->filter_by_date($list, $request);
        $list = $list->orderBy('id','DESC')->get();
        $countlist = Order::count('id');
        $choxn = Order::with('orderDetail', 'user', 'payment')->where('status', 0)->orderBy('id','DESC')->get();
        $counchoxn = Order::where('status', 0)->count('id');
        $daxn = Order::with('orderDetail', 'user', 'payment')->where('status', 1)->orderBy('id','DESC')->get();
        $countdaxn = Order::where('status', 1)->count('id');
        $dangvc = Order::with('orderDetail', 'user', 'payment')->where('status', 2)->orderBy('id','DESC')->get();
        $countdangvc = Order::where('status', 2)->count('id');
        $daht = Order::with('orderDetail', 'user', 'payment')->where('status', 3)->orderBy('id','DESC')->get();
        $countdaht = Order::where('status', 3)->count('id');
        $dahuy = Order::with('orderDetail', 'user', 'payment')->where('status', 4)->orderBy('id','DESC')->get();
        $countdahuy = Order::where('status', 4)->count('id');
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
        $order_detail = OrderDetail::with('order', 'product')->where('order_id', $id)->orderBy('created_at', 'DESC')->get();
        $total_order = OrderDetail::with('order')->where('order_id', $id)->sum('total');
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
            $order->status = '1';
            $order->save();
            toastr()->info('Thành công', 'Xác nhận đơn hàng thành công.');
            return redirect()->back();
        }
        $order->status = '4';
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
