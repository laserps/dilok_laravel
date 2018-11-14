<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

            if(!empty($_GET)){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

        $catalog = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogCategoryManagementV1',$params);
        $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
        $get_products2 = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRenderListV1',$params);
        $get_type_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);
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
                        // 'filters' => [
                        //     [
                        //         'field' => 'type_id',
                        //         'value' => 'configurable',
                        //         'condition_type' => 'eq',
                        //     ],
                        // ],
                    ],
                    [
                        'filters' => [
                            [
                                'field' => 'type_id',
                                'value' => 'configurable',
                                'condition_type' => 'eq',
                            ],
                        ],
                    ],
                ],
                // 'sortOrders' => [
                //     [
                //         'field' => 'entity_id',
                //         'direction' => 'DESC',
                //     ],
                // ],
                'pageSize' => 12,
                'currentPage' => $page,
            ],
        ];
        $get_product_page['storeId'] = "1";
        $get_product_page['currencyCode'] = "THB";

        $catalogs = [
            'rootCategoryId' => 1,
        ];

        $get_size_products = [
            'attributeCode' => 'size',
        ];

        $get_color_product = [
            'attributeCode' => 'color',
        ];

        $get_clothing_products = [
            'attributeCode' => 'clothing_size',
        ];

        $get_gender_products = [
            'attributeCode' => 'gender',
        ];

        $login_customers = array(
            'username' => 'hamworkbythai@gmail.com',
            'password' => 'Whitestar01'
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

        $get_session_all = \Session::all();

        if(!empty($get_session_all[0])){
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

            $result2 = json_decode(curl_exec($ch));

            if(empty($result2->parameters)){

                $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

                $result3 = json_decode(curl_exec($ch));

                if(empty($result3->parameters)) {

                    $data['token_customer'] = $result2;
                    $data['login'] = $result2;
                    $data['cart_customer'] = $result3;

                    $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);

                        foreach($result3 as $key => $value){
                            $get_key_product = array(
                                'sku' => $value->sku
                            );
                            $data['product_key'][$key] = $get_products->catalogProductRepositoryV1Get($get_key_product);
                        }

                } else {
                    $data['token_customer'] = $result2;
                    $data['login'] = '';
                    $data['cart_customer'] = '';
                }

            } else {
                \Session::flush();
                return redirect('/');
            }
        }

            $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
            $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);
            $data['category'] = $catalog->catalogCategoryManagementV1GetTree($catalogs);
            $data['color_product'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_color_product);
            $data['size_products'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_size_products);
            // $data['clothing_size'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_clothing_products);
            $data['gender'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_gender_products);

        } catch(Exception $e) {
            $data['products'] = $e->getMessage();
        }

        return view('filter',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function get_gender(Request $request,$id=null){
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
        if(!empty($_GET)){
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $input_all['gender'] = $request->input('gender');
        $input_all['brand'] = $request->input('brand');
        $input_all['size'] = $request->input('size');
        $input_all['colorproduct'] = $request->input('colorproduct');

        $gender = array();
        $brand = array();
        $size = array();
        $colorproduct = array();

        if(!empty($input_all['gender'])){
            foreach($input_all['gender'] as $key => $value){
                $gender[] = [
                    'field' => 'gender',
                    'value' => '%25'.$value.'%25',
                    'conditionType' => 'like',
                ];
            }
        }

        if(!empty($input_all['brand'])){
            foreach($input_all['brand'] as $key => $value){
                $brand[] = [
                    'field' => 'category_id',
                    'value' => $value,
                    'conditionType' => 'eq',
                ];
            }
        }

        if(!empty($input_all['size'])){
            foreach($input_all['size'] as $key => $value){
                $size[] = [
                    'field' => 'size',
                    'value' => $value,
                    'conditionType' => 'eq',
                ];
            }
        }

        if(!empty($input_all['colorproduct'])){
            foreach($input_all['colorproduct'] as $key => $value){
                $colorproduct[] = [
                    'field' => 'color',
                    'value' => '%25'.$value.'%25',
                    'conditionType' => 'like',
                ];
            }
        }

        $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
        $get_products2 = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRenderListV1',$params);

        // if($id != null){
            if(!empty($input_all['gender']) || !empty($input_all['brand']) || !empty($input_all['size']) || !empty($input_all['colorproduct'])){
                $get_product_page = [
                    'searchCriteria' => [
                        'filterGroups' => [
                            0 => [
                                'filters' => [
                                    [
                                        'field' => 'status',
                                        'value' => '1',
                                        'conditionType' => 'eq',
                                    ],
                                ],
                                // 'filters' => [
                                //     [
                                //         'field' => 'visibility',
                                //         'value' => '4',
                                //         'condition_type' => 'eq',
                                //     ],
                                // ],
                                // 'filters' => [
                                //     [
                                //         'field' => 'type_id',
                                //         'value' => 'configurable',
                                //         'condition_type' => 'eq',
                                //     ],
                                // ],
                            ],
                            // 2 => [
                            //     'filters' => [
                            //         [
                            //             'field' => 'visibility',
                            //             'value' => '4',
                            //             'condition_type' => 'eq',
                            //         ],
                            //     ],
                            // ],
                            1 => [
                                'filters' => $gender
                            ],
                            2 => [
                                'filters' => $brand
                            ],
                            3 => [
                                'filters' => $size
                            ],
                            4 => [
                                'filters' => $colorproduct
                            ],
                            5 => [
                                'filters' => [
                                    [
                                        'field' => 'type_id',
                                        'value' => 'simple',
                                        'condition_type' => 'eq',
                                    ],
                                ],
                            ],
                        ],
                        'pageSize' => 12,
                        'currentPage' => $page,
                    ],
                ];
                $data['page'] = $page;
            } else {
                $get_product_page = [
                    'searchCriteria' => [
                        'filterGroups' => [
                            [
                                'filters' => [
                                    [
                                        'field' => 'status',
                                        'value' => '1',
                                        'conditionType' => 'eq',
                                    ],
                                ],
                                // 'filters' => [
                                //     [
                                //         'field' => 'visibility',
                                //         'value' => '4',
                                //         'condition_type' => 'eq',
                                //     ],
                                // ],
                                // 'filters' => [
                                //     [
                                //         'field' => 'type_id',
                                //         'value' => 'configurable',
                                //         'condition_type' => 'eq',
                                //     ],
                                // ],
                            ],
                            [
                                'filters' => [
                                    [
                                        'field' => 'type_id',
                                        'value' => 'configurable',
                                        'condition_type' => 'eq',
                                    ],
                                ],
                            ],
                        ],
                        'pageSize' => 12,
                        'currentPage' => $page,
                    ],
                ];
            }
        // } else {
        //     $get_product_page = [
        //             'searchCriteria' => [
        //                 'filterGroups' => [
        //                     [
        //                         'filters' => [
        //                             [
        //                                 'field' => 'status',
        //                                 'value' => '1',
        //                                 'conditionType' => 'eq',
        //                             ],
        //                         ],
        //                         'filters' => [
        //                             [
        //                                 'field' => 'visibility',
        //                                 'value' => '4',
        //                                 'condition_type' => 'eq',
        //                             ],
        //                         ],
                                // 'filters' => [
                                //     [
                                //         'field' => 'type_id',
                                //         'value' => 'configurable',
                                //         'condition_type' => 'eq',
                                //     ],
                                // ],
        //                     ],
        //                 ],
        //                 'pageSize' => 12,
        //                 'currentPage' => $page,
        //             ],
        //         ];
        //     $data['id_product'] = $id;
        // }
            $get_product_page['storeId'] = "1";
            $get_product_page['currencyCode'] = "THB";

        $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
        $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);

        } catch(Exception $e){
          $data['products'] = $e->getMessage();
        }

        return view('filter_search',$data);
    }

    public function filter_search(){
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
        if(!empty($_GET)){
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);


        // $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
        $get_product_page = [
            'searchCriteria' => [
                'filterGroups' => [
                    [
                        'filters' => [
                            [
                                'field' => 'status',
                                'value' => '1',
                                'condition_type' => 'eq',
                            ],
                        ],

                    ],
                ],
                'pageSize' => 12,
                'currentPage' => $page,
            ],
        ];

        $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
        $data['page'] = $page;

        }catch(Exception $e){
          $data['products'] = $e->getMessage();
        }

        return view('filter_search',$data);
    }

    public function add_to_cart(Request $request){
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
            $product = $request->input('product');
            $price_product = $request->input('price');
            $product_id = $request->input('product_id');

            $userData = array("username" => "customer", "password" => "customer@01");
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = curl_exec($ch);

        $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
        $get_product_detail = array(
            'sku' => $product
        );
        $data_product = $get_products->catalogProductRepositoryV1Get($get_product_detail);

        // $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/products/".$product);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        // // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($test));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));

        // $data_product = curl_exec($ch);

        // dd($data_product);
        // exit();

        $get_session_all = \Session::all();

        if(!empty($get_session_all[0])){
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

            $result2 = curl_exec($ch);

        }

        $product = [
            "cartItem" => [
              // "item_id" => 22,
              "sku"=> $data_product->result->sku,
              "qty"=> 1,
              "name" => $data_product->result->sku,
              "price" => $price_product,
              "product_type" => "simple",
              "quote_id"=> json_decode($result2)->id,
              // "productOption"=> [
              //   "extensionAttributes"=> [
              //     "configurableItemOptions"=> [
              //       [
              //         "optionId"=> "93",
              //         "optionValue"=> 44,
              //         "extensionAttributes"=> []
              //       ]
              //     ]
              //   ]
              // ]
            ]
          ];

        $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/".json_decode($result2)->id."/items");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($product));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));

        $result3 = curl_exec($ch);

        // dd($result3);
        // exit();

            $return['status'] = 1;
            $return['login'] = $result3;
            $return['content'] = 'เพิ่มสินค้าสำเร็จ';
        } catch (Exception $e){
            $return['status'] = 0;
            $return['content'] = 'เพิ่มสินค้าไม่สำรเ็จ'.$e->getMessage();;
        }
        $return['title'] = 'เพิ่มสินค้า';

        return json_encode($return);


    }

    public function del_to_cart(Request $request){
        try{
            $product_sku = $request->input('product');
            $product_id = $request->input('id_sku');

            $get_session_all = \Session::all();

            if(!empty($get_session_all[0])){
                $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/me");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

                $result2 = curl_exec($ch);

                $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

                $get_cart = json_decode(curl_exec($ch));

            }

            $product = [
                "cartItem" => [
                    "item_id" => $product_id,
                    "sku" => $product_sku,
                    "name" => $product_sku,
                    "quote_id" => $get_cart->id,
                ]
              ];

            $userData = array("username" => "customer", "password" => "customer@01");
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = curl_exec($ch);

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items/".$product_id);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "delete");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));


            $result3 = curl_exec($ch);

            // dd($product);
            // exit();

                $return['status'] = 1;
                $return['login'] = $result3;
                $return['content'] = 'ลบสินค้าสำเร็จ';
            } catch (Exception $e){
                $return['status'] = 0;
                $return['content'] = 'ลบสินค้าไม่สำรเ็จ'.$e->getMessage();;
            }
            $return['title'] = 'ลบสินค้า';

        return json_encode($return);
    }
}
