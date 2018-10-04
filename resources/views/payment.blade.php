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
                     <img src="/dilok/assets/images/payment/visa.jpg" class="pay-size2" style="display:inline;">
                     <img src="/dilok/assets/images/payment/mc.png" class="pay-size3" style="display:inline;">
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
                        <img src="/dilok/assets/images/payment/bb.png" class="pay-size " style="display:inline;">
                        <img src="/dilok/assets/images/payment/scb.jpg" class="pay-size" style="display:inline;">
                        <img src="/dilok/assets/images/payment/kbank.png" class="pay-size" style="display:inline;">
                        <img src="/dilok/assets/images/payment/ktb.jpg" class="pay-size" style="display:inline;">
                        <img src="/dilok/assets/images/payment/tmb.png" class="pay-size2" style="display:inline;">
                      </div>
                   </label>
                 <label class="pay-select">
                     <div class="pay-font4" style="display:inline;">Paypal</div>
                       <img src="/dilok/assets/images/payment/pp.png" class="pay-size2" style="display:inline;">
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
                          <a href="#" class="pay-font5"><u>edit</u></a>
                        </div>
                    </div>
                </div>
                <div class="pt-3">
                    <div class="pay-font6">Chattapon Uthum<br>
                      19/63 Samsen 13<br>
                      Vachiraphayaban, Dusit<br>
                      Bankkok, Thailand 10300
                    </div>
                    <div class="pt-2 pay-font6">Tel: 084-003-3467</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="pay-font1"style="display:inline;">Shipping Address</div>
                        <div class="pay-font1 pay-m-l3 w-100" style="display:inline;">
                          <a href="#" class="pay-font5"><u>edit</u></a>
                        </div>
                    </div>
                </div>
                <div class="pt-3">
                    <div class="pay-font6">Chattapon Uthum<br>
                      19/63 Samsen 13<br>
                      Vachiraphayaban, Dusit<br>
                      Bankkok, Thailand 10300
                    </div>
                    <div class="pt-2 pay-font6">Tel: 084-003-3467</div>
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
                               <div class="pay-font7" >4 items</div>
                          </div>
                      </div>
                      <div class="row pt-3 pay-padding">
                          <div class="col-xl-6 col-lg-6 col-md-6 pay-m-l-r">
                              <div class="overlay-img2">
                                <img class="image-full" src="assets/images/product/2/adidas/014.jpg">
                              </div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-6 pay-m-l-r">
                            <div class="pay-font8 pay-m-t3">Pureboost DPR Shoes</div>
                            <div class="pay-font9 pay-m-t3 pay-m-t2">Color: White-Blue</div>
                            <div class="pay-font9 pay-m-t2">Size: [UK] 7.5</div>
                            <div class="pay-font9 pay-m-t2">Qty: 2</div>
                            <div class="pay-font12 text-center text-lg-right text-md-right pay-m-t">1,850 THB</div>
                          </div>
                      </div>
                      <div class="row pt-3 pay-m-t4 pay-padding">
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
                      </div>
                      <hr class="mt-5">
                      <div class="row pay-padding">
                          <div class="col-xl-6 col-lg-6 col-md-6 col-6 pay-m-l-r">
                              <div class="pay-font10">Subtotal</div>
                              <div class="pay-font10">Delivery</div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-6 col-6 pay-m-l-r">
                              <div class="pay-font10 text-right">3,700 THB</div>
                              <div class="pay-font10 text-right">0 THB</div>
                          </div>
                      </div>
                      <div class="row mt-3 bg-gray py-3 pay-m-r-l2">
                          <div class="col-xl-6 col-lg-6  col-md-6 col-6 pay-m-l-r pt-1">
                              <div class="pay-font10">Total</div>
                          </div>
                          <div class="col-xl-6 col-lg-6  col-md-6 col-6 pay-m-l-r text-right">
                              <div class="pay-font11" style="display:inline;">3,700</div>
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
                      <button class="btn checkout-btn">
                          <span class="pull-left">Order</span>
                          <span class="pull-right">></span>
                      </button>
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
        @include('latest-product')
        </section>

    </div>
  </div>


</div>

@endsection

@section('js_bottom')

@endsection

