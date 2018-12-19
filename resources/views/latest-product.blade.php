<div class="row mx-0 px-lg-0 px-md-5 px-1 d-lg-block d-md-none d-none">
    <div class="col-12">
        <h3 class="mb-2">LATEST PRODUCT</h3>

        <div class="latest-slide owl-carousel owl-theme">

        @if(!empty($products->result->items->item))
          @foreach($products->result->items->item as $key_product => $value_product)
            @foreach($value_product->customAttributes as $key_custom => $value_custom)
          <!-- บังคับ first child มัclass first    last child มี class last  -->
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

              @if(!empty($products2->result->items->item[$key_product]->priceInfo->regularPrice))
                @if($value_product->id == $products2->result->items->item[$key_product]->id)
                  @php $price_defult = $products2->result->items->item[$key_product]->priceInfo->regularPrice; @endphp
                @else
                  @php $price_defult = ''; @endphp
                @endif
              @endif

              @if(!empty($products2->result->items->item[$key_product]->priceInfo->finalPrice))
                @if($value_product->id == $products2->result->items->item[$key_product]->id)
                  @php $price_special = $products2->result->items->item[$key_product]->priceInfo->finalPrice; @endphp
                @else
                  @php $price_special = ''; @endphp
                @endif
              @else
                @php $price_special = ''; @endphp
              @endif
          <div class="item first">
            <div class="card p-1">
                <div class="latest-product-frame">
                  <a href="{{ url('product/'.$value_product->id) }}">
                    <img class="latest-product-pic" src="http://dilokstore.com/magento/pub/media/catalog/product\{{$image}}" alt="Card image cap">
                  </a>
                  <a href="{{ url('product/'.$value_product->id) }}"> <img class="latest-product-pic second-latest-product" src="http://dilokstore.com/magento/pub/media/catalog/product\{{$small_image}}" alt="Card image cap"> </a>
                </div>
                <div class="card-body p-0">
                  <div class="row px-0 mx-0">
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

                  @if(!empty($price_defult))
                    @if($price_defult != $price_special)
                      @if($percen_sum != null || $percen_sum != '')
                        <div id="ribbon2" class="red-ribbon">{{number_format($percen_sum,0)}}%
                        </div>
                      @endif
                    @endif
                  @endif
                      <div class="col-8 px-xl-2 px-0 mb-2">
                          <div class="product-title">
                            <span>{{ $value_product->name }}<span>
                          </div>
                          <div class="product-categories">
                            @foreach($value_custom as $key => $value)
                              @if(!empty($value->attributeCode) && !empty($value->value) && $value->attributeCode == 'short_description')
                                <span>{!! $value->value !!}</span>
                              @endif
                            @endforeach
                          </div>
                      </div>
                      <div class="col-2 mb-2 px-0"></div>
                      <div class="col-2 mb-2 px-0">
                        <!-- <button type="button" class="btn heart-btn"><i name="like-button" class="fa-2x fa-heart liked fas liked-shaked"></i></button> -->
                        <button type="button" class="btn heart-btn"><i name="like-button" class="far fa-2x fa-heart not-liked"></i></button>
                      </div>
                      <div class="col-4 px-xl-2 px-0 mb-2">
                      </div>
                      <div class="col-8 px-xl-2 px-0 mb-2 latest-product-price">

                        @if(!empty($price_defult))
                          <span class="@if($price_defult != $price_special){{$before}}@endif">
                              {{ number_format($price_defult,2) }}
                          </span>
                        @endif
                          <span style="@if(!empty($price_special)) @if($price_defult != $price_special){{$pan}} {{"color:red"}} @endif @endif" class="@if($date >= $special_from_date && $date <= $special_to_date){{$after}}@endif">
                          
                              
                                {{ $price_special }}
                              
                             
                          </span>
                          <span class="currency">THB</span>
                      </div>
                      <div class="col-xl-6 col-lg-12 px-xl-1 px-lg-0 mb-xl-0 mb-2 latest-product-btn">
                        <a href="{{ url('product/'.$value_product->id) }}">
                          <button type="button" class="btn add-to-cart p-2">
                            <label class="mb-0 d-flex px-2">
                              <span>Add to cart</span>
                              <i class="fas fa-plus ml-auto pt-1" aria-hidden="true"></i>
                            </label>
                          </button>
                        </a>
                      </div>
                      <div class="col-xl-6 col-lg-12 px-xl-1 px-lg-0 latest-product-btn">
                        <a href="{{ url('product/'.$value_product->id) }}">
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
        @endforeach
      @endif
        </div>
    </div>
</div>



<!---แสดงในโมบาย- -->


<!-- <div class="frame mb-5 d-lg-none d-md-block d-block" style="height:auto;overflow-x:auto;overflow-y:hidden;">
   <div class="" style="display:flex;height:auto;">
      <div class="inner-item ">
        <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/01.jpg" alt="Card image cap"></a>
            </div>
            <div id="ribbon" class="green-ribbon">
            New
            </div>
            <div id="ribbon2" class="red-ribbon">
            -50%
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item ">
        <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/02.jpg" alt="Card image cap"></a>
            </div>
           <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item ">
        <div class="h-100">
          <div class="latest-card" >
           <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/03.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item ">
        <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/04.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
       <div class="inner-item ">
        <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/09.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item ">
        <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/08.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item ">
        <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/020.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item ">
        <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/08.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item ">
        <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/09.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
   </div>


  <div class="w-100 mt-4" style="display:flex;height:auto;">
    <div class="inner-item w-100">
       <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/010.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>

            </div>
          </div>
        </div>
      </div>
      <div class="inner-item w-100">
        <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/011.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item w-100">
        <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/012.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item w-100">
       <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/013.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item w-100">
       <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/014.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item w-100">
       <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/015.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>

            </div>
          </div>
        </div>
      </div>
      <div class="inner-item w-100">
       <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/016.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item w-100">
       <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/017.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-item w-100">
       <div class="h-100">
          <div class="latest-card" >
            <div class="latest-fix-frame">
              <a href="{{ url('product-details1')}}"><img class="latest-img-top" src="assets/images/product/2/adidas/01.jpg" alt="Card image cap"></a>
            </div>
            <div class="card-body">
              <a href="{{ url('product-details1')}}"><p class="card-title text-dark">Pureboost DPR Shoes</p></a>
              <a href="{{ url('product-details1')}}"><p class="card-text text-secondary" style="font-size: 14px;">Men running</p></a>
              <span class="normal">1,850</span><span class="currency">THB</span>
            </div>
          </div>
        </div>
      </div>
   </div>
</div> -->
