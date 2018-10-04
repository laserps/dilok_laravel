@extends('welcome')
@section('body')
<!-- START CONTENT -->
      <div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->

<div class="wrapper">
   <div class="container pb-5 fadeIn animated">
    <div class="col-12 text-center mt-5">
        <div class="forgot-font1">FORGOT YOUR PASSWORD?</div>
    </div>
    <div class="col-12 text-center mt-4">
        <div class="regist-font3">Enter your email below and we'll send you a link to reset your password.</div>
    </div>

      <form class="forgot-m-t">
          <div class="form-row">
              <div class="col-12 text-center">
                  <label class="forgot-font2 forgot-m-l d-flex" for="validationDefaultUsername1">
                      Email Address
                      <span class="forgot-font3 ml-1">*</span>
                      <span class="forgot-font4 forgot-m-l2">* Required fields</span>
                  </label>
                  <div class="input-group-prepend"></div>
                  <input type="text" class="forgot-form" id="validationDefaultUsername1" placeholder="Email" aria-describedby="inputGroupPrepend1" required>
              </div>
          </div>
          <div class="form-row forgot-m-t2">
              <div class="col-12 text-center">
                    <button class="btn forgot-btn" type="submit">SUBMIT</button>
              </div>
          </div>
      </form>

</div>

@endsection

@section('js_bottom')
@endsection

