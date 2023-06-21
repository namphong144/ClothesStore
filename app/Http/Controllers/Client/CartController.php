<?php

namespace App\Http\Controllers\Client;

use App\Models\Brand;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    public function check_coupon(Request $request){
        $data = $request->all();

    }

    public function list_cart()
    {
        
        if(\Cart::getContent()->isEmpty())
        {
            toastr()->warning('Cảnh báo', 'Không có sản phẩm nào trong giỏ hàng của bạn!');
           return redirect()->back(); 
        }
        else{
            $category = ProductCategory::get();
            $cart = \Cart::getContent();
          //dd($cart);
            return view('client.cart.show', compact('category', 'cart'));
        }
    }

    public function add_cart(Request $request)
    {
        $product_id = $request->product_id_hidden;
        $product =  Product::with('productImage')->find($product_id);
        if($request->qty == 0){
            toastr()->error('Lỗi', 'Số lượng sản phẩm không hợp lệ!');
            return redirect()->back(); 
        }
        else{
        \Cart::add(array(
            'id' => $product_id,
            'name' => $product->name,
            'quantity' => $request->qty,
            'price' => $product->price,
            'attributes' => array(
                'image' => $product->productImage[0]->path,
                'slug' => $product->slug,
            ),
        ));
        toastr()->success('Thành công', 'Thêm vào giỏ hàng thành công.');
        return redirect()->route('list-cart');
    }
    }

    public function update_cart(Request $request)
    {
        if($request->quantity == 0){
            toastr()->error('Lỗi', 'Số lượng sản phẩm không hợp lệ!');
            return redirect()->back(); 
        }
         else{
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        toastr()->success('Thành công', 'Cập nhật vào giỏ hàng thành công.');

        return redirect()->route('list-cart');
    }
    }

    public function delete_cart(Request $request)
    {
        if(\Cart::getContent()->count() == 1)
        {
            \Cart::remove($request->id);
            toastr()->success('Thành công', 'Xóa sản phẩm khỏi giỏ hàng thành công.');
           return redirect()->route('homepage');
        }
        else{
        \Cart::remove($request->id);
        toastr()->success('Thành công', 'Xóa sản phẩm khỏi giỏ hàng thành công.');

        return redirect()->back(); 
        }
    }

    public function clear_all_cart()
    {
        \Cart::clear();
        toastr()->success('Thành công', 'Xóa toàn bộ giỏ hàng thành công.');

        return redirect()->route('homepage');
    }
}