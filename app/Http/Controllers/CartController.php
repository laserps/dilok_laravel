<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
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
        $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
        $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token_admin = json_decode(curl_exec($ch));

        $text_color_product = $request->input('text_color_product');
        $text_size_product = $request->input('text_size_product');
        $text_name_product = $request->input('text_name_product');
        $text_price_product = $request->input('text_price_product');
        $text_valuecolor_product = $request->input('text_valuecolor_product');
        $text_valuesize_product = $request->input('text_valuesize_product');
        $text_type_product = $request->input('text_type_product');

        $get_session_all = \Session::all();

        try {
            if(!empty($get_session_all['customer_id'])){
                // if($text_color_product != '' && $text_size_product != '' && $text_name_product != '' && $text_price_product != '' && $text_valuecolor_product != '' && $text_valuesize_product != ''){
                    $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                    $customer = json_decode(curl_exec($ch));

                    $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                    $create_cart = json_decode(curl_exec($ch));

                    if($text_type_product == 'configurable'){
                        $product = [
                            "cartItem" => [
                                "sku"=> $text_name_product,
                                "qty"=> 1,
                                "name" => $text_name_product,
                                "price" => $text_price_product,
                                "product_type" => "configurable",
                                "quote_id"=> $create_cart,
                                "product_option" => [
                                    "extension_attributes" => [
                                        "configurable_item_options" => [
                                            [
                                                "option_id" => "93",
                                                "option_value" => $text_valuecolor_product
                                            ],
                                            [
                                                "option_id" => "135",
                                                "option_value" => $text_valuesize_product
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ];
                    } else {
                        $product = [
                            "cartItem" => [
                                "sku"=> $text_name_product,
                                "qty"=> 1,
                                "name" => $text_name_product,
                                "price" => $text_price_product,
                                "product_type" => "simple",
                                "quote_id"=> $create_cart,
                            ]
                        ];
                    }

                    // dd($product);
                    // exit();


                    $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($product));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                    $add_product_to_cart = json_decode(curl_exec($ch));

                    if(!empty($add_product_to_cart->message)){
                        if($add_product_to_cart->message == 'This product is out of stock.'){
                            $return['status'] = 3;
                            $return['content'] = 'สินค้าหมด';
                        }
                    } else {
                        $return['result'] = $create_cart;
                        $return['status'] = 1;
                        $return['content'] = 'เพิ่มสินค้าสำเร็จ';
                    }

                // } else {
                //     $return['status'] = 0;
                //     $return['content'] = 'กรุณาเลือกประเภทสินค้าให้ถูกต้อง';
                // }
            } else {
                \Session::flush();
                $return['status'] = 2;
                $return['content'] = 'กรุณาล็อกอินเข้าสู่ระบบ';
            }
        } catch(Exception $e){
          $return['error'] = 'Error';
        }

        return json_encode($return);




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
