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
}
