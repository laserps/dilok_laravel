@extends('welcome')
@section('body')
<!-- START CONTENT -->
      <div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->
<div class="container">
	  <div class="row">
	    <div class="col-lg-12 text-center mt-4">
	      <h2>OUR STORES</h2>
	    </div>
	    <div class="col-lg-12 text-center ">
	      <p>dilok storse simply dummy text of the printing and typesetting industry. Lorem </p>
	    </div>
	    <div class="col-lg-6 mb-4">
	      <div class="add_Branch-card">
	        <div class="add_Branch-fix-frame mt-4">
	          <a href="{{ url('add-sub-branch') }}"><img src='https://s3-ap-southeast-1.amazonaws.com/wpimage.shopspotapp.com/wp-content/uploads/2016/07/15072043/re_IMG_9319.jpg' class="add_Branch-img-top" /></a>
	        </div>
	        <div class="text-center mt-3">
	          <h3>NEWCASTLE</h3>
	        </div>
	        <div class="text-center mt-3">
	          <a href="{{ url('add-sub-branch') }}" class="btn add_Branch-btn-secondary">STORE INFORMATION</a>
	        </div>
	      </div>
	    </div>

	    <div class="col-lg-6 mb-4">
	      <div class="add_Branch-card">
	        <div class="add_Branch-fix-frame mt-4">
	          <a href="{{ url('add-sub-branch') }}"><img src='https://s3-ap-southeast-1.amazonaws.com/wpimages.mover.in.th/wp-content/uploads/2017/02/28040159/IMG_06391-1024x682.jpg' class="add_Branch-img-top" /></a>
	        </div>
	        <div class="text-center mt-3">
	          <h3>GLASGOW</h3>
	        </div>
	        <div class="text-center mt-3">
	          <a href="{{ url('add-sub-branch') }}" class="btn add_Branch-btn-secondary">STORE INFORMATION</a>
	        </div>
	      </div>
	    </div>
	  </div>
</div>
</div>
@endsection

@section('js_bottom')

@endsection

