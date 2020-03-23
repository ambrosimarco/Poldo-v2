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
Auth::routes();
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    //Route::put('user/{id}', 'UserController@update_api');
});
*/
Route::put('/order', 'OrderController@store_api');
Route::delete('/order', 'OrderController@destroy_api');
Route::get('/aaaa', 'SandwichController@index_api');