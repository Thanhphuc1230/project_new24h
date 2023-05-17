@extends('website.master')
@section('module', 'Hot news')
@section('content')
    <section class="module highlight">
        <div class="container">
            <div class="row no-gutter">
                <!--========== BEGIN .COL-MD-8 ==========-->
                <div class="col-md-8">
                    <div class="module-title">
                        <h3 class="title"><span class="bg-1">Tin tức mới nhất</span></h3>
                    </div>
                    <!--========== BEGIN .NEWS ==========-->
                    <div class="news">
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="content-hot-new" id="post_data">
                            </div>
                        </div>
                        
                        <!-- End .item -->

                    </div>
                    <!--========== END NEWS ==========-->
                </div>
                <!--========== END .COL-MD-8 ==========-->

            </div>
        </div>
    </section>

@endsection
