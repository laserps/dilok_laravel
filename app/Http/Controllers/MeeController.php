<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeeController extends Controller
{
    public function addCustomer(){
        $value =
        [
            "customer"=>[
                'email' => 'tes2t@test.com',
                'firstname' => 'firstname',
                'lastname' => 'lastname',
                'website_id' => 1,
                'store_id' => 1,
                'group_id' => 1,
                "default_billing" => 1,
                "default_shipping" => 1,
                "gender"=> 0,
                "created_at" => "2018-09-24 06:48:56",
                "updated_at" => "2018-09-24 06:48:56",
                "created_in" => "Default Store View",
                "addresses"=> [
                    [
                        "id" => 0,
                        "customer_id" => 7,
                        "region" => ["region_code" => null,"region" => null,"region_id" => 0],
                        "region_id" => 0,
                        "country_id" => "TH",
                        "street" => ["137"],
                        "telephone" => "0917161124",
                        "postcode" => "30000",
                        "city" => "Nakhon Ratjasima",
                        "firstname" => "Napat",
                        "lastname" => "Osaklang",
                        "middlename"=> "string",
                        "prefix"=> "string",
                        "suffix"=> "string",
                        "vat_id"=> "string",
                        "default_shipping"=> false,
                        "default_billing"=> false,
                        "extension_attributes"=> [],
                        "custom_attributes"=> [
                            [
                            "attribute_code"=> "string",
                            "value"=> "string"
                            ]
                        ]
                    ],
                    [
                        "id" => 1,
                        "customer_id" => 7,
                        "region" => ["region_code" => null,"region" => null,"region_id" => 0],
                        "region_id" => 0,
                        "country_id" => "TH",
                        "street" => ["137"],
                        "telephone" => "0917161124",
                        "postcode" => "30000",
                        "city" => "Nakhon Ratjasima",
                        "firstname" => "Napat",
                        "lastname" => "Osaklang",
                        "middlename"=> "string",
                        "prefix"=> "string",
                        "suffix"=> "string",
                        "vat_id"=> "string",
                        "default_shipping"=> true,
                        "default_billing"=> true,
                        "extension_attributes"=> [],
                        "custom_attributes"=> [
                            [
                            "attribute_code"=> "string",
                            "value"=> "string"
                            ]
                        ]
                    ]

                ],
            ]
        ];

        $userData = array("username" => "dilok", "password" => "dilok@01");
        $ch = curl_init("http://localhost/dilok2/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token = curl_exec($ch);
        curl_close($ch);
        // return $token;

        $chch = curl_init("http://localhost/wb_magento/rest/default/V1/customers/7");
        curl_setopt($chch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " .
        json_decode($token)));
        // curl_setopt($chch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($chch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($chch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chch, CURLOPT_POSTFIELDS, json_encode($value));


        $chch = curl_init("http://localhost/dilok2/rest/all/V1/customers");
        curl_setopt($chch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($chch, CURLOPT_POSTFIELDS, json_encode($value));
        curl_setopt($chch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));

        $result = curl_exec($chch);
        curl_close($chch);
        return $result;

    }
}