<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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

        try{

        $create_customers = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=customerAccountManagementV1',$params);

        $customer['customer'] = array(
            'email' => $request->input('email'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'website_id' => 1,
            'store_id' => 1,
            'group_id' => 1,
            "default_billing" => 1,
            // "dob" => "1",
            // "confirmation"=> "1",
            "default_shipping" => 1,
            // "middlename" => "ham",
            "gender"=> 0,
            // "taxvat"=> "0",
            // "prefix" => "1",
            // "suffix" => "1",
            "created_at" => "2018-09-24 06:48:56",
            "updated_at" => "2018-09-24 06:48:56",
            "created_in" => "Default Store View",
              "addresses" => [
                array(
                  // "id"=> 0,
                  "customer_id"=> 5,
                  "region"=> array(
                    "region_code"=> "string",
                    "region"=> "string",
                    "region_id"=> 0,
                    "extension_attributes"=> array(),
                  ),
                  "region_id"=> 0,
                  "country_id"=> "string",
                  "street"=> [
                    "string"
                  ],
                  "company"=> "string",
                  "telephone"=> "string",
                  "fax"=> "string",
                  "postcode"=> "string",
                  "city"=> "string",
                  "firstname"=> "string",
                  "lastname"=> "string",
                  "middlename"=> "string",
                  "prefix"=> "string",
                  "suffix"=> "string",
                  "vat_id"=> "string",
                  "default_shipping"=> true,
                  "default_billing"=> true,
                  "extension_attributes"=> array(),
                  "custom_attributes"=> [
                    array(
                      "attribute_code"=> "string",
                      "value"=> "string"
                    ),
                  ]
                )
              ],
            // 'addresses' =>
            //       [
            //         array(
            //         // "id" => 9,
            //         "customer_id" => 75,
            //         "region" => array(
            //           "region_code" => "TH",
            //           "region" => "Bankok",
            //           "region_id" => 0,
            //           "extension_attributes" => array(),
            //         ),
            //         "region" => "Bankok",
            //         "region_id" => 0,
            //         "country_id" => "TH",
            //         // "street" => array("street","PO Box 321"),
            //         "company" => "workbythai",
            //         "telephone" => "0857000516",
            //         // "fax" => "1",
            //         "postcode" => "10800",
            //         "city" => "Bankok",
            //         "firstname" => $request->input('firstname'),
            //         "lastname" => $request->input('lastname'),
            //         // "middlename" => "1",
            //         // "prefix" => "1",
            //         // "suffix" => "1",
            //         // "vat_id" => "1",
            //         "default_shipping" => 1,
            //         "default_billing" => 1,
            //         // "extension_attributes" => array(),
            //         // "custom_attributes" => [
            //         //     array(
            //         //       "attribute_code" => "23",
            //         //       "value" => "bbb"
            //         //     ),
            //         //   ],
            //         ),
            //       ],
            //       "disable_auto_group_change" => 0,
            //       "extension_attributes" => [
            //           array(
            //           "is_subscribed" =>  true
            //         ),
            //       ],
            //       "custom_attributes" => [
            //         array(
            //           "attribute_code" => "23",
            //           "value" => "bbb"
            //         ),
            //       ]
        );

        // dd($customer);
        // exit();

        // $customer['addresses'] = array(
        //     'firstname'             => $request->input('firstname'),
        //     'lastname'              => $request->input('lastname'),
        //     'create_address'        => true,
        //     'city'                  => 'Bankok',
        //     'company'               => 'workbythai',
        //     'country_id'            => 'TH',
        //     'region_id'             => 12,
        //     'postcode'              => '10800',
        //     'street'                => array('1518/4', 'workbythai'),
        //     'telephone'             => '02-1024291',
        //     'is_default_billing'    => true,
        //     'is_default_shipping'   => true
        // );

        $customer['password'] = $request->input('password');
        $create_customer = $create_customers->customerAccountManagementV1CreateAccount($customer);
        $return['status'] = 1;
        $return['customer'] = $create_customer;
        $return['content'] = 'สำเร็จ';

        } catch (Exception $e){
            $return['status'] = 0;
            $return['content'] = 'ไม่สำรเ็จ'.$e->getMessage();;
        }
        $return['title'] = 'เพิ่มข้อมูล';

        return json_encode($return);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login_customer(Request $request){
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

        try{

        $login_customer = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=integrationCustomerTokenServiceV1',$params);

        $login_customers = array(
            'username' => $request->input('email_login'),
            'password' => $request->input('password_login')
        );

        $return['result'] = $login_customer->integrationCustomerTokenServiceV1CreateCustomerAccessToken($login_customers);
        $return['status'] = 1;
        $return['content'] = 'สำเร็จ';

        } catch (Exception $e){
            $return['status'] = 0;
            $return['content'] = 'ไม่สำรเ็จ'.$e->getMessage();;
        }
        $return['title'] = 'เข้าสู่ระบบ';

        return json_encode($return);

    }
}
