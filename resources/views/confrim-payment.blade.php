@extends('welcome')

@section('body')
<div class="wrapper">


    @include('cart-sidebar')
    @include('nav-sidebar')

    <div class="container text-center head-center ">
        <div class="col-md-10 col-12 mx-auto">
            <div class="thank-head">
                <p>THANK YOU!</p>
            </div>
            <div class="text-success thank-head">
                <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <div class="thank-content text-uppercase">
                <p>Thanks a bunch for filling that out. It means a lot to us, just like you do! We really appreciate you giving us a moment of your time today. Thanks for being you.</p>
            </div>
            <div>Registration closes in <span id="time">05</span> seconds!</div>
            <!-- <div>
                <img src="{{asset('assets/images/logo/logo.jpg')}}" class="w-100" alt="">
            </div> -->
        </div>
    </div>
</div>
@endsection

@section('js_bottom')
<script>
window.onload = function () {
    var fiveseconds = 5,
        display = document.getElementById('time');
        startTimer(fiveseconds, display);
};
function startTimer(duration, display) {
    var timer = duration, seconds;
    var sttime = setInterval(function () {
        seconds = parseInt(timer % 60, 10);
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent =  seconds;
        if (seconds == 0) {
            window.location.href = '{{url('')}}';
            clearInterval(sttime);
        }
        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

// window.location.href = 'https://stackoverflow.com/questions/1226714/how-to-get-the-browser-to-navigate-to-url-in-javascript';
</script>
 
@endsection