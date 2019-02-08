<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/checkphp',function(){
    return phpinfo();
});

Route::get('/testapi','TestapiController@index');
Route::post('/postapidilok','TestapiController@postapidilok');
Route::get('/testsoap','TestapiController@testsoap');
Route::get('/testsoap2','TestapiController@testsoap2');

Route::get('/testrest','TestapiController@testrest');
Route::get('/testrestpost','MeeController@addCustomer');


Route::get('/','HomeController@index');
Route::get('/blog','BlogController@index');
Route::get('/single-blog/{id}','BlogController@detailblog');
Route::get('/launches','LauncheController@index');
Route::get('/launches-detail','LauncheController@detail');
Route::get('/filter','FilterController@index');
Route::get('/product/{id}','ProductController@detail');
Route::get('/product-details2','ProductController@details');
Route::get('/product-details1/{id}','ProductController@detail1');
Route::get('/regist','RegistController@index');
Route::get('/forgot','RegistController@forgot');
Route::get('/add-branch','AboutController@add_branch');
Route::get('/add-sub-branch','AboutController@sub_branch');
Route::get('/add-out-story','AboutController@add_out_story');
Route::get('/add-blank','HelpfulController@add_blank');
Route::get('/adidas','ProductController@adidas');
Route::get('/reebok','ProductController@reebok');

Route::get('/payment','ProductController@payment');
Route::post('/payment_order','ProductController@payment_order');

Route::get('/order','OrderProductController@index');

Route::post('/gender','FilterController@get_gender');
Route::post('/addproducttocart','FilterController@add_to_cart');
Route::post('/deleteproducttocart','FilterController@del_to_cart');
// Route::post('/gender/{gender}/{brand}/{size}/{colorproduct}','FilterController@get_gender');
Route::get('/filter/{gender}','FilterController@get_gender');
Route::get('/filter_search','FilterController@filter_search');
Route::post('/filter_page_list','FilterController@filter_page_list');
// Route::get('/Login',[ 'as' => 'login', 'uses' => 'CheckController@index']);

// Route::post('/login_customer',[ 'as' => 'login', 'uses' => 'CustomerController@login_customer']);

Route::post('/addproductconfigurable','CartController@create');

//Customer
Route::post('/create_customer','CustomerController@create');
Route::get('/account','CustomerController@profile');
Route::get('/page_edit_account/{id}','CustomerController@show');
Route::post('/edit_customer/{id}','CustomerController@edit');
Route::post('/login_customer','CustomerController@login_customer');

Route::post('/payment/paypal','PaypalPaymentController@paywithPaypal');
Route::get('/payments/success','PaypalPaymentController@success');
Route::get('/payments/fails',function(){
    echo "fails";
});
Route::post('/add_address_customer/{id}','CustomerController@store');
Route::get('/get_address_customer/{id}','CustomerController@show_edit_address');
Route::post('/edit_address_customer/{id}','CustomerController@edit_address_customer');
Route::post('/del_address_customer/{id}','CustomerController@destroy');

//logout
Route::get('/logout','CustomerController@logout');

Route::post('/get_billing/{id}','CustomerController@get_billing');

// Route::get('size','TestapiController@getresize');
Route::get('size','TestapiController@getresize');

Route::get('size2/{id}','TestapiController@resize');
Route::get('apitest','TestapiController@index');

Route::get('/brands/{brands}','FilterController@index');
Route::get('/brands/{brands}/{genders}','FilterController@index');

Route::get('phpinfo',function(){
	return phpinfo();
});

Route::get('imagemake',function(){
    $img = Image::make('D:\TOTAL2\8.1289650-703\TON_7198.jpg')->resize(300, 200);
    return $img->response('jpg');
});