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
              <form class="pt-3">
                 <label class="pay-select">
                     <div class="pay-font4" style="display:inline;">Credit/Debit</div>
                     <img src="{{ asset('assets/images/payment/visa.jpg') }}" class="pay-size2" style="display:inline;">
                     <img src="{{ asset('assets/images/payment/mc.png') }}" class="pay-size3" style="display:inline;">
                     <input type="radio" name="radio">
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
                      <input type="radio" name="radio">
                      <span class="checkmark2"></span>
                      <div class="flex-sm-row d-lg-inline d-md-inline d-xl-inline">
                        <img src="{{ asset('assets/images/payment/bb.png') }}" class="pay-size " style="display:inline;">
                        <img src="{{ asset('assets/images/payment/scb.jpg') }}" class="pay-size" style="display:inline;">
                        <img src="{{ asset('assets/images/payment/kbank.png') }}" class="pay-size" style="display:inline;">
                        <img src="{{ asset('assets/images/payment/ktb.jpg') }}" class="pay-size" style="display:inline;">
                        <img src="{{ asset('assets/images/payment/mc.png') }}" class="pay-size2" style="display:inline;">
                      </div>
                   </label>
                 <label class="pay-select">
                     <div class="pay-font4" style="display:inline;">Paypal</div>
                       <img src="{{ asset('assets/images/payment/pp.png') }}" class="pay-size2" style="display:inline;">
                     <input type="radio" name="radio">
                     <span class="checkmark2"></span>
                 </label>
            </div>
          </div>
          <div class="col-xl-3  mt-5">
            <div class="card pay-b-n p-3">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="pay-font1"style="display:inline;">Billing Address</div>
                        <div class="pay-font1 pay-m-l2 w-100" style="display:inline;">
                          <a href="#" class="pay-font5" data-toggle="modal" data-target="#billing"><u>edit</u></a>
                        </div>
                    </div>
                </div>
                <div class="pt-3">
                    <div class="pay-font6">{{ $token_customer->firstname }} {{ $token_customer->lastname }}<br>
                      {{ $token_customer->addresses[0]->street[0] }}<br>
                      {{ $token_customer->addresses[0]->street[1] }}, {{ $token_customer->addresses[0]->city }}<br>
                      {{ $token_customer->addresses[0]->region->region }}, {{ $token_customer->addresses[0]->country_id }} {{ $token_customer->addresses[0]->postcode }}
                    </div>
                    <div class="pt-2 pay-font6">Tel: {{ $token_customer->addresses[0]->telephone }}</div>
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
                    <div class="pay-font6">{{ $token_customer->firstname }} {{ $token_customer->lastname }}<br>
                      {{ $token_customer->addresses[0]->street[0] }}<br>
                      {{ $token_customer->addresses[0]->street[1] }}, {{ $token_customer->addresses[0]->city }}<br>
                      {{ $token_customer->addresses[0]->region->region }}, {{ $token_customer->addresses[0]->country_id }} {{ $token_customer->addresses[0]->postcode }}
                    </div>
                    <div class="pt-2 pay-font6">Tel: {{ $token_customer->addresses[0]->telephone }}</div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-xl-12">
                      <div class="pay-font1"style="display:inline;">Shipping Method</div>
                      <div class="pay-font1 pay-m-l4 w-100" style="display:inline;">
                        <a href="#" class="pay-font5"><u>edit</u></a>
                      </div>
                  </div>
                </div>
                <div class="pt-3">
                    <div class="pay-font6">EMS</div>
                </div>
            </div>
          </div>

          <div class="col-xl-3  mt-5">
            <div class="card pay-b-n">
              <div class="row">
                  <div class="col-xl-12">
                      <div class="row mt-3 pay-padding">
                          <div class="col-xl-8 col-lg-6 col-md-6 col-12 text-center text-lg-left text-md-left pay-m-l-r">
                               <div class="pay-font1">ORDER SUMARY</div>
                          </div>
                          <div class="col-xl-4 col-lg-6  col-md-6 col-12 text-center text-lg-right text-md-right pay-m-l-r">
                               <div class="pay-font7" >{{ count($cart_customer) }} items</div>
                          </div>
                      </div>
                      @if(!empty($cart_customer))
                        @php
                          $sum_price = 0;
                        @endphp

                      @foreach($cart_customer as $key_cart => $value_cart)
                      <div class="row pt-3 pay-padding">
                          @foreach($product_key[$key_cart]->result->customAttributes->item as $key_product_image => $value_image)
                            @if($value_image->attributeCode == 'image')
                              <div class="col-xl-6 col-lg-6 col-md-6 pay-m-l-r">
                                  <div class="overlay-img2">
                                    <img class="image-full" src="http://192.168.1.27/dilok2/pub/media/catalog/product\{{ $value_image->value }}">
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
                              <div class="pay-font10 text-right">@if(!empty($sum_price)){{ $sum_price }}@endif THB</div>
                              <div class="pay-font10 text-right">100 THB</div>
                          </div>
                      </div>
                      <div class="row mt-3 bg-gray py-3 pay-m-r-l2">
                          <div class="col-xl-6 col-lg-6  col-md-6 col-6 pay-m-l-r pt-1">
                              <div class="pay-font10">Total</div>
                          </div>
                          <div class="col-xl-6 col-lg-6  col-md-6 col-6 pay-m-l-r text-right">
                              <div class="pay-font11" style="display:inline;">@if(!empty($sum_price)){{ $sum_price+100 }}@endif</div>
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
                      <a href="{{ url('payment_order') }}"><button class="btn checkout-btn">
                          <span class="pull-left">Order</span>
                          <span class="pull-right">></span>
                      </button></a>
                    </div>
                </div>
                <div class="col-xl-12 mt-2">
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
                </div>
            </div>
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
        ...aa
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
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
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
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
</script>
@endsection
