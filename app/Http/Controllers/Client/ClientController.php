<?php

namespace App\Http\Controllers\Client;
use session;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Store;
use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductComment;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class ClientController extends Controller
{
    //
    
    public function timkiem()
    {
        if(isset($_GET['search']) && !empty($_GET['search'])){
           $search =  $_GET['search'];
          
           if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
           // dd($sort_by);
           if($sort_by == 'tangdan'){
               $product_shop = Product::where('name', 'LIKE', '%'.$search.'%')->orderBy('price', 'ASC')->paginate(9);
           }elseif($sort_by == 'giamdan'){
               $product_shop = Product::where('name', 'LIKE', '%'.$search.'%')->orderBy('price', 'DESC')->paginate(9); 
           }
       }
       else{
           $product = Product::where('name', 'LIKE', '%'.$search.'%')->orderBy('updated_at', 'DESC')->paginate(9);
       }

            $category = ProductCategory::get();
            $brand = Brand::get();
            $info = Store::first();
            $min_price = Product::min('price');
             $max_price = Product::max('price');
          
           return view('client.search', compact('search', 'product', 'category', 'brand', 'info', 'min_price', 'max_price'));
        }else{
            return redirect()->to('/');
        }
    }

    public function home()
    { 
        return view('client.home');
    }

    public function shop(Request $request)
    {
       return view('client.shop');
    }

    public function category($slug, Request $request)
    {
        $info = Store::first();
        $category = ProductCategory::get();
        $brand = Brand::get();
        $cateslug = ProductCategory::where('slug',$slug)->first();
        $min_price = Product::min('price');
        $max_price = Product::max('price');
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
           if($sort_by == 'tangdan'){
               $product = Product::with('brand')->where('status', 0)->where('product_category_id',$cateslug->id)->orderBy('price', 'ASC')->paginate(9);
           }elseif($sort_by == 'giamdan'){
               $product = Product::with('brand')->where('status', 0)->where('product_category_id',$cateslug->id)->orderBy('price', 'DESC')->paginate(9); 
           }
       }
       else{
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);

        $product = Product::with('brand')->where('status', 0)->where('product_category_id',$cateslug->id);
        if($brand_ids != null){
            $product = $product->whereIn('brand_id', $brand_ids);
        }
        $product = $product->orderBy('updated_at', 'DESC')->paginate(9);
       
       }
        return view('client.shop', compact('cateslug', 'product', 'category', 'brand', 'info', 'min_price', 'max_price'));
    }

    private function filter($product, Request $request)
    {
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);
        $product = $brand_ids != null ? $product->whereIn('brand_id', $brand_ids) : $product;
        return $product;
    }
    
    public function product($slug)
    {
        $info = Store::first();
        $category = ProductCategory::get();
        $brand = Brand::get(); 
        $product = Product::with('productCategory','brand', 'productImage', 'product_size', 'productComment')->where('status', 0)->where('slug',$slug)->first();
        $avg_rating =  ProductComment::where('product_id', $product->id)->avg('rating');
        $avg_rating = round($avg_rating);
        $related_product = Product::with('productCategory')->where('status', 0)->where('product_category_id',$product->productCategory->id)
        ->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get()->take(4);
        
        $min_price = Product::min('price');
        $max_price = Product::max('price');
        return view('client.product', compact('product', 'avg_rating', 'category', 'brand', 'related_product', 'info', 'min_price', 'max_price'));
    }

    public function blog()
    {
        return view('client.blog');
    }

    public function blog_detail($slug)
    {
        return view('client.blog_detail');
    } 

    public function contact()
    {
        return view('client.contact');
    }

    //filter product
    public function sort_asc(Request $request)
    {
        $info = Store::first();
        $category = ProductCategory::get();
        $brand = Brand::get(); 
        $product_shop = Product::with('brand')->where('status', 0)->orderBy('price', 'ASC')->paginate(9);
        return redirect()->back();
    }
}
