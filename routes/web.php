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


Route::Group(['prefix' => '/api/v1'], function () {
    Route::post('/authentication', 'Api\LoblawsellerApi@authentication');
    Route::get('/getProduct', 'Api\LoblawsellerApi@getProduct');
    Route::post('/createProduct', 'Api\LoblawsellerApi@createProduct');
    Route::put('/editProduct', 'Api\LoblawsellerApi@editProduct');
    Route::get('/productSearch', 'Api\LoblawsellerApi@productSearch');
});

