<?php

namespace App\Http\Controllers\Client;

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

    public function vnpay(Request $request)
    {
        $code_cart = rand(0, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/history-purchase";
        $vnp_TmnCode = "OC2S0E1Q";//Mã website tại VNPAY 
        $vnp_HashSecret = "DLZNRBNOBBWSNJSEGVNJEMICEDHYZQEM"; //Chuỗi bí mật

        $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toan don hang test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total * 100000; //*100 
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version


        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                
                  //them don hang
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'status' => '0',
            'payment_id' => '2',
        ]);

         //them chi tiet don hang
        $cartitems = \Cart::getContent();
        //dd($cartitems);
        foreach($cartitems as $items){
            $orderItem = OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $items->attributes->id,
                'size' => $items->attributes->size,
                'qty' => $items->quantity,
                'total' => $items->quantity*$items->price,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);

            $prodSize = Product_Size::where('id', $items->attributes->size_id)->decrement('quantity', $items->quantity);

        }

        //gui email
        $total = \Cart::getTotal();
        $subtotal = \Cart::getSubTotal();
        $this->send_mail($order, $total, $subtotal);
        //xoa gio hang
        \Cart::clear();

        toastr()->success('Thành công', 'Mua hàng thành công!');
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
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
                $info = Store::first();
                $category = ProductCategory::get();
                $list_payment = Payment::get();
                $cart = \Cart::getContent();
            return view('client.checkout.checkout', compact('category','info', 'list_payment', 'cart'));
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
        if(!isset($request->payment)){
            toastr()->warning('Cảnh báo', 'Vui lòng chọn phương thức thanh toán.');
            return redirect()->back();
        }
        
        $cartitems = \Cart::getContent();
        //them don hang
        if(Auth::user()->level == '1'){
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'status' => '3',
                'sales' => \Cart::getTotal(),
                'profit' => $request->loinhuan,
                'payment_id' => $request->payment,
            ]); 
        }else{
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'status' => '0',
            'sales' => \Cart::getTotal(),
            'profit' => $request->loinhuan,
            'payment_id' => $request->payment,
        ]);
    }

         //them chi tiet don hang
       // $cartitems = \Cart::getContent();
        //dd($cartitems);
        foreach($cartitems as $items){
            $orderItem = OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $items->attributes->id,
                'size' => $items->attributes->size,
                'qty' => $items->quantity,
                'total' => $items->quantity*$items->price,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);

            $prodSize = Product_Size::where('id', $items->attributes->size_id)->decrement('quantity', $items->quantity);

        }

        //gui email
        $total = \Cart::getTotal();
        $subtotal = \Cart::getSubTotal();
        $this->send_mail($order, $total, $subtotal);
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
        $info = Store::first();
        $category = ProductCategory::get();
       $order = Order::with('orderDetail')->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('client.checkout.history_purchase', compact('order', 'info', 'category')); 
    }

    public function history_detail($id)
    {
        $info = Store::first();
        $category = ProductCategory::get();
        $order = Order::with('payment', 'user')->find($id);
        $orderdetail = OrderDetail::with('order', 'product')->where('order_id', $id)->orderBy('created_at', 'DESC')->get();
        $total_order = OrderDetail::with('order')->where('order_id', $id)->sum('total');
        //dd($orderdetail);
        return view('client.checkout.history_detail', compact('orderdetail', 'order', 'total_order', 'info', 'category')); 
    }

    public function client_huy(Request $request, $id)
    {
        $data = $request->all();
        $order =  Order::find($id);
        $order->status = '4';
        $order->save();
        toastr()->success('Thành công', 'Hủy đơn hàng thành công.');
        return redirect()->back();
    }

    public function client_nhan_hang(Request $request, $id)
    {
        $data = $request->all();
        $order =  Order::find($id);
        $order->status = '3';
        $order->save();
        toastr()->success('Thành công', 'Xác nhận đơn hàng thành công.');
        return redirect()->back();
    }

    public function danh_gia($id)
    {
        $info = Store::first();
        $category = ProductCategory::get();
        $orderdetail = OrderDetail::with('product')->find($id);
        return view('client.checkout.rating', compact( 'info', 'category', 'orderdetail'));
    }

    public function add_rating(Request $request, $id)
    {

        $status_orderdt =  OrderDetail::find($id);
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
        $rating->created_at = Carbon::now('Asia/Ho_Chi_Minh');
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
            $message->subject('Thong bao dat hang thanh cong');
        });
    }
}
