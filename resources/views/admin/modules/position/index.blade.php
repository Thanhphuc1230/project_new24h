@extends('admin.master')
@section('module', 'Phân quyền')
@section('action', 'List')
@section('content')
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
        </div>
        <div class="white_card_body">
            <div class="QA_section">
                <div class="white_box_tittle list_header">
                    <h3>Danh sách phân quyền</h3>
                    <div class="box_right d-flex lms_block">
                        <div class="serach_field_2">
                            <div class="search_inner">
                                <form action="{{ route('admin.position.index') }}" method="GET">
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
                                Thêm quyền hạn nhân viên
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
                                    <div class="container-fluid p-0 sm_padding_15px">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-12">
                                                <div class="white_card card_height_100 mb_30">
                                                    <div class="white_card_header">
                                                        <div class="box_header m-0">
                                                            <div class="main-title">
                                                                <h3 class="m-0">Thêm chủ đề</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="white_card_body">
                                                        <form>
                                                            <div class="mb-3">
                                                                <h6 class="card-subtitle mb-2">Nhân viên</h6>
                                                                <select class="form-select" name="uuid_staff">
                                                                    @foreach ($staff as $item)
                                                                        {
                                                                        <option selected="" value="{{ $item->uuid }}">
                                                                            {{ $item->fullname }}</option>
                                                                        }
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6 class="card-subtitle mb-2">Chức vụ</h6>
                                                                <select class="form-select" name="position_staff">
                                                                    @foreach ($position as $item)
                                                                        {
                                                                        <option selected="" value="{{ $item->uuid }}">
                                                                            {{ $item->position }}</option>
                                                                        }
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6 class="card-subtitle mb-2">Vị trí</h6>
                                                                <select class="form-select" name="category_id[]">
                                                                    @foreach ($category_selected as $category)
                                                                        {
                                                                        <option selected=""
                                                                            value="{{ $category->id_category }}">
                                                                            {{ $category->name_cate }}</option>
                                                                        }
                                                                    @endforeach

                                                                </select>
                                                            </div>

                                                            <div id="additionalSelects"></div>
                                                            <button type="button" class="btn btn-success mb-3"
                                                                onclick="addSelect()">Thêm vị trí</button>


                                                            <div class="mb-3">
                                                                <h6 class="card-subtitle mb-2">Trạng thái</h6>
                                                                <select class="form-select" name="status_position">
                                                                    <option selected="" value="1">Hiện</option>
                                                                    <option value="0">Ẩn</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
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
                        <table class="table dataTable no-footer dtr-inline" id='my-table' role="grid"
                            aria-describedby="DataTables_Table_1_info" style="width: 971px;">
                            <thead>
                                <tr role="row">
                                    <th scope="col" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1" style="width: 101px;" aria-sort="ascending"
                                        aria-label="title: activate to sort column descending">ID</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1" style="width: 133px;"
                                        aria-label="Category: activate to sort column ascending">Tên Nhân viên</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1" style="width: 133px;"
                                        aria-label="Category: activate to sort column ascending">Công việc</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1" style="width: 133px;"
                                        aria-label="Category: activate to sort column ascending">Vị trí</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1" style="width: 133px;"
                                        aria-label="Category: activate to sort column ascending">Status</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1" style="width: 127px;"
                                        aria-label="Lesson: activate to sort column ascending">Created</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1" style="width: 67px;"
                                        aria-label="Price: activate to sort column ascending">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr role="row" class="odd">
                                    @foreach ($position_staff as $item)
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->fullname }}</td>
                                        <td>{{ $item->position }}</td>
                                        <td>
                                            @php
                                                $category_id = json_decode($item->category_id);
                                                
                                                $positions = \Illuminate\Support\Facades\DB::table('categories')
                                                    ->whereIn('id_category', $category_id)
                                                    ->get();
                                            @endphp
                                            @foreach ($positions as $position)
                                                {{ $position->name_cate }},
                                            @endforeach

                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            @php
                                                if ($item->status_position == 0) {
                                                    if (session('admin_check')) {
                                                        echo '<a onclick="return confirm(\'Xác nhận kích hoạt nhãn hàng ?\')"href="' . route('admin.position.status_position', ['uuid' => $item->uuid, 'status' => 1]) . '"class="status_btn" style="background:#FA8072!important">Unactive</a>';
                                                    } else {
                                                        echo '<a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck" class="status_btn" style="background:#FA8072!important">Unactive</a>';
                                                    }
                                                } else {
                                                    if (session('admin_check')) {
                                                        echo '<a onclick="return confirm(\'Xác nhận tắt kích hoạt nhãn hàng ?\')"href="' . route('admin.position.status_position', ['uuid' => $item->uuid, 'status' => 0]) . '"class="status_btn">Active</a>';
                                                    } else {
                                                        echo '<a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck"class="status_btn">Active</a>';
                                                    }
                                                }
                                            @endphp

                                        </td>
                                        <td>
                                            <div class="action_btns d-flex">
                                                @if (session('admin_check'))
                                                    <a href="{{ route('admin.position.edit', ['uuid' => $item->uuid]) }}" class="action_btn mr_10">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a onclick="return confirm('Xác nhận xóa nhãn hàng ?')"
                                                       href="{{ route('admin.position.destroy', ['uuid' => $item->uuid]) }}" class="action_btn">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @else
                                                    <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck" class="action_btn mr_10">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck" class="action_btn">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="paginate-table">
                        {!! $position_staff->appends(request()->except('page'))->links() !!}
                    </div>
                </div>
            </div>
            {{-- end content --}}
        </div>
    </div>

    <script>
        function addSelect() {
            var selectContainer = document.getElementById('additionalSelects');
            var select = document.createElement('select');
            select.className = 'form-select';
            select.setAttribute('name', 'category_id[]');

            @foreach ($category_selected as $category)
                var option = document.createElement('option');
                option.value = "{{ $category->id_category }}";
                option.text = "{{ $category->name_cate }}";
                select.appendChild(option);
            @endforeach

            var div = document.createElement('div');
            div.className = 'mb-3';
            div.appendChild(select);

            selectContainer.appendChild(div);
        }
    </script>
@endsection
