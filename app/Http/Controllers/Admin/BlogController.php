<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    //
    public function index()
    {
        //
        $list = Blog::orderBy('id','DESC')->get();
        return view('admin.blog.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.blog.form');
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
                'slug' => 'required|max:255',
                'sub_title' => 'required|max:255',
                'content' => 'nullable',
                'image_cover' => 'required|image|mimes:png,jpg,jfif,jpeg',
                'status' => 'required',
            ],
            [
                'title.required' => 'Tên tiêu đề bắt buộc phải nhập.',
                'title.max' => 'Tên tiêu đề chỉ dài tối đa 255 kí tự.',
                'sub_title.required' => 'Tên tiêu đề phụ bắt buộc phải nhập.',
                'sub_title.max' => 'Tên tiêu đề phụ chỉ dài tối đa 255 kí tự.',
                'image_cover.required' => 'Ảnh blog bắt buộc phải có.',
                'image_cover.image' => 'File phải có đuôi jpg,png,jpeg,gif,svg,jfif.',
                'image_cover.max' => 'File chỉ có dung lượng tối đa 2GB.',
            ]
        );

        $blog = new Blog();
        $blog->user_id = Auth::user()->id;
        $blog->title = $data['title'];
        $blog->slug = $data['slug'];
        $blog->sub_title = $data['sub_title'];
        $blog->content = $data['content'];
        $blog->status = $data['status'];

        $get_image = $request->file('image_cover');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/blog/',$new_image);
            $blog->image_cover = $new_image;
        }
        $blog->save();
        toastr()->success('Thành công', 'Thêm blog thành công.');
        return redirect()->route('blog.index');
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
        $blog = Blog::find($id);
        $list = Blog::orderBy('id','DESC')->get();
        return view('admin.blog.form', compact('list','blog'));
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
                'slug' => 'required|max:255',
                'sub_title' => 'required|max:500',
                'content' => 'nullable',
                'image_cover' => 'image|mimes:png,jpg,jfif,jpeg',
                'status' => 'required',
            ],
            [
                'title.required' => 'Tên tiêu đề bắt buộc phải nhập.',
                'title.max' => 'Tên tiêu đề chỉ dài tối đa 255 kí tự.',
                'sub_title.required' => 'Tên tiêu đề phụ bắt buộc phải nhập.',
                'sub_title.max' => 'Tên tiêu đề phụ chỉ dài tối đa 500 kí tự.',
                'image_cover.image' => 'File phải có đuôi jpg,png,jpeg,gif,svg,jfif.',
                'image_cover.max' => 'File chỉ có dung lượng tối đa 2GB.',
            ]
        );

        $blog = Blog::find($id);
        $blog->user_id = Auth::user()->id;
        $blog->title = $data['title'];
        $blog->slug = $data['slug'];
        $blog->sub_title = $data['sub_title'];
        $blog->content = $data['content'];
        $blog->status = $data['status'];

        $get_image = $request->file('image_cover');

        $path = public_path().'/uploads/blog/'.$blog->image_cover;
        if($get_image){
            if(file_exists($path)){
                unlink($path);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/blog/',$new_image);
            $blog->image_cover = $new_image;
        }

        $blog->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $blog->save();
        toastr()->success('Thành công', 'Cập nhật blog thành công.');
        return redirect()->route('blog.index');
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
        $blog = Blog::find($id);
        $blog->delete();
        toastr()->info('Thành công', 'Xóa blog thành công.');
        return redirect()->back();
    }
}