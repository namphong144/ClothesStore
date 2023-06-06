<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = Brand::orderBy('id','DESC')->get();
        return view('admin.brand.index', compact('list'));
       
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.brand.form');
 
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
        $data = $request->validate(
            [
                'name' => 'required|unique:brands|max:255',
                'slug' => 'required|unique:brands|max:255',
            ],
            [
                'name.required' => 'Tên thương hiệu bắt buộc phải nhập.',
                'name.max' => 'Tên thương hiệu chỉ dài tối đa 255 kí tự.',
                'name.unique' => 'Tên thương hiệu đã tồn tại.',
                'slug.unique' => 'Slug thương hiệu đã tồn tại.',
            ]
        );

        $brand = new Brand();
        $brand->name = $data['name'];
        $brand->slug = $data['slug'];
        $brand->save();
        toastr()->success('Thành công', 'Thêm thương hiệu thành công.');
        return redirect()->route('brand.index');
       
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
        $brand = Brand::find($id);
        $list = Brand::orderBy('id','ASC')->get();
        return view('admin.brand.form', compact('list','brand'));
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
        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'slug' => 'required|max:255',
            ],
            [
                'name.required' => 'Tên thương hiệu bắt buộc phải nhập.',
                'name.max' => 'Tên thương hiệu chỉ dài tối đa 255 kí tự.',
            ]
        );

        $brand = Brand::find($id);
        $brand->name = $data['name'];
        $brand->slug = $data['slug'];
        $brand->save();
        toastr()->success('Thành công', 'Cập nhật thương hiệu thành công.');
        return redirect()->route('brand.index');
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
        $brand = Brand::find($id);

        if($category->product){
            $product = Product::whereIn('brand_id', [$brand->id])->delete();
    }
        $brand->delete();
        toastr()->info('Thành công', 'Xóa thương hiệu thành công.');
        return redirect()->back();
    }
}

