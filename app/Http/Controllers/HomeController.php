<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = ProductCategory::get();
        $blog = Blog::orderBy('updated_at', 'DESC')->get()->take(3);
        $product_nu = Product::with('brand', 'productImage')->where('status', 0)->where('slug', 'LIKE', '%nu%')->orderBy('updated_at', 'DESC')->paginate(10);
        $product_nam = Product::with('brand', 'productImage')->where('status', 0)->where('slug', 'LIKE', '%nam%')->orderBy('updated_at', 'DESC')->paginate(10);
      
        return view('client.home', compact('category','blog', 'product_nu', 'product_nam'));
    }
}