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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'ProxyListController@showProxy');

//Route::put('/filterProxy/', 'ProxyListController@showProxy');

Route::get('/tcpreq', 'ProxyListController@tcpRequest');

Route::get('/tcptest', 'TcpController@index');

