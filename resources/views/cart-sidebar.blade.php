<!-- CART CONTENT -->
<div class="overlay" onclick="close()"></div>

<div class="loading">
  <img id="loading-image" src="assets/images/loading/spinner.gif" alt="Loading..." />
</div>

<nav id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-head">
      <div class="row h-100 mx-0">
        <div class="col-12 px-0">
          <div class="row p-2">

              <!-- Product loop -->
              @if(!empty($cart_customer))
                @php
                  $sum_price = 0;
                  $date = date('Y-m-d H:i:s');
                @endphp

                @foreach($cart_customer as $key_cart => $value_cart)

                @foreach($product_key[$key_cart]->result->customAttributes->item as $key_product => $value_product)
                  @if($value_product->attributeCode == 'special_from_date')
                    @php $start_date = $value_product->value; @endphp
                  @endif

                  @if($value_product->attributeCode == 'special_to_date')
                    @php $end_date = $value_product->value; @endphp
                  @endif

                  @if($value_product->attributeCode == 'special_price')
                    @php $special_price = $value_product->value; @endphp
                  @endif
                @endforeach

                  @foreach($product_key[$key_cart]->result->customAttributes->item as $key_product_image => $value_image)
                    @if($value_image->attributeCode == 'image')
                      <div class="col-lg-5 col-md-5 col-5 p-md-0 p-2 cart-col">
                        <a href="{{ url('product-details2') }}">
                          <div class="cart-product-frame">
                            <img class="cart-product" src="http://192.168.1.27/dilok2/pub/media/catalog/product\{{ $value_image->value }}">
                          </div>
                        </a>
                      </div>
                    @endif
                  @endforeach

                <div class="col-lg-7 col-md-7 col-7 cart-col cart-col-414 px-lg-2 px-md-2 px-0">
                    <div class="cart-product-detail">
                      <div class="cart-bin">
                          <button class="bin-btn delete_cart_product" data-product_sku="{{ $value_cart->sku }}" data-id_sku="{{ $value_cart->item_id }}">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                          </button>
                      </div>
                      <div class="cart-product-name">
                        <!-- <a href="{{ url('product-detail-1') }}"> -->
                        <a>
                            <span>{{ $value_cart->name }}</span>
                          </a>
                      </div>
                      @foreach($product_key[$key_cart]->result->customAttributes->item as $key_product_image => $value_sizes)
                        @foreach($size_products->result->item as $key_size => $value_size)
                          @if($value_sizes->attributeCode == 'size')
                            @if($value_size->value == $value_sizes->value)
                                @php $size = $value_size->label @endphp
                            @endif
                          @endif
                        @endforeach
                      @endforeach
                      @foreach($product_key[$key_cart]->result->customAttributes->item as $key_product_image => $value_colors)
                        @foreach($color_product->result->item as $key_color => $value_color)
                          @if($value_colors->attributeCode == 'color')
                            @if($value_color->value == $value_colors->value)
                              <div class="cart-product-size">
                                    <span>{{ $value_color->label }}, UK {{ $size }}</span>
                              </div>
                            @endif
                          @endif
                        @endforeach
                      @endforeach
                      <!-- <div class="cart-product-size">
                            <span>B41674</span>
                      </div> -->
                      <div class="cart-product-quantity">
                            <span class="mr-xl-1 mr-md-3 mr-2">qty</span>
                            <!-- <a class="minus" onclick="minusfunction()"> - </a> -->
                            <input class="input-group-field" name="quantity" type="number" value="{{ $value_cart->qty }}"/>
                            <!-- <a class="plus" onclick="plusfunction()"> + </a> -->
                            <span class="pull-right">THB</span>
                            @if($date >= $start_date && $date <= $end_date)
                              <span class="pull-right discount mx-1">
                                {{ number_format($special_price,2) }}
                              </span>
                            @endif
                            <span class="pull-right @if($date >= $start_date && $date <= $end_date) {{'discounted'}} @endif">
                              @if($date >= $start_date && $date <= $end_date)
                                {{ number_format($product_key[$key_cart]->result->price,2) }}
                              @endif
                            </span>
                      </div>
                    </div>
                </div>
                <div class="w-100 px-4">
                  <hr>
                </div>
                @php
                  $sum_price += $value_cart->price;
                @endphp
                @endforeach
              @endif
              <!-- END first product  loop -->

              <!-- <div class="col-lg-5 col-md-5 col-5 p-md-0 p-2 cart-col">
                <a href="{{ url('product-details2') }}">
                    <div class="cart-product-frame">
                      <img class="cart-product" src="assets/images/product/2/adidas/2.jpg">
                    </div>
                  </a>
              </div>
              <div class="col-lg-7 col-md-7 col-7 cart-col cart-col-414 px-lg-2 px-md-2 px-0">
                  <div class="cart-product-detail">
                    <div class="cart-bin">
                        <button class="bin-btn">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="cart-product-name">
                      <a href="{{ url('product-detail-1') }}">
                          <span>Adidas Deerupt Runner</span>
                        </a>
                    </div>
                    <div class="cart-product-size">
                          <span>Red, UK 7</span>
                    </div>
                    <div class="cart-product-size">
                          <span>B41674</span>
                    </div>
                    <div class="cart-product-quantity">
                          <span class="mr-xl-1 mr-md-3 mr-2">qty</span>
                          <a class="minus" onclick="minusfunction()"> - </a>
                          <input class="input-group-field" name="quantity" type="number" value="1"/>
                          <a class="plus" onclick="plusfunction()"> + </a>
                           <span class="pull-right">THB</span><span class="pull-right mx-1">2,400</span>
                    </div>
                  </div>
              </div>
              <div class="w-100 px-4">
                <hr>
              </div> -->

              <!-- <div class="col-lg-5 col-md-5 col-5 p-md-0 p-2 cart-col">
                <a href="{{ url('product-details2') }}">
                    <div class="cart-product-frame">
                      <img class="cart-product" src="assets/images/product/2/adidas/3.jpg">
                    </div>
                  </a>
              </div>
              <div class="col-lg-7 col-md-7 col-7 cart-col cart-col-414 px-lg-2 px-md-2 px-0">
                  <div class="cart-product-detail">
                    <div class="cart-bin">
                        <button class="bin-btn">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="cart-product-name">
                      <a href="{{ url('product-detail-1') }}">
                          <span>Adidas Stan Smith CF</span>
                        </a>
                    </div>
                    <div class="cart-product-size">
                          <span>Black, UK 7</span>
                    </div>
                    <div class="cart-product-size">
                          <span>B41674</span>
                    </div>
                    <div class="cart-product-quantity">
                          <span class="mr-xl-1 mr-md-3 mr-2">qty</span>
                          <a class="minus" onclick="minusfunction()"> - </a>
                          <input class="input-group-field" name="quantity" type="number" value="1"/>
                          <a class="plus" onclick="plusfunction()"> + </a>
                           <span class="pull-right">THB</span><span class="pull-right discount mx-1">2,400</span><span class="pull-right discounted">4,800</span>
                    </div>
                  </div>
              </div>
              <div class="w-100 px-4">
                <hr>
              </div>

              <div class="col-lg-5 col-md-5 col-5 p-md-0 p-2 cart-col">
                <a href="{{ url('product-details2') }}">
                    <div class="cart-product-frame">
                      <img class="cart-product" src="assets/images/product/2/adidas/4.jpg">
                    </div>
                  </a>
              </div>
              <div class="col-lg-7 col-md-7 col-7 cart-col cart-col-414 px-lg-2 px-md-2 px-0">
                  <div class="cart-product-detail">
                    <div class="cart-bin">
                        <button class="bin-btn">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="cart-product-name">
                      <a href="{{ url('product-detail-1') }}">
                          <span>Adidas Deerupt Runner</span>
                        </a>
                    </div>
                    <div class="cart-product-size">
                          <span>Red, UK 7</span>
                    </div>
                    <div class="cart-product-size">
                          <span>B41674</span>
                    </div>
                    <div class="cart-product-quantity">
                          <span class="mr-xl-1 mr-md-3 mr-2">qty</span>
                          <a class="minus" onclick="minusfunction()"> - </a>
                          <input class="input-group-field" name="quantity" type="number" value="1"/>
                          <a class="plus" onclick="plusfunction()"> + </a>
                           <span class="pull-right">THB</span><span class="pull-right mx-1">2,400</span>
                    </div>
                  </div>
              </div>
              <div class="w-100 px-4">
                <hr>
              </div>


              <div class="col-lg-5 col-md-5 col-5 p-md-0 p-2 cart-col">
                <a href="{{ url('product-details2') }}">
                    <div class="cart-product-frame">
                      <img class="cart-product" src="assets/images/product/2/adidas/5.jpg">
                    </div>
                  </a>
              </div>
              <div class="col-lg-7 col-md-7 col-7 cart-col cart-col-414 px-lg-2 px-md-2 px-0">
                  <div class="cart-product-detail">
                    <div class="cart-bin">
                        <button class="bin-btn">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="cart-product-name">
                      <a href="{{ url('product-detail-1') }}">
                          <span>Adidas Stan Smith CF</span>
                        </a>
                    </div>
                    <div class="cart-product-size">
                          <span>Black, UK 7</span>
                    </div>
                    <div class="cart-product-size">
                          <span>B41674</span>
                    </div>
                    <div class="cart-product-quantity">
                          <span class="mr-xl-1 mr-md-3 mr-2">qty</span>
                          <a class="minus" onclick="minusfunction()"> - </a>
                          <input class="input-group-field" name="quantity" type="number" value="1"/>
                          <a class="plus" onclick="plusfunction()"> + </a>
                          <span class="pull-right">THB</span><span class="pull-right discount mx-1">2,400</span><span class="pull-right discounted">4,800</span>
                    </div>
                  </div>
              </div>
              <div class="w-100 px-4">
                <hr>
              </div>


              <div class="col-lg-5 col-md-5 col-5 p-md-0 p-2 cart-col">
                <a href="{{ url('product-details2') }}">
                    <div class="cart-product-frame">
                      <img class="cart-product" src="assets/images/product/2/adidas/6.jpg">
                    </div>
                  </a>
              </div>
              <div class="col-lg-7 col-md-7 col-7 cart-col cart-col-414 px-lg-2 px-md-2 px-0">
                  <div class="cart-product-detail">
                    <div class="cart-bin">
                        <button class="bin-btn">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="cart-product-name">
                      <a href="{{ url('product-detail-1') }}">
                          <span>Adidas Deerupt Runner</span>
                        </a>
                    </div>
                    <div class="cart-product-size">
                          <span>Red, UK 7</span>
                    </div>
                    <div class="cart-product-size">
                          <span>B41674</span>
                    </div>
                    <div class="cart-product-quantity">
                          <span class="mr-xl-1 mr-md-3 mr-2">qty</span>
                          <a class="minus" onclick="minusfunction()"> - </a>
                          <input class="input-group-field" name="quantity" type="number" value="1"/>
                          <a class="plus" onclick="plusfunction()"> + </a>
                          <span class="pull-right">THB</span><span class="pull-right mx-1">2,400</span>
                    </div>
                  </div>
              </div>
              <div class="w-100 px-4">
                <hr>
              </div> -->
              <!-- End last product loop -->
          </div>
        </div>
      </div>
    </div>
    <!-- END Sidebar Header -->
    <div class='sidebar-bottom'>
      <div class="row pt-4 px-5 mx-0">
        <div class="col-12 text-center">
            <div class="subtotal">
              <span class="pull-left">Subtotal:</span><span class="pull-right"> THB</span><span class="pull-right">@if(!empty($sum_price)){{ $sum_price }}@endif</span>
            </div>
        </div>
        <div class="col-12 my-1 text-center">
            <div class="shipping">
              <span class="pull-left">Shipping:</span><span class="pull-right">THB</span><span class="pull-right">100</span>
            </div>
        </div>
        <div class="col-12  mb-3 text-center">
            <div class="total">
              <span class="pull-left">Total:</span><span class="pull-right">THB</span><span class="pull-right">@if(!empty($sum_price)){{ $sum_price+100 }}@endif</span>
            </div>
        </div>
        <div class="col-12 text-center justify-content-center">
            <div class="checkout">
              <a href="{{ url('payment') }}" class="btn checkout-btn">CHECK OUT  ></a>
            </div>
        </div>

        <!-- <div class="col-12 px-0 text-center">
            <hr>
            <div class="promotion">
              <a id="promotion-code" class="promotion-code" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <div class="promotion-button">
                     <span class="pull-left">กรอกรหัสโปรโมชั่น / ส่วนลด</span><span class="icon-collpase fa fa-plus pull-right" aria-hidden="true"></span>
                  </div>
              </a>
              <div class="promotion-collapse collapse mb-2" id="collapseExample">
                <form>
                  <div class="form-group text-left">
                    <label>Enter promo code or gift coupon code.</label>
                    <input type="text" class="form-control code-input" id="" aria-describedby="" placeholder="">
                  </div>
                  <div class="code-button">
                    <button type="submit" class="btn btn-primary pull-left">CHECK BALANCE</button>
                    <button type="submit" class="btn btn-primary pull-right">CONFIRM</button>
                  </div>
                </form>
              </div>
            </div>
            <hr class="mt-0">
        </div> -->

      </div>
    </div>
</nav>
<!-- END CART CONTENT -->
