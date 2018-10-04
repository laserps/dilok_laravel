@extends('welcome')
@section('body')
    <!-- START CONTENT -->
      <div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->

<div class="container-fluid custom-container">

          <section class="product-detail mt-lg-5 mt-3 mb-lg-5 mb-md-5 mb-4">
            <div class="product-detail-box product-detail-boxes">

              <div class="product-detail1-left-side mb-md-4 mb-3">

                <div class="row">
                  <div class="col-12 mb-xl-4 mb-lg-4 mb-0">
                    <div id="product-carousel"  class="carousel slide product-carousel" data-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-carousel-img" src="assets/images/product/1/22.jpg">
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <!-- รุป youtube เปลี่ยนแค่ช่องก่อน0.jpg เป็นlink video -->
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/iGEUCPnw4Po?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-carousel-img" src="assets/images/product/1/33.jpg">
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-carousel-img" src="assets/images/product/1/44.jpg">
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-carousel-img" src="assets/images/product/1/55.jpg">
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-carousel-img" src="assets/images/product/1/66.jpg">
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-carousel-img" src="assets/images/product/1/55.jpg">
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-carousel-img" src="assets/images/product/1/44.jpg">
                          </div>
                        </div>
                      </div>
                      <a class="carousel-control-prev custom-control-prev" href="#product-carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon custom-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next custom-control-next" href="#product-carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon custom-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                      </div>
                  </div>
                  <div class="col-12 d-lg-block d-none">
                    <div class="productdetail1-carousel owl-carousel owl-theme px-5">
                        <!-- บังคับไล่ชื่อitem+เลขด้วย -->
                        <div class="item item1">
                          <div class="product-ipad-frame">
                            <img  class="product-ipad-img" src="assets/images/product/1/22.jpg">
                          </div>
                        </div>
                        <div class="item item2">
                          <div class="owl-video-play-icon"></div>
                          <div class="product-ipad-frame">
                            <img class="product-ipad-img" src="//img.youtube.com/vi/iGEUCPnw4Po/0.jpg">
                          </div>
                        </div>
                        <div class="item item3">
                          <div class="product-ipad-frame">
                            <img class="product-ipad-img" src="assets/images/product/1/33.jpg">
                          </div>
                        </div>
                        <div class="item item4">
                          <div class="product-ipad-frame">
                            <img class="product-ipad-img" src="assets/images/product/1/44.jpg">
                          </div>
                        </div>
                        <div class="item item5">
                          <div class="product-ipad-frame">
                            <img class="product-ipad-img" src="assets/images/product/1/55.jpg">
                          </div>
                        </div>
                        <div class="item item6">
                          <div class="product-ipad-frame">
                            <img class="product-ipad-img" src="assets/images/product/1/66.jpg">
                          </div>
                        </div>
                        <div class="item item7">
                          <div class="product-ipad-frame">
                            <img class="product-ipad-img" src="assets/images/product/1/55.jpg">
                          </div>
                        </div>
                        <div class="item item8">
                          <div class="product-ipad-frame">
                            <img class="product-ipad-img" src="assets/images/product/1/44.jpg">
                          </div>
                        </div>
                    </div>

                    <div class="owl-nav tog row replace-nav mb-5">
                      <div class="col-1 mr-auto">
                        <div class="owl-prev latest-prev3 arrow-fadein">
                          <i class="fas fa-angle-left fa-3x"></i>
                        </div>
                      </div>
                      <div class="col-1 ml-auto">
                        <div class="owl-next latest-next3 arrow-fadein pull-right">
                          <i class="fas fa-angle-right fa-3x"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <!-- Modal -->
                <div class="modal fade full-screen-product" id="full-screen-product-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body product-detail-modal-body">
                          <div class="row px-0 mx-0 w-100">
                            <div class="col-12">
                               <button type="button" class="close custom-close2 my-auto pull-right" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                               </button>
                             </div>
                             <div class="col-12 px-0 h-100 d-xl-none d-block ">
                               <img width="100%" src="assets/images/product/1/11.jpg">
                               <img width="100%" src="assets/images/product/1/22.jpg">
                               <img width="100%" src="assets/images/product/1/33.jpg">
                               <img width="100%" src="assets/images/product/1/44.jpg">
                               <img width="100%" src="assets/images/product/1/55.jpg">
                               <img width="100%" src="assets/images/product/1/66.jpg">
                             </div>

                             <div class="col-12 px-0 h-100 d-xl-block d-none">
                               <!-- carouselExampleIndicators มี css -->
                               <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                 <ol class="carousel-indicators">
                                   <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                   <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                   <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                   <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                   <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                   <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                                   <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                                   <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
                                 </ol>
                                 <div class="carousel-inner w-50 mx-auto">
                                      <div class="carousel-item h-100 active">
                                        <img class="d-block h-100 w-100" src="assets/images/product/1/22.jpg">
                                      </div>
                                      <div class="carousel-item">
                                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/iGEUCPnw4Po?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                      </div>
                                      <div class="carousel-item">
                                        <img class="d-block h-100 w-100" src="assets/images/product/1/33.jpg">
                                      </div>
                                      <div class="carousel-item">
                                        <img class="d-block h-100 w-100" src="assets/images/product/1/44.jpg">
                                      </div>
                                      <div class="carousel-item">
                                        <img class="d-block h-100 w-100" src="assets/images/product/1/55.jpg">
                                      </div>
                                      <div class="carousel-item">
                                        <img class="d-block h-100 w-100" src="assets/images/product/1/66.jpg">
                                      </div>
                                      <div class="carousel-item">
                                        <img class="d-block h-100 w-100" src="assets/images/product/1/55.jpg">
                                      </div>
                                      <div class="carousel-item">
                                        <img class="d-block h-100 w-100" src="assets/images/product/1/44.jpg">
                                      </div>
                                 </div>
                                 <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                   <span class="carousel-control-prev-icon custom-carousel-prev" aria-hidden="true"></span>
                                   <span class="sr-only">Previous</span>
                                 </a>
                                 <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                   <span class="carousel-control-next-icon custom-carousel-next" aria-hidden="true"></span>
                                   <span class="sr-only">Next</span>
                                 </a>
                               </div>


                             </div>
                           </div>
                      </div>
                    </div>
                  </div>
                </div>



              </div>

              <div class="product-detail1-right-side pl-xl-5 pl-0">
                <div class="sticky-box">
                      <div class="row mx-0">
                        <div class="col-12 pr-lg-0">
                          <div class="sticky-product-title w-100">
                              <h2>Adidas Zoom Pegasus 35
                                <button type="button" class="btn top-btn heart-btn pull-right"><i name="like-button" class="fa-1x fa-heart liked fas liked-shaked"></i></button>
                                <button type="button" class="btn top-btn pull-right"><i class="fa-1x fa-share-alt fas"></i></button>
                              </h2>
                          </div>

                          <div class="sticky-product-excerpt mb-2">
                              <span>
                                Reimaging a classic tennis style, this pair of Pharrell Williams Tennis HU sneakers are a fresh style from adidas. Dressed in white from heel to toe, this pair are built using flexible knit uppers – sure to hug your feet with every stride. Signed off with Williams’ signature branding, this pair are detailed with supportive outsole inserts within their rubber base.
                              </span>
                          </div>

                          <div class="sticky-product-picker">
                            <span class="ml-2">
                               Color
                            </span>
                            <span class="grey">
                               (black)
                            </span>
                            <div class="row mx-0 mt-2 mb-3">
                              <div class="col-lg-1 col-md-1 col-2 px-1 mb-2 text-center">
                                <button type="button" class="btn color-btn color-active" style="background-color:blue"></button>
                              </div>
                              <div class="col-lg-1 col-md-1 col-2 px-1 mb-2 text-center">
                                <button type="button" class="btn color-btn" style="background-color:white"></button>
                              </div>
                              <div class="col-lg-1 col-md-1 col-2 px-1 mb-2 text-center">
                                <button type="button" class="btn color-btn" style="background-color:black"></button>
                              </div>
                              <div class="col-lg-1 col-md-1 col-2 px-1 mb-2 text-center">
                                <button type="button" class="btn color-btn" style="background-color:orange"></button>
                              </div>
                            </div>
                            <span class="ml-2">
                               Size
                            </span>
                            <div class="row mx-0 mt-2 mb-3 size-select-box2">

                              <div class="dropdown">
                                <button class="btn add-to-cart dropdown-toggle" type="button" data-toggle="dropdown">Choose size (UK)
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                  <div class="size-picker">
                                      <div class="row w-100 mx-0 p-2">
                                          <div class="size-item active">
                                            7
                                          </div>
                                          <div class="size-item">
                                            7.5
                                          </div>
                                          <div class="size-item">
                                            8
                                          </div>
                                          <div class="size-item">
                                            8.5
                                          </div>
                                          <div class="size-item">
                                            9
                                          </div>
                                          <div class="size-item">
                                            9.5
                                          </div>
                                          <div class="size-item">
                                            10
                                          </div>
                                          <div class="size-item">
                                            10.5
                                          </div>
                                      </div>
                                  </div>
                                </ul>
                              </div>



                            </div>
                          </div>


                          <div class="sticky-product-quantity p-3">
                            <div class="row mx-0">
                              <div class="col-5 px-0 pt-2">


                                <select class="quantity">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                </select>
                                <span class="red">2 pieces, left</span>
                              </div>
                              <div class="col-7 px-0">
                                <div class="sale-percent px-2">
                                  <span>Sale 50%</span>
                                </div>
                                <div class="pt-2 latest-product-price">
                                  <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                  <!-- ไม่ลดราคา -->
                                  <!-- <span class="original">925</span><span class="currency">THB</span> -->
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row my-3 mx-0">
                            <div class="col-xl-4 col-lg-6"></div>
                            <div class="col-xl-4 col-lg-3 col-md-6 col-12 px-xl-1 px-lg-1 px-md-2 px-1 latest-product-btn latest-product-btn-detail1 mb-2">
                              <button type="button" class="btn add-to-cart p-2">
                                <label class="mb-0 d-flex px-2">
                                  <span>ADD TO CART</span>
                                  <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                </label>
                              </button>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-md-6 col-12 px-xl-1 px-lg-1 px-md-2 px-1 latest-product-btn latest-product-btn-detail1">
                              <button type="button" class="btn fast-buy p-2">
                                <label class="mb-0 d-flex px-2">
                                  <span>BUY NOW</span>
                                  <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                </label>
                              </button>
                            </div>
                          </div>

                        </div>
                      </div>
                </div>
              </div>

            </div>
          </section>

          <section class="mb-5">
            <div class="row mx-0 px-lg-0 px-md-5 px-1">
                <div class="col-12">
                    <h3 class="mb-2">PRODUCT DETAIL</h3>
                </div>
                <div class="launches_detail-bg product-detail1-content">
                  <p>Reimaging a classic tennis style, this pair of Pharrell Williams Tennis HU sneakers are a fresh style from adidas. Dressed in white from heel to toe, this pair are built using flexible knit uppers – sure to hug your feet with every stride. Signed off with Williams’ signature branding, this pair are detailed with supportive outsole inserts within their rubber base.</p>
                  <div class="launches_detail-lineheight mt-lg-4">
                    <p><i class="far fa-check-circle mr-3"></i>It is a long established fact that a reader will be distracted</p>
                    <p><i class="far fa-check-circle mr-3"></i>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    <p><i class="far fa-check-circle mr-3"></i>Contrary to popular belief, Lorem Ipsum is not simply random text. </p>
                    <p><i class="far fa-check-circle mr-3"></i>Lorem Ipsum has been the industry's </p>
                    <p><i class="far fa-check-circle mr-3"></i>There are many variations of passages of Lorem Ipsum</p>
                    <p><i class="far fa-check-circle mr-3"></i>Lorem Ipsum has been the industry's standard dummy </p>
                    <p><i class="far fa-check-circle mr-3"></i>It is a long established fact</p>
                  </div>
                </div>
            </div>
          </section>

          <section class="latest-product mb-lg-5 mb-md-5 mb-4">
              @include('latest-product')
          </section>
        </div>


      </div>

@endsection

@section('js_bottom')
<script>
var fixmeTop = $('.product-detail1-left-side').offset().top;       // get initial position of the element
$(window).scroll(function() {                  // assign scroll event listener
    var currentScroll = $(window).scrollTop(); // get current position
    if (currentScroll >= fixmeTop) {           // apply position: fixed if you
        $('.sticky-box').css({                      // scroll to that element or below it
            position: 'sticky',
            top: '0',
            left: '0'
        });
    } else {                                   // apply position: static
        $('.sticky-box').css({                      // if you scroll above it
            position: 'static'
        });
    }

});

$('.product-carousel').carousel({
  pause: true,
  interval: false,
  wrap: false,
});

$('.carousel-control-prev').click(function(){
  $('.productdetail1-carousel').trigger('prev.owl.carousel');
});

$('.carousel-control-next').click(function(){
  $('.productdetail1-carousel').trigger('next.owl.carousel');
});

$('.latest-next3').click(function(){
  $('.carousel-control-next').click();
});

$('.latest-prev3').click(function(){
  $('.carousel-control-prev').click();
});

$(".item1").click(function(){
  $(".product-carousel").carousel(0);
});

$(".item2").click(function(){
  $(".product-carousel").carousel(1);
});

$(".item3").click(function(){
  $(".product-carousel").carousel(2);
});

$(".item4").click(function(){
  $(".product-carousel").carousel(3);
});

$(".item5").click(function(){
  $(".product-carousel").carousel(4);
});

$(".item6").click(function(){
  $(".product-carousel").carousel(5);
});

$(".item7").click(function(){
  $(".product-carousel").carousel(6);
});

$(".item8").click(function(){
  $(".product-carousel").carousel(7);
});





</script>
@endsection
