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

Auth::routes();

Route::get('/', 'HomeController@order')->name('order');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users', 'UserController');
Route::post('/sandwiches/{id}');
Route::resource('sandwiches', 'SandwichController');
Route::get('/contacts', 'HomeController@contacts')->name('contacts');
Route::get('/settings', 'HomeController@settings')->name('settings');
Route::get('/orders', 'OrderController@index_customers');
Route::get('/print', 'HomeController@print_index');