@extends('welcome')
@section('body')
<!-- START CONTENT -->
      <div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->


        <div class="container-fluid custom-container">


         <div class="container-fluid custom-container">
        <div class="row mt-3">
          <div class="col-lg-6 col-md-6 col-12 text-lg-left text-md-left text-center">
                 <p style="padding-top: 14px;">LAUNCHES</p>
              </div>
        </div>
      </div>

      <div class="container-fluid custom-container mt-2">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card_new">
              <div class="launches-fix-frame">
                <span class='zoom' id='zoom1'>
                <img src='assets/images/product/2/adidas/1.jpg' class="launches-img " width='100%' height='auto' alt='Baby Wallper'/>
              </span>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-3 col-lg-3 col-md-4  launches_border text-md-center">
                  <p class="launches_font_30">January</p>
                  <p class="launches_font_31">7</p>
                  <p class="launches_font_32">2018</p>
                    </div>
                  <div class="col-9 col-lg-9 col-md-8  lau_pad_10">
                    <a href="{{ url('launches-detail') }}"><p class="launches_font_30 line-h-20">Adidas EQT Support ADV PK'</p></a>
                    <p class="font_14 line-h-20 fix_20">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in</p>
                    </div>
                    <div class="col-lg-12 text-right px-0">
                  <a href="{{ url('launches-detail') }}" class="btn fast-buy p-2 ">
                                    <label class="mb-0 d-flex px-2 white">
                                        <span>Read More</span>
                                        <i class="icon-collpase fas fa-angle-right ml-2 pt-1" aria-hidden="true"></i>
                                    </label>
                                  </a>
                          </div>
                  </div>
              </div>
          </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card_new">
              <div class="launches-fix-frame">
              <span class='zoom' id='zoom2'>
                <img src='assets/images/product/2/adidas/2.jpg' class="launches-img" width='100%' height='auto' alt='Baby Wallper'/>
              </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3 col-lg-3 col-md-4 launches_border text-md-center">
                  <p class="launches_font_30">December</p>
                  <p class="launches_font_31">28</p>
                  <p class="launches_font_32">2018</p>
                    </div>
                  <div class="col-9 col-lg-9 col-md-8 lau_pad_10">
                    <a href="{{ url('launches-detail') }}"><p class="launches_font_30 line-h-20">Adidas EQT Support ADV PK'</p></a>
                    <p class="font_14 line-h-20 fix_20">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in</p>
                    </div>
                    <div class="col-lg-12 text-right px-0">
                  <a href="{{ url('launches-detail') }}" class="btn fast-buy p-2 ">
                                    <label class="mb-0 d-flex px-2 white">
                                        <span>Read More</span>
                                        <i class="icon-collpase fas fa-angle-right ml-2 pt-1" aria-hidden="true"></i>
                                    </label>
                                  </a>
                          </div>
                  </div>
              </div>
          </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card_new">
              <div class="launches-fix-frame">
                <span class='zoom' id='zoom3'>
                <img src='assets/images/product/2/adidas/3.jpg' class="launches-img" width='100%' height='auto' alt='Baby Wallper'/>
              </span>
              </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3 col-lg-3 col-md-4 launches_border text-md-center">
                  <p class="launches_font_30">March</p>
                  <p class="launches_font_31">31</p>
                  <p class="launches_font_32">2018</p>
                    </div>
                  <div class="col-9 col-lg-9 col-md-8 lau_pad_10">
                    <a href="{{ url('launches-detail') }}"><p class="launches_font_30 line-h-20">Adidas EQT Support ADV PK'</p></a>
                    <p class="font_14 line-h-20 fix_20">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in</p>
                    </div>
                    <div class="col-lg-12 text-right px-0">
                  <a href="{{ url('launches-detail') }}" class="btn fast-buy p-2 ">
                                    <label class="mb-0 d-flex px-2 white">
                                        <span>Read More</span>
                                        <i class="icon-collpase fas fa-angle-right ml-2 pt-1" aria-hidden="true"></i>
                                    </label>
                                  </a>
                          </div>
                  </div>
              </div>
          </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12 mt-lg-4">
            <div class="card_new">
              <div class="launches-fix-frame">
                <span class='zoom' id='zoom4'>
                <img src='assets/images/product/2/adidas/4.jpg' class="launches-img" width='100%' height='auto' alt='Baby Wallper'/>
              </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3 col-lg-3 col-md-4 launches_border text-md-center">
                  <p class="launches_font_30">September</p>
                  <p class="launches_font_31">31</p>
                  <p class="launches_font_32">2018</p>
                    </div>
                  <div class="col-9 col-lg-9 col-md-8 lau_pad_10">
                    <a href="{{ url('launches-detail') }}"><p class="launches_font_30 line-h-20">Adidas EQT Support ADV PK'</p></a>
                    <p class="font_14 line-h-20 fix_20">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in</p>
                    </div>
                    <div class="col-lg-12 text-right px-0">
                  <a href="{{ url('launches-detail') }}" class="btn fast-buy p-2 ">
                                    <label class="mb-0 d-flex px-2 white">
                                        <span>Read More</span>
                                        <i class="icon-collpase fas fa-angle-right ml-2 pt-1" aria-hidden="true"></i>
                                    </label>
                                  </a>
                          </div>
                  </div>
              </div>
          </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12 mt-lg-4">
            <div class="card_new">
              <div class="launches-fix-frame">
                <span class='zoom' id='zoom5'>
                <img src='assets/images/product/2/adidas/29.jpg' class="launches-img" width='100%' height='auto' alt='Baby Wallper'/>
              </span>
              </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3 col-lg-3 col-md-4 launches_border text-md-center">
                  <p class="launches_font_30">July</p>
                  <p class="launches_font_31">31</p>
                  <p class="launches_font_32">2018</p>
                    </div>
                  <div class="col-9 col-lg-9 col-md-8 lau_pad_10">
                    <a href="{{ url('launches-detail') }}"><p class="launches_font_30 line-h-20">Adidas EQT Support ADV PK'</p></a>
                    <p class="font_14 line-h-20 fix_20">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in</p>
                    </div>
                    <div class="col-lg-12 text-right px-0">
                  <a href="{{ url('launches-detail') }}" class="btn fast-buy p-2 ">
                                    <label class="mb-0 d-flex px-2 white">
                                        <span>Read More</span>
                                        <i class="icon-collpase fas fa-angle-right ml-2 pt-1" aria-hidden="true"></i>
                                    </label>
                                  </a>
                          </div>
                  </div>
              </div>
          </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12 mt-lg-4">
            <div class="card_new">
              <div class="launches-fix-frame">
                <span class='zoom' id='zoom6'>
                <img src='assets/images/product/2/adidas/27.jpg' class="launches-img" width='100%' height='auto' alt='Baby Wallper'/>
              </span>
              </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3 col-lg-3 col-md-4 launches_border text-md-center">
                  <p class="launches_font_30">July</p>
                  <p class="launches_font_31">31</p>
                  <p class="launches_font_32">2018</p>
                    </div>
                  <div class="col-9 col-lg-9 col-md-8 lau_pad_10">
                    <a href="{{ url('launches-detail') }}"><p class="launches_font_30 line-h-20">Adidas EQT Support ADV PK'</p></a>
                    <p class="font_14 line-h-20 fix_20">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in</p>
                    </div>
                    <div class="col-12 text-right header-slide-btn" >
                                <a href="{{ url('launches-detail') }}" class="btn fast-buy p-2 ">
                                    <label class="mb-0 d-flex px-2 white">
                                        <span>Read More</span>
                                        <i class="icon-collpase fas fa-angle-right ml-2 pt-1" aria-hidden="true"></i>
                                    </label>
                                  </a>
                              </div>
                  </div>
              </div>
          </div>
          </div>
        </div>
      </div>

<!-- card end -->


    <div class="container-fluid custom-container mt-5">
          <ul class="pagination justify-content-center">
            <li class="page-item pr-1"><a class="news_page-link active" href="javascript:void(0);">1</a></li>
            <li class="page-item pr-1"><a class="news_page-link " href="javascript:void(0);">2</a></li>
            <li class="page-item pr-1"><a class="news_page-link" href="javascript:void(0);">3</a></li>
            <li class="page-item pr-1"><a class="news_page-link" href="javascript:void(0);">4</a></li>
          </ul>
        </div>


      </div>
    <!-- END CONTENT -->

@endsection

@section('js_bottom')
<script type="text/javascript">
  $(document).ready(function(){
   if(window.matchMedia("(max-width: 1024px)").matches){
      } else{
          $('#zoom1').zoom();
          $('#zoom2').zoom();
          $('#zoom3').zoom();
          $('#zoom4').zoom();
          $('#zoom5').zoom();
          $('#zoom6').zoom();
        }
});
</script>
@endsection

