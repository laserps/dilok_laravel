<?php
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
// $tokenadmin = new SoapClient('http://192.168.1.27/dilok/soap/default?wsdl&services=integrationAdminTokenServiceV1',$params);
// $request = new SoapClient('http://192.168.1.27/dilok/soap/default?wsdl&services=directoryCurrencyInformationAcquirerV1',$params);
// $create_customers = new SoapClient('http://192.168.1.27/dilok/soap/default?wsdl&services=customerAccountManagementV1',$params);
$create_customers2 = new SoapClient('http://192.168.1.27/dilok/soap/default?wsdl&services=customerGroupRepositoryV1,customerGroupManagementV1,customerCustomerMetadataV1,customerAddressMetadataV1,customerCustomerRepositoryV1,customerAccountManagementV1,customerAddressRepositoryV1',$params);
$login_customer = new SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=integrationCustomerTokenServiceV1',$params);
// $get_currency = new SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=directoryCurrencyInformationAcquirerV1',$params);
$get_products = new SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
$get_products2 = new SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRenderListV1',$params);
$get_products_link = new SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=configurableProductLinkManagementV1',$params);
$get_products_option = new SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=configurableProductOptionRepositoryV1',$params);
$get_stock_product = new SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogInventoryStockRegistryV1',$params);
$get_type_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);
$category = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogCategoryManagementV1',$params);
$category2 = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogCategoryRepositoryV1',$params);
// $login_customer22 = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl_list&services=catalogCategoryRepositoryV1',$params);
// $get_products_type = new SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=quoteGuestCartRepositoryV1',$params);

// $get_products_gallerys = new \SoapClient('http://192.168.1.27/dilok/soap/default?wsdl&services=catalogProductAttributeMediaGalleryManagementV1',$params);
// $catalog = new \SoapClient('http://192.168.1.27/dilok/soap/default?wsdl&services=catalogCategoryManagementV1',$params);

// $soapResponse = $create_customers2->__getFunctions();

// $test = array(
// 	'username' => 'dilok',
// 	'password' => 'dilok@01'
// );
// $tokenadmin = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=integrationAdminTokenServiceV1',array("soap_version" => SOAP_1_2));
// $admin_token = $tokenadmin->integrationAdminTokenServiceV1CreateAdminAccessToken($test);

//         dd($test);
//         exit();

// dd($soapResponse);
// exit();
$get_session_all = \Session::all();

$userData = array("username" => "customer", "password" => "customer@01");
$ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

$token_admin = json_decode(curl_exec($ch));
$get_session_all = \Session::all();

$ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all[0]));

$result2 = json_decode(curl_exec($ch));

dd($result2);
exit();

foreach($result2->addresses as $key => $value){
    $address_value[$key] = [
        "id" => $value->id,
        "customer_id" => $value->customer_id,
        "region" => [
          "region_code" => $value->region->region_code,
          "region" => $value->region->region,
          "region_id" => $value->region->region_id,
        ],
        "region_id" => $value->region_id,
        "country_id" => $value->country_id,
        "street" => $value->street,
        "company" => $value->company,
        "telephone" => $value->telephone,
        "postcode" => $value->postcode,
        "city" => $value->city,
        "firstname" => $value->firstname,
        "lastname" => $value->lastname,
    ];
}

dd($address_value);



$customer['customer'] = array(
            'email' => 'banjong_147@hotmail.com',
            'firstname' => 'banjong',
            'lastname' => 'limkluea',
            'website_id' => 1,
            'store_id' => 1,
            'group_id' => 1,
            'addresses' =>
                  // [
                    array(
                    // "id" => 72,
                    "customer_id" => 72,
                    "region" => array(
                      "region_code" => "string",
                      "region" => "Bankok",
                      "region_id" => 0,
                      "extension_attributes" => array(),
                    ),
                    "region_id" => 0,
                    "country_id" => "TH",
                    "street" =>
                        [
                          "404 Main Street",
                          "PO Box 321",
                      ],
                    "company" => "workbythai",
                    "telephone" => "0857000516",
                    "fax" => "",
                    "postcode" => "10800",
                    "city" => "Bankok",
                    "firstname" => 'banjong',
                    "lastname" => 'limkluea',
                    "middlename" => "",
                    "prefix" => "",
                    "suffix" => "",
                    "vat_id" => "",
                    "default_shipping" => true,
                    "default_billing" => true,
                    "extension_attributes" => array(),
                    "custom_attributes" => array(
                        "attribute_code" => "23",
                        "value" => "bbb"
                    ),
                    ),
                  // ],
                  // "disable_auto_group_change" => 0,
                  // "extension_attributes" => array(
                  //   "is_subscribed" =>  true
                  // ),
                  // "custom_attributes" => [
                  //   array(
                  //     "attribute_code" => "23",
                  //     "value" => "bbb"
                  //   ),
                  // ]
        );

// $soapResponse = $address_customer->__getFunctions();

// return dd(json_encode($customer));
// exit();

	// $admin_token = $tokenadmin->integrationAdminTokenServiceV1CreateAdminAccessToken(array('username' => 'workbythai01', 'password' => 'workbythai@01'));
	// $currency = $get_currency->directoryCurrencyInformationAcquirerV1GetCurrencyInfo();
	// $create_customer_email = $create_customers->customerAccountManagementV1IsEmailAvailable(array('customerEmail' => 'hamworkbythai2@gmail.com'));

	// $customer['customer'] = array(
	// 	'email' => 'test01@hotmail.com',
	// 	'firstname' => 'banjong',
	// 	'lastname' => 'limkluea',
	// 	'website_id' => 1,
	// 	'store_id' => 1,
	// 	'group_id' => 1
	// );
	// $customer['password'] = "Whitestar01";
	// $create_customer = $create_customers->customerAccountManagementV1CreateAccount($customer);

	$login_customers = array(
		'username' => 'hamworkbythai@gmail.com',
		'password' => 'Whitestar01'
	);

	// dd($currency);
	// exit();

	// $get_token_login = $login_customer->integrationCustomerTokenServiceV1CreateCustomerAccessToken(array('username' => 'hamworkbythai@gmail.com','password' => 'Whitestar01'));
	$get_token_login = $login_customer->integrationCustomerTokenServiceV1CreateCustomerAccessToken($login_customers);
	// $get_customer = $create_customers->customerAccountManagementV1ValidateResetPasswordLinkToken(array('customerId' => '2' , 'resetPasswordLinkToken' => '3afcab3761a3230e9b2bf2a91174b5ab'));

	// dd($get_token_login);
	// exit();

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
        'currentPage' => 12,
    ],
];
$get_product_page['storeId'] = "1";
$get_product_page['currencyCode'] = "THB";
$option_product = array(
	'sku' => 'Nike Roshe One'
);
$get_stock_products = array(
	'productSku' => 'Nike Roshe One-WHITE-6'
);
$get_color_product = [
    'attributeCode' => 'color',
];
// $get_products_gallery = [
//     'sku' => 'product1',
// ];
// $catalogs = [
//     'rootCategoryId' => 1,
// ];
$login_customer = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=integrationCustomerTokenServiceV1',$params);

$login_customers = array(
    'username' => 'hamworkbythai@gmail.com',
    'password' => 'Whitestar01'
);

        // $token = $login_customer->integrationCustomerTokenServiceV1CreateCustomerAccessToken($login_customers);


	// $get_product = $get_products->catalogProductRepositoryV1GetList($get_product_page);
	// $get_product2 = $get_products2->catalogProductRenderListV1GetList($get_product_page);
	// $get_product3 = $get_products_link->configurableProductLinkManagementV1GetChildren($option_product);
	// $get_product4 = $get_products_option->configurableProductOptionRepositoryV1GetList($option_product);
	// $get_product5 = $get_stock_product->catalogInventoryStockRegistryV1GetStockStatusBySku($get_stock_products);
    // $get_product6 = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_color_product);
    // $cat = $category->catalogCategoryManagementV1GetTree(array('rootCategoryId'=>'1'));
    // $cat2 = $category2->catalogCategoryRepositoryV1Get(array('categoryId'=> '3'));
    // $tt = $login_customer22->customerAccountManagementV1ValidateResetPasswordLinkToken(array('customerId'=> '1' , 'resetPasswordLinkToken' => $token->result));
	// $get_product = $get_products->configurableProductLinkManagementV1GetChildren(array('sku'=>'Mj01'));
	// $get_product_types = $get_products_type->quoteGuestCartRepositoryV1Get(array('cartId'=>'1'));
    // $get_products_gallerys = $get_products_gallerys->catalogProductAttributeMediaGalleryManagementV1GetList($get_products_gallery);
    // $get_catalog = $catalog->catalogCategoryManagementV1GetTree($catalogs);
	// dd($get_product,$get_products_gallerys,$get_catalog);
	// dd($get_product,$get_product2,$get_product3,$get_product4,$get_product5,$get_product6,$cat,$cat2);
	// dd($cat,$cat2);
	// dd($get_product2->result->items->item[1]);
	// dd($create_customer);

}catch(Exception $e){
	echo $e->getMessage();
}
?>