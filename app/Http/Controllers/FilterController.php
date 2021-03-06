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
        header("Cache-Control: max-age=60"); //30days (60sec)
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

        $get_session_all = \Session::all();

        $token_admin_magento = new HomeController;

        if(!empty($get_session_all['token_admin'])){
            $token = $get_session_all['token_admin'];
        } else {
            $token = $token_admin_magento->login_admin_magento();
        }

        $mh = curl_multi_init();

        if(!empty($_GET)){
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $categories = curl_init("http://128.199.235.248/magento/rest/V1/categories?rootCategoryId=1");
        curl_setopt($categories, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($categories, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($categories, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

        $size_products = curl_init("http://128.199.235.248/magento/rest//V1/products/attributes/size/options");
        curl_setopt($size_products, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($size_products, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($size_products, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

        $color_product = curl_init("http://128.199.235.248/magento/rest//V1/products/attributes/color/options");
        curl_setopt($color_product, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($color_product, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($color_product, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

        //เรียกข้อมูล block
        $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

        $blocks = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks);
        curl_setopt($blocks, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($blocks, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($blocks, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

        curl_multi_add_handle($mh, $categories);
        curl_multi_add_handle($mh, $size_products);
        curl_multi_add_handle($mh, $color_product);
        curl_multi_add_handle($mh, $blocks);

        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        $category = json_decode(curl_multi_getcontent($categories));

        try{
            if($brands == 'htglight'){
                $data['brands2'] = $brands;
                // $type = 'configurable';
            }

            if($brands == "Men" || $brands == "Women" || $brands == "Kid") {
                $data['brands2'] = $brands;
            } else {
                $data['brands2'] = $brands;
            }
            $genderss = '';
            if(is_int($brands)){
                $brands = '';
            } elseif($brands == "Men" || $brands == "Women" || $brands == "Kid") {
                if($brands == "Men"){
                    $genders = 306;
                    $genderss = 'Male';
                    $brands = '';
                } elseif($brands == "Women"){
                    $genders = 307;
                    $genderss = 'Female';
                    $brands = '';
                } elseif($brands == "Kid"){
                    $genders = 308;
                    $genderss = 'Kids';
                    $brands = '';
                } else {
                    $genders = '';
                    $genderss = '';
                    $brands = '';
                }
            } else {
                foreach($category->children_data as $key => $value_cat){
                    if($value_cat->name == $brands){
                        $brands = $value_cat->id;
                    }
                }
            }


                $data['genders22'] = $genderss;

            if($genders == "Men" || $genders == "Women" || $genders == "Kid") {
                if($genders == "Men"){
                    $genders = 306;
                    $data['genders22'] = 'Male';
                    $genders_text = 'Male';
                } elseif($genders == "Women"){
                    $genders = 307;
                    $data['genders22'] = 'Female';
                    $genders_text = 'Female';
                } elseif($genders == "Kid"){
                    $genders = 308;
                    $data['genders22'] = 'Kids';
                    $genders_text = 'Kids';
                } else {
                    $genders = '';
                    $data['genders22'] = '';
                    $genders_text = '';
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
                if($brands == 'highlight'){
                    $brand[] = [
                        'field' => 'highlight',
                        'value' => "1",
                        'conditionType' => 'eq',
                    ];
                } else {
                    $brand[] = [
                        'field' => 'category_id',
                        'value' => $brands.",",
                        'conditionType' => 'in',
                    ];
                }
            }
            if(!empty($genders)){
                // $gender[] = [
                //     'field' => 'gender',
                //     'value' => '%25'.$genders.'%25',
                //     'conditionType' => 'like',
                // ];
                $gender[] = [
                    'field' => 'gender',
                    'value' => $genders.",",
                    'conditionType' => 'in',
                ];
            }

            // if(!empty($_GET)){
            //     $type = 'simple';
            // } else {
            //     // $type = 'configurable';
            //     $type = 'simple';
            // }
            if(!empty($brands) && $brands != 'highlight'){
                // $type = 'simple';
                $type = 'configurable';
            } else {
                // $type = 'configurable';
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

            //เรียกข้อมูลสินค้า
            $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
            //เรียกข้อมูลสินค้า
            $get_products2 = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRenderListV1',$params);
            //เรียก size & color ทั้งหมด
            $get_type_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);

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
                                'filters' => [
                                    [
                                        'field' => 'type_id',
                                        'value' => $type,
                                        'conditionType' => 'eq',
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

            $get_clothing_products = [
                'attributeCode' => 'clothing_size',
            ];

            $get_gender_products = [
                'attributeCode' => 'gender',
            ];

            $get_highlight_products = [
                'attributeCode' => 'highlight',
            ];

        if(!empty($get_session_all['customer_id'])){
            //เรียกข้อมูล customer
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $customer_me = json_decode(curl_exec($ch));

            if(empty($customer_me->parameters)){
                //เรียกข้อมูลตะกร้าสินค้า
                $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $customer_item = json_decode(curl_exec($ch));

                if(empty($customer_item->parameters)) {

                    $data['token_customer'] = $customer_me;
                    $data['login'] = $customer_me;
                    $data['cart_customer'] = $customer_item;

                    //เรียกข้อมูลสินค้า
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

        $data['category'] = json_decode(curl_multi_getcontent($categories));
        $data['blocks'] = json_decode(curl_multi_getcontent($blocks));
        $data['size_products'] = json_decode(curl_multi_getcontent($size_products));
        $data['color_product'] = json_decode(curl_multi_getcontent($color_product));

            $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
            $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);
            $data['gender'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_gender_products);
            $data['highlight'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_highlight_products);
            // $data['blocks'] = $blocks;
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
        $input_all['highlight'] = $request->input('highlight');

        // $request->session()->put('session_gender', $input_all['gender']);
        // $request->session()->put('session_brand', $input_all['brand']);
        // $request->session()->put('session_size', $input_all['size']);
        // $request->session()->put('session_colorproduct', $input_all['colorproduct']);

        $session_all = session()->all();

        $gender = array();
        $brand = array();
        $size = array();
        $colorproduct = array();
        $highlight = array();
        $main_array = array();

        $brand_text = null;
        $gender_text = null;
        $size_text = null;
        $color_text = null;
        $highlight_text = null;

        // dd($input_all['gender']);
        // if(count($input_all['gender']) >= 2){
        //     foreach($input_all['gender'] as $key => $value){
        //         echo $value.',',;
        //     }
        // } else {
        //     dd($input_all['gender']);
        // }
        // exit();

        $status = [
            'filters' => [
                [
                    'field' => 'status',
                    'value' => '1',
                    'conditionType' => 'eq',
                ],
            ],
        ];
        $type = [
            'filters' => [
                [
                    'field' => 'type_id',
                    'value' => 'configurable',
                    // 'value' => 'simple',
                    'conditionType' => 'eq',
                ],
            ],
        ];

        array_push($main_array, $status);
        array_push($main_array, $type);

        if(!empty($input_all['gender'])){
            foreach($input_all['gender'] as $key => $value){
                // $gender = [
                //     'filters' => [
                //         [
                //             'field' => 'gender',
                //             'value' => '%25'.$value.'%25',
                //             'conditionType' => 'like',
                //         ],
                //     ],
                // ];
                // $gender[] = [
                //     'field' => 'gender',
                //     'value' => '%25'.$value.'%25',
                //     'conditionType' => 'like',
                // ];
                $gender_text .= $value.",";
            }
                $gender[] = [
                    'field' => 'gender',
                    'value' => $gender_text,
                    'conditionType' => 'in',
                ];
                array_push($main_array, $gender);
        }

        if(!empty($input_all['brand'])){
            foreach($input_all['brand'] as $key => $value){
                // $brand = [
                //     'filters' => [
                //         [
                //             'field' => 'category_id',
                //             'value' => $value.',',
                //             'conditionType' => 'in',
                //         ],
                //     ],
                // ];
                // $brand[] = [
                //     'field' => 'category_id',
                //     'value' => $value,
                //     'conditionType' => 'eq',
                // ];
                $brand_text .= $value.",";
            }
                $brand[] = [
                    'field' => 'category_id',
                    'value' => $brand_text,
                    'conditionType' => 'in',
                ];
                array_push($main_array, $brand);
        }

        if(!empty($input_all['size'])){
            foreach($input_all['size'] as $key => $value){
                // $size = [
                //     'filters' => [
                //         [
                //             'field' => 'size',
                //             'value' => $value,
                //             'conditionType' => 'eq',
                //         ],
                //     ],
                // ];
                // $size[] = [
                //     'field' => 'size',
                //     'value' => $value,
                //     'conditionType' => 'eq',
                // ];
                $size_text .= $value.",";
            }
                $size[] = [
                    'field' => 'size',
                    'value' => $size_text,
                    'conditionType' => 'in',
                ];
                array_push($main_array, $size);
        }

        if(!empty($input_all['colorproduct'])){
            foreach($input_all['colorproduct'] as $key => $value){
                // $colorproduct = [
                //     'filters' => [
                //         [
                //             'field' => 'color',
                //             'value' => '%25'.$value.'%25',
                //             'conditionType' => ' ',
                //         ],
                //     ],
                // ];
                // $colorproduct[] = [
                //     'field' => 'color',
                //     'value' => '%25'.$value.'%25',
                //     'conditionType' => 'like',
                // ];
                $color_text .= $value.",";
            }
                $colorproduct[] = [
                    'field' => 'color',
                    'value' => $color_text,
                    'conditionType' => 'in',
                ];
                array_push($main_array, $colorproduct);
        }

        if(!empty($input_all['highlight'])){
            foreach($input_all['highlight'] as $key => $value){
                $highlight_text .= $value.",";
            }
                $highlight[] = [
                    'field' => 'highlight',
                    'value' => '1',
                    'conditionType' => 'eq',
                ];
                array_push($main_array, $highlight);
        }

        //เรียกข้อมูลสินค้า
        $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
        //เรียกข้อมูลสินค้า
        $get_products2 = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRenderListV1',$params);

            if(!empty($input_all['gender']) || !empty($input_all['brand']) || !empty($input_all['size']) || !empty($input_all['colorproduct']) || !empty($input_all['highlight'])){
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
                                'filters' => [
                                    [
                                        'field' => 'type_id',
                                        'value' => 'configurable',
                                        // 'value' => 'simple',
                                        'conditionType' => 'eq',
                                    ],
                                ],
                            ],
                            2 => [
                                'filters' => $gender
                            ],
                            3 => [
                                'filters' => $brand
                            ],
                            4 => [
                                'filters' => $size
                            ],
                            5 => [
                                'filters' => $colorproduct
                            ],
                            6 => [
                                'filters' => $highlight
                            ],
                            // $gender,
                            // $size,
                            // $colorproduct,
                            // $brand
                            // 6 => [
                            //     'filters' => [
                            //         [
                            //             'field' => 'visibility',
                            //             'value' => '4',
                            //             'condition_type' => 'eq',
                            //         ],
                            //     ],
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
                            ],
                            [
                                'filters' => [
                                    [
                                        'field' => 'type_id',
                                        'value' => 'configurable',
                                        // 'value' => 'simple',
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
                        'pageSize' => 12,
                        'currentPage' => $page,
                    ],
                ];
            }

            $get_product_page['storeId'] = "1";
            $get_product_page['currencyCode'] = "THB";

        $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
        $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);
        $data['products_list_pages'] = json_encode($get_product_page);

        } catch(Exception $e){
          $data['products'] = $e->getMessage();
        }

        $data['session_chk'] = $session_all;

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

        //เรียกข้อมูลสินค้า
        $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
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

            $get_session_all = \Session::all();

            $token_admin_magento = new HomeController;

            if(!empty($get_session_all['token_admin'])){
                $token = $get_session_all['token_admin'];
            } else {
                $token = $token_admin_magento->login_admin_magento();
            }

        //เรียกข้อมูลสินค้า
        $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
        $get_product_detail = array(
            'sku' => $product
        );
        $data_product = $get_products->catalogProductRepositoryV1Get($get_product_detail);

        if(!empty($get_session_all['customer_id'])){
            //เรียกข้อมูล customer
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $customer_me = curl_exec($ch);

            //เรียกข้อมูลตะกร้าสินค้า
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

            //เก็บสินค้าลงตะกร้า
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($product));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $customer_item = json_decode(curl_exec($ch));

            if(!empty($customer_item->message)){
                $return['status'] = 3;
                $return['content'] = 'สินค้าชิ้นนี้หมด';
            } else {
                $return['status'] = 1;
                $return['login'] = $customer_item;
                $return['content'] = 'เพิ่มสินค้าสำเร็จ';
            }

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
                //เรียกข้อมูล customer
                $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $result2 = curl_exec($ch);

                //เรียกข้อมูลตะกร้าสินค้า
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

                //ลบสินค้าในตะกร้า
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

    public function filter_page_list(Request $request){
        try {
            $data = $request->all();
            $list_product_page = $data['product_main_page'];
            $page_list = $data['page_list'];

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

            $get_product_page = [
                    'searchCriteria' => [
                        'filterGroups' =>
                            $list_product_page['searchCriteria']['filterGroups'],
                        'sortOrders' => [
                            [
                                'field' => 'entity_id',
                                'direction' => 'DESC',
                            ],
                        ],
                        'pageSize' => 12,
                        'currentPage' => $page_list,
                    ],
                ];
            $get_product_page['storeId'] = "1";
            $get_product_page['currencyCode'] = "THB";
            $data['page'] = $page_list;

            //เรียกข้อมูลสินค้า
            $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
            //เรียกข้อมูลสินค้า
            $get_products2 = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRenderListV1',$params);

            $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
            $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);
            $data['products_list_pages'] = json_encode($get_product_page);
            $data['status'] = 1;
        } catch (Exception $e) {
            $data['products'] = $e->getMessage();
        }

    // return view('filter_search2',$data);
        return json_encode($data);

    }
}
