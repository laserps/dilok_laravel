<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('testapi');
    }

    public function postapidilok(Request $request){
        dd($request->all());
        exit();
    }

    public function testsoap(){
        try {
            $opts = array(
                'http' => array(
                    'user_agent' => 'PHPSoapClient'
                )
            );
            $context = stream_context_create($opts);

            $wsdlUrl = 'http://localhost/dilok/api/soap/?wsdl';
            $soapClientOptions = array(
                // 'stream_context' => $context,
                'trace' => true,
                'cache_wsdl' => WSDL_CACHE_NONE
            );

            $client = new \SoapClient($wsdlUrl, $soapClientOptions);

            $checkVatParameters = array(
                'countryCode' => 'DK',
                'vatNumber' => '47458714'
            );

            $result = $client->checkVat($checkVatParameters);
            print_r($result);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function testsoap2(){
        return view('testsoap');
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

    // CURLOPT_POSTFIELDS
    public function testrest(){
        $userData = array("username" => "admin", "password" => "Osaklang8136");
        $ch = curl_init("http://localhost/wb_magento/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));
        
        $token = curl_exec($ch);
        // return $token;
        
        $ch = curl_init("http://localhost/wb_magento/rest/V1/customers/2");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));
        
        $result = curl_exec($ch);
        
        return $result;
    }

    public function testrestpost(){
        // $value = {
        //     "id":2,
        //     "group_id":1,
        //     "default_billing":"2",
        //     "default_shipping":"2",
        //     "created_at":"2018-10-10 05:51:16",
        //     "updated_at":"2018-10-10 05:53:45",
        //     "created_in":"Default Store View",
        //     "dob":"1989-10-22",
        //     "email":"MOsaklang@gmail.com",
        //     "firstname":"Napat",
        //     "lastname":"Osaklang",
        //     "gender":1,
        //     "store_id":1,
        //     "website_id":1,
        //     "addresses":[
        //         {
        //             "id":2,
        //             "customer_id":2,
        //             "region":{"region_code":null,"region":null,"region_id":0},
        //             "region_id":0,
        //             "country_id":"TH",
        //             "street":["137"],
        //             "telephone":"0917161124",
        //             "postcode":"30000",
        //             "city":"Nakhon Ratjasima",
        //             "firstname":"Napat",
        //             "lastname":"Osaklang",
        //             "default_shipping":true,
        //             "default_billing":true
        //         }
        //     ],
        //     "disable_auto_group_change":1,
        //     "extension_attributes":{"is_subscribed":false}
        // };
        $value = [
            "id" => 1,
            "group_id" => 1,
            "default_billing" => "2",
            "default_shipping" => "2",
            "created_at" => "2018-10-10 05:51:16",
            "updated_at" => "2018-10-10 05:53:45",
            "created_in" => "Default Store View",
            "dob" => "1989-10-22",
            "email" => "MOsaklang2@gmail.com",
            "firstname" => "Napat",
            "lastname" => "Osaklang",
            "gender" => 1,
            "store_id" => 1,
            "website_id" => 1,
            "addresses" => [
                [
                    "id" => 1,
                    "customer_id" => 3,
                    "region" => ["region_code" => null,"region" => null,"region_id" => 0],
                    "region_id" => 0,
                    "country_id" => "TH",
                    "street" => ["137"],
                    "telephone" => "0917161124",
                    "postcode" => "30000",
                    "city" => "Nakhon Ratjasima",
                    "firstname" => "Napat",
                    "lastname" => "Osaklang",
                    "default_shipping" => true,
                    "default_billing" => true
                ]
            ],
            "disable_auto_group_change" => 1,
            "extension_attributes" => ["is_subscribed" => false]
        ];
        // return $value;
        // /V1/customers
        // $userData = array("username" => "admin", "password" => "Osaklang8136");
        $ch = curl_init("http://localhost/wb_magento/rest/V1/customers");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($value));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($value))));
        
        $token = curl_exec($ch);
        return $token;
        
        // return $result;
    }
}
