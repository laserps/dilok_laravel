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
            'password' => 'confirmed|required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|min:8',
            'password_confirmation' => 'required|min:8',
        ]);

        $date = date_create($request->input('dob'));
        $birdday = date_format($date,"Y-m-d");

        $errors = $validator->errors();

        if ($validator->fails()) {
            if($errors->first('password')){
                $return['status'] = 2;
                $return['content'] = 'Password ต้องมีอย่างน้อย 8 ตัวอักษร อักษรตัวใหญ่ 1 ตัว อักษรเล็ก 1 ตัวและตัวเลข 1 ตัว';
            }
            if($errors->first('password_confirmation')){
                $return['status'] = 2;
                $return['content'] = 'Password ไม่ตรงกัน';
            }
        } else {
            try{
                $value = [
                    "customer" => [
                        'email' => $request->input('email'),
                        'firstname' => $request->input('firstname'),
                        'lastname' => $request->input('lastname'),
                        'website_id' => 1,
                        'store_id' => 1,
                        'group_id' => 1,
                        "dob" => $birdday,
                        "default_billing" => 1,
                        "default_shipping" => 1,
                        "gender"=> $request->input('gender'),
                        "created_in" => "Default Store View",
                        "addresses"=> [
                            [
                                "region" => ["region_code" => $request->input('country'),"region" => $request->input('country_name'),"region_id" => 0],
                                "region_id" => 0,
                                "country_id" => $request->input('country'),
                                "street" => [$request->input('address'),$request->input('address2')],
                                "telephone" => $request->input('telephone'),
                                "postcode" => $request->input('postcode'),
                                "city" => $request->input('city'),
                                "company" => $request->input('company'),
                                "firstname" => $request->input('firstname'),
                                "lastname" => $request->input('lastname'),
                                "vat_id"=> $request->input('vat'),
                                "default_shipping"=> true,
                                "default_billing"=> true,
                                "extension_attributes"=> [],
                            ]
                        ],
                    ],
                    "password" => $request->input('password'),
                ];

                $admin_token = array("username" => "customerdilok", "password" => "dilokstore@1234");
                $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($admin_token));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($admin_token))));

                $token = json_decode(curl_exec($ch));

                $chch = curl_init("http://128.199.235.248/magento/rest/all/V1/customers");
                curl_setopt($chch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($chch, CURLOPT_POSTFIELDS, json_encode($value));
                curl_setopt($chch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($chch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

                $result = json_decode(curl_exec($chch));

                if(!empty($result->message)){
                    if($result->message == 'A customer with the same email already exists in an associated website.'){
                        $return['status'] = 3;
                        $return['content'] = 'Email นี้ได้มีการใช้แล้ว';
                    }
                } else {
                    $return['status'] = 1;
                    $return['customer'] = $result;
                    $return['content'] = 'สมัครสมาชิกสำเร็จ';
                }

            } catch (Exception $e){
                $return['status'] = 0;
                $return['content'] = 'ไม่สำรเ็จ'.$e->getMessage();
            }
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
        $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
        $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token = json_decode(curl_exec($ch));

        $get_session_all = \Session::all();

        if(!empty($get_session_all['customer_id'])){
                $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $result2 = json_decode(curl_exec($ch));

                // $data['token_customer'] = $result2;

                foreach($result2->addresses as $key => $value){
                    if(!empty($value->company)){
                        $company = $value->company;
                    } else {
                        $company = '';
                    }

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
                            "company" => $company,
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

        $chch = curl_init("http://128.199.235.248/magento/rest/all/V1/customers/me");
        curl_setopt($chch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($chch, CURLOPT_POSTFIELDS, json_encode($value));
        curl_setopt($chch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

        $result = json_decode(curl_exec($chch));

        // dd($result);
        // exit();

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = json_decode(curl_exec($ch));

            $chch = curl_init("http://128.199.235.248/magento/rest/all/V1/customers/".$id."");
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
        $date = date_create($request->input('dob'));
        $birdday = date_format($date,"Y-m-d");

        $value = [
            "customer"=>[
                'id' => $id,
                'email' => $request->input('email'),
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'website_id' => 1,
                'store_id' => 1,
                'group_id' => 1,
                "gender"=> $request->input('gender'),
                "dob"=> $birdday,
            ],
            "password" => $request->input('password'),
        ];

        $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
        $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token = curl_exec($ch);


        $chch = curl_init("http://128.199.235.248/magento/rest/all/V1/customers/".$id."");
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

            $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = json_decode(curl_exec($ch));

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/addresses/".$id."");
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

            $catalog = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogCategoryManagementV1',$params);

            $catalogs = [
                'rootCategoryId' => 1,
            ];

            $get_session_all = \Session::all();

            $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = json_decode(curl_exec($ch));

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/directory/countries");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . $token));

            $result = json_decode(curl_exec($ch));

            $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $blocks = json_decode(curl_exec($ch));

            $data['countries'] = $result;

            if(!empty($get_session_all['customer_id'])){
                $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $result2 = json_decode(curl_exec($ch));

                if(!empty($result2->id)){
                    $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                    $result3 = json_decode(curl_exec($ch));

                    if(empty($result3->parameters)) {

                        $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine");
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

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

                        $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
                        $get_products2 = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRenderListV1',$params);
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

                        $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);

                        foreach($result3 as $key => $value){
                            $get_key_product = array(
                                'sku' => $value->sku
                            );

                            $data['product_key'][$key] = $get_products->catalogProductRepositoryV1Get($get_key_product);
                        }

                        $get_type_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);

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
                        $data['color_product'] = '';
                        $data['size_products'] = '';
                        $data['products'] = '';
                        $data['products2'] = '';
                        $data['token_customer'] = $result2;
                        $data['cart_customer'] = '';
                        $data['get_cart'] = '';
                    }

                } else {
                    \Session::flush();
                    return redirect('/');
                }

            } else {
                \Session::flush();
                return redirect('/');
            }

        $data['category'] = $catalog->catalogCategoryManagementV1GetTree($catalogs);
        $data['blocks'] = $blocks;
        $data['page_title'] = 'Account';

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

            $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = curl_exec($ch);

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/customer/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($login_customers));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));

            $result = curl_exec($ch);

            if(empty(json_decode($result)->message)){
                $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($result)));

                $result2 = curl_exec($ch);

                // \Session::put(json_decode($result2)->id, json_decode($result));
                $request->session()->put('customer_id', json_decode($result));

                $return['status'] = 1;
                $return['login'] = $result2;
                $return['content'] = 'เข้าสู่ระบบสำเร็จ';
            } else {
                $return['status'] = 3;
                $return['content'] = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
            }

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

    public function get_billing($id_address){
        try{
            $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = json_decode(curl_exec($ch));

        $get_session_all = \Session::all();

        if(!empty($get_session_all['customer_id'])){
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $result2 = json_decode(curl_exec($ch));

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/addresses/".$id_address."");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $address_bill = json_decode(curl_exec($ch));

            $return['status'] = 1;
            $return['login'] = $address_bill;
            $return['content'] = 'เข้าสู่ระบบสำเร็จ';
        } else {
            \Session::flush();
            return redirect('/');
        }

        } catch (Exception $e){
            $return['status'] = 0;
            $return['content'] = 'เข้าสู่ระบบไม่สำรเ็จ'.$e->getMessage();
        }
        $return['title'] = 'เข้าสู่ระบบ';

        return json_encode($return);
    }

    public function show_edit_address($id_address){
        try {
            $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = json_decode(curl_exec($ch));

            $chch = curl_init("http://128.199.235.248/magento/rest/all/V1/customers/addresses/".$id_address."");
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

    public function edit_address_customer($id_address,Request $request){
        try{
        $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
        $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token = json_decode(curl_exec($ch));

        $get_session_all = \Session::all();

        if(!empty($get_session_all['customer_id'])){
                $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $result2 = json_decode(curl_exec($ch));


                foreach($result2->addresses as $key => $value){
                    if(!empty($value->company)){
                        $company = $value->company;
                    } else {
                        $company = '';
                    }
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
                            "company" => $company,
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
                        "id" => $request->input('customer_address_id'),
                        "customer_id" => $id_address,
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
                        'id' => $id_address,
                        'email' => $request->input('edit_address_email'),
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


                // dd($value);
                // exit();

            } else {
                \Session::flush();
                $return['status'] = 2;
                $return['content'] = 'กรุณาล็อกอินเข้าสู่ระบบ';
            }

        $chch = curl_init("http://128.199.235.248/magento/rest/all/V1/customers/me");
        curl_setopt($chch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($chch, CURLOPT_POSTFIELDS, json_encode($value));
        curl_setopt($chch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

        $result = json_decode(curl_exec($chch));

        // dd($result);
        // exit();

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
}
