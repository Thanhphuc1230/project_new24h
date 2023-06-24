@extends('admin.master')
@section('module', 'Comment')
@section('action', 'List')
@section('content')
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
        </div>
        <div class="white_card_body">
            <div class="QA_section">
                <div class="white_box_tittle list_header">
                    <h4>Comment List </h4>
                    <div class="box_right d-flex lms_block">
                        <div class="serach_field_2">
                            <div class="search_inner">
                                <form action="{{ route('admin.comment.index') }}" method="GET">
                                    <div class="search_field">
                                        <input type="text" name="search" placeholder="Search content here...">
                                    </div>
                                    <button type="submit"> <i class="ti-search"></i> </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-outline-primary mb-3" id="goBackButton" onclick="goBack()"><i class="fas fa-arrow-circle-left"></i></button>

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
                                        aria-label="Category: activate to sort column ascending">Bài viết</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1" style="width: 133px;"
                                        aria-label="Category: activate to sort column ascending">Email Comment</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1" style="width: 133px;"
                                        aria-label="Category: activate to sort column ascending"> Comment</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1" style="width: 127px;"
                                        aria-label="Lesson: activate to sort column ascending">Status</th>
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
                                    @foreach ($comments as $item)
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ html_entity_decode(Str::words($item->title, 15)) }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->comment }}</td>
                                        <td>
                                            @php
                                                if ($item->status_comment == 0) {
                                                    if (session('user_check')) {
                                                        echo '<a onclick="return confirm(\'Xác nhận kích hoạt bài viết ?\')"
                                                    href="' .
                                                            route('admin.comment.status_comment', ['uuid' => $item->uuid, 'status' => 1]) .
                                                            '"
                                                    class="status_btn" style="background:#FA8072 !important">Unactive</a>';
                                                    } else {
                                                        echo '<a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck" class="status_btn" style="background:#FA8072!important">Unactive</a>';
                                                    }
                                                } else {
                                                    if (session('user_check')) {
                                                        echo '<a onclick="return confirm(\'Xác nhận tắt kích hoạt bài viết ?\')"
                                                    href="' .
                                                            route('admin.comment.status_comment', ['uuid' => $item->uuid, 'status' => 0]) .
                                                            '"
                                                    class="status_btn">Active</a>';
                                                    } else {
                                                        echo '<a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck"class="status_btn">Active</a>';
                                                    }
                                                }
                                            @endphp
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>

                                        <td>
                                            @php
                                                if (session('admin_check')) {
                                                    echo '<a href="' . route('admin.comment.edit', ['uuid' => $item->uuid]) . '" class="action_btn mr_10"><i class="far fa-edit"></i></a>';
                                                    echo '<a onclick="return confirm(\'Xác nhận xóa bình luận ?\')" href="' . route('admin.comment.destroy', ['uuid' => $item->uuid]) . '" class="action_btn"><i class="fas fa-trash"></i></a>';
                                                } else {
                                                    echo '<a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck" class="action_btn mr_10"><i class="far fa-edit"></i></a>';
                                                    echo '<a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterCheck" class="action_btn"><i class="fas fa-trash"></i></a>';
                                                }
                                            @endphp
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="paginate-table">
                        {!! $comments->appends(request()->except('page'))->links() !!}
                    </div>
                </div>
            </div>
            {{-- end content --}}
        @endsection
