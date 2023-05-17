@extends('website.master')
@section('module', $new_category['data']['new_category']->name_cate)
@section('content')

    <!-- Begin .breadcrumb-line -->
    <div class="container">
        <!-- Begin .breadcrumb-line -->
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li>
                    <h5><a href="{{ route('website.index') }}">Home</a></h5>
                </li>
                <li class="active">{{ $new_category['data']['new_category']->name_cate }}</li>
            </ul>
        </div>
        <!-- End .breadcrumb-line -->
    </div>
    <!-- End .breadcrumb-line -->
    @include('website.partials.search')
    <section class="module highlight">
        <div class="container">
            <div class="row no-gutter">
                <!--========== BEGIN .COL-MD-8 ==========-->
                <div class="col-md-8">
                    <div class="module-title">
                        <h3 class="title"><span
                                class="bg-12">{{ $new_category['data']['new_category']->name_cate }}</span></h3>
                    </div>
                    <!--========== BEGIN .ARTICLE ==========-->
                    <div class="article">
                        @foreach ($new_top as $item)
                            <div class="entry-block-small">
                                <div class="entry-image"><a class="img-link"
                                        href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><img
                                            class="img-responsive img-full"
                                            @php if (substr($item->avatar, 0, 8) === "https://") {
                                                echo 'src="'. $item->avatar.'" ';
                                                } else {
                                                    echo ' src="' . asset('images/news/'.$item->avatar) . '" ';
                                                } @endphp
                                            alt=""></a></div>
                                <div class="entry-content">
                                    <h3><a
                                            href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">{{ html_entity_decode(Str::words($item->title, 12)) }}</a>
                                    </h3>
                                    <br>
                                    <div class="post-meta-elements">
                                        <div class="post-meta-date"> <i
                                                class="fa fa-calendar"></i>{{ date('d-m-Y ', strtotime($item->created_at)) }}
                                        </div>
                                    </div>
                                    <p><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"
                                            class="external-link">{{ Str::words($item->intro, 15) }}</a></p>
                                    <div> <a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><span
                                                class="read-more">Continue reading</span></a> </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--========== END ARTICLE ==========-->
                </div>
                <!--========== END.COL-MD-8 ==========-->
                <!--========== BEGIN .COL-MD-4 ==========-->
                <div class="col-md-4">
                    <!-- Begin .block-title-2 -->
                    <div class="block-title-2">
                        <h3><strong>Tin tức xem nhiều</strong></h3>
                    </div>
                    <!-- End .block-title-2 -->
                    <!--========== BEGIN .SIDEBAR-NEWSFEED ==========-->
                    <div class="sidebar-newsfeed">
                        <!-- Begin .newsfeed -->
                        <div class="newsfeed-3" >
                            <ul >
                                @foreach ($boot_new['most_views'] as $item)
                                    <li style="margin: 0px;">
                                        <div class="item">
                                            <div class="item-image"><a class="img-link"
                                                    href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><img
                                                        class="img-responsive img-full"
                                                        @php if (substr($item->avatar, 0, 8) === "https://") {
                                                            echo 'src="'. $item->avatar.'" ';
                                                            } else {
                                                                echo ' src="' . asset('images/news/'.$item->avatar) . '" ';
                                                            } @endphp
                                                        alt=""></a></div>
                                            <div class="item-content">
                                                <h4 class="ellipsis"><a
                                                        href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">{{ html_entity_decode(Str::words($item->title, 15)) }}
                                                    </a>
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
                    <!--========== END .SIDEBAR-NEWSFEED =========-->
                </div>
                <div class="col-md-12">
                    {!! $new_top->links() !!}
                </div>
                <!--========== END.COL-MD-4 ==========-->
            </div>
        </div>
    </section>
    <!--========== BEGIN .MODULE ==========-->
    <section class="module">
        <div class="container">
            <div class="row no-gutter">
                <!--========== BEGIN .COL-MD-8 ==========-->
                <div class="col-md-8">
                    <!--========== BEGIN .NEWS ==========-->
                    <div class="news">
                        <div class="module-title">
                            <h3 class="title"><span class="bg-11">Tin cùng chuyên đề</span></h3>
                        </div>
                        @foreach ($newOfSameTopic as $item)
                            <!-- Begin .item-->
                            <div class="item">
                                <div class="item-image-2"><a class="img-link" laza
                                        href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><img
                                            class="img-responsive img-full" loading="lazy"
                                            @php if (substr($item->avatar, 0, 8) === "https://") {
                                                echo 'src="'. $item->avatar.'" ';
                                                } else {
                                                    echo ' src="' . asset('images/news/'.$item->avatar) . '" ';
                                                } @endphp alt=""></a><span><a
                                            class="label-2"
                                            href="{{ route('website.category_news', ['name_cate' => Str::of($item['category']->name_cate)->slug('-'), 'uuid' => $item['category']->uuid]) }}">{{ $item['category']->name_cate }}</a></span>
                                </div>
                                <div class="item-content">
                                    <div class="title-left title-style04 underline04">
                                        <h3><a
                                                href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</strong></a>
                                        </h3>
                                    </div>
                                    <p><a
                                            href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">{{ Str::words($item->intro, 20) }}</a>
                                    </p>

                                    <div> <a href="{{ route('website.category_news', ['name_cate' => Str::of($item['category']->name_cate)->slug('-'), 'uuid' => $item['category']->uuid]) }}"
                                            target="_blank"><span
                                                class="read-more">{{ $item['category']->name_cate }}</span></a> </div>
                                </div>
                            </div>
                            <!-- End .item-->
                        @endforeach
                        
                    </div>
                    {!!$newOfSameTopic->links()!!}
                    <!--========== End .NEWS ==========-->
                </div>
                <!--========== End .COL-MD-8 ==========-->
                <!--========== BEGIN .COL-MD-4 ==========-->
                <div class="col-md-4">
                    <!-- Begin .block-title-1 -->
                    <div class="block-title-1">
                        <h3><a ><strong>Có thể bạn muốn xem</strong> </a></h3>
                    </div>
                    <!-- End .block-title-1 -->
                    <!--========== BEGIN .SIDEBAR-NEWSFEED ==========-->
                    <div class="sidebar-newsfeed">
                        <!-- Begin .newsfeed -->
                        <div class="newsfeed-3">
                            <ul>
                                @foreach ($maybeYouLike as $item)
                                    <li>
                                        <div class="item">
                                            <div class="item-image"><a class="img-link"
                                                    href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><img
                                                        class="img-responsive img-full"  loading="lazy"
                                                        @php if (substr($item->avatar, 0, 8) === "https://") {
                                                            echo 'src="'. $item->avatar.'" ';
                                                            } else {
                                                                echo ' src="' . asset('images/news/'.$item->avatar) . '" ';
                                                            } @endphp
                                                        alt=""></a></div>
                                            <div class="item-content">
                                                <h4 class="ellipsis"><a
                                                        href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">{{ html_entity_decode(Str::words($item->title, 15)) }}</a>
                                                </h4>
                                                <p class="ellipsis"><a
                                                        href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">{{ Str::words($item->intro, 15) }}</a>
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
    @include('website.partials.copyrights')
@endsection
