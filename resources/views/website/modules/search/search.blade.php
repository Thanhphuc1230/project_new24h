@extends('website.master')

@section('module', 'Trang tìm kiếm - 24hnews')
@section('content')
<section class="module highlight">
    <div class="container">
      <div class="row no-gutter"> 
        <!--========== BEGIN .COL-MD-8 ==========-->
        <div class="col-md-8"> 
          <!--========== BEGIN .NEWS ==========-->
          <div class="news">
            <div class="module-title">
              <h3 class="title"><b>{{$count_result}}</b> Kết quả tìm kiếm</h3>
            </div>
            <!-- Begin .item -->
            @foreach($name as $item)
            <div class="item">
                <div class="item-image-1"><a class="img-link"
                        href="{{ route('website.detailNew', ['uuid' => $item->Nuuid]) }}"><img loading="lazy"
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
                        <h3><a href="{{ route('website.detailNew', ['uuid' => $item->Nuuid]) }}"><strong>{{ html_entity_decode(Str::words($item->title, 15)) }}
                                </strong></a>
                        </h3>
                    </div>
                    <p><a href="{{ route('website.detailNew', ['uuid' => $item->Nuuid]) }}"
                            class="external-link">{{ Str::words($item->intro, 15) }}</a>
                    </p>
                    <div><a
                            href="{{ route('website.category_news', ['name_cate' => Str::of($item['category']->name_cate)->slug('-'), 'uuid' => $item['category']->uuid]) }}"><span
                                class="read-more">{{ $item['category']->name_cate }}</span></a></div>
                </div>
            </div>
            @endforeach
            <!-- End .item --> 
          
            <!-- End .item --> 
          </div>
          <!--========== END NEWS ==========--> 
        </div>
        <!--========== END .COL-MD-8 ==========--> 
        <!--========== BEGIN .COL-MD-4 ==========-->
      
        <!--========== END .COL-MD-4==========--> 
      </div>
    </div>
  </section>
@endsection
