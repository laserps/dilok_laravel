@extends('welcome')
@section('css_bottom')
<style>
.checkboxlist{
  opacity:1 !important;
  position: absolute;
  top: 0;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #fff;
  margin-top: 7px;
  border: 1px solid #d2d2d2 !important;
}
</style>
@endsection
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
                        <span class="filter_list"></span>
                        @php
                          $session_chk = session()->all();
                          $chk_brand  = '';
                          $chk_gender  = '';
                          $chk_size  = '';
                          $chk_colorproduct  = '';
                        @endphp
                        @if(!empty($session_chk['session_brand']))
                          @foreach($session_chk['session_brand'] as $key => $value)
                            @php $chk_brand = $value @endphp
                          @endforeach
                        @endif
                        @if(!empty($session_chk['session_gender']))
                          @foreach($session_chk['session_gender'] as $key => $value)
                            @php $chk_gender = $value @endphp
                          @endforeach
                        @endif
                        @if(!empty($session_chk['session_size']))
                          @foreach($session_chk['session_size'] as $key => $value)
                            @php $chk_size = $value @endphp
                          @endforeach
                        @endif
                        @if(!empty($session_chk['session_colorproduct']))
                          @foreach($session_chk['session_colorproduct'] as $key => $value)
                            @php $chk_colorproduct = $value @endphp
                          @endforeach
                        @endif

                        @if(!empty($brands2))
                          @if($brands2 == 'Men' || $brands2 == 'Women' || $brands2 == 'Kid')
                          @else
                            <span class="fillter-block fillter-select fillter-font3 remove_gender_tag'+data+'">
                              <a class="fas fillter-close pr-2 remove_gender" data-remove_gender="'+data+'"></a>{{ $brands2 }}
                            </span>
                          @endif
                        @endif
                        @if(!empty($genders22))
                          @if($genders22 != 'Men' || $genders22 != 'Women' || $genders22 != 'Kid')
                          <span class="fillter-block fillter-select fillter-font3 remove_gender_tag'+data+'">
                            <a class="fas fillter-close pr-2 remove_gender" data-remove_gender="'+data+'"></a>{{ $genders22 }}
                          </span>
                          @endif
                        @endif

                    </div>
                </div>
            </div>
        </form>
        <hr>
        @if(!empty($_GET['genders']))
            @php $genders = $_GET['genders']; @endphp
        @else
            @php $genders = ''; @endphp
        @endif

        <form class="form-group" id="type">
              <button class="btn fillter-bg px-0" type="button" data-toggle="collapse" data-target="#collapseExample222" aria-expanded="false" aria-controls="collapseExample">
                  <span class="fillter-font2 pull-left">GENDER</span>
                  <span class="fas fa-chevron-down pull-right" aria-hidden="true"></span>
              </button>
              <div class="collapse show" id="collapseExample222">
                  <div class="filter-scroll">
                      @foreach($gender->result->item as $key_category => $value_category)
                        @if($value_category->label != ' ')
                          @if(!empty($genders) && $genders == $value_category->value || !empty($genders22) && $genders22 == $value_category->label || !empty($chk_gender))
                            <label class="check">
                                <div class="regist-m-l2 pt-1 fillter-font3 " data-type="{{ $value_category->value }}">{{ $value_category->label }}</div>
                                <input style="" name="gender[]" data-text_gender="{{ $value_category->label }}" class="checkboxlist checkmark data_type2{{ $value_category->value }}" data-type="{{ $value_category->value }}"  type="checkbox" value="{{ $value_category->value }}" @if(!empty($genders22)) {{ 'checked' }} @endif @if(!empty($genders)) {{ 'checked' }} @endif @if($chk_gender == $value_category->value) {{ 'checked' }} @endif />
                                <!-- <span class="checkmark data_type{{ $value_category->value }}" data-type="{{ $value_category->value }}" data-text_type="{{ $value_category->label }}"></span> -->
                            </label>
                          @else
                            <label class="check">
                                <div class="regist-m-l2 pt-1 fillter-font3 " data-type="{{ $value_category->value }}">{{ $value_category->label }}</div>
                                <input style="" name="gender[]" data-text_gender="{{ $value_category->label }}" class="checkboxlist checkmark data_type2{{ $value_category->value }}" data-type="{{ $value_category->value }}"  type="checkbox" value="{{ $value_category->value }}" />
                                <!-- <span class="checkmark data_type{{ $value_category->value }}" data-type="{{ $value_category->value }}" data-text_type="{{ $value_category->label }}"></span> -->
                            </label>
                          @endif
                        @endif
                      @endforeach
                  </div>
              </div>
              <div class="test22"></div>
          <hr>
            @if(!empty($_GET['brands']))
                @php $brands = $_GET['brands']; @endphp
            @else
                @php $brands = ''; @endphp
            @endif

                <button class="btn fillter-bg px-0" type="button" data-toggle="collapse" data-target="#collapseExample333" aria-expanded="false" aria-controls="collapseExample">
                    <span class="fillter-font2 pull-left">BRAND {{ $chk_brand }} {{ $brands2 }}</span>
                    <span class="fas fa-chevron-down pull-right" aria-hidden="true"></span>
                </button>
                <div class="collapse show" id="collapseExample333">
                    <div class="filter-scroll">
                        @foreach($category->result->childrenData->item as $key_category => $value_category)
                          @if($value_category->name != 'Default Category')
                            @if(!empty($brands) && $brands == $value_category->id || !empty($brands2) && $brands2 == $value_category->name || !empty($chk_brand))
                              <label class="check">
                                  <div class="regist-m-l2 pt-1 fillter-font3" data-type="{{ $value_category->id }}">{{ $value_category->name }}</div>
                                  <input name="brand[]" type="checkbox" data-text_gender="{{ $value_category->name }}" data-type="{{ $value_category->id }}" class="checkboxlist checkmark data_type2{{ $value_category->id }}" value="{{ $value_category->id }}" @if(!empty($brands2)) @if($brands2 == $value_category->name) {{ 'checked' }} @endif @endif @if(!empty($brands)) {{ 'checked' }} @endif @if(!empty($brands2)) @if($chk_brand == $value_category->id) {{ 'checked' }} @endif @endif />
                                  <!-- <span class="checkmark data_type{{ $value_category->id }}" data-type="{{ $value_category->id }}" data-text_type="{{ $value_category->name }}"></span> -->
                              </label>
                              @else
                                  <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3" data-type="{{ $value_category->id }}">{{ $value_category->name }}</div>
                                    <input name="brand[]" type="checkbox" data-text_gender="{{ $value_category->name }}" data-type="{{ $value_category->id }}" class="checkboxlist checkmark data_type2{{ $value_category->id }}" value="{{ $value_category->id }}" />
                                    <!-- <span class="checkmark data_type{{ $value_category->id }}" data-type="{{ $value_category->id }}" data-text_type="{{ $value_category->name }}"></span> -->
                                </label>
                              @endif
                          @endif
                        @endforeach
                    </div>
                </div>
          <hr>
                <!-- <button class="btn fillter-bg px-0" type="button" data-toggle="collapse" data-target="#collapseExample444" aria-expanded="false" aria-controls="collapseExample">
                    <span class="fillter-font2 pull-left">CLOTHING SIZE</span>
                    <span class="fas fa-chevron-down pull-right" aria-hidden="true"></span>
                </button>
                <div class="collapse show" id="collapseExample444">
                    <div class="filter-scroll">
                      @if(!empty($clothing_size))
                        @foreach($clothing_size->result->item as $key_sizes => $value_sizes)
                          @if($value_sizes->label != ' ')
                            <label class="check">
                                <div class="regist-m-l2 pt-1 fillter-font3">{{ $value_sizes->label }}</div>
                                <input type="checkbox"/>
                                <span class="checkmark"></span>
                            </label>
                          @endif
                        @endforeach
                      @endif
                    </div>
                </div>
            <hr> -->
                  <button class="btn fillter-bg px-0" type="button" data-toggle="collapse" data-target="#collapseExample555" aria-expanded="false" aria-controls="collapseExample">
                      <span class="fillter-font2 pull-left">FOOTWEAR SIZE</span>
                      <span class="fas fa-chevron-down pull-right" aria-hidden="true"></span>
                  </button>
                  <div class="collapse show" id="collapseExample555">
                      <div class="filter-scroll">
                          @foreach($size_products->result->item as $key_sizes => $value_sizes)
                            @if($value_sizes->label != ' ')
                              @if(!empty($chk_size))
                                <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">{{ $value_sizes->label }}</div>
                                    <input name="size[]" type="checkbox" data-text_gender="{{ $value_sizes->label }}" data-type="{{ $value_sizes->value }}"" class="checkboxlist checkmark data_type2{{ $value_sizes->value }}" value="{{ $value_sizes->value }}" @if($chk_size == $value_sizes->value) {{ 'checked' }} @endif />
                                    <!-- <span class="checkmark data_type{{ $value_sizes->value }}"></span> -->
                                </label>
                              @else
                                <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">{{ $value_sizes->label }}</div>
                                    <input name="size[]" type="checkbox" data-text_gender="{{ $value_sizes->label }}" data-type="{{ $value_sizes->value }}"" class="checkboxlist checkmark data_type2{{ $value_sizes->value }}" value="{{ $value_sizes->value }}"/>
                                    <!-- <span class="checkmark data_type{{ $value_sizes->value }}"></span> -->
                                </label>
                              @endif
                            @endif
                          @endforeach
                      </div>
                  </div>
              <hr>
                    <button class="btn fillter-bg px-0" type="button" data-toggle="collapse" data-target="#collapseExample666" aria-expanded="false" aria-controls="collapseExample">
                        <span class="fillter-font2 pull-left">COLOR</span>
                        <span class="fas fa-chevron-down pull-right" aria-hidden="true"></span>
                    </button>
                    <div class="collapse show" id="collapseExample666">
                        <div class="filter-scroll">
                          @foreach($color_product->result->item as $key_color => $value_color)
                            @if($value_color->label != ' ')
                              @if(!empty($chk_colorproduct))
                                <label class="check">
                                    <div class="regist-m-l2 pt-1 fillter-font3">{{$value_color->label}}</div>
                                    <input name="colorproduct[]" data-text_gender="{{ $value_color->label }}" data-type="{{ $value_color->value }}" type="checkbox" class="checkboxlist checkmark data_type2{{ $value_color->value }}" value="{{ $value_color->value }}" @if($chk_colorproduct == $value_color->value) {{ 'checked' }} @endif />
                                    <!-- <span class="checkmark data_type{{ $value_color->value }}"></span> -->
                                </label>
                              @else
                                <label class="check">
                                  <div class="regist-m-l2 pt-1 fillter-font3">{{$value_color->label}}</div>
                                  <input name="colorproduct[]" data-text_gender="{{ $value_color->label }}" data-type="{{ $value_color->value }}" type="checkbox" class="checkboxlist checkmark data_type2{{ $value_color->value }}" value="{{ $value_color->value }}"/>
                                  <!-- <span class="checkmark data_type{{ $value_color->value }}"></span> -->
                                </label>
                              @endif
                            @endif
                          @endforeach
                        </div>
                    </div>
              </form>
            <hr>
         </div>
    </section>

    <div class="filtered-item filtered-item3 col-xl-10 col-lg-9 col-md-12 fadeIn animated">
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

      <div id="filter_data_search"></div>
      <section class="grid-item box box-padding" id="filter_data">
          <ul class="row list-unstyled">
            @if(!empty($products->result->items->item))
              @foreach($products->result->items->item as $key_product => $value_product)
                @foreach($value_product->customAttributes as $key_custom => $value_custom)
                  <li class="col-xl-3 col-lg-4 col-md-4 col-6 fadeIn animated filtered-item2 fillter-m-b filter-p">

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
                    $price_defult = 0;
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

                  @if(!empty($products2->result->items->item[$key_product]->priceInfo->regularPrice))
                    @if($value_product->id == $products2->result->items->item[$key_product]->id)
                      @php $price_defult = $products2->result->items->item[$key_product]->priceInfo->regularPrice; @endphp
                    @else
                      @php $price_defult = $value_product->price; @endphp
                    @endif
                  @else
                    @php $price_defult = $value_product->price; @endphp
                  @endif

                  @if(!empty($products2->result->items->item[$key_product]->priceInfo->finalPrice))
                    @if($value_product->id == $products2->result->items->item[$key_product]->id)
                      @php $price_special = $products2->result->items->item[$key_product]->priceInfo->finalPrice; @endphp
                    @else
                      @php $price_special = $value_product->price; @endphp
                    @endif
                  @else
                    @php $price_special = $value_product->price; @endphp
                  @endif

                    <div class="item">
                      <div class="card p-1 fillter-m filter-r filter-position-r">
                        @if(!empty($news_from_date) && !empty($news_to_date))
                          @if($date >= $news_from_date && $date <= $news_to_date)
                            <div id="ribbon" class="green-ribbon">
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

                        @if($price_defult != $price_special)
                          @if($percen_sum != null || $percen_sum != '')
                            <div id="ribbon2" class="red-ribbon" style="@if($price_defult == $price_special) {{ 'display: none;' }} @else {{ '' }} @endif">{{number_format($percen_sum,0)}}%
                            </div>
                          @endif
                        @endif
                          <div class="latest-product-frame filter-frame filter-product-frame ">
                              <a href="{{ url('product/'.$value_product->id) }}">
                                @if(!empty($image))
                                  <img class="latest-product-pic" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$image}}" alt="Card image cap">
                                @else
                                  <img class="latest-product-pic" src="{{ url('assets/images/No_Image_Available.jpg') }}" alt="Card image cap">
                                @endif
                              </a>
                              <a href="{{ url('product/'.$value_product->id) }}"> <img class="latest-product-pic second-latest-product" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$small_image}}" alt="Card image cap"> </a>
                          </div>
                          <div class="card-body p-1 filter-a filter-position-a">
                            <div class="row px-0 mx-0">
                                <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                                    <!-- <div class="product-title filter-font-product1"> -->
                                    <div class="filter-font-product1">
                                      <span>{{ $value_product->name }}<span>
                                    </div>
                                    <div class="product-categories filter-font-product1">
                                        @foreach($value_custom as $key => $value)
                                          @if(!empty($value->attributeCode) && !empty($value->value) && $value->attributeCode == 'short_description')
                                            <span>{!! str_limit(strip_tags($value->value),50) !!}</span>
                                          @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-3 col-md-3 col-4 mb-2 px-0 text-right">
                                  <!-- <button type="button" class="btn heart-btn"><i name="like-button" class="fa-2x fa-heart liked fas liked-shaked"></i></button> -->
                                  <!-- <button type="button" class="btn heart-btn"><i name="like-button" class="far fa-2x fa-heart not-liked"></i></button> -->
                                </div>
                                <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                                <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">
                                  @if(!empty($price_defult))
                                    <span class="@if($price_special != $price_defult){{'before'}}@endif">{{ number_format($price_defult,2) }}</span>
                                  @endif
                                      <span style="@if($price_special != $price_defult){{'padding-right: 0px;'}}@endif" class="@if($price_special != $price_defult){{'after'}}@endif">
                                        @if($price_special != $price_defult)
                                            {{ number_format($price_special,2) }}
                                        @endif
                                      </span>
                                      <span class="currency filter-font-product1">THB</span>
                                </div>
                                <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                  <!-- <button type="button" class="btn add-to-cart p-2"> -->
                                  <button type="button" class="btn_add_to_cart" data-product_detail="{{ $value_product->name }}" data-product_id="{{ $value_product->id }}" data-price_product="@if($price_special != $price_defult)
                                    {{ $price_special }}
                                  @endif" class="btn add-to-cart p-2">
                                  <!-- <a href="{{ url('product/'.$value_product->id) }}"> -->
                                    <input type="hidden" name="price_product_main" value="@if($price_special != $price_defult){{number_format($price_special,2)}}@else @if(!empty($price_defult)) {{number_format($price_defult,2)}} @endif @endif">
                                    <!-- <button type="button" class="btn add-to-cart p-2"> -->
                                    <!-- <button type="button" class="btn_add_to_cart" data-product_detail="{{ $value_product->name }}" data-product_id="{{ $value_product->id }}" data-price_product="@if($price_special != $price_defult) -->
                                    <!-- {{ $price_special }} -->
                                <!-- @endif" class="btn add-to-cart p-2"> -->
                                      <label class="mb-0 d-flex pr-2">
                                        <span>Add to cart</span>
                                        <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                                      </label>
                                    </button>
                                  <!-- </a> -->
                                  <!-- </button> -->
                                </div>
                                <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                                  <a href="{{ url('product/'.$value_product->id) }}">
                                    <button type="button" class="btn fast-buy p-2">
                                      <label class="mb-0 d-flex pr-2">
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
                  </li>
                @endforeach
              @endforeach
            @endif
          </ul>

        <div class="container">
          <ul class="pagination justify-content-center">
            @php
              $prev_page = $products->result->searchCriteria->currentPage-1;
              $next_page = $products->result->searchCriteria->currentPage+1;
              $main_page = $products->result->searchCriteria->currentPage;
              $sum_products = $products->result->totalCount;
              $products = $products->result->searchCriteria->pageSize;
              $page_number = number_format($sum_products/$products);
              $sum_page = ($page_number-$main_page);
              $main_page2 = $main_page-4;
              $gender_list_page = null;
            @endphp
            @if($sum_page <= 4)
              @php $sum_page = $main_page+$sum_page; $main_page2 = $main_page; @endphp
            @else
              @php $sum_page = $main_page+4; $main_page2 = $main_page-4; @endphp
            @endif
            @if($main_page2 <= 4)
              @php $main_page2 = $main_page-($main_page-1); @endphp
            @else
              @php $main_page-4; @endphp
            @endif
            @if(!empty($genders22))
              @if($genders22 == 'Male')
                @php $gender_list_page = 'Men'; @endphp
              @elseif($genders22 == 'Female')
                @php $gender_list_page = 'Women'; @endphp
              @elseif($genders22 == 'Kids')
                @php $gender_list_page = 'Kid'; @endphp
              @endif
            @endif
            @if($prev_page)
              @if(!empty($brands2) && !empty($gender_list_page))
                <li class="page-item pr-1"><a class="news_page-link" href="{{ url('brands') }}/{{$brands2}}/{{$gender_list_page}}?page={{$prev_page}}">&laquo;</a></li>
              @elseif(!empty($brands2))
                <li class="page-item pr-1"><a class="news_page-link" href="{{ url('brands') }}/{{$brands2}}?page={{$prev_page}}">&laquo;</a></li>
              @else
                <li class="page-item pr-1"><a class="news_page-link" href="{{ url('filter') }}?page={{$prev_page}}">&laquo;</a></li>
              @endif
            @endif
            @for($i = $main_page2; $i <= $sum_page; $i++)
              @if(!empty($brands2) && !empty($gender_list_page))
                <li class="page-item pr-1"><a @if($main_page == $i) style="background-color: #999;" @endif class="news_page-link page_main" href="{{ url('brands') }}/{{$brands2}}/{{$gender_list_page}}?page={{$i}}">{{ $i }}</a></li>
              @elseif(!empty($brands2))
                <li class="page-item pr-1"><a @if($main_page == $i) style="background-color: #999;" @endif class="news_page-link page_main" href="{{ url('brands') }}/{{$brands2}}?page={{$i}}">{{ $i }}</a></li>
              @else
                <li class="page-item pr-1"><a @if($main_page == $i) style="background-color: #999;" @endif class="news_page-link page_main" href="{{ url('filter') }}?page={{$i}}">{{ $i }}</a></li>
              @endif
            @endfor
            @if($i != 1)
              @if($next_page)
                @if(!empty($brands2) && !empty($gender_list_page))
                  <li class="page-item pr-1"><a class="news_page-link" href="{{ url('brands') }}/{{$brands2}}/{{$gender_list_page}}?page={{$next_page}}">&raquo;</a></li>
                @elseif(!empty($brands2))
                  <li class="page-item pr-1"><a class="news_page-link" href="{{ url('brands') }}/{{$brands2}}?page={{$next_page}}">&raquo;</a></li>
                @else
                  <li class="page-item pr-1"><a class="news_page-link" href="{{ url('filter') }}?page={{$next_page}}">&raquo;</a></li>
                @endif
              @endif
            @endif
          </ul>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection

@section('js_bottom')
<script type="text/javascript">
var gid;
function gender(value){
  gid = $(value).data('type');
  if($('#type input[value="'+gid+'"]').is(':checked') == false){
    $('#type input[value="'+gid+'"]').attr('checked',true);
  } else {
    $('#type input[value="'+gid+'"]').attr('checked',false);
  }
}

$('body').on('click','.checkmark',function(){
    var data = $(this).data('type');
    var text = $(this).data('text_gender');
    var form = $('#type').serializeArray();
    $('body').loader('show');
      $.ajax({
        method : "POST",
        url : url_gb+"/gender",
        data : form,
    }).done(function(rec){
      $('#filter_data').remove();
      $('#filter_data_search').html(rec);
      $('body').loader('hide');
      // fa-times
      if($('.data_type2'+data).is(':checked') == true){
        $('.filter_list').append('<span class="fillter-block fillter-select fillter-font3 remove_gender_tag'+data+'">\n\
                        <a class="fas fillter-close pr-2 remove_gender" data-remove_gender="'+data+'"></a>'+text+'\n\
                      </span>');
      } else {
        $('.remove_gender_tag'+data).remove();
      }
    }).fail(function(){
      $('body').loader('hide');
      al_su('Error','danger');
    });
});

// $('body').on('click','.remove_gender',function(){
//   var data = $(this).data('remove_gender');
//   $('body').loader('show');
//     $.ajax({
//       method : "POST",
//       url : url_gb+"/gender/"+data,
//       dataType : 'json'
//   }).done(function(rec){
//       if(data == rec.gender_id.value) {
//         $('body').loader('hide');
//         $('.remove_gender_tag'+rec.gender_id.value).remove();
//       }
//   }).fail(function(){
//     $('body').loader('hide');
//     al_su('Error','danger');
//   });
// });

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
        }
        if($('.filter-frame').hasClass('filter-product-frame5')){
          $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');
          $('.filter-frame').addClass('filter-product-frame');
        }
    } else if(document.getElementById("demo").innerHTML == 'hide filter'){
      document.getElementById("demo").innerHTML = "show filter";
        if($('.filter-frame').hasClass('filter-product-frame2')){
          $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');
          $('.filter-frame').addClass('filter-product-frame4');
        }
        if($('.filter-frame').hasClass('filter-product-frame')){
          $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');
          $('.filter-frame').addClass('filter-product-frame5');
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
      } else {
        $('.btn-row').prop("disabled", false);
        $('.btn-column').prop("disabled", true);
        $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');
        $('.filter-frame').addClass('filter-product-frame2');
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
    } else {
      $('.btn-row').prop("disabled", true);
      $('.btn-column').prop("disabled", false);
      $('.filter-frame').removeClass('filter-product-frame filter-product-frame2 filter-product-frame3 filter-product-frame4 filter-product-frame5 filter-product-frame6');
      $('.filter-frame').addClass('filter-product-frame');
    }
}
  </script>
@endsection
