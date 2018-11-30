@extends('welcome')
@section('body')
    <!-- START CONTENT -->
      <div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->


        <!-- SITE CONTENT -->
        <div class="container-fluid px-0">
          <section class="slide-section mt-2 mb-lg-5 mb-md-5 mb-4">

                <div class="header-slide owl-carousel owl-theme">
                  <div class="item">
                    <img class="slide-img" src='http://blog.wishatl.com/wp-content/uploads/2015/12/Hypebeast-adidas-Originals-Uncaged-2.jpg'>
                    <div class="row header-row">
                      <div class="col-12 index-text-color  ">
                        <h1>Best of MEN's SNEAKERS</h1>
                        <h5>is simply dummy text of the printing and typesetting industry. Lorem Ipsum</h5>
                      </div>
                      <div class="col-12 ">
                        <hr></hr>
                        <div class="header-slide-btn">
                          <a href="{{ url('filter') }}" class="btn fast-buy p-2 w-100">
                            <label class="mb-0 d-flex px-2 white" style="cursor:pointer;">
                              <span>DETAIL</span>
                              <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                            </label>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <img class="slide-img" src='http://blog.wishatl.com/wp-content/uploads/2015/12/Hypebeast-adidas-Originals-Uncaged-4.jpg'>
                    <div class="row header-row">
                      <div class="col-12 index-text-color">
                        <h1>Best of MEN's SNEAKERS</h1>
                        <h5>is simply dummy text of the printing and typesetting industry. Lorem Ipsum</h5>
                      </div>
                      <div class="col-12">
                        <hr></hr>
                        <div class="header-slide-btn">
                          <a href="{{ url('filter') }}" class="btn fast-buy p-2 w-100">
                            <label class="mb-0 d-flex px-2 white" style="cursor:pointer;">
                              <span>DETAIL</span>
                              <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                            </label>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <img class="slide-img" src='http://blog.wishatl.com/wp-content/uploads/2015/12/Hypebeast-adidas-Originals-Uncaged-7.jpg'>
                    <div class="row header-row">
                      <div class="col-12 index-text-color ">
                        <h1>Best of MEN's SNEAKERS</h1>
                        <h5>is simply dummy text of the printing and typesetting industry. Lorem Ipsum</h5>
                      </div>
                      <div class="col-12">
                        <hr></hr>
                        <div class="header-slide-btn">
                          <a href="{{ url('filter') }}" class="btn fast-buy p-2 w-100">
                            <label class="mb-0 d-flex px-2 white" style="cursor:pointer;">
                              <span>DETAIL</span>
                              <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                            </label>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <img class="slide-img" src='http://blog.wishatl.com/wp-content/uploads/2015/12/Hypebeast-adidas-Originals-Uncaged-6.jpg'>
                    <div class="row header-row">
                      <div class="col-12 index-text-color ">

                        <h1>Best of MEN's SNEAKERS</h1>
                        <h5>ลดราคารองเท้า 50 - 70% ไม่ว่าจะเป็นรองเท้าผ้าใบ รองเท้าเดือนทาง รองเท้าวิ่ง</h5>
                      </div>
                      <div class="col-12">
                        <hr></hr>
                        <div class="header-slide-btn">
                          <a href="{{ url('filter') }}" class="btn fast-buy p-2 w-100 mx-auto mx-sm-right">
                            <label class="mb-0 d-flex px-2 white" style="cursor:pointer;">
                              <span>DETAIL</span>
                              <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                            </label>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

          </section>

          <div class="custom-container">

                <section class="latest-product mb-lg-5 mb-md-5 mb-4">
                	@include('latest-product')
                </section>

                <section class="product-series mb-lg-5 mb-md-5 mb-4">
                  <div class="row">
                      <div class="col-xl-6 col-lg-8 col-md-6 col-12 product-series-col">
                          <div class="product-series-frame">
                              <img class="product-series-img " src="https://78.media.tumblr.com/7c668391d2de3473ad9b47ef0e739658/tumblr_ober17IfLb1tg9hheo10_r1_1280.gif">
                          </div>
                      </div>
                      <div class="col-xl-6 col-lg-4 col-md-6 col-12 product-series-col">
                        <div class="row mx-0 header-row h-100">
                          <div class="col-12 my-auto">
                            <h1>The Top Series</h1>

                            <h5>Discovering Your Individual Style</h5>
                            <hr></hr>

                            <div class="header-slide-btn" >
                              <a href="{{ url('filter')}}" class="btn fast-buy p-2 w-100">
                                <label class="mb-0 d-flex px-2 white">
                                  <span>More Detail</span>
                                  <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                </label>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </section>

               <section class="brand-hightlight mb-lg-5 mb-md-5 mb-4">
                  <div class="row mx-0 mb-3">
                    <div class="col-12 px-lg-3 pl-0 pr-0 mb-md-3">
                      <h3 class="mb-1 mt-2 pull-left">BRAND HIGHLIGHT</h3>
                    </div>
                  </div>
                  <div class="brand-slide owl-carousel owl-theme">
                    <!-- บังคับ first child มัclass first    last child มี class last  -->


                    <div class="item first">
                      <div class="slide-brand-frame">
                        <a href="{{ url('filter') }}">
                          <img class="slide-brand-img" src="{{ url('assets/images/logo/adidas.png') }}">
                        </a>
                      </div>
                    </div>

                    <div class="item">
                      <div class="slide-brand-frame">

                        <a href="{{ url('filter') }}">
                          <img class="slide-brand-img" src="{{ url('assets/images/logo/onisuka.png') }}">
                        </a>
                      </div>
                    </div>
                    <div class="item">
                      <div class="slide-brand-frame">
                        <a href="{{ url('filter') }}">
                          <img class="slide-brand-img" src="{{ url('assets/images/logo/reebok.png') }}">
                        </a>
                      </div>
                    </div>
                    <div class="item">
                      <div class="slide-brand-frame">
                        <a href="{{ url('product-details2')}}">
                          <img class="slide-brand-img" src="{{ url('assets/images/logo/onisuka.png' ) }}">
                        </a>
                      </div>
                    </div>
                    <div class="item last">
                      <div class="slide-brand-frame">

                        <a href="{{ url('filter') }}">
                          <img class="slide-brand-img" src="{{ url('assets/images/logo/reebok.png') }}">
                        </a>
                      </div>
                    </div>

                  </div>
                </section>


                <section class="upcoming-launches mb-lg-5 mb-md-5 mb-4">
                   <div class="row mx-0">
                     <div class="col-12 px-lg-3 px-0 mb-md-3">
                       <h3 class="mb-1 pull-left">UPCOMING LAUNCES</h3>
                       <div class="latest-product-btn pull-right mb-2">
                           <a href="{{ url('launches') }}" class="btn view-all p-2 res-414-up">
                             <label class="mb-0 d-flex px-2">
                               <span>view all</span>
                               <i class="fas fa-plus ml-auto pl-3 pt-1" aria-hidden="true"></i>
                             </label>
                           </a>
                       </div>
                     </div>
           	    		<div class="col-lg-4 col-md-6 col-12">
                       <div class="card_new">
                         <div class="launches-fix-frame">
                           <span class='zoom' id='zoom1'>
                           <img src="{{ url('assets/images/product/2/adidas/3.jpg') }}" class="launches-img" width='100%' height='auto' alt='Baby Wallper'/>
                           </span>
                         </div>
                         <div class="card-body">
                           <div class="row">
                             <div class="col-3 col-lg-3 col-md-4  launches_border text-md-center">
                               <p class="launches_font_30">January</p>
                               <p class="launches_font_31">7</p>
                               <p class="launches_font_32">2018</p>
                             </div>
                             <div class="col-9 col-lg-9 col-md-8  lau_pad_10">
                               <a href="#"><p class="launches_font_30 line-h-20">ADIDAS ORIGINALS “EQT SUPPORT SK PRIMEKNIT”</p></a>
                               <p class="font_14 line-h-20 fix_20">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in</p>
                             </div>
                             <div class="col-lg-12 text-right px-0">
                               <a href="{{ url('launches-detail') }}" class="btn fast-buy p-2 ">
                                  <label class="mb-0 d-flex px-2 white">
                                      <span>Read More</span>
                                      <i class="icon-collpase fas fa-angle-right ml-2 pt-1" aria-hidden="true"></i>
                                  </label>
                                </a>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
           	    		<div class="col-lg-4 col-md-6 col-12">
                       <div class="card_new">
                         <div class="launches-fix-frame">
                           <span class='zoom' id='zoom2'>
                           <img src="{{ url('assets/images/product/2/adidas/1.jpg') }}" class="launches-img" width='100%' height='auto' alt='Baby Wallper'/>
                           </span>
                         </div>
                         <div class="card-body">
                           <div class="row">
                             <div class="col-3 col-lg-3 col-md-4  launches_border text-md-center">
                               <p class="launches_font_30">January</p>
                               <p class="launches_font_31">7</p>
                               <p class="launches_font_32">2018</p>
                             </div>
                             <div class="col-9 col-lg-9 col-md-8  lau_pad_10">
                               <a href="#"><p class="launches_font_30 line-h-20">ADIDAS X RAF SIMONS REPLICANT OZWEEGO US</p></a>
                               <p class="font_14 line-h-20 fix_20">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in</p>
                             </div>
                             <div class="col-lg-12 text-right px-0">
                              <a href="{{ url('launches-detail') }}" class="btn fast-buy p-2 ">
                                  <label class="mb-0 d-flex px-2 white">
                                      <span>Read More</span>
                                      <i class="icon-collpase fas fa-angle-right ml-2 pt-1" aria-hidden="true"></i>
                                  </label>
                                </a>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                    <div class="col-lg-4 col-md-6 col-12">
                       <div class="card_new">
                         <div class="launches-fix-frame">
                           <span class='zoom' id='zoom3'>
                           <img src="{{ url('assets/images/product/2/adidas/4.jpg') }}" class="launches-img" width='100%' height='auto' alt='Baby Wallper'/>
                           </span>
                         </div>
                         <div class="card-body">
                           <div class="row">
                             <div class="col-3 col-lg-3 col-md-4  launches_border text-md-center">
                               <p class="launches_font_30">January</p>
                               <p class="launches_font_31">7</p>
                               <p class="launches_font_32">2018</p>
                             </div>
                             <div class="col-9 col-lg-9 col-md-8  lau_pad_10">
                               <a href="{{ url('launches-detail') }}"><p class="launches_font_30 line-h-20">ADIDAS ORIGINALS BY ALEXANDER WANG TRAINER ADIDAS ORIGINALS BY ALEXANDER </p></a>
                               <p class="font_14 line-h-20 fix_20">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in</p>
                             </div>
                             <div class="col-lg-12 text-right px-0">
                               <a href="{{ url('launches-detail') }}" class="btn fast-buy p-2 ">
                                  <label class="mb-0 d-flex px-2 white">
                                      <span>Read More</span>
                                      <i class="icon-collpase fas fa-angle-right ml-2 pt-1" aria-hidden="true"></i>
                                  </label>
                                </a>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>


                  <section class="blog-launches mb-lg-5 mb-md-5 mb-4">
                    <div class="row mx-0">
                      <div class="col-12 px-lg-3 px-0 mb-md-3">
                        <h3 class="mb-1 mt-2 pull-left">BLOG</h3>
                        <div class="latest-product-btn pull-right mb-2">

                          <a href="{{ url('blog') }}" class="btn view-all p-2 res-414-up">
                            <label class="mb-0 d-flex px-2">
                              <span>view all</span>
                              <i class="fas fa-plus ml-auto pl-3 pt-1" aria-hidden="true"></i>
                            </label>

                          </a>
                        </div>
                      </div>

                  @foreach($sum_blocks->items as $key_block => $value_block)
                    @php
                      preg_match('/<img.+url=[\'"](?P<src>.+?)[\'"].*>/i', $value_block->content, $image);
                      $date=date_create($value_block->creation_time);
                    @endphp
                      <div class="col-lg-6 col-12 blog-img-col">
                        <div class="card_new mr-0 px-1">
                            <div class="blog-img-frame">
                              <a href="{{ url('single-blog') }}/{{ $value_block->id }}">
                                @if(!empty($image['src']))
                                  <img class="blog-img" src="http://dilokstore.com/magento/pub/media/{{ $image['src'] }}"/>
                                @else
                                  <img class="blog-img" src="{{ url('assets/images/No_Image_Available.jpg') }}">
                                @endif
                              </a>
                            </div>
                            <div class="card-body">
                              <div class="blog-excerpt mb-2">
                                <span class="launches_font_30 line-h-20">{!! str_limit(strip_tags($value_block->content),200) !!}</span>
                              </div>
                                <span class="line-h-20 grey text-small">{{ date_format($date,"d/m/Y") }}</span>
                            </div>
                        </div>
                      </div>
                  @endforeach

                      <!-- <div class="col-lg-6 col-12 blog-img-col">
                        <div class="card_new mr-0  px-1">
                            <div class="blog-img-frame">
                              <a href="{{ url('single-blog') }}">
                                <img class="blog-img" src='https://scontent.fbkk5-5.fna.fbcdn.net/v/t1.0-9/16939236_1004972542935763_1944494886694740495_n.jpg?_nc_cat=0&oh=f912c0654d66380fb7ac48705cec09f0&oe=5B9F6832'/>
                              </a>
                            </div>
                            <div class="card-body">

                              <div class="blog-excerpt mb-2">
                                <span class="launches_font_30 line-h-20">Sports fashion retailer Dilok has opened a new store at Chula Soi7 Sports fashion retailer Dilok has opened a new store at Chula Soi7</span>
                              </div>

                                <span class="line-h-20 grey text-small">20/06/2018</span>
                            </div>
                        </div>
                      </div> -->


                      <div class="col-12 res-414-down">
                        <a href="{{ url('blog') }}">
                          <label>view all <span> > </span></label>
                        </a>
                      </div>

                    </div>
                  </section>
                </div>

              </div>

        </div>
        <!-- END SITE CONTENT -->


      </div>
    <!-- END CONTENT -->





@endsection

@section('js_bottom')
<script>

$('.header-slide').owlCarousel({
    loop:true,
    items:1,
    dot:true,
    autoplay:true,
});

$('.header-slide').find('.owl-dots').removeClass('disabled');

$('.brand-slide').owlCarousel({
    nav:true,
    navText:["",""],
    loop:false,
    items:3,
    dot:true,
    autoplay:false,
    responsive : {
        0 : {
          items : 1,
          dot:false,
        },
        414 : {
          items : 1,
          dot:false,
        },
        768 : {
          items : 2,
        },
        1024 : {
          items : 2,
        },
        1366 : {
            items : 3,
        },
        1367 : {
            items : 3,
        }
    },
});
$('.brand-slide').find('.owl-nav').removeClass('disabled');
$('.brand-slide').find('.owl-next').removeClass('disabled');

if(window.matchMedia("(max-width: 414px)").matches){
}
else{
  $('.brand-slide').find('.owl-dots').removeClass('disabled');

}

$('.brand-slide').find('.owl-next').addClass('latest-next latest-next-1 arrow-fadein');
$('.brand-slide').find('.owl-next').append("<i class='fas fa-angle-right fa-4x'></i>");
$('.brand-slide').find('.owl-prev').removeClass('disabled');
$('.brand-slide').find('.owl-prev').addClass('latest-prev  latest-prev-1');
$('.brand-slide').find('.owl-prev').append("<i class='fas fa-angle-left fa-4x'></i>");
$('.brand-slide').on('translated.owl.carousel', function(e) {
  $('.brand-slide .owl-stage .owl-item.active').each(function(){
      if($(this).closest('.owl-stage').find('.active .item').hasClass('first'))
      {
        $(this).closest('.owl-carousel').find('.latest-prev').removeClass('arrow-fadein');
      }
      else{
        $(this).closest('.owl-carousel').find('.latest-prev').addClass('arrow-fadein');
      }
      if($(this).closest('.owl-stage').find('.active .item').hasClass('last'))
      {
        $(this).closest('.owl-carousel').find('.latest-next').removeClass('arrow-fadein');
      }
      else{
        $(this).closest('.owl-carousel').find('.latest-next').addClass('arrow-fadein');
      }
  });
});

$('.brand-slide').find('.owl-dots').removeClass('disabled');

if(window.matchMedia("(max-width: 1024px)").matches){

          }
          else{
              $('#zoom1').zoom();
              $('#zoom2').zoom();
              $('#zoom3').zoom();

          }

</script>
@endsection
