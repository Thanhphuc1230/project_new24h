@php
    use Illuminate\Support\Str;
@endphp

<header id="header">
    <!-- Begin .top-menu -->
    <div class="top-menu">
        <!-- Begin .container -->
        <div class="container">
            <!-- Begin .left-top-menu -->
            <ul class="left-top-menu">
                <li> <a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                <li> <a href="#" class="twitter"><i class="fa fa-twitter"></i></a> </li>
                <li> <a href="#" class="youtube"> <i class="fa fa-youtube"></i></a> </li>
                <li> <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a> </li>
                <li> <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a> </li>
                <li> <a href="#" class="instagram"> <i class="fa fa-instagram"></i></a> </li>
                <li class="address"><a href="#"><i class="fa fa-phone"></i> +00 (123) 456 7890</a></li>
                <li class="address"><a href="#"><i class="fa fa-envelope-o"></i> info@domain.com</a></li>
            </ul>
            <!-- End .left-top-menu -->
            <!-- Begin .right-top-menu -->
            <ul class="right-top-menu pull-right">
                <li class="contact"><a href="contact.html"><i class="fa fa-map-marker fa-i"></i></a></li>
                <li class="about"><a href="{{ route('getLogin') }}"><i class="fa fa-user fa-i"></i></a> </li>
                <li>
                    <div class="search-container">
                        <div class="search-icon-btn"> <span style="cursor:pointer"><i class="fa fa-search"></i></span>
                        </div>
                        <div class="search-input">
                            <input type="search" class="search-bar" placeholder="Search..." title="Search" />
                        </div>
                    </div>
                </li>
            </ul>
            <!-- End .right-top-menu -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .top-menu -->
    <!-- Begin .container -->
    <div class="container">
        <!-- Begin .header-logo -->
        <div class="header-logo"><a href="{{ route('website.index') }}"><img src="{{ asset('website/img/logo.png') }} "
                    alt="Site Logo" />
                <h1>24h <span>News</span></h1>
                <h4>Your 24h News Source</h4>
            </a></div>
        <!-- End .header-logo -->

        <!--========== BEGIN .NAVBAR #MOBILE-NAV ==========-->
        <nav class="navbar navbar-default" id="mobile-nav">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" id="sidenav-toggle"> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <div class="sidenav-header-logo"><a href="{{ route('website.index') }}"><img
                            src="{{ asset('website/img/logo.png') }} " alt="Site Logo" />
                        <h2>24h <span>News</span></h2>
                        <h5>Your 24h News Source</h5>
                    </a></div>
            </div>
            <div class="sidenav" data-sidenav data-sidenav-toggle="#sidenav-toggle">
                <button type="button" class="navbar-toggle active" data-toggle="collapse"> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <div class="sidenav-brand">
                    <div class="sidenav-header-logo"><a href="{{ route('website.index') }}"><img
                                src="{{ asset('website/img/logo.png') }} " alt="Site Logo" />
                            <h2>24h <span>News</span></h2>
                            <h5>Your 24h News Source</h5>
                        </a></div>
                </div>
                <ul class="sidenav-menu">
                    <li class="active"><a href="{{ route('website.index') }}">Home</a></li>
                    @foreach ($new_header as $item)
                        <li><a
                                href="{{ route('website.category_news', ['name_cate' => Str::of($item->name_cate)->slug('-'), 'uuid' => $item->uuid]) }}">{{ $item->name_cate }}</a>
                        </li>
                    @endforeach
                    @if (Auth::user())
                        <li><a href="{{ route('website.profile', ['uuid' => Auth::user()->uuid]) }}">Profile</a></li>
                    @else
                        <li><a href="{{ route('getLogin') }}">Login</a></li>
                    @endif
                </ul>
            </div>
        </nav>
        <!--========== END .NAVBAR #MOBILE-NAV ==========-->
    </div>
    <!-- End .container -->
    <!--========== BEGIN .NAVBAR #FIXED-NAVBAR ==========-->
    <div class="navbar" id="fixed-navbar">
        <!--========== BEGIN MAIN-MENU .NAVBAR-COLLAPSE COLLAPSE #FIXED-NAVBAR-TOOGLE ==========-->
        <div class="main-menu nav navbar-collapse collapse" id="fixed-navbar-toggle">
            <!--========== BEGIN .CONTAINER ==========-->
            <div class="container">
                <!-- Begin .nav navbar-nav -->
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ route('website.index') }}">Home</a></li>
                    @foreach ($new_header as $item)
                        <li><a
                                href="{{ route('website.category_news', ['name_cate' => Str::of($item->name_cate)->slug('-'), 'uuid' => $item->uuid]) }}">{{ $item->name_cate }}</a>
                        </li>
                    @endforeach
                    @if (Auth::user())
                        <li><a href="{{ route('website.profile', ['uuid' => Auth::user()->uuid]) }}">Profile</a></li>
                    @else
                        <li><a href="{{ route('getLogin') }}">Login</a></li>
                    @endif
                    <!--========== END DROPDOWN MEGA-DROPDOWN ==========-->
                </ul>
                <!--========== END .NAV NAVBAR-NAV ==========-->
            </div>
            <!--========== END .CONTAINER ==========-->
        </div>
        <!--========== END MAIN-MENU .NAVBAR-COLLAPSE COLLAPSE #FIXED-NAVBAR-TOOGLE ==========-->
        <!--========== BEGIN .SECOND-MENU NAVBAR #NAV-BELOW-MAIN ==========-->
        <div class="second-menu navbar" id="nav-below-main">
            <!-- Begin .container -->
            <div class="container">
                <!-- Begin .collapse navbar-collapse -->
                <div class="collapse navbar-collapse nav-below-main">
                    <!-- Begin .nav navbar-nav -->
                    <ul class="nav navbar-nav">
                        @foreach ($mini_categories as $category)
                            <li><a
                                    href="{{ route('website.category_news', ['name_cate' => Str::of($category->name_cate)->slug('-'), 'uuid' => $category->uuid]) }}">{{ $category->name_cate }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- End .nav navbar-nav -->
                </div>
                <!-- End .collapse navbar-collapse -->
                <!-- Begin .clock -->

                <!-- End .clock -->
            </div>
            <!-- End .container -->
        </div>
        <!--========== END .SECOND-MENU NAVBAR #NAV-BELOW-MAIN ==========-->

    </div>
</header>

@if (Session::get('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (Session::get('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! Session::get('error') !!}</li>
        </ul>
    </div>
@endif
<section id="main-section">
