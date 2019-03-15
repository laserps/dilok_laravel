@extends('welcome')

@section('body')
<div class="wrapper">


    @include('cart-sidebar')
    @include('nav-sidebar')

    <div class="container my-5">


        <div class="row">
            <div class="col-lg-3 order-lg-1 order-2">
                <div class="card rounded-0">
                    <div class="card-header black-bg px-2 rounded-0">
                        <div class="text-larger text-white text-center">
                            <b>MY ACCOUNT</b>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush mx-2 oh-account">
                        <li class="list-group-item px-0 py-1">
                            <a class="text-secondary" href="#">Account Summary</a>
                        </li>
                        <li class="list-group-item px-0 py-1">
                            <a class="text-secondary" href="#">Address Book</a>
                        </li>
                        <li class="list-group-item px-0 py-1">
                            <a class="text-secondary" href="#">Edit Login</a>
                        </li>
                        <li class="list-group-item px-0 py-1">
                            <a class="text-secondary active" href="#">Order History</a>
                        </li>
                        <li class="list-group-item px-0 py-1">
                            <a class="text-secondary" href="#">My Wish List</a>
                        </li>
                        <li class="list-group-item px-0 py-1">
                            <a class="text-secondary" href="#">My Credit Cards</a>
                        </li>
                        <li class="list-group-item px-0 py-1">
                            <a class="text-secondary" href="#">Sing-out</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 order-lg-2 order-1">
                <section class="mb-3">
                    <div class="cart-font2">ORDER HISTORY</div>
                    <span class="text-small text-secondary">Select an order to view detailed status.</span>
                </section>

                <section class="mb-5">
                    <div class="text-larger">
                        <b>MOST RECENT ORDERS</b>
                        <hr class="my-2">
                    </div>  
                    <div class="text-small text-secondary mb-3">
                        <span>Order per Page: 5</span>
                    </div>  
                    <div class="history-tableres">
                        <table class="table table-bordered ">
                            <thead class="black-bg">
                                <tr>
                                    <th class="text-center border-dark text-white py-2" width="20%">order</th>
                                    <th class="text-center border-dark text-white py-2" width="15%">Order Date</th>
                                    <th class="text-center border-dark text-white py-2" width="45%">Status</th>
                                    <th class="text-center border-dark text-white py-2" width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1 ; $i <= 4; $i++)
                                <tr>
                                    <td class="px-2 py-2 border-dark align-middle">
                                        <img src="{{asset('assets/images/product/2/adidas/'.$i.'.jpg')}}" class="w-100">
                                        <span class="text-small">ESS CHELSEA -593 (XS)</span>
                                    </td>
                                    <td class="px-2 py-2 border-dark align-middle">05/18/15</td>
                                    <td class="px-2 py-2 border-dark align-middle">Fully Shipped</td>
                                    <td class="px-2 py-2 border-dark align-middle">
                                        <a href="#" class="black">View Order</a>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>

                        </table>
                    </div>
                </section>
            </div>
        </div>

        
    </div>

</div>
@endsection

@section('js_bottom')

@endsection