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
    $df = $products_detail->result->items->item->price;
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
            <div class="product-detail-box product-detail-boxes">

              <div class="product-detail1-left-side mb-md-4 mb-3">

                <div class="row">
                  <div class="col-12 mb-xl-4 mb-lg-4 mb-0">
                    <div id="product-carousel"  class="carousel slide product-carousel" data-ride="carousel">
                      <div class="carousel-inner">
                        <!-- <div class="carousel-item active"> -->
                          @if(isset($products_gallery->result->item))
                            @if(is_array($products_gallery->result->item))
                              @foreach($products_gallery->result->item as $key_gallerys => $value_gallerys)
                                <div class="carousel-item @if(isset($value_gallerys->types->item)) {{ 'active' }} @endif">
                                  <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1">
                                    <img class="product-carousel-img" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$value_gallerys->file}}">
                                  </div>
                                </div>
                              @endforeach
                            @else
                            <div class="carousel-item">
                              <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1">
                                <img class="product-carousel-img" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$value_gallerys->file}}">
                              </div>
                            </div>
                            @endif
                          @else
                          <div class="carousel-item active">
                            <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1">
                              <img class="product-carousel-img" src="{{ url('assets/images/No_Image_Available.jpg') }}">
                            </div>
                          </div>
                          @endif

                        <!-- </div> -->
                        <!-- <div class="carousel-item"> -->
                          <!-- <div class="product-carousel-frame" data-toggle="modal" data-target="#full-screen-product-1"> -->
                            <!-- รุป youtube เปลี่ยนแค่ช่องก่อน0.jpg เป็นlink video -->
                            <!--< iframe width="100%" height="100%" src="https://www.youtube.com/embed/iGEUCPnw4Po?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
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
                        </div> -->
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
                  @php $i = 1; @endphp
                  @if(isset($products_gallery->result->item))
                    @if(is_array($products_gallery->result->item))
                      @foreach($products_gallery as $key_gallerys => $value_gallerys)
                        @foreach($value_gallerys->item as $key_gallery => $value_gallery)
                        <div class="item item{{$i++}}">
                          <div class="product-ipad-frame">
                            <img  class="product-ipad-img" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$value_gallery->file}}">
                          </div>
                        </div>
                        @endforeach
                      @endforeach
                    @else
                      <div class="item item">
                        <div class="product-ipad-frame">
                          <img  class="product-ipad-img" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$products_gallery->result->item->file}}">
                        </div>
                      </div>
                    @endif
                  @else
                    <div class="item item">
                      <div class="product-ipad-frame">
                        <img  class="product-ipad-img" src="{{ url('assets/images/No_Image_Available.jpg') }}">
                      </div>
                    </div>
                  @endif
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
                              @else
                                <img width="100%" src="{{ url('assets/images/No_Image_Available.jpg') }}">
                              @endif
                             </div>

                             <div class="col-12 px-0 h-100 d-xl-block d-none">
                               <!-- carouselExampleIndicators มี css -->
                               <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                 <ol class="carousel-indicators">
                                  @if(isset($products_gallery->result->item))
                                      @if(is_array($products_gallery->result->item))
                                        @foreach($products_gallery->result->item as $key_gallerys => $value_gallerys)
                                          <li data-target="#carouselExampleIndicators" data-slide-to="{{$key_gallerys}}" class="active"></li>
                                        @endforeach
                                      @else
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                      @endif
                                  @else
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                  @endif
                                 </ol>
                                 <div class="carousel-inner w-50 mx-auto">
                                    @if(isset($products_gallery->result->item))
                                      @if(is_array($products_gallery->result->item))
                                        @foreach($products_gallery->result->item as $key_gallerys => $value_gallerys)
                                          <div class="carousel-item h-100 @if(isset($value_gallerys->types->item)) {{ 'active' }} @endif">
                                            <img class="d-block h-100 w-100" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$value_gallerys->file}}">
                                          </div>
                                        @endforeach
                                      @else
                                        <div class="carousel-item h-100">
                                          <img class="d-block h-100 w-100" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$value_gallerys->file}}">
                                        </div>
                                      @endif
                                    @else
                                      <div class="carousel-item h-100 active">
                                        <img class="d-block h-100 w-100" src="{{ url('assets/images/No_Image_Available.jpg') }}">
                                      </div>
                                    @endif
                                      <!-- <div class="carousel-item">
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
                                      </div> -->
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
                              <h2>{{ $products_detail->result->items->item->name }}
                                <!-- <button type="button" class="btn top-btn heart-btn pull-right"><i name="like-button" class="fa-1x fa-heart liked fas liked-shaked"></i></button> -->
                                <!-- <button type="button" class="btn top-btn pull-right"><i class="fa-1x fa-share-alt fas"></i></button> -->
                              </h2>
                          </div>

                          <div class="sticky-product-excerpt mb-2">
                              <span>@if(!empty($short_description)){{ str_limit(strip_tags($short_description),400) }}@endif</span>
                          </div>

                          <div class="sticky-product-picker">
                            <span class="ml-2">
                               Color
                            </span>
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
                            </div>
                            <span class="ml-2">
                               Size
                            </span>
                            <div class="row mx-0 mt-2 mb-3 size-select-box2">

                        <div class="dropdown">
                          <button class="btn add-to-cart dropdown-toggle value_select" type="button" data-toggle="dropdown">Choose size (UK)
                           <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                  <div class="size-picker">
                                      <div class="row w-100 mx-0 p-2">
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
                                                            <div class="size-item btn_size_active" data-btnsize="{{ $value_sizes->label }}" data-valuesize="{{$value_sizes->value}}">
                                                              {{ $value_sizes->label }}
                                                            </div>
                                                          @endif
                                                        @else
                                                      @if($value_value == $value_sizes->value)
                                                        <div class="size-item btn_size_active" data-btnsize="{{ $value_sizes->label }}" data-valuesize="{{$value_sizes->value}}">
                                                          {{ $value_sizes->label }}
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
                                                  <div class="size-item btn_size_active" data-btnsize="{{ $value_sizes->label }}" data-valuesize="{{$value_sizes->value}}">
                                                    {{ $value_sizes->label }}
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
                                        <div class="size-item active">
                                          {{ $value_size_product->label }}
                                        </div>
                                      @endif
                                    @endforeach
                                  @endif
                                @endif
                              @else
                                @if(!empty($size_products))
                                  @foreach($size_products->result->item as $key_color_product => $value_size_product)
                                    @if($value_size_product->value == $size)
                                      <div class="size-item active">
                                        {{ $value_size_product->label }}
                                      </div>
                                    @endif
                                  @endforeach
                                @endif
                              @endif
                            </div>
                          </div>
                        </ul>
                      </div>



                            </div>
                          </div>


                          <div class="sticky-product-quantity p-3">
                            <div class="row mx-0">
                              <div class="col-5 px-0 pt-2">


                                <!-- <select class="quantity">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                </select>
                                <span class="red">2 pieces, left</span> -->
                              </div>
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
                                        @if(!empty($percen_sum))
                                        <span>{{number_format($percen_sum,0)}}%</span>
                                        @endif
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

                          <input type="hidden" name="text_type_product" class="text_type_product" value="{{ $products_detail->result->items->item->typeId }}" readonly>
                          <input type="hidden" name="text_color_product" class="text_color_product" readonly>
                          <input type="hidden" name="text_valuecolor_product" class="text_valuecolor_product" readonly>
                          <input type="hidden" name="text_size_product" class="text_size_product" readonly>
                          <input type="hidden" name="text_valuesize_product" class="text_valuesize_product" readonly>
                          <input type="hidden" name="text_name_product" class="text_name_product" value="{{ $products_detail->result->items->item->name }}" readonly>
                          <input type="hidden" name="text_price_product" class="text_price_product" value="@if($price_special != $price_defult) {{ $price_special }} @else {{ $price_defult }} @endif" readonly>

                          <div class="row my-3 mx-0">
                            <div class="col-xl-4 col-lg-6"></div>
                            <div class="col-xl-4 col-lg-3 col-md-6 col-12 px-xl-1 px-lg-1 px-md-2 px-1 latest-product-btn latest-product-btn-detail1 mb-2">
                              <!-- <button type="button" class="btn add-to-cart p-2">
                                <label class="mb-0 d-flex px-2">
                                  <span>ADD TO CART</span>
                                  <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                </label>
                              </button> -->
                              <button type="button" class="btn add-to-cart btn_add_to_cart_config p-2">
                                <label class="mb-0 d-flex px-2">
                                  <span>ADD TO CART</span>
                                  <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                </label>
                              </button>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-md-6 col-12 px-xl-1 px-lg-1 px-md-2 px-1 latest-product-btn latest-product-btn-detail1">
                              <button type="button" class="btn fast-buy p-2 btn_add_to_cart_config">
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
                  <p>@if(!empty($description)){!! $description !!}@endif</p>
                </div>
            </div>
          </section>

          <section class="latest-product mb-lg-5 mb-md-5 mb-4">
              @include('latest-product')
          </section>
        </div>

@endforeach
@endif

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
      $('.value_select').html(data);
    } else {
      $(this).removeClass('active');
      $('.text_size_product').val('');
      $('.text_valuesize_product').val('');
      $('.value_select').html('Choose size (UK)');
    }
  } else {
    $(this).addClass('active');
    $('.text_size_product').val(data);
    $('.text_valuesize_product').val(valuesize);
    $('.value_select').html(data);
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
      } else if(rec.status == 3) {
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





</script>
@endsection
