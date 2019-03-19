<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpfulController extends Controller
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

    public function add_blank(){
        try {
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

            $size = curl_init("http://128.199.235.248/magento/rest//V1/products/attributes/size/options");
            curl_setopt($size, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($size, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($size, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $color = curl_init("http://128.199.235.248/magento/rest//V1/products/attributes/color/options");
            curl_setopt($color, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($color, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($color, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            //เรียกข้อมูล block
            $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

            $blocks = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks);
            curl_setopt($blocks, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($blocks, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($blocks, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            curl_multi_add_handle($mh, $categories);
            curl_multi_add_handle($mh, $size);
            curl_multi_add_handle($mh, $color);
            curl_multi_add_handle($mh, $blocks);

            $running = null;
            do {
                curl_multi_exec($mh, $running);
            } while ($running);


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

                $data['size_products'] = json_decode(curl_multi_getcontent($size));
                $data['color_product'] = json_decode(curl_multi_getcontent($color));

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

        $data['category'] = json_decode(curl_multi_getcontent($categories));
        $data['blocks'] = json_decode(curl_multi_getcontent($blocks));
        $data['page_title'] = 'Policy';

        } catch (Exception $e) {
            $data['products'] = $e->getMessage();
        }

        return view('add-blank',$data);
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
