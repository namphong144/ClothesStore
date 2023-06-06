<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = Slider::orderBy('id','DESC')->get();
        return view('admin.slider.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.slider.form');
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
                'title' => 'required|max:255',
                'description' => 'nullable',
                'image' => 'image|mimes:png,jpg,jfif,jpeg',
                'link' => 'nullable|max:255',
            ],
            [
                'title.required' => 'Tên danh mục bắt buộc phải nhập.',
                'title.max' => 'Tên danh mục chỉ dài tối đa 255 kí tự.',
                'link.max' => 'Tên tiêu đề chỉ dài tối đa 255 kí tự.',
            ]
        );

        $slider = new Slider();
        $slider->title = $data['title'];
        $slider->description = $data['description'];
        $slider->status = $request->status == true ? '0':'1';
        $slider->link = $data['link'];

        $get_image = $request->file('image');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/slider/',$new_image);
            $slider->image = $new_image;
        }
        $slider->save();
        toastr()->success('Thành công', 'Thêm slider thành công.');
        return redirect()->route('slider.index');
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
        $slider = Slider::find($id);
        $list = Slider::orderBy('id','ASC')->get();
        return view('admin.slider.form', compact('list','slider'));
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
                'title' => 'required|max:255',
                'description' => 'nullable',
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg,jfif|max:2048',
                'link' => 'nullable|max:255',
            ],
            [
                'title.required' => 'Tên tiêu đề bắt buộc phải nhập.',
                'title.max' => 'Tên tiêu đề chỉ dài tối đa 255 kí tự.',
                'image.image' => 'File phải có đuôi jpg,png,jpeg,gif,svg,jfif.',
                'image.max' => 'File chỉ có dung lượng tối đa 2GB.',
                'link.max' => 'Tên tiêu đề chỉ dài tối đa 255 kí tự.',
            ]
        );

        $slider = Slider::find($id);
        $slider->title = $data['title'];
        $slider->description = $data['description'];
        $slider->status = $request->status == true ? '0':'1';
        $slider->link = $data['link'];

        $get_image = $request->file('image');

        $path = public_path().'/uploads/slider/'.$slider->image;
        if($get_image){
            if(file_exists($path)){
                unlink($path);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/slider/',$new_image);
            $slider->image = $new_image;
        }
        
        $slider->save();
        toastr()->success('Thành công', 'Cập nhật slider thành công.');
        return redirect()->route('slider.index');
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
        $slider = Slider::find($id);
        $slider->delete();
        toastr()->info('Thành công', 'Xóa slider thành công.');
        return redirect()->back();
    }
}
