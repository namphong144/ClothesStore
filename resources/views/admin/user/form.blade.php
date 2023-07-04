@extends('layouts.layout_admin')
@section('title', 'Khách hàng')
@section('main')
<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    User
                    <div class="page-title-subheading">
                        Xem, tạo, cập nhật, xóa và quản lý
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(!isset($user))
                    <form method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
                        @else
                        <form method="POST" action="{{route('user.update',$user->id)}}" enctype="multipart/form-data">
                            @method('PUT')
                            @endif
                        @csrf
                        @if (session('Notification'))
                        <div class="alert alert-warning" role="alert">
                            {{session('Notification')}}
                        </div>
                        @endif

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="name" id="name" placeholder="Name" type="text"
                                    class="form-control" value="{{isset($user) ? $user->name : '',}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="email"
                                class="col-md-3 text-md-right col-form-label">Email</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="email" id="email" placeholder="Email" type="email"
                                    class="form-control" value="{{isset($user) ? $user->email : '',}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="password"
                                class="col-md-3 text-md-right col-form-label">Password</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="password" id="password" placeholder="Password" type="password"
                                    class="form-control" value="{{isset($user) ? $user->password : '',}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="password_confirmation"
                                class="col-md-3 text-md-right col-form-label">Confirm Password</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" type="password"
                                    class="form-control" value="{{isset($user) ? $user->password : '',}}">
                            </div>
                        </div>


                        <div class="position-relative row form-group">
                            <label for="phone"
                                class="col-md-3 text-md-right col-form-label">Phone</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="phone" id="phone" placeholder="Phone" type="tel"
                                    class="form-control" value="{{isset($user) ? $user->phone : '',}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="level"
                                class="col-md-3 text-md-right col-form-label">Level</label>
                            <div class="col-md-9 col-xl-8">
                                <select name="level" id="level" class="form-control">
                                    <option value="{{isset($user) ? $user->level : '',}}">-- Level --</option>
                                    <option value="0">
                                       Manager
                                    </option>
                                    <option value="1">
                                       Staff
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="description"
                                   class="col-md-3 text-md-right col-form-label">Description</label>
                            <div class="col-md-9 col-xl-8">
                                <textarea name="description" id="description" class="form-control" value="{{isset($user) ? $user->description : '',}}"></textarea>
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                <a href="{{route('user.index')}}" class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Cancel</span>
                                </a>
                                @if(!isset($user))
                                <button type="submit"
                                    class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-download fa-w-20"></i>
                                    </span>
                                    <span>Save</span>
                                </button>
                                @else
                                <button type="submit"
                                    class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-download fa-w-20"></i>
                                    </span>
                                    <span>Save</span>
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection