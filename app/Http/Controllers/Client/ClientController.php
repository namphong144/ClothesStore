<?php

namespace App\Http\Controllers\Client;
use session;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
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
        
    }

    public function home()
    { 
        $category = ProductCategory::get();
        $product_nu = Product::with('brand', 'productImage')->where('status', 0)->where('slug', 'LIKE', '%nu%')->orderBy('updated_at', 'DESC')->paginate(10);
        $product_nam = Product::with('brand', 'productImage')->where('status', 0)->where('slug', 'LIKE', '%nam%')->orderBy('updated_at', 'DESC')->paginate(10);
      
        return view('client.home', compact('category', 'product_nu', 'product_nam'));
    }

    public function shop(Request $request)
    {
        $category = ProductCategory::get();
        $brand = Brand::get(); 
        $min_price = Product::min('price');
        $max_price = Product::max('price');
        if(isset($_GET['sort_by'])){
             $sort_by = $_GET['sort_by'];
            // dd($sort_by);
            if($sort_by == 'tangdan'){
                $product = Product::with('brand', 'productImage')->where('status', 0)->orderBy('price', 'ASC')->paginate(9);
            }elseif($sort_by == 'giamdan'){
                $product = Product::with('brand', 'productImage')->where('status', 0)->orderBy('price', 'DESC')->paginate(9); 
            }
        }
        else{
            //brand
            $brands = $request->brand ?? [];
            $brand_ids = array_keys($brands);
            //price

    $product = Product::with('brand', 'productImage')->where('status', 0);
    if($brand_ids != null){
        $product = $product->whereIn('brand_id', $brand_ids);
    }if(isset($_GET['start_price']) && $_GET['end_price']){
        $priceMin = $_GET['start_price'];
        $priceMax =  $_GET['end_price'];
        $product = $product->whereBetween('price',[$priceMin, $priceMax]);
    }
    
    $product = $product->orderBy('updated_at', 'DESC')->paginate(9);
        }
       return view('client.shop', compact('product', 'category', 'brand', 'min_price', 'max_price'));
    }

    public function category($slug, Request $request)
    {
        $category = ProductCategory::get();
        $brand = Brand::get();
        $cateslug = ProductCategory::where('slug',$slug)->first();
        $min_price = Product::min('price');
        $max_price = Product::max('price');
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
           if($sort_by == 'tangdan'){
               $product = Product::with('brand', 'productImage')->where('status', 0)->where('category_id',$cateslug->id)->orderBy('price', 'ASC')->paginate(9);
           }elseif($sort_by == 'giamdan'){
               $product = Product::with('brand', 'productImage')->where('status', 0)->where('category_id',$cateslug->id)->orderBy('price', 'DESC')->paginate(9); 
           }
       }
       else{
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);

        $product = Product::with('brand', 'productImage')->where('status', 0)->where('category_id',$cateslug->id);
        if($brand_ids != null){
            $product = $product->whereIn('brand_id', $brand_ids);
        }
        $product = $product->orderBy('updated_at', 'DESC')->paginate(9);
       
       }
        return view('client.shop', compact('cateslug', 'product', 'category', 'brand', 'min_price', 'max_price'));
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
        $category = ProductCategory::get();
        $brand = Brand::get(); 
        $product = Product::with('productCategory','brand', 'productImage')->where('status', 0)->where('slug',$slug)->first();
        // $avg_rating =  ProductComment::where('product_id', $product->id)->avg('rating');
        // $avg_rating = round($avg_rating);
        $related_product = Product::with('productCategory')->where('status', 0)->where('category_id',$product->productCategory->id)
        ->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get()->take(4);
        
        $min_price = Product::min('price');
        $max_price = Product::max('price');
        return view('client.product', compact('product', 'category', 'brand', 'related_product', 'min_price', 'max_price'));
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
        $category = ProductCategory::get();
        $brand = Brand::get(); 
        $product_shop = Product::with('brand')->where('status', 0)->orderBy('price', 'ASC')->paginate(9);
        return redirect()->back();
    }
}