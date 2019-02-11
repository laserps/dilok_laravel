@extends('welcome')
@section('body')
<!-- START CONTENT -->
      <div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->


        <div class="container-fluid custom-container">
            <div class="row p-2">
               <div class="col-xl-12 mt-5">
                   <div class="cart-font2">MY ORDER</div>
                @foreach($order_customer_me->items as $key_order_customer_me => $value_order_customer_me)
                   <div class="row pt-3">
                       <div class="col-xl-4 col-lg-4 col-md-6 col-12 cart-p-l">
                           <div class="cart-m-t2">Order ID : {{ $value_order_customer_me->increment_id }}</div>
                       </div>
                       <div class="col-xl-12 col-lg-6 cart-bg">
                           <div class="row">
                               <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                   <div class="pay-font9">Firstname : @if(!empty($value_order_customer_me->billing_address->firstname)){{ $value_order_customer_me->billing_address->firstname }} @endif</div>
                                   <div class="pay-font9">Lastname : @if(!empty($value_order_customer_me->billing_address->lastname)){{ $value_order_customer_me->billing_address->lastname }} @endif</div>
                                   <div class="pay-font9">Email : @if(!empty($value_order_customer_me->billing_address->email)){{ $value_order_customer_me->billing_address->email }} @endif</div>
                                   <div class="pay-font9">Company : @if(!empty($value_order_customer_me->billing_address->company)){{ $value_order_customer_me->billing_address->company }} @endif</div>
                                   <div class="pay-font9">Postcode : @if(!empty($value_order_customer_me->billing_address->postcode)){{ $value_order_customer_me->billing_address->postcode }} @endif</div>
                               </div>
                               <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                   <div class="pay-font9">City : @if(!empty($value_order_customer_me->billing_address->city)){{ $value_order_customer_me->billing_address->city }} @endif</div>
                                   <div class="pay-font9">Region : @if(!empty($value_order_customer_me->billing_address->region)){{ $value_order_customer_me->billing_address->region }} @endif</div>
                                   <div class="pay-font9">Telephone : @if(!empty($value_order_customer_me->billing_address->telephone)){{ $value_order_customer_me->billing_address->telephone }} @endif</div>
                                   <div class="pay-font9">Address Line1 : @if(!empty($value_order_customer_me->billing_address->street[0])){{ $value_order_customer_me->billing_address->street[0] }} @endif</div>
                                   <div class="pay-font9">Address Line2 : @if(!empty($value_order_customer_me->billing_address->street[1])) {{ $value_order_customer_me->billing_address->street[1] }} @endif</div>
                               </div>
                               <div class="col-xl-2 col-lg-2 col-md-2 col-12 text-center cart-m-t3">
                                  <div class="pay-font9">Status : {{ $value_order_customer_me->status }}</div>
                               </div>
                               <div class="col-xl-2 col-lg-2 col-md-2 col-12 text-center cart-m-t3">
                                  <span class="pay-m-t cart-font3">{{ $value_order_customer_me->base_subtotal }} {{ $value_order_customer_me->base_currency_code }}</span>
                               </div>
                           </div>
                       </div>
                    </div>
                       @foreach($value_order_customer_me->items as $key_item => $value_product)
                        @php
                          $opts = array(
                              'ssl' => array('ciphers'=>'RC4-SHA', 'verify_peer'=>false, 'verify_peer_name'=>false)
                          );

                          $params = array (
                            'encoding' => 'UTF-8',
                            'verifypeer' => false,
                            'verifyhost' => false,
                            'soap_version' => SOAP_1_2,
                            'trace' => 1,
                            'exceptions' => 1,
                            'connection_timeout' => 180,
                            'stream_context' => stream_context_create($opts),
                            'cache_wsdl' => WSDL_CACHE_NONE
                          );
                          $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
                          $get_product_detail = [
                              'searchCriteria' => [
                                  'filterGroups' => [
                                      [
                                          'filters' => [
                                              [
                                                  'field' => 'entity_id',
                                                  'value' => $value_product->product_id,
                                                  'condition_type' => 'eq',
                                              ],
                                          ],
                                      ],
                                  ],
                              ],
                          ];
                          $get_product_detail['storeId'] = "1";
                          $get_product_detail['currencyCode'] = "THB";


                          $products_detail = $get_products->catalogProductRepositoryV1GetList($get_product_detail);
                        @endphp
                        <div class="row">
                          <div class="col-xl-4 col-lg-4 col-md-4 col-12 cart-p-l">
                            @if(!empty($products_detail->result->items->item))
                              @foreach($products_detail->result->items->item->customAttributes as $key_custom => $value_custom)
                                @php
                                  $image = '';
                                @endphp
                                @foreach($value_custom as $key => $value)
                                  @if($value->attributeCode == 'image' && !empty($value->value))
                                    @php
                                      $images = $value->value;
                                    @endphp
                                  @endif
                                @endforeach
                              @endforeach
                            @endif
                            <div class="col-xl-6 col-lg-6 col-md-8">
                              <div class="overlay-img" style="height:160px;">
                                @if(!empty($images))
                                  <img class="image-full" src="http://128.199.235.248/magento/pub/media/catalog/product\{{$images}}">
                                @else
                                  <img class="image-full" src="{{ url('assets/images/No_Image_Available.jpg') }}">
                                @endif
                              </div>
                           </div>
                          </div>
                           <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                              <div class="cart-m-t2">Name : @if(!empty($value_product->name)){{ $value_product->name }} @endif</div>
                              <div class="pay-font9">sku : @if(!empty($value_product->sku)){{ $value_product->sku }} @endif</div>
                              <div class="pay-font9 mt-2">Price : @if(!empty($value_product->price)){{ $value_product->price }} @endif</div>
                              <div class="pay-font9 mt-2">Item : @if(!empty($value_product->qty_ordered)){{ $value_product->qty_ordered }} @endif</div>
                              <div class="pay-font9 mt-2">Date : @if(!empty($value_product->created_at)){{ $value_product->created_at }} @endif</div>
                          </div>
                        </div>
                          <div class="clearfix"></div><br/>
                       @endforeach
                     <hr>
                  @endforeach
               </div>
            </div>

        </div>


      </div>
    <!-- END CONTENT -->

@endsection

@section('js_bottom')

@endsection

