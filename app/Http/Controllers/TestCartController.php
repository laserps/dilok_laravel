<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestCartController extends Controller
{
    public function index(){
        $userData = array("username" => "customerdilok", "password" => "dilokstore@1234");
        $ch = curl_init("http://128.199.235.248/magento/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));
        $token = json_decode(curl_exec($ch));
        $customer_token = \Session::get('customer_id');

        //create new cart
        $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $customer_token));
        $new_cart = json_decode(curl_exec($ch));

        //setting item for cart
        $item = [
            "cartItem" => [
                "sku"=> 'Nike Roshe One-BLACK-8',
                "qty"=> 1,
                "name" => 'Nike Roshe One-BLACK-8',
                "price" => 1,
                "product_type" => "simple",
                "quote_id"=> $new_cart,
            ]
        ];
        
        //save item to cart
        $ch = curl_init("http://128.199.235.248/magento/rest/V1/carts/mine/items");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($item));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $customer_token));
        $now_cart = json_decode(curl_exec($ch));

        dd($new_cart,$now_cart);
    }
}
