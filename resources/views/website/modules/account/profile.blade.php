@extends('website.master')
@section('module', 'Profile')
@section('content')
    <section id="main-section">

        <div class="account_page_bg">
            <div class="container">
                <section class="main_content_area">
                    <div class="account_dashboard">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <!-- Nav tabs -->
                                <div class="dashboard_tab_button">
                                    <ul role="tablist" class="nav flex-column dashboard-list" id="nav-tab">


                                        <li><a href="#information" data-toggle="tab" class="nav-link active">Thông tin</a>
                                        </li>
                                        <li> <a href="#history" data-toggle="tab" class="nav-link">Lịch sử</a></li>
                                        <li> <a href="#comment" data-toggle="tab" class="nav-link">Comment</a></li>
                                        <li> <a href="#save" data-toggle="tab" class="nav-link">Lưu bài viết</a></li>
                                        @if (Auth::user()->password !== null)
                                            <li> <a href="#password" data-toggle="tab" class="nav-link">Bảo mật</a></li>
                                        @endif

                                    </ul>
                                    <ul class="nav flex-column dashboard-list">
                                        <li> <a href="{{ route('website.logout') }}">Logout</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-9 col-lg-9">

                                <!-- Tab panes -->
                                <div class="tab-content dashboard_content">

                                    <div class="tab-pane active" id="information">
                                        <h2 class="no-margin text-bold">Thông tin cá nhân <small>Bold 20px</small></h2>
                                        <form id="contact-form" method="post"
                                            action="{{ route('website.updatedProfile', ['uuid' => $profile->uuid]) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="messages"></div>
                                            <div class="controls">
                                                <div class="row no-gutter">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_name">Họ và tên *</label>
                                                            <input id="form_name" type="text" name="fullname"
                                                                class="form-control" value="{{ $profile->fullname }}"
                                                                required="" data-error="fullname is required.">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_lastname">Email *</label>
                                                            <input id="form_lastname" type="text" name="email"
                                                                class="form-control" value="{{ $profile->email }}"
                                                                required="" data-error="Email is required." disabled>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row no-gutter">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_email">Sđt *</label>
                                                            <input id="form_email" type="text" name="phone"
                                                                class="form-control" placeholder="Please enter your phone *"
                                                                required="" data-error="Valid email is required."
                                                                value="{{ $profile->phone }}">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row no-gutter">
                                                    <div class="form-group">
                                                        <label for="form_message">Avatar cũ </label>
                                                        @php
                                                            $avatar = !empty($profile->avatar) ? $profile->avatar : 'default_user.png';
                                                        @endphp

                                                        <img src="{{ asset('images/users/' . $avatar) }}" width="150px">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="form_message">Avatar mới </label>
                                                        <input id="form_email" type="file" name="avatar"
                                                            class="form-control">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">Cập nhật thông
                                                                tin</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row no-gutter">
                                                    <div class="col-md-12">
                                                        <p class="text-muted"><strong>*</strong>Bắt buộc điền
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="tab-pane fade" id="history">
                                        <h3>Lịch sử</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr class="bg-1">
                                                        <th>STT</th>
                                                        <th>Tên bài viết</th>
                                                        <th>Ngày xem</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($history as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"
                                                                    style="color:#8fbc8f">{{ html_entity_decode(Str::words($item->title, 15)) }}</a>
                                                            </td>
                                                            <td>{{ $item->created_at }}</td>
                                                            <td><a
                                                                    href="{{ route('website.deleteHistory', ['uuid_history' => $item->Huuid]) }}">Delete</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="comment">
                                        <h3>Comment</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr class="bg-1">
                                                        <th>STT</th>
                                                        <th>Tên bài viết</th>
                                                        <th>Comment</th>
                                                        <th>Status</th>
                                                        <th>Day</th>
                                                        <th>Chi tiết</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($comments as $comment)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td><a href="{{ route('website.detailNew', ['uuid' => $comment->uuid]) }}"
                                                                    style="color:#8fbc8f">{{ html_entity_decode(Str::words($comment->title, 15)) }}</a>
                                                            </td>
                                                            <td>{{ $comment->comment }}</td>

                                                            <td>
                                                                    @if ($comment->status_comment == 0)
                                                                        <p> Chưa duyệt</p>  
                                                                    @elseif($comment->status_comment == 1)
                                                                        <p style="color:green">Đã duyệt</p> 
                                                                    @else
                                                                        <p style="color:red">Đã bị Chặn</p> 
                                                                    @endif

                                                            </td>
                                                            <td>{{ $comment->created_at }}</td>
                                                            <td><a
                                                                    href="{{ route('website.editComment', ['uuid' => $comment->Cuuid]) }}">Edit</a>
                                                                <a href="{{ route('website.deleteComment', ['uuid' => $comment->Cuuid]) }} "
                                                                    onclick="return confirm('Bạn có chắc muốn xóa comment ?')">Delete</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="save">
                                        <h3>Bài viết đã lưu</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr class="bg-1">
                                                        <th>STT</th>
                                                        <th>Tên bài viết</th>
                                                        <th>Day</th>
                                                        <th>Chi tiết</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($save_post as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"
                                                                    style="color:#8fbc8f">{{ html_entity_decode(Str::words($item->title, 15)) }}</a>
                                                            </td>
                                                            <td>{{ $item->created_at }}</td>
                                                            <td>
                                                                <a href="{{ route('website.deleteSavePost', ['uuid_save_post' => $item->Suuid]) }}"
                                                                    onclick="return confirm('Bạn có chắc muốn xóa bài viết đã lưu?')">Delete</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="password">
                                        <h2 class="no-margin text-bold">Cập nhật mật khẩu mới<small>Bold 20px</small></h2>
                                        <form id="contact-form" method="post"
                                            action="{{ route('website.updatedPassword', ['uuid' => $profile->uuid]) }}">
                                            @csrf
                                            <div class="messages"></div>
                                            <div class="controls">
                                                <div class="row no-gutter">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_name">Mật khẩu cũ *</label>
                                                            <input id="form_name" type="password" name="old_password"
                                                                class="form-control"
                                                                placeholder="Please enter your firstname *" required=""
                                                                data-error="Firstname is required.">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row no-gutter">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_email">Mật khẩu mới *</label>
                                                            <input id="form_email" type="password" name="password"
                                                                class="form-control"
                                                                placeholder="Please enter your password *" required="">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row no-gutter">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_email">Nhập lại mật khẩu mới *</label>
                                                            <input id="form_email" type="password"
                                                                name="password_confirm" class="form-control"
                                                                placeholder="Please enter your password_confirm *"
                                                                required="">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row no-gutter">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">Đổi mật
                                                                khẩu</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row no-gutter">
                                                    <div class="col-md-12">
                                                        <p class="text-muted"><strong>*</strong>Bắt buộc phải điền
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <h2 class="no-margin text-bold">Cập nhật email mới<small>Bold 20px</small></h2>
                                        <form id="contact-form" method="post"
                                            action="{{ route('website.updatedEmail', ['uuid' => $profile->uuid]) }}">
                                            @csrf
                                            <div class="messages"></div>
                                            <div class="controls">
                                                <div class="row no-gutter">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_name">Email cũ *</label>
                                                            <input id="form_name" type="email" name="email_old"
                                                                class="form-control" value="{{ $profile->email }}"
                                                                disabled>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row no-gutter">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="form_email">Email mới *</label>
                                                            <input id="form_email" type="email" name="email"
                                                                class="form-control"
                                                                placeholder="Please enter your new email *"
                                                                required="">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row no-gutter">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">Cập nhật email
                                                                mới</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row no-gutter">
                                                    <div class="col-md-12">
                                                        <p class="text-muted"><strong>*</strong>Bắt buộc phải điền
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
