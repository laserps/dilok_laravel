@extends('welcome')

@section('body')
<div class="wrapper">


    @include('cart-sidebar')
    @include('nav-sidebar')

    <div class="container">
    <section class="my-5">
        <div class="row">
            <div class="col-xl-8 col-lg-7 mb-3">
                <div class="mb-3">
                    <h5>ตัวเลือกการชำระเงิน</h5>
                </div>
                <div class="card rounded-0 mb-5">
                    <div class="card-body">
                        <div class="pay-font1">Payment Method</div>
                        <label class="pay-select">
                            <div class="pay-font4 d-inline">Paypal</div>
                            <img src="{{ asset('assets/images/payment/pp.png') }}" class="pay-size2 d-inline">
                            <input type="radio" name="radio" class="payment_method" data-payment_method="paypal_express" checked>
                            <span class="checkmark2"></span>
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <h5>รายการสั่งซื้อ</h5>
                </div>    
                <div class="card rounded-0">
                    <div class="card-body">
                        <div class="oder-tresponsive">
                            <table>
                                <tbody>
                                    @for ($i = 1 ; $i < 4 ; $i++)
                                        <tr>
                                            <td class="py-3" width="12%">
                                                <a href="{{url('product-details1')}}">
                                                    <img src="{{asset('assets/images/product/2/adidas/'.$i.'.jpg')}}" class="w-100">
                                                </a>
                                            </td>
                                            <td class="px-2 py-3" width="50%">
                                                <div class="text-body order-list-text-respon">
                                                    <span>HARDEN VOL III -088 (M)</span>
                                                </div>
                                                <div class="pay-font9">
                                                    <span>Size: [UK] MQty: 1</span>
                                                </div>
                                            </td>
                                            <td class="px-2 py-3 order-list-text-respon" width="20%">
                                                1,500 THB
                                            </td>
                                            <td class="px-2 py-3 order-list-text-respon text-right" width="15%">
                                                จำนวน: 1
                                            </td>
                                            <td class="py-3 order-list-text-respon text-right" width="3%">
                                                <a href="#" class="text-danger">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-lg-5 mb-3">
                <div class="mb-3">
                    <h5>ที่อยู่ในการจัดส่ง/ใบกำกับภาษี</h5>
                </div>
                <div class="card rounded-0 mb-4">
                    <div class="card-body px-2">

                        <div class="oder-tresponsive">
                            <div class="address-respon">
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <div class="text-center text-small text-info">
                                            <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="text-small font-weight-bolder">
                                            <span>Napat M'ee Osaklang</span>
                                        </div>
                                        <div class="text-small text-muted">
                                            <span>334/16 ซ.วงศ์สว่าง11 เขตบางซื่อ กทม 1080010800, บางซื่อ/ Bang Sue, กรุงเทพมหานคร/ Bangkok 0652340110</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="text-small text-right">
                                            <a href="#" class="text-info">แก้ไข</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <div class="text-center text-small text-info">
                                            <i class="fa fa-building" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="text-small text-muted">
                                            <span>ที่อยู่ในการออกใบกำกับภาษีใช้ที่อยู่เดียวกับการจัดส่ง</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="text-small text-right">
                                            <a href="#" class="text-info">แก้ไข</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <div class="text-center text-small text-info">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="text-small text-muted">
                                            <span>0612345678</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="text-small text-right">
                                            <a href="#" class="text-info">แก้ไข</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <div class="text-center text-small text-info">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="text-small text-muted">
                                            <span>dilokstore_test@hotmail.com</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="text-small text-right">
                                            <a href="#" class="text-info">แก้ไข</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <h5>สรุปข้อมูลคำสั่งซื้อ</h5>
                </div>
                <div class="card rounded-0 mb-4">
                    <!-- สรุปข้อมูลคำสั่งซื้อ -->
                    <div class="card-body px-2">
                        <div class="d-inline-flex w-100 mb-2">
                            <div class="w-50 text-small text-muted">ยอดรวม (1 ชิ้น)</div>
                            <div class="w-50 text-right">฿142.00</div>
                        </div>
                        <div class="d-inline-flex w-100 mb-2">
                            <div class="w-50 text-small text-muted">ค่าจัดส่ง</div>
                            <div class="w-50 text-right">฿45.00</div>
                        </div>
                        <hr class="my-2">
                        <!-- ยอดรวมทั้งหมด-->
                        <div class="d-inline-flex w-100 mb-4">
                            <div class="w-50 text-small text-muted">ยอดรวมทั้งสิ้น</div>
                            <div class="w-50 text-right font-weight-bold">
                                <span>฿187.00</span>
                                <small class="d-block text-muted text-right">รวมภาษีมูลค่าเพิ่ม (ถ้ามี)</small>
                            </div>
                        </div>
                        
                        <div class="w-100">
                            <a href="#" type="button" class="btn fast-buy py-2 w-100">
                               Buy now
                            </a> 
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
        
    </div>

</div>
@endsection

@section('js_bottom')

@endsection