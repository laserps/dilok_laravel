@extends('welcome')
@section('body')
<!-- START CONTENT -->
      <div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->

      @php
        preg_match('/<img.+url=[\'"](?P<src>.+?)[\'"].*>/i', $sum_blocks->content, $image);
        $date=date_create($sum_blocks->creation_time);
      @endphp
        <!-- SITE CONTENT -->
          <div class="container">
            <div class="row my-md-5 my-4">
              <div class="col-12">
                <div class="text-center">
                  <span class="grey text-small">{{ date_format($date,"d/m/Y") }}</span>
                </div>
              </div>
              <div class="col-xl-6 col-lg-8 col-md-9 col-12 mx-auto my-3">
                <div class="sb-uppercase text-center">
                  <h3 class="sb-h3-respon">{{ $sum_blocks->title }}</h3>
                </div>
              </div>
              <div class="col-12 my-3 sb-font-respon">
                <div class="my-3">
                  @if(!empty($image['src']))
                    <img class="w-100" src="http://128.199.235.248/magento/pub/media/{{ $image['src'] }}"/>
                  @else
                    <img class="w-100" src="{{ url('assets/images/No_Image_Available.jpg') }}">
                  @endif
                </div>
                <div class="my-3">
                  {!! strip_tags($sum_blocks->content) !!}
                </div>
            </div>

            </div>
          </div>
        <!-- END SITE CONTENT -->


      </div>
    <!-- END CONTENT -->

@endsection

@section('js_bottom')

@endsection

