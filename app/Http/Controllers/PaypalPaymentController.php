<?php
namespace App\Http\Controllers;

use Paypalpayment;
// use Request;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PaypalPaymentController extends Controller{

    public function paywithPaypal(Request $request)
    {
        $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
        $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token = json_decode(curl_exec($ch));

        $false_chk = explode(",",$request->chk_false);
        $chk_false_id = explode(",",$request->chk_false_id);
        $chk_price_id = explode(",",$request->chk_price_id);

        $request->session()->put('product_id', $false_chk);
        $request->session()->put('sku_product', $chk_false_id);
        $request->session()->put('price_product', $chk_price_id);
        $request->session()->put('token_admin', $token);

        $session_all = session()->all();
        $value_product_ids = session()->get('product_id');
        $value_sku_products = session()->get('sku_product');
        $price_products = session()->get('price_product');

        $check = $request->c_cart_product_id;

        $get_session_all = \Session::all();

        // if(count($value_sku_products) >= 2){
        //     dd(1);
        // } else {
        //     $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine");
        //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

        //     $create_cart2 = json_decode(curl_exec($ch));

        //     $product2 = [
        //         "cartItem" => [
        //             "sku"=> $value_sku_products[0],
        //             "qty"=> 1,
        //             "name" => $value_sku_products[0],
        //             "price" => $price_products[0],
        //             "product_type" => "simple",
        //             "quote_id"=> $create_cart2,
        //         ]
        //     ];

        //     $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
        //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($product2));
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

        //     $post_items = json_decode(curl_exec($ch));

        //     dd($product2,$post_items);
        // }

        // dd(count($value_sku_products),$value_sku_products,$product);
        // exit();

        $validator = \Validator::make($request->all(), [
            'id_value_billing' => 'required',
            'id_value_shipping' => 'required',
        ]);

        $errors = $validator->errors();

        if ($validator->fails()) {
            $status['status'] = 2;
            $status['content'] = 'กรุณาเลือกที่อยู่';
        } else {
            if(!empty($get_session_all['customer_id'])){

                foreach($value_product_ids as $key_product_id => $value_product_id){
                    $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items/".$value_product_id);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "delete");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                    $delete_item_product = curl_exec($ch);

                }

                    $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                    $result2 = json_decode(curl_exec($ch));

                    $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/addresses/".$request->id_value_billing."");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

                    $address_bill = json_decode(curl_exec($ch));

                    $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/addresses/".$request->id_value_shipping."");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

                    $address_shipping = json_decode(curl_exec($ch));

                    if(!empty($address_bill->street[1])){
                        $street_bill = $address_bill->street[1];
                    } else {
                        $street_bill = '';
                    }

                    if(!empty($address_shipping->street[1])){
                        $street_ship = $address_shipping->street[1];
                    } else {
                        $street_ship = '';
                    }

                    if(!empty($address_shipping->company)){
                        $company_shipping = $address_shipping->company;
                    } else {
                        $company_shipping = '';
                    }

                    if(!empty($address_bill->company)){
                        $company_bill = $address_bill->company;
                    } else {
                        $company_bill = '';
                    }

                ///////// Add Shipping ////////
                    $data_shipping = [
                      "addressInformation" => [
                        "shippingAddress" => [
                            "customer_id" => $address_shipping->customer_id, // 1
                            "region" => $address_shipping->region->region, // Thailand
                            "country_id" => $address_shipping->country_id, // TH
                            "street" => [
                                $address_shipping->street[0],$street_ship // 1518/4 , wongsawang
                            ],
                            "company" => $company_shipping, // workbythai
                            "telephone" => $address_shipping->telephone, // 021024291
                            "postcode" => $address_shipping->postcode, // 10800
                            "city" => $address_shipping->city, // bangsue
                            "firstname" => $address_shipping->firstname, // workbythai
                            "lastname" => $address_shipping->lastname, // workbythai
                            "region_code" => $address_shipping->region->region_code, // Thailand
                            "sameAsBilling" => 1
                        ],
                        "billingAddress" => [
                            "customer_id" => $address_bill->customer_id, // 1
                            "region" => $address_bill->region->region, // Thailand
                            "country_id" => $address_bill->country_id, // TH
                            "street" => [
                                $address_bill->street[0],$street_bill // 1518/4 , wongsawang
                            ],
                            "company" => $company_bill, // workbythai
                            "telephone" => $address_bill->telephone, // 021024291
                            "postcode" => $address_bill->postcode, // 10800
                            "city" => $address_bill->city, // bangsue
                            "firstname" => $address_bill->firstname, // workbythai
                            "lastname" => $address_bill->lastname, // workbythai
                            "region_code" => $address_bill->region->region_code // Thailand
                        ],
                            "shipping_method_code" => "flatrate",
                            "shipping_carrier_code" => "flatrate"
                        ]
                    ];

                    $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/shipping-information");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_shipping));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                    $result_shipping = json_decode(curl_exec($ch));

                    // dd($data_shipping,$result_shipping);
                    // exit();

                    $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                    $cart_item = json_decode(curl_exec($ch));

                    $sum = 0;

                if(!empty($address_shipping->street[1])){
                    $street2 = $address_shipping->street[1];
                } else {
                    $street2 = '';
                }

                // ### Address
                // Base Address object used as shipping or billing
                // address in a payment. [Optional]
                // $shippingAddress = Paypalpayment::shippingAddress();
                // $shippingAddress->setLine1($address_shipping->street[0])
                //     ->setLine2($street2)
                //     ->setCity($address_shipping->city)
                //     ->setState($address_shipping->country_id)
                //     ->setPostalCode($address_shipping->postcode)
                //     ->setCountryCode($address_shipping->country_id)
                //     ->setPhone($address_shipping->telephone)
                //     // ->setCountryCode("TH")
                //     // ->setPhone("6657000516")
                //     ->setRecipientName($address_shipping->firstname);

                // ### Payer
                // A resource representing a Payer that funds a payment
                // Use the List of `FundingInstrument` and the Payment Method
                // as 'credit_card'
                $payer = Paypalpayment::payer();
                $payer->setPaymentMethod("paypal");

                    foreach($cart_item as $key_item => $value_item){
                        $cart_item[$key_item] = Paypalpayment::item();
                        $cart_item[$key_item]->setName($value_item->sku)
                        ->setDescription($value_item->sku)
                        ->setCurrency('THB')
                        ->setQuantity($value_item->qty)
                        ->setTax(0)
                        ->setPrice($value_item->price);

                        $sum += $value_item->price;
                    }

                $itemList = Paypalpayment::itemList();
                $itemList->setItems($cart_item);
                    // ->setShippingAddress($shippingAddress);

                $details = Paypalpayment::details();
                $details->setShipping("0")
                        ->setTax("0")
                        //total of items prices
                        ->setSubtotal($sum);

                //Payment Amount
                $amount = Paypalpayment::amount();
                $amount->setCurrency("THB")
                        // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                        ->setTotal($sum)
                        ->setDetails($details);

                // ### Transaction
                // A transaction defines the contract of a
                // payment - what is the payment for and who
                // is fulfilling it. Transaction is created with
                // a `Payee` and `Amount` types

                $transaction = Paypalpayment::transaction();
                $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription("Payment description")
                    ->setInvoiceNumber(uniqid());

                // ### Payment
                // A Payment Resource; create one using
                // the above types and intent as 'sale'

                $redirectUrls = Paypalpayment::redirectUrls();
                $redirectUrls->setReturnUrl(url("/payments/success"))
                    ->setCancelUrl(url("/payments/fails"));

                $payment = Paypalpayment::payment();

                $payment->setIntent("sale")
                    ->setPayer($payer)
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions([$transaction]);


                // dd($payment);
                // exit();

                $status['status'] = 1;
            } else {
                session()->forget('customer_id');
                $status['status'] = 2;
            }


            try {
                // ### Create Payment
                // Create a payment by posting to the APIService
                // using a valid ApiContext
                // The return object contains the status;
                $payment->create(Paypalpayment::apiContext());
                $status['approval_url'] = $payment->getApprovalLink();
            } catch (\PPConnectionException $ex) {
                return response()->json(["error" => $ex->getMessage()], 400);
            }
        }

        // $respon = response()->json([$payment->toArray(), 'approval_url' => $payment->getApprovalLink()], 200);

        return json_encode($status);
    }

    public function success(){
        $configpaypal = \Config::get('paypal_payment');

        $account = $configpaypal['account'];
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $account['client_id'],  // AY9LOQarQhjvZPm16Z2iINOQIMe0Yqy45qdAqIO0adyb9AXHleU4HlnCCfnkYluy5Vr1QR9GAzq45NKz
                $account['client_secret'] // EF2usP-kyxFJJaO6QYF9iQ3gT2yJy70s1hAU3m6QyGQ5DzuNYiyeUUVWdAelwMSxDKn45P0PmTB-0CcK
            )
        );


        // Get payment object by passing paymentId
        $paymentId = $_GET['paymentId'];

        $payment = Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];
        $token_payment = $_GET['token'];
        $price_products = '';
        $price_main_cart = '';

        // Execute payment with payer ID
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

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
            "connection_timeout" => 180,
            'stream_context' => stream_context_create($opts),
            'cache_wsdl' => WSDL_CACHE_NONE
        );

        try {
        // Execute payment
            // $result = $payment->execute($execution, $apiContext);

            $create_order = [
              // "email"=> "hamworkbythai@gmail.com",
              "paymentMethod"=> [
                "method"=> "checkmo",
                // "method"=> "paypal_express",
                // "additional_data"=> [
                  // "paypal_express_checkout_token" => $token_payment, //EC-1J094180WA280981C
                  // "paypal_express_checkout_redirect_required" => false,
                  // "paypal_express_checkout_payer_id" => $payerId, //E229NB87LG5SQ
                  // "method_title"=> "PayPal Express Checkout",
                  // "paypal_payer_id" => $payerId,
                  // "paypal_correlation_id"=> "3d3bad7ea8f03"
                // ],
              ],
              // "billingAddress"=> [
              //   "region"=> "TH",
              //   "region_id"=> 0,
              //   "region_code"=> "bangkok",
              //   "country_id"=> "TH",
              //   "street"=> [
              //     "1518/4"
              //   ],
              //   "company"=> "workbythai",
              //   "telephone"=> "021024291",
              //   "postcode"=> "10800",
              //   "city"=> "bangkok",
              //   "firstname"=> "banjong",
              //   "lastname"=> "limkluea",
              //   "customer_id"=> 1,
              //   "email"=> "hamworkbythai@gmail.com",
              //   "same_as_billing"=> 1,
              //   "customer_address_id"=> 1,
              //   "save_in_address_book"=> 1,
              //   "extension_attributes"=> [],
              // ],
            ];

            $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = json_decode(curl_exec($ch));


            $get_session_all = \Session::all();
            $session_all = session()->all();
            $value_sku_products = session()->get('sku_product');
            $price_products = session()->get('price_product');
            // dd($get_session_all,$get_session_all['customer_id']);
            // exit();

            if(!empty($get_session_all['customer_id'])){

                $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/payment-information");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($create_order));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer ".$get_session_all['customer_id']));

                $result_order = json_decode(curl_exec($ch));

                $ch = curl_init("http://128.199.235.248/magento/rest/V1/orders"."/".$result_order);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer ". $token));

                $get_oder_status = json_decode(curl_exec($ch));

                $status = [
                    'entity' => [
                        'entity_id'=> $get_oder_status->entity_id,
                        'increment_id' => $get_oder_status->increment_id,
                        'status'=> 'processing',
                    ]
                ];

                $ch = curl_init("http://128.199.235.248/magento/rest/V1/orders");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($status));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer ".$token));

                $status_order = json_decode(curl_exec($ch));

                $get_product_detail = null;
                // $price_product_cart = 0;

                $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
                $get_products2 = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRenderListV1',$params);

                if(!empty($value_sku_products)){
                    // if(count($value_sku_products) >= 2){
                        foreach($value_sku_products as $key_sku_product => $value_sku_product){
                            if(!empty($value_sku_product)){
                                $get_product_detail = array(
                                    'sku' => $value_sku_product
                                );

                                $data_product = $get_products->catalogProductRepositoryV1Get($get_product_detail);

                                $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine");
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                                $create_cart = json_decode(curl_exec($ch));

                                $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                                $customer = json_decode(curl_exec($ch));

                                    // $get_product_detail2 = [
                                    //       'searchCriteria' => [
                                    //           'filterGroups' => [
                                    //               [
                                    //                   'filters' => [
                                    //                       [
                                    //                           'field' => 'entity_id',
                                    //                           'value' => $data_product->result->id,
                                    //                           'condition_type' => 'eq',
                                    //                       ],
                                    //                   ],
                                    //               ],
                                    //           ],
                                    //       ],
                                    //   ];
                                    // $get_product_detail2['storeId'] = "1";
                                    // $get_product_detail2['currencyCode'] = "THB";
                                    // $get_product_page = $get_products2->catalogProductRenderListV1GetList($get_product_detail2);

                                    // if(!empty($get_product_page->result->items->item->priceInfo->finalPrice)){
                                    //     $price_product_cart = $get_product_page->result->items->item->priceInfo->finalPrice;
                                    // }
                                    // if(!empty($data_product->result->price)){
                                    //     $price_product_cart = $data_product->result->price;
                                    // }

                                    // $price_main_cart = (int)$price_product_cart;

                                    $product = [
                                        "cartItem" => [
                                            "sku"=> $data_product->result->sku,
                                            "qty"=> 1,
                                            "name" => $data_product->result->sku,
                                            "price" => $price_products[$key_sku_product],
                                            "product_type" => "simple",
                                            "quote_id"=> $create_cart,
                                        ]
                                    ];

                                $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($product));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                                $post_items = json_decode(curl_exec($ch));

                                $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/".$customer->id."/carts");
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

                                $create_cart222 = json_decode(curl_exec($ch));

                                // dd($get_product_detail,$get_product_detail2,$price_product_cart,$price_products,$product,$price_main_cart,$post_items,$session_all);
                                session()->forget('sku_product');
                            }
                        }
                    // } else {
                            // $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine");
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                            // $create_cart = json_decode(curl_exec($ch));

                            // $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                            // $customer = json_decode(curl_exec($ch));

                            // $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/".$customer->id."/carts");
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

                            // $create_cart = json_decode(curl_exec($ch));

                            // $product = [
                            //     "cartItem" => [
                            //         "sku"=> $value_sku_products[0],
                            //         "qty"=> 1,
                            //         "name" => $value_sku_products[0],
                            //         "price" => $price_products[0],
                            //         "product_type" => "simple",
                            //         "quote_id"=> $create_cart,
                            //     ]
                            // ];
                            // $product = [
                            //     "cartItem" => [
                            //         "sku"=> 'HARDEN VOL III -088',
                            //         "qty"=> 1,
                            //         "name" => 'HARDEN VOL III -088',
                            //         "price" => 1500,
                            //         "product_type" => "configurable",
                            //         "quote_id"=> $create_cart,
                            //         "product_option" => [
                            //             "extension_attributes" => [
                            //                 "configurable_item_options" => [
                            //                     [
                            //                         "option_id" => "135",
                            //                         "option_value" => "83"
                            //                     ]
                            //                 ]
                            //             ]
                            //         ]
                            //     ]
                            // ];

                            // $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($product));
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                            // $post_items = json_decode(curl_exec($ch));

                            // $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/".$customer->id."/carts");
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

                            // $create_cart222 = json_decode(curl_exec($ch));

                            // // dd($create_cart,$product,$post_items);
                            // session()->forget('sku_product');

                    // }
                }

            } else {
                session()->forget('customer_id');
                return redirect('/');
            }

            session()->forget('sku_product');

            return redirect('/');

            // dd($result,$result_order,$payerId,$token_payment,$create_order);
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }

}