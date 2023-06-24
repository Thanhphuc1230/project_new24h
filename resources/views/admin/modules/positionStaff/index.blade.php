@extends('admin.master')
@section('module', 'Bộ phận')
@section('action', 'Danh sách')
@section('content')
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
        </div>
        <div class="white_card_body">
            <div class="QA_section">
                <div class="white_box_tittle list_header">
                    <h3>Danh sách Bộ phận</h3>
                    <div class="box_right d-flex lms_block">
                        <div class="serach_field_2">
                            <div class="search_inner">
                                <form action="{{ route('admin.positionStaff.index') }}" method="GET">
                                    <div class="search_field">
                                        <input type="text" name="search" placeholder="Search content here...">
                                    </div>
                                    <button type="submit"> <i class="ti-search"></i> </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_body">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter">
                                Thêm Bộ phận
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
                                <form action="{{ route('admin.position.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-lg-12">
                                        <div class="white_card card_height_100 mb_30">
                                            <div class="white_card_header">
                                                <div class="box_header m-0">
                                                    <div class="main-title">
                                                        <h3 class="m-0">Thêm Bộ phận</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="white_card_body">
                                                <div class="mb-3">
                                                    <h6 class="card-subtitle mb-2">Bộ phận</h6>
                                                    <input type="text" name="position" class="form-control"
                                                        placeholder="vd: Đăng bài" value="{{ old('position') }}">
                                                </div>
                                                <div class=" mb-3">
                                                    <h6 class="card-subtitle mb-2">Level</h6>
                                                    <select class="form-select" name="level_staff">
                                                        <option value="2"
                                                            {{ old('level_staff') == 2 ? 'selected' : '' }}>Staff
                                                        </option>
                                                        <option value="1"
                                                            {{ old('level_staff') == 1 ? 'selected' : '' }}>Admin
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class=" mb-3">
                                                    <h6 class="card-subtitle mb-2">Trang thái</h6>
                                                    <select class="form-select" name="status_postion">
                                                        <option selected="">Choose...</option>
                                                        <option value="0"
                                                            {{ old('status_postion') == 0 ? 'selected' : '' }}>Tắt
                                                        </option>
                                                        <option value="1"
                                                            {{ old('status_postion') == 1 ? 'selected' : '' }}>Bật
                                                        </option>
                                                    </select>
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
                                        rowspan="1" colspan="1" style="width: 133px;">Bộ phận</th>
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
                                    @foreach ($position as $item)
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->position }}</td>

                                        <td>@php
                                            echo $item->level_staff === 1 ? 'Admin' : ($item->level_staff === 2 ? 'Staff' : '');
                                        @endphp</td>
                                        <td>
                                            @php
                                                if ($item->status_position == 0) {
                                                    if (session('admin_check')) {
                                                        echo '<a onclick="return confirm(\'Xác nhận kích hoạt chức vụ ?\')"href="' . route('admin.positionStaff.status_position', ['uuid' => $item->uuid, 'status' => 1]) . '"class="status_btn" style="background:#FA8072!important">Unactive</a>';
                                                    } else {
                                                        echo '<a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck" class="status_btn" style="background:#FA8072!important">Unactive</a>';
                                                    }
                                                } else {
                                                    if (session('admin_check')) {
                                                        echo '<a onclick="return confirm(\'Xác nhận tắt kích hoạt chức vụ ?\')"href="' . route('admin.positionStaff.status_position', ['uuid' => $item->uuid, 'status' => 0]) . '"class="status_btn">Active</a>';
                                                    } else {
                                                        echo '<a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck"class="status_btn">Active</a>';
                                                    }
                                                }
                                            @endphp

                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <div class="action_btns d-flex">
                                                @php
                                                    if (session('admin_check')) {
                                                        echo '<a href="' .
                                                            route('admin.positionStaff.edit', ['uuid' => $item->uuid]) .
                                                            '" class="action_btn mr_10">
                                                        <i class="far fa-edit"></i>
                                                    </a>';
                                                        echo '<a onclick="return confirm(\'Xác nhận xóa nhãn hàng ?\')"
                                                        href="' .
                                                            route('admin.positionStaff.destroy', ['uuid' => $item->uuid]) .
                                                            '" class="action_btn">
                                                        <i class="fas fa-trash"></i>
                                                    </a>';
                                                    } else {
                                                        echo '<a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck"
                                                        class="action_btn mr_10">
                                                        <i class="far fa-edit"></i>
                                                    </a>';
                                                        echo '<a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck"
                                                        class="action_btn">
                                                        <i class="fas fa-trash"></i>
                                                    </a>';
                                                    }
                                                @endphp
                                            </div>
                                        </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="paginate-table">
                        {!! $position->appends(request()->except('page'))->links() !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- end content --}}
    @endsection
