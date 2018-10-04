@extends('welcome')
@section('body')
<!-- START CONTENT -->
<div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        @include('filter-sidebar')
        <!-- END CART SIDEBAR -->
<div class="row mt-5">
          <div class="col-xl-2 col-lg-3 fillter-d-n3" id="myDIV">
            <section class="filter">
               <form class="form-group">
                    <button class="btn fillter-bg px-0" type="button" data-toggle="collapse" data-target="#collapseExample111" aria-expanded="false" aria-controls="collapseExample">
                        <span class="fillter-font2 pull-left">SELECTED</span>
                        <span class="fas fa-chevron-down pull-right" aria-hidden="true"></span>
                    </button>
                    <div class="collapse show" id="collapseExample111">
                        <div class="mt-2">
                            <div class="row flex-xl-row">
                                <span class="fillter-block fillter-select fillter-font3">
                                  <a href="#" class="fas fa-times fillter-close pr-2"></a>Male
                                </span>
                                <span class="fillter-block fillter-select fillter-font3">
                                  <a href="#" class="fas fa-times fillter-close pr-2"></a>Adidas
                                </span>
                                <span class="fillter-block fillter-select fillter-font3">
                                  <a href="#" class="fas fa-times fillter-close pr-2"></a>Adidas
                                </span>
                                <span class="fillter-block fillter-select fillter-font3">
                                  <a href="#" class="fas fa-times fillter-close pr-2"></a>Adidas
                                </span>
                                <span class="fillter-block fillter-select fillter-font3">
                                  <a href="#" class="fas fa-times fillter-close pr-2"></a>Adidas
                                </span>
                                <span class="fillter-block fillter-select fillter-font3">
                                  <a href="#" class="fas fa-times fillter-close pr-2"></a>Adidas
                                </span>
                                <span class="fillter-block fillter-select fillter-font3">
                                  <a href="#" class="fas fa-times fillter-close pr-2"></a>onitsuka
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <form class="form-group">
                      <button class="btn fillter-bg px-0" type="button" data-toggle="collapse" data-target="#collapseExample222" aria-expanded="false" aria-controls="collapseExample">
                          <span class="fillter-font2 pull-left">GENDER</span>
                          <span class="fas fa-chevron-down pull-right" aria-hidden="true"></span>
                      </button>
                      <div class="collapse show" id="collapseExample222">
                          <div class="filter-scroll">
                              <label class="check">
                                  <div class="regist-m-l2 pt-1 fillter-font3">Male</div>
                                  <input type="checkbox"/>
                                  <span class="checkmark"></span>
                              </label>
                              <label class="check">
                                  <div class="regist-m-l2 pt-1 fillter-font3">Female</div>
                                  <input type="checkbox"/>
                                  <span class="checkmark"></span>
                              </label>
                                  <label class="check">
                                  <div class="regist-m-l2 pt-1 fillter-font3">Kids</div>
                                  <input type="checkbox"/>
                                  <span class="checkmark"></span>
                              </label>
                          </div>
                      </div>
                  </form>
                  <hr>
                  <form class="form-group">
                        <button class="btn fillter-bg px-0" type="button" data-toggle="collapse" data-target="#collapseExample333" aria-expanded="false" aria-controls="collapseExample">
                            <span class="fillter-font2 pull-left">BRAND</span>
                            <span class="fas fa-chevron-down pull-right" aria-hidden="true"></span>
                        </button>
                        <div class="collapse show" id="collapseExample333">
                            <div class="filter-scroll">
                                <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Adidas</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Adidas</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Albam</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                    <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Alltimers</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                </label>
                                    <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Andersons</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                </label>
                                    <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Aries</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                </label>
                                    <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Armor-lux</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                </label>
                                    <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Arpenteur</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                </label>
                                    <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Asics</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                </label>
                                    <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Axel Arigato</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                </label>
                                    <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Barbour</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                </label>
                                    <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Beams Plus</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </form>
                  <hr>
                  <form class="form-group">
                        <button class="btn fillter-bg px-0" type="button" data-toggle="collapse" data-target="#collapseExample444" aria-expanded="false" aria-controls="collapseExample">
                            <span class="fillter-font2 pull-left">CLOTHING SIZE</span>
                            <span class="fas fa-chevron-down pull-right" aria-hidden="true"></span>
                        </button>
                        <div class="collapse show" id="collapseExample444">
                            <div class="filter-scroll">
                                <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">One Size</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">XX-Small</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">X-Small</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                    <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Small</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                                </label>
                                    <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">Medium</div>
                                    <input type="checkbox"/>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <form class="form-group">
                          <button class="btn fillter-bg px-0" type="button" data-toggle="collapse" data-target="#collapseExample555" aria-expanded="false" aria-controls="collapseExample">
                              <span class="fillter-font2 pull-left">FOOTWEAR SIZE</span>
                              <span class="fas fa-chevron-down pull-right" aria-hidden="true"></span>
                          </button>
                          <div class="collapse show" id="collapseExample555">
                              <div class="filter-scroll">
                                  <label class="check">
                                      <div class="regist-m-l2 pt-1 fillter-font3">UK 3</div>
                                      <input type="checkbox"/>
                                      <span class="checkmark"></span>
                                  </label>
                                  <label class="check">
                                      <div class="regist-m-l2 pt-1 fillter-font3">UK 3.5</div>
                                      <input type="checkbox"/>
                                      <span class="checkmark"></span>
                                  </label>
                                  <label class="check">
                                      <div class="regist-m-l2 pt-1 fillter-font3">UK4</div>
                                      <input type="checkbox"/>
                                      <span class="checkmark"></span>
                                  </label>
                                      <label class="check">
                                      <div class="regist-m-l2 pt-1 fillter-font3">UK4.5</div>
                                      <input type="checkbox"/>
                                      <span class="checkmark"></span>
                                  </label>
                                  </label>
                                      <label class="check">
                                      <div class="regist-m-l2 pt-1 fillter-font3">UK 5</div>
                                      <input type="checkbox"/>
                                      <span class="checkmark"></span>
                                  </label>
                              </div>
                          </div>
                      </form>
                      <hr>
                      <form class="form-group">
                            <button class="btn fillter-bg px-0" type="button" data-toggle="collapse" data-target="#collapseExample666" aria-expanded="false" aria-controls="collapseExample">
                                <span class="fillter-font2 pull-left">COLOR</span>
                                <span class="fas fa-chevron-down pull-right" aria-hidden="true"></span>
                            </button>
                            <div class="collapse show" id="collapseExample666">
                                <div class="filter-scroll">
                                    <label class="check">
                                        <div class="regist-m-l2 pt-1 fillter-font3">Black</div>
                                        <input type="checkbox"/>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="check">
                                        <div class="regist-m-l2 pt-1 fillter-font3">Blue</div>
                                        <input type="checkbox"/>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="check">
                                        <div class="regist-m-l2 pt-1 fillter-font3">Brown</div>
                                        <input type="checkbox"/>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="check">
                                        <div class="regist-m-l2 pt-1 fillter-font3">Burgundy</div>
                                        <input type="checkbox"/>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="check">
                                        <div class="regist-m-l2 pt-1 fillter-font3">Gold</div>
                                        <input type="checkbox"/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                      </form>
                    <hr>
                 </div>
            </section>
            <div class="filtered-item filtered-item3 col-xl-10 col-lg-9 col-md-12 fadeIn animated">
              <div class="row mx-0">
                    <div class="col-xl-6 col-lg-5 col-12">
                        <div class="filter-overlay-banner">
                            <img src = "assets/images/product/reebok.jpg" class="filter-image-banner">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12 pr-3 pl-3">
                        <div class="col-xl-2 col-lg-2 col-md-1 col-3">
                            <div class="filter-overlay-banner2 filter-m-l2">
                                <img src = "assets/images/logo/reebok2.png" class="filter-image-banner2">
                            </div>
                        </div>
                        <div class="fillter-font5 filter-overflow filter-p2 text-center text-lg-left text-md-left">
                          simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                          standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                          it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                        </div>
                    </div>
                </div>
                  <div class="row mt-5 mx-0">
                      <div class="col-md-3 col-12 d-md-block d-lg-none d-xl-none fillter-r-l filter-m-l">
                          <button class="btn btn-fillter filter-sidebar-btn pull-right" type="button">
                              <span class="black"> filter </span>
                          </button>
                      </div>
                      <div class="col-xl-2 col-lg-3 fillter-d-n1   pl-4">
                          <button onclick="myFunction()" class="btn btn-hide" id="demo">hide filter</button>
                      </div>
                      <div class="col-xl-10 col-lg-9 col-md-9 col-12">
                          <div class="row filter-pt-3 filter-p3 mx-0">
                              <div class="col-xl-11 col-9 col-lg-9 col-md-10 text-left text-lg-right text-md-right mt-2 order-1 order-lg-2 order-md-1">
                                  <div class="fillter-font3">1-20 of 80 items</div>
                              </div>
                              <div class="col-xl-1 col-lg-3 col-md-2 col-3 text-right text-lg-right text-md-center fillter-d-n2 fillter-m-t2 order-2 order-lg-3 order-md-2 pr-0">
                                  <button onclick="myFunction2()" class="btn btn-column"><i class="fas fa-square"></i></button>
                                  <button onclick="myFunction3()" class="btn btn-row" disabled><i class="fas fa-th-large"></i></button>
                              </div>
                          </div>
                      </div>
                  </div>
              <section class="grid-item box box-padding">
                  <ul class="row list-unstyled">
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                        <div class="item">
                          <div class="card p-1 fillter-m filter-r filter-position-r">
                            <div id="ribbon" class="green-ribbon">
                            New
                            </div>
                            <div id="ribbon2" class="red-ribbon">
                            -50%
                            </div>
                              <div class="latest-product-frame filter-frame filter-product-frame ">
                                  <a href="product-details1.php"> <img class="filter-image-full filter-full" src="assets/images/product/2/adidas/01.jpg" alt="Card image cap"> </a>
                                  <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/02.jpg" alt="Card image cap"> </a>
                              </div>
                              <div class="card-body p-1 filter-a filter-position-a">
                                <div class="row px-0 mx-0">
                                    <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                        <div class="product-title filter-font-product1">
                                          <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                        </div>
                                        <div class="product-categories filter-font-product1">
                                          <span>Men running</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                      <button type="button" class="btn heart-btn"><i name="like-button" class="fa-2x fa-heart liked fas liked-shaked"></i></button>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                    <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                      <span class="before filter-font-product1">1,825</span><span class="after filter-font-product1">925</span><span class="currency filter-font-product1">THB</span>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn add-to-cart p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span>Add to cart</span>
                                          <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn fast-buy p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span >Buy now</span>
                                          <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </li>
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                        <div class="item">
                          <div class="card p-1 fillter-m filter-r filter-position-r">
                              <div class="latest-product-frame filter-frame filter-product-frame fillter-height ">
                                <a href="product-details1.php"> <img class="filter-image-full filter-full" src="assets/images/product/2/adidas/03.jpg" alt="Card image cap"> </a>
                                <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/04.jpg" alt="Card image cap"> </a>
                              </div>
                              <div class="card-body p-1 filter-a filter-position-a">
                                <div class="row px-0 mx-0">
                                    <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                        <div class="product-title">
                                          <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                        </div>
                                        <div class="product-categories">
                                          <span>Men running</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                      <button type="button" class="btn heart-btn"><i name="like-button" class="far fa-2x fa-heart not-liked"></i></button>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                    <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                      <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn add-to-cart p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span>Add to cart</span>
                                          <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn fast-buy p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span >Buy now</span>
                                          <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </li>
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                        <div class="item">
                          <div class="card p-1 fillter-m filter-r filter-position-r">
                              <div class="latest-product-frame filter-frame filter-product-frame fillter-height ">
                                <a href="product-details1.php"> <img class=" filter-image-full filter-full" src="assets/images/product/2/adidas/09.jpg" alt="Card image cap"> </a>
                                <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/08.jpg" alt="Card image cap"> </a>
                              </div>
                              <div class="card-body p-1 filter-a filter-position-a">
                                <div class="row px-0 mx-0">
                                    <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                        <div class="product-title">
                                          <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                        </div>
                                        <div class="product-categories">
                                          <span>Men running</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                      <button type="button" class="btn heart-btn"><i name="like-button" class="far fa-2x fa-heart not-liked"></i></button>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                    <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                      <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn add-to-cart p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span>Add to cart</span>
                                          <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn fast-buy p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span >Buy now</span>
                                          <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </li>
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                        <div class="item">
                          <div class="card p-1 fillter-m filter-r filter-position-r">
                            <div id="ribbon" class="green-ribbon">
                            New
                            </div>
                              <div class="latest-product-frame filter-frame filter-product-frame fillter-height ">
                                <a href="product-details1.php"> <img class=" filter-image-full filter-full" src="assets/images/product/2/adidas/08.jpg" alt="Card image cap"> </a>
                                <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/09.jpg" alt="Card image cap"> </a>
                              </div>
                              <div class="card-body p-1 filter-a filter-position-a">
                                <div class="row px-0 mx-0">
                                    <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                        <div class="product-title">
                                          <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                        </div>
                                        <div class="product-categories">
                                          <span>Men running</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                      <button type="button" class="btn heart-btn"><i name="like-button" class="far fa-2x fa-heart not-liked"></i></button>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                    <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                      <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn add-to-cart p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span>Add to cart</span>
                                          <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn fast-buy p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span >Buy now</span>
                                          <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </li>
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                          <div class="item">
                            <div class="card p-1 fillter-m filter-r filter-position-r">
                              <div id="ribbon" class="red-ribbon">
                              -50%
                              </div>
                                <div class="latest-product-frame filter-frame filter-product-frame fillter-height ">
                                  <a href="product-details1.php"> <img class=" filter-image-full filter-full" src="assets/images/product/2/adidas/010.jpg" alt="Card image cap"> </a>
                                  <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/011.jpg" alt="Card image cap"> </a>
                                </div>
                                <div class="card-body p-1 filter-a filter-position-a">
                                  <div class="row px-0 mx-0">
                                      <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                          <div class="product-title">
                                            <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                          </div>
                                          <div class="product-categories">
                                            <span>Men running</span>
                                          </div>
                                      </div>
                                      <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                        <button type="button" class="btn heart-btn"><i name="like-button" class="fa-2x fa-heart liked fas liked-shaked"></i></button>
                                      </div>
                                      <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                      <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                        <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                      </div>
                                      <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                        <button type="button" class="btn add-to-cart p-2">
                                          <label class="mb-0 d-flex pr-2">
                                            <span>Add to cart</span>
                                            <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                          </label>
                                        </button>
                                      </div>
                                      <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                        <button type="button" class="btn fast-buy p-2">
                                          <label class="mb-0 d-flex pr-2">
                                            <span >Buy now</span>
                                            <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                          </label>
                                        </button>
                                      </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                      </li>
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                        <div class="item">
                          <div class="card p-1 fillter-m filter-r filter-position-r">
                              <div class="latest-product-frame filter-frame filter-product-frame fillter-height ">
                                <a href="product-details1.php"> <img class="filter-image-full filter-full" src="assets/images/product/2/adidas/012.jpg" alt="Card image cap"> </a>
                                <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/013.jpg" alt="Card image cap"> </a>
                              </div>
                              <div class="card-body p-1 filter-a filter-position-a">
                                <div class="row px-0 mx-0">
                                    <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                        <div class="product-title">
                                          <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                        </div>
                                        <div class="product-categories">
                                          <span>Men running</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                      <button type="button" class="btn heart-btn"><i name="like-button" class="fa-2x fa-heart liked fas liked-shaked"></i></button>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                    <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                      <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn add-to-cart p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span>Add to cart</span>
                                          <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn fast-buy p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span >Buy now</span>
                                          <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </li>
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                        <div class="item">
                          <div class="card p-1 fillter-m filter-r filter-position-r">
                              <div class="latest-product-frame filter-frame filter-product-frame fillter-height ">
                                <a href="product-details1.php"> <img class=" filter-image-full filter-full" src="assets/images/product/2/adidas/014.jpg" alt="Card image cap"> </a>
                                <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/015.jpg" alt="Card image cap"> </a>
                              </div>
                              <div class="card-body p-1 filter-a filter-position-a">
                                <div class="row px-0 mx-0">
                                    <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                        <div class="product-title">
                                          <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                        </div>
                                        <div class="product-categories">
                                          <span>Men running</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                      <button type="button" class="btn heart-btn"><i name="like-button" class="far fa-2x fa-heart not-liked"></i></button>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                    <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                      <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn add-to-cart p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span>Add to cart</span>
                                          <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn fast-buy p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span >Buy now</span>
                                          <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </li>
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                        <div class="item">
                          <div class="card p-1 fillter-m filter-r filter-position-r">
                              <div class="latest-product-frame filter-frame filter-product-frame fillter-height ">
                                <a href="product-details1.php"> <img class=" filter-image-full filter-full" src="assets/images/product/2/adidas/016.jpg" alt="Card image cap"> </a>
                                <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/017.jpg" alt="Card image cap"> </a>
                              </div>
                              <div class="card-body p-1 filter-a filter-position-a">
                                <div class="row px-0 mx-0">
                                    <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                        <div class="product-title">
                                          <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                        </div>
                                        <div class="product-categories">
                                          <span>Men running</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                      <button type="button" class="btn heart-btn"><i name="like-button" class="far fa-2x fa-heart not-liked"></i></button>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                    <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                      <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn add-to-cart p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span>Add to cart</span>
                                          <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn fast-buy p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span >Buy now</span>
                                          <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </li>
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                          <div class="item">
                            <div class="card p-1 fillter-m filter-r filter-position-r">
                                <div class="latest-product-frame filter-frame filter-product-frame fillter-height ">
                                  <a href="product-details1.php"> <img class=" filter-image-full filter-full" src="assets/images/product/2/adidas/019.jpg" alt="Card image cap"> </a>
                                  <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/019.jpg" alt="Card image cap"> </a>
                                </div>
                                <div class="card-body p-1 filter-a filter-position-a">
                                  <div class="row px-0 mx-0">
                                      <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                          <div class="product-title">
                                            <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                          </div>
                                          <div class="product-categories">
                                            <span>Men running</span>
                                          </div>
                                      </div>
                                      <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                        <button type="button" class="btn heart-btn"><i name="like-button" class="fa-2x fa-heart liked fas liked-shaked"></i></button>
                                      </div>
                                      <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                      <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                        <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                      </div>
                                      <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                        <button type="button" class="btn add-to-cart p-2">
                                          <label class="mb-0 d-flex pr-2">
                                            <span>Add to cart</span>
                                            <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                          </label>
                                        </button>
                                      </div>
                                      <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                        <button type="button" class="btn fast-buy p-2">
                                          <label class="mb-0 d-flex pr-2">
                                            <span >Buy now</span>
                                            <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                          </label>
                                        </button>
                                      </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                      </li>
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                        <div class="item">
                          <div class="card p-1 fillter-m filter-r filter-position-r">
                              <div class="latest-product-frame filter-frame filter-product-frame fillter-height ">
                                <a href="product-details1.php"> <img class="filter-image-full filter-full" src="assets/images/product/2/adidas/020.jpg" alt="Card image cap"> </a>
                                <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/021.jpg" alt="Card image cap"> </a>
                              </div>
                              <div class="card-body p-1 filter-a filter-position-a">
                                <div class="row px-0 mx-0">
                                    <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                        <div class="product-title">
                                          <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                        </div>
                                        <div class="product-categories">
                                          <span>Men running</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                      <button type="button" class="btn heart-btn"><i name="like-button" class="fa-2x fa-heart liked fas liked-shaked"></i></button>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                    <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                      <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn add-to-cart p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span>Add to cart</span>
                                          <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn fast-buy p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span >Buy now</span>
                                          <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </li>
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                        <div class="item">
                          <div class="card p-1 fillter-m filter-r filter-position-r">
                              <div class="latest-product-frame filter-frame filter-product-frame fillter-height ">
                                <a href="product-details1.php"> <img class=" filter-image-full filter-full" src="assets/images/product/2/adidas/022.jpg" alt="Card image cap"> </a>
                                <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/023.jpg" alt="Card image cap"> </a>
                              </div>
                              <div class="card-body p-1 filter-a filter-position-a">
                                <div class="row px-0 mx-0">
                                    <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                        <div class="product-title">
                                          <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                        </div>
                                        <div class="product-categories">
                                          <span>Men running</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                      <button type="button" class="btn heart-btn"><i name="like-button" class="fa-2x fa-heart liked fas liked-shaked"></i></button>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                    <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                      <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn add-to-cart p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span>Add to cart</span>
                                          <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn fast-buy p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span >Buy now</span>
                                          <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </li>
                      <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">
                        <div class="item">
                          <div class="card p-1 fillter-m filter-r filter-position-r">
                              <div class="latest-product-frame filter-frame filter-product-frame fillter-height ">
                                <a href="product-details1.php"> <img class="filter-image-full filter-full" src="assets/images/product/2/adidas/01.jpg" alt="Card image cap"> </a>
                                <a href="product-details2.php"> <img class="second-latest-product filter-image-full filter-full" src="assets/images/product/2/adidas/02.jpg" alt="Card image cap"> </a>
                              </div>
                              <div class="card-body p-1 filter-a filter-a filter-position-a">
                                <div class="row px-0 mx-0">
                                    <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                        <div class="product-title">
                                          <span>Pureboost DPR Shoes Pureboost DPR Shoes Pureboost DPR Shoes<span>
                                        </div>
                                        <div class="product-categories">
                                          <span>Men running</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                      <button type="button" class="btn heart-btn"><i name="like-button" class="fa-2x fa-heart liked fas liked-shaked"></i></button>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                    <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                      <span class="before">1,825</span><span class="after">925</span><span class="currency">THB</span>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn add-to-cart p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span>Add to cart</span>
                                          <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                    <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                      <button type="button" class="btn fast-buy p-2">
                                        <label class="mb-0 d-flex pr-2">
                                          <span >Buy now</span>
                                          <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                        </label>
                                      </button>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </li>
                  </ul>
                  <div class="container">
                        <ul class="pagination justify-content-center">
                          <li class="page-item pr-1"><a class="news_page-link" href="javascript:void(0);">1</a></li>
                          <li class="page-item pr-1"><a class="news_page-link" href="javascript:void(0);">2</a></li>
                          <li class="page-item pr-1"><a class="news_page-link" href="javascript:void(0);">3</a></li>
                          <li class="page-item pr-1"><a class="news_page-link" href="javascript:void(0);">4</a></li>
                        </ul>
                  </div>
              </section>
            </div>
          </div>
      </div>


</div>

@endsection

@section('js_bottom')
<script type="text/javascript">
function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

    $('.filtered-item').toggleClass('col-xl-10 col-xl-12 col-lg-12 col-lg-9');
    $('.filtered-item2').addClass('col-lg-4');

    if(document.getElementById("demo").innerHTML == 'show filter'){

      document.getElementById("demo").innerHTML = "hide filter";

      if($('.filter-frame').hasClass('filter-product-frame4') || $('.filter-frame').hasClass('filter-product-frame6')){


        $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');

        $('.filter-frame').addClass('filter-product-frame2');

        alert('test case reset 4')
      }

      if($('.filter-frame').hasClass('filter-product-frame5')){
        $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');

        $('.filter-frame').addClass('filter-product-frame');


        alert('test case reset 5')
      }

    }

    else if(document.getElementById("demo").innerHTML == 'hide filter'){
        document.getElementById("demo").innerHTML = "show filter";


        if($('.filter-frame').hasClass('filter-product-frame2')){

          $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');

          $('.filter-frame').addClass('filter-product-frame4');


          alert('test case 4')
        }

        if($('.filter-frame').hasClass('filter-product-frame')){

          $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');

          $('.filter-frame').addClass('filter-product-frame5');

          alert('test case 5')
        }


    }
}



  function myFunction2() {

    $('.filtered-item2').addClass('col-xl-4 col-12 col-lg-6 col-md-6');
    $('.filtered-item2').removeClass('col-xl-3 col-6 col-lg-4 col-md-4');

  if(document.getElementById("demo").innerHTML == 'show filter') {

      $('.btn-row').prop("disabled", false);
      $('.btn-column').prop("disabled", true);

      $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');

      $('.filter-frame').addClass('filter-product-frame6');

      alert('test 3')
    }
    else {
      $('.btn-row').prop("disabled", false);
      $('.btn-column').prop("disabled", true);

      $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');

      $('.filter-frame').addClass('filter-product-frame2');

      alert('test 4')
    }
  }


  function myFunction3() {
    $('.filtered-item2').addClass('col-xl-3 col-6 col-lg-4 col-md-4');
    $('.filtered-item2').removeClass('col-xl-4 col-12 col-lg-6 col-md-6');

    if(document.getElementById("demo").innerHTML == 'show filter') {
        $('.btn-row').prop("disabled", true);
        $('.btn-column').prop("disabled", false);

        $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');

        $('.filter-frame').addClass('filter-product-frame5');

        alert('test 5')
      }
      else {

        $('.btn-row').prop("disabled", true);
        $('.btn-column').prop("disabled", false);

        $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');

        $('.filter-frame').addClass('filter-product-frame');


        alert('test 6')
      }

  }




</script>
@endsection

