<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
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

        $data['products'] = $get_products->catalogProductRepositoryV1GetList($get_product_page);
        $data['products2'] = $get_products2->catalogProductRenderListV1GetList($get_product_page);

        }catch(Exception $e){
          $data['products'] = $e->getMessage();
        }

        return view('index',$data);
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
