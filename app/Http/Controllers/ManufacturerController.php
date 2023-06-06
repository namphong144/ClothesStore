<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = Manufacturer::orderBy('id','DESC')->get();
        return view('admin.manufacturer.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.manufacturer.form');
 
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
                'name' => 'required|unique:manufacturers|max:255',
                'phone' => 'required|max:13',
                'address' => 'required|max:255',
            ],
            [
                'name.required' => 'Tên nhà sản xuất bắt buộc phải nhập.',
                'name.max' => 'Tên nhà sản xuất chỉ dài tối đa 255 kí tự.',
                'name.unique' => 'Tên nhà sản xuất đã tồn tại.',
                'phone.max' => 'Điện thoại chỉ dài tối đa 13 số.',
                'address.required' => 'Địa chỉ bắt buộc phải nhập.',
                'address.max' => 'Địa chỉ chỉ dài tối đa 255 kí tự.',
            ]
        );

        $manufacturer = new Manufacturer();
        $manufacturer->name = $data['name'];
        $manufacturer->phone = $data['phone'];
        $manufacturer->address = $data['address'];
        $manufacturer->save();
        toastr()->success('Thành công', 'Thêm nhà cung cấp thành công.');
        return redirect()->route('manufacturer.index');
       
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
        $manufacturer = Manufacturer::find($id);
        $list = Manufacturer::orderBy('id','ASC')->get();
        return view('admin.manufacturer.form', compact('list','manufacturer'));
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
                'phone' => 'required|max:13',
                'address' => 'required|max:255',
            ],
            [
                'name.required' => 'Tên nhà sản xuất bắt buộc phải nhập.',
                'name.max' => 'Tên nhà sản xuất chỉ dài tối đa 255 kí tự.',
                'phone.max' => 'Điện thoại chỉ dài tối đa 13 số.',
                'address.required' => 'Địa chỉ bắt buộc phải nhập.',
                'address.max' => 'Địa chỉ chỉ dài tối đa 255 kí tự.',
            ]
        );

        $manufacturer = Manufacturer::find($id);
        $manufacturer->name = $data['name'];
        $manufacturer->phone = $data['phone'];
        $manufacturer->address = $data['address'];
        $manufacturer->save();
        toastr()->success('Thành công', 'Cập nhật nhà cung cấp thành công.');
        return redirect()->route('manufacturer.index');
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
        $manufacturer = Manufacturer::find($id);
        $manufacturer->delete();
        toastr()->info('Thành công', 'Xóa nhà cung cấp thành công.');
        return redirect()->back();
    }

}
