<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = Color::orderBy('id','DESC')->get();
        return view('admin.color.index', compact('list'));
       
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.color.form');
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
                'name' => 'required|unique:colors|max:255',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên màu sắc bắt buộc phải nhập.',
                'name.max' => 'Tên màu sắc chỉ dài tối đa 255 kí tự.',
                'name.unique' => 'Tên màu sắc đã tồn tại.',
            ]
        );

        $color = new Color();
        $color->name = $data['name'];
        $color->status = $data['status'];
        $color->save();
        toastr()->success('Thành công', 'Thêm màu sắc thành công.');
        return redirect()->route('color.index');
       
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
        $color = Color::find($id);
        $list = Color::orderBy('id','ASC')->get();
        return view('admin.color.form', compact('list','color'));
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
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên màu sắc bắt buộc phải nhập.',
                'name.max' => 'Tên màu sắc chỉ dài tối đa 255 kí tự.',
            ]
        );

        $color = Color::find($id);
        $color->name = $data['name'];
        $color->status = $data['status'];
        $color->save();
        toastr()->success('Thành công', 'Cập nhật màu sắc thành công.');
        return redirect()->route('color.index');
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
        $color = Color::find($id);
        $color->delete();
        toastr()->info('Thành công', 'Xóa màu sắc thành công.');
        return redirect()->back();
    }
}