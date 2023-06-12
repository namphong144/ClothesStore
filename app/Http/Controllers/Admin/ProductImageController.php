<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        //
        $product = Product::find($product_id);
        $productimg = $product->productImage;
        return view('admin.product.image.index', compact('product', 'productimg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        //
        $data = $request->all();
        $productImage = new ProductImage();
        if($request->hasFile('image')){

            $get_image = $request->file('image');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/product/',$new_image);
            $productImage->path = $new_image;
        }
            $productImage->product_id = $product_id;
            $productImage->save();
    }
    return redirect('/admin/product/'.$product_id.'/image');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id, $product_image_id)
    {
        //
        $productImage = ProductImage::findOrFail($product_image_id);

        $paths = public_path().'/uploads/product/'.$productImage->path;
        if(File::exists($paths)){
            File::delete($paths);
        }
        $productImage->delete();
        return redirect('/admin/product/'.$product_id.'/image');

    }
}