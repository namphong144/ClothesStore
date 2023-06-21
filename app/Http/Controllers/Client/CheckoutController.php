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
use Darryldecode\Cart\Cart;
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
             //xoa gio hang
            \Cart::clear();

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
   public function checkout()
   {
       if(Auth::check()){
           if(\Cart::getContent()->isEmpty())
           {
               toastr()->warning('Cảnh báo', 'Không thể thanh toán! Hãy thêm sản phẩm bạn muốn mua vào giỏ hàng.');
              return redirect()->back(); 
           }
           else{
               $category = ProductCategory::get();
               $list_payment = Payment::get();
               $cart = \Cart::getContent();
           return view('client.checkout.checkout', compact('category', 'list_payment', 'cart'));
           }
       }
      else{
       if(\Cart::getContent()->isEmpty())
       {
           toastr()->warning('Cảnh báo', 'Không thể thanh toán! Hãy thêm sản phẩm bạn muốn mua vào giỏ hàng.');
          return redirect()->back(); 
       }
       else{
       toastr()->error('Lỗi', 'Vui lòng đăng nhập để thanh toán!');
       return redirect()->route('login'); 
       }
      }
   }

   public function checkout_process(Request $request)
   {
       
       $cartitems = \Cart::getContent();

       $checkout_code = substr(md5(microtime()),rand(0,26),5);
       
       //them don hang
       if(Auth::user()->level == '1'){
           $order = Order::create([
               'customer_id' => auth()->user()->id,
               'order_status' => '3',
               'order_code' => $checkout_code,
               'payment_id' => $request->payment,
           ]); 
       }else{
       $order = Order::create([
            'customer_id' => auth()->user()->id,
            'order_status' => '0',
            'order_code' => $checkout_code,
            'payment_id' => $request->payment,
       ]);
   }

        //them chi tiet don hang
      // $cartitems = \Cart::getContent();
       //dd($cartitems);
       foreach($cartitems as $items){
           $orderItem = OrderDetails::create([
               'order_id' => $order->id,
               'product_id' => $items->id,
               'sell_quantity' => $items->quantity,
               'sell_total' => $items->quantity*$items->price,
           ]);

           //decrement quantity after purchase
           $qty = Product::where('id', $items->id)->decrement('quantity', $items->quantity);

       }

       //gui email
    //    $total = \Cart::getTotal();
    //    $subtotal = \Cart::getSubTotal();
    //    $this->send_mail($order, $total, $subtotal);
       //xoa gio hang
       \Cart::clear();
       toastr()->success('Thành công', 'Mua hàng thành công!');
       return redirect()->route('history-purchase');
   }

   public function history_purchase()
   {
       if(!Auth::check()){
           toastr()->success('Cảnh báo', 'Vui lòng đăng nhập để xem!');
           return redirect()->route('login');
       }
        $category = ProductCategory::get();
        $order = Order::with('orderDetail', 'payment')->where('customer_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
       return view('client.checkout.history_purchase', compact('order', 'category')); 
   }

   public function history_detail($id)
   {
       $category = ProductCategory::get();
       $order = Order::with('payment', 'user')->find($id);
       $orderdetail = OrderDetails::with('order', 'product')->where('order_id', $id)->orderBy('created_at', 'DESC')->get();
       $total_order = OrderDetails::with('order')->where('order_id', $id)->sum('sell_total');
       //dd($orderdetail);
       return view('client.checkout.history_detail', compact('orderdetail', 'order', 'total_order', 'category')); 
   }

   public function client_huy(Request $request, $id)
   {
       $data = $request->all();
       $order =  Order::find($id);
       $order->order_status = '4';
       $order->save();

       //increment quantity after cancel
       //$qty = Product::where('id', $items->id)->increment('quantity', $items->quantity);
       toastr()->success('Thành công', 'Hủy đơn hàng thành công.');
       return redirect()->back();
   }

   public function client_nhan_hang(Request $request, $id)
   {
       $data = $request->all();
       $order =  Order::find($id);
       $order->order_status = '3';
       $order->save();
       toastr()->success('Thành công', 'Xác nhận đơn hàng thành công.');
       return redirect()->back();
   }

   public function danh_gia($id)
   {
       $category = ProductCategory::get();
       $orderdetail = OrderDetails::with('product')->find($id);
       return view('client.checkout.rating', compact('category', 'orderdetail'));
   }

   public function add_rating(Request $request, $id)
   {

       $status_orderdt =  OrderDetails::find($id);
       $status_orderdt->comment = '1';
       $status_orderdt->save();

       $data = $request->validate(
           [
               'product_id'=> 'required',
               'rating' => 'required',
               'massage' => 'required|max:500',
           ],
           [
               'rating.required' => 'Vui lòng đánh giá sao cho sản phẩm.',
               'massage.max' => 'Bình luận chỉ dài tối đa 500 kí tự.',
               'massage.required' => 'Bình luận buộc phải nhập.',
           ]
       );
       $rating = new ProductComment();
       $rating->product_id = $data['product_id'];
       $rating->user_id = auth()->user()->id;
       $rating->rating = $data['rating'];
       $rating->messages = $data['massage'];
       $rating->save();
       toastr()->success('Thành công', 'Đánh giá sản phẩm thành công.');
       return redirect()->route('history-purchase');
   }

   private function send_mail($order, $total, $subtotal)
   {
       $email_to = auth()->user()->email;
       $address = auth()->user()->address;
       $phone = auth()->user()->phone;
       $cartitems = \Cart::getContent();
       $order = $order->created_at;

       Mail::send('client.checkout.email', compact('order','email_to', 'total', 'subtotal', 'cartitems', 'phone', 'address'), 
       function($message) use ($email_to){
           $message->from('huyenha200204@gmail.com', 'CodeLean Shop');
           $message->to($email_to);
           $message->subject('Thông báo đặt hàng thành công!');
       });
   }
}