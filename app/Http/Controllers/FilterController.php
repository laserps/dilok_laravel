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
    public function index($brands=null,$genders=null)
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
            'connection_timeout' => 180,
            'stream_context' => stream_context_create($opts),
            'cache_wsdl' => WSDL_CACHE_NONE
        );

        $catalog = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogCategoryManagementV1',$params);
        $catalogs = [
            'rootCategoryId' => 1,
        ];
        $category = $catalog->catalogCategoryManagementV1GetTree($catalogs);

        try{
            $data['brands2'] = $brands;

            if(is_int($brands)){
                $brands = '';
            } elseif($brands == "Men" || $brands == "Women" || $brands == "Kid") {
                if($brands == "Men"){
                    $genders = 306;
                    $brands = '';
                } elseif($brands == "Women"){
                    $genders = 307;
                    $brands = '';
                } elseif($brands == "Kid"){
                    $genders = 308;
                    $brands = '';
                } else {
                    $genders = '';
                    $brands = '';
                }
            } else {
                foreach($category->result->childrenData->item as $key => $value_cat){
                    if($value_cat->name == $brands){
                        $brands = $value_cat->id;
                    }
                }
            }

            if($genders == "Men" || $genders == "Women" || $genders == "Kid") {
                if($genders == "Men"){
                    $genders = 306;
                } elseif($genders == "Women"){
                    $genders = 307;
                } elseif($genders == "Kid"){
                    $genders = 308;
                } else {
                    $genders = '';
                }
            }

            // if(!empty($_GET['brands'])){
            //     $brands = $_GET['brands'];
            // } else {
            //     $brands = '';
            // }
            // if(!empty($_GET['genders'])){
            //     $genders = $_GET['genders'];
            // } else {
            //     $genders = '';
            // }
            if(!empty($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $gender = array();
            $brand = array();
            $size = array();
            $colorproduct = array();

            if(!empty($brands)){
                $brand[] = [
                    'field' => 'category_id',
                    'value' => $brands,
                    'conditionType' => 'eq',
                ];
            }
            if(!empty($genders)){
                $gender[] = [
                    'field' => 'gender',
                    'value' => '%25'.$genders.'%25',
                    'conditionType' => 'like',
                ];
            }

            if(!empty($_GET)){
                $type = 'simple';
            } else {
                $type = 'configurable';
            }

            // if(!empty($input_all['gender'])){
            //     foreach($input_all['gender'] as $key => $value){
            //         $gender[] = [
            //             'field' => 'gender',
            //             'value' => '%25'.$value.'%25',
            //             'conditionType' => 'like',
            //         ];
            //     }
            // }


            // if(!empty($input_all['size'])){
            //     foreach($input_all['size'] as $key => $value){
            //         $size[] = [
            //             'field' => 'size',
            //             'value' => $value,
            //             'conditionType' => 'eq',
            //         ];
            //     }
            // }

            // if(!empty($input_all['colorproduct'])){
            //     foreach($input_all['colorproduct'] as $key => $value){
            //         $colorproduct[] = [
            //             'field' => 'color',
            //             'value' => '%25'.$value.'%25',
            //             'conditionType' => 'like',
            //         ];
            //     }
            // }

            // dd($gender);
            // exit();

            $catalog = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogCategoryManagementV1',$params);
            $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
            $get_products2 = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRenderListV1',$params);
            $get_type_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);

                $get_product_page = [
                    'searchCriteria' => [
                        'filterGroups' => [
                            0 => [
                                'filters' => [
                                    [
                                        'field' => 'visibility',
                                        'value' => '4',
                                        'condition_type' => 'eq',
                                    ],
                                ],
                            ],
                            // 4 => [
                            //     'filters' => $size
                            // ],
                            // 5 => [
                            //     'filters' => $colorproduct
                            // ],
                            1 => [
                                'filters' => [
                                    [
                                        'field' => 'type_id',
                                        'value' => $type,
                                        'condition_type' => 'eq',
                                    ],
                                ],
                            ],
                            2 => [
                                'filters' => $gender
                            ],
                            3 => [
                                'filters' => $brand
                            ],
                        ],
                        'sortOrders' => [
                            [
                                'field' => 'entity_id',
                                'direction' => 'DESC',
                            ],
                        ],
                        'pageSize' => 12,
                        'currentPage' => $page,
                    ],
                ];
                $get_product_page['storeId'] = "1";
                $get_product_page['currencyCode'] = "THB";

                // dd($get_product_page);
                // exit();

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

            $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = json_decode(curl_exec($ch));

            $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $blocks = json_decode(curl_exec($ch));

            $get_session_all = \Session::all();

        if(!empty($get_session_all['customer_id'])){
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $customer_me = json_decode(curl_exec($ch));

            if(empty($customer_me->parameters)){

                $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $customer_item = json_decode(curl_exec($ch));

                if(empty($customer_item->parameters)) {

                    $data['token_customer'] = $customer_me;
                    $data['login'] = $customer_me;
                    $data['cart_customer'] = $customer_item;

                    $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);

                        foreach($customer_item as $key => $value){
                            $get_key_product = array(
                                'sku' => $value->sku
                            );
                            $data['product_key'][$key] = $get_products->catalogProductRepositoryV1Get($get_key_product);
                        }

                } else {
                    $data['token_customer'] = $customer_me;
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
            $data['blocks'] = $blocks;
            $data['page_title'] = 'Fillter';


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

    public function get_gender(Request $request  , $brand = null){
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

        // $input_all['gender'][] = $gender;
        // $input_all['brand'][] = $brand;
        // $input_all['size'][] = $size;
        // $input_all['colorproduct'][] = $colorproduct;

        $gender = array();
        $brand = array();
        $size = array();
        $colorproduct = array();

        // dd($input_all);

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

        $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
        $get_products2 = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRenderListV1',$params);

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
                            ],
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
                            // 6 => [
                            //     'filters' => [
                            //         [
                            //             'field' => 'visibility',
                            //             'value' => '4',
                            //             'condition_type' => 'eq',
                            //         ],
                            //     ],
                            // ],
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

            dd($get_product_page);
            exit();

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
          'connection_timeout' => 180,
          'stream_context' => stream_context_create($opts),
          'cache_wsdl' => WSDL_CACHE_NONE
        );
        try{
        if(!empty($_GET)){
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);


        // $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
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
            'connection_timeout' => 180,
            'stream_context' => stream_context_create($opts),
            'cache_wsdl' => WSDL_CACHE_NONE
        );

        try{
            $product = $request->input('product');
            $price_product = $request->input('price');
            $product_id = $request->input('product_id');

            $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token = curl_exec($ch);

        $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
        $get_product_detail = array(
            'sku' => $product
        );
        $data_product = $get_products->catalogProductRepositoryV1Get($get_product_detail);

        $get_session_all = \Session::all();

        if(!empty($get_session_all['customer_id'])){
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $customer_me = curl_exec($ch);

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $create_cart = json_decode(curl_exec($ch));

            $product = [
                "cartItem" => [
                    "sku"=> $data_product->result->sku,
                    "qty"=> 1,
                    "name" => $data_product->result->sku,
                    "price" => $price_product,
                    "product_type" => "simple",
                    "quote_id"=> $create_cart,
                ]
            ];

            // dd($product);

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($product));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $customer_item = json_decode(curl_exec($ch));

            $return['status'] = 1;
            $return['login'] = $customer_item;
            $return['content'] = 'เพิ่มสินค้าสำเร็จ';
        } else {
            \Session::flush();
            $return['status'] = 2;
            $return['content'] = 'กรุณาล็อกอินเข้าสู่ระบบ';
        }

        } catch (Exception $e){
            $return['status'] = 0;
            $return['content'] = 'เพิ่มสินค้าไม่สำรเ็จ'.$e->getMessage();
        }

        $return['title'] = 'เพิ่มสินค้า';

    return json_encode($return);

    }

    public function del_to_cart(Request $request){
        try{
            $product_sku = $request->input('product');
            $product_id = $request->input('id_sku');

            $get_session_all = \Session::all();

            if(!empty($get_session_all['customer_id'])){
                $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $result2 = curl_exec($ch);

                $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $get_cart = json_decode(curl_exec($ch));

                $product = [
                    "cartItem" => [
                        "item_id" => $product_id,
                        "sku" => $product_sku,
                        "name" => $product_sku,
                        "quote_id" => $get_cart->id,
                    ]
                ];

                $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items/".$product_id);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "delete");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $customer_item = json_decode(curl_exec($ch));

                $return['status'] = 1;
                $return['login'] = $customer_item;
                $return['content'] = 'ลบสินค้าสำเร็จ';
            } else {
                \Session::flush();
                $return['status'] = 2;
                $return['content'] = 'กรุณาล็อกอินเข้าสู่ระบบ';
            }

            } catch (Exception $e){
                $return['status'] = 0;
                $return['content'] = 'ลบสินค้าไม่สำรเ็จ'.$e->getMessage();;
            }

            $return['title'] = 'ลบสินค้า';

        return json_encode($return);
    }
}
