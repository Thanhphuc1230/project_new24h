<section class="module highlight">
    <div class="container">
      <div class="row no-gutter"> 
        <!--========== BEGIN .COL-MD-8 ==========-->
        <div class="col-md-8">
          <div class="module-title">
            <h3 class="title"><span class="bg-1">Local News</span></h3>
            <h3 class="subtitle">Latest News in details</h3>
          </div>
          <!--========== BEGIN .ROW ==========-->
          <div class="row no-gutter"> 
            <!--========== BEGIN .COL-MD-3 ==========-->
            <div class="col-xs-12 col-sm-3 col-md-3"> 
              <!-- Begin .list list-mark-1 -->
              <ul class="list list-mark-1">
                <li><a href="index.html">Home</a></li>
                  
              </ul>
              <!-- End .list list-mark-1 --> 
            </div>
            <!--========== END .COL-MD-3 ==========--> 
            <!--========== BEGIN .COL-MD-9 ==========-->
            <div class="col-xs-12 col-sm-9 col-md-9"> 
              <!--========== BEGIN .NEWS ==========-->
              <div class="news">
                  @for($i =1 ; $i <= 5 ; $i++)
                <div class="item">
                  <div class="item-image-3"><a class="img-link" href="#"><img class="img-responsive img-full" src="{{ asset('website/img/index_800x400-image09.jpg ') }}" alt=""></a><span><a class="label-1" href="news.html">Breaking News</a></span> </div>
                  <div class="item-content">
                    <div class="title-left title-style04 underline04">
                      <h3><a href="#"><strong>Explosion</strong></a></h3>
                    </div>
                    <p><a href="#" target="_blank" class="external-link"> At least nine firefighters were injured when a massive natural gas explosion...</a></p>
                    <div> <a href="watch-live.html" target="_blank"><span class="read-more">Watch Live</span></a> </div>
                  </div>
                </div>
                @endfor
            
              </div>
              <!--========== END .NEWS ==========--> 
            </div>
            <!--========== END .COL-MD-9 ==========--> 
          </div>
          <!--========== END .ROW ==========--> 
        </div>
        <!--========== END .COL-MD-8 ==========--> 
        <!--========== BEGIN COL-MD-4 ==========-->
        <div class="col-md-4"> 
          <!-- Begin .title-style02 -->
          <div class="title-style02">
            <h3><a href="#">Recent Posts</a></h3>
          </div>
          <!-- End .title-style02 --> 
          <!--========== BEGIN .SIDEBAR-SCROLL ==========-->
          <div class="sidebar-scroll"> 
            <!-- Begin .scroll-item -->
            <div class="item">
              <div class="item-image-full"><a class="img-link" href="#"><img class="img-responsive img-full" src="{{ asset('website/img/index_800x400-image02.jpg ') }}" alt=""></a></div>
            </div>
            <div class="item">
              <div class="item-content-1">
                <h3>Tens of thousands of people have demonstrated against the governing.</h3>
              </div>
            </div>
            
            <!-- End .scroll-item -->
            @for($i = 1 ; $i <= 8 ; $i++)
            <div class="scroll-item">
              <div class="item">
                <div class="item-image"><a class="img-link" href="#"><img class="img-responsive img-full" src="{{ asset('website/img/index_800x400-image40.jpg ') }}" alt=""></a></div>
                <div class="item-content">
                  <p><i class="fa fa-clock-o"></i> <span class="day"> 1 min ago</span> <br/>
                    The River Seine is at its highest level for more than 30 years. </p>
                </div>
              </div>
            </div>
            @endfor
        
            <div class="item">
              <div class="item-image-full"><a class="img-link" href="#"><img class="img-responsive img-full" src="{{ asset('website/img/index_800x400-image04.jpg ') }}" alt=""></a></div>
            </div>
            @for($i = 1 ; $i <= 3; $i ++)
            <div class="scroll-item">
              <div class="item">
                <div class="item-content-1">
                  <p><i class="fa fa-clock-o"></i> <span class="day"> 9 min ago</span> <br/>
                    Magazines are publications, that are printed or electronically published online magazines. </p>
                </div>
              </div>
            </div>
            @endfor
         
            <!-- End .scroll-item --> 
          </div>
          <!--========== END .SIDEBAR-SCROLL ==========--> 
        </div>
        <!--========== END .COL-MD-4 ==========--> 
      </div>
    </div>
  </section>
  <!--========== END .MODULE ==========--> 
  <!--========== BEGIN .MODULE ==========-->
  <section class="module"> 
    <!--========== BEGIN .CONTAINER ==========-->
    <div class="container"> 
      <!--========== BEGIN .ROW ==========-->
      <div class="row no-gutter"> 
        <!-- Begin .full-block-three-columns -->
        <div class="full-block-three-columns"> 
          <!-- Begin .container-full-->
          <div class="container-full bottom-text full-photo">
            <div class="entry-media">
              <div class="image" style="display: block; background-image: url("{{asset('website/img/index_875x656.jpg')}} ");"></div>
            </div>
            <div class="content">
              <h2><a href="#">Florida International Air Show</a></h2>
              <h4>One of the top 15 air show events and festivals in the USA, Florida International Air Show has been a popular event for nearly 40 years.</h4>
            </div>
          </div>
          <!-- End .container-full--> 
        </div>
        <!-- End .full-block-three-columns --> 
        <!-- Begin .full-block-three-columns -->
        <div class="full-block-three-columns"> 
       
          <!-- Begin .entry-post -->
          <div class="entry-post"> 
              @for($i = 1 ; $i <= 3 ; $i++)
            <!-- Begin .item-->
            <div class="item">
              <div class="item-image"><a class="img-link" href="#"><img class="img-responsive img-full" src="{{ asset('website/img/index_464x232-image01.jpg ') }}" alt=""></a></div>
              <div class="item-content">
                <div class="entry-meta bg-1">News</div>
                <p class="ellipsis"><a href="#">Police are hunting a group of men believed to be responsible for...</a></p>
              </div>
            </div>
            <!-- End .item--> 
            @endfor
     
          </div>
          <!-- End .entry-post --> 
        </div>
        <!-- End .full-block-three-columns --> 
        <!-- Begin .full-block-three-columns -->
        <div class="full-block-three-columns">
          <div class="sidebar-add-place"> <a href="#" target="_blank"><img class="img-responsive" src="{{ asset('website/img/banner_300x600.jpg ') }}" alt=""></a> </div>
        </div>
        <!-- End .full-block-three-columns --> 
      </div>
    </div>
  </section>