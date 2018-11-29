<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
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

    public function detail($id){
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
          $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
          $get_products2 = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRenderListV1',$params);
          $get_products_gallerys = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductAttributeMediaGalleryManagementV1',$params);
          $get_color_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);
          $get_products_option = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=configurableProductOptionRepositoryV1',$params);
          $get_stock_product = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogInventoryStockRegistryV1',$params);
          $catalog = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogCategoryManagementV1',$params);

          $get_product_detail = [
              'searchCriteria' => [
                  'filterGroups' => [
                      [
                          'filters' => [
                              [
                                  'field' => 'entity_id',
                                  'value' => $id,
                                  'condition_type' => 'eq',
                              ],
                          ],
                      ],
                  ],
              ],
          ];
          $get_product_detail['storeId'] = "1";
          $get_product_detail['currencyCode'] = "THB";
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

          $get_color_product = [
              'attributeCode' => 'color',
          ];

          $get_size_products = [
              'attributeCode' => 'size',
          ];

          $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
          $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);
          $data['products3'] = $get_products2->catalogProductRenderListV1GetList($get_product_detail);
          $data['products_detail'] = $get_products->catalogProductRepositoryV1GetList($get_product_detail);

          $option_product_color = array(
            'sku' => $data['products_detail']->result->items->item->sku,
            // 'id' => 5
            'id' => 7
          );
          $option_product_size = array(
            'sku' => $data['products_detail']->result->items->item->sku,
            // 'id' => 6
            'id' => 8
          );

          $option_product = array(
            'sku' => $data['products_detail']->result->items->item->sku,
          );

          if($data['products_detail']->result->items->item->typeId == 'configurable'){
            $data['product_options'] = $get_products_option->configurableProductOptionRepositoryV1GetList($option_product);
          } else {
            $data['product_options'] = '';
          }


          // dd($data['product_options']);
          // exit();

          // foreach($test->result->item as $key_options => $value_options){
          //   if($value_options->attributeId == '93' && $value_options->label == 'Color'){
          //     foreach($value_options->values->item as $key_value => $value_value){
          //       dd($value_value);
          //     }
          //   }
          // }

          // dd($test);
          // exit();

          // $data['product_option'] = $get_products_option->configurableProductOptionRepositoryV1Get($option_product_color);
          // $data['product_option_size'] = $get_products_option->configurableProductOptionRepositoryV1Get($option_product_size);

          // @foreach($product_option->result->values->item as $key_product_color => $value_product_color)
          //   @if($value_product_color->valueIndex == $value_color->value)
          //     <div class="col-1 mr-2 px-2 mb-2 text-center">
          //       <button type="button" class="btn color-btn color-active" style="background-color:{{$value_color->label}}"></button>
          //     </div>
          //   @endif
          // @endforeach

          // @foreach($product_option_size->result->values->item as $key_product_size => $value_product_size)
          //   @if($value_sizes->label != ' ')
              // @if($value_product_size->valueIndex == $value_sizes->value)
              //   <div class="col-xl-4 col-6 px-0 size-select @if($value_product_size->valueIndex != $value_sizes->value) {{ 'disabled' }} @endif">
              //     <span>{{ $value_sizes->label }}</span>
              //   </div>
              // @endif
          //   @endif
          // @endforeach

          // if(!empty($data['product_option']) || !empty($data['product_option_size'])){
            $get_products_gallery = [
                  'sku' => $data['products_detail']->result->items->item->sku,
              ];
            $data['products_gallery'] = $get_products_gallerys->catalogProductAttributeMediaGalleryManagementV1GetList($get_products_gallery);
            $data['color_product'] = $get_color_products->catalogProductAttributeOptionManagementV1GetItems($get_color_product);
            $data['size_products'] = $get_color_products->catalogProductAttributeOptionManagementV1GetItems($get_size_products);

            // dd($data['size_products'],$data['product_option_size']);
            // exit();

            // foreach($data['color_product']->result->item as $key_color => $value_color){
            //   foreach($data['product_option']->result->values->item as $key_product_color => $value_product_color){
            //     if($value_color->value != ''){
            //       if($value_product_color->valueIndex == $value_color->value){
            //         foreach($data['size_products']->result->item as $key_sizes => $value_sizes){
            //           foreach($data['product_option_size']->result->values->item as $key_product_size => $value_product_size){
            //             if($value_sizes->label != ' '){
            //               if($value_product_size == $value_sizes->value){
            //                 $get_stock_products = array(
            //                   'productSku' => $data['products_detail']->result->items->item->sku.'-'.$value_color->label.'-'.$value_sizes->label
            //                 );
            //                 // $stock_data = $get_stock_product->catalogInventoryStockRegistryV1GetStockStatusBySku($get_stock_products);
            //                 $data['stock'][$value_color->label][$value_sizes->label] = $get_stock_product->catalogInventoryStockRegistryV1GetStockStatusBySku($get_stock_products);
            //               }
            //             }
            //           }
            //         }
            //       }
            //     }
            //   }
            // }
          // }

        $catalogs = [
            'rootCategoryId' => 1,
        ];

        $userData = array("username" => "customer", "password" => "customer@01");
        $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token = json_decode(curl_exec($ch));

        $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

        $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/cmsBlock/search?".$get_blocks);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

        $blocks = json_decode(curl_exec($ch));


        $get_session_all = \Session::all();

        if(!empty($get_session_all['customer_id'])){
          $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/me");
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . ($get_session_all['customer_id'])));

          $result2 = json_decode(curl_exec($ch));

          if(empty($result2->parameters)){

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $result3 = json_decode(curl_exec($ch));

            if(!empty($result3->message)){
              if($result3->message == '%fieldName is a required field.'){
                    $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

                    $create_cart = json_decode(curl_exec($ch));
              }
            } else {
            if(empty($result3->parameters)) {
              $data['token_customer'] = $result2;
              $data['cart_customer'] = $result3;

              $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);

                foreach($result3 as $key => $value){
                  $get_key_product = array(
                    'sku' => $value->sku
                  );
                  $data['product_key'][$key] = $get_products->catalogProductRepositoryV1Get($get_key_product);
                }

                $get_type_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);
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
          } else {
            \Session::flush();
            return redirect('/');
          }
        }

          // if(!empty($stock_data)){
          //   $data['stock'][$value_color->label][$value_sizes->label] = $stock_data;
          // } else {
          //   $data['stock'][$value_color->label][$value_sizes->label] = '';
          // }

          // $get_stock_products = array(
          //   'productSku' => 'Nike Roshe One-WHITE-6'
          // );
          // dd($get_stock_products);
          // exit();


          // dd($data);
          // exit();
        $data['category'] = $catalog->catalogCategoryManagementV1GetTree($catalogs);
        $data['blocks'] = $blocks;
        $data['page_title'] = 'ProductDetail';

        }catch(Exception $e){
          $data['products'] = $e->getMessage();
        }

        return view('product-details2',$data);
    }
    public function details(){
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
        $catalog = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogCategoryManagementV1',$params);
        $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
        $get_product_page = [
            'searchCriteria' => [
                'filterGroups' => [
                    [
                    ],
                ],
                'pageSize' => 20,
            ],
        ];
        $catalogs = [
            'rootCategoryId' => 1,
        ];

        $userData = array("username" => "customer", "password" => "customer@01");
        $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

        $token = json_decode(curl_exec($ch));

        $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

        $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/cmsBlock/search?".$get_blocks);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

        $blocks = json_decode(curl_exec($ch));

        $data['category'] = $catalog->catalogCategoryManagementV1GetTree($catalogs);
        $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
        $data['blocks'] = $blocks;
        $data['page_title'] = 'Fillter';

        }catch(Exception $e){
          $data['products'] = $e->getMessage();
        }

        return view('product-details2',$data);
    }

    public function detail1(){
        return view('product-details1');
    }

    public function adidas(){
        $data['page_title'] = 'Adidas';
        return view('adidas',$data);
    }

    public function reebok(){
        $data['page_title'] = 'Reebok';
        return view('reebok',$data);
    }

    public function payment(){
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

      $catalog = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogCategoryManagementV1',$params);

      $catalogs = [
          'rootCategoryId' => 1,
      ];

      $userData = array("username" => "customer", "password" => "customer@01");
      $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

      $token = json_decode(curl_exec($ch));

      $get_blocks = 'searchCriteria[filter_groups][0][filters][0][field]=is_active&searchCriteria[filter_groups][0][filters][0][value]=1&searchCriteria[filter_groups][0][filters][0][condition_type]=eq&searchCriteria[pageSize]=12&searchCriteria[sortOrders][0][field]=block_id&searchCriteria[sortOrders][0][direction]=DESC';

      $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/cmsBlock/search?".$get_blocks);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

      $blocks = json_decode(curl_exec($ch));

      $get_session_all = \Session::all();
        if(!empty($get_session_all['customer_id'])){
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $result2 = curl_exec($ch);

            if(!empty(json_decode($result2)->id)){

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $result3 = json_decode(curl_exec($ch));

              if(empty($result3->parameters)) {

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $get_cart = json_decode(curl_exec($ch));

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

            $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);
            $get_products2 = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRenderListV1',$params);
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

            $get_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductRepositoryV1',$params);

            foreach($result3 as $key => $value){
              $get_key_product = array(
                'sku' => $value->sku
              );

              $data['product_key'][$key] = $get_products->catalogProductRepositoryV1Get($get_key_product);
            }

            $get_type_products = new \SoapClient('http://192.168.1.27/dilok2/soap/default?wsdl&services=catalogProductAttributeOptionManagementV1',$params);

            $get_color_product = [
              'attributeCode' => 'color',
            ];
            $get_size_product = [
              'attributeCode' => 'size',
            ];

            $data['color_product'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_color_product);
            $data['size_products'] = $get_type_products->catalogProductAttributeOptionManagementV1GetItems($get_size_product);
            $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
            $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);
            $data['token_customer'] = json_decode($result2);
            $data['cart_customer'] = $result3;
            $data['get_cart'] = $get_cart;
          } else {
            $data['color_product'] = '';
            $data['size_products'] = '';
            $data['products'] = '';
            $data['products2'] = '';
            $data['token_customer'] = json_decode($result2);
            $data['cart_customer'] = '';
            $data['get_cart'] = '';
            $data['product_key']['customer_id'] = '';
          }
        } else {
          \Session::flush();
          return redirect('/');
        }

        } else {
          \Session::flush();
          return redirect('/');
        }

        $data['category'] = $catalog->catalogCategoryManagementV1GetTree($catalogs);
        $data['blocks'] = $blocks;
        $data['page_title'] = 'Payment';

        return view('payment',$data);
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

    public function payment_order(Request $request){
      $userData = array("username" => "customer", "password" => "customer@01");
      $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/integration/admin/token");
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));

      $token = json_decode(curl_exec($ch));

      $get_session_all = \Session::all();

      if(!empty($get_session_all['customer_id'])){
          $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/addresses/".$request->data_billing."");
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

          $address_bill = json_decode(curl_exec($ch));

          $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/addresses/".$request->data_shipping."");
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));

          $address_shipping = json_decode(curl_exec($ch));


          dd($address_bill,$address_shipping);
          exit();

      } else {
          \Session::flush();
          return redirect('/');
      }

      dd($request->all());
      exit();


        // if(!empty($get_session_all['customer_id'])){
            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/customers/me");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . ($get_session_all['customer_id'])));

            $result2 = curl_exec($ch);

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/".json_decode($result2)->id."/items");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));

            $result3 = json_decode(curl_exec($ch));

              // $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/products/Nike Air Span II SE-BLACK-6");
              // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
              // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));

              // $result4 = json_decode(curl_exec($ch));

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/payment-information");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . ($get_session_all['customer_id'])));

            $result5 = json_decode(curl_exec($ch));

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/items");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));

            $cart_item = json_decode(curl_exec($ch));

            foreach($cart_item as $key_item => $value_item){
              $item[$key_item] = Paypalpayment::item();
              $item[$key_item] = array(
                'setName' => $value_item->sku,
                'setDescription' => $value_item->name,
                'setCurrency' => "THB",
                'setQuantity' => $value_item->qty,
                'setTax' => 0,
                'setPrice' => $value_item->price,
              );
            }

            // dd($item);
            // exit();

            // $data = [
            //   "addressInformation"=> [
            //   "shippingAddress"=> [
            //   "customerAddressId"=> 5
            //   ],
            //   "shippingMethodCode"=> "string",
            //   "shippingCarrierCode"=> "string"
            //   ]
            // ];

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/shipping-methods");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . ($get_session_all['customer_id'])));

            $result10 = json_decode(curl_exec($ch));


            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/billing-address");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));


            $result12 = json_decode(curl_exec($ch));

            // $data_billing = [
            //   "id" => 1,
            //   "addresses" => [
            //     "firstname"=> "banjong",
            //     "lastname"=> "limkluea",
            //     "email"=> "hamworkbythai@gmail.com",
            //     "street" => [
            //       "1518/4"
            //     ],
            //     "city"=> "bangkok",
            //     "region_id"=> 0,
            //     "region"=> "bangkok",
            //     "region_code"=> "bangkok",
            //     "postcode"=> "10800",
            //     "country_id"=> "TH",
            //     "telephone"=> "021024291",
            //     // "same_as_billing"=> 1,
            //     // "save_in_address_book"=> 1
            //   ],
            //   "useForShipping" => true
            // ];

            $data_billing = [
              "address" => [
                  "region" => "bang sue",
                  "country_id" => "TH",
                  "street" => [
                      "1518/4"
                  ],
                  "telephone" => "021024291",
                  "postcode" => "10800",
                  "city" => "bangkok",
                  "firstname" => "banjong",
                  "lastname" => "limkluea",
                  "email" => "hamworkbythai@gmail.com"
                ]
            ];



            // $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/billing-address");
            // curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
            // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_billing));
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));


            // $result13 = json_decode(curl_exec($ch));

            $totle = [
              "email"=> "hamworkbythai@gmail.com",
              "paymentMethod"=> [
                "method"=> "checkmo",
              ],
              "billingAddress"=> [
                "region"=> "TH",
                "region_id"=> 0,
                "region_code"=> "bangkok",
                "country_id"=> "TH",
                "street"=> [
                  "1518/4"
                ],
                "company"=> "workbythai",
                "telephone"=> "021024291",
                "postcode"=> "10800",
                "city"=> "bangkok",
                "firstname"=> "banjong",
                "lastname"=> "limkluea",
                "customer_id"=> 1,
                "email"=> "hamworkbythai@gmail.com",
                "same_as_billing"=> 1,
                "customer_address_id"=> 1,
                "save_in_address_book"=> 1,
                "extension_attributes"=> [],
              ],
            ];

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/totals");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($totle));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));


            $totals = json_decode(curl_exec($ch));

            dd($totals);
            exit();

            /*$shipping = [
              "addressId" => 1
            ];

            $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/estimate-shipping-methods-by-address-id");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($shipping));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $get_session_all['customer_id']));


            $result15 = json_decode(curl_exec($ch));

            dd($result15);
            exit();
            */



            dd($result_shipping);
            exit();



            ///////// Create Order /////////
            // $create_order = [
            //   "email"=> "hamworkbythai@gmail.com",
            //   "paymentMethod"=> [
            //     // "po_number"=> "free",
            //     "method"=> "checkmo",
            //     // "method"=> "paypal_express",
            //     // "additional_data"=> [
            //     //   "paypal_express_checkout_token" => "EC-xxxxxxxxxxxx",
            //     //   "paypal_express_checkout_redirect_required" => false,
            //     //   "paypal_express_checkout_payer_id" => "XXXXXXXXXX"
            //     // ],
            //     // "extension_attributes"=> [
            //     //   "agreement_ids"=> [
            //     //     "string"
            //     //   ]
            //     // ]
            //   ],
            //   "billingAddress"=> [
            //     // "id"=> 0,
            //     "region"=> "TH",
            //     "region_id"=> 0,
            //     "region_code"=> "bangkok",
            //     "country_id"=> "TH",
            //     "street"=> [
            //       "1518/4"
            //     ],
            //     "company"=> "workbythai",
            //     "telephone"=> "021024291",
            //     // "fax"=> "string",
            //     "postcode"=> "10800",
            //     "city"=> "bangkok",
            //     "firstname"=> "banjong",
            //     "lastname"=> "limkluea",
            //     // "middlename"=> "string",
            //     // "prefix"=> "string",
            //     // "suffix"=> "string",
            //     // "vat_id"=> "string",
            //     "customer_id"=> 1,
            //     "email"=> "hamworkbythai@gmail.com",
            //     "same_as_billing"=> 1,
            //     "customer_address_id"=> 1,
            //     "save_in_address_book"=> 1,
            //     "extension_attributes"=> [],
            //     // "custom_attributes"=> [
            //     //   [
            //     //     "attribute_code"=> "string",
            //     //     "value"=> "string"
            //     //   ]
            //     // ]
            //   ],
            // ];

            // $ch = curl_init("http://192.168.1.27/dilok2/rest/V1/carts/mine/payment-information");
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($create_order));
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . ($get_session_all['customer_id'])));


            // $result_order = json_decode(curl_exec($ch));


            // dd($result_order);
            // exit();

        // }
    }
}
