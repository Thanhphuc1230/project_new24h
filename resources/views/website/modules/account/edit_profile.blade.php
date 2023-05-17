@extends('website.master')
@section('module', 'Profile')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="container">
                <div class="title-style01">
                    <h3><strong>Get</strong> In Touch</h3>
                </div>
                <form id="contact-form" method="post" action="{{ route('website.updatedComment', ['uuid' => $comment_user->Cuuid]) }}">
                    @csrf
                    <div class="messages"></div>
                    <div class="controls">
                        <div class="row no-gutter">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Tên bài viết *</label>
                                    <input id="form_name" type="text" class="form-control" value="{{$comment_user->title}}" disabled>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_lastname">Thời gian comment </label>
                                    <input id="form_lastname" type="text"class="form-control"
                                        value="{{$comment_user->created_at}}" disabled>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutter">
                            <div class="form-group">
                                <label for="form_message">Nội dung comment *</label>
                                <textarea id="form_message" name="comment" class="form-control" placeholder="Message for me *" rows="4"
                                    required="" data-error="Please,leave us a message.">{{$comment_user->comment}}</textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-success btn-send" value="Chỉnh sửa comment">
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutter">
                            <div class="col-md-12">
                                <p class="text-muted"><strong>*</strong> These fields are required.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
