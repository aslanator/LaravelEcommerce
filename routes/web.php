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

Route::get('/login/', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);



/* ADMIN */

Route::resource('/admin/options', '\App\Admin\Controllers\OptionsController');
Route::resource('/admin/products', '\App\Admin\Controllers\ProductController');
Route::resource('/admin/menu', '\App\Admin\Controllers\MenuController');
Route::resource('/admin/orders', '\App\Admin\Controllers\OrderController');
