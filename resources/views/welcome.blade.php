<!doctype html>
<html lang="en">
  <head>
    <title>Dilok</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="robots" content="index, follow, all">
<meta name="author" content="Workbythai">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<!-- ICON -->
<link rel="icon" type="image" sizes="16x16" href="{{ asset('assets/images/logo/fav.jpg') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/logo/fav.jpg') }}">

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">


<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/fontawesome5/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor2/animate.css-master/animate.css') }}">


<!-- CUSTOM CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pond.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/gia.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/park.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.loader.css') }}">

<!-- GOOGLE FONTS -->
<link href="{{ asset('https://fonts.googleapis.com/css?family=Kanit:300,400,500,600') }}" rel="stylesheet">


<!-- CUSTOM CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor2/owlcarousel/css/owl.carousel.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor2/owlcarousel/css/owl.theme.default.min.css') }}">
<!-- zoom- -->
<link rel="stylesheet" type="text/css" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.0/aos.css') }}">

<link href="{{ asset('assets/vendor2/datepic/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet"/>

@yield('css_bottom')
<!-- Select2 -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->


    <!-- END HEADER -->
  </head>
<style>
.alert-danger{
    position: fixed;
    margin: 0px 0px 0px -200px !important;
    z-index: 9999;
    top: 50% !important;
    width: 400px !important;
    height: 100px;
    left: 50%;
    background-color: black;
    border-color: black;
    color: white;
}
.alert-success{
    position: fixed;
    margin: 0px 0px 0px -200px !important;
    z-index: 9999;
    top: 50% !important;
    width: 400px !important;
    height: 100px;
    left: 50%;
    background-color: black;
    border-color: black;
    color: white;
}
</style>

  <body>
    <!-- START NAVBAR -->
    <!-- Image and text -->
<!-- Desktop + ipad pro landscape Navbar -->
<nav class="navbar navbar-expand-lg d-xl-flex d-none black-bg px-0">
      <div class="custom-container nav-container black-bg">
        <div class=" row">
          <div class="col-6">
            <ul class="desktop-nav navbar-nav mr-auto ">
              <li class="nav-item active">
                 <a class="nav-link" href="{{ url('/') }}"><span style="font-weight : 400;">HOME</span></a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="{{ url('filter') }}"><span style="font-weight : 400;">LATEST</span></a>
                <div class="list">
                    <div class="list-container">
                      <div class="row">
                        <!-- col 1 -->
                        <div class="col-4 list-first-col">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link main" href="{{ url('filter') }}">View all Latest</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('brands') }}/{{ ('Men') }}">Latest Male</a>
                              <!-- <a class="nav-link" href="{{ url('filter/?genders=25') }}">Latest Male</a> -->
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('brands') }}/{{ ('Kid') }}">Latest Kid's</a>
                              <!-- <a class="nav-link" href="{{ url('filter?genders=27') }}">Latest Kid's</a> -->
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('brands') }}/{{ ('Women') }}">Latest Women's</a>
                              <!-- <a class="nav-link" href="{{ url('filter?genders=26') }}">Latest Women's</a> -->
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                </div>
              </li> <!-- Latest -->
              
              <li class="nav-item">
                <a class="nav-link" href="{{ url('filter') }}"><span style="font-weight : 400;">BRAND</span></a>
                <div class="list">
                    <div class="list-container">
                      <div class="row">
                        <!-- col 1 -->
                        <div class="col-12">
                          <div class="row">
                            <div class="col-12">
                              <div class="w-100">
                              <a class="nav-link main" href="{{ url('filter') }}">View all Brans and Designers</a>
                              </div>
                              <div class="column-box">
                                <div class="columns">
                                  <ul class="nav-ul-list">
                                    @foreach($category->result->childrenData->item as $key_category => $value_category)
                                      @if($value_category->name != 'Default Category')
                                        <li>
                                          <a class="nav-link" href="{{ url('brands') }}/{{ $value_category->name }}">{{ $value_category->name }}</a>
                                        </li>
                                      @endif
                                    @endforeach
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- END list container-->
                </div>
              </li> <!-- Brand -->

              <li class="nav-item">

                <!-- <a class="nav-link" href="{{ url('filter/?genders=25') }}"><span style="font-weight : 400;">MEN</span></a> -->
                <a class="nav-link" href="{{ url('brands/Men') }}"><span style="font-weight : 400;">MEN</span></a>
                <div class="list">
                    <div class="list-container">
                      <div class="row">
                        <!-- col 1 -->

                        <div class="column-box">
                          <div class="columns">
                            <ul class="nav-ul-list">
                              @foreach($category->result->childrenData->item as $key_category => $value_category)
                                @if($value_category->name != 'Default Category')
                                  <li>
                                    <a class="nav-link" href="{{ url('brands') }}/{{ $value_category->name }}/{{ ('Men') }}">{{ $value_category->name }}</a>
                                  </li>
                                @endif
                              @endforeach
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </li> <!-- MEN -->


              <li class="nav-item">
                <!-- <a class="nav-link" href="{{ url('filter/?genders=26') }}"><span style="font-weight : 400;">WOMEN</span></a> -->
                <a class="nav-link" href="{{ url('brands/Women') }}"><span style="font-weight : 400;">WOMEN</span></a>
                <div class="list">
                    <div class="list-container">
                      <div class="row">
                        <!-- col 1 -->
                        <div class="column-box">
                          <div class="columns">
                            <ul class="nav-ul-list">
                              @foreach($category->result->childrenData->item as $key_category => $value_category)
                                @if($value_category->name != 'Default Category')
                                  <li>
                                    <!-- <a class="nav-link" href="{{ url('filter/?genders=26&brands=') }}{{ $value_category->id }}">{{ $value_category->name }}</a> -->
                                    <a class="nav-link" href="{{ url('brands') }}/{{ $value_category->name }}/{{ ('Women') }}">{{ $value_category->name }}</a>
                                  </li>
                                @endif
                              @endforeach
                            </ul>
                          </div>
                        </div>
                        <!-- <div class="col-12 list-first-col">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link main" href="{{ url('filter') }}">NEW PRODUCTS</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Latest Sneakers</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Latest Women's</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">New This Week</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Restocks</a>
                            </li>
                          </ul>
                        </div> -->
                        <!-- col 2 -->
                        <!-- <div class="col-3 list-first-col">
                            <div class="row">
                              <div class="col-6">
                                <ul class="nav flex-column">
                                  <li class="nav-item">
                                    <a class="nav-link main" href="{{ url('filter') }}">CHLOTHES</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">All clothes</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Kid's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Women's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Trend</a>
                                  </li>
                                </ul>
                              </div>
                              <div class="col-6">
                                <ul class="nav flex-column">
                                  <li class="nav-item">
                                    <a class="nav-link main" href="{{ url('filter') }}">SCHOES</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">All clothes</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Kid's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Women's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Trend</a>
                                  </li>
                                </ul>
                            </div>
                            </div>
                        </div> -->
                        <!-- col  3-->
                        <!-- <div class="col-3">
                            <div class="row">
                              <div class="col-6">
                                <ul class="nav flex-column">
                                  <li class="nav-item">
                                    <a class="nav-link main" href="{{ url('filter') }}">Sport</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">All clothes</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Trend</a>
                                  </li>
                                </ul>
                              </div>
                              <div class="col-6">
                                <ul class="nav flex-column">
                                  <li class="nav-item">
                                    <a class="nav-link main" href="{{ url('filter') }}">Size</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">All clothes</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Kid's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Women's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Trend</a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                        </div> -->
                        <!-- col 4 -->
                        <!-- <div class="col-2">
                            <div class="row">
                              <div class="nav-col col-12">
                                <a href="{{ url('adidas') }}">
                                  <div class="nav-double">
                                    <img class="nav-product" src="assets/images/index/navbrand/4.jpg" alt="Card image cap">
                                  </div>
                                  <div class="w-100 text-center">
                                    <span>ADIDAS</span>
                                  </div>
                                </a>
                              </div>
                              <div class="nav-col col-12">
                                <a href="{{ url('adidas') }}">
                                  <div class="nav-double">
                                    <img class="nav-product" src="assets/images/index/navbrand/6.jpg" alt="Card image cap">
                                  </div>
                                  <div class="w-100 text-center">
                                    <span>ADIDAS</span>
                                  </div>
                                </a>
                              </div>
                            </div>
                        </div> -->
                      </div>
                    </div>
                </div>

              </li> <!-- WOMEN -->
              <li class="nav-item">

                <!-- <a class="nav-link" href="{{ url('filter/?genders=27') }}"><span style="font-weight : 400;">KID</span></a> -->
                <a class="nav-link" href="{{ url('brands/Kid') }}"><span style="font-weight : 400;">KID</span></a>
                <div class="list">
                    <div class="list-container">
                      <div class="row">
                        <!-- col 1 -->
                        <div class="column-box">
                          <div class="columns">
                            <ul class="nav-ul-list">
                              @foreach($category->result->childrenData->item as $key_category => $value_category)
                                @if($value_category->name != 'Default Category')
                                  <li>
                                    <!-- <a class="nav-link" href="{{ url('filter/?genders=27&brands=') }}{{ $value_category->id }}">{{ $value_category->name }}</a> -->
                                    <a class="nav-link" href="{{ url('brands') }}/{{ $value_category->name }}/{{ ('Kid') }}">{{ $value_category->name }}</a>
                                  </li>
                                @endif
                              @endforeach
                            </ul>
                          </div>
                        </div>
                        <!-- <div class="col-12 list-first-col">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link main" href="{{ url('filter') }}">NEW PRODUCTS</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Latest Sneakers</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Latest Women's</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">New This Week</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Restocks</a>
                            </li>
                          </ul>
                        </div> -->
                        <!-- col 2 -->
                        <!-- <div class="col-3 list-first-col">
                            <div class="row">
                              <div class="col-6">
                                <ul class="nav flex-column">
                                  <li class="nav-item">
                                    <a class="nav-link main" href="{{ url('filter') }}">CHLOTHES</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">All clothes</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Kid's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Women's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Trend</a>
                                  </li>
                                </ul>
                              </div>
                              <div class="col-6">
                                <ul class="nav flex-column">
                                  <li class="nav-item">
                                    <a class="nav-link main" href="{{ url('filter') }}">SCHOES</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">All clothes</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Kid's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Women's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Trend</a>
                                  </li>
                                </ul>
                            </div>
                            </div>
                        </div> -->
                        <!-- col  3-->
                        <!-- <div class="col-3">
                            <div class="row">
                              <div class="col-6">
                                <ul class="nav flex-column">
                                  <li class="nav-item">
                                    <a class="nav-link main" href="{{ url('filter') }}">Sport</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">All clothes</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Trend</a>
                                  </li>
                                </ul>
                              </div>
                              <div class="col-6">
                                <ul class="nav flex-column">
                                  <li class="nav-item">
                                    <a class="nav-link main" href="{{ url('filter') }}">Size</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">All clothes</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Kid's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Latest Women's</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ url('filter') }}">Trend</a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                        </div> -->
                        <!-- col 4 -->
                        <!-- <div class="col-2">
                            <div class="row">
                              <div class="nav-col col-12">
                                <a href="{{ url('adidas') }}">
                                  <div class="nav-double">
                                    <img class="nav-product" src="assets/images/index/navbrand/4.jpg" alt="Card image cap">
                                  </div>
                                  <div class="w-100 text-center">
                                    <span>ADIDAS</span>
                                  </div>
                                </a>
                              </div>
                              <div class="nav-col col-12">
                                <a href="{{ url('adidas') }}">
                                  <div class="nav-double">
                                    <img class="nav-product" src="assets/images/index/navbrand/6.jpg" alt="Card image cap">
                                  </div>
                                  <div class="w-100 text-center">
                                    <span>ADIDAS</span>
                                  </div>
                                </a>
                              </div>
                            </div>
                        </div> -->
                      </div>
                    </div>
                </div>

              </li> <!-- KID -->

             <!--  <li class="nav-item">
                <a class="nav-link" href="{{ url('sale') }}"><span style="font-weight : 400;">SALE</span></a>
                <div class="list">
                    <div class="list-container">
                      <div class="row">
                        <div class="col-2 list-first-col">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link main" href="{{ url('filter') }}">View all Latest</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Latest Kid's</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Latest Sneakers</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Latest Women's</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">New This Week</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Restocks</a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-2">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link main-2" href="{{ url('filter') }}">LATEST BRANDS</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Adidas</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('reebok') }}">Reebok</a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-2">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link main-2" href="{{ url('filter') }}">LATEST BRANDS</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('filter') }}">Adidas</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('reebok') }}">Reebok</a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-2">
                            <div class="row">
                              <div class="nav-col col-12">

                                <a href="{{ url('adidas') }}">
                                  <div class="nav-double">
                                    <img class="nav-product" src="assets/images/index/navbrand/15.jpg" alt="Card image cap">
                                  </div>
                                  <div class="w-100 text-center">
                                    <span>ADIDAS</span>
                                  </div>
                                </a>
                              </div>
                              <div class="nav-col col-12">

                                <a href="{{ url('adidas') }}">
                                  <div class="nav-double">
                                    <img class="nav-product" src="assets/images/index/navbrand/16.jpg" alt="Card image cap">
                                  </div>
                                  <div class="w-100 text-center">
                                    <span>ADIDAS</span>
                                  </div>
                                </a>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
              </li> -->

              <li class="nav-item">

                <a class="nav-link" href="{{ url('blog') }}"><span style="font-weight : 400;">BLOG</span></a>
                <div class="list">
                    <div class="list-container">
                      <div class="w-100 mb-3">
                        <span>READ DILOK. BLOG</span>
                      </div>
                          <div class="row">
                            <div class="col-12 blog-box">
                              <div class="row ">

                                @foreach($blocks->items as $key_blocks => $value_blocks)
                                @php
                                  preg_match('/<img.+url=[\'"](?P<src>.+?)[\'"].*>/i', $value_blocks->content, $image);
                                @endphp
                                  <div class="col-3 blog-row mb-3">
                                    <div class="row blog-row">
                                      <div class="col-4 blog-col">
                                        <a href="{{ url('single-blog') }}/{{ $value_blocks->id }}">
                                          <div class="nav-blog">
                                            @if(!empty($image['src']))
                                              <img class="nav-product" src="http://128.199.235.248/magento/pub/media/{{ $image['src'] }}"/>
                                            @else
                                              <img class="nav-product" src="{{ url('assets/images/No_Image_Available.jpg') }}">
                                            @endif
                                          </div>
                                        </a>
                                      </div>
                                      <div class="col-8 blog-row">
                                        <a href="{{ url('single-blog') }}/{{ $value_blocks->id }}">
                                          <div class="center-table nav-blog-text">
                                            <span>{{ $value_blocks->title }}</span>
                                          </div>
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach

                                  <!-- <div class="col-6 blog-row mb-3">
                                    <div class="row blog-row">
                                      <div class="col-4 blog-col">

                                        <a href="#">
                                          <div class="nav-blog">
                                            <img class="nav-product" src="assets/images/index/navbrand/10.jpg" alt="Card image cap">
                                          </div>
                                        </a>
                                      </div>
                                      <div class="col-8 blog-row">

                                        <a href="#">
                                          <div class="center-table nav-blog-text">
                                            <span>I'm vertically reatee layout.</span>
                                          </div>
                                        </a>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-6 blog-row mb-3">
                                    <div class="row blog-row">
                                      <div class="col-4 blog-col">

                                        <a href="#">
                                          <div class="nav-blog">
                                            <img class="nav-product" src="assets/images/index/navbrand/11.jpg" alt="Card image cap">
                                          </div>
                                        </a>
                                      </div>
                                      <div class="col-8 blog-row">

                                        <a href="#">
                                          <div class="center-table nav-blog-text">
                                            <span>I'm vertically reatee layout.</span>
                                          </div>
                                        </a>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-6 blog-row mb-3">
                                    <div class="row blog-row">
                                      <div class="col-4 blog-col">

                                        <a href="#">
                                          <div class="nav-blog">
                                            <img class="nav-product" src="assets/images/index/navbrand/12.jpg" alt="Card image cap">
                                          </div>
                                        </a>
                                      </div>
                                      <div class="col-8 blog-row">

                                        <a href="#">
                                          <div class="center-table nav-blog-text">
                                            <span>I'm vertically reatee layout.</span>
                                          </div>
                                        </a>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-6 blog-row mb-3">
                                    <div class="row blog-row">
                                      <div class="col-4 blog-col">

                                        <a href="#">
                                          <div class="nav-blog">
                                            <img class="nav-product" src="assets/images/index/navbrand/13.jpg" alt="Card image cap">
                                          </div>
                                        </a>
                                      </div>
                                      <div class="col-8 blog-row">

                                        <a href="#">
                                          <div class="center-table nav-blog-text">
                                            <span>I'm vertically reatee layout.</span>
                                          </div>
                                        </a>
                                      </div>
                                    </div>
                                  </div> -->

                              </div>
                            </div>
                            <!-- <div class="col-2 nav-col-single">
                              <div class="nav-blog-single mb-2">

                                <a href="#">
                                  <img class="nav-product" src="assets/images/index/navbrand/14.jpg" alt="Card image cap">
                                </a>
                              </div>
                              <div class="nav-blog-text text-center">

                                <a href="#">
                                 <span>This is dummy topic name.</span>
                                </a>
                              </div>
                            </div> -->

                          </div>
                    </div>
                </div>
              </li> <!-- BLOG -->
            </ul><!-- END TOP-LEFT NAVBAR -->
          </div>
          <div class="col-6">
            <ul class="navbar-nav desktop-nav ml-auto nav-cart-black">
              <li class="nav-item">
                <div class="input-group search-input-group">
                  <input type="text" class="form-control search-input white" placeholder="Search item" aria-label="Search item" aria-describedby="basic-addon2">

                  <div class="input-group-append">
                    <!-- ปุ่มขยาย ssearch มี script ใน Footerscript -->
                    <button class="btn search-btn toggle-search" onclick="expandsearch()" type="button"><i class="fa fa-search white" aria-hidden="true"></i></button>
                    <!-- ปุ่ม search -->
                    <button class="btn search-btn confirm-search" type="button"><i class="fa fa-search white" aria-hidden="true"></i></button>
                  </div>
                </div>
              </li>

              <li class="nav-item cart mr-3">
                <button class="btn btn-secondary cart-btn sidebarCollapse" type="button" >
                  <span style="font-weight : 400;"><i class="fa fa-shopping-cart" aria-hidden="true"></i> CART
                  @if(!empty($cart_customer))
                    @if(count($cart_customer) != '[]')
                      ({{ count($cart_customer) }})
                    @else
                      (0)
                    @endif
                  @else
                    (0)
                  @endif
                </span>
                </button>
              </li>
              <!-- logged in -->
              @if(!empty($token_customer))

                <li class="nav-item" style="margin-top: 5px;">
                  <div class="btn-group">
                    <button class="btn profile-btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                      <div class="center-table">
                        <!-- <span class="image-cropper">
                            <img class="profile-pic rounded" src="assets/images/index/person/1.jpg"/>
                        </span> -->
                        <span class="profile-name pl-2">{{ $token_customer->firstname }}</span>
                      </div>

                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ url('account') }}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                        <a class="dropdown-item" href="{{ url('order') }}"><i class="fa fa-list-alt" aria-hidden="true"></i> Order</a>
                        <a class="dropdown-item" href="{{ url('history-order') }}"><i class="fa fa-history" aria-hidden="true"></i> Order history</a>
                        <!-- <a class="dropdown-item" href="#">Action</a> -->
                        <!-- <a class="dropdown-item" href="#">Another action</a> -->
                        <a class="dropdown-item" href="{{ url('logout') }}"><i class="fa fa-sign-out-alt" aria-hidden="true"></i> Log out</a>
                    </div>
                  </div>
                </li>
              <!-- end loged in -->
              @else
                <li class="nav-item">
                     <div class="dropdown">
                       <button class="btn btn-secondary log-in-dropdown-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <span style="font-weight:400;"><i class="fa fa-sign-in-alt" aria-hidden="true"></i> Log in</span>
                       </button>
                       <div class="dropdown-menu dropdown-menu-right log-in-dropdown" aria-labelledby="dropdownMenuButton">
                             <form class="p-5 form_login_customer2">
                              <div class="form-group">
                                <label class="d-flex">Email address<span class="red">*</span><span class="red ml-auto">*Required fields</span></label>
                                <input type="email" name="email_login" class="form-control" aria-describedby="" placeholder="">
                              </div>
                              <div class="form-group">
                                <label class="d-flex">Password<span class="red">*</span><span class="ml-auto"><a class="grey" href="{{ url('forgot') }}">Forget your password?</a></span></label>
                                <input type="password" name="password_login" class="form-control" placeholder="">
                              </div>
                                <div class="regist-m-t2 text-center">
                                  <button class="btn regist-btn-1 btn_login_customer2" type="button">LOG IN</button>
                                </div>
                            </form>
                            <div class="create-account py-3">
                              <span><a class="black" href="{{ url('regist') }}">New? Create an account</a></span>
                            </div>
                       </div>
                     </div>
                </li>
              @endif
              <!-- END Not loged in -->
            </ul>
          </div>
        </div>
      </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light nav-border logo-nav d-xl-flex d-none px-0">
    <div class="custom-container nav-container logo-nav">
      <div class="row w-100 logo-nav">
        <div class="col-3">
          @if( URL::current()!=url('/') )
            <ol class="breadcrumb px-2 pull-left" style="top:0;">
              <li class="breadcrumb-item "><a href="{{ url('/') }}" class="text-dark">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
          @else
            <div class="py-4"><br></div>
          @endif
        </div>

        <div class="col-6 pt-3">
          <!-- <div class="w-100 h-100"> -->
            <div class="centering-logo mx-auto h-100">
              <a href="{{ url('/') }}">
                <div class="logo-lg-frame">
                  <img class="logo-lg" src="{{ url('assets/images/logo/logo.jpg') }}" alt="">
                </div>
              </a>
            </div>
          <!-- </div> -->
        </div>

        <div class="col-3">
          <ul id="languagepicker" >
            <div class="languagepicker roundborders large">
              
            
            <a href="#en"><li class="current-language"><img src="http://i64.tinypic.com/fd60km.png"/>English</li></a>
       <!--      <a href="#es"><li><img src="http://i68.tinypic.com/avo5ky.png"/>Español</li></a>
            <a href="#fr"><li><img src="http://i65.tinypic.com/300b30k.png"/>Français</li></a>
            <a href="#de"><li><img src="http://i63.tinypic.com/10zmzyb.png"/>German</li></a>
            <a href="#it"><li><img src="http://i65.tinypic.com/23jl6bn.png"/>Italiano</li></a>
            <a href="#nt"><li><img src="http://i65.tinypic.com/2d0kyno.png"/>Nederlands</li></a> -->
            <a href="#en"><li><img src="http://i65.tinypic.com/14llf13.gif"/>Thailand</li></a>
            </div>
          </ul>
        </div>

      </div>
    </div>
</nav>
<!-- ipad-pro and downward device width -->
<nav class="navbar mobile-nav navbar-expand-xl navbar-dark black-bg d-xl-none d-lg-flex">

  <div class="row w-100 h-100 mx-0">
    <div class="col-lg-5 col-md-5 col-4 px-0-nav" style="position:relative;">
      <button class="btn btn-secondary collapse-nav-btn pull-left nav-btn" type="button">
         <span><span class="navbar-toggler-icon"></span></span>
      </button>
    </div>
    <div class="col-lg-2 col-md-2 col-4 px-0-nav">
      <div class="w-100 h-100">
        <div class="centering-logo mx-auto h-100">
          <a href="{{ url('/') }}">
            <div class="logo-lg-frame">
              <img class="logo-lg" src="{{ url('assets/images/logo/logo-invert.png') }}" alt="">
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-5 col-md-5 col-4 px-0-nav">
      <button class="btn btn-secondary cart-btn sidebarCollapse pull-right" type="button">
        <span>
          <i class="fa fa-shopping-cart" aria-hidden="true"></i> 
        </span>
        <span class="d-xl-block d-lg-none d-md-none d-none">(0)</span>
      </button>
      <div class="input-group search-input-group pull-right d-lg-flex d-md-flex d-none">
        <input type="text" class="form-control search-input white" placeholder="Search item" aria-label="Search item" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <!-- ปุ่มขยาย ssearch มี script ใน Footerscript -->
          <button class="btn search-btn toggle-search" onclick="expandsearch()" type="button"><i class="fa fa-search white" aria-hidden="true"></i></button>
          <!-- ปุ่ม search -->
          <button class="btn search-btn confirm-search" type="button"><i class="fa fa-search white" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>

  </div>

</nav>

@yield('body')

<footer class="footer" style="height: 500px;">
  <div class="custom-container">
    <div class="row pt-lg-5 pt-md-5 pt-3 pb-2">
      <div class="col-xl-3 col-lg-3 col-md-12 col-12 d-lg-block d-none">
        <div class="w-100">
          <div class="centering-logo h-100 mb-5">
              <div class="logo-lg-frame-footer mx-lg-0 mx-md-auto text-lg-left text-md-center">
                <a href="{{ url('/') }}">
                <img class="logo-lg-footer" src="{{ url('assets/images/logo/logo-invert.png') }}" alt="">
                </a>
              </div>
          </div>

          <div class="contact-info row white mx-0">
             <div class="col-xl-2 col-lg-1 col-md-12 col-1 text-center">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
             </div>
              <div class="col-xl-10 col-lg-11 col-md-12 col-12 pr-xl-2 pl-lg-1 pr-lg-5 pl-md-0 mb-2 text-lg-left text-md-center">Street No. 12m Newyouk 12 md-123, USA Postcode 9706</div>
             <div class="col-xl-2 col-lg-1 col-md-12 col-1 text-center">
              <i class="fa fa-phone" aria-hidden="true"></i>
             </div>
              <div class="col-xl-10 col-lg-11 col-md-12 col-12 pr-xl-2 pl-lg-1 pr-lg-5 pl-md-0 mb-2 text-lg-left text-md-center">+66 89-123-4567</div>
             <div class="col-xl-2 col-lg-1 col-md-12 col-1 text-center">
              <i class="fa fa-envelope" aria-hidden="true"></i>
             </div>
             <div class="col-xl-10 col-lg-11 col-md-12 col-12 pr-xl-2 pl-lg-1 pr-lg-5 pl-md-0 mb-2 text-lg-left text-md-center">admin@dilok.com</div>
          </div>
        </div>
      </div>


      <div class="col-xl-6 col-lg-6 col-md-4 pt-5 d-lg-block d-none">
        <div class="row white mx-0 text-lg-left text-md-center">
           <div class="col-12 pr-lg-5 px-md-0 mb-lg-2 mb-md-1"><a href="{{ url('filter') }}" class="footer-link">BRAND</a></div>
           @foreach($category->result->childrenData->item as $key_category => $value_category)
              @if($value_category->name != 'Default Category')
                <div class="col-6 mb-1 footer-submenu"><a href="{{ url('filter/?brands=') }}{{ $value_category->id }}" class="footer-link">{{ $value_category->name }}</a></div>
              @endif
            @endforeach
           <!-- <div class="col-12 mb-1 footer-submenu"><a href="{{ url('filter') }}" class="footer-link">Adidas</a></div> -->
           <!-- <div class="col-12 mb-1 footer-submenu"><a href="{{ url('filter') }}" class="footer-link">Onisuka</a></div>
           <div class="col-12 mb-1 footer-submenu"><a href="{{ url('filter') }}" class="footer-link">Puma</a></div>
           <div class="col-12 mb-1 footer-submenu"><a href="{{ url('filter') }}" class="footer-link">Reebok</a></div> -->
        </div>
      </div>


      <!-- <div class="col-xl-3 col-lg-3 col-md-4 pt-5 d-lg-block d-none">
        <div class="row white mx-0 text-lg-left text-md-center">
           <div class="col-12 pr-lg-5 px-md-0 mb-lg-2 mb-md-1"><a href="#" class="footer-link">CAREGORIES</a></div>
           <div class="col-12 mb-1 footer-submenu"><a href="{{ url('filter') }}" class="footer-link">Basketball</a></div>
           <div class="col-12 mb-1 footer-submenu"><a href="{{ url('filter') }}" class="footer-link">Golf</a></div>
           <div class="col-12 mb-1 footer-submenu"><a href="{{ url('filter') }}" class="footer-link">Outdoor</a></div>
           <div class="col-12 mb-1 footer-submenu"><a href="{{ url('filter') }}" class="footer-link">Running</a></div>
           <div class="col-12 mb-1 footer-submenu"><a href="{{ url('filter') }}" class="footer-link">Tennis</a></div>
           <div class="col-12 mb-1 footer-submenu"><a href="{{ url('filter') }}" class="footer-link">Training</a></div>
        </div>
      </div> -->


      <div class="col-xl-3 col-lg-3 col-md-4 pt-5 d-lg-block d-none">
        <div class="row white mx-0 text-lg-left text-md-center">
           <div class="col-12 pr-lg-5 px-md-0 mb-lg-2 mb-md-1">ABOUT US</div>
            <div class="col-12 footer-submenu"><a href="{{ url('add-branch') }}" class="footer-link">Brach</a></div>
           <div class="col-12 mb-1 footer-submenu"><a href="{{ url('add-out-story') }}" class="footer-link">Out Story</a></div>

           <div class="col-12 pr-lg-5 px-md-0 my-md-2 my-lg-2 my-md-1"><a href="#" class="footer-link" data-toggle="modal" data-target="#helpful">HELPFUL</a></div>
           <div class="col-12 mb-1 footer-submenu"><a href="{{ url('add-blank') }}" class="footer-link">Policy</a></div>
           <div class="col-12 mb-1 footer-submenu"><a href="{{ url('add-blank') }}" class="footer-link">Term of use</a></div>
        </div>
      </div>

      <div class="col-12 py-1 mb-2 d-lg-none d-md-block">
        <div class="row justify-content-center text-center">
          <div class="col-11">
            <a class="icon-link round facebook"><i class="fab fa-facebook"></i></a>
            <a class="icon-link round twitter"><i class="fab fa-twitter"></i></a>
            <a class="icon-link round instagram"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>

      <div class="col-12 text-center white d-lg-none d-md-block">
        <button type="button" class="btn btn-primary language-picker " data-toggle="modal" data-target="#exampleModal">
          Language : <img class="pb-2 pr-2" src="http://i65.tinypic.com/2d0kyno.png"/><u>Nederlands</u>
        </button>
      </div>

      <div class="col-12 pt-2 text-center white">
          <span>Copyright 2018 © Dilok.com All right reserved<span>
          <p class="white d-lg-none d-md-block mb-0"><a class="white" href="{{ url('add-blank') }}">Term of use</a> | <a class="white" href="{{ url('add-blank') }}">Policy</a></p>
      </div>


    </div>
  </div>
</footer>



<!-- HELP -->
<div class="modal fade px-0" id="helpful" tabindex="-1" role="dialog" aria-labelledby="helpful" aria-hidden="true">
  <div class="modal-dialog account-modal-dialog " role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header justify-content-center border-0">
        <div class="text-center">
          <h3 class="modal-title help-head-modal" id="helpful">HOW CAN WE HELP?</h3>
        </div>
        <button type="button" class="close account-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body help-modal-body"><!-- MODAL BODY -->


        <div class="col-md-10 mx-auto">
          <div class="input-group mb-3">
            <input type="text" class="form-control help-input-all" placeholder="Search">
            <div class="input-group-append">
              <button class="btn help-input-group" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>

        <div class="row mt-md-4 mt-3">
          <div class="col-md-6 mb-md-5 mb-3">
            <h5>What is Lorem Ipsum?</h5>
            <div><a href="#" class="help-font-set">Lorem ipsum dolor sit amet, consectetur adipiscing elit?</a></div>
            <div><a href="#" class="help-font-set">Nunc cursus urna eget tellus posuere?</a></div>
            <div><a href="#" class="help-font-set">Lorem ipsum dolor sit amet, consectetur adipiscing elit?</a></div>
            <div><a href="#" class="help-font-set">Contrary to popular belief, Lorem Ipsum is not?</a></div>
          </div>
          <div class="col-md-6 mb-md-5 mb-3">
            <h5>Where can I get some</h5>
            <div><a href="#" class="help-font-set">There are many variations of passages of Lorem Ipsum?</a></div>
            <div><a href="#" class="help-font-set">But the majority have suffered alteration?</a></div>
            <div><a href="#" class="help-font-set">Don't look even slightly believable?</a></div>
            <div><a href="#" class="help-font-set">Lorem Ipsum generators on the Internet tend to?</a></div>
            <div class="mt-md-3"><a href="#" class="help-see-all" data-toggle="modal" data-target="#seeall">SEE ALL</a></div>
          </div>
          <div class="col-md-6 mb-md-5 mb-3">
            <h5>Where does it come from</h5>
            <div><a href="#" class="help-font-set">There are many variations of passages of Lorem Ipsum?</a></div>
            <div><a href="#" class="help-font-set">But the majority have suffered alteration?</a></div>
            <div><a href="#" class="help-font-set">Don't look even slightly believable?</a></div>
            <div><a href="#" class="help-font-set">Lorem Ipsum generators on the Internet tend to?</a></div>
            <div class="mt-md-3"><a href="#" class="help-see-all" data-toggle="modal" data-target="#seeall">SEE ALL</a></div>
          </div>
          <div class="col-md-6 mb-md-5 mb-3">
            <h5>What is Lorem Ipsum?</h5>
            <div><a href="#" class="help-font-set">There are many variations of passages of Lorem Ipsum?</a></div>
            <div><a href="#" class="help-font-set">But the majority have suffered alteration?</a></div>
            <div><a href="#" class="help-font-set">Don't look even slightly believable?</a></div>
            <div><a href="#" class="help-font-set">Lorem Ipsum generators on the Internet tend to?</a></div>
            <div class="mt-md-3"><a href="#" class="help-see-all" data-toggle="modal" data-target="#seeall">SEE ALL</a></div>
          </div>
          <div class="col-md-6 mb-md-5 mb-3">
            <h5>Where does it come from</h5>
            <div><a href="#" class="help-font-set">There are many variations of passages of Lorem Ipsum?</a></div>
            <div><a href="#" class="help-font-set">But the majority have suffered alteration?</a></div>
            <div><a href="#" class="help-font-set">Don't look even slightly believable?</a></div>
            <div><a href="#" class="help-font-set">Lorem Ipsum generators on the Internet tend to?</a></div>
            <div class="mt-md-3"><a href="#" class="help-see-all" data-toggle="modal" data-target="#seeall">SEE ALL</a></div>
          </div>
          <div class="col-md-6 mb-md-5 mb-3">
            <h5>What is Lorem Ipsum?</h5>
            <div><a href="#" class="help-font-set">Lorem ipsum dolor sit amet, consectetur adipiscing elit?</a></div>
            <div><a href="#" class="help-font-set">Nunc cursus urna eget tellus posuere?</a></div>
            <div><a href="#" class="help-font-set">Lorem ipsum dolor sit amet, consectetur adipiscing elit?</a></div>
            <div><a href="#" class="help-font-set">Contrary to popular belief, Lorem Ipsum is not?</a></div>
          </div>
          <div class="col-md-6 mb-md-5 mb-3">
            <h5>What is Lorem Ipsum?</h5>
            <div><a href="#" class="help-font-set">There are many variations of passages of Lorem Ipsum?</a></div>
            <div><a href="#" class="help-font-set">But the majority have suffered alteration?</a></div>
            <div><a href="#" class="help-font-set">Don't look even slightly believable?</a></div>
            <div><a href="#" class="help-font-set">Lorem Ipsum generators on the Internet tend to?</a></div>
            <div class="mt-md-3"><a href="#" class="help-see-all" data-toggle="modal" data-target="#seeall">SEE ALL</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SUB-HELP -->
<div class="modal fade px-0" id="seeall" tabindex="-1" role="dialog" aria-labelledby="seeall" aria-hidden="true">
  <div class="modal-dialog account-modal-dialog " role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header justify-content-center border-0" style="position: relative;">
        <div class="help-tab-position">
          <span>Help</span> > <span class="grey">Shipping</span>
        </div>
        <div class="text-center">
          <h3 class="modal-title help-head-modal" id="seeall">HOW CAN WE HELP?</h3>
        </div>
        <button type="button" class="close account-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body help-modal-body"><!-- MODAL BODY -->
        <div class="col-md-10 mx-auto">
          <div class="input-group mb-3">
            <input type="text" class="form-control help-input-all" placeholder="Search">
            <div class="input-group-append">
              <button class="btn help-input-group" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>

          <div class="col-md-10 mb-md-5 mx-auto">
            <div class="text-center">
              <h5>SHIPPING</h5>
            </div>

              <ul class="article-list px-3 mb-md-5" style="line-height: 30px;">
                <li>
                  <a href="#" class="black">Do you ship to my country?</a>
                </li>
                <li>
                  <a href="#" class="black">How much is shipping?</a>
                </li>
                <li>
                  <a href="#" class="black">Can I change the shipping address?</a>
                </li>
                <li>
                  <a href="#" class="black">Do I pay customs  import charges if I live outside the EU?</a>
                </li>
                <li>
                  <a href="#" class="black">How long does shipping take?</a>
                </li>
                <li>
                  <a href="#" class="black">Can I track my parcel?</a>
                </li>
                <li>
                  <a href="#" class="black">What couriers do you use for shipping?</a>
                </li>
                <li>
                  <a href="#" class="black">Do you ship to PO Box addresses?</a>
                </li>
                <li>
                  <a href="#" class="black">Do you ship to BFPO addresses?</a>
                </li>
                <li>
                  <a href="#" class="black">Can someone else sign for my shipment?</a>
                </li>
                <li>
                  <a href="#" class="black">What if I'm not home when it's delivered?</a>
                </li>
                <li>
                  <a href="#" class="black">How do I know if my item has been dispatched?</a>
                </li>
                <li>
                  <a href="#" class="black">Customs have asked me for further information. What should I do?</a>
                </li>
              </ul>

              <div class="text-center">
                <h5>CAN’T FIND WHAT YOU’RE LOOKING FOR?</h5>
              </div>

<!--               <div class="row"> -->
                <div class="col-md-6 mx-auto mt-lg-4 mt-3">
                  <div>
                     <button type="button" class="btn account-btn-save-ad w-100" data-toggle="modal" data-target="#email-us">EMAIL-US</button>
                  </div>
                </div>
<!--                 <div class="col-md-6">
                  <button type="button" class="btn help-live-chat w-100" style="position: relative;">
                    <i class="fa fa-circle text-success help-chat-online" aria-hidden="true"></i> LIVE CHAT
                  </button>
                </div> -->
<!--               </div> -->

              <div class="col-md-10 mx-auto">
                  <div class="text-center">
                    <p><b>Email:</b> admin@dilok.com</p>
                    <p><b>Telephone:</b> <span>++66 89-123-4567</span></p>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>


<!-- SEND EMAIL -->
<div class="modal fade px-0" id="email-us" tabindex="-1" role="dialog" aria-labelledby="email-us" aria-hidden="true">
  <div class="modal-dialog account-modal-dialog " role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header justify-content-center border-0">

        <div class="help-tab-position">
          <span>Help</span> > <span class="grey">Submit a request</span>
        </div>
        <div class="text-center">
          <h3 class="modal-title help-head-modal" id="email-us">HOW CAN WE HELP?</h3>
          <h5 class="modal-title" id="email-us">SEND A MESSAGE</h5>
        </div>
        <button type="button" class="close account-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body help-mail-body"><!-- MODAL BODY -->


        <div class="col-md-10 mx-auto">
          <div class="form-group">
            <label for="text"> <span>Name</span> <span class="text-danger">*</span> <span class="account-requited text-danger">Required fields</span></label>
            <input type="text" class="form-control" placeholder="">
          </div>
        </div>

        <div class="col-md-10 mx-auto">
          <div class="form-group">
            <label for="text"> <span>Your email address</span> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="">
          </div>
        </div>

        <div class="col-md-10 mx-auto">
          <div class="form-group">
            <label for="text"> <span>Subject</span> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="">
          </div>
        </div>

        <div class="col-md-10 mx-auto">
          <div class="form-group">
            <label for="text"> <span>Message</span> <span class="text-danger">*</span></label>
            <textarea class="form-control rounded-0" rows="3"></textarea>
          </div>
        </div>

        <div class="col-md-10 mx-auto">
          <div class="form-group">
            <label for="text"> <span>Phone number</span> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="">
          </div>
        </div>

        <div class="col-md-10 mx-auto">
          <div class="form-group">
            <label for="text"> <span>Order number</span> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="">
          </div>
        </div>


        <div class="col-md-10 mx-auto">
          <div class="form-group">
            <label for="text"> <span>Attachments</span> <span class="text-danger">*</span></label>
            <label class="help-filecontainer w-100">
              <div>
                <span class="help-paperclip"><i class="fa fa-paperclip" aria-hidden="true"></i></span>
                <span class="help-addfile">Add file</span>
                <span class="help-dropfiles">or drop files here.</span>
              </div>
                <input type="file" class="form-control">
            </label>
          </div>
        </div>


        <div class="col-md-6 mx-auto">
          <div class="form-group">
            <div>
              <button type="button" class="btn account-btn-save-ad w-100">SUBMIT</button>
            </div>
          </div>
        </div>

        <div class="col-md-10 mx-auto">
            <div class="text-center">
              <p><b>Email:</b> admin@dilok.com</p>
              <p><b>Telephone:</b> <span>++66 89-123-4567</span></p>
            </div>
        </div>
<!--
        <div class="col-md-6 mx-auto">
          <div class="form-group">
            <div>
              <button type="button" class="btn help-live-chat w-100" style="position: relative;">
                  <i class="fa fa-circle text-success help-chat-online" aria-hidden="true"></i> LIVE CHAT
              </button>
            </div>
          </div>
        </div>  -->

      </div>
    </div>
  </div>
</div>


</footer>

@yield('model')
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="{{ asset('node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor2/owlcarousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('https://cdn.rawgit.com/jackmoore/zoom/master/jquery.zoom.min.js') }}"></script>


    <script src="{{ asset('assets/vendor2/datepic/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor2/datepic/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('assets/js/jquery.loader.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.bootstrap-growl.min.js') }}"></script>

    <script type="text/javascript">
var url_gb = '{{url('')}}';
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



    $(document).ready(function () {

      $('#datepicker').datepicker({
         autoclose: true,
         todayHighlight: true,
         dateFormat: 'dd-mm-yyyy'
     });

      // when opening the sidebar
      $('.sidebarCollapse').on('click', function () {
          // open sidebar
          $('#sidebar').addClass('active');
          // $('body').addClass('push');
          // $('nav').addClass('push-nav');
          // $('footer').addClass('push-nav');
          // $('.custom-container').addClass('push-nav');
          $('.overlay').fadeIn();
          $('.collapse.in').toggleClass('in');
          $('a[aria-expanded=true]').attr('aria-expanded', 'false');
          $('.cart-product-name').each( function (){
            var name = this;
            var text = $(name).text();
            text = text.trim();
            if(text.length > 25){
              text = text.substr(0,25) + '....';
            }
            $(this).closest('div.cart-product-name').find('span').text(text);
          });
          $('.cart-product-size').each( function (){
            var name = this;
            var text = $(name).text();
            text = text.trim();
            if(text.length > 20){
              text = text.substr(0,20) + '....';
            }
            $(this).closest('div.cart-product-size').find('span').text(text);
          });
      });
      $('.nav-btn').on('click', function () {
          // open sidebar
          $('#nav-sidebar').addClass('active');
          // $('body').addClass('push-right');
          // $('nav').addClass('push-nav-right');
          // $('footer').addClass('push-nav-right');
          // $('.custom-container').addClass('push-nav-right');
          // fade in the overlay
          $('.overlay').fadeIn();
          $('.collapse.in').toggleClass('in');
          $('a[aria-expanded=true]').attr('aria-expanded', 'false');
      });
      $('.filter-sidebar-btn').on('click', function () {
          // open sidebar
          $('#filter-sidebar').addClass('active');
          // $('body').addClass('push-filter-right');
          // $('nav').addClass('push-filter-nav-right');
          // $('footer').addClass('push-filter-nav-right');
          // $('.custom-container').addClass('push-filter-nav-right');
          $('.overlay').fadeIn();
          $('.collapse.in').toggleClass('in');
          $('a[aria-expanded=true]').attr('aria-expanded', 'false');
      });
      $('.close-sidebar').on('click', function () {
        document.getElementById("mobile-sidebar").style.opacity = "0";
        $('.overlay').fadeOut();
      });
      // if dismiss or overlay was clicked
      $('.overlay , .language-picker').on('click', function () {
        // hide the sidebar
        $('#nav-sidebar').removeClass('active');
        $('#filter-sidebar').removeClass('active');
        $('#sidebar').removeClass('active');
        // $('body').removeClass('push');
        // $('nav').removeClass('push-nav');
        // $('footer').removeClass('push-nav');
        // $('.custom-container').removeClass('push-nav');
        // $('body').removeClass('push-right');
        // $('nav').removeClass('push-nav-right');
        // $('footer').removeClass('push-nav-right');
        // $('.custom-container').removeClass('push-nav-right');
        // $('body').removeClass('push-filter-right');
        // $('nav').removeClass('push-filter-nav-right');
        // $('footer').removeClass('push-filter-nav-right');
        // $('.custom-container').removeClass('push-filter-nav-right');
        // fade out the overlay
        $('.overlay').fadeOut();
      });
      // toggle  + and - in collapse btn
      function toggleChevron() {
          $(this).closest("div.promotion").find(".icon-collpase").toggleClass("fa-plus fa-minus");
      }
      {{-- document.getElementById("promotion-code").addEventListener("click", toggleChevron); --}}
      // END toggle  + and - in collapse btn
      // toggle  + and - in collapse mobile nav list
      $('.mobile-nav-list').on('click', function () {
        $(this).closest("div.promotion").find(".icon-collpase").toggleClass("fa-plus fa-minus");
      });
    });
// โหลด

    if(window.matchMedia("(min-width: 9000px)").matches){
      $(window).on('resize', function () {
        location.reload();
      });
    }

    function al_su(content,type){
      $(function() {
        setTimeout(function() {
            $.bootstrapGrowl(content, { type: type , align : 'center_middle'});
        }, 3000);
      });
    }

    function al_da(content,type){
      $(function() {
        setTimeout(function() {
            $.bootstrapGrowl(content, { type: type , align : 'center_middle'});
        }, 3000);
      });
    }

    $(window).on('load', function () {
  // $('body').loader('show');
      // LANGUAGE PICKER
      $(".large").bind('mouseover', function() {
        var languagecount = document.getElementById("languagepicker").getElementsByTagName("li").length
        language = languagecount;
        language = language * 41;
        $(this).css("height", language);
      });
      $(".large").bind('mouseleave', function() {
        language = 41;
        $(this).css("height", language);
      });
      
      // END LANGUAGE PICKER
        $( '.cart-product' ).each( function () {
           var iw = $(this).width();
           var ih = $(this).height();
           if(iw > ih){
             $(this).css({'width':'auto'});
             $(this).css({'height':100+'%'});
           }
           else if(ih > iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
           else if(ih == iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
        });
        $('.cart-product-frame').each( function (){
          if(window.matchMedia("(max-width: 414px)").matches){
            var iw = $(this).width();
            iw = iw * 0.55;
            iw2 = iw * 1.9;
            $(this).css({'height':iw2+'px'});
            $('.cart-col').css({'height':iw2+'px'});
            $('.cart-col-414').css({'height':iw2+'px'});
          }
          else{
            var iw = $(this).width();
            iw = iw * 0.55;
            $(this).css({'height':iw+'px'});
            $('.cart-col').css({'height':iw+'px'});
          }
        });
        // navbar
        $( '.nav-product' ).each( function () {
           var iw = $(this).width();
           var ih = $(this).height();
           if(iw > ih){
             $(this).css({'width':'auto'});
             $(this).css({'height':100+'%'});
           }
           else if(ih > iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
           else if(ih == iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
        });
        $('.nav-double').each( function (){
          var iw = $(this).width();
          if(window.matchMedia("(max-width: 1366px)").matches){
            iw = iw * 0.8;
            iw2 = iw * 0.9;
            $(this).css({'height':iw2+'px'});
            $('.nav-col').css({'height':iw+'px'});
          }
          else{
            iw = iw * 0.7;
            iw2 = iw * 0.8;
            $(this).css({'height':iw2+'px'});
            $('.nav-col').css({'height':iw+'px'});
          }
        });
        $('.nav-launches').each( function (){
          var iw = $(this).width();
          iw = iw * 0.6;
          $(this).css({'height':iw+'px'});
          $('.launches-col').css({'height':iw+'px'});
        });
        $('.nav-blog').each( function (){
          var iw = $(this).width();
          // iw = iw * 0.5;
          if(window.matchMedia("(max-width: 1366px)").matches){
            iw = iw * 1.1;
            $(this).css({'height':iw+'px'});
            $('.blog-col').css({'height':iw+'px'});
            $('.blog-row').css({'height':iw+'px'});
          }
          else{
            $(this).css({'height':iw+'px'});
            $('.blog-col').css({'height':iw+'px'});
            $('.blog-row').css({'height':iw+'px'});
          }
        });
        $('.nav-blog-single').each( function (){
          var iw = $(this).width();
          // iw = iw * 1.2;
          if(window.matchMedia("(max-width: 1366px)").matches){
            iw2 = iw * 1.5;
            $(this).css({'height':iw2+'px'});
            $(this).css({'width':iw2+'px'});
            $('.nav-col-single').css({'height':iw2+'px'});
          }
          else{
            $(this).css({'height':iw+'px'});
            $('.nav-col-single').css({'height':iw+'px'});
          }
        });
        $('.nav-blog-text').each( function (){
          var name = this;
          var text = $(name).text();
          text = text.trim();
          if(text.length > 30){
            text = text.substr(0,30) + '....';
          }
          $(this).closest('div').find('span').text(text);
        });
        $('.profile-name').each(function (){
          if(window.matchMedia("(max-width: 1366px)").matches){
            var name = this;
            var text = $(name).text();
            text = text.trim();
            if(text.length > 10){
              text = text.substr(0,10) + '...';
            }
            $(this).closest('div').find('.profile-name').text(text);
          }
          else{
            var name = this;
            var text = $(name).text();
            text = text.trim();
            if(text.length > 25){
              text = text.substr(0,25) + '...';
            }
            $(this).closest('div').find('.profile-name').text(text);
          }
        });
        $('.logo-lg-frame').each( function (){
          var iw = $(this).height();
          if(window.matchMedia("(max-width: 1366px)").matches){
            iw = iw * 2;
            $(this).closest('div.centering-logo').css({'width':iw+'px'});
            $(this).css({'width':iw+'px'});
          }
          else{
            iw = iw * 2;
            $(this).closest('div.centering-logo').css({'width':iw+'px'});
            $(this).css({'width':iw+'px'});
          }
        });
        $( '.logo-lg' ).each( function () {
           var iw = $(this).width();
           var ih = $(this).height();
           if(iw > ih){
             $(this).css({'width':'auto'});
             $(this).css({'height':100+'%'});
           }
           else if(ih > iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
           else if(ih == iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
        });
        $('.logo-lg-frame-footer').each( function (){
          var iw = $(this).width();
          if(window.matchMedia("(max-width: 768px)").matches){
            iw = iw * 0.15;
            $(this).closest('div.centering-logo').css({'height':iw+'px'});
            $(this).css({'height':iw+'px'});
          }
          else if(window.matchMedia("(max-width: 1024px)").matches){
            iw = iw * 0.35;
            $(this).closest('div.centering-logo').css({'height':iw+'px'});
            $(this).css({'height':iw+'px'});
          }
          else if(window.matchMedia("(max-width: 1366px)").matches){
            iw = iw * 0.3;
            $(this).closest('div.centering-logo').css({'height':iw+'px'});
            $(this).css({'height':iw+'px'});
          }
          else{
            iw = iw * 0.26;
            $(this).closest('div.centering-logo').css({'height':iw+'px'});
            $(this).css({'height':iw+'px'});
          }
        });
        $( '.logo-lg-footer' ).each( function () {
           var iw = $(this).width();
           var ih = $(this).height();
           if(iw > ih){
             $(this).css({'width':'auto'});
             $(this).css({'height':100+'%'});
           }
           else if(ih > iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
           else if(ih == iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
        });
        $('.loading').addClass('opa0');
        // LASTEST PRODUCT SLIDE IN INC FOLDER
        $('.latest-slide').owlCarousel({
            nav:true,
            dot:true,
            navText:["",""],
            items:4,
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
                  items : 3,
                },
                1366 : {
                    items : 3,
                },
                1367 : {
                    items : 4,
                }
            },
            // onChanged: callback
        });
        $('.latest-slide').find('.owl-nav').removeClass('disabled');
        $('.latest-slide').find('.owl-next').removeClass('disabled');

        if(window.matchMedia("(max-width: 414px)").matches){
        }
        else{
          $('.latest-slide').find('.owl-dots').removeClass('disabled');
        }

        $('.latest-slide').find('.owl-next').addClass('latest-next arrow-fadein');
        $('.latest-slide').find('.owl-next').append("<i class='fas fa-angle-right fa-5x'></i>");
        $('.latest-slide').find('.owl-prev').removeClass('disabled');
        $('.latest-slide').find('.owl-prev').addClass('latest-prev');
        $('.latest-slide').find('.owl-prev').append("<i class='fas fa-angle-left fa-5x'></i>");
        $('.latest-slide').on('translated.owl.carousel', function(e) {
          $('.latest-slide .owl-stage .owl-item.active').each(function(){
              if($(this).closest('.owl-stage').find('.active .item').hasClass('first'))
              {
                $(this).closest('.owl-carousel').find('.latest-prev').removeClass('arrow-fadein');
              }
              else{
                $(this).closest('.owl-carousel').find('.latest-prev').addClass('arrow-fadein');
              }
              if($(this).closest('.owl-carousel').find('.active .item').hasClass('last'))
              {
                $(this).closest('.owl-carousel').find('.latest-next').removeClass('arrow-fadein');
              }
              else{
                $(this).closest('.owl-carousel').find('.latest-next').addClass('arrow-fadein');
              }
          });
        });
        $('.latest-product-frame').each( function (){
          var iw = $(this).width();
          if(window.matchMedia("(max-width: 320px)").matches){
            iw2 = iw * 1.8;
            iw = iw * 0.7;
            $(this).css({'height':iw+'px'});
          }
          else if(window.matchMedia("(max-width: 414px)").matches){
            iw2 = iw * 1.5;
            iw = iw * 0.7;
            $(this).css({'height':iw+'px'});
          }
          else if(window.matchMedia("(max-width: 1024px)").matches){
            iw2 = iw * 1.6;
            iw = iw * 0.8;
            $(this).css({'height':iw+'px'});
          }
          else if(window.matchMedia("(max-width: 1366px)").matches){
            iw2 = iw * 1.2;
            iw = iw * 0.8;
            $(this).css({'height':iw+'px'});
          }
          else{
            iw2 = iw * 1.2;
            iw = iw * 0.8;
            $(this).css({'height':iw+'px'});
          }
        });
        $( '.latest-product-pic' ).each( function () {
           var iw = $(this).width();
           var ih = $(this).height();
           if(iw > ih){
             $(this).css({'width':'auto'});
             $(this).css({'height':100+'%'});
           }
           else if(ih > iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});

           }
           else if(ih == iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
        });
        $('.product-title').each( function (){
          var name = this;
          var text = $(name).find('span').text();
          text = text.trim();
          if(window.matchMedia("(max-width: 414px)").matches){
            if(text.length > 12){
              text = text.substr(0,12) + '....';
            }
          }
          else if(window.matchMedia("(max-width: 1024px)").matches){
            if(text.length > 15){
              text = text.substr(0,15) + '....';
            }
          }
          else{
            if(text.length > 20){
              text = text.substr(0,20) + '....';
            }
          }
          $(this).closest('div.product-title').find('span').text(text);
        });
        $('.product-categories').each( function (){
          var name = this;
          var text = $(name).find('span').text();
          text = text.trim();
          if(text.length > 20){
            text = text.substr(0,20) + '....';
          }
          $(this).closest('div.product-categories').find('span').text(text);
        });
        // END LASTEST PRODUCT SLIDE IN INC FOLDER
        // INDEX PICTURE MANAGEMENT
        $( '.product-series-img' ).each( function () {
           var iw = $(this).width();
           var ih = $(this).height();
           if(iw > ih){
             $(this).css({'width':'auto'});
             $(this).css({'height':100+'%'});
           }
           else if(ih > iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
           else if(ih == iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
        });
        $('.product-series-frame').each( function (){
          if(window.matchMedia("(max-width: 768px)").matches){
            var iw = $(this).width();
            iw = iw * 0.5;
            $(this).css({'height':iw+'px'});
            $('.product-series-col');
          }
          else if(window.matchMedia("(max-width: 1024px)").matches){
            var iw = $(this).width();
            iw = iw * 0.6;
            $(this).css({'height':iw+'px'});
            $('.product-series-col');
          }
          else{
            var iw = $(this).width();
            iw = iw * 0.6;
            $(this).css({'height':iw+'px'});
            $('.product-series-col');
          }
        });

        $('.slide-brand-frame').each( function (){
          var iw = $(this).width();
            iw = iw * 0.3;
            $(this).closest('div.item').css({'height':iw+'px'});
            $(this).css({'height':iw+'px'});
        });
        $( '.slide-brand-img' ).each( function () {
           var iw = $(this).width();
           var ih = $(this).height();
           if(iw > ih){
             $(this).css({'width':'auto'});
             $(this).css({'height':100+'%'});
           }
           else if(ih > iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
           else if(ih == iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
        });

        $( '.blog-img' ).each( function () {
           var iw = $(this).width();
           var ih = $(this).height();
           if(iw > ih){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
           else if(ih > iw){
             $(this).css({'width':'auto'});
             $(this).css({'height':100+'%'});
           }
           else if(ih == iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
        });
        $('.blog-img-frame').each( function (){
          if(window.matchMedia("(max-width: 320px)").matches){
            var iw = $(this).width();
            iw2 = iw * 0.9;
            iw3 = iw2 / 5.5;
            iw = iw * 0.5;
            $(this).css({'height':iw+'px'});
            $('.blog-img-col').css({'height':iw2+'px'});
            $('.blog-excerpt').css({'height':iw3+'px'});
          }
          else if(window.matchMedia("(max-width: 414px)").matches){
            var iw = $(this).width();
            iw2 = iw * 0.8;
            iw3 = iw2 / 6;
            iw = iw * 0.5;
            $(this).css({'height':iw+'px'});
            $('.blog-img-col').css({'height':iw2+'px'});
            $('.blog-excerpt').css({'height':iw3+'px'});
          }
          else if(window.matchMedia("(max-width: 768px)").matches){
            var iw = $(this).width();
            iw2 = iw * 0.7;
            iw3 = iw2 / 8;
            iw = iw * 0.5;
            $(this).css({'height':iw+'px'});
            $('.blog-img-col').css({'height':iw2+'px'});
            $('.blog-excerpt').css({'height':iw3+'px'});
          }
          else if(window.matchMedia("(max-width: 1024px)").matches){
            var iw = $(this).width();
            iw2 = iw * 0.75;
            iw3 = iw2 / 8;
            iw = iw * 0.6;
            $(this).css({'height':iw+'px'});
            $('.blog-img-col').css({'height':iw2+'px'});
            $('.blog-excerpt').css({'height':iw3+'px'});
          }
          else if(window.matchMedia("(max-width: 1366px)").matches){
            var iw = $(this).width();
            iw2 = iw * 0.75;
            iw3 = iw2 / 10;
            iw = iw * 0.6;
            $(this).css({'height':iw+'px'});
            $('.blog-img-col').css({'height':iw2+'px'});
            $('.blog-excerpt').css({'height':iw3+'px'});
          }
          else if(window.matchMedia("(max-width: 1680px)").matches){
            var iw = $(this).width();
            iw2 = iw * 0.6;
            iw3 = iw2 / 10;
            iw = iw * 0.7;
            $(this).css({'height':iw+'px'});
            $('.blog-img-col').css({'height':iw2+'px'});
            $('.blog-excerpt').css({'height':iw3+'px'});
          }
          else{
            var iw = $(this).width();
            iw2 = iw * 0.65;
            iw3 = iw2 / 11.8;
            iw = iw * 0.5;
            $(this).css({'height':iw+'px'});
            $('.blog-img-col').css({'height':iw2+'px'});
            $('.blog-excerpt').css({'height':iw3+'px'});
          }
        });
        //END INDEX PICTURE MANAGEMENT

        $( '.product-desktop-img' ).each( function () {
           var iw = $(this).width();
           var ih = $(this).height();
           if(iw > ih){
             $(this).css({'width':'auto'});
             $(this).css({'height':100+'%'});
           }
           else if(ih > iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
           else if(ih == iw){
             $(this).css({'width':100+'%'});
             $(this).css({'height':'auto'});
           }
        });

        $('.product-desktop-frame').each( function (){
            var iw = $(this).width();
            $(this).css({'height':iw+'px'});
            $('.product-desktop-col').css({'height':iw+'px'});
        });

        $('.product-detail-left-side').each( function (){
          var iw = $(this).height();
          $('.product-detail-right-side').css({'height':iw+'px'});
        });


        // PRODUCT DETAILS 2 PAGE
        $('.productdetail2-carousel').owlCarousel({
            items:1,
            loop:true,
            margin:10,
            video:true,
            lazyLoad:true,
            center:true,
            navText:["",""],
        })
        // END PRODUCT DETAILS 2 PAGE

        // PRODUCT DETAILS 1 PAGE
        $('.productdetail1-carousel').owlCarousel({
            items:7,
            responsive : {
                0 : {
                  items : 1,
                  dot:false,
                },
                1024 : {
                  items : 5,
                },
                1366 : {
                    items : 7,
                },
            },
            loop:false,
            margin:5,
            video:true,
            lazyLoad:true,
            mouseDrag:false,
            touchDrag:false,
            navText:["",""],
        })

        $('.productdetail1-carousel').find('.owl-nav').removeClass('disabled');
        $('.productdetail1-carousel').find('.owl-nav').addClass('opa0');
        $('.productdetail1-carousel').find('.owl-next').removeClass('disabled');
        $('.productdetail1-carousel').find('.owl-next').addClass('latest-next1 arrow-fadein');
        $('.productdetail1-carousel').find('.owl-next').append("<i class='fas fa-angle-right fa-3x'></i>");
        $('.productdetail1-carousel').find('.owl-prev').removeClass('disabled');
        $('.productdetail1-carousel').find('.owl-prev').addClass('latest-prev1 arrow-fadein');
        $('.productdetail1-carousel').find('.owl-prev').append("<i class='fas fa-angle-left fa-3x'></i>");

        // END PRODUCT DETAILS 1 PAGE

    });
    // end window onload and resize

    function expandsearch(){
      $(".toggle-search").css({"display": "none"});
      $(".confirm-search").css({"display": "block"});
      $(".search-input").css({"animation-name": "expand","right": "0%"});
    }
    window.onclick =  function collapsesearch() {
      var display = $(".search-input").css("animation-name");
      if(display != 'none'){
        $(".toggle-search").css({"display": "block"});
        $(".confirm-search").css({"display": "none"});
        $(".search-input").css({"animation-name": "collapse","right": "-100%"});
      }
    }
    $(".toggle-search").click(false);
    $(".confirm-search").click(false);
    $(".search-input").click(false);
    // heart button js
    $("i[name='like-button']").click(function(){
        $(this).removeClass('liked-shaked');
        $(this).toggleClass('liked');
        $(this).toggleClass('not-liked');
        $(this).toggleClass('far');
        $(this).toggleClass('fas');
        if($(this).hasClass("liked")) {
            $(this).addClass('liked-shaked');
        }

    });

$('body').on('click','.btn_login_customer',function(){
  var form = $('.form_login_customer').serializeArray();
  $('body').loader('show');
    $.ajax({
      method : "POST",
      url : url_gb+"/login_customer",
      dataType: "JSON",
      data : form,
    }).done(function(rec){
      if(rec.status==1){
        $('.form_login_customer')[0].reset();
        al_su(rec.content,'success');
        window.location.href = url_gb;
        $('body').loader('hide');
      } else if(rec.status == 3){
        $('body').loader('hide');
        al_su(rec.content,'danger');
      } else {
        $('body').loader('hide');
        al_su(rec.content,'danger');
      }
    }).fail(function(e){
      al_su('Error','danger');
      $('body').loader('hide');
  });
});

$('body').on('click','.btn_login_customer2',function(){
  var form = $('.form_login_customer2').serializeArray();
  $('body').loader('show');
    $.ajax({
      method : "POST",
      url : url_gb+"/login_customer",
      dataType: "JSON",
      data : form,
    }).done(function(rec){
      if(rec.status==1){
        $('.form_login_customer2')[0].reset();
        al_su(rec.content,'success');
        window.location.href = url_gb;
        $('body').loader('hide');
      } else if(rec.status == 3){
        $('body').loader('hide');
        al_su(rec.content,'danger');
      } else {
      $('body').loader('hide');
        al_su(rec.content,'danger');
      }
    }).fail(function(){
      $('body').loader('hide');
      al_su('Error','danger');
  });
});

$('body').on('click','.btn_add_to_cart',function(){
  var data = $(this).data('product_detail');
  var price = $(this).data('price_product');
  var product_id = $(this).data('product_id');
  $('body').loader('show');
    $.ajax({
      method : "POST",
      url : url_gb+"/addproducttocart",
      dataType: "JSON",
      data : { 'product' :data , 'price' : price ,'product_id':product_id},
    }).done(function(rec){
      if(rec.status==1){
        al_su(rec.content,'success');
        location.reload();
        $('body').loader('hide');
      } else if(rec.status == 2){
        $('body').loader('hide');
        al_su(rec.content,'danger');
        window.location.href = url_gb+'/regist';
      } else if(rec.status == 3){
        al_su(rec.content,'danger');
        $('body').loader('hide');
      }else{
        $('body').loader('hide');
        al_su(rec.content,'danger');
      }
    }).fail(function(){
        $('body').loader('hide');
        al_su('Error','danger');
  });
});

$('body').on('click','.delete_cart_product',function(){
  var data = $(this).data('product_sku');
  var id_sku = $(this).data('id_sku');
  $('body').loader('show');
    $.ajax({
      method : "POST",
      url : url_gb+"/deleteproducttocart",
      dataType: "JSON",
      data : { 'product' :data , 'id_sku' : id_sku},
    }).done(function(rec){
      if(rec.status==1){
        al_su(rec.content,'success');
        location.reload();
        $('body').loader('hide');
      }else{
        $('body').loader('hide');
        al_su(rec.content,'danger');
      }
    }).fail(function(){
        $('body').loader('hide');
        al_su('Error','danger');
  });
});

$('body').on('click','.pageination_list',function(){
  var data = $(this).data('pageination_detail');
  var page_list = $(this).data('page_list');
  $('body').loader('show');
    $.ajax({
      method : "POST",
      url : url_gb+"/filter_page_list",
      dataType : "JSON",
      data : { 'product_main_page' : data , 'page_list' : page_list},
    }).done(function(rec){
      console.log(rec.status);
      $('#filter_data_page_main').remove();
      $('#filter_data_search_page_list').html(rec);
      $('body').loader('hide');
    }).fail(function(){
      console.log('Error');
      $('body').loader('hide');
    });
});

</script>

@yield('js_bottom')
