@extends('website.master')
@section('module', html_entity_decode($detail_new->title))
@section('image_new', $detail_new->avatar)
@section('title', $detail_new->title)
@section('content')
    @include('website.partials.search')
    <div id="main-section">
        <div class="container header_category">
            <!-- Begin .breadcrumb-line -->
            <div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li>
                        <h5><a
                                href="{{ route('website.category_news', ['name_cate' => Str::of($category_header['category']->name_cate)->slug('-'), 'uuid' => $category_header['category']->uuid]) }}">{{ $category_header['category']->name_cate }}</a>
                        </h5>
                    </li>
                    <li class="active">{{ $category_header['category_child']->name_cate }}</li>
                </ul>
            </div>
            <!-- End .breadcrumb-line -->
        </div>
        <!--========== BEGIN .MODULE ==========-->
        <section class="module">

            <div class="container">
                <!--========== BEGIN .ROW ==========-->
                <div class="row no-gutter">
                    <!--========== BEGIN .COL-MD-8 ==========-->
                    <div class="col-md-8">
                        <!--========== BEGIN .POST ==========-->
                        <div class="post post-full clearfix title_new">
                            <div class="entry-title">
                                <h2 class="entry-title">{{ html_entity_decode($detail_new->title) }}</h2>
                            </div>
                            <div class="entry-main">
                                <div class="post-meta-elements">
                                    <div class="post-meta-author"> <i class="fa fa-user"></i><a>By
                                            {{ $detail_new->author }}</a> </div>
                                    <div class="post-meta-date"> <i
                                            class="fa fa-calendar"></i>{{ date('d-m-Y h:i A', strtotime($detail_new->created_at)) }}
                                    </div>
                                    <div class="post-meta-comments"><i class="fa-regular fa-comment"></i>
                                        {{ $count_comment }}
                                        Comments
                                    </div>
                                    <div class="post-meta-comments"> <i class="fas fa-eye"></i>
                                        {{ $detail_new->new_view }} views
                                    </div>
                                    {{-- save post --}}
                                    @if (!Auth::user())
                                        <a href="{{ route('website.checkUser') }}"><i class="fa-regular fa-bookmark"></i>
                                            @else
                                                @php
                                                    $userSave = \DB::table('save_post')
                                                        ->where('uuid_post', $detail_new->uuid)
                                                        ->where('user_uuid', Auth::user()->uuid)
                                                        ->exists();
                                                @endphp
                                                <div class="post-meta-comments">
                                                    @if ($userSave)
                                                        <a href="#"
                                                            onclick="deleteSavePost('{{ $detail_new->uuid }}')"><i
                                                                class="fa-sharp fa-solid fa-bookmark"></i></a>
                                                    @else
                                                        <a href="#" onclick="savePost('{{ $detail_new->uuid }}')"><i
                                                                class="fa-regular fa-bookmark"></i></a>
                                                    @endif
                                                </div>
                                    @endif
                                </div>
                            </div>
                            <div class="entry-main">
                                <div class="entry-content">
                                    <p>
                                    <h3>{{ $detail_new->intro }}</h3>
                                    </p>
                                    <p>{!! $detail_new->content !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="comment-section">
                            <h4>Chia sẻ bài viết</h4>
                            <div class="social-btn-sp">
                                {!! $shareButtons !!}
                            </div>
                        </div>
                        <!--  End .post -->

                        <!--  Begin .comment-section -->
                        <div class="comment-section">
                            <!-- Begin .title-style01 -->
                            <div class="comment-title title-style01">
                                <h4>{{ $count_comments }} Comments</h4>
                            </div>
                            <!-- End .title-style01 -->
                            <ul class="comments-list">
                                @foreach ($comments_user as $comment)
                                    <li>
                                        <div class="comment clearfix">
                                            @php
                                                $avatar = !empty($comment->avatar) ? $comment->avatar : 'default_user.png';
                                            @endphp
                                            <div class="avatar"><img src="{{ asset('images/users/' . $avatar) }}"
                                                    alt="avatar" class="img-responsive"></div>
                                            <div class="comment-content">
                                                <div class="comment-title">
                                                    <h5 class="comment-author">{{ $comment->fullname }}</h5>
                                                    <div class="comment-date"><i class="fa fa-calendar"></i><span
                                                            class="day">{{ date('d-m-Y h:i A', strtotime($comment->created_at)) }}</span>
                                                    </div>
                                                </div>
                                                <p>{{ $comment->comment }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="comment-section">
                            {!! $comments_user->links() !!}
                        </div>
                        <!--  End .comment-section -->
                        <!--  Begin .form-reply-section -->

                        <div class="form-reply-section">
                            <div class="comment-title title-style01">
                                <h4>leave a reply</h4>
                            </div>
                            <form class="form-reply ui-form"
                                action="{{ route('website.postComment', ['uuidOfNew' => $detail_new->uuid]) }}"
                                method="post">
                                @csrf
                                <div class="row no-gutter">
                                    <div class="col-md-12">
                                        <textarea rows="5" placeholder="Comment" class="form-control" name="comments" title="Comment"></textarea>
                                    </div>
                                </div>
                                <div class="row no-gutter">
                                    <div class="col-md-12">
                                        @if (Auth::user())
                                            <button class="btn btn-primary btn-black" type="submit">Post Comment</button>
                                        @endif
                                        @if (!Auth::user())
                                            <div class="cart_button">
                                                <a class="btn btn-primary btn-black" type="button"
                                                    href="{{ route('website.checkUser') }}">Post
                                                    Comment</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--  End .form-reply-section -->
                    </div>
                    <!--========== END .COL-MD-8 ==========-->
                    <!--========== BEGIN .COL-MD-4==========-->
                    <div class="col-md-4">
                        <div class="title-style02">
                            <h3><strong>Có thể bạn muốn đọc</strong> </h3>
                        </div>
                        <!-- End .title-style02 -->
                        <div class="sidebar-post detail-post-you-like">
                            <ul>
                                @foreach ($maybeYouLike as $item)
                                    <li>
                                        <div class="item">
                                            <div class="item-image"><a class="img-link"
                                                    href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><img
                                                        class="img-responsive img-full"
                                                        @php if (substr($item->avatar, 0, 8) === "https://")
                                                        {
                                                        echo 'src="'. $item->avatar.'"';
                                                        } else {
                                                        echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                        } @endphp
                                                        alt=""></a></div>
                                            <div class="item-content">
                                                <p><a
                                                        href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}">{{ html_entity_decode(Str::words($item->title, 10)) }}</a>
                                                </p>
                                                <p><a>{{ date('d.m.Y ', strtotime($item->created_at)) }}</a></p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--========== END .SIDEBAR-POST ==========-->

                    </div>
                    <!--========== END .COL-MD-4 ==========-->
                </div>
            </div>
            <!--========== END .CONTAINER ==========-->
        </section>
        <!--========== END .MODULE ==========-->
        {{-- tin cùng chuyên mục --}}
        <section class="module highlight">
            <div class="container">
                <div class="row no-gutter">
                    <!--========== BEGIN .COL-MD-8 ==========-->
                    <div class="col-md-12">
                        <div class="module-title">
                            <h3 class="title"><span class="bg-1">Tin tức cùng chuyên mục</span></h3>
                        </div>
                        <!--========== BEGIN .NEWS ==========-->
                        <div class="news">
                            <div class="news-block">
                                @foreach ($featured_posts as $item)
                                    <div class="item-block">
                                        <div class="item-image"><a class="img-link"
                                                href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><img
                                                    class="img-responsive img-full"
                                                    @php if (substr($item->avatar, 0, 8)
                                                    === "https://") {
                                                    echo 'src="'. $item->avatar.'"';
                                                    } else {
                                                    echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                    } @endphp
                                                    loading="lazy" alt=""></a></div>
                                        <div class="item-content">
                                            <p><a href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"
                                                    class="external-link"><strong>{{ $item['category']->name_cate }}
                                                        -</strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</a>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--========== END .NEWS ==========-->
                    </div>
                    <!--========== END .COL-MD-8 ==========-->
                </div>
            </div>
        </section>
        <section class="module">
            <div class="container">
                <div class="row no-gutter">
                    <!--========== BEGIN .COL-MD-8 ==========-->
                    <div class="col-md-8">
                        <!--========== BEGIN .NEWS ==========-->
                        <div class="news">
                            <div class="module-title">
                                <h3 class="title"><span class="bg-11">Xem thêm</span></h3>
                            </div>
                            @foreach ($readMore as $item)
                                <!-- Begin .item-->
                                <div class="item">
                                    <div class="item-image-2"><a class="img-link"
                                            href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><img
                                                class="img-responsive img-full" loading="lazy"
                                                @php if (substr($item->avatar, 0, 8) === "https://")
                                    {
                                    echo 'src="'. $item->avatar.'"';
                                    } else {
                                    echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                    } @endphp
                                                alt=""></a><span><a class="label-2"
                                                href="{{ route('website.category_news', ['name_cate' => Str::of($item['category']->name_cate)->slug('-'), 'uuid' => $item['category']->uuid]) }}">{{ $item['category']->name_cate }}</a></span>
                                    </div>
                                    <div class="item-content">
                                        <div class="title-left title-style04 underline04">
                                            <h3><a
                                                    href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</strong>
                                                </a></h3>
                                        </div>
                                        <p> <i class="fa fa-clock-o"></i> <span
                                                class="date"><strong>{{ date('d-m-Y', strtotime($item->created_at)) }}</strong></span>
                                            <strong>{{ date('H:i A', strtotime($item->created_at)) }}</strong>
                                        </p>
                                        <p><a
                                                href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}">
                                                {{ Str::words($item->intro, 20) }}</a></p>

                                        <div> <a href="{{ route('website.category_news', ['name_cate' => Str::of($item['category']->name_cate)->slug('-'), 'uuid' => $item['category']->uuid]) }}"
                                                target="_blank"><span
                                                    class="read-more">{{ $item['category']->name_cate }}</span></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End .item-->
                            @endforeach

                        </div>
                        <div class="button-load-more"><a
                                href="{{ route('website.category_news', ['name_cate' => Str::of($detail_new['category']->name_cate)->slug('-'), 'uuid' => $detail_new['category']->uuid]) }}"
                                type="button" class="btn btn-default active">Xem thêm</a></div>
                        <!--========== End .NEWS ==========-->
                    </div>
                    <!--========== End .COL-MD-8 ==========-->
                </div>
            </div>
        </section>

    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.post-meta-comments a', function(event) {
                event.preventDefault();
                var uuid = '{{ $detail_new->uuid }}';
                if ($(this).find('i').hasClass('fa-regular')) {
                    savePost(uuid);
                } else {
                    deleteSavePost(uuid);
                }
            });
        });

        function savePost(uuid) {
            $.ajax({
                url: '{{ route('website.savePost', ['uuid' => $detail_new->uuid]) }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.post-meta-comments a i').removeClass('fa-regular fa-bookmark').addClass(
                        'fa-solid fa-bookmark');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function deleteSavePost(uuid) {
            $.ajax({
                url: '/deleteSavePost/' + uuid,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.post-meta-comments a i').removeClass('fa-solid fa-bookmark').addClass(
                        'fa-regular fa-bookmark');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>

    @include('website.partials.copyrights')
@endsection
