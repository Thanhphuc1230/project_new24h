@extends('admin.master')
@section('module','User')
@section('action','List')
@section('content')
<div class="white_card card_height_100 mb_30">
    <div class="white_card_header">
    </div>
    <div class="white_card_body">
        <div class="QA_section">
            <div class="white_box_tittle list_header">
                <h3>User-list</h3>
                <div class="box_right d-flex lms_block">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter">
                            Add Users
                        </button>
                    </div>
                    @include('admin.partials.error')
                </div>

            </div>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
                style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('admin.partials.error')
                            <form action="{{ route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="col-lg-12">
                                    <div class="white_card card_height_100 mb_30">
                                        <div class="white_card_header">
                                            <div class="box_header m-0">
                                                <div class="main-title">
                                                    <h3 class="m-0">User Create</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="white_card_body">
                                            <div class="mb-3">
                                                <h6 class="card-subtitle mb-2">FullName</h6>
                                                <input type="text" name="fullname" class="form-control"
                                                    placeholder="vd: Nguyễn văn A" value="{{old('fullname')}}">
                                            </div>

                                            <div class="mb-3">
                                                <h6 class="card-subtitle mb-2">Phone</h6>
                                                <input type="text" name="phone" class="form-control"
                                                    placeholder="vd: 090123456789" value="{{old('phone')}}">
                                            </div>

                                            <div class="mb-3">
                                                <h6 class="card-subtitle mb-2">Email</h6>
                                                <input type="text" name="email" class="form-control"
                                                    placeholder="vd: Vana@gmail.com" value="{{old('email')}}">
                                            </div>

                                            <div class="mb-3">
                                                <h6 class="card-subtitle mb-2">Password</h6>
                                                <input type="password" name="password" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <h6 class="card-subtitle mb-2">Password-confirmation</h6>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control">
                                            </div>

                                            <div class=" mb-3">
                                                <h6 class="card-subtitle mb-2">Level</h6>
                                                <select class="form-select" name="level">
                                                    <option selected="">Choose...</option>
                                                    <option value="2" {{ old('level')==2 ? 'selected' : '' }}>User
                                                    </option>
                                                    <option value="1" {{ old('level')==1 ? 'selected' : '' }}>Admin
                                                    </option>
                                                </select>
                                            </div>

                                            <div class=" mb-3">
                                                <h6 class="card-subtitle mb-2">Avatar</h6>
                                                <input type="file" class="form-control" name="avatar">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="QA_table mb_30">
                <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper no-footer">
                    <table class="table  dataTable no-footer dtr-inline" id='my-table' role="grid"
                        aria-describedby="DataTables_Table_1_info" style="width: 971px;">
                        <thead>
                            <tr role="row">
                                <th scope="col" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1" style="width: 101px;" aria-sort="ascending">ID</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1" style="width: 133px;">Avatar</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1" style="width: 133px;">Fullname</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1" style="width: 132px;">Email</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1" style="width: 132px;">Level</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1" style="width: 132px;">Status</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1" style="width: 127px;">Created</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1" style="width: 67px;">Action</th>
                            </tr>
                        </thead>


                        <tbody>


                            <tr role="row" class="odd">


                                @foreach ($users as $user)

                                <td>{{ $loop->iteration }}</td>
                                @php
                                $avatar = !empty($user->avatar) ? $user->avatar : 'default_user.png';
                                @endphp

                                <td><img src="{{ asset('images/users/'.$avatar) }}" width="50px"></td>
                                <td>{{ $user->fullname }}</td>

                                <td>{{ $user->email }}</td>
                                <td>
                                    @php
                                    if($user->level == 1){
                                    @endphp
                                    Admin
                                    @php
                                    }
                                    else{
                                    @endphp
                                    User
                                    @php } @endphp</td>
                                <td>
                                    @php
                                    if($user->status_user == 1){
                                    @endphp
                                    <a onclick="return confirm('Xác nhận chặn người dùng ?')"
                                        href="{{ route('admin.users.status_user',['uuid' => $user->uuid,'status'=>0]) }} "
                                        class="status_btn">Active</a>
                                    @php
                                    }else{
                                    @endphp
                                    <a onclick="return confirm('Xác nhân cho phép người dùng hoạt động trở lại ?')"
                                        href="{{ route('admin.users.status_user',['uuid' => $user->uuid,'status'=>1]) }}"
                                        class="status_btn" style="background: red !important">Unactive</a>
                                    @php
                                    }
                                    @endphp

                                </td>
                                <td>{{ date('d/m/Y', strtotime($user->created_at )) }}</td>
                                <td>
                                    <div class="action_btns d-flex">
                                        <a href="{{ route('admin.users.edit', ['uuid' => $user->uuid]) }}"
                                            class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
                                        <a onclick="return confirm('Xác nhận xóa thành viên, sẽ xóa luôn các đơn hàng của người dùng và không thể khôi phục lại ?')"
                                            href="{{ route('admin.users.destroy', ['uuid' => $user->uuid]) }}"
                                            class="action_btn"> <i class="fas fa-trash"></i> </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- end content --}}
    @endsection