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

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'MainController@index')->name('index');
Route::get('/categories', 'MainController@categories')->name('categories');
Route::get('/cart', 'CartController@cart')->name('cart');
Route::get('/cart/order', 'CartController@cartOrder')->name('cart-order');
Route::post('/cart/add/{id}', 'CartController@cartAdd')->name('cart-add');
Route::post('/cart/remove/{id}', 'CartController@cartRemove')->name('cart-remove');
Route::post('/cart/order', 'CartController@cartConfirm')->name('cart-confirm');
Route::get('/{category}', 'MainController@category')->name('category');
Route::get('/{category}/{product?}', 'MainController@product')->name('product');
