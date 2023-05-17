  @include('website.partials.head')
  @include('website.partials.header')
  <!--========== END #HEADER ==========-->
  <!--========== BEGIN #MAIN-SECTION ==========-->

  <!-- ========== BEGIN PARALLAX ========== -->
  
  
  @yield('content')

  <!--========== BEGIN .MODULE ==========-->
  {{-- @include('website.partials.local_new') --}}
  <!--========== END .MODULE ==========-->
  <!--========== BEGIN .MODULE ==========-->
  {{-- @include('website.partials.boot_new') --}}
  <!--========== END .MODULE ==========-->
  <!--========== BEGIN .MODULE  ==========-->

  <!--========== END .MODULE ==========-->
  @include('website.partials.footer')
