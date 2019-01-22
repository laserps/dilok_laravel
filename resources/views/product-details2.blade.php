@extends('welcome')
@section('body')
    <!-- START CONTENT -->
      <div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->
@if(!empty($products_detail->result->items->item))
@foreach($products_detail->result->items->item->customAttributes as $key_custom => $value_custom)
  @php
    $image = '';
    $small_image = '';
    $special_price = 0;
    $after = '';
    $before = '';
    $pan = 'padding-right: 5px;';
    $thumbnail = '';
    $swatch_image = '';
    $special_price = '';
    $special_from_date = '';
    $special_to_date = '';
    $discounted = '';
    $discount = '';
    $video = '';
    $colorproduct = '';
    $colorproduct2 = '';
    $size = '';
    $date = date('Y-m-d H:i:s');
  @endphp
  @foreach($value_custom as $key => $value)
    @if($value->attributeCode == 'image' && !empty($value->value))
      @php $image = $value->value; @endphp
    @endif
    @if($value->attributeCode == 'small_image' && !empty($value->value))
      @php $small_image = $value->value; @endphp
    @endif
    @if($value->attributeCode == 'thumbnail' && !empty($value->value))
      @php $thumbnail = $value->value; @endphp
    @endif
    @if($value->attributeCode == 'swatch_image' && !empty($value->value))
      @php $swatch_image = $value->value; @endphp
    @endif
    @if($value->attributeCode == 'special_price' && !empty($value->value))
      @php $special_price = $value->value; $after = 'after'; $pan = 'padding-right: 0px;'; $discounted = 'discounted'; $discount = 'discount'; @endphp
    @endif
    @if($value->attributeCode == 'description' && !empty($value->value))
      @php $description = $value->value; @endphp
    @endif
    @if($value->attributeCode == 'short_description' && !empty($value->value))
      @php $short_description = $value->value; @endphp
    @endif
    @if($value->attributeCode == 'colorproduct' && !empty($value->value))
      @php $colorproduct = $value->value; @endphp
    @endif
    @if($value->attributeCode == 'color' && !empty($value->value))
      @php $colorproduct2 = $value->value; @endphp
    @endif
    @if($value->attributeCode == 'size' && !empty($value->value))
      @php $size = $value->value; @endphp
    @endif
    @if($value->attributeCode == 'special_from_date' && !empty($value->value))
      @php $special_from_date = $value->value; @endphp
    @endif
    @if($value->attributeCode == 'special_to_date' && !empty($value->value))
      @php $special_to_date = $value->value; @endphp
    @endif
  @endforeach

  @if(isset($products3->result->items->item))
    @if(!empty($products3->result->items->item->priceInfo->regularPrice))
        @php $price_defult = $products3->result->items->item->priceInfo->regularPrice; @endphp
    @endif
  @else
    @php $price_defult = ''; @endphp
  @endif

  @if(isset($products3->result->items->item))
    @if(!empty($products3->result->items->item->priceInfo->finalPrice))
        @php $price_special = $products3->result->items->item->priceInfo->finalPrice; @endphp
    @endif
  @else
    @php $price_special = ''; @endphp
  @endif


@if(!empty($products_gallery->result))
  @foreach($products_gallery as $key_gallerys => $value_gallerys)
    @if(!empty($value_gallerys->item))
    @foreach($value_gallerys->item as $key_gallery => $value_gallery)
      @if(!empty($value_gallery->mediaType))
        @if($value_gallery->mediaType == 'external-video' && !empty($value_gallery->extensionAttributes->videoContent->videoUrl))
          @php $video = $value_gallery->extensionAttributes->videoContent->videoUrl; @endphp
        @endif
      @endif
    @endforeach
    @endif
  @endforeach
@endif

  <div class="container-fluid custom-container">

          <section class="product-detail mt-lg-5 mt-3 mb-lg-5 mb-md-5 mb-4">

            <div class="product-detail-box">
              <!-- DESKTOP AND IPOAD PRO PRODUCT PIC AND VIDEO -->
              <div class="product-detail-left-side">
                <div class="row mx-0">
                  <!-- บังคับใช้ zoom + เลข ทั้ง id และ class   มี script ข้างล่าง -->
                  <!-- @if(!empty($image))
                    <div class="product-desktop-col col-xl-6 col-lg-12 px-1 mb-2">
                        <div class="product-desktop-frame zoom1 cur" id="zoom1" data-toggle="modal" data-target="#full-screen-product-1">
                          <img class="product-desktop-img" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$image}}">
                        </div>
                    </div>
                  @endif -->

                  <!-- ตาม layout Video อยู่อันที่2  ติ๊กเอาทุกอย่าง(controllerของvideo ชื่อ video etc.)ออกเวลา copy iframeมาใส่-->
                  <!-- @if(!empty($video))
                  <div class="product-desktop-col col-xl-6 col-lg-12 px-1 mb-2">
                    <div class="product-desktop-frame">
                      <iframe width="100%" height="100%" src="{{$video}}?rel=0&amp;controls=0&amp;mute=1&amp;autoplay=1&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                     </div>
                  </div>
                  @endif -->
                  @if(isset($products_gallery->result->item))
                    @if(is_array($products_gallery->result->item))
                      @foreach($products_gallery as $key_gallerys => $value_gallerys)
                        @foreach($value_gallerys->item as $key_gallery => $value_gallery)
                          <div class="product-desktop-col col-xl-6 col-lg-12 px-1 mb-2">
                            <div class="product-desktop-frame zoom3 cur" id="zoom3" data-toggle="modal" data-target="#full-screen-product-1">
                              <img class="product-desktop-img" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$value_gallery->file}}">
                            </div>
                          </div>
                        @endforeach
                      @endforeach
                    @else
                      <div class="product-desktop-col col-xl-6 col-lg-12 px-1 mb-2">
                        <div class="product-desktop-frame zoom3 cur" id="zoom3" data-toggle="modal" data-target="#full-screen-product-1">
                          <img class="product-desktop-img" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$products_gallery->result->item->file}}">
                        </div>
                      </div>
                    @endif
                  @endif
                  <!-- @if(!empty($small_image))
                    <div class="product-desktop-col col-xl-6 col-lg-12 px-1 mb-2">
                      <div class="product-desktop-frame zoom3 cur" id="zoom3" data-toggle="modal" data-target="#full-screen-product-1">
                        <img class="product-desktop-img" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$small_image}}">
                      </div>
                    </div>
                  @endif
                  @if(!empty($thumbnail))
                    <div class="product-desktop-col col-xl-6 col-lg-12 px-1 mb-2">
                      <div class="product-desktop-frame zoom4 cur" id="zoom4" data-toggle="modal" data-target="#full-screen-product-1">
                        <img class="product-desktop-img" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$thumbnail}}">
                      </div>
                    </div>
                  @endif
                  @if(!empty($swatch_image))
                    <div class="product-desktop-col col-xl-6 col-lg-12 px-1 mb-2">
                      <div class="product-desktop-frame zoom5 cur" id="zoom5" data-toggle="modal" data-target="#full-screen-product-1">
                        <img class="product-desktop-img" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$swatch_image}}">
                      </div>
                    </div>
                  @endif -->
                </div>
              </div>

              <!-- PRODUCT GALLERTY MODAL -->
              <div class="modal fade full-screen-product" id="full-screen-product-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      @if(isset($products_gallery->result->item))
                        @if(is_array($products_gallery->result->item))
                          @foreach($products_gallery as $key_gallerys => $value_gallerys)
                            @foreach($value_gallerys->item as $key_gallery => $value_gallery)
                              <img width="100%" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$value_gallery->file}}">
                            @endforeach
                          @endforeach
                        @else
                            <img width="100%" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$products_gallery->result->item->file}}">
                        @endif
                      @endif
                      <!-- <img width="100%" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$image}}"> -->
                      <!-- <img width="100%" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$small_image}}"> -->
                      <!-- <img width="100%" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$thumbnail}}"> -->
                      <!-- <img width="100%" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$swatch_image}}"> -->
                    </div>
                  </div>
                </div>
              </div>

              <!-- Ipad and below -->
              <div class="product-detail-left-side-small d-lg-none d-md-block">
                <div class="row mx-0">
                  <!-- <div class="col-6"><span>รองเท้าวิ่งชาย</span></div><div class="col-6 text-right"><span>925 THB</span></div> -->
                  <!-- <div class="col-12 mb-3"><h3>Adidas Deerupt Runner</h3></div> -->

                  <div class="col-12 px-0">
                    <div class="productdetail2-carousel owl-carousel owl-theme">
                      @if(isset($products_gallery->result->item))
                        @if(is_array($products_gallery->result->item))
                          @foreach($products_gallery as $key_gallerys => $value_gallerys)
                            @foreach($value_gallerys->item as $key_gallery => $value_gallery)
                              <div class="item">
                                <div class="product-ipad-frame" data-toggle="modal" data-target="#full-screen-product-1">
                                  <img width="100%" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$value_gallery->file}}">
                                </div>
                              </div>
                            @endforeach
                          @endforeach
                        @else
                            <div class="item">
                                <div class="product-ipad-frame" data-toggle="modal" data-target="#full-screen-product-1">
                                  <img width="100%" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$products_gallery->result->item->file}}">
                                </div>
                              </div>
                        @endif
                      @endif

                      @if(!empty($video))
                        <div class="item-video">
                          <!-- <a class="owl-video" href="https://www.youtube.com/watch?v=yjNXVkWhXkc"></a> -->
                          <iframe width="100%" height="100%" src="{{$video}}?rel=0&amp;controls=0&amp;mute=1&amp;autoplay=1&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                      @endif

                        <!-- <div class="item">
                          <div class="product-ipad-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-ipad-img" src="assets/images/product/1/22.jpg">
                          </div>
                        </div>
                        <div class="item-video"><a class="owl-video" href="https://www.youtube.com/watch?v=yjNXVkWhXkc"></a></div>
                        <div class="item">
                          <div class="product-ipad-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-ipad-img" src="assets/images/product/1/33.jpg">
                          </div>
                        </div>
                        <div class="item">
                          <div class="product-ipad-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-ipad-img" src="assets/images/product/1/44.jpg">
                          </div>
                        </div>
                        <div class="item">
                          <div class="product-ipad-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-ipad-img" src="assets/images/product/1/55jpg">
                          </div>
                        </div>
                        <div class="item">
                          <div class="product-ipad-frame" data-toggle="modal" data-target="#full-screen-product-1">
                            <img class="product-ipad-img" src="assets/images/product/1/66.jpg">
                          </div>
                        </div> -->
                    </div>
                  </div>

                </div>
              </div>





              <!-- END DESKTOP AND IPOAD PRO PRODUCT PIC AND VIDEO -->
              <div class="product-detail-right-side px-xl-3 pl-lg-3 mt-lg-0 mt-5">
                  <div class="sticky-box">
                        <div class="row mx-0">
                          <div class="col-12">
                            <button type="button" class="btn top-btn heart-btn pull-right"><i name="like-button" class="far fa-1x fa-heart not-liked icon-size"></i></button>
                            <button type="button" class="btn top-btn pull-right"><i class="fa-1x fa-share-alt fas "></i></button>
                          </div>
                          <div class="col-12 pr-lg-0">
                            <div class="sticky-product-title">
                                <h2>{{ $products_detail->result->items->item->name }}</h2>
                            </div>

                            <div class="sticky-product-quantity p-3 mb-3">
                              <div class="row mx-0">
                                <div class="col-12 px-0">
                                @if(!empty($price_defult))
                                  <div class="sale-percent px-2">
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

                                    @if($price_defult >= $price_special)
                                      @if($percen_sum != null || $percen_sum != '')
                                        <span>{{number_format($percen_sum,0)}}%</span>
                                      @endif
                                    @endif
                                  </div>
                                  <div class="pt-2 latest-product-price">
                                    @if(!empty($price_defult))
                                      <span class="@if($price_defult != $price_special){{$before}}@endif">
                                          {{ number_format($price_defult,2) }}
                                      </span>
                                    @endif
                                        <span style="@if($price_defult != $price_special){{$pan}} {{ "color:red;" }}@endif" class="@if($price_defult != $price_special){{$after}}@endif">
                                          @if($price_special != 0)
                                            @if($price_defult != $price_special)
                                              {{ number_format($price_special,2) }}
                                            @endif
                                          @endif
                                        </span>
                                        <span class="currency">THB</span>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="" style="width: 100%;">
                              <span class="ml-2">
                                 Color
                              </span>
                              <!-- <span class="grey">
                                 (black)
                              </span> -->

                               @php $color = explode(',',$colorproduct); $size_product = explode(',',$size); @endphp

                              <div class="row mx-0 mt-2 mb-3">

                              @if(isset($product_options->result->item))
                                @if(!empty($product_options))
                                  @if(!empty($color_product))
                                    @foreach($color_product->result->item as $key_color => $value_color)
                                      @foreach($color as $key_product_color => $value_product_color)
                                        @if(is_array($product_options->result->item))
                                          @foreach($product_options->result->item as $key_options => $value_options)
                                            @if($value_options->attributeId == '93' && $value_options->label == 'Color')
                                              @foreach($value_options->values->item as $key_value => $value_value)
                                                @if(count($value_options->values->item) > 1)
                                                  @if($value_value->valueIndex == $value_color->value)
                                                    <div class="col-1 mr-2 px-2 mb-2 text-center">
                                                       <a class="btn color-btn btn_color_active" data-btncolor="{{$value_color->label}}" data-valuecolor="{{$value_color->value}}" style="background-color:{{$value_color->label}}"></a>
                                                    </div>
                                                  @endif
                                                @else
                                                  @if($value_value == $value_color->value)
                                                    <!-- <div class="col-1 mr-2 px-2 mb-2 text-center">
                                                       <a type="button" class="btn color-btn color-active" style="background-color:{{$value_color->label}}"></a>
                                                    </div> -->
                                                    <div class="col-1 mr-2 px-2 mb-2 text-center">
                                                       <a class="btn color-btn btn_color_active" data-btncolor="{{$value_color->label}}" data-valuecolor="{{$value_color->value}}" style="background-color:{{$value_color->label}}"></a>
                                                    </div>
                                                  @endif
                                                @endif
                                              @endforeach
                                            @endif
                                          @endforeach
                                        @else
                                          @if($product_options->result->item->attributeId == '93' && $product_options->result->item->label == 'Color')
                                            @foreach($product_options->result->item->values->item as $key_value => $value_value)
                                                @if(count($product_options->result->item->values->item) > 1)
                                                  @if($value_value->valueIndex == $value_color->value)
                                                    <div class="col-1 mr-2 px-2 mb-2 text-center">
                                                       <a class="btn color-btn btn_color_active" data-btncolor="{{$value_color->label}}" data-valuecolor="{{$value_color->value}}" style="background-color:{{$value_color->label}}"></a>
                                                    </div>
                                                  @endif
                                                @endif
                                            @endforeach
                                          @endif
                                        @endif
                                      @endforeach
                                    @endforeach
                                  @endif
                                @else
                                  @if(!empty($color_product))
                                    @foreach($color_product->result->item as $key_color_product => $value_color_product)
                                      @if($value_color_product->value == $colorproduct2)
                                        <div class="col-1 mr-2 px-2 mb-2 text-center">
                                           <button type="button" class="btn color-btn color-active" style="background-color:{{ $value_color_product->label }}"></button>
                                        </div>
                                      @endif
                                    @endforeach
                                  @endif
                                @endif

                              @else
                                  @if(!empty($color_product))
                                    @foreach($color_product->result->item as $key_color_product => $value_color_product)
                                      @if($value_color_product->value == $colorproduct2)
                                        <div class="col-1 mr-2 px-2 mb-2 text-center">
                                           <button type="button" class="btn color-btn color-active" style="background-color:{{ $value_color_product->label }}"></button>
                                        </div>
                                      @endif
                                    @endforeach
                                  @endif
                              @endif
                                <!-- <div class="col-1 mr-2 px-2 mb-2 text-center">
                                  <button type="button" class="btn color-btn" style="background-color:white"></button>
                                </div> -->
                              </div>
                              <span class="ml-2">
                                 Size
                              </span>
                              <div class="row mx-0 mt-2 mb-3 size-select-box">
                              @if(isset($product_options->result->item))
                                @if(!empty($product_options))
                                  @if(!empty($size_products))
                                    @foreach($size_products->result->item as $key_sizes => $value_sizes)
                                      @if(is_array($product_options->result->item))
                                        @foreach($product_options->result->item as $key_options => $value_options)
                                          @if($value_options->attributeId == '135' && $value_options->label == 'Size')
                                            @foreach($value_options->values->item as $key_value => $value_value)
                                              @if(count($value_options->values->item) > 1)
                                                @if($value_value->valueIndex == $value_sizes->value)
                                                  <div class="col-xl-4 col-6 px-0 size-select btn_size_active @if($value_value->valueIndex != $value_sizes->value) {{ 'disabled' }} @endif" data-btnsize="{{ $value_sizes->label }}" data-valuesize="{{$value_sizes->value}}">
                                                    <span>{{ $value_sizes->label }}</span>
                                                  </div>
                                                @endif
                                              @else
                                                @if($value_value == $value_sizes->value)
                                                <div class="col-xl-4 col-6 px-0 size-select btn_size_active @if($value_value != $value_sizes->value) {{ 'disabled' }} @endif" data-btnsize="{{ $value_sizes->label }}" data-valuesize="{{$value_sizes->value}}">
                                                  <span>{{ $value_sizes->label }}</span>
                                                </div>
                                                @endif
                                              @endif
                                            @endforeach
                                          @endif
                                        @endforeach
                                      @else
                                        @if($product_options->result->item->attributeId == '135' && $product_options->result->item->label == 'Size')
                                          @foreach($product_options->result->item->values->item as $key_value => $value_value)
                                              @if(count($product_options->result->item->values->item) > 1)
                                                @if($value_value->valueIndex == $value_sizes->value)
                                                  <div class="col-xl-4 col-6 px-0 size-select btn_size_active @if($value_value->valueIndex != $value_sizes->value) {{ 'disabled' }} @endif" data-btnsize="{{ $value_sizes->label }}" data-valuesize="{{$value_sizes->value}}">
                                                    <span>{{ $value_sizes->label }}</span>
                                                  </div>
                                                @endif
                                              @endif
                                          @endforeach
                                        @endif
                                      @endif
                                    @endforeach
                                  @endif
                                @else
                                  @if(!empty($size_products))
                                    @foreach($size_products->result->item as $key_color_product => $value_size_product)
                                      @if($value_size_product->value == $size)
                                        <div class="col-xl-4 col-6 px-0 size-select active">
                                          <span>{{ $value_size_product->label }}</span>
                                        </div>
                                      @endif
                                    @endforeach
                                  @endif
                                @endif
                              @else
                                @if(!empty($size_products))
                                  @foreach($size_products->result->item as $key_color_product => $value_size_product)
                                    @if($value_size_product->value == $size)
                                      <div class="col-xl-4 col-6 px-0 size-select active">
                                        <span>{{ $value_size_product->label }}</span>
                                      </div>
                                    @endif
                                  @endforeach
                                @endif
                              @endif
                                <!-- <div class="col-xl-4 col-6 px-0 size-select disabled">
                                  <span>US 7.5</span>
                                </div>
                                <div class="col-xl-4 col-6 px-0 size-select active">
                                  <span>US 8</span>
                                </div> -->
                              </div>
                            </div>

                            @if(!empty($stock))
                              @foreach($stock as $color => $sizes)
                                @foreach($sizes as $size => $value)
                                  @if($value->result->qty != 0)
                                    {{ $color }} {{ $size }} {{ $value->result->qty }}
                                  @endif
                                @endforeach
                              @endforeach
                            @endif

                            <div class="row my-3 mx-0 pb-3 sticky-product-picker" style="width: 100%;">
                              <div class="col-xl-6 col-lg-12 col-6 px-xl-1 px-lg-0 px-md-2 px-1 latest-product-btn mb-2">
                                @if($products_detail->result->items->item->typeId == 'simple')
                                  <button type="button" class="btn_add_to_cart" data-product_detail="{{ $products_detail->result->items->item->name }}" data-product_id="{{ $products_detail->result->items->item->id }}" data-price_product="@if($price_special != $price_defult)
                                    {{ $price_special }}
                                      @endif" class="btn add-to-cart p-2">
                                  <label class="mb-0 d-flex pr-2">
                                    <span>Add to cart</span>
                                    <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                  </label>
                                </button>
                                @else
                                <button type="button" class="btn add-to-cart btn_add_to_cart_config p-2">
                                  <label class="mb-0 d-flex px-2">
                                    <span>ADD TO CART</span>
                                    <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                  </label>
                                </button>
                                @endif
                              </div>
                              <div class="col-xl-6 col-lg-12 col-6 px-xl-1 px-lg-0 px-md-2 px-1 latest-product-btn">
                                <button type="button" class="btn fast-buy p-2">
                                  <label class="mb-0 d-flex px-2">
                                    <span>BUY NOW</span>
                                    <i class="icon-collpase fas fa-angle-right ml-auto pt-1" aria-hidden="true"></i>
                                  </label>
                                </button>
                              </div>

                              <input type="hidden" name="text_type_product" class="text_type_product" value="{{ $products_detail->result->items->item->typeId }}" readonly>
                              <input type="hidden" name="text_color_product" class="text_color_product" readonly>
                              <input type="hidden" name="text_valuecolor_product" class="text_valuecolor_product" readonly>
                              <input type="hidden" name="text_size_product" class="text_size_product" readonly>
                              <input type="hidden" name="text_valuesize_product" class="text_valuesize_product" readonly>
                              <input type="hidden" name="text_name_product" class="text_name_product" value="{{ $products_detail->result->items->item->name }}" readonly>
                              <input type="hidden" name="text_price_product" class="text_price_product" value="@if($price_special != $price_defult) {{ $price_special }} @else {{ $price_defult }} @endif" readonly>
                            </div>


                            <div class="sticky-product-excerpt mb-2">
                                <span>@if(!empty($short_description)){{ str_limit(strip_tags($short_description),400) }}@endif</span>
                                <br>
                                <label class="additional-details d-flex" data-toggle="modal" data-target="#viewdetials">
                                <a class="additional-details ml-auto" href="#">More Detail.. &raquo;</a>
                                </label>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade full-screen-product" id="viewdetials" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <div class="row w-100 px-3">

                                      <div class="col-xl-3 col-lg-5 colmd-7 col-12">
                                        <div class="row detail-product-frame">
                                          <div class="col-md-3 col-4 p-md-0 p-2">
                                             <div class="detail-product-frame">
                                               <img class="detail-product-img" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$small_image}}">
                                             </div>
                                          </div>
                                          <div class="col-md-9 col-8 px-lg-2 px-lg-0 px-md-1 px-0">
                                              <div class="cart-product-detail detail-product-frame">
                                                <div class="cart-product-name">
                                                  <span>{{ $products_detail->result->items->item->name }}</span>
                                                </div>
                                                <div class="cart-product-quantity">
                                                  @if(!empty($price_defult))
                                                    <span class="pull-left @if($price_defult != $price_special) {{ 'discounted' }} @endif mx-1">{{ number_format($price_defult,2) }}</span>
                                                  @endif
                                                      <span class="@if($price_special != $price_defult) {{ 'discount' }} @endif">
                                                        @if($price_special != $price_defult)
                                                          {{ number_format($price_special,2) }}
                                                        @endif
                                                      </span>
                                                      <span class="currency">THB</span>
                                                </div>
                                              </div>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="ml-auto btn-cmd-detail-position">
                                        <button type="button" class="close custom-close2 my-auto" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>

                                    </div>
                                  </div>
                                  <div class="modal-body product-detail-modal-body">
                                    <div class="container">
                                      <pre>@if(!empty($description)){!! $description !!}@endif</pre>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                  </div>
              </div>
            </div>
          </section>

          <section class="latest-product mb-lg-5 mb-md-5 mb-4">
            @include('latest-product')
          </section>
        </div>
        <!-- END SITE CONTENT -->

@endforeach
@endif

      </div>

@endsection

@section('js_bottom')
<script>
  if(window.matchMedia("(min-width: 1366px)").matches){
    $('#zoom1').zoom();
    $('#zoom2').zoom();
    $('#zoom3').zoom();
    $('#zoom4').zoom();
    $('#zoom5').zoom();
    $('#zoom6').zoom();
  }
  var fixmeTop = $('.product-detail-left-side').offset().top;       // get initial position of the element
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
  $('.productdetail2-carousel').find('.owl-dots').toggleClass('disabled custom-dots');
  $('.productdetail2-carousel').find('.tog').addClass('d-none');
  // $('.owl-video-play-icon').remove();

$('body').on('click','.btn_color_active',function(){
  var data = $(this).data('btncolor');
  var valuecolor = $(this).data('valuecolor');
  var text_color_product = $('.text_color_product').val();
  if(text_color_product != ''){
    if(data != text_color_product){
      $('.btn_color_active').removeClass('color-active');
      $(this).addClass('color-active');
      $('.text_color_product').val(data);
      $('.text_valuecolor_product').val(valuecolor);
    } else {
      $(this).removeClass('color-active');
      $('.text_color_product').val('');
      $('.text_valuecolor_product').val('');
    }
  } else {
    $(this).addClass('color-active');
    $('.text_color_product').val(data);
    $('.text_valuecolor_product').val(valuecolor);
  }
});

$('body').on('click','.btn_size_active',function(){
  var data = $(this).data('btnsize');
  var valuesize = $(this).data('valuesize');
  var text_size_product = $('.text_size_product').val();
  if(text_size_product != ''){
    if(data != text_size_product){
      $('.btn_size_active').removeClass('active');
      $(this).addClass('active');
      $('.text_size_product').val(data);
      $('.text_valuesize_product').val(valuesize);
    } else {
      $(this).removeClass('active');
      $('.text_size_product').val('');
      $('.text_valuesize_product').val('');
    }
  } else {
    $(this).addClass('active');
    $('.text_size_product').val(data);
    $('.text_valuesize_product').val(valuesize);
  }
});

$('body').on('click','.btn_add_to_cart_config',function(){
  var text_color_product = $('.text_color_product').val();
  var text_size_product = $('.text_size_product').val();
  var text_name_product = $('.text_name_product').val();
  var text_price_product = $('.text_price_product').val();
  var text_valuecolor_product = $('.text_valuecolor_product').val();
  var text_valuesize_product = $('.text_valuesize_product').val();
  var text_type_product = $('.text_type_product').val();
  // $('body').loader('show');
  // if(text_color_product != '' && text_size_product != '' && text_name_product != '' && text_price_product != '' && text_valuecolor_product != '' && text_valuesize_product != ''){
    $('body').loader('show');
    $.ajax({
      method : "POST",
      url : url_gb+"/addproductconfigurable",
      dataType: "JSON",
      data : { 'text_color_product' :text_color_product , 'text_size_product' : text_size_product ,'text_name_product':text_name_product ,'text_price_product':text_price_product,'text_valuecolor_product':text_valuecolor_product,'text_valuesize_product':text_valuesize_product,'text_type_product':text_type_product},
    }).done(function(rec){
      if(rec.status == 1){
        al_su(rec.content,'success');
        location.reload();
        $('body').loader('hide');
      } else if(rec.status == 2) {
        window.location.href = url_gb+'/regist';
      } else {
        $('body').loader('hide');
        al_su(rec.content,'danger');
      }
    }).fail(function(){
        $('body').loader('hide');
        al_su('Error','danger');
    });
  // } else {
  //   al_su('กรุณาเลือกประเภทสินค้า','danger');
  //   // $('body').loader('hide');
  // }
});
</script>

@endsection
