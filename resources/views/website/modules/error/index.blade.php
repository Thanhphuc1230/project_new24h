@extends('website.master')
@section('module','Không tìm thấy trang')
@section('content')
<section id="main-section">
    <!--========== BEGIN .CONTAINER ==========-->
    <div class="container">
    </div>
    <!--========== END .CONTAINER ==========-->
    <!-- Begin .Error 404 -->
    <div class="error-404 container-fluid text-center">
        <div class="error-msg" style="font-size: 67.45px;">Error 404</div>
        <h2 class="medium-caption" style="font-size: 30px;">Page Not Found!</h2>
        <h4>Sorry! We could not found the page you are looking for! Please search below...</h4>
        <div class="col-sm-offset-4 col-sm-4">
            <form action="#" class="main-search">
                <div class="input-group content-group">
                    <input type="text" class="form-control" placeholder="Search" title="Search">
                    <div class="input-group-btn">
                        <button type="submit" class="btn bg-red btn-icon"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-offset-1 col-md-10">
            <p class="text-center"><a class="btn btn-default btn-lg" href="{{ route('website.index') }}">Take me
                    home</a></p>
        </div>
    </div>
    <!-- End .Error 404 -->
</section>
@endsection
