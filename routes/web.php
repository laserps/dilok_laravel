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

Route::get('/testapi','TestapiController@index');
Route::post('/postapidilok','TestapiController@postapidilok');
Route::get('/testsoap','TestapiController@testsoap');
Route::get('/testsoap2','TestapiController@testsoap2');

Route::get('/','HomeController@index');
Route::get('/blog','BlogController@index');
Route::get('/single-blog','BlogController@detailblog');
Route::get('/launches','LauncheController@index');
Route::get('/launches-detail','LauncheController@detail');
Route::get('/filter','FilterController@index');
Route::get('/product/{id}','ProductController@detail');
Route::get('/product-details2','ProductController@details');
Route::get('/product-details1','ProductController@detail1');
Route::get('/regist','RegistController@index');
Route::get('/forgot','RegistController@forgot');
Route::get('/add-branch','AboutController@add_branch');
Route::get('/add-sub-branch','AboutController@sub_branch');
Route::get('/add-out-story','AboutController@add_out_story');
Route::get('/add-blank','HelpfulController@add_blank');
Route::get('/adidas','ProductController@adidas');
Route::get('/reebok','ProductController@reebok');

Route::get('/payment','ProductController@payment');

Route::post('/gender','FilterController@get_gender');
Route::get('/filter_search','FilterController@filter_search');
Route::post('/create_customer','CustomerController@create');
Route::post('/login_customer','CustomerController@login_customer');
