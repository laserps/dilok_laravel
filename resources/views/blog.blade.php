@extends('welcome')
@section('body')
<!-- START CONTENT -->
      <div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->


        <!-- SITE CONTENT -->
          <div class="container">
            <div class="row my-md-5 my-4">
            @foreach($sum_blocks->items as $key_block => $value_block)
              @php
                preg_match('/<img.+url=[\'"](?P<src>.+?)[\'"].*>/i', $value_block->content, $image);
                $date=date_create($value_block->creation_time);
              @endphp
              <div class="col-md-6">
                <div class="card w-100 border-0">
                  <div class="blog-img-fix">
                    <a href="{{ url('single-blog') }}/{{ $value_block->id }}">
                      @if(!empty($image['src']))
                        <img class="blog-img-auto" src="http://128.199.235.248/magento/pub/media/{{ $image['src'] }}"/>
                      @else
                        <img class="blog-img-auto" src="{{ url('assets/images/No_Image_Available.jpg') }}">
                      @endif
                    </a>
                  </div>
                  <div class="card-body px-0">
                    <div class="blog-title  mb-2">
                      <span>{!! str_limit(strip_tags($value_block->content),200) !!}</span>
                    </div>
                    <div>
                      <span class="grey text-small">{{ date_format($date,"d/m/Y") }}</span>
                    </div>
                  </div>
                </div>
              </div>

            @endforeach

              <!-- <div class="col-md-6">
                <div class="card w-100 border-0">
                  <div class="blog-img-fix">
                    <a href="{{ url('single-blog') }}">
                      <img class="blog-img-auto" src="https://scontent.fbkk5-5.fna.fbcdn.net/v/t1.0-9/16939236_1004972542935763_1944494886694740495_n.jpg?_nc_cat=0&oh=f912c0654d66380fb7ac48705cec09f0&oe=5B9F6832">
                    </a>
                  </div>
                  <div class="card-body px-0">
                    <div class="blog-title  mb-2">
                      <span>Sports fashion retailer Dilok has opened a new store at Chula Soi7 Sports fashion retailer Dilok has opened a new store at Chula Soi7</span>
                    </div>
                    <div>
                      <span class="grey text-small">22/06/2018</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card w-100 border-0">
                  <div class="blog-img-fix">
                    <a href="{{ url('single-blog') }}">
                      <img class="blog-img-auto" src="assets/images/index/blog1.jpg">
                    </a>
                  </div>
                  <div class="card-body px-0">
                    <div class="blog-title  mb-2">
                      <span>Sports fashion retailer Dilok has opened a new store at Chula Soi7 Sports fashion retailer Dilok has opened a new store at Chula Soi7</span>
                    </div>
                    <div>
                      <span class="grey text-small">22/06/2018</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card w-100 border-0">
                  <div class="blog-img-fix">
                    <a href="{{ url('single-blog') }}">
                      <img class="blog-img-auto" src="https://scontent.fbkk5-5.fna.fbcdn.net/v/t1.0-9/16939236_1004972542935763_1944494886694740495_n.jpg?_nc_cat=0&oh=f912c0654d66380fb7ac48705cec09f0&oe=5B9F6832">
                    </a>
                  </div>
                  <div class="card-body px-0">
                    <div class="blog-title  mb-2">
                      <span>Sports fashion retailer Dilok has opened a new store at Chula Soi7 Sports fashion retailer Dilok has opened a new store at Chula Soi7</span>
                    </div>
                    <div>
                      <span class="grey text-small">22/06/2018</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card w-100 border-0">
                  <div class="blog-img-fix">
                    <a href="{{ url('single-blog') }}">
                      <img class="blog-img-auto" src="assets/images/index/blog1.jpg">
                    </a>
                  </div>
                  <div class="card-body px-0">
                    <div class="blog-title  mb-2">
                      <span>Sports fashion retailer Dilok has opened a new store at Chula Soi7 Sports fashion retailer Dilok has opened a new store at Chula Soi7</span>
                    </div>
                    <div>
                      <span class="grey text-small">22/06/2018</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card w-100 border-0">
                  <div class="blog-img-fix">
                    <a href="{{ url('single-blog') }}">
                      <img class="blog-img-auto" src="https://scontent.fbkk5-5.fna.fbcdn.net/v/t1.0-9/16939236_1004972542935763_1944494886694740495_n.jpg?_nc_cat=0&oh=f912c0654d66380fb7ac48705cec09f0&oe=5B9F6832">
                    </a>
                  </div>
                  <div class="card-body px-0">
                    <div class="blog-title  mb-2">
                      <span>Sports fashion retailer Dilok has opened a new store at Chula Soi7 Sports fashion retailer Dilok has opened a new store at Chula Soi7</span>
                    </div>
                    <div>
                      <span class="grey text-small">22/06/2018</span>
                    </div>
                  </div>
                </div>
              </div> -->

            </div>
          </div>

        <!-- Start Pagination -->
        <div class="container-fluid custom-container mt-5">
          <ul class="pagination justify-content-center">
            @php
              $prev_page = $sum_blocks->search_criteria->current_page-1;
              $next_page = $sum_blocks->search_criteria->current_page+1;
              $main_page = $sum_blocks->search_criteria->current_page;
              $sum_products = $sum_blocks->total_count;
              $products = $sum_blocks->search_criteria->page_size;
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
            @if($prev_page)
              <li class="page-item pr-1"><a class="news_page-link" href="{{ url('blog') }}?page={{$prev_page}}">&laquo;</a></li>
            @endif
            @for($i = $main_page2; $i <= $sum_page; $i++)
                  <li class="page-item pr-1"><a @if($main_page == $i) style="background-color: #999;" @endif class="news_page-link page_main" href="{{ url('blog') }}?page={{$i}}">{{ $i }}</a></li>
            @endfor
            @if($sum_page != 1)
              @if($next_page)
                <li class="page-item pr-1"><a class="news_page-link" href="{{ url('blog') }}?page={{$next_page}}">&raquo; </a></li>
              @endif
            @endif
          </ul>
        </div>
        <!-- End Pagination -->

        <!-- END SITE CONTENT -->


      </div>
    <!-- END CONTENT -->

@endsection

@section('js_bottom')

@endsection

