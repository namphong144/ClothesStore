<?php

namespace App\Http\Controllers\Admin;

use File;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Statistic;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
{
    $product = Product::count();
    $order = Order::count();
    $blog = Blog::count();
    $user = User::where('level', 0)->count();
    $order_dahuy = Order::where('order_status', 4)->count();
    $order_ht = $order - $order_dahuy;
    $ordernew = Order::with('orderDetail', 'user', 'payment')->where('order_status', 0)->orderBy('id','DESC')->paginate(10);

    $product_view = Product::orderBy('view','DESC')->take(10)->get();
    $blog_view = Blog::orderBy('view','DESC')->take(10)->get();

    $revenue_today = Statistic::whereDate('order_date',date('Y-m-d'))->first();
    if(isset($revenue_today)){
        return view('admin.dashboard', compact('product', 'order_ht', 'blog', 'user', 'ordernew', 'revenue_today', 'product_view', 'blog_view'));
    }
    
    return view('admin.dashboardnosales', compact('product', 'order_ht', 'blog', 'user', 'ordernew', 'product_view', 'blog_view'));
}

    public function month_order(Request $request)
    {
        $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(60)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $get = Statistic::whereBetween('order_date', [$sub60days, $now])->orderBy('order_date', 'ASC')->get();
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function filter_by_date(Request $request)
    {
        $data = $request->all();

        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();

        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request)
    {
        $data = $request->all();

        // $today = Carbon::now()->->format('Y-m-d');
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7ngay'){
            $get = Statistic::whereBetween('order_date', [$sub7days, $now])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value'] == 'thangtruoc'){
            $get = Statistic::whereBetween('order_date', [$dauthangtruoc, $cuoithangtruoc])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value'] == 'thangnay'){
            $get = Statistic::whereBetween('order_date', [$dauthangnay, $now])->orderBy('order_date', 'ASC')->get();
        }else{
            $get = Statistic::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'ASC')->get();
        }

        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
            );
        }

        echo $data = json_encode($chart_data);
    }

}