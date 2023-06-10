<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = Size::orderBy('id','DESC')->get();
        return view('admin.size.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.size.form');
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
                'size_name' => 'required|unique:sizes|max:255',
            ],
            [
                'size_name.required' => 'Tên size bắt buộc phải nhập.',
                'size_name.max' => 'Tên size chỉ dài tối đa 255 kí tự.',
                'size_name.unique' => 'Tên size đã tồn tại.', 
            ]
        );

        $size = new Size();
        $size->name = $data['size_name'];
        $size->save();
        toastr()->success('Thành công', 'Thêm size thành công.');
        return redirect()->route('size.index');
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
        $size = Size::find($id);
        $list = Size::orderBy('id','DESC')->get();
        return view('admin.size.form', compact('list','size'));
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
                'size_name' => 'required|max:255',
            ],
            [
                'size_name.required' => 'Tên size bắt buộc phải nhập.',
                'size_name.max' => 'Tên size chỉ dài tối đa 255 kí tự.',
            ]
        );

        $size = Size::find($id);
        $size->name = $data['size_name'];
        $size->save();
        toastr()->success('Thành công', 'Cập nhật size thành công.');
        return redirect()->route('size.index');
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
        $size = Size::find($id);
        $size->delete();
        toastr()->info('Thành công', 'Xóa size thành công.');
        return redirect()->back();
    }
}