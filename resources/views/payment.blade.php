@extends('welcome')
@section('body')
<!-- START CONTENT -->
<div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->
<div class="container-fluid custom-container fadeIn animated">
        <div class="row">
          <div class="col-xl-6 mt-5">
            <div class="card pay-b-n p-3">
              <div class="pay-font1">Payment Method</div>
              <!-- <div class="pt-3"> -->
            <form id="form_total_cart_product">
                 <!-- <label class="pay-select">
                     <div class="pay-font4" style="display:inline;">Credit/Debit</div>
                     <img src="{{ asset('assets/images/payment/visa.jpg') }}" class="pay-size2" style="display:inline;">
                     <img src="{{ asset('assets/images/payment/mc.png') }}" class="pay-size3" style="display:inline;">
                     <input type="radio" name="radio" class="payment_method" data-payment_method="checkmo2">
                     <span class="checkmark2"></span>
                     <div class="pay-font2 pt-2">
                       It is a long established fact that a reader will be distracted by the
                       readable content of a page when looking.
                     </div>
                 </label>

                 <div class="form-group row pt-2">
                      <div class="col-xl-4 txt-right">
                        <label class="pay-font3">Credit type<span class="forgot-font3 ml-1">*</span></label>
                      </div>
                      <div class="col-xl-6">
                        <input type="text" value="" name="" class="pay-form">
                      </div>
                      <div class="col-xl-2"></div>
                 </div>
                 <div class="form-group row">
                      <div class="col-xl-4 txt-right">
                        <label class="pay-font3">Credit Number<span class="forgot-font3 ml-1">*</span></label>
                      </div>
                      <div class="col-xl-6">
                        <input type="text" value="" name="" class="pay-form">
                      </div>
                      <div class="col-xl-2"></div>
                 </div>
                 <div class="form-group row">
                      <div class="col-xl-4 txt-right">
                        <label class="pay-font3">Expiry Date<span class="forgot-font3 ml-1">*</span></label>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-md-6 col-6 pay-m-l-r">
                        <input type="text" value="" name="" class="pay-form">
                      </div>
                      <div class="col-xl-3 col-lg-6 col-md-6 col-6 pay-m-l-r">
                        <input type="text" value="" name="" class="pay-form">
                      </div>
                      <div class="col-xl-3"></div>
                 </div>
                 <div class="form-group row">
                      <div class="col-xl-4 txt-right">
                        <label class="pay-font3">CVV<span class="forgot-font3 ml-1">*</span></label>
                      </div>
                      <div class="col-xl-3">
                        <input type="text" value="" name="" class="pay-form">
                      </div>
                 </div>
                 <hr class="mt-5">
                   <label class="pay-select">
                      <div class="pay-font4" style="display:inline;">Online Banking</div>
                      <input type="radio" name="radio" class="payment_method" data-payment_method="checkmo">
                      <span class="checkmark2"></span>
                      <div class="flex-sm-row d-lg-inline d-md-inline d-xl-inline">
                        <img src="{{ asset('assets/images/payment/bb.png') }}" class="pay-size " style="display:inline;">
                        <img src="{{ asset('assets/images/payment/scb.jpg') }}" class="pay-size" style="display:inline;">
                        <img src="{{ asset('assets/images/payment/kbank.png') }}" class="pay-size" style="display:inline;">
                        <img src="{{ asset('assets/images/payment/ktb.jpg') }}" class="pay-size" style="display:inline;">
                        <img src="{{ asset('assets/images/payment/mc.png') }}" class="pay-size2" style="display:inline;">
                      </div>
                   </label> -->
                 <label class="pay-select">
                     <div class="pay-font4" style="display:inline;">Paypal</div>
                       <img src="{{ asset('assets/images/payment/pp.png') }}" class="pay-size2" style="display:inline;">
                     <input type="radio" name="radio" class="payment_method" data-payment_method="paypal_express" checked>
                     <span class="checkmark2"></span>
                 </label>
            </div>
            <input type="hidden" name="payment_method_value" class="payment_method_value" value="paypal_express">
          </div>
          <div class="col-xl-3  mt-5">
            <div class="card pay-b-n p-3">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="pay-font1" style="display:inline;">Billing Address</div>
                        <div class="pay-font1 pay-m-l2 w-100" style="display:inline;">
                          <a href="#" class="pay-font5" data-toggle="modal" id="billing_modal" data-target="#billing"><u>edit</u></a>
                        </div>
                    </div>
                </div>
                <div class="pt-3">
                    <div class="pay-font6">
                      <div><span>Firstname : </span><span id="bill_firstname">@if(!empty($token_customer->addresses[0]->firstname)){{ $token_customer->addresses[0]->firstname }} @endif</span></div>
                      <div><span>Lastname : </span><span id="bill_lastname">@if(!empty($token_customer->addresses[0]->lastname)){{ $token_customer->addresses[0]->lastname }} @endif</span></div>
                      <div><span>Street : </span><span id="bill_street1">@if(!empty($token_customer->addresses[0]->street[0])){{ $token_customer->addresses[0]->street[0] }} @endif</span></div>
                      <div><span>Street2 : </span><span id="bill_street2">@if(!empty($token_customer->addresses[0]->street[1])){{ $token_customer->addresses[0]->street[1] }} @endif</span></div>
                      <div><span>Company : </span><span id="bill_company">@if(!empty($token_customer->addresses[0]->company)) {{ $token_customer->addresses[0]->company }} @endif</span></div>
                      <div><span>Telephone : </span><span id="bill_telephone">@if(!empty($token_customer->addresses[0]->telephone)) {{ $token_customer->addresses[0]->telephone }} @endif</span></div>
                      <div><span>City : </span><span id="bill_city">@if(!empty($token_customer->addresses[0]->city)) {{ $token_customer->addresses[0]->city }} @endif</span></div>
                      <div><span>Postcode : </span><span id="bill_postcode">@if(!empty($token_customer->addresses[0]->postcode)) {{ $token_customer->addresses[0]->postcode }} @endif</span></div>
                      <div><span>Country : </span><span id="bill_country_id">@if(!empty($token_customer->addresses[0]->country_id)) {{ $token_customer->addresses[0]->country_id }} @endif</span></div>
                      <!-- <div><span>Email : </span><span id="bill_email">@if(!empty($token_customer->addresses[0]->email)) {{ $token_customer->addresses[0]->email }} @endif</span></div> -->

                      <input type="hidden" name="id_value_billing" id="id_value_billing" value="@if(!empty($token_customer->addresses[0]->id)) {{ $token_customer->addresses[0]->id }} @endif" required>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="pay-font1"style="display:inline;">Shipping Address</div>
                        <div class="pay-font1 pay-m-l3 w-100" style="display:inline;">
                          <a href="#" class="pay-font5" data-toggle="modal" data-target="#shipping"><u>edit</u></a>
                        </div>
                    </div>
                </div>
                <div class="pt-3">
                    <div class="pay-font6">
                      <div><span>Firstname : </span><span id="shipping_firstname">@if(!empty($token_customer->addresses[0]->firstname)){{ $token_customer->addresses[0]->firstname }} @endif</span></div>
                      <div><span>Lastname : </span><span id="shipping_lastname">@if(!empty($token_customer->addresses[0]->lastname)){{ $token_customer->addresses[0]->lastname }} @endif</span></div>
                      <div><span>Street : </span><span id="shipping_street1">@if(!empty($token_customer->addresses[0]->street[0])){{ $token_customer->addresses[0]->street[0] }} @endif</span></div>
                      <div><span>Street2 : </span><span id="shipping_street2">@if(!empty($token_customer->addresses[0]->street[1])){{ $token_customer->addresses[0]->street[1] }} @endif</span></div>
                      <div><span>Company : </span><span id="shipping_company">@if(!empty($token_customer->addresses[0]->company)) {{ $token_customer->addresses[0]->company }} @endif</span></div>
                      <div><span>Telephone : </span><span id="shipping_telephone">@if(!empty($token_customer->addresses[0]->telephone)) {{ $token_customer->addresses[0]->telephone }} @endif</span></div>
                      <div><span>City : </span><span id="shipping_city">@if(!empty($token_customer->addresses[0]->city)) {{ $token_customer->addresses[0]->city }} @endif</span></div>
                      <div><span>Postcode : </span><span id="shipping_postcode">@if(!empty($token_customer->addresses[0]->postcode)) {{ $token_customer->addresses[0]->postcode }} @endif</span></div>
                      <div><span>Country : </span><span id="shipping_country_id">@if(!empty($token_customer->addresses[0]->country_id)) {{ $token_customer->addresses[0]->country_id }} @endif</span></div>
                      <!-- <div><span>Email : </span><span id="shipping_email">@if(!empty($token_customer->addresses[0]->email)) {{ $token_customer->addresses[0]->email }} @endif</span></div> -->

                      <input type="hidden" name="id_value_shipping" id="id_value_shipping" value="@if(!empty($token_customer->addresses[0]->id)) {{ $token_customer->addresses[0]->id }} @endif" required>
                    </div>
                </div>
                <hr>
                <!-- <div class="row">
                  <div class="col-xl-12">
                      <div class="pay-font1"style="display:inline;">Shipping Method</div>
                      <div class="pay-font1 pay-m-l4 w-100" style="display:inline;">
                        <a href="#" class="pay-font5"><u>edit</u></a>
                      </div>
                  </div>
                </div>
                <div class="pt-3">
                    <div class="pay-font6">EMS</div>
                </div> -->
            </div>
          </div>

        <div class="col-xl-3  mt-5">
          <div class="card pay-b-n">
              <div class="row">
                      <input type="hidden" name="chk_false" id="chk_false">
                      <input type="hidden" name="chk_false_id" id="chk_false_id">
                      <input type="hidden" name="chk_price_id" id="chk_price_id">
                      <input type="hidden" name="chk_color_id" id="chk_color_id">
                      <input type="hidden" name="chk_op_color_id" id="chk_op_color_id">
                      <input type="hidden" name="chk_op_size_id" id="chk_op_size_id">
                  <div class="col-xl-12">
                      <div class="row mt-3 pay-padding">
                          <div class="col-xl-8 col-lg-6 col-md-6 col-12 text-center text-lg-left text-md-left pay-m-l-r">
                               <div class="pay-font1">ORDER SUMARY</div>
                          </div>
                          <div class="col-xl-4 col-lg-6  col-md-6 col-12 text-center text-lg-right text-md-right pay-m-l-r">
                               <div class="pay-font7" >@if($cart_customer ==  null) {{ 0 }} @else {{ count($cart_customer) }} @endif items</div>
                          </div>
                      </div>
                      @if(!empty($cart_customer))
                        @php
                          $sum_price = 0;
                          $op_color = '';
                          $color = '';
                          $op_size = '';
                          $size = '';
                        @endphp
                      @foreach($cart_customer as $key_cart => $value_cart)
                        @if(!empty($value_cart->product_option))
                          @if($value_cart->product_option->extension_attributes->configurable_item_options[0]->option_id == '135')
                            @php
                              $op_color = $value_cart->product_option->extension_attributes->configurable_item_options[0]->option_id;
                              $color = $value_cart->product_option->extension_attributes->configurable_item_options[0]->option_value;
                            @endphp
                          @endif
                          @if($value_cart->product_option->extension_attributes->configurable_item_options[0]->option_id == '93')
                            @php
                              $op_size = $value_cart->product_option->extension_attributes->configurable_item_options[0]->option_id;
                              $size = $value_cart->product_option->extension_attributes->configurable_item_options[0]->option_value;
                            @endphp
                          @endif
                        @else
                          @php
                            $op_color = '';
                            $color = '';
                            $op_size = '';
                            $size = '';
                          @endphp
                        @endif
                        <!-- data-qty="{{ $value_cart->qty }}" -->
                      <input type="checkbox" style="width: 50px; height: 20px; position: relative;" class="checkbox chk_product_list" data-color_product="{{ $color }}" data-color_op_product="{{ $op_color }}" data-size_product="{{ $size }}" data-price_op_product="{{$op_size}}" data-price_product="{{ $value_cart->price }}" name="c_cart_product_id[{{$key_cart}}]" id="{{ $value_cart->sku }}" price="{{ $value_cart->price }}" value="{{ $value_cart->item_id }}">
                      <!-- <input type="text" name="cart_product_id[{{$key_cart}}]" value="{{ $value_cart->item_id }}"> -->
                      <!-- <input type="text" name="chk_false[{{$key_cart}}]" class="chk_false{{$key_cart}}" value=""> -->
                      <div class="row pt-3 pay-padding">
                          @foreach($product_key[$key_cart]->result->customAttributes->item as $key_product_image => $value_image)
                            @if($value_image->attributeCode == 'image')
                              <div class="col-xl-6 col-lg-6 col-md-6 pay-m-l-r">
                                  <div class="overlay-img2">
                                    <img class="image-full" src="http://128.199.235.248/magento/pub/media/catalog/product\{{ $value_image->value }}">
                                  </div>
                              </div>
                            @endif
                          @endforeach

                          <div class="col-xl-6 col-lg-6 col-md-6 pay-m-l-r">
                            <div class="pay-font8 pay-m-t3">{{ $value_cart->name }}</div>
                          @foreach($product_key[$key_cart]->result->customAttributes->item as $key_product_image => $value_colors)
                            @foreach($color_product->result->item as $key_color => $value_color)
                              @if($value_colors->attributeCode == 'color')
                                @if($value_color->value == $value_colors->value)
                                  <div class="pay-font9 pay-m-t3 pay-m-t2">Color: {{ $value_color->label }}</div>
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                          @foreach($product_key[$key_cart]->result->customAttributes->item as $key_product_image => $value_sizes)
                            @foreach($size_products->result->item as $key_size => $value_size)
                              @if($value_sizes->attributeCode == 'size')
                                @if($value_size->value == $value_sizes->value)
                                  <div class="pay-font9 pay-m-t2">Size: [UK] {{ $value_size->label }}</div>
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                            <div class="pay-font9 pay-m-t2">Qty: {{ $value_cart->qty }}</div>
                            <div class="pay-font12 text-center text-lg-right text-md-right pay-m-t">{{ number_format($value_cart->price,2) }} THB</div>
                          </div>
                      </div>
                        @php
                          $sum_price += $value_cart->price;
                        @endphp
                        @endforeach
                      @endif
                      <!-- <div class="row pt-3 pay-m-t4 pay-padding">
                          <div class="col-xl-6 col-lg-6 col-md-6 pay-m-l-r">
                              <div class="overlay-img2">
                                <img class="image-full" src="assets/images/product/2/adidas/018.jpg">
                              </div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-6 pay-m-l-r">
                            <div class="pay-font8 pay-m-t3">Pureboost DPR Shoes</div>
                            <div class="pay-font9 pay-m-t3 pay-m-t2">Color: White-Blue</div>
                            <div class="pay-font9 pay-m-t2">Size: [UK] 7.5</div>
                            <div class="pay-font9 pay-m-t2">Qty: 2</div>
                            <div class="pay-font12 text-center text-lg-right text-md-right pay-m-t">1,850 THB</div>
                          </div>
                      </div> -->
                      <hr class="mt-5">
                      <div class="row pay-padding">
                          <div class="col-xl-6 col-lg-6 col-md-6 col-6 pay-m-l-r">
                              <div class="pay-font10">Subtotal</div>
                              <div class="pay-font10">Delivery</div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-6 col-6 pay-m-l-r">
                              <div class="pay-font10 text-right"><span class="subtotal2">0</span> THB</div>
                              <!-- @if(!empty($sum_price)){{ $sum_price }}@endif -->
                              <div class="pay-font10 text-right">0 THB</div>
                          </div>
                      </div>
                      <div class="row mt-3 bg-gray py-3 pay-m-r-l2">
                          <div class="col-xl-6 col-lg-6  col-md-6 col-6 pay-m-l-r pt-1">
                              <div class="pay-font10">Total</div>
                          </div>
                          <div class="col-xl-6 col-lg-6  col-md-6 col-6 pay-m-l-r text-right">
                              <!-- <div class="pay-font11" style="display:inline;">@if(!empty($sum_price)){{ $sum_price }}@endif</div> -->
                              <div class="pay-font11 total2" style="display:inline;">0</div>
                              <div class="pay-font10" style="display:inline;"> THB</div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="row mt-4">
                <div class="col-xl-6 col-lg-4 col-md-4"></div>
                <div class="col-xl-6 col-lg-4 col-md-4 pl-3 pr-3">
                    <div class="checkout">
                      <!-- <a href="{{ url('payment_order') }}"> -->
                        <button type="button" class="btn checkout-btn" id="btn_submit_payment">
                      <!-- <a href="{{ url('payment/paypal') }}"><button class="btn checkout-btn"> -->
                          <span class="pull-left">Order</span>
                          <span class="pull-right">></span>
                      </button>
                    <!-- </a> -->
                    </div>
                </div>
                <!-- <div class="col-xl-12 mt-2">
                    <hr>
                      <a href="#">
                          <div class="promotion-button">
                             <span class="pull-left">Return Policy</span>
                          </div>
                      </a>
                    <hr class="mt-0">
                      <a href="#">
                          <div class="promotion-button">
                             <span class="pull-left">Payment</span>
                          </div>
                      </a>
                    <hr class="mt-0">
                </div> -->
            </div>
            </form>
          </div>
        </div>


        <section class="structure py-5">
        </section>

    </div>
  </div>


</div>

@endsection

@section('model')
<div class="modal fade" id="billing" tabindex="-1" role="dialog" aria-labelledby="billingLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="billingLabel">Billing Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach($token_customer->addresses as $key_address => $value_address)
          <div class="col-12 px-0 my-3">
            <div class="card account-card">
              <div class="card-body account-line-height text-md-left text-center">
                <div class="radio">
                  <label>
                    <input type="radio" name="value_billing" class="value_billing" id="optionsRadios2" value="{{ $value_address->id }}"> Select
                  </label>
                </div>
                  <div><span>Firstname : {{ $value_address->firstname }}</span></div>
                  <div><span>Lastname : {{ $value_address->lastname }}</span></div>
                  <div><span>Street : {{ $value_address->street[0] }}</span></div>
                  <div><span>Street2 : @if(!empty($value_address->street[1])){{ $value_address->street[1] }} @endif</span></div>
                  <div><span>Company : @if(!empty($value_address->company)) {{ $value_address->company }} @endif</span></div>
                  <div><span>Telephone : @if(!empty($value_address->telephone)) {{ $value_address->telephone }} @endif</span></div>
                  <div><span>Country : @if(!empty($value_address->country_id)) {{ $value_address->country_id }} @endif</span></div>
                  <div><span>City : @if(!empty($value_address->city)) {{ $value_address->city }} @endif</span></div>
                  <div><span>Region : @if(!empty($value_address->region->region)) {{ $value_address->region->region }} @endif</span></div>
                  <div><span>Postcode : @if(!empty($value_address->postcode)) {{ $value_address->postcode }} @endif</span></div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn_submit_billing">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="shipping" tabindex="-1" role="dialog" aria-labelledby="shippingLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="shippingLabel">Shipping Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach($token_customer->addresses as $key_address => $value_address)
          <div class="col-12 px-0 my-3">
            <div class="card account-card">
              <div class="card-body account-line-height text-md-left text-center">
                <div class="radio">
                  <label>
                    <input type="radio" name="value_shipping" class="value_shipping" id="optionsRadios2" value="{{ $value_address->id }}"> Select
                  </label>
                </div>
                  <div><span>Firstname : {{ $value_address->firstname }}</span></div>
                  <div><span>Lastname : {{ $value_address->lastname }}</span></div>
                  <div><span>Street : {{ $value_address->street[0] }}</span></div>
                  <div><span>Street2 : @if(!empty($value_address->street[1])){{ $value_address->street[1] }} @endif</span></div>
                  <div><span>Company : @if(!empty($value_address->company)) {{ $value_address->company }} @endif</span></div>
                  <div><span>Telephone : @if(!empty($value_address->telephone)) {{ $value_address->telephone }} @endif</span></div>
                  <div><span>Country : @if(!empty($value_address->country_id)) {{ $value_address->country_id }} @endif</span></div>
                  <div><span>City : @if(!empty($value_address->city)) {{ $value_address->city }} @endif</span></div>
                  <div><span>Region : @if(!empty($value_address->region->region)) {{ $value_address->region->region }} @endif</span></div>
                  <div><span>Postcode : @if(!empty($value_address->postcode)) {{ $value_address->postcode }} @endif</span></div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn_submit_shipping">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js_bottom')
<script type="text/javascript">
// $('body').on('click','#btn-submit_form',function(){
//   var form = $('#form_register_customer').serializeArray();
//   var firstname = $('.firstname').val();
//   $('body').loader('show');
//     $.ajax({
//       method : "POST",
//       url : url_gb+"/create_customer",
//       dataType: "JSON",
//       data: form,
//     }).done(function(rec){
//       if(rec.status==1){
//         $('#form_register_customer')[0].reset();
//         $('body').loader('hide');
//         al_su(rec.content,'success');

//       }else{
//         $('body').loader('hide');
//         al_su(rec.content,'danger');
//       }
//     }).fail(function(){
//         $('body').loader('hide');
//         al_su('Error','danger');
//   });
// });

$('body').on('change','.chk_product_list',function(){
  var price_product = $(this).data('price_product');
  var subtotal = parseInt($('.subtotal2').html());
  if(this.checked) {
    $('.subtotal2').html(subtotal+price_product);
    $('.total2').html(subtotal+price_product);
  } else {
    $('.subtotal2').html(subtotal-price_product);
    $('.total2').html(subtotal-price_product);
  }
});

$('body').on('click','#btn_submit_billing',function(){
  var id_address = $(this).data('data_billing');
  var atLeastOneIsChecked = $('.value_billing:radio:checked').length > 0;
  if(atLeastOneIsChecked == true){
    $.ajax({
      method : "POST",
      url : url_gb+"/get_billing/"+id_address,
      dataType: "JSON",
    }).done(function(rec){
      $('#bill_firstname').html(rec.login.firstname);
      $('#bill_lastname').html(rec.login.lastname);
      $('#bill_street1').html(rec.login.street[0]);
      $('#bill_street2').html(rec.login.street[1]);
      $('#bill_company').html(rec.login.company);
      $('#bill_telephone').html(rec.login.telephone);
      $('#bill_city').html(rec.login.city);
      $('#bill_postcode').html(rec.login.postcode);
      $('#bill_country_id').html(rec.login.country_id);
      $('#bill_email').html(rec.login.email);
      $('#billing').modal('hide');
    }).fail(function(){
      $('body').loader('hide');
      al_su('Error','danger');
    });
  } else {
    return;
  }
});

$('body').on('click','#btn_submit_shipping',function(){
  var id_address = $(this).data('data_shipping');
  var atLeastOneIsChecked = $('.value_shipping:radio:checked').length > 0;
  if(atLeastOneIsChecked == true){
    $.ajax({
      method : "POST",
      url : url_gb+"/get_billing/"+id_address,
      dataType: "JSON",
    }).done(function(rec){
      $('#shipping_firstname').html(rec.login.firstname);
      $('#shipping_lastname').html(rec.login.lastname);
      $('#shipping_street1').html(rec.login.street[0]);
      $('#shipping_street2').html(rec.login.street[1]);
      $('#shipping_company').html(rec.login.company);
      $('#shipping_telephone').html(rec.login.telephone);
      $('#shipping_city').html(rec.login.city);
      $('#shipping_postcode').html(rec.login.postcode);
      $('#shipping_country_id').html(rec.login.country_id);
      $('#shipping_email').html(rec.login.email);
      $('#shipping').modal('hide');
    }).fail(function(){
      $('body').loader('hide');
      al_su('Error','danger');
    });
  } else {
    return;
  }
});

$('body').on('change','.value_billing',function(){
    var data_billing = $(this).val();
    $('#id_value_billing').val('');
    if($(this).is(":checked") == true){
        $('#id_value_billing').val(data_billing);
        $('#btn_submit_billing').attr('data-data_billing',data_billing);
    }
});
$('body').on('change','.value_shipping',function(){
    var data_shipping = $(this).val();
    $('#id_value_shipping').val('');
    if($(this).is(":checked") == true){
        $('#id_value_shipping').val(data_shipping);
        $('#btn_submit_shipping').attr('data-data_shipping',data_shipping);
    }
});

$('body').on('change','.payment_method',function(){
    var data = $(this).data('payment_method');
    $('.payment_method_value').val(data);
});

$('body').on('click','#btn_submit_payment',function(){
    var form = $('#form_total_cart_product').serializeArray();
    check_chk();
    $('body').loader('show');
    $.ajax({
      method : "POST",
      url : url_gb+"/payment/paypal",
      dataType: "JSON",
      data: form ,
    }).done(function(rec){
        if(rec.approval_url != null && rec.status == 1){
         window.location.href = rec.approval_url;
        } else if(rec.status == 2){
          $('body').loader('hide');
          al_su(rec.content,'danger');
          // window.location.href = url_gb;
        } else {
          $('body').loader('hide');
          al_su('Error','danger');
        }

    }).fail(function(e){
        $('body').loader('hide');
        al_su('Error','danger');
    });
});

$('body').on('click','[type=checkbox]',function(){
  var cb = $("[type=checkbox]");
  var chk_check = [];
  var chk_false_id = [];
  var chk_price_id = [];
  var chk_color_id = [];
  // var chk_qty_id = [];
  var chk_size_id = [];
  var chk_op_color_id = [];
  var chk_op_size_id = [];
  var price = $('.chk_product_list').data('price_product');
  var color = $('.chk_product_list').data('color_product');
  var size = $('.chk_product_list').data('size_product');
  // var qty = $('.chk_product_list').data('qty');
  var op_color = $('.chk_product_list').data('op_color_product');
  var op_size = $('.chk_product_list').data('op_size_product');
    $.each(cb,function(key,value){
        if(value.checked == false){
          chk_check.push(value.value);
          chk_false_id.push(value.id);
          chk_price_id.push(price);
          chk_color_id.push(color);
          // chk_qty_id.push(qty);
          chk_size_id.push(size);
          chk_op_color_id.push(op_color);
          chk_op_size_id.push(op_size);
        }
    });
      $('#chk_false').val(chk_check);
      $('#chk_false_id').val(chk_false_id);
      $('#chk_price_id').val(chk_price_id);
      $('#chk_color_id').val(chk_color_id);
      $('#chk_size_id').val(chk_size_id);
      $('#chk_op_color_id').val(chk_op_color_id);
      $('#chk_op_size_id').val(chk_op_size_id);
});

function check_chk(){
    var cb = $("[type=checkbox]");
    var chk_check = [];
    var chk_false_id = [];
    var chk_price_id = [];
    var chk_color_id = [];
    // var chk_qty_id = [];
    var chk_size_id = [];
    var chk_op_color_id = [];
    var chk_op_size_id = [];
    var price = $('.chk_product_list').data('price_product');
    var color = $('.chk_product_list').data('color_product');
    var size = $('.chk_product_list').data('size_product');
    // var qty = $('.chk_product_list').data('qty');
    var op_color = $('.chk_product_list').data('op_color_product');
    var op_size = $('.chk_product_list').data('op_size_product');
    $.each(cb,function(key,value){
        if(value.checked == false){
          chk_check.push(value.value);
          chk_false_id.push(value.id);
          chk_price_id.push(price);
          chk_color_id.push(color);
          // chk_qty_id.push(qty);
          chk_size_id.push(size);
          chk_op_color_id.push(op_color);
          chk_op_size_id.push(op_size);
        }
    });
    // return chk_check,chk_false_id,chk_price_id,chk_qty_id;
    return chk_check,chk_false_id,chk_price_id;
}


</script>
@endsection
