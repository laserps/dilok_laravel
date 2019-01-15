<section class="grid-item box box-padding">
  <ul class="row list-unstyled">


  @if(!empty($products->result->items->item))
    @if(count($products->result->items->item) != 1)
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
            $price_special = '';
            $price_defult = '';
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

        @if(isset($products->result->items->item))
          @if(!empty($products->result->items->item[$key_product]))
            @php $price_defult = $products->result->items->item[$key_product]->price; @endphp
          @endif
        @else
          @php $price_defult = ''; @endphp
        @endif


        @if(isset($products2->result->items->item))
          @if(!empty($products2->result->items->item[$key_product]->priceInfo->finalPrice))
            @if($value_product->id == $products2->result->items->item[$key_product]->id)
              @php $price_special = $products2->result->items->item[$key_product]->priceInfo->finalPrice; @endphp
            @else
              @php $price_special = ''; @endphp
            @endif
          @endif
        @else
          @php $price_special = ''; @endphp
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
                  @if(!empty($price_special))
                    @if($price_defult != $price_special)
                      @php $percen_sum = (100-(($price_special*100)/$price_defult)); @endphp
                    @else
                      @php $percen_sum = '0'; @endphp
                    @endif
                  @else
                    @php $percen_sum = '0'; @endphp
                  @endif
                @else
                  @php $percen_sum = ''; $before = ''; @endphp
                @endif

                @if($price_defult != $price_special)
                  @if($percen_sum != null)
                    <div id="ribbon2" class="red-ribbon" style="@if($percen_sum == '0') {{ 'display: none;' }} @else {{ '' }} @endif">{{number_format($percen_sum,0)}}%
                    </div>
                  @endif
                @endif
                  <div class="latest-product-frame filter-frame filter-product-frame ">
                      <a href="{{ url('product/'.$value_product->id) }}">
                        @if(!empty($image))
                          <img class="latest-product-pic" style="width: 100%; height: auto;" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$image}}" alt="Card image cap">
                        @else
                          <img class="latest-product-pic" style="width: 100%; height: auto;" src="{{ url('assets/images/No_Image_Available.jpg') }}" alt="Card image cap">
                        @endif
                      </a>
                      <a href="{{ url('product/'.$value_product->id) }}"> <img style="width: 100%; height: auto;" class="latest-product-pic second-latest-product" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$small_image}}" alt="Card image cap"> </a>
                  </div>
                  <div class="card-body p-1 filter-a filter-position-a">
                    <div class="row px-0 mx-0">
                        <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                            <div class="product-title filter-font-product1">
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
                          <button type="button" class="btn heart-btn"><i name="like-button" class="far fa-2x fa-heart not-liked"></i></button>
                        </div>
                        <div class="col-xl-4 col-md-4 col-0 col-lg-3 px-xl-2 px-0 mb-2 filtered-item3 d-md-flex d-none"></div>
                        <div class="col-xl-8 col-md-8 col-lg-9 col-12 px-xl-2 px-0 mb-2 latest-product-price filtered-item3">

                            <span class="@if(!empty($price_special)) @if($price_special != $price_defult){{'before'}}@endif @endif">{{ number_format($price_defult,2) }}</span>

                              <span style="@if($price_special != $price_defult){{'padding-right: 0px;'}}@endif" class="@if($price_special != $price_defult){{'after'}}@endif">
                                @if($price_special != $price_defult)
                                    {{ $price_special }}
                                @endif
                              </span>
                              <span class="currency filter-font-product1">THB</span>
                        </div>
                        <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                          <button type="button" class="btn_add_to_cart" data-product_detail="{{ $value_product->name }}" data-product_id="{{ $value_product->id }}" data-price_product="@if(!empty($price_special))
                                    {{ $price_special }}
                          @else
                          {{ $price_defult }}
                                @endif" class="btn add-to-cart p-2">
                            <label class="mb-0 d-flex pr-2">
                              <span>Add to cart</span>
                              <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                            </label>
                          </button>
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

    @else
        @foreach($products->result->items->item->customAttributes as $key_custom => $value_custom)
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

        @if(isset($products2->result->items->item))
          @if(!empty($products2->result->items->item->priceInfo->regularPrice))
            @php $price_defult = $products2->result->items->item->priceInfo->regularPrice; @endphp
          @endif
        @else
          @php $price_defult = ''; @endphp
        @endif

        @if(isset($products2->result->items->item))
          @if(!empty($products2->result->items->item->priceInfo->finalPrice))
            @php $price_special = $products2->result->items->item->priceInfo->finalPrice; @endphp
          @endif
        @else
          @php $price_special = ''; @endphp
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
                      <a href="{{ url('product/'.$products->result->items->item->id) }}">
                        @if(!empty($image))
                          <img class="latest-product-pic" style="width: 100%; height: auto;" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$image}}" alt="Card image cap">
                        @else
                          <img class="latest-product-pic" style="width: 100%; height: auto;" src="{{ url('assets/images/No_Image_Available.jpg') }}" alt="Card image cap">
                        @endif
                      </a>
                      <a href="{{ url('product/'.$products->result->items->item->id) }}"> <img style="width: 100%; height: auto;" class="latest-product-pic second-latest-product" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$small_image}}" alt="Card image cap"> </a>
                  </div>
                  <div class="card-body p-1 filter-a filter-position-a">
                    <div class="row px-0 mx-0">
                        <div class="col-xl-8 col-lg-9 col-md-9 col-8 px-xl-2 px-0 mb-2">
                            <div class="product-title filter-font-product1">
                              <span>{{ $products->result->items->item->name }}<span>
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
                          <button type="button" class="btn heart-btn"><i name="like-button" class="far fa-2x fa-heart not-liked"></i></button>
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
                          <button type="button" class="btn_add_to_cart" data-product_detail="{{ $products->result->items->item->name }}" data-product_id="{{ $products->result->items->item->id }}" data-price_product="@if($price_special != $price_defult)
                                    {{ $price_special }}
                                @endif" class="btn add-to-cart p-2">
                            <label class="mb-0 d-flex pr-2">
                              <span>Add to cart</span>
                              <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                            </label>
                          </button>
                        </div>
                        <div class="d-none d-lg-block d-md-none col-xl-6 col-lg-12 px-xl-1 px-lg-0 mt-2 latest-product-btn latest-product-btn-pond fillter-btn-width">
                          <a href="{{ url('product/'.$products->result->items->item->id) }}">
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
    @endif
  @else
    ไม่มีสินค้า
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
    @if(empty($sum_page))
      @php $sum_page = 1; @endphp
    @endif
    @if($prev_page)
      <li class="page-item pr-1"><a class="news_page-link" href="{{ url('filter') }}?page={{$prev_page}}">&laquo;</a></li>
    @endif
    @for($i = $main_page2; $i <= $sum_page; $i++)
          <li class="page-item pr-1"><a @if($main_page == $i) style="background-color: #999;" @endif class="news_page-link page_main" href="{{ url('filter') }}?page={{$i}}">{{ $i }}</a></li>
    @endfor
    @if($next_page)
      <li class="page-item pr-1"><a class="news_page-link" href="{{ url('filter') }}?page={{$next_page}}">&raquo;</a></li>
    @endif
  </ul>
</div>
</section>