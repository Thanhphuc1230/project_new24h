@extends('admin.master')
@section('content')
@section('module', 'News')
@section('action', 'Edit')
@include('admin.partials.error')
<form action="{{ route('admin.news.update', ['uuid' => $new->uuid]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <a href="{{ route('admin.news.index') }}"> <i class="ti-arrow-left"
                                style="font-size: 25px"></i></a>
                        <h3 class="m-0">News Edit</h3>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <div class="mb-3">
                    <h4 class="card-subtitle mb-2">Tiêu đề</h4>
                    <input type="text" name="title" class="form-control"
                        value="{{ html_entity_decode(old('title', $new->title)) }}">
                </div>
                <div class="mb-3">
                    <h4 class="card-subtitle mb-2">Giới thiệu</h4>
                    <input type="text" name="intro" class="form-control"
                        value="{{ html_entity_decode(old('intro', $new->intro)) }}">
                </div>
                <div class="mb-3">
                    <h6 class="card-subtitle mb-2">Thuộc nhóm</h6>
                    <select class="form-select" name="category_id">
                        @foreach ($category_selected as $category_option)
                            <option value="{{ $category_option->id_category }}"
                                {{ old('category_id', $new->category_id) == $category_option->id_category ? 'selected' : '' }}>
                                {{ $category_option->name_cate }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <h6 class="card-subtitle mb-2">Vị trí</h6>
                    <select class="form-select" name="where_in">
                        {{ $new->where_in }}
                        <option value="1" {{ $new->where_in == 1 ? 'selected' : '' }}>Hot news</option>
                        <option value="2" {{ $new->where_in == 2 ? 'selected' : '' }}>Tin thời sự</option>
                        <option value="3" {{ $new->where_in == 3 ? 'selected' : '' }}>Tin thế giới</option>
                        <option value="4" {{ $new->where_in == 4 ? 'selected' : '' }}>Tin pháp luật</option>
                        <option value="5" {{ $new->where_in == 5 ? 'selected' : '' }}>Tin kinh doanh</option>
                        <option value="6" {{ $new->where_in == 6 ? 'selected' : '' }}>Tin công nghệ</option>
                        <option value="7" {{ $new->where_in == 7 ? 'selected' : '' }}>Tin du lịch</option>
                        <option value="8" {{ $new->where_in == 8 ? 'selected' : '' }}>Tin văn hóa</option>
                        <option value="9" {{ $new->where_in == 9 ? 'selected' : '' }}>Tin giải trí</option>
                        <option value="10" {{ $new->where_in == 10 ? 'selected' : '' }}>Tin thể thao</option>
                        <option value="11" {{ $new->where_in == 11 ? 'selected' : '' }}>Tin sức khỏe</option>
                        <option value="0" {{ $new->where_in == 0 ? 'selected' : '' }}>Không lên trang chính
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <h6 class="card-subtitle mb-2">Avatar Current</h6>

                    <div>
                        @php
                            $avatar = !empty($new->avatar) ? $new->avatar : 'default.png';
                            if (substr($avatar, 0, 8) === 'https://') {
                                echo '<img src="' . $avatar . '" width="250px">';
                            } else {
                                echo '<img src="' . asset('images/news/' . $avatar) . '" width="250px">';
                            }
                            
                        @endphp
                    </div>
                </div>
                <div class="mb-3">
                    <h6 class="card-subtitle mb-2">Avatar Show</h6>
                    <input type="file" name="avatar" class="form-control">
                </div>

                <div class="mb-3">
                    <h4 class="card-subtitle mb-2">Nội dung bài viết</h4>
                    <textarea class="form-control" maxlength="225" rows="3" name="content"> {{ old('content', $new->content) }} </textarea>
                    <script>
                        CKEDITOR.replace('content', {
                            filebrowserUploadUrl: "{{ route('admin.upload', ['_token' => csrf_token()]) }}",
                            filebrowserUploadMethod: 'form'
                        })
                    </script>
                </div>

                <div class="mb-3">
                    <div class="mb-3">
                        <h4 class="card-subtitle mb-2">Người đăng</h4>
                        <input type="text" class="form-control" placeholder="vd: Samsung"
                            value="{{ old('author', $new->author) }}" disabled>
                        <input type="hidden" name="author" class="form-control" placeholder="vd: Samsung"
                            value="{{ old('author', $new->author) }}">
                    </div>
                    @if (Auth::user()->level !== 1)
                    @else
                        <div class="mb-3">
                            <h6 class="card-subtitle mb-2">Trạng thái</h6>
                            <select class="form-select" name="status">
                                <option selected="" value="1"
                                    {{ old('status', $new->status) == 1 ? 'selected' : '' }}>Hiện</option>
                                <option value="0" {{ old('status', $new->status) == 0 ? 'selected' : '' }}>Ẩn
                                </option>
                            </select>
                        </div>
                    @endif


                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
</form>

@endsection
