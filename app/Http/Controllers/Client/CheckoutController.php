<?php

namespace App\Http\Controllers\Client;

use App\Models\Brand;
use App\Models\OrderDetails;
use App\Models\Shipping;
use session;
use Carbon\Carbon;
use App\Models\Size;
use App\Models\Order;
use App\Models\Store;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderDetail;
use Darryldecode\Cart\Cart;
use App\Models\Product_Size;
use Illuminate\Http\Request;
use App\Models\ProductComment;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    //
    public function show_checkout(){
        $category = ProductCategory::get();
        $brand = Brand::get();
        $product_nu = Product::with('brand', 'productImage')->where('status', 0)->where('slug', 'LIKE', '%nu%')->orderBy('updated_at', 'DESC')->paginate(10);
        $product_nam = Product::with('brand', 'productImage')->where('status', 0)->where('slug', 'LIKE', '%nam%')->orderBy('updated_at', 'DESC')->paginate(10);
        return view('client.show_checkout', compact( 'category', 'brand', 'product_nu', 'product_nam'));
    }
    public function confirm_order(Request $request){
        $data = $request ->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_payment = $data['shipping_payment'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);
        $order = new Order();
        $order->customer_id = Auth::id();
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();

        \Illuminate\Support\Facades\Session::forget('cart');

//        if (\Illuminate\Support\Facades\Session::get('cart')){
//            foreach (\Illuminate\Support\Facades\Session::get('cart') as $key => $cart){
//                $order_details = new OrderDetails();
//                $order_details->order_id = $order['order_id'];
//                $order_details->order_code = $checkout_code;
//                $order_details->product_id = $cart['product_id'];
//                $order_details->product_name = $cart['product_name'];
//                $order_details->sell_price= $cart['product_price'];
//                $order_details->sell_quantity= $cart['product_qty'];
//                $order_details->save();
//            }
//        }
   }
}
