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

Route::get('/', function () {
    return view('welcome');
});
//商家登录
Route::get('/merlogin','MercanteController@merLogin');
Route::post('/merlogdo','MercanteController@merLogdo');
Route::get('/merlogout', 'MercanteController@merlogout');
//商品
Route::get('/goodscreate','GoodsController@goodscreate')->middleware('checkLogin');
Route::post('/goodsdo','GoodsController@goodsdo');
Route::get('/goodslist','GoodsController@goodslist');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
