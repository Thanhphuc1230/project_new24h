@php
    if (Auth::user()->level == 1) {
        $level = 'Admin';
    } else {
        $level = 'Staff';
    }
@endphp
@extends('admin.master')
@section('content')
@section('module', $level)
@section('action', 'Edit')
<form method="post" action="{{ route('admin.profile_admin.updatedProfile', ['uuid' => $admin->uuid]) }}"
    enctype="multipart/form-data">
    @csrf
    <div class="main_content_iner ">
        <div class="container-fluid p-0 sm_padding_15px">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Thông tin {{ $level }}
                                    </h3>
                                </div>
                            </div>
                            @include('admin.partials.error')
                        </div>
                        <div class="white_card_body">
                            <form>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">FullName</h6>
                                    <input type="text" name="fullname" class="form-control" placeholder="vd: Samsung"
                                        value="{{ old('fullname', $admin->fullname) }}">
                                </div>

                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Phone</h6>
                                    <input type="text" name="phone" class="form-control" placeholder="vd: Samsung"
                                        value="{{ old('phone', $admin->phone) }}">
                                </div>
                                <div class="input-group mb-3">
                                    <label class="input-group-text">Level</label>
                                    <select class="form-select" name="level" disabled>
                                        <option selected=""></option>
                                        <option value="2" {{ old('level', $admin->level) == 2 ? 'selected' : '' }}>
                                            Users</option>
                                        <option value="1" {{ old('level', $admin->level) == 1 ? 'selected' : '' }}>
                                            Admin</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Avatar-Current</h6>
                                    @php
                                        $avatar = !empty($admin->avatar) ? $admin->avatar : 'default_user.png';
                                    @endphp

                                    <div>
                                        <img class="img-fluid img-thumbnail"
                                            src="{{ asset('images/users/' . $avatar) }}" alt="" width="200px">
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupFile01">Avatar</label>
                                    <input type="file" class="form-control" name="avatar">
                                </div>

                                <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form method="post" action="{{ route('admin.profile_admin.updatedPassword', ['uuid' => $admin->uuid]) }}">
    @csrf
    <div class="main_content_iner ">
        <div class="container-fluid p-0 sm_padding_15px">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Cập nhật mật khẩu
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <form>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Mẩu khẩu cũ </h6>
                                    <input type="password" name="old_password" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Mẩu khẩu mới </h6>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Nhập lại mật khẩu </h6>
                                    <input type="password" name="password_confirm" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form method="post" action="{{ route('admin.profile_admin.updatedEmail', ['uuid' => $admin->uuid]) }}">
    @csrf
    <div class="main_content_iner ">
        <div class="container-fluid p-0 sm_padding_15px">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Cập nhật email
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <form>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Email</h6>
                                    <input type="email" name="email" class="form-control" value={{ $admin->email }} disabled>
                                </div>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Email mới </h6>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật Email</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
