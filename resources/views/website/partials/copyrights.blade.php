<footer id="footer">
    <!-- Begin .parallax -->
    <div id="parallax-section2">
        <div class="bg parallax2 overlay img-overlay2">
            <div class="container">
                <div class="row no-gutter">
                    <div class="col-sm-6 col-md-3">
                        <h3 class="title-left title-style03 underline03">About Us</h3>
                        <p class="about-us">Trang này là project cá nhân em lấy nguồn theo <a
                                href="https://tuoitre.vn/" style="color:blue">tuoitre.com</a>.<br>
                        <br>
                             </p>
                        <div class="site-logo"><a href="{{ route('website.index') }}"><img
                                    src="{{ asset('website/img/logo.png') }}" alt="Side Logo" loading="lazy" />
                                <h3>24h <span>News</span></h3>
                                <p>Tuoitre.asia</p>
                            </a></div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <h3 class="title-left title-style03 underline03">Tin 24h</h3>
                        <div class="footer-post">
                            <ul>
                                @foreach ($latest_news as $item)
                                    <li>
                                        <div class="item">
                                            <div class="item-image"><a class="img-link"
                                                    href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><img
                                                        class="img-responsive img-full" loading="lazy"
                                                        @php if (substr($item->avatar, 0,
                                                8) === "https://") {
                                                echo 'src="'. $item->avatar.'"';
                                                } else {
                                                echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                } @endphp
                                                        alt=""></a></div>
                                            <div class="item-content">
                                                <p class="ellipsis"><a
                                                        href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}">{{ html_entity_decode($item->title) }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <h3 class="title-left title-style03 underline03">Tin mới nhất</h3>
                        <div class="footer-post">
                            <ul>
                                @foreach ($latest_news_2 as $item)
                                    <li>
                                        <div class="item">
                                            <div class="item-image"><a class="img-link"
                                                    href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}"><img
                                                        class="img-responsive img-full" loading="lazy"
                                                        @php if (substr($item->avatar, 0,
                                                8) === "https://") {
                                                echo 'src="'. $item->avatar.'"';
                                                } else {
                                                echo 'src="' . asset('images/news/'.$item->avatar) . '" ';
                                                } @endphp
                                                        alt=""></a></div>
                                            <div class="item-content">
                                                <p class="ellipsis"><a
                                                        href="{{ route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'), 'uuid' => $item->uuid]) }}">{{ html_entity_decode($item->title) }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <h3 class="title-left title-style03 underline03">Tags</h3>
                        <div class="tagcloud">
                            @foreach ($new_header as $item)
                                <a
                                    href="{{ route('website.category_news', ['name_cate' => Str::of($item->name_cate)->slug('-'), 'uuid' => $item->uuid]) }}">{{ $item->name_cate }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End .parallax -->
</footer>
<!--========== END #FOOTER==========-->
<button onclick="scrollToTop(1500)" id="moveToTopBtn" title="Go to top">
    <i class="fas fa-arrow-up"></i> <!-- Font Awesome icon -->
  </button>
<!--========== BEGIN #COPYRIGHTS==========-->
<div id="copyrights">
    <!-- Begin .container -->
    <div class="container">
        <!-- Begin .copyright -->
        <div class="copyright">{{ date('Y') }} 24h NEWS <i class="fa-solid fa-heart" style="color: #ff0000;"></i>
            Made With By <a href="https://www.facebook.com/Tphuc1505/" style="color: #ff0000;"> DTP </a></div>
        <!-- End .copyright -->
        <!--  Begin .footer-social-icons -->
        <div class="footer-social-icons">
            <ul>
                <li> <a href="https://www.facebook.com/Tphuc1505/" class="facebook"><i class="fa fa-facebook"></i></a> </li>
                <li> <a href="https://www.linkedin.com/in/daothanhphuc/" class="linkedin"><i class="fa fa-linkedin"></i></a> </li>
            </ul>
        </div>
        <!--  End .footer-social-icons -->
    </div>
    <!-- End .container -->
</div>
<!--========== END #COPYRIGHTS==========-->
</div>

<!--========== END #WRAPPER ==========-->
