<?php

namespace App\Http\Controllers\Client;


use App\Models\Brand;
use App\Models\Size;
use App\Models\Store;
use App\Models\Product;
use App\Models\Product_Size;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    public function hover_cart(){
        $cart = count(Session::get('cart'));
        $output = '';
        if($cart > 0){
            $output.='<div class="select-items">';
                                    foreach (Session::get('cart') as $key => $value)
                                        $output.='<table>
                                            <tbody>
                                            <tr>
                                                <td class="si-pic"><img  src="'.asset('uploads/product/'.$value['product_image']).'" alt=""></td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <p>'.number_format($value['product_price'],0,',','.').'đ x '.$value['product_qty'].'</p>
                                                        <h6>'.$value['product_name'].'</h6>
                                                    </div>
                                                </td>
                                                    <td class="si-close">
                                                        <a href="'.asset('/delete-product/'.$value['session_id']).'"><i class="ti-close"></i></a>
                                                    </td>
                                            </tr>
                                            </tbody>
                                        </table>';
            $output.='</div>';
        }else{
        $output.='<div class="select-items">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <p>Giỏ hàng trống</p>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>';
        }
        echo $output;
    }
    public function show_cart_header(){
        $cart = count(Session::get('cart'));
        echo $cart;

    }
    public function check_coupon(Request $request){
        $data = $request->all();

    }
    public function show_cart(){
        $category = ProductCategory::get();
        $brand = Brand::get();
        $product_nu = Product::with('brand', 'productImage')->where('status', 0)->where('slug', 'LIKE', '%nu%')->orderBy('updated_at', 'DESC')->paginate(10);
        $product_nam = Product::with('brand', 'productImage')->where('status', 0)->where('slug', 'LIKE', '%nam%')->orderBy('updated_at', 'DESC')->paginate(10);
        return view('client.show_cart', compact( 'category', 'brand', 'product_nu', 'product_nam'));
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();

        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_available = 0;
            foreach ($cart as $key => $val){
                if ($val['product_id']==$data['cart_product_id']){
                    $is_available++;
                }
            }
            if($is_available == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
        }
        Session::put('cart', $cart);
        Session::save();

    }
    public function delete_product($session_id){
        $cart = Session::get('cart');
        if($cart == true){
            foreach ($cart as $key => $val){
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('message', 'Xóa sản phẩm thất bại');
        }
    }
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart == true){
            foreach ($data['cart_qty'] as $key => $qty){
                foreach ($cart as $session => $val){
                    if ($val['session_id'] == $key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message', 'Cập nhật số lượng thành công');
        }else{
            return redirect()->back()->with('message', 'Cập nhật số lượng thất bại');
        }
    }
    public function delete_all_product(){
        $cart = Session::get('cart');
        if ($cart == true){
            Session::forget('cart');
            return redirect()->back()->with('message', 'Xóa hết sản phẩm thành công');
        }
    }
}
