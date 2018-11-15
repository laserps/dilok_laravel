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

        if(!empty($get_session_all[0])){
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/addresses/".$request->data_shipping."");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $address_shipping = json_decode(curl_exec($ch));

            ///////// Add Shipping ////////
                $data_shipping = [
                  "addressInformation" => [
                    "shippingAddress" => [
                      "customer_id" => 1,
                      "region" => "TH",
                      "country_id" => "TH",
                      "street" => [
                        "1518/4"
                      ],
                      "company" => "workbythai",
                      "telephone" => "021024291",
                      "postcode" => "10800",
                      "city" => "bangkok",
                      "firstname" => "banjong",
                      "lastname" => "limkluea",
                      "prefix" => "address_",
                      "region_code" => "TH",
                      "sameAsBilling" => 1
                    ],
                    "billingAddress" => [
                      "customer_id" => 1,
                      "region" => "TH",
                      "country_id" => "TH",
                      "street" => [
                        "1518/4"
                      ],
                      "company" => "workbythai",
                      "telephone" => "021024291",
                      "postcode" => "10800",
                      "city" => "bangkok",
                      "firstname" => "banjong",
                      "lastname" => "limkluea",
                      "prefix" => "address_",
                      "region_code" => "TH"
                    ],
                      "shipping_method_code" => "flatrate",
                      "shipping_carrier_code" => "flatrate"
                    ]
                ];

                // $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/shipping-information");
                // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_shipping));
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

                // $result_shipping = json_decode(curl_exec($ch));

                $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

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
                    ->setCurrency('USD')
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
            $amount->setCurrency("USD")
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
              "billingAddress"=> [
                "region"=> "TH",
                "region_id"=> 0,
                "region_code"=> "bangkok",
                "country_id"=> "TH",
                "street"=> [
                  "1518/4"
                ],
                "company"=> "workbythai",
                "telephone"=> "021024291",
                "postcode"=> "10800",
                "city"=> "bangkok",
                "firstname"=> "banjong",
                "lastname"=> "limkluea",
                "customer_id"=> 1,
                "email"=> "hamworkbythai@gmail.com",
                "same_as_billing"=> 1,
                "customer_address_id"=> 1,
                "save_in_address_book"=> 1,
                "extension_attributes"=> [],
              ],
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
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));


            $result_order = json_decode(curl_exec($ch));

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