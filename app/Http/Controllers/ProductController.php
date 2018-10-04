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
          "connection_timeout" => 180,
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
            'id' => 7
          );
          $option_product_size = array(
            'sku' => $data['products_detail']->result->items->item->sku,
            'id' => 8
          );


          $data['product_option'] = $get_products_option->configurableProductOptionRepositoryV1Get($option_product_color);
          $data['product_option_size'] = $get_products_option->configurableProductOptionRepositoryV1Get($option_product_size);
          $get_products_gallery = [
                'sku' => $data['products_detail']->result->items->item->sku,
            ];
          $data['products_gallery'] = $get_products_gallerys->catalogProductAttributeMediaGalleryManagementV1GetList($get_products_gallery);
          $data['color_product'] = $get_color_products->catalogProductAttributeOptionManagementV1GetItems($get_color_product);
          $data['size_products'] = $get_color_products->catalogProductAttributeOptionManagementV1GetItems($get_size_products);

          foreach($data['color_product']->result->item as $key_color => $value_color){
            foreach($data['product_option']->result->values->item as $key_product_color => $value_product_color){
              if($value_color->value != ''){
                if($value_product_color->valueIndex == $value_color->value){
                  foreach($data['size_products']->result->item as $key_sizes => $value_sizes){
                    foreach($data['product_option_size']->result->values->item as $key_product_size => $value_product_size){
                      if($value_sizes->label != ' '){
                        if($value_product_size->valueIndex == $value_sizes->value){
                          $get_stock_products = array(
                            'productSku' => $data['products_detail']->result->items->item->sku.'-'.$value_color->label.'-'.$value_sizes->label
                          );
                          $data['stock'][$value_color->label][$value_sizes->label] = $get_stock_product->catalogInventoryStockRegistryV1GetStockStatusBySku($get_stock_products);
                        }
                      }
                    }
                  }
                }
              }
            }
          }
          // $get_stock_products = array(
          //   'productSku' => 'Nike Roshe One-WHITE-6'
          // );
          // dd($get_stock_products);
          // exit();


          // dd($data);
          // exit();

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
          "connection_timeout" => 180,
          'stream_context' => stream_context_create($opts),
          'cache_wsdl' => WSDL_CACHE_NONE
        );
        try{
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
          $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
        }catch(Exception $e){
          $data['products'] = $e->getMessage();
        }

        return view('product-details2',$data);
    }

    public function detail1(){
        return view('product-details1');
    }

    public function adidas(){
        return view('adidas');
    }

    public function reebok(){
        return view('reebok');
    }

    public function payment(){
        return view('payment');
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
