<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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


            $userData = array("username" => "customer", "password" => "customer@01");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token_admin = json_decode(curl_exec($ch));

            if(!empty($_GET)){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $get_blocks_page = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=6&searchCriteria[currentPage]='.$page.'';
            $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));

            $blocks = json_decode(curl_exec($ch));

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks_page);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));

            $sum_blocks = json_decode(curl_exec($ch));

            $data['sum_blocks'] = $sum_blocks;

            $get_type_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);
            $get_size_products = [
                'attributeCode' => 'size',
            ];

            $get_color_product = [
                'attributeCode' => 'color',
            ];

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

                $data['color_product'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_color_product);
                $data['size_products'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_size_products);

            } else {
                \Session::flush();
                return redirect('/');
            }
        } else {
            $data['token_customer'] = '';
            $data['cart_customer'] = '';
            $data['color_product'] = '';
            $data['size_products'] = '';
            // $data['sum_blocks'] = '';
        }

        $data['category'] = $catalog->catalogCategoryManagementV1GetTree($catalogs);
        $data['blocks'] = $blocks;
        $data['page_title'] = 'Block';

        } catch (Exception $e) {
            $data['products'] = $e->getMessage();
        }

        return view('blog',$data);
    }

    public function detailblog($id_block){
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
            $get_type_products = new \SoapClient('http://128.199.235.248/magento/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);
            $get_size_products = [
                'attributeCode' => 'size',
            ];

            $get_color_product = [
                'attributeCode' => 'color',
            ];
            $catalogs = [
                'rootCategoryId' => 1,
            ];

            $userData = array("username" => "customer", "password" => "customer@01");
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

            $token_admin = json_decode(curl_exec($ch));

            $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));

            $blocks = json_decode(curl_exec($ch));

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/".$id_block);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token_admin));

            $sum_blocks = json_decode(curl_exec($ch));

            $data['sum_blocks'] = $sum_blocks;

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

                $data['color_product'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_color_product);
                $data['size_products'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_size_products);

            } else {
                \Session::flush();
                return redirect('/');
            }
        } else {
            $data['token_customer'] = '';
            $data['cart_customer'] = '';
            $data['color_product'] = '';
            $data['size_products'] = '';
        }

        $data['category'] = $catalog->catalogCategoryManagementV1GetTree($catalogs);
        $data['blocks'] = $blocks;
        $data['page_title'] = 'BlockDetail';

        } catch (Exception $e) {
            $data['products'] = $e->getMessage();
        }

        return view('detailblog',$data);
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
