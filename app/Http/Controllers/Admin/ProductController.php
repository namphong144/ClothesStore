<?php

namespace App\Http\Controllers\Admin;

use File;
use Storage;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status_choose(Request $request)
    {
        $data = $request->all();
        $product = Product::find($data['product_id']);
        $product->status = $data['status_val'];
        $product->save();
    } 

    public function index()
    {
        //
        $list = Product::with('productCategory', 'brand', 'productImage')->orderBy('updated_at','DESC')->get();
        $countlist = Product::count('id');
        $category = ProductCategory::pluck('name','id');
        $brand = Brand::pluck('name','id');
        
        $path = public_path()."/json/";
        if(!is_dir($path)){
            mkdir($path, 0777, true);
            File::put($path.'product.json', json_encode($list));
        }else{
            File::put($path.'product.json', json_encode($list));
        }
        return view('admin.product.index', compact('list', 'countlist', 'category', 'brand'));
       
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = ProductCategory::pluck('name','id');
        $brand = Brand::pluck('name','id');
        $size = Size::where('status', '0')->get();
        return view('admin.product.form', compact('category', 'brand', 'size'));
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required|unique:products|max:255',
            'slug' => 'required|unique:products|max:255',
            'description' => 'required',
            'price_origin' => 'required',
            'price' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
        ],
    [
            'name.required' => 'Tên sản phẩm bắt buộc phải nhập.',
            'name.max' => 'Tên sản phẩm chỉ dài tối đa 255 kí tự.',
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            'price_origin.required' => 'Giá nhập sản phẩm bắt buộc phải nhập.',
            'price.required' => 'Giá sản phẩm bắt buộc phải nhập.',
            'slug.required' => 'Slug sản phẩm bắt buộc phải nhập.',
            'description.required' => 'Mô tả sản phẩm bắt buộc phải nhập.',
    ]);
        
        $product = new Product();
        $product->name = $data['name'];
        $product->slug = $data['slug'];
        $product->price_origin = $data['price_origin'];
        $product->price = $data['price'];
        $product->category_id = $data['category_id'];
        $product->brand_id = $data['brand_id'];
        $product->status = $data['status'];
        $product->description = $data['description'];
        $product->save();

        
        if($request->hasFile('images')){

            $uploadPath = public_path().'/uploads/product/';

            foreach($request->file('images') as $imageFile){

                $get_name_image = $imageFile->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,9999).'.'.$imageFile->getClientOriginalExtension();
                $imageFile->move($uploadPath ,$new_image);
                $finalImagePathName = $new_image;

            $product->productImage()->create([
                'product_id' => $product->id,
                'path' => $finalImagePathName,
            ]);
            }
        }
        if($request->size){
            foreach($request->size as $key=>$sizes){
                $product->product_size()->create([
                    'product_id' => $product->id,
                    'size_id' => $sizes,
                    'quantity' => $request->sizequantity[$key] ?? 0
                ]);
            }
        }
        toastr()->success('Thành công', 'Thêm sản phẩm thành công.');
       return redirect()->route('product.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::with('productCategory', 'brand', 'productImage')->find($id);
        $product_sizes = $product->product_size->pluck('size_id')->toArray();
        $sizes = Size::where('status', '0')->whereNotIn('id', $product_sizes)->get();
        return view('admin.product.show', compact('product', 'product_sizes', 'sizes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = ProductCategory::pluck('name','id');
        $brand = Brand::pluck('name','id');
        $product = Product::find($id);
        $images = ProductImage::all();
        $product_sizes = $product->product_size->pluck('size_id')->toArray();
        $sizes = Size::where('status', '0')->whereNotIn('id', $product_sizes)->get();
        return view('admin.product.form', compact('category', 'brand', 'product', 'images', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
            'description' => 'required',
            'price_origin' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
        ],
    [
            'name.required' => 'Tên sản phẩm bắt buộc phải nhập.',
            'name.max' => 'Tên sản phẩm chỉ dài tối đa 255 kí tự.',
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            'price_origin.required' => 'Giá nhập sản phẩm bắt buộc phải nhập.',
            'price.required' => 'Giá sản phẩm bắt buộc phải nhập.',
            'slug.required' => 'Slug sản phẩm bắt buộc phải nhập.',
            'description.required' => 'Mô tả sản phẩm bắt buộc phải nhập.',
    ]);
        
        $product =  Product::find($id);
        $product->name = $data['name'];
        $product->slug = $data['slug'];
        $product->price_origin = $data['price_origin'];
        $product->price = $data['price'];
        $product->category_id = $data['category_id'];
        $product->brand_id = $data['brand_id'];
        $product->status = $data['status'];
        $product->description = $data['description'];

        $product->save();

        if($request->hasFile('images')){

            $uploadPath = public_path().'/uploads/product/';

            foreach($request->file('images') as $imageFile){

                $get_name_image = $imageFile->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,9999).'.'.$imageFile->getClientOriginalExtension();
                $imageFile->move($uploadPath ,$new_image);
                $finalImagePathName = $new_image;

        $product->productImage()->create([
            'product_id' => $product->id,
            'path' => $finalImagePathName,
        ]);
        }
    }

    if($request->size){
        foreach($request->size as $key=>$sizes){
            $product->product_size()->create([
                'product_id' => $product->id,
                'size_id' => $sizes,
                'quantity' => $request->sizequantity[$key] ?? 0
            ]);
        }
    }
        toastr()->success('Thành công', 'Cập nhật sản phẩm thành công.');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
               //xoa ảnh sp  
        if($product->productImage){
            foreach ($product->productImage as $image){
                $paths = public_path().'/uploads/product/'.$image->path;
                if(file_exists($paths)){
                    unlink($paths);
            }
        }
        ProductImage::whereIn('product_id', [$product->id])->delete();

        //xoa chi tiet sp
        ProductDetail::whereIn('product_id', [$product->id])->delete();
    }
        $product->delete();
        toastr()->info('Thành công', 'Xóa sản phẩm thành công.');
        return redirect()->back();

    }

    public function destroyImage(int $id)
    {
        $productImage = ProductImage::findOrFail($id);

        $paths = public_path().'/uploads/product/'.$productImage->path;
        if(File::exists($paths)){
            File::delete($paths);
        }
        $productImage->delete();
        return redirect()->back();
    }

    public function updateQtySize(Request $request, $prod_size_id)
    {
        $productSizeData = Product::findOrFail($request->product_id)->product_size()->where('id', $prod_size_id)->first();

        $productSizeData->update([
            'quantity' => $request->qty
        ]);
        return response()->json(['message'=> 'Cập nhật số lượng size thành công!']);
    }

    public function deleteQtySize($prod_size_id)
    {
        $prodSize = ProductDetail::findOrFail($prod_size_id);
        $prodSize->delete();
        return response()->json(['message'=> 'Xóa size thành công!']);
    }
}