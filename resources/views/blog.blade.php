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

            </div>
          </div>

        <!-- Start Pagination -->
            <div class="container-fluid custom-container mt-5">
              <ul class="pagination justify-content-center">
                <li class="page-item pr-1"><a class="news_page-link active" href="javascript:void(0);">1</a></li>
                <li class="page-item pr-1"><a class="news_page-link " href="javascript:void(0);">2</a></li>
                <li class="page-item pr-1"><a class="news_page-link" href="javascript:void(0);">3</a></li>
                <li class="page-item pr-1"><a class="news_page-link" href="javascript:void(0);">4</a></li>
              </ul>
            </div>
        <!-- End Pagination -->

        <!-- END SITE CONTENT -->


      </div>
    <!-- END CONTENT -->

@endsection

@section('js_bottom')

@endsection
    
