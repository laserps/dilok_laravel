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
        $userData = array("username" => "customer", "password" => "customer@01");
        $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token = json_decode(curl_exec($ch));

        $get_session_all = \Session::all();


        $aa = $request->all();
        $false_chk = explode(",",$request->chk_false);
        $chk_false_id = explode(",",$request->chk_false_id);

        $request->session()->put('product_id', $false_chk);
        $request->session()->put('sku_product', $chk_false_id);
        $session_all = session()->all();
        $value_product_ids = session()->get('product_id');
        $value_sku_products = session()->get('sku_product');

        $check = $request->c_cart_product_id;


        if(!empty($get_session_all['customer_id'])){

            foreach($value_product_ids as $key_product_id => $value_product_id){
                $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items/".$value_product_id);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "delete");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $delete_item_product = curl_exec($ch);

            }

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $result2 = json_decode(curl_exec($ch));

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/addresses/".$request->id_value_billing."");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $address_bill = json_decode(curl_exec($ch));

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/addresses/".$request->id_value_shipping."");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $address_shipping = json_decode(curl_exec($ch));

            // dd($address_shipping->region->region);
            // exit();


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
                      "customer_id" => $address_shipping->customer_id,
                      "region" => $address_shipping->region->region,
                      "country_id" => $address_shipping->country_id,
                      "street" => [
                        $address_shipping->street[0],$street_ship
                      ],
                      "company" => $company_shipping,
                      "telephone" => $address_shipping->telephone,
                      "postcode" => $address_shipping->postcode,
                      "city" => $address_shipping->city,
                      "firstname" => $address_shipping->firstname,
                      "lastname" => $address_shipping->lastname,
                      "region_code" => $address_shipping->region->region_code,
                      "sameAsBilling" => 1
                    ],
                    "billingAddress" => [
                      "customer_id" => $address_bill->customer_id,
                      "region" => $address_bill->region->region,
                      "country_id" => $address_bill->country_id,
                      "street" => [
                        $address_bill->street[0],$street_bill
                      ],
                      "company" => $company_bill,
                      "telephone" => $address_bill->telephone,
                      "postcode" => $address_bill->postcode,
                      "city" => $address_bill->city,
                      "firstname" => $address_bill->firstname,
                      "lastname" => $address_bill->lastname,
                      "region_code" => $address_bill->region->region_code
                    ],
                      "shipping_method_code" => "flatrate",
                      "shipping_carrier_code" => "flatrate"
                    ]
                ];

                // dd($data_shipping);
                // exit();

                $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/shipping-information");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_shipping));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $result_shipping = json_decode(curl_exec($ch));

                $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $cart_item = json_decode(curl_exec($ch));

                $sum = 0;


                // exit();

            if(!empty($address_shipping->street[1])){
                $street2 = $address_shipping->street[1];
            } else {
                $street2 = '';
            }

            // ### Address
            // Base Address object used as shipping or billing
            // address in a payment. [Optional]
            $shippingAddress = Paypalpayment::shippingAddress();
            $shippingAddress->setLine1($address_shipping->street[0])
                ->setLine2($street2)
                ->setCity($address_shipping->city)
                ->setState($address_shipping->country_id)
                ->setPostalCode($address_shipping->postcode)
                ->setCountryCode($address_shipping->country_id)
                ->setPhone($address_shipping->telephone)
                ->setRecipientName($address_shipping->firstname);

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
            $itemList->setItems($cart_item)
                ->setShippingAddress($shippingAddress);

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
            $status['status'] = 0;
        }

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create(Paypalpayment::apiContext());
        } catch (\PPConnectionException $ex) {
            return response()->json(["error" => $ex->getMessage()], 400);
        }

        // $respon = response()->json([$payment->toArray(), 'approval_url' => $payment->getApprovalLink()], 200);
        $status['approval_url'] = $payment->getApprovalLink();

        // dd($payment);
        // exit();

        return json_encode($status);
    }

    public function success(){
        $configpaypal = \Config::get('paypal_payment');

        $account = $configpaypal['account'];
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $account['client_id'],
                $account['client_secret']
            )
        );

        // Get payment object by passing paymentId
        $paymentId = $_GET['paymentId'];

        $payment = Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];
        $token_payment = $_GET['token'];

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
            $result = $payment->execute($execution, $apiContext);

            $create_order = [
              "email"=> "hamworkbythai@gmail.com",
              "paymentMethod"=> [
                "method"=> "paypal_express",
                "additional_data"=> [
                  "paypal_express_checkout_token" => $token_payment,
                  "paypal_express_checkout_redirect_required" => false,
                  "paypal_express_checkout_payer_id" => $payerId,
                ],
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

            $get_session_all = \Session::all();

            $userData = array("username" => "customer", "password" => "customer@01");
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = json_decode(curl_exec($ch));

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/payment-information");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($create_order));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));


            $result_order = json_decode(curl_exec($ch));

            $value_sku_products = session()->get('sku_product');

            $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);

            foreach($value_sku_products as $key_sku_product => $value_sku_product){
                $get_product_detail = array(
                    'sku' => $value_sku_product
                );
                $data_product = $get_products->catalogProductRepositoryV1Get($get_product_detail);

                $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $create_cart = json_decode(curl_exec($ch));

                $product = [
                    "cartItem" => [
                      "sku"=> $data_product->result->sku,
                      "qty"=> 1,
                      "name" => $data_product->result->sku,
                      "price" => 1,
                      "product_type" => "simple",
                      "quote_id"=> $create_cart,
                    ]
                  ];

                $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($product));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $post_items = json_decode(curl_exec($ch));
            }

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