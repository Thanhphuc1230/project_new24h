@extends('website.master')
@section('module', 'Trang chủ')
@section('content')
    @include('website.partials.search')
    <section class="module highlight">
        <div class="container">
            <div class="module-title">
                <h3 class="title"><span class="bg-1">Hot news</span></h3>
            </div>
            <!--========== BEGIN .ROW ==========-->
            <div class="row no-gutter">
                <!--========== BEGIN .COL-MD-6 ==========-->
                <div class="col-sm-6 col-md-6">
                    <!--========== BEGIN .NEWS ==========-->
                    <div class="news">
                        <!-- Begin .item -->
                        @foreach ($breaking_news_left as $item)
                            <div class="item">
                                <div class="item-image-1"><a class="img-link"
                                        href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><img
                                            class="img-responsive img-full"
                                            @php if (substr($item->avatar, 0, 8) === "https://")
                                {
                                echo 'src="'. $item->avatar.'"';
                                } else {
                                echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                } @endphp
                                            alt=""></a><span><a class="label-5"
                                            href="{{ route('website.category_news', ['name_cate' => Str::of($item['category']->name_cate)->slug('-'), 'uuid' => $item['category']->uuid]) }}">{{ $item['category']->name_cate }}</a></span>
                                </div>
                                <div class="item-content">
                                    <div class="title-left title-style04 underline04">
                                        <h3><a
                                                href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}
                                                </strong></a>
                                        </h3>
                                    </div>
                                    <p><a href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"
                                            class="external-link">{{ Str::words($item->intro, 15) }}</a>
                                    </p>
                                    <div><a
                                            href="{{ route('website.category_news', ['name_cate' => Str::of($item['category']->name_cate)->slug('-'), 'uuid' => $item['category']->uuid]) }}"><span
                                                class="read-more">{{ $item['category']->name_cate }}</span></a></div>
                                </div>
                            </div>
                        @endforeach
                        <!-- End .item -->
                    </div>
                    <!--========== END .NEWS ==========-->
                </div>
                <!--========== END .COL-MD-6 ==========-->
                <!--========== BEGIN .COL-MD-6 ==========-->
                <div class="col-sm-6 col-md-6">
                    <!--========== BEGIN .NEWS==========-->
                    <div class="news">
                        <!-- Begin .item-->
                        @foreach ($breaking_news_right as $item)
                            <div class="item">
                                <div class="item-image-1"><a class="img-link"
                                        href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><img
                                            class="img-responsive img-full" loading="lazy"
                                            @php if (substr($item->avatar, 0, 8) === "https://")
                                {
                                echo 'src="'. $item->avatar.'"';
                                } else {
                                echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                } @endphp
                                            alt=""></a><span><a class="label-5"
                                            href="{{ route('website.category_news', ['name_cate' => Str::of($item['category']->name_cate)->slug('-'), 'uuid' => $item['category']->uuid]) }}">{{ $item['category']->name_cate }}</a></span>
                                </div>
                                <div class="item-content">
                                    <div class="title-left title-style04 underline04">
                                        <h3><a
                                                href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}
                                                </strong></a>
                                        </h3>
                                    </div>
                                    <p><a href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"
                                            class="external-link">{{ Str::words($item->intro, 15) }}</a>
                                    </p>
                                    <div><a
                                            href="{{ route('website.category_news', ['name_cate' => Str::of($item['category']->name_cate)->slug('-'), 'uuid' => $item['category']->uuid]) }}"><span
                                                class="read-more">{{ $item['category']->name_cate }}</span></a></div>
                                </div>
                            </div>
                            <!-- End .item-->
                        @endforeach
                    </div>
                    <!--========== END .NEWS ==========-->
                </div>
                <div class="col-md-12 button-load-more">
                    <a href={{ route('website.hotNews') }} type="button" class="btn btn-default active">Xem tin mới
                        nhất</a>
                </div>
                <!--========== END .COL-MD-6 ==========-->
            </div>
        </div>
    </section>
    <!--========== END .MODULE ==========-->
    <!--========== BEGIN .MODULE ==========-->
    {{-- Nation --}}
    <section class="module">
        <div class="container">
            <div class="row no-gutter">
                <!--========== BEGIN .COL-MD-8 ==========-->
                <div class="col-md-8">
                    <!--========== BEGIN .NEWS ==========-->
                    <div class="news">
                        <div class="module-title">
                            <h3 class="title"><span class="bg-11"> Thế Giới</span></h3>
                        </div>
                        @foreach ($nation_news as $item)
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
                            href="{{ route('website.category_news', ['name_cate' => Str::of($new_header[1]->name_cate)->slug('-'), 'uuid' => $new_header[1]->uuid]) }}"
                            type="button" class="btn btn-default active">Xem thêm</a></div>
                    <!--========== End .NEWS ==========-->
                </div>
                <!--========== End .COL-MD-8 ==========-->
                <!--========== BEGIN .COL-MD-4 ==========-->
                <div class="col-md-4">

                    <!-- Begin .block-title-1 -->
                    <div class="block-title-1">
                        <h3><strong>Top tin tức</strong></h3>
                    </div>
                    <!-- End .block-title-1 -->
                    <!--========== BEGIN .SIDEBAR-NEWSFEED ==========-->
                    <div class="sidebar-newsfeed">
                        <!-- Begin .newsfeed -->
                        <div class="newsfeed-3">
                            <ul>
                                @foreach ($boot_new['most_views'] as $item)
                                    <li>
                                        <div class="item">
                                            <div class="item-image"><a class="img-link"
                                                    href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><img
                                                        class="img-responsive img-full" loading="lazy"
                                                        @php if (substr($item->avatar, 0, 8) ===
                                            "https://") {
                                            echo 'src="'. $item->avatar.'"';
                                            } else {
                                            echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                            } @endphp
                                                        alt=""></a>
                                            </div>
                                            <div class="item-content">
                                                <h4 class="ellipsis"><a
                                                        href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}">{{ html_entity_decode($item->title) }}</a>
                                                </h4>
                                                <p class="ellipsis"><i class="fas fa-eye"></i> {{ $item->new_view }} views
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <!-- End .newsfeed -->
                    </div>
                    <!--========== END .SIDEBAR-NEWSFEED ==========-->
                </div>
                <!--========== END .COL-MD-4 ==========-->
            </div>
        </div>
    </section>
   
    <section class="module highlight">
        <div class="container">
            <div class="row no-gutter">
                <!--========== BEGIN .COL-MD-8 ==========-->
                <div class="col-md-8">
                    <div class="module-title">
                        <h3 class="title"><span class="bg-12">Pháp Luật</span></h3>
                    </div>
                    <!--========== BEGIN .NEWS ==========-->
                    <div class="news">
                        <!-- Begin .item -->
                        @if (count($law_news) > 0)
                            <div class="item">
                                <div class="item-image-1"><a class="img-link"
                                        href="{{ route('website.detailNew', ['name_post' => Str::of($law_news[0]->title)->slug('-'), 'uuid' => $law_news[0]->uuid]) }}"><img
                                            class="img-responsive img-full"
                                            @php if (substr($law_news[0]->avatar, 0, 8) === "https://")
                                                {
                                                echo 'src="'. $law_news[0]->avatar.'"';
                                                } else {
                                                echo 'src="' . asset('images/news/'.$law_news[0]->avatar) . '" ';
                                                } @endphp
                                            alt=""></a></div>
                                <div class="item-content">
                                    <div class="title-left title-style04 underline04">
                                        <h3><a
                                                href="{{ route('website.detailNew', ['name_post' => Str::of($law_news[0]->title)->slug('-'), 'uuid' => $law_news[0]->uuid]) }}"><strong>{{ html_entity_decode($law_news[0]->title) }}</strong></a>
                                        </h3>
                                        <br>
                                        <div class="post-meta-elements">
                                            <div class="post-meta-author"> <i
                                                    class="fa fa-user"></i><a>{{ $law_news[0]->author }}</a> </div>
                                            <div class="post-meta-date"> <i
                                                    class="fa fa-calendar"></i>{{ date('d.m.Y | H:i A', strtotime($law_news[0]->created_at)) }}
                                            </div>
                                        </div>
                                    </div>
                                    <p><a href="{{ route('website.detailNew', ['name_post' => Str::of($law_news[0]->title)->slug('-'), 'uuid' => $law_news[0]->uuid]) }}"
                                            class="external-link"><strong>{{ Str::words($law_news[0]->intro, 20) }}</strong></a>
                                    </p>
                                    <div> <a
                                            href="{{ route('website.detailNew', ['name_post' => Str::of($law_news[0]->title)->slug('-'), 'uuid' => $law_news[0]->uuid]) }}"><span
                                                class="read-more">Continue reading</span></a> </div>
                                </div>
                            </div>
                            <!-- End .item -->
                            <div class="news-block">
                                @foreach ($law_news as $key => $item)
                                    @if ($key !== 0)
                                        <div class="item-block">
                                            <div class="item-image"><a class="img-link"
                                                    href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><img
                                                        class="img-responsive img-full" loading="lazy"
                                                        @php if (substr($item->avatar, 0, 8) ===
                                                    "https://") {
                                                    echo 'src="'. $item->avatar.'"';
                                                    } else {
                                                    echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                    } @endphp
                                                        alt=""></a></div>
                                            <div class="item-content">
                                                <p><span
                                                        class="day">{{ date('d/m/Y ', strtotime($item->created_at)) }}</span>
                                                </p>
                                                <p><a href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"
                                                        class="external-link"><strong>{{ $item['category']->name_cate }}-</strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        <div class="button-load-more"><a href="{{ route('website.category_news',['name_cate'=> Str::of($new_header[0]->name_cate)->slug('-'),'uuid'=>$new_header[0]->uuid]) }}" type="button"
                            class="btn btn-default active">Xem thêm</a></div>
                    </div>
                    <!--========== END .NEWS ==========-->
                    <div class="module-title">
                        <h3 class="title"><span class="bg-12">Kinh doanh</span></h3>
                    </div>
                    <!--========== BEGIN .NEWS ==========-->
                    <div class="news">
                        <!-- Begin .item -->
                        @if (count($business_news) > 0)
                            <div class="item">
                                <div class="item-image-1"><a class="img-link"
                                        href="{{ route('website.detailNew', ['name_post' => Str::of($business_news[0]->title)->slug('-'), 'uuid' => $law_news[0]->uuid]) }}"><img
                                            class="img-responsive img-full"
                                            @php if (substr($business_news[0]->avatar, 0, 8) === "https://")
                                                {
                                                echo 'src="'. $business_news[0]->avatar.'"';
                                                } else {
                                                echo 'src="' . asset('images/news/'.$business_news[0]->avatar) . '" ';
                                                } @endphp
                                            alt=""></a></div>
                                <div class="item-content">
                                    <div class="title-left title-style04 underline04">
                                        <h3><a
                                                href="{{ route('website.detailNew', ['name_post' => Str::of($business_news[0]->title)->slug('-'), 'uuid' => $business_news[0]->uuid]) }}"><strong>{{ html_entity_decode($business_news[0]->title) }}</strong></a>
                                        </h3>
                                        <br>
                                        <div class="post-meta-elements">
                                            <div class="post-meta-author"> <i
                                                    class="fa fa-user"></i><a>{{ $business_news[0]->author }}</a> </div>
                                            <div class="post-meta-date"> <i
                                                    class="fa fa-calendar"></i>{{ date('d.m.Y | H:i A', strtotime($business_news[0]->created_at)) }}
                                            </div>
                                        </div>
                                    </div>
                                    <p><a href="{{ route('website.detailNew', ['name_post' => Str::of($business_news[0]->title)->slug('-'), 'uuid' => $business_news[0]->uuid]) }}"
                                            class="external-link"><strong>{{ Str::words($business_news[0]->intro, 20) }}</strong></a>
                                    </p>
                                    <div> <a
                                            href="{{ route('website.detailNew', ['name_post' => Str::of($business_news[0]->title)->slug('-'), 'uuid' => $business_news[0]->uuid]) }}"><span
                                                class="read-more">Continue reading</span></a> </div>
                                </div>
                            </div>
                            <!-- End .item -->
                            <div class="news-block">
                                @foreach ($business_news as $key => $item)
                                    @if ($key !== 0)
                                        <div class="item-block">
                                            <div class="item-image"><a class="img-link"
                                                    href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><img
                                                        class="img-responsive img-full" loading="lazy"
                                                        @php if (substr($item->avatar, 0, 8) ===
                                                    "https://") {
                                                    echo 'src="'. $item->avatar.'"';
                                                    } else {
                                                    echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                    } @endphp
                                                        alt=""></a></div>
                                            <div class="item-content">
                                                <p><span
                                                        class="day">{{ date('d/m/Y ', strtotime($item->created_at)) }}</span>
                                                </p>
                                                <p><a href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"
                                                        class="external-link"><strong>{{ $item['category']->name_cate }}-</strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        <div class="button-load-more"><a href="{{ route('website.category_news',['name_cate'=> Str::of($new_header[1]->name_cate)->slug('-'),'uuid'=>$new_header[1]->uuid]) }}" type="button"
                            class="btn btn-default active">Xem thêm</a></div>
                    </div>
                    <!--========== END .NEWS ==========-->
                </div>
                <!--========== END .COL-MD-8 ==========-->
                <!--========== BEGIN .COL-MD-4 ==========-->
                <div class="col-md-4">
                    <!--========== BEGIN .TABS ==========-->
                    <div class="sidebar-tabs">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="tabbable">
                                    <!-- Begin .nav nav-tabs -->
                                    <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                                        <li class="active"><a href="#solid-justified-tab1" data-toggle="tab">Văn Hóa</a>
                                        </li>
                                        <li><a href="#solid-justified-tab2" data-toggle="tab">Du lịch</a></li>
                                        <li><a href="#solid-justified-tab3" data-toggle="tab">Sức khỏe</a></li>
                                    </ul>
                                    <!-- End .nav nav-tabs -->
                                    <div class="tab-content">
                                        <!-- Begin #tab1 -->
                                        <div class="tab-pane active" id="solid-justified-tab1">
                                            <ul>
                                                @foreach ($boot_new['culture_news'] as $item)
                                                    <li><a
                                                            href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}">
                                                            <div class="img-responsive"><img loading="lazy"
                                                                    @php if (substr($item->avatar, 0, 8) === "https://")
                                                                        {
                                                                        echo 'src="'. $item->avatar.'"';
                                                                        } else {
                                                                        echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                                        } @endphp
                                                                    height="56px" alt=""></div>
                                                            <p>{{ html_entity_decode(Str::words($item->title, 10)) }}</p>
                                                            <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                                        </a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                        <!-- End #tab1 -->
                                        <!-- Begin #tab2 -->
                                        <div class="tab-pane" id="solid-justified-tab2">
                                            <ul>
                                                @foreach ($boot_new['travel_news'] as $item)
                                                    <li><a
                                                            href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}">
                                                            <div class="img-responsive"><img loading="lazy"
                                                                    @php if (substr($item->avatar, 0, 8) === "https://")
                                                                {
                                                                echo 'src="'. $item->avatar.'"';
                                                                } else {
                                                                echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                                } @endphp
                                                                    height="56px" alt=""></div>
                                                            <p>{{ html_entity_decode(Str::words($item->title, 10)) }}</p>
                                                            <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                                        </a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- End #tab2 -->
                                        <!-- Begin #tab3 -->
                                        <div class="tab-pane" id="solid-justified-tab3">
                                            <ul>
                                                @foreach ($boot_new['health_news'] as $item)
                                                    <li><a
                                                            href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}">
                                                            <div class="img-responsive"><img loading="lazy"
                                                                    @php if (substr($item->avatar, 0, 8) === "https://")
                                                                {
                                                                echo 'src="'. $item->avatar.'"';
                                                                } else {
                                                                echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                                } @endphp
                                                                    height="56px" alt=""></div>
                                                            <p>{{ html_entity_decode(Str::words($item->title, 10)) }}</p>
                                                            <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                                        </a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- End #tab3 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-tabs">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="tabbable">
                                    <!-- Begin .nav nav-tabs -->
                                    <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                                        <li class="active"><a href="#solid-justified-tabCN" data-toggle="tab">Công
                                                nghệ</a>
                                        </li>
                                        <li><a href="#solid-justified-tabTT" data-toggle="tab">Thể thao</a></li>
                                        <li><a href="#solid-justified-tabGT" data-toggle="tab">Giải trí</a></li>
                                    </ul>
                                    <!-- End .nav nav-tabs -->
                                    <div class="tab-content">
                                        <!-- Begin #tab1 -->
                                        <div class="tab-pane active" id="solid-justified-tabCN">
                                            <ul>
                                                @foreach ($boot_new['technology_news'] as $item)
                                                    <li><a
                                                            href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}">
                                                            <div class="img-responsive"><img loading="lazy"
                                                                    @php if (substr($item->avatar, 0, 8) === "https://")
                                                                        {
                                                                        echo 'src="'. $item->avatar.'"';
                                                                        } else {
                                                                        echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                                        } @endphp
                                                                    height="56px" alt=""></div>
                                                            <p>{{ html_entity_decode(Str::words($item->title, 10)) }}</p>
                                                            <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                                        </a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- End #tab1 -->
                                        <!-- Begin #tab2 -->
                                        <div class="tab-pane" id="solid-justified-tabTT">
                                            <ul>
                                                @foreach ($boot_new['sport_news'] as $item)
                                                    <li><a
                                                            href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}">
                                                            <div class="img-responsive"><img loading="lazy"
                                                                    @php if (substr($item->avatar, 0, 8) === "https://")
                                                                {
                                                                echo 'src="'. $item->avatar.'"';
                                                                } else {
                                                                echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                                } @endphp
                                                                    height="56px" alt=""></div>
                                                            <p>{{ html_entity_decode(Str::words($item->title, 10)) }}</p>
                                                            <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                                        </a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- End #tab2 -->
                                        <!-- Begin #tab3 -->
                                        <div class="tab-pane" id="solid-justified-tabGT">
                                            <ul>
                                                @foreach ($boot_new['entertainment_news'] as $item)
                                                    <li><a
                                                            href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}">
                                                            <div class="img-responsive"><img loading="lazy"
                                                                    @php if (substr($item->avatar, 0, 8) === "https://")
                                                                {
                                                                echo 'src="'. $item->avatar.'"';
                                                                } else {
                                                                echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                                } @endphp
                                                                    height="56px" alt=""></div>
                                                            <p>{{ html_entity_decode(Str::words($item->title, 10)) }}</p>
                                                            <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                                        </a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- End #tab3 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--========== END .TABS ==========-->
                </div>
                <!--========== END .COL-MD-4 ==========-->
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
                            <h3 class="title"><span class="bg-11">Thời sự</span></h3>
                        </div>
                        @foreach ($boot_new['local_news'] as $item)
                            <!-- Begin .item-->
                            <div class="item">
                                <div class="item-image-2"><a class="img-link"
                                        href="{{ route('website.detailNew', ['name_post'=>Str::of($item->title)->slug('-'),'uuid' => $item->uuid]) }}"><img
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
                                        <h3><a href="{{ route('website.detailNew', ['name_post'=>Str::of($item->title)->slug('-'),'uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</strong>
                                            </a></h3>
                                    </div>
                                    <p> <i class="fa fa-clock-o"></i> <span
                                        class="date"><strong>{{ date('d-m-Y', strtotime($item->created_at)) }}</strong></span>
                                    <strong>{{ date('H:i A', strtotime($item->created_at)) }}</strong></p>
                                    <p><a href="{{ route('website.detailNew', ['name_post'=>Str::of($item->title)->slug('-'),'uuid' => $item->uuid]) }}">
                                            {{Str::words($item->intro, 20) }}</a></p>
    
                                    <div> <a href="{{ route('website.category_news', ['name_cate' => Str::of($item['category']->name_cate)->slug('-'), 'uuid' => $item['category']->uuid]) }}"
                                            target="_blank"><span
                                                class="read-more">{{ $item['category']->name_cate }}</span></a>
                                    </div>
                                </div>
                            </div>
                            <!-- End .item-->
                        @endforeach
    
                    </div>
                    <div class="button-load-more"><a href="{{ route('website.category_news',['name_cate'=> Str::of($new_header[0]->name_cate)->slug('-'),'uuid'=>$new_header[0]->uuid]) }}" type="button"
                        class="btn btn-default active">Xem thêm</a></div>
                    <!--========== End .NEWS ==========-->
                </div>
                <!--========== End .COL-MD-8 ==========-->
              
            </div>
        </div>
    </section>
    @include('website.partials.copyrights')
@endsection
