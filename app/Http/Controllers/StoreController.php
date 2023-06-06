<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $list = Store::orderBy('id','DESC')->get();
        // return view('admin.store.index', compact('list'));
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
    public function store(Request $request)
    {
        //
       
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
        $store = Store::find($id);
        return view('admin.store.index', compact('store'));
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
        $store = Store::find($id);
        $list = Store::orderBy('id','ASC')->get();
        return view('admin.store.form', compact('list','store'));
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
                'email' => 'required|max:255',
                'logo' => 'image|mimes:jpg,png,jpeg,gif,svg,jfif|max:2048',
            ],
            [
                'name.required' => 'Tên cửa hàng bắt buộc phải nhập.',
                'name.max' => 'Tên cửa hàng chỉ dài tối đa 255 kí tự.',
                'phone.max' => 'Điện thoại chỉ dài tối đa 13 số.',
                'address.required' => 'Địa chỉ bắt buộc phải nhập.',
                'address.max' => 'Địa chỉ chỉ dài tối đa 255 kí tự.',
                'logo.image' => 'File phải có đuôi jpg,png,jpeg,gif,svg,jfif.',
                'logo.max' => 'File chỉ có dung lượng tối đa 2GB.',
            ]
        );

        $store = Store::find($id);
        $store->name = $data['name'];
        $store->phone = $data['phone'];
        $store->address = $data['address'];
        $store->email = $data['email'];

        $get_image = $request->file('logo');

        $path = public_path().'/uploads/logo/'.$store->logo;
        if($get_image){
            if(file_exists($path)){
                unlink($path);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/store/',$new_image);
            $store->logo = $new_image;
        }
        $store->save();
        toastr()->success('Thành công', 'Cập nhật thông tin cửa hàng thành công.');
        return redirect()->route('store.show',$store->id);
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
    }
}
