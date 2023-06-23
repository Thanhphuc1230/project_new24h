@extends('admin.master')
@section('content')
@section('module', 'Bộ phận')
@section('action', 'Edit')

<form action="{{ route('admin.positionStaff.update', ['uuid' => $position->uuid]) }}" method="post"
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
                                    <a href="{{ route('admin.users.index') }}"> <i class="ti-arrow-left"
                                            style="font-size: 25px"></i></a>
                                    <h3 class="m-0">Chỉnh sửa bộ phận</h3>
                                </div>
                            </div>
                            @include('admin.partials.error')
                        </div>
                        <div class="white_card_body">
                            <form>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Bộ phận</h6>
                                    <input type="text" name="position" class="form-control" placeholder="vd: Samsung"
                                        value="{{ old('position', $position->position) }}">
                                </div>
                                <div class=" mb-3">
                                    <h6 class="card-subtitle mb-2">Trang thái</h6>
                                    <select class="form-select" name="status_position">
                                        <option selected="">Choose...</option>
                                        <option value="0"
                                            {{ old('status_position', $position->status_position) == 0 ? 'selected' : '' }}>
                                            Tắt
                                        </option>
                                        <option value="1"
                                            {{ old('status_position', $position->status_position) == 1 ? 'selected' : '' }}>
                                            Bật
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
