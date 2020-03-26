<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    //Route::put('user/{id}', 'UserController@update_api');
});
*/
Route::get('/order/list/{id}', 'OrderController@show_list_api');
Route::put('/order', 'OrderController@store_api');
Route::delete('/order', 'OrderController@destroy_api');