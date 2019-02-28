@extends('welcome')
@section('body')
<div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->

	<div class="container">
          <div class="row my-lg-5 mt-md-3 my-2">
            <div class="col-12 mt-md-4 mt-3">
              <div class="sub-branch-fix-img">
                <img src="assets/images/branch/1.jpg" class="w-100 sub-img-auto">
              </div>
            </div>
            <div class="col-lg-6 col-12 mt-md-4 mt-3">
              <div class="text-center sub-branch-pb-30px">
                <h2>DILOK. MBK</h2>
              </div>

              <div class="text-center sub-branch-pb-30px">
                <div class="">
                  <div class="sub-branch-font-store">
                    <span>Store Information</span>
                  </div>
                </div>



                <div class="sub-branch-font-address">
                  <p class="mb-0">DILOK. MBK</p>
                  <p class="mb-0">MBK Center 444,</p>
                  <p class="mb-0">Phayathai Road,</p>
                  <p class="mb-0">Wangmai,Pathumwan,</p>
                  <p class="mb-0">Bangkok, 10330</p>
                </div>
                <div class="sub-branch-font-address mt-md-3 mt-2">
                  <p class="mb-0">T: +66 89-123-4567</p>
                  <a href="#" class="sub-branch-font-address">admin@dilok.com</a>
                </div>
              </div>


                <div class="">
                  <div class="text-center sub-branch-font-store">
                    <span>OPENING TIMES</span>
                  </div>

                  <table class="mx-auto sub-branch-table">
                    <tbody>
                      <tr>
                        <td class="text-left">Monday</td>
                        <td class="text-right">9am - 7pm</td>
                      </tr>
                      <tr>
                        <td class="text-left">Tuesday</td>
                        <td class="text-right">9am - 7pm</td>
                      </tr>
                      <tr>
                        <td class="text-left">Wednesday</td>
                        <td class="text-right">9am - 7pm</td>
                      </tr>
                      <tr>
                        <td class="text-left">Thursday</td>
                        <td class="text-right">9am - 8pm</td>
                      </tr>
                      <tr>
                        <td class="text-left">Friday</td>
                        <td class="text-right">9am - 7pm</td>
                      </tr>
                      <tr>
                        <td class="text-left">Saturday</td>
                        <td class="text-right">9am - 7pm</td>
                      </tr>
                      <tr>
                        <td class="text-left">Sunday</td>
                        <td class="text-right">10am - 5pm</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="col-lg-6 col-12 mt-md-4 mt-3">
                <div class="branch-map">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.5658431130705!2d100.52807421540678!3d13.744714990352032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29ed2ca6bf789%3A0x85cf71c48488fcd2!2z4LiU4Li04Lil4LiBIOC4hOC4reC4meC5gOC4i-C4m-C4leC5jCDguKrguYLguJXguKPguYw!5e0!3m2!1sth!2sth!4v1530687815590" width="100%" height="100%" class="sub-map-responsive" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
          </div>



          <div class="row mb-lg-5 mt-md-3 mb-2">
            <div class="col-12 px-2">
              <div class="my-2 sub-img-head-footer">
                <img src="assets/images/branch/head.jpg" class="sub-img-auto">
              </div>
            </div>
            <div class="col-md-6 px-2">
              <div class="my-2 sub-img-short"><img src="assets/images/branch/2.jpg" class="sub-img-auto"></div>
              <div class="my-2 sub-img-long"><img src="assets/images/branch/3.jpg" class="sub-img-auto"></div>
            </div>
            <div class="col-md-6 px-2">
              <div class="my-2 sub-img-long"><img src="assets/images/branch/5.jpg" class="sub-img-auto"></div>
              <div class="my-2 sub-img-short"><img src="assets/images/branch/6.jpg" class="sub-img-auto"></div>
            </div>
            <div class="col-12 px-2">
              <div class="my-2 sub-img-head-footer">
                <img src="assets/images/branch/4.jpg" class="sub-img-auto">
              </div>
            </div>
          </div>
        </div>

</div>
@endsection

@section('js_bottom')

@endsection

