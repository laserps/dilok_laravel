<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
        $catalog = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogCategoryManagementV1',$params);
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
                                // 'value' => 'configurable',
                                'value' => 'simple',
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

        $get_product_highlight = [
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
                      ],
                      [
                        'filters' => [
                            [
                                'field' => 'status',
                                'value' => '1',
                                'condition_type' => 'eq',
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
                      [
                        'filters' => [
                            [
                                'field' => 'highlight',
                                'value' => '1',
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
        $get_product_highlight['storeId'] = "1";
        $get_product_highlight['currencyCode'] = "THB";

        $catalogs = [
            'rootCategoryId' => 1,
        ];

        $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
        $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token = json_decode(curl_exec($ch));

        $token_admin_text = session()->put('token_admin', $token);
        $get_session_all = \Session::all();


        // dd($get_session_all['token_admin']);

        $get_blocks_page = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=2&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';
        $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks_page);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['token_admin']));

            $sum_blocks = json_decode(curl_exec($ch));


            $ch = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['token_admin']));

            $blocks = json_decode(curl_exec($ch));

            $data['sum_blocks'] = $sum_blocks;

        $get_session_all = \Session::all();

        if(!empty($get_session_all['customer_id'])){
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . ($get_session_all['customer_id'])));

            $result2 = json_decode(curl_exec($ch));

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/".$result2->id."/carts");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $create_cart222 = json_decode(curl_exec($ch));


            if(empty($result2->parameters) || empty($create_cart222->parameters)){

                $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                $result3 = json_decode(curl_exec($ch));

                if(empty($result3->parameters)) {

                    $data['token_customer'] = $result2;
                    $data['cart_customer'] = $result3;

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

                } else {
                    $data['token_customer'] = $result2;
                    $data['cart_customer'] = '';
                    $data['color_product'] = '';
                    $data['size_products'] = '';
                }
            }
        }

        $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
        $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);
        $data['products_highlight'] = $get_products->catalogProductRepositoryV1GetList($get_product_highlight);
        $data['products2_highlight'] = $get_products2->catalogProductRenderListV1GetList($get_product_highlight);
        $data['category'] = $catalog->catalogCategoryManagementV1GetTree($catalogs);
        $data['blocks'] = $blocks;
        $data['page_title'] = 'Main';

        }catch(Exception $e){
          $data['products'] = $e->getMessage();
        }

        return view('index',$data);
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
}
