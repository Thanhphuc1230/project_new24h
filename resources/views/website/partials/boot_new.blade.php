<section class="module">
    <div class="container">
        <div class="row no-gutter">
            <!--========== BEGIN .COL-MD-8 ==========-->
            <div class="col-md-8">
                <!--========== BEGIN .NEWS ==========-->
                <div class="news">
                    <div class="module-title">
                        <h3 class="title"><span class="bg-11">Thời sự</span></h3>
                        <h3 class="subtitle">Tin tức mới nhất</h3>
                    </div>
                    @foreach ($boot_new['local_news'] as $item)
                        <!-- Begin .item-->
                        <div class="item">
                            <div class="item-image-2"><a class="img-link"
                                    href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><img
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
                                    <h3><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</strong>
                                        </a></h3>
                                </div>
                                <p> <i class="fa fa-clock-o"></i> <span
                                    class="date"><strong>{{ date('d-m-Y', strtotime($item->created_at)) }}</strong></span>
                                <strong>{{ date('H:i A', strtotime($item->created_at)) }}</strong></p>
                                <p><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">
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
<section class="module">
    <div class="container">
        <div class="row no-gutter">
            <!--========== BEGIN .COL-MD-8 ==========-->
            <div class="col-md-8">
                <!--========== BEGIN .NEWS ==========-->
                <div class="news">
                    <div class="module-title">
                        <h3 class="title"><span class="bg-11">Công nghệ</span></h3>
                        <h3 class="subtitle">Tin tức mới nhất</h3>
                    </div>
                    @foreach ($boot_new['technology_news'] as $item)
                        <!-- Begin .item-->
                        <div class="item">
                            <div class="item-image-2"><a class="img-link"
                                    href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><img
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
                                    <h3><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</strong>
                                        </a></h3>
                                </div>
                                <p> <i class="fa fa-clock-o"></i> <span
                                    class="date"><strong>{{ date('d-m-Y', strtotime($item->created_at)) }}</strong></span>
                                <strong>{{ date('H:i A', strtotime($item->created_at)) }}</strong></p>
                                <p><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">
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
                <div class="button-load-more"><a href="{{ route('website.category_news',['name_cate'=> Str::of($new_header[4]->name_cate)->slug('-'),'uuid'=>$new_header[4]->uuid]) }}" type="button"
                    class="btn btn-default active">Xem thêm</a></div>
                <!--========== End .NEWS ==========-->
            </div>
            <!--========== End .COL-MD-8 ==========-->
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
                        <h3 class="title"><span class="bg-11">Du lịch</span></h3>
                        <h3 class="subtitle">Tin tức mới nhất</h3>
                    </div>
                    @foreach ($boot_new['travel_news'] as $item)
                        <!-- Begin .item-->
                        <div class="item">
                            <div class="item-image-2"><a class="img-link"
                                    href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><img
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
                                    <h3><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</strong>
                                        </a></h3>
                                </div>
                                <p> <i class="fa fa-clock-o"></i> <span
                                    class="date"><strong>{{ date('d-m-Y', strtotime($item->created_at)) }}</strong></span>
                                <strong>{{ date('H:i A', strtotime($item->created_at)) }}</strong></p>
                                <p><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">
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
                <div class="button-load-more"><a href="{{ route('website.category_news',['name_cate'=> Str::of($new_header[5]->name_cate)->slug('-'),'uuid'=>$new_header[5]->uuid]) }}" type="button"
                    class="btn btn-default active">Xem thêm</a></div>
                <!--========== End .NEWS ==========-->
            </div>
            <!--========== End .COL-MD-8 ==========-->
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
                        <h3 class="title"><span class="bg-11">Sức khỏe</span></h3>
                        <h3 class="subtitle">Tin tức mới nhất</h3>
                    </div>
                    @foreach ($boot_new['health_news'] as $item)
                        <!-- Begin .item-->
                        <div class="item">
                            <div class="item-image-2"><a class="img-link"
                                    href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><img
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
                                    <h3><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</strong>
                                        </a></h3>
                                </div>
                                <p> <i class="fa fa-clock-o"></i> <span
                                    class="date"><strong>{{ date('d-m-Y', strtotime($item->created_at)) }}</strong></span>
                                <strong>{{ date('H:i A', strtotime($item->created_at)) }}</strong></p>
                                <p><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">
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
                <div class="button-load-more"><a href="{{ route('website.category_news',['name_cate'=> Str::of($new_header[9]->name_cate)->slug('-'),'uuid'=>$new_header[9]->uuid]) }}" type="button"
                    class="btn btn-default active">Xem thêm</a></div>
                <!--========== End .NEWS ==========-->
            </div>
            <!--========== End .COL-MD-8 ==========-->
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
                        <h3 class="title"><span class="bg-11">Văn hóa</span></h3>
                        <h3 class="subtitle">Tin tức mới nhất</h3>
                    </div>
                    @foreach ($boot_new['culture_news'] as $item)
                        <!-- Begin .item-->
                        <div class="item">
                            <div class="item-image-2"><a class="img-link"
                                    href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><img
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
                                    <h3><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</strong>
                                        </a></h3>
                                </div>
                                <p> <i class="fa fa-clock-o"></i> <span
                                    class="date"><strong>{{ date('d-m-Y', strtotime($item->created_at)) }}</strong></span>
                                <strong>{{ date('H:i A', strtotime($item->created_at)) }}</strong></p>
                                <p><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">
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
                <div class="button-load-more"><a href="{{ route('website.category_news',['name_cate'=> Str::of($new_header[6]->name_cate)->slug('-'),'uuid'=>$new_header[6]->uuid]) }}" type="button"
                    class="btn btn-default active">Xem thêm</a></div>
                <!--========== End .NEWS ==========-->
            </div>
            <!--========== End .COL-MD-8 ==========-->
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
                        <h3 class="title"><span class="bg-11">Thể thao</span></h3>
                        <h3 class="subtitle">Tin tức mới nhất</h3>
                    </div>
                    @foreach ($boot_new['sport_news'] as $item)
                        <!-- Begin .item-->
                        <div class="item">
                            <div class="item-image-2"><a class="img-link"
                                    href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><img
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
                                    <h3><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</strong>
                                        </a></h3>
                                </div>
                                <p> <i class="fa fa-clock-o"></i> <span
                                    class="date"><strong>{{ date('d-m-Y', strtotime($item->created_at)) }}</strong></span>
                                <strong>{{ date('H:i A', strtotime($item->created_at)) }}</strong></p>
                                <p><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">
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
                <div class="button-load-more"><a href="{{ route('website.category_news',['name_cate'=> Str::of($new_header[8]->name_cate)->slug('-'),'uuid'=>$new_header[8]->uuid]) }}" type="button"
                    class="btn btn-default active">Xem thêm</a></div>
                <!--========== End .NEWS ==========-->
            </div>
            <!--========== End .COL-MD-8 ==========-->
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
                        <h3 class="title"><span class="bg-11">Giải trí</span></h3>
                        <h3 class="subtitle">Tin tức mới nhất</h3>
                    </div>
                    @foreach ($boot_new['entertainment_news'] as $item)
                        <!-- Begin .item-->
                        <div class="item">
                            <div class="item-image-2"><a class="img-link"
                                    href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><img
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
                                    <h3><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}</strong>
                                        </a></h3>
                                </div>
                                <p> <i class="fa fa-clock-o"></i> <span
                                    class="date"><strong>{{ date('d-m-Y', strtotime($item->created_at)) }}</strong></span>
                                <strong>{{ date('H:i A', strtotime($item->created_at)) }}</strong></p>
                                <p><a href="{{ route('website.detailNew', ['uuid' => $item->uuid]) }}">
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
                <div class="button-load-more"><a href="{{ route('website.category_news',['name_cate'=> Str::of($new_header[7]->name_cate)->slug('-'),'uuid'=>$new_header[7]->uuid]) }}" type="button"
                    class="btn btn-default active">Xem thêm</a></div>
                <!--========== End .NEWS ==========-->
            </div>
            <!--========== End .COL-MD-8 ==========-->
        </div>
    </div>
</section>

