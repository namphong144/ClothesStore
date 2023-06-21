@extends('layouts.layout_admin')

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

            <div class="page-title-actions">
                <a href="{{route('user.create')}}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    Create
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">

                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="btn btn-focus">This week</button>
                            <button class="active btn btn-focus">Anytime</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="myTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Họ và tên</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $key=>$user)
                            <tr>
                                <td class="text-center text-muted">{{$user->id}}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{$user->name}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center">
                                  {{-- @if ($user->level == 0)
                                     Manage
                                     @else
                                     Staff 
                                  @endif --}}
                                  <select name="" id="{{$user->id}}" class="level_choose">
                                    @if ($user->level == 0)
                                    <option value="1">Admin</option>
                                    <option selected value="0">User</option>
                                    @else
                                    <option selected value="1">Admin</option>
                                    <option value="0">User</option>
                                    @endif
                                  </select>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('user.show',$user->id)}}"
                                        class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                        Details
                                    </a>
                                    <a href="{{route('user.edit',$user->id)}}" data-toggle="tooltip" title="Edit"
                                        data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                        <span class="btn-icon-wrapper opacity-8">
                                            <i class="fa fa-edit fa-w-20"></i>
                                        </span>
                                    </a>
                                    <form class="d-inline" action="{{route('user.destroy',$user->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                            type="submit" data-toggle="tooltip" title="Delete"
                                            data-placement="bottom"
                                            onclick="return confirm('Do you really want to delete this item?')">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                                                     
                            </tr>
                            @endforeach  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
      $('.level_choose').change(function(){
        var level_val = $(this).val();
        var user_id = $(this).attr('id');
        $.ajax({
                url: "{{ route('level-choose') }}",
                method: "GET",
                data: {
                    level_val:level_val,
                    user_id:user_id
                },
                success: function(data) {
                   alert('Thay đổi thành công!');
                }
            });
      })
</script>
@endsection