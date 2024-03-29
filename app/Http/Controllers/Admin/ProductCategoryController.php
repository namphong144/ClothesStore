<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = ProductCategory::orderBy('id','DESC')->get();
        return view('admin.category.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // $data = $request->all();
       $data = $request->validate(
        [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'status' => 'required',
        ],
        [
            'name.required' => 'Tên danh mục bắt buộc phải nhập.',
            'name.max' => 'Tên danh mục chỉ dài tối đa 255 kí tự.',
        ]
    );
        $category = new ProductCategory();
        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->status = $data['status'];
        $category->save();
        toastr()->success('Thành công', 'Thêm danh mục thành công.');
        return redirect()->route('category.index');
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
        $category = ProductCategory::find($id);
        $list = ProductCategory::orderBy('id','ASC')->get();
        return view('admin.category.form', compact('list','category'));
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
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên danh mục bắt buộc phải nhập.',
                'name.max' => 'Tên danh mục chỉ dài tối đa 255 kí tự.',
            ]
        );

        $category = ProductCategory::find($id);
        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->status = $data['status'];
        $category->save();
        if($category->status == 1){
            $productstatus = Product::whereIn('category_id', [$category->id])->increment('status', 1);
        }elseif($category->status == 0){
            $productstatus = Product::whereIn('category_id', [$category->id])->decrement('status', 1);
        }
        toastr()->success('Thành công', 'Cập nhật danh mục thành công.');
        return redirect()->route('category.index');
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
        $category = ProductCategory::find($id);
        //xoá sp thuộc danh mục
        //$product = Product::whereIn('category_id', [$category->id])->delete();
        $category->delete();
        toastr()->info('Thành công', 'Xóa danh mục thành công.');
        return redirect()->back();
    }
}