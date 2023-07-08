<?php

namespace App\Http\Controllers\Client;

use session;
use Carbon\Carbon;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Statistic;
use Darryldecode\Cart\Cart;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\ProductComment;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    //
//     Thông tin thẻ test VNPAY
//     Ngân hàng: NCB
// Số thẻ: 9704198526191432198
// Tên chủ thẻ:NGUYEN VAN A
// Ngày phát hành:07/15
// Mật khẩu OTP:123456
    public function vnpay(Request $request)
    {
        $code_cart = rand(0, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/history-purchase";
        $vnp_TmnCode = "CGXZLS0Z";//Mã website tại VNPAY
        $vnp_HashSecret = "XNBCJFAKAZQSGTARRLGCHVZWCIOIGSHN"; //Chuỗi bí mật

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
            $checkout_code = substr(md5(microtime()),rand(0,26),5);

            $order = Order::create([
                'customer_id' => auth()->user()->id,
                'order_status' => '0',
                'order_code' => $checkout_code,
                'sales' => \Cart::getTotal(),
                'profit' => $request->loinhuan,
                'order_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
                'payment_id' => '2',
            ]);

            //them chi tiet don hang
            $cartitems = \Cart::getContent();
            //dd($cartitems);
            foreach($cartitems as $items){
                $orderItem = OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $items->attributes->id,
                    'size' => $items->attributes->size,
                    'sell_quantity' => $items->quantity,
                    'sell_total' => $items->quantity*$items->price,
                ]);

                //decrement quantity after purchase
                $prodSize = ProductDetail::where('id', $items->attributes->size_id)->decrement('quantity', $items->quantity);
            }
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
                $category = ProductCategory::get();
                //$list_payment = Payment::get();
                $payment = Payment::pluck('payment_method','id');
                $cart = \Cart::getContent();
                return view('client.checkout.checkout', compact('category', 'payment', 'cart'));
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
                'sales' => \Cart::getTotal(),
                'profit' => $request->loinhuan,
                'order_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
                'payment_id' => '1',
            ]);

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

        }else{
            $order = Order::create([
                'customer_id' => auth()->user()->id,
                'order_status' => '0',
                'order_code' => $checkout_code,
                'sales' => \Cart::getTotal(),
                'profit' => $request->loinhuan,
                'payment_id' => '1',
            ]);
        }

        //them chi tiet don hang
        // $cartitems = \Cart::getContent();
        //dd($cartitems);
        foreach($cartitems as $items){
            $orderItem = OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $items->attributes->id,
                'product_detail_id' => $items->attributes->product_detail_id,
                'size' => $items->attributes->size,
                'sell_quantity' => $items->quantity,
                'sell_total' => $items->quantity*$items->price,
            ]);

            //decrement quantity after purchase
            $prodSize = ProductDetail::where('id', $items->attributes->size_id)->decrement('quantity', $items->quantity);

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

        $order_detail = OrderDetails::with('order', 'product')->where('order_id', $id)->get();
        foreach($order_detail as $items){
            $sell_quantity = $items->sell_quantity;

            //cong so luong sp da huy vao kho
            $qty = ProductDetail::where('id', $items->product_detail_id)->increment('quantity', $sell_quantity);
        };

        toastr()->success('Thành công', 'Hủy đơn hàng thành công.');
        return redirect()->back();
    }

    public function client_nhan_hang(Request $request, $id)
    {
        $data = $request->all();
        $order =  Order::find($id);
        $order->order_status = '3';
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
