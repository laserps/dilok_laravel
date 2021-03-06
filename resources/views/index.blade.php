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
          <div class="custom-container position-relative">
            <div class="row header-row">
              <div class="col-12 index-text-color">
                <h1>Best of MEN's SNEAKERS</h1>
                <h5>is simply dummy text of the printing and typesetting industry. Lorem Ipsum</h5>
              </div>
              <div class="col-12 ">
                <hr>
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
        </div>
        <div class="item">
          <img class="slide-img" src='http://blog.wishatl.com/wp-content/uploads/2015/12/Hypebeast-adidas-Originals-Uncaged-4.jpg'>
          <div class="custom-container position-relative">
            <div class="row header-row">
              <div class="col-12 index-text-color">
                <h1>Best of MEN's SNEAKERS</h1>
                <h5>is simply dummy text of the printing and typesetting industry. Lorem Ipsum</h5>
              </div>
              <div class="col-12">
                <hr>
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
        </div>
        <div class="item">
          <img class="slide-img" src='http://blog.wishatl.com/wp-content/uploads/2015/12/Hypebeast-adidas-Originals-Uncaged-7.jpg'>
          <div class="custom-container position-relative">
            <div class="row header-row">
              <div class="col-12 index-text-color ">
                <h1>Best of MEN's SNEAKERS</h1>
                <h5>is simply dummy text of the printing and typesetting industry. Lorem Ipsum</h5>
              </div>
              <div class="col-12">
                <hr>
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
        </div>
        <div class="item">
          <img class="slide-img" src='http://blog.wishatl.com/wp-content/uploads/2015/12/Hypebeast-adidas-Originals-Uncaged-6.jpg'>
          <div class="custom-container position-relative">
            <div class="row header-row">
              <div class="col-12 index-text-color ">
                <h1>Best of MEN's SNEAKERS</h1>
                <h5>ลดราคารองเท้า 50 - 70% ไม่ว่าจะเป็นรองเท้าผ้าใบ รองเท้าเดือนทาง รองเท้าวิ่ง</h5>
              </div>
              <div class="col-12">
                <hr>
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
                <hr>

                <div class="header-slide-btn content-slide-btn">
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
          <!-- บังคับ first child มี class first    last child มี class last  -->
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
        <!-- <div class="row mx-0">
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
                   </div> -->

        <div class="row mx-0 px-lg-0 px-md-5 px-1 d-lg-block d-md-none d-none">
          <div class="col-12">
            <div class="col-12 px-lg-3 px-0 mb-md-3">
              <h3 class="mb-1 mt-2 pull-left">HIGHLIGHT</h3>
              <div class="latest-product-btn pull-right mb-2">

                <!-- <a href="{{ url('brands/highlight') }}" class="btn view-all p-2 res-414-up">
            <label class="mb-0 d-flex px-2">
              <span>view all</span>
              <i class="fas fa-plus ml-auto pl-3 pt-1" aria-hidden="true"></i>
            </label>
          </a> -->

              </div>
            </div>
            <div class="clearfix"></div>



            <div class="latest-slide owl-carousel owl-theme">
              @if(!empty($products_highlight->result->items->item))
              @if(is_array($products_highlight->result->items->item))
              @foreach($products_highlight->result->items->item as $key_product => $value_product)
              @foreach($value_product->customAttributes as $key_custom => $value_custom)
              <!-- บังคับ first child มี class first    last child มี class last  -->
              @php
              $image = '';
              $small_image = '';
              $special_price = 0;
              $news_from_date = '';
              $news_to_date = '';
              $after = '';
              $before = '';
              $special_from_date = '';
              $special_to_date = '';
              $pan = 'padding-right: 5px;';
              $date = date('Y-m-d H:i:s');
              @endphp
              @foreach($value_custom as $key => $value)
              @if($value->attributeCode == 'image' && !empty($value->value))
              @php $image = $value->value; @endphp
              @endif
              @if($value->attributeCode == 'small_image' && !empty($value->value))
              @php $small_image = $value->value; @endphp
              @endif
              @if($value->attributeCode == 'special_from_date' && !empty($value->value))
              @php $special_from_date = $value->value; @endphp
              @endif
              @if($value->attributeCode == 'special_to_date' && !empty($value->value))
              @php $special_to_date = $value->value; @endphp
              @endif
              @if($value->attributeCode == 'special_price' && !empty($value->value))
              @php $special_price = $value->value; $after = 'after'; $pan = 'padding-right: 0px;'; @endphp
              @endif
              @if($value->attributeCode == 'news_from_date' && !empty($value->value))
              @php $news_from_date = $value->value; @endphp
              @endif
              @if($value->attributeCode == 'news_to_date' && !empty($value->value))
              @php $news_to_date = $value->value; @endphp
              @endif
              @endforeach

              @if(!empty($products2_highlight->result->items->item[$key_product]->priceInfo->regularPrice))
              @if($value_product->id == $products2_highlight->result->items->item[$key_product]->id)
              @php $price_defult = $products2_highlight->result->items->item[$key_product]->priceInfo->regularPrice;
              @endphp
              @else
              @php $price_defult = $value_product->price; @endphp
              @endif
              @else
              @php $price_defult = ''; @endphp
              @endif

              @if(!empty($products2_highlight->result->items->item[$key_product]->priceInfo->finalPrice))
              @if($value_product->id == $products2_highlight->result->items->item[$key_product]->id)
              @php $price_special = $products2_highlight->result->items->item[$key_product]->priceInfo->finalPrice;
              @endphp
              @else
              @php $price_special = $value_product->price; @endphp
              @endif
              @else
              @php $price_special = ''; @endphp
              @endif

              <div class="item first">
                <div class="card p-1">
                  <div class="latest-product-frame">
                    <a href="{{ url('product-details1/'.$value_product->id) }}">
                      @if(!empty($image))
                      <img class="latest-product-pic" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$image}}"
                        alt="Card image cap">
                      @else
                      <img class="latest-product-pic" src="{{ url('assets/images/No_Image_Available.jpg') }}" alt="Card image cap">
                      @endif
                    </a>
                    <a href="{{ url('product/'.$value_product->id) }}">
                      <!-- <img class="latest-product-pic second-latest-product" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$small_image}}" alt="Card image cap"> -->
                    </a>
                  </div>
                  <div class="card-body p-0">
                    <div class="row px-0 mx-0">
                      @if(!empty($news_from_date) && !empty($news_to_date))
                      @if($date >= $news_from_date && $date <= $news_to_date) <div id="ribbon" class="green-ribbon">
                        New
                    </div>
                    @endif
                    @endif
                    @if(!empty($price_defult))
                    @if($price_special != 0)
                    @php $before = 'before'; @endphp
                    @endif
                    @if($price_defult != $price_special)
                    @php $percen_sum = (100-(($price_special*100)/$price_defult)); @endphp
                    @else
                    @php $percen_sum = '0'; @endphp
                    @endif
                    @else
                    @php $percen_sum = ''; $before = ''; @endphp
                    @endif

                    @if(!empty($price_defult))
                    @if($price_defult != $price_special)
                    @if($percen_sum != null || $percen_sum != '')
                    <div id="ribbon2" class="red-ribbon">{{number_format($percen_sum,0)}}%
                    </div>
                    @endif
                    @endif
                    @endif
                    <div class="col-12 px-xl-2 px-0 mb-2">
                      <div class="product-title">
                        <span>{{ $value_product->name }}</span>
                      </div>
                      <div class="product-categories">
                        @foreach($value_custom as $key => $value)
                        @if(!empty($value->attributeCode) && !empty($value->value) && $value->attributeCode ==
                        'short_description')
                          <div>{!! str_limit(strip_tags($value->value),70) !!}</div>
                        @endif
                        @endforeach
                      </div>
                    </div>
                    <div class="col-2 mb-2 px-0"></div>
                    <div class="col-2 mb-2 px-0">
                      <!-- <button type="button" class="btn heart-btn"><i name="like-button" class="fa-2x fa-heart liked fas liked-shaked"></i></button> -->
                      <!-- <button type="button" class="btn heart-btn"><i name="like-button" class="far fa-2x fa-heart not-liked"></i></button> -->
                    </div>
                    <div class="col-4 px-xl-2 px-0 mb-2">
                    </div>
                    <div class="col-12 px-xl-2 px-0 mb-2 latest-product-price">

                      @if(!empty($price_defult))
                      <span class="@if($price_defult != $price_special){{$before}}@endif">
                        {{ number_format($price_defult,2) }}
                      </span>
                      @endif
                      <span style="@if(!empty($price_special)) @if($price_defult != $price_special){{$pan}} {{"color:red"}} @endif @endif"
                        class="@if($date >= $special_from_date && $date <= $special_to_date){{$after}}@endif">

                        @if($price_defult != $price_special)
                        {{ number_format($price_special,2) }}
                        @endif

                      </span>
                      <span class="currency">THB</span>
                    </div>
                    <div class="col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 latest-product-btn">
                      <a href="{{ url('product/'.$value_product->id) }}">
                        <button type="button" class="btn add-to-cart p-1">
                          <label class="mb-0 d-flex px-1">
                            <span>Add to cart</span>
                            <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                          </label>
                        </button>
                      </a>
                    </div>
                    <div class="col-xl-6 col-lg-12 px-xl-1 px-lg-0 latest-product-btn">
                      <a href="{{ url('product/'.$value_product->id) }}">
                        <button type="button" class="btn fast-buy p-1">
                          <label class="mb-0 d-flex px-2">
                            <span>Buy now</span>
                            <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                          </label>
                        </button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @endforeach
            @else
            @foreach($products_highlight->result->items->item->customAttributes as $key => $value2)
            @php
            $image = '';
            $small_image = '';
            $special_price = 0;
            $news_from_date = '';
            $news_to_date = '';
            $after = '';
            $before = '';
            $special_from_date = '';
            $special_to_date = '';
            $pan = 'padding-right: 5px;';
            $date = date('Y-m-d H:i:s');
            @endphp
            @foreach($value2 as $key => $value)
            @if($value->attributeCode == 'image' && !empty($value->value))
            @php $image = $value->value; @endphp
            @endif
            @if($value->attributeCode == 'small_image' && !empty($value->value))
            @php $small_image = $value->value; @endphp
            @endif
            @if($value->attributeCode == 'special_from_date' && !empty($value->value))
            @php $special_from_date = $value->value; @endphp
            @endif
            @if($value->attributeCode == 'special_to_date' && !empty($value->value))
            @php $special_to_date = $value->value; @endphp
            @endif
            @if($value->attributeCode == 'special_price' && !empty($value->value))
            @php $special_price = $value->value; $after = 'after'; $pan = 'padding-right: 0px;'; @endphp
            @endif
            @if($value->attributeCode == 'news_from_date' && !empty($value->value))
            @php $news_from_date = $value->value; @endphp
            @endif
            @if($value->attributeCode == 'news_to_date' && !empty($value->value))
            @php $news_to_date = $value->value; @endphp
            @endif
            @endforeach

            @if(!empty($products2_highlight->result->items->item->priceInfo->regularPrice))
            @if($products_highlight->result->items->item->id == $products2_highlight->result->items->item->id)
            @php $price_defult = $products2_highlight->result->items->item->priceInfo->regularPrice; @endphp
            @else
            @php $price_defult = $products_highlight->result->items->item->price; @endphp
            @endif
            @else
            @php $price_defult = ''; @endphp
            @endif

            @if(!empty($products2_highlight->result->items->item->priceInfo->finalPrice))
            @if($products_highlight->result->items->item->id == $products2_highlight->result->items->item->id)
            @php $price_special = $products2_highlight->result->items->item->priceInfo->finalPrice; @endphp
            @else
            @php $price_special = $products_highlight->result->items->item->price; @endphp
            @endif
            @else
            @php $price_special = ''; @endphp
            @endif
            <div class="item first">
              <div class="card p-1">
                <div class="latest-product-frame">
                  <a href="{{ url('product-details1/'.$products_highlight->result->items->item->id) }}">
                    @if(!empty($image))
                    <img class="latest-product-pic" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$image}}"
                      alt="Card image cap">
                    @else
                    <img class="latest-product-pic" src="{{ url('assets/images/No_Image_Available.jpg') }}" alt="Card image cap">
                    @endif
                  </a>
                  <a href="{{ url('product-details1/'.$products_highlight->result->items->item->id) }}">
                    <!-- <img class="latest-product-pic second-latest-product" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$small_image}}" alt="Card image cap"> -->
                  </a>
                </div>
                <div class="card-body p-0">
                  <div class="row px-0 mx-0">
                    @if(!empty($news_from_date) && !empty($news_to_date))
                    @if($date >= $news_from_date && $date <= $news_to_date) <div id="ribbon" class="green-ribbon">
                      New
                  </div>
                  @endif
                  @endif
                  @if(!empty($price_defult))
                  @if($price_special != 0)
                  @php $before = 'before'; @endphp
                  @endif
                  @if($price_defult != $price_special)
                  @php $percen_sum = (100-(($price_special*100)/$price_defult)); @endphp
                  @else
                  @php $percen_sum = '0'; @endphp
                  @endif
                  @else
                  @php $percen_sum = ''; $before = ''; @endphp
                  @endif

                  @if(!empty($price_defult))
                  @if($price_defult != $price_special)
                  @if($percen_sum != null || $percen_sum != '')
                  <div id="ribbon2" class="red-ribbon">{{number_format($percen_sum,0)}}%
                  </div>
                  @endif
                  @endif
                  @endif
                  <div class="col-12 px-xl-2 px-0 mb-2">
                    <div class="product-title">
                      <span>{{ $products_highlight->result->items->item->name }}</span>
                    </div>
                    <div class="product-categories">
                      @foreach($products_highlight->result->items->item->customAttributes->item as $key => $value3)
                      @if(!empty($value3->attributeCode) && !empty($value3->value) && $value3->attributeCode ==
                      'short_description')
                      <span>{!! $value3->value !!}</span>
                      @endif
                      @endforeach
                    </div>
                  </div>
                  <div class="col-2 mb-2 px-0"></div>
                  <div class="col-2 mb-2 px-0">
                    <!-- <button type="button" class="btn heart-btn"><i name="like-button" class="fa-2x fa-heart liked fas liked-shaked"></i></button> -->
                    <!-- <button type="button" class="btn heart-btn"><i name="like-button" class="far fa-2x fa-heart not-liked"></i></button> -->
                  </div>
                  <div class="col-4 px-xl-2 px-0 mb-2">
                  </div>
                  <div class="col-8 px-xl-2 px-0 mb-2 latest-product-price">

                    @if(!empty($price_defult))
                    <span class="@if($price_defult != $price_special){{$before}}@endif">
                      {{ number_format($price_defult,2) }}
                    </span>
                    @endif
                    <span style="@if(!empty($price_special)) @if($price_defult != $price_special){{$pan}} {{"color:red"}} @endif @endif"
                      class="@if($date >= $special_from_date && $date <= $special_to_date){{$after}}@endif">

                      @if($price_defult != $price_special)
                      {{ number_format($price_special,2) }}
                      @endif

                    </span>
                    <span class="currency">THB</span>
                  </div>
                  <div class="col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 latest-product-btn">
                    <a href="{{ url('product-details1/'.$products_highlight->result->items->item->id) }}">
                      <button type="button" class="btn add-to-cart">
                        <label class="mb-0 d-flex px-2">
                          <span>Add to cart</span>
                          <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                        </label>
                      </button>
                    </a>
                  </div>
                  <div class="col-xl-6 col-lg-12 px-xl-1 px-lg-0 latest-product-btn">
                    <a href="{{ url('product-details1/'.$products_highlight->result->items->item->id) }}">
                      <button type="button" class="btn fast-buy p-2">
                        <label class="mb-0 d-flex px-2">
                          <span>Buy now</span>
                          <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                        </label>
                      </button>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @endif
          @endif
        </div>
    </div>
  </div>


  <section class="blog-launches mb-lg-5 mb-md-5 mb-4">
    <div class="row mx-0">
      <div class="col-12 px-lg-3 px-0 mb-3">
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
        <div class="col-md-6 col-12 blog-img-col">
          <div class="card_new mr-0 px-1">
            <div class="blog-img-frame">
              <a href="{{ url('single-blog') }}/{{ $value_block->id }}">
                @if(!empty($image['src']))
                <img class="blog-img" src="http://128.199.235.248/magento/pub/media/{{ $image['src'] }}" />
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
    loop: true,
    items: 1,
    dot: true,
    autoplay: true,
  });

  $('.header-slide').find('.owl-dots').removeClass('disabled');

  $('.brand-slide').owlCarousel({
    nav: true,
    navText: ["", ""],
    loop: false,
    items: 3,
    dot: true,
    autoplay: false,
    responsive: {
      0: {
        items: 1,
        dot: false,
      },
      414: {
        items: 1,
        dot: false,
      },
      768: {
        items: 2,
      },
      1024: {
        items: 2,
      },
      1366: {
        items: 3,
      },
      1367: {
        items: 3,
      }
    },
  });
  $('.brand-slide').find('.owl-nav').removeClass('disabled');
  $('.brand-slide').find('.owl-next').removeClass('disabled');

  if (window.matchMedia("(max-width: 414px)").matches) {} else {
    $('.brand-slide').find('.owl-dots').removeClass('disabled');

  }

  $('.brand-slide').find('.owl-next').addClass('latest-next latest-next-1 arrow-fadein');
  $('.brand-slide').find('.owl-next').append("<i class='fas fa-angle-right fa-4x'></i>");
  $('.brand-slide').find('.owl-prev').removeClass('disabled');
  $('.brand-slide').find('.owl-prev').addClass('latest-prev  latest-prev-1');
  $('.brand-slide').find('.owl-prev').append("<i class='fas fa-angle-left fa-4x'></i>");
  $('.brand-slide').on('translated.owl.carousel', function (e) {
    $('.brand-slide .owl-stage .owl-item.active').each(function () {
      if ($(this).closest('.owl-stage').find('.active .item').hasClass('first')) {
        $(this).closest('.owl-carousel').find('.latest-prev').removeClass('arrow-fadein');
      } else {
        $(this).closest('.owl-carousel').find('.latest-prev').addClass('arrow-fadein');
      }
      if ($(this).closest('.owl-stage').find('.active .item').hasClass('last')) {
        $(this).closest('.owl-carousel').find('.latest-next').removeClass('arrow-fadein');
      } else {
        $(this).closest('.owl-carousel').find('.latest-next').addClass('arrow-fadein');
      }
    });
  });

  $('.brand-slide').find('.owl-dots').removeClass('disabled');

  if (window.matchMedia("(max-width: 1024px)").matches) {

  } else {
    $('#zoom1').zoom();
    $('#zoom2').zoom();
    $('#zoom3').zoom();

  }
</script>
@endsection