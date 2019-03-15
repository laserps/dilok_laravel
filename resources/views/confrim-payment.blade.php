@extends('welcome')

@section('body')
<div class="wrapper">


    @include('cart-sidebar')
    @include('nav-sidebar')

    <div class="container">

        <!-- <div>
            <img src="{{asset('assets/images/logo/logo.jpg')}}" class="w-100" alt="">
        </div> -->
        
    </div>

</div>
@endsection

@section('js_bottom')

@endsection