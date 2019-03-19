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
        //การดึงค่า admin token
        header("Cache-Control: max-age=60"); //30days (60sec)

        $token_admin = $this->login_admin_magento();
        session()->put('token_admin', $token_admin);

        $mtime = microtime();
        $mtime = explode(" ",$mtime);
        $mtime = $mtime[1] + $mtime[0];
        $starttime = $mtime;

        $mh = curl_multi_init();
            //เรียกหมวดหมู่
            // $catalog = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogCategoryManagementV1',$params);

            $categories = curl_init("http://128.199.235.248/magento/rest/V1/categories?rootCategoryId=1");
            curl_setopt($categories, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($categories, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($categories, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));

            //เรียกข้อมูลสินค้า
            // $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);

            $filter_get_products = '?searchCriteria[pageSize]=20&searchCriteria[currentPage]=1&searchCriteria[filterGroups][0][filters][0][field]=type_id&searchCriteria[filterGroups][0][filters][0][value]=configurable&searchCriteria[filterGroups][0][filters][0][conditionType]=eq';

            $filter_get_products_price = '?storeId=1&currencyCode=THB&searchCriteria[pageSize]=20&searchCriteria[currentPage]=1&searchCriteria[filterGroups][0][filters][0][field]=type_id&searchCriteria[filterGroups][0][filters][0][value]=configurable&searchCriteria[filterGroups][0][filters][0][conditionType]=eq';

            $get_products = curl_init("http://128.199.235.248/magento/rest/V1/products".$filter_get_products);
            curl_setopt($get_products, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($get_products, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($get_products, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));
            // $getconfigproduct = json_decode(curl_exec($get_products));

            $get_products_price = curl_init("http://128.199.235.248/magento/rest/V1/products-render-info".$filter_get_products);
            curl_setopt($get_products_price, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($get_products_price, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($get_products_price, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));
            // $getconfigproduct = json_decode(curl_exec($get_products_price));


            //เรียกข้อมูลสินค้า
            // $get_products2 = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRenderListV1',$params);
            $filter_get_products2 = '?searchCriteria[pageSize]=20&searchCriteria[filterGroups][0][filters][0][field]=visibility&searchCriteria[filterGroups][0][filters][0][value]=4&searchCriteria[filterGroups][0][filters][0][conditionType]=eq&searchCriteria[filterGroups][2][filters][0][field]=type_id&searchCriteria[filterGroups][2][filters][0][value]=configurable&searchCriteria[filterGroups][2][filters][0][conditionType]=eq&searchCriteria[filterGroups][3][filters][0][field]=highlight&searchCriteria[filterGroups][3][filters][0][value]=1&searchCriteria[filterGroups][3][filters][0][conditionType]=eq&searchCriteria[filterGroups][1][filters][0][field]=status&searchCriteria[filterGroups][1][filters][0][value]=1&searchCriteria[filterGroups][1][filters][0][conditionType]=eq';

            $filter_get_products2_price = '?storeId=1&currencyCode=THB&searchCriteria[pageSize]=20&searchCriteria[filterGroups][0][filters][0][field]=visibility&searchCriteria[filterGroups][0][filters][0][value]=4&searchCriteria[filterGroups][0][filters][0][conditionType]=eq&searchCriteria[filterGroups][2][filters][0][field]=type_id&searchCriteria[filterGroups][2][filters][0][value]=configurable&searchCriteria[filterGroups][2][filters][0][conditionType]=eq&searchCriteria[filterGroups][3][filters][0][field]=highlight&searchCriteria[filterGroups][3][filters][0][value]=1&searchCriteria[filterGroups][3][filters][0][conditionType]=eq&searchCriteria[filterGroups][1][filters][0][field]=status&searchCriteria[filterGroups][1][filters][0][value]=1&searchCriteria[filterGroups][1][filters][0][conditionType]=eq';

            $get_products2 = curl_init("http://128.199.235.248/magento/rest/V1/products".$filter_get_products2);
            curl_setopt($get_products2, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($get_products2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($get_products2, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));
            // $getconfigproduct = json_decode(curl_exec($get_products2));

            $get_products2_price = curl_init("http://128.199.235.248/magento/rest/V1/products-render-info".$filter_get_products2_price);
            curl_setopt($get_products2_price, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($get_products2_price, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($get_products2_price, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));
            // $getconfigproduct = json_decode(curl_exec($get_products2_price));

            //เรียกข้อมูล block
            $get_blocks_page = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=2&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

            //เรียกข้อมูล block
            $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

            // API sum_blocks
            $sum_blocks = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks_page);
            curl_setopt($sum_blocks, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($sum_blocks, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($sum_blocks, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));
            // $sum_blocks = json_decode(curl_exec($sum_blocks));

            // API blocks
            $blocks = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks);
            curl_setopt($blocks, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($blocks, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($blocks, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));
            // $blocks = json_decode(curl_exec($blocks));
            // $data['sum_blocks'] = $sum_blocks;

            $size = curl_init("http://128.199.235.248/magento/rest//V1/products/attributes/size/options");
            curl_setopt($size, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($size, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($size, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));

            $color = curl_init("http://128.199.235.248/magento/rest//V1/products/attributes/color/options");
            curl_setopt($color, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($color, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($color, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));

            curl_multi_add_handle($mh, $categories);
            curl_multi_add_handle($mh, $get_products);
            curl_multi_add_handle($mh, $get_products_price);
            curl_multi_add_handle($mh, $get_products2);
            curl_multi_add_handle($mh, $get_products2_price);
            curl_multi_add_handle($mh, $sum_blocks);
            curl_multi_add_handle($mh, $blocks);
            curl_multi_add_handle($mh, $size);
            curl_multi_add_handle($mh, $color);

            $running = null;
            do {
                curl_multi_exec($mh, $running);
            } while ($running);

            // $data['category'] = json_decode(curl_multi_getcontent($categories));
            // $data['products'] = json_decode(curl_multi_getcontent($get_products));
            // $data['products2'] = json_decode(curl_multi_getcontent($get_products_price));
            // $data['products_highlight'] = json_decode(curl_multi_getcontent($get_products2));
            // $data['products2_highlight'] = json_decode(curl_multi_getcontent($get_products2_price));
            // $data['blocks'] = json_decode(curl_multi_getcontent($blocks));
            // $data['sum_blocks'] = json_decode(curl_multi_getcontent($sum_blocks));

            $data['category'] = json_decode(curl_multi_getcontent($categories));
            $data['products'] = json_decode(curl_multi_getcontent($get_products));
            $data['products2'] = json_decode(curl_multi_getcontent($get_products_price));
            $data['products_highlight'] = json_decode(curl_multi_getcontent($get_products2));
            $data['products2_highlight'] = json_decode(curl_multi_getcontent($get_products2_price));
            $data['blocks'] = json_decode(curl_multi_getcontent($blocks));
            $data['sum_blocks'] = json_decode(curl_multi_getcontent($sum_blocks));

            // $mtime = microtime();
            // $mtime = explode(" ",$mtime);
            // $mtime = $mtime[1] + $mtime[0];
            // $endtime = $mtime;
            // $totaltime = ($endtime - $starttime);
            // $data[] = "หน้านี้ประมวลผล ".$totaltime." วินาที";
            // dd($data);

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

            $get_product_page = [
                'searchCriteria' => [
                    'filterGroups' => [
                        [
                            'filters' => [
                                [
                                    'field' => 'visibility', //การมองเห็น
                                    'value' => '4', //1 Not //2 Catalog //3 search //4 catalog , search
                                    'condition_type' => 'eq', // =
                                ],
                            ],
                            'filters' => [
                                [
                                    'field' => 'status', // status
                                    'value' => '1', //1 , 0
                                    'condition_type' => 'eq',
                                ],
                            ],
                            'filters' => [
                                [
                                    'field' => 'type_id', // ประเภท
                                    // 'value' => 'configurable', // ตัวแม่
                                    'value' => 'simple', // ตัวลูก
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

            $get_session_all = \Session::all();

            $token_admin_magento = new HomeController;

            if(!empty($get_session_all['token_admin'])){
                $token = $get_session_all['token_admin'];
            } else {
                $token = $token_admin_magento->login_admin_magento();
            }

            if(!empty($get_session_all['customer_id'])){
                //เรียกข้อมูล customer
                $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . ($get_session_all['customer_id'])));
                $result2 = json_decode(curl_exec($ch));

                if(empty($result2->parameters)){
                        //สร้างตะกร้าสินค้า
                        $create_cart222 = curl_init("http://128.199.235.248/magento/rest/V1/customers/".$result2->id."/carts");
                        curl_setopt($create_cart222, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($create_cart222, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($create_cart222, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));
                        $create_cart222 = json_decode(curl_exec($create_cart222));

                        //เรียกข้อมูลตะกร้าสินค้า
                        $result3 = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
                        curl_setopt($result3, CURLOPT_CUSTOMREQUEST, "GET");
                        curl_setopt($result3, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($result3, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));
                        $result3 = json_decode(curl_exec($result3));

                        if(empty($result3->parameters)) {

                            $data['token_customer'] = $result2;
                            $data['cart_customer'] = $result3;

                            //เรียกข้อมูลสินค้า
                            $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);

                            foreach($result3 as $key => $value){
                            $get_key_product = array(
                                'sku' => $value->sku
                            );

                            $data['product_key'][$key] = $get_products->catalogProductRepositoryV1Get($get_key_product);
                            }

                            $data['size_products'] = json_decode(curl_multi_getcontent($size));
                            $data['color_product'] = json_decode(curl_multi_getcontent($color));

                        } else {
                            $data['token_customer'] = $result2;
                            $data['cart_customer'] = '';
                            $data['color_product'] = '';
                            $data['size_products'] = '';
                        }
                    }
            }


            // $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
            // $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);
            // $data['products_highlight'] = $get_products->catalogProductRepositoryV1GetList($get_product_highlight);
            // $data['products2_highlight'] = $get_products2->catalogProductRenderListV1GetList($get_product_highlight);
            // $data['category'] = $catalog->catalogCategoryManagementV1GetTree($catalogs);
            // $data['blocks'] = $blocks;

        }catch(Exception $e){
          $data['products'] = $e->getMessage();
        }

        return view('index',$data);
    }

    public function login_admin_magento(){
        //login admin magento
        $token = session('token_admin');
        if(!isset($token)){
            $admin_magento = array("username" => "customerdilok", "password" => "dilokstore@1234");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($admin_magento));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($admin_magento))));

            $token = json_decode(curl_exec($ch));
            session()->put('token_admin', $token);
            return $token;
        }else{
            return session('token_admin');
        }

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
