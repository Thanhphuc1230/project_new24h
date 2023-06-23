@extends('admin.master')
@section('content')
@section('module', 'Phân quyền')
@section('action', 'Chỉnh sửa')
@include('admin.partials.error')
<form action="{{ route('admin.position.update', ['uuid' => $position->uuid]) }}" method="post"
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
                                    <a href="{{ route('admin.categories.index') }}"> <i class="ti-arrow-left"
                                            style="font-size: 25px"></i></a>
                                    <h3 class="m-0">Category Edit</h3>
                                </div>
                            </div>
                            @include('admin.partials.error')
                        </div>
                        <div class="white_card_body">
                            <form>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Tên nhân viên</h6>
                                    <input type="text" name="name_cate" class="form-control"
                                        placeholder="vd: Samsung" value="{{ $position->fullname }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Chức vụ</h6>
                                    <select class="form-select" name="position_staff">
                                        @foreach ($staff_positions as $staff_position)
                                            <option value="{{ $staff_position->uuid }}"
                                                {{ old('position_staff', $position->position_staff) == $staff_position->uuid ? 'selected' : '' }}>
                                                {{ $staff_position->position }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @foreach (json_decode($position->category_id) as $cate)
                                    <div class="mb-3">
                                        <h6 class="card-subtitle mb-2">Vị trí</h6>
                                        <select class="form-select" name="category_id[]">
                                            @foreach ($category_selected as $category)
                                                <option value="{{ $category->id_category }}"
                                                    {{ old('category_id[]', $category->id_category) == $cate ? 'selected' : '' }}>
                                                    {{ $category->name_cate }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Trạng thái</h6>
                                    <select class="form-select" name="status_position">
                                        <option selected="" value="1"
                                            {{ old('status_position', $position->status_position) == 1 ? 'selected' : '' }}>
                                            Hiện
                                        </option>
                                        <option value="0"
                                            {{ old('status_position', $position->status_position) == 0 ? 'selected' : '' }}>
                                            Ẩn
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
