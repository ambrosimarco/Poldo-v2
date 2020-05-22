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
Route::group(['middleware'=> ['auth:api']], function(){
    // Ordini
    Route::get('/order/list/{id}', 'OrderController@show_list_api');
    Route::put('/order', 'OrderController@store_api');
    Route::delete('/order', 'OrderController@destroy_api');
    // Utenti
    Route::post('/users', 'UserController@store_api');
    Route::delete('/users/{id}', 'UserController@soft_destroy_api');
    // Panini
    Route::post('/sandwiches', 'SandwichController@store_api');
    Route::delete('/sandwiches/{id}', 'SandwichController@soft_destroy_api');
    //Impostazioni
    Route::delete('/settings', 'SettingsController@wipe_system_api');
});
