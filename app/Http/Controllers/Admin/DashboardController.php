<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use File;

class DashboardController extends Controller
{
    //
    public function index()
{
    $product = Product::count();
    $order = Order::count();
    $order_dahuy = Order::where('status', 4)->count();
    $order_ht = $order - $order_dahuy;
    $revenue_today = Order::where('status', 3)->whereDate('updated_at',date('Y-m-d'))
    ->select(\DB::raw('DATE(updated_at) as day'), \DB::raw('sum(sales) as saleToday'))->groupBy('day')->get();
    $profit_today = Order::where('status', 3)->whereDate('updated_at',date('Y-m-d'))
    ->select(\DB::raw('DATE(updated_at) as day'), \DB::raw('sum(profit) as profitToday'))->groupBy('day')->get();
    // $revenue_today2 = Order::with(['orderDetail' => function($q){
    //     $q->select(\DB::raw('sum(total) as saleToday'));
    //     }
    //     ])->where('status', 3)->whereDate('updated_at',date('2023-01-31'))
    // ->select(\DB::raw('DATE(updated_at) as day'))->groupBy('day')->get()->toArray();
    //dd($order_ht);
    $ordernew = Order::with('orderDetail', 'user', 'payment')->where('status', 0)->orderBy('id','DESC')->paginate(10);
    return view('admin.dashboard', compact('product', 'order_ht', 'ordernew', 'revenue_today', 'profit_today'));
}

}
