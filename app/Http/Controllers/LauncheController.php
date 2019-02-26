<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LauncheController extends Controller
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
            'connection_timeout' => 180,
            'stream_context' => stream_context_create($opts),
            'cache_wsdl' => WSDL_CACHE_NONE
        );

        try{
            //เรียก size & color ทั้งหมด
            $get_type_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);

            $get_size_products = [
                'attributeCode' => 'size',
            ];

            $get_color_product = [
                'attributeCode' => 'color',
            ];

        $get_session_all = \Session::all();

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
            } else {
                $data['token_customer'] = '';
                $data['login'] = '';
                $data['cart_customer'] = '';
            }

        $data['color_product'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_color_product);
        $data['size_products'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_size_products);
        $data['page_title'] = 'Launches';

        } catch (Exception $e){
          $data['products'] = $e->getMessage();
        }

        return view('launches',$data);
    }

    public function detail(){
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
        //เรียกข้อมูลสินค้า
        $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
        //เรียกข้อมูลสินค้า
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

        //เรียก size & color ทั้งหมด
        $get_type_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);

            $get_size_products = [
                'attributeCode' => 'size',
            ];

            $get_color_product = [
                'attributeCode' => 'color',
            ];

        $get_session_all = \Session::all();

        if(!empty($get_session_all['customer_id'])){
            //เรีขกข้อมูล customer
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

                $result3 = json_decode(curl_exec($ch));

                if(empty($result3->parameters)) {

                    $data['token_customer'] = $customer_me;
                    $data['login'] = $customer_me;
                    $data['cart_customer'] = $result3;

                    //เรียกข้อมูลสินค้า
                    $get_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductRepositoryV1',$params);

                        foreach($result3 as $key => $value){
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

            $data['color_product'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_color_product);
            $data['size_products'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_size_products);
            $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
            $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);
            $data['page_title'] = 'LaunchesDetail';
        }catch(Exception $e){
          $data['products'] = $e->getMessage();
        }

        return view('launches-detail',$data);
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
