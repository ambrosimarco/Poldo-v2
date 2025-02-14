<?php

use Illuminate\Support\Facades\Route;

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

// Authentication Routes...
Auth::routes([
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
      ]);

Route::group(['middleware'=> ['online.status.check', 'session.timeout']], function(){
        Route::get('/', 'HomeController@order')->name('order');
        Route::resource('users', 'UserController');
        Route::resource('sandwiches', 'SandwichController');
        Route::get('/contacts', 'HomeController@contacts')->name('contacts');
        Route::get('/settings', 'SettingsController@index');
        Route::patch('/settings', 'SettingsController@update')->name('updateSettings');
        Route::get('/orders', 'OrderController@index_customers');
        Route::get('/print/orders', 'OrderController@print_orders');
        Route::get('/print', 'HomeController@print_index');
});
