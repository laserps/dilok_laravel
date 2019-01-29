<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class TestapiController extends Controller
{
    protected $items;
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

        $get_blocks_page = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=2&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';
        $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks_page);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $sum_blocks = json_decode(curl_exec($ch));

            $ch = curl_init("http://128.199.235.248/magento/rest/V1/cmsBlock/search?".$get_blocks);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

            $blocks = json_decode(curl_exec($ch));

            $data['sum_blocks'] = $sum_blocks;

        $get_session_all = \Session::all();

        if(!empty($get_session_all['customer_id'])){
            $ch = curl_init("http://128.199.235.248/magento/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . ($get_session_all['customer_id'])));

            $result2 = json_decode(curl_exec($ch));

            if(empty($result2->parameters)){

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
        $data['category'] = $catalog->catalogCategoryManagementV1GetTree($catalogs);
        $data['blocks'] = $blocks;
        $data['page_title'] = 'Main';

        }catch(Exception $e){
          $data['products'] = $e->getMessage();
        }

        return view('testapi',$data);
    }

    public static function resize($realpath) {
        // $path = 'D:\TOTAL';
        // $asd = \App\Http\Controllers\TestapiController::getresize();
        // dd($asd);
        //decode_realpath

        // foreach($asd as $key => $value){
        //     echo $path.$value."<br/>";
        // }
        $realpath = base64_decode($realpath);
        // dd(memory_get_usage());

        //resize
        $getimageinfo = getimagesize($realpath);

        // dd($getimageinfo);
        if(!empty($getimageinfo)){
            //set variable
            $new_width = 1800;
            $width = $getimageinfo[0];
            $height = $getimageinfo[1];
            $resize_ratio = $new_width / $width;
            $new_height = $height * $resize_ratio;

            $image = $realpath;

            // create an image manager instance with favored driver
            $manager = new ImageManager(array('driver' => 'imagick'));
            // to finally create image instances
            // $image = $manager->make($image)->resize($new_width, $new_height)->save($image);
            if($width > 1800){
                $image = $image;
                // $image = \Image::make($image)->resize($new_width, $new_height)->save($image);
            } else {
                $image = '';
            }
            // dd($image);
        }
        echo "Image : ".$image;
        // $data['status'] = ($image==true) ? 'success' : 'error';
        // $data['data'] = $image;
        // return $data;
        // exit();
    }

       public static function getresize222()
    {
        $items = null;
        $path = 'D:\TOTAL';
        $folders = scandir($path);
        $results = null;
        if(count($folders)!=0){
            foreach($folders as $key => $folder){
                if($folder!='.' && $folder!='..' && $folder!='desktop.ini'  && $folder!='.DS_Store' && $folder!='Golf Move.mov'){
                    $infolders = scandir($path.'/'.$folder);
                    if(count($infolders)!=0){
                        $valuein=null;
                        foreach($infolders as $keyin => $infolder){
                            if($infolder!='.' && $infolder!='..' && $infolder!='desktop.ini' && $infolder!='.DS_Store'){
                                $valuein[] = $infolder;
                                $infolder = str_replace(" ","_",$infolder);
                                // $items[] = base64_encode($path.'/'.$folder.'/'.$infolder);
                                $items[] = base64_encode($path.'/'.$folder.'/'.$infolder);
                            }
                        }
                    }
                }
            }
        }
        $data['items'] = $items;
        return count($items)!=0 ? $data : null;
    }

    public static function getresize()
    {
        $items = array();
        $path = 'D:\TOTAL';
        $folders = scandir($path);
        $results = null;
        if(count($folders)!=0){
            foreach($folders as $key => $folder){
                $counts=0;

                if($folder!='.' && $folder!='..' && $folder!='desktop.ini'  && $folder!='.DS_Store'  && $folder!='Golf Move.mov'){
                    $infolders = scandir($path.'/'.$folder);
                    $value = str_replace("_","-",$folder);
                    $for = explode('.',$folder);
                    if(!empty($for[1])){
                        $for = $for[1];
                    }else{
                        $for = $folder;
                    }
                    if($folder != $value){
                        // echo $path.'/'.$folder. ' <br/> ' .$path.'/'.$for."<hr>";
                    // rename($path.'/'.$folder, $path.'/'.$value);
                    echo $path.'/'.$folder. ' <br/> ' .$path.'/'.$value."<hr>";
                    }
                    if(count($infolders)!=0){
                        $valuein=null;
                        foreach($infolders as $keyin => $infolder){
                            if($infolder!='.' && $infolder!='..' && $infolder!='desktop.ini' && $infolder!='.DS_Store'){
                                $for = explode('.',$folder);
                                if(!empty($for[1])){
                                    $for = $for[1];
                                }else{
                                    $for = $folder;
                                }
                                $valuein[] = $infolder;
                                $image_ee = str_replace(" ","_",$infolder);
                                // echo $path.'/'.$for.'/'.$image_ee."<br/>";

                        // echo ($for[1]."<br/>");
                        // echo (" Folder : ".$folder);
                                // if($infolder != $image_ee){
                                    // rename($path.'/'.$folder.'/'.$infolder, $path.'/'.$folder.'/'.$image_ee);
                                // }
                                $items[] = '/'.$for.'/'.$image_ee;
                                // $items[] = $path.'/'.$folder.'/'.$infolder .' => '. $path.'/'.$for.'/'.$image_ee;
                                // $items[] =  base64_encode($path.'/'.$folder.'/'.$image_ee);


                                // echo $image_ee."<br/>";
                            }
                        }

                        // echo $folder."<br/>";
                        // if(in_array($for,['1254123-001', '14061-HPLM', '14058-BLU'])){
                            // $counts = count(explode(',',str_replace('"','',str_replace('\\','',str_replace(']','',str_replace('[','',json_encode($items)))))))-1;
                            // $main_image = explode(',',str_replace('"','',str_replace('\\','',str_replace(']','',str_replace('[','',json_encode($items))))));
                            // $count = '';
                            // for($i=1;$i<=$counts;$i++){
                            //     $count .= ',';
                            // }
                            // $image_sum = str_replace('"','',str_replace('\\','',str_replace(']','',str_replace('[','',json_encode($items)))));

                            // $data_update = [
                            //     'base_image' => $main_image[0],
                            //     'small_image' => $main_image[0],
                            //     'thumbnail_image' => $main_image[0],
                            //     'swatch_image' => $main_image[0],
                            //     'additional_images' => $image_sum,
                            //     'additional_image_labels' => $count
                            // ];
                            // dd($data_update);
                            // echo  $for."<br>";
                            // $aa = \DB::table('dilok_import')->where('folder',$for)->update($data_update);
                            // $count = '';

                            // echo $folder."<br/>";
                            // echo $main_image[0]."<br/>";
                            // echo $infolder."<br/>";
                            // echo $key.".".$image_sum."<hr>";
                        // }
                        // $items = null;
                        // $aa = \DB::table('image')->where('folder',$folder)->Paginate(10);
                        // dd($image_sum,$count,$main_image[0],$data_update);
                        // dd($data_update);
                        // dd($data_update,$aa);
                        // $image_sum = '';
                        // $data_update = '';
                        // echo $folder." : ";
                        // echo $count."<br>";
                        // return dd($image_sum,$count,$main_image[0],$data_update);
                        // return $items;

                    }
                }

            }

        }
        // return json_encode($items);
        // dd($aa);
        // return response()->json([
            // 'path' => $items
        // ]);
        // $return['title'] = $items;
        // $aa['aa'] = $items;
        // $data['items'] = $items;
        // return dd($data);


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
