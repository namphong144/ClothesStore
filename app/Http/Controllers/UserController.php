<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Carbon\Carbon;
use Storage;
use File;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function level_choose(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['user_id']);
        $user->level = $data['level_val'];
        $user->save();
    } 
    
    public function index()
    {
        //
        $list = User::orderBy('id','DESC')->get();
        return view('admin.user.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.form');
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
       $data = $request->all();
        // $data = $request->validate(
        //     [
        //         'name' => 'required|max:255',
        //         'email' => 'max:255|unique:user,email',
        //         'phone' => 'required|max:11', 
        //         'level' => 'required',
        //         'password' => 'required',
        //         'avatar' => 'required|image|mimes:jpg, png, jpeg, gif, svg, jfif|max:2048',
                
        //     ],
        //     [
        //         'name.required' => 'Tên user bắt buộc phải nhập.',
        //         'name.max' => 'Tên user chỉ dài tối đa 255 kí tự.',
        //         'email.unique' => 'Email đã tồn tại.',
        //         'email.max' => 'Tên email chỉ dài tối đa 255 kí tự.',
        //         'avatar.required' => 'Phải chọn hình ảnh cho phim.',
        //         'avatar.image' => 'File phải có dạng hình ảnh.',
        //         'avatar.mimes' => 'File phải thuộc 1 trong những đuôi jpg, png, jpeg, gif, svg, jfif .',
        //         'avatar.max' => 'File có dung lượng tối đa 2GB.',
        //     ]
        // );
       // $user = auth()->user();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->level = $data['level'];
        $user->phone = $data['phone'];
        $user->description = $data['description'];
        if($data['password'] != null){
            if($data['password'] != $data['password_confirmation']){
                return back()->with('Notification', 'Mật khẩu xác thực không khớp.');
            }
        }else{
            $user->password = $data['password']?$request->password:Auth::user()->password;
        }

        $get_image = $request->file('image');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/avatar_admin/',$new_image);
            $user->avatar = $new_image;
        }

        $user->save();
        //toastr()->success('Success', 'Thêm user thành công.');
        return redirect()->route('user.index');
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
        $user = User::find($id);
        return view('admin.user.show', compact('user'));
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
        $user =  User::find($id);
        return view('admin.user.form', compact('user'));
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
        $data = $request->all();
        $user = User::find($id);
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        //mat khau
        if($data['password'] != null){
            if($data['password'] != $data['password_confirmation']){
                return back()->with('Notification', 'Mat khau xac thuc khong khop');
            }
        }else{
            $user->password = $data['password']?$request->password:Auth::user()->password;
        }
        
        $user->level = $data['level'];
        $user->phone = $data['phone'];
        $user->description = $data['description'];
        $get_image = $request->file('image');

        if($get_image){
            // if(file_exists('uploads/avatar_admin/'.$user->avatar)){
            //     unlink('uploads/avatar_admin/'.$user->avatar);
            // }else{
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/avatar_admin/',$new_image);
            $user->avatar = $new_image;
        //}
    }
    $user->save();
        //toastr()->success('Success', 'Thêm user thành công.');
        return redirect()->route('user.index');
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
        $user = User::find($id);
        //xoa anh
        if(file_exists('uploads/avatar_admin/'.$user->avatar)){
            unlink('uploads/avatar_admin/'.$user->avatar);
        }
        $user->delete();
       // toastr()->info('Success', 'Xóa phim thành công.');
        return redirect()->back();
    }
}
