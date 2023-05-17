@extends('admin.master')
@section('content')
@section('module', 'Category')
@section('action', 'Edit')
@include('admin.partials.error')
<form action="{{ route('admin.comment.update', ['uuid' => $comment->uuid]) }}" method="post"
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
                                    <h4 class="card-subtitle mb-2">Email người cmt</h4>
                                    <input type="text" name="email"class="form-control"
                                        value="{{ old('email', $comment->email) }}" disabled >
                                </div>
                                <div class="mb-3">
                                    <h4 class="card-subtitle mb-2">Bài viết</h4>
                                    <input type="text" name="email"class="form-control"
                                        value="{{ old('email', $comment->title) }}" disabled >
                                </div>
                                <div class="mb-3">
                                    <h4 class="card-subtitle mb-2">Tiêu đề</h4>
                                    <textarea type="text" name="comment" class="form-control"maxlength="225" rows="3" 
                                        >{{ old('comment', $comment->comment) }} </textarea>
                                </div>

                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Trạng thái</h6>
                                    <select class="form-select" name="status_cate">
                                        <option selected="" value="1"
                                            {{ old('status', $comment->status_cate) == 1 ? 'selected' : '' }}>Hiện
                                        </option>
                                        <option value="0"
                                            {{ old('status', $comment->status_cate) == 0 ? 'selected' : '' }}>Ẩn
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
