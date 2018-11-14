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
        $validator = \Validator::make($request->all(), [
            // 'password' => 'required|regex:/(^([a-zA-Z]+)([0-9]+)(\d+)?$)/u|min:1',
            'password' => 'required|regex:/(^([A-Za-z]+)([0-9]+)(\d+)?$)/u|min:1',
            // 'password' => 'required|regex:/^([a-z])([A-Z])(\d)).+$/|min:1',
        ]);

        if ($validator->fails()) {
            return "2";
        } else {
            return "1";
        }




        exit();

        try{
            $value = [
                "customer" => [
                    // 'id' => 29,
                    'email' => $request->input('email'),
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'website_id' => 1,
                    'store_id' => 1,
                    'group_id' => 1,
                    "default_billing" => 1,
                    "default_shipping" => 1,
                    // "gender"=> 0,
                    // "created_at" => "2018-09-24 06:48:56",
                    // "updated_at" => "2018-09-24 06:48:56",
                    "created_in" => "Default Store View",
                    "addresses"=> [
                        [
                            // "id" => 0,
                            // "customer_id" => 29,
                            "region" => ["region_code" => $request->input('country'),"region" => $request->input('country_name'),"region_id" => 0],
                            "region_id" => 0,
                            "country_id" => $request->input('country'),
                            "street" => [$request->input('address')],
                            "telephone" => $request->input('telephone'),
                            "postcode" => $request->input('postcode'),
                            "city" => $request->input('city'),
                            "firstname" => $request->input('firstname'),
                            "lastname" => $request->input('lastname'),
                            // "middlename"=> "string",
                            // "prefix"=> "1",
                            // "suffix"=> "1",
                            // "vat_id"=> "1",
                            "default_shipping"=> true,
                            "default_billing"=> true,
                            "extension_attributes"=> [],
                        ]
                    ],
                ],
                "password" => $request->input('password'),
            ];

            $admin_token = array("username" => "customer", "password" => "customer@01");
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($admin_token));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($admin_token))));

            $token = json_decode(curl_exec($ch));

            $chch = curl_init("http://192.168.1.27/dilok2/rest/all/V1/customers");
            curl_setopt($chch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($chch, CURLOPT_POSTFIELDS, json_encode($value));
            curl_setopt($chch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $result = json_decode(curl_exec($chch));

            $return['status'] = 1;
            $return['customer'] = $result;
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
    public function store(Request $request , $id)
    {
      try{
        $userData = array("username" => "customer", "password" => "customer@01");
        $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token = json_decode(curl_exec($ch));

        $get_session_all = \Session::all();

        if(!empty($get_session_all[0])){
                $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/me");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

                $result2 = json_decode(curl_exec($ch));

                // $data['token_customer'] = $result2;

                foreach($result2->addresses as $key => $value){
                    $address_value[$key] = [
                        "id" => $value->id,
                        "customer_id" => $value->customer_id,
                        "region" => [
                          "region_code" => $value->region->region_code,
                          "region" => $value->region->region,
                          "region_id" => $value->region->region_id,
                        ],
                        "region_id" => $value->region_id,
                        "country_id" => $value->country_id,
                        "street" => $value->street,
                        "company" => !empty($value->company),
                        "telephone" => $value->telephone,
                        "postcode" => $value->postcode,
                        "city" => $value->city,
                        "firstname" => $value->firstname,
                        "lastname" => $value->lastname,
                    ];
                }


                if(count($address_value) == 1){
                    $count = 1;
                } else {
                    $count = count($address_value);
                }

                $address_value[$count] =
                    [
                        "customer_id" => $id,
                        "region" => ["region_code" => $request->input('country'),"region" => $request->input('country_name'),"region_id" => 0],
                        "region_id" => 0,
                        "country_id" => $request->input('country'),
                        "street" => [$request->input('address'),$request->input('address2')],
                        "company" => $request->input('company'),
                        "telephone" => $request->input('telephone'),
                        "postcode" => $request->input('postcode'),
                        "city" => $request->input('city'),
                        "firstname" => $request->input('firstname'),
                        "lastname" => $request->input('lastname'),
                ];

                $value = [
                    "customer" => [
                        'id' => $id,
                        'email' => $request->input('email'),
                        'firstname' => $request->input('firstname'),
                        'lastname' => $request->input('lastname'),
                        'website_id' => 1,
                        'store_id' => 1,
                        'group_id' => 1,
                        "default_billing" => 1,
                        "default_shipping" => 1,
                        "addresses" =>
                            $address_value,
                    ],
                ];

            } else {
                \Session::flush();
                $return['status'] = 2;
                $return['content'] = 'กรุณาล็อกอินเข้าสู่ระบบ';
            }

        $chch = curl_init("http://192.168.1.27/dilok2/rest/all/V1/customers/me");
        curl_setopt($chch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($chch, CURLOPT_POSTFIELDS, json_encode($value));
        curl_setopt($chch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

        $result = json_decode(curl_exec($chch));

        // dd($result);
        // exit();

        $return['status'] = 1;
        $return['customer'] = $result;
        $return['content'] = 'สำเร็จ';

        } catch (Exception $e){
            $return['status'] = 0;
            $return['content'] = 'ไม่สำรเ็จ'.$e->getMessage();;
        }
        $return['title'] = 'เพิ่มข้อมูล';

        return json_encode($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $userData = array("username" => "customer", "password" => "customer@01");
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = json_decode(curl_exec($ch));

            $chch = curl_init("http://192.168.1.27/dilok2/rest/all/V1/customers/".$id."");
            curl_setopt($chch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($chch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $result = json_decode(curl_exec($chch));

            $return['status'] = 1;
            $return['customer'] = $result;
            $return['content'] = 'สำเร็จ';

        } catch (Exception $e) {
            $return['status'] = 0;
            $return['content'] = 'ไม่สำรเ็จ'.$e->getMessage();
        }

        return json_encode($return);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id , Request $request)
    {
      try{
        $value = [
            "customer"=>[
                'id' => $id,
                'email' => $request->input('email'),
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'website_id' => 1,
                'store_id' => 1,
                'group_id' => 1,
                // "default_billing" => 1,
                // "default_shipping" => 1,
                // "gender"=> 0,
                // "created_at" => "2018-09-24 06:48:56",
                // "updated_at" => "2018-09-24 06:48:56",
                // "created_in" => "Default Store View",
                // "addresses"=> [
                //     [
                //         // "id" => 0,
                //         // "customer_id" => 29,
                //         "region" => ["region_code" => $request->input('country'),"region" => $request->input('country_name'),"region_id" => 0],
                //         "region_id" => 0,
                //         "country_id" => $request->input('country'),
                //         "street" => [$request->input('address')],
                //         "telephone" => $request->input('telephone'),
                //         "postcode" => $request->input('postcode'),
                //         "city" => $request->input('city'),
                //         "firstname" => $request->input('firstname'),
                //         "lastname" => $request->input('lastname'),
                //         // "middlename"=> "string",
                //         // "prefix"=> "1",
                //         // "suffix"=> "1",
                //         // "vat_id"=> "1",
                //         "default_shipping"=> true,
                //         "default_billing"=> true,
                //         "extension_attributes"=> [],
                //         // "custom_attributes"=> [
                //         //     [
                //         //     "attribute_code"=> "string",
                //         //     "value"=> "string"
                //         //     ]
                //         // ]
                //     ]
                // ],
            ],
            "password" => $request->input('password'),
        ];

        $userData = array("username" => "customer", "password" => "customer@01");
        $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token = curl_exec($ch);


        $chch = curl_init("http://192.168.1.27/dilok2/rest/all/V1/customers/".$id."");
        curl_setopt($chch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($chch, CURLOPT_POSTFIELDS, json_encode($value));
        curl_setopt($chch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));

        $result = curl_exec($chch);

        $return['status'] = 1;
        $return['customer'] = $result;
        $return['content'] = 'สำเร็จ';

        } catch (Exception $e){
            $return['status'] = 0;
            $return['content'] = 'ไม่สำรเ็จ'.$e->getMessage();
        }
        $return['title'] = 'เพิ่มข้อมูล';

        return json_encode($return);
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
        try {
            $get_session_all = \Session::all();

            $userData = array("username" => "customer", "password" => "customer@01");
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = json_decode(curl_exec($ch));

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/addresses/".$id."");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "delete");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $result = json_decode(curl_exec($ch));

            $return['status'] = 1;
            $return['customer'] = $result;
            $return['content'] = 'ลบที่อยู่สำเร็จ';

        } catch (Exception $e) {
            $return['status'] = 0;
            $return['content'] = 'ลบที่อยู่ไม่สำรเ็จ'.$e->getMessage();
        }

        return json_encode($return);
    }

    public function profile(){
      try {
            $get_session_all = \Session::all();

            $userData = array("username" => "customer", "password" => "customer@01");
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = json_encode(curl_exec($ch));

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/directory/countries");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . $token));

            $result = json_decode(curl_exec($ch));

            $data['countries'] = $result;

            if(!empty($get_session_all[0])){
                $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/me");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

                $result2 = json_decode(curl_exec($ch));

                if(!empty($result2->id)){
                    $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

                    $result3 = json_decode(curl_exec($ch));

                    $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

                    $get_cart = json_decode(curl_exec($ch));

                    $opts = array(
                        'ssl' => array('ciphers' => 'RC4-SHA', 'verify_peer' => false, 'verify_peer_name' => false)
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

                    $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
                    $get_products2 = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRenderListV1',$params);
                    $get_product_page = [
                        'searchCriteria' => [
                            'filterGroups' => [
                                [
                                    'filters' => [
                                        [
                                            'field' => 'visibility',
                                            'value' => '4',
                                            'condition_type' => 'eq',
                                        ],
                                    ],
                                    'filters' => [
                                        [
                                            'field' => 'status',
                                            'value' => '1',
                                            'condition_type' => 'eq',
                                        ],
                                    ],
                                    'filters' => [
                                        [
                                            'field' => 'type_id',
                                            'value' => 'configurable',
                                            'condition_type' => 'eq',
                                        ],
                                    ],
                                ],
                            ],
                            'sortOrders' => [
                                [
                                    'field' => 'entity_id',
                                    'direction' => 'DESC',
                                ],
                            ],
                            'pageSize' => 20,
                        ],
                    ];
                    $get_product_page['storeId'] = "1";
                    $get_product_page['currencyCode'] = "THB";

                    $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);

                    foreach($result3 as $key => $value){
                        $get_key_product = array(
                            'sku' => $value->sku
                        );

                        $data['product_key'][$key] = $get_products->catalogProductRepositoryV1Get($get_key_product);
                    }

                    $get_type_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);

                    $get_color_product = [
                        'attributeCode' => 'color',
                    ];
                    $get_size_product = [
                        'attributeCode' => 'size',
                    ];

                    $data['color_product'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_color_product);
                    $data['size_products'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_size_product);
                    $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
                    $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);
                    $data['token_customer'] = $result2;
                    $data['cart_customer'] = $result3;
                    $data['get_cart'] = $get_cart;

                } else {
                    \Session::flush();
                    return redirect('/');
                }

            } else {
                \Session::flush();
                return redirect('/');
            }
        } catch (Exception $e) {
            $data['products'] = $e->getMessage();
        }
        return view('account',$data);
    }

    public function login_customer(Request $request){
        try{
            $login_customers = array(
                'username' => $request->input('email_login'),
                'password' => $request->input('password_login')
            );

            $userData = array("username" => "customer", "password" => "customer@01");
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = curl_exec($ch);

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/customer/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($login_customers));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));

            $result = curl_exec($ch);

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($result)));

            $result2 = curl_exec($ch);

            \Session::put(json_decode($result2)->id, json_decode($result));

            $return['status'] = 1;
            $return['login'] = $result2;
            $return['content'] = 'เข้าสู่ระบบสำเร็จ';

        } catch (Exception $e){
            $return['status'] = 0;
            $return['content'] = 'เข้าสู่ระบบไม่สำรเ็จ'.$e->getMessage();
        }
        $return['title'] = 'เข้าสู่ระบบ';

        return json_encode($return);

    }

    public function logout(){
        \Session::flush();
        return redirect('/');
    }
}
