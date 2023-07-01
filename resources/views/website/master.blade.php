  @include('website.partials.head')
  @include('website.partials.header')
  
  @yield('content')

  <!--========== BEGIN .MODULE ==========-->
  {{-- @include('website.partials.boot_new') --}}
  <!--========== END .MODULE ==========-->
  <!--========== BEGIN .MODULE  ==========-->

  <!--========== END .MODULE ==========-->
  @include('website.partials.footer')
