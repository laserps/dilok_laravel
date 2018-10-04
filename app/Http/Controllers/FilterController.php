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

            $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
            $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);
            $data['category'] = $catalog->catalogCategoryManagementV1GetTree($catalogs);
            $data['color_product'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_color_product);
            $data['size_products'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_size_products);
            // $data['clothing_size'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_clothing_products);
            $data['gender'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_gender_products);
        }catch(Exception $e){
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

    public function get_gender(Request $request){
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
                            // 1 => [
                            //     'filters' => [
                            //         [
                            //             'field' => 'type_id',
                            //             'value' => 'configurable',
                            //             'condition_type' => 'eq',
                            //         ],
                            //     ],
                            // ],
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
                                'filters' => [
                                    [
                                        'field' => 'visibility',
                                        'value' => '4',
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
                        'pageSize' => 12,
                        'currentPage' => $page,
                    ],
                ];
            }
            $get_product_page['storeId'] = "1";
            $get_product_page['currencyCode'] = "THB";

        $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
        $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);

        // dd($data);
        // exit();

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
}
