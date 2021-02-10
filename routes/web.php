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
Route::group([
    'middleware' => 'auth',
    'namespace' => 'Admin',
    'prefix' => 'admin'
], function () {
    Route::group(['middleware' => 'is.admin'], function () {
        Route::get('/orders', 'OrderController@index')->name('orders');
    });

    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
});

Route::get('/', 'MainController@index')->name('index');
Route::get('/categories', 'MainController@categories')->name('categories');

Route::group(['prefix' => 'cart'], function () {
    Route::post('/add/{id}', 'CartController@cartAdd')->name('cart-add');

    Route::group(['middleware' => 'cart.not.empty'], function () {
        Route::get('/', 'CartController@cart')->name('cart');
        Route::get('/order', 'CartController@cartOrder')->name('cart-order');
        Route::post('/remove/{id}', 'CartController@cartRemove')->name('cart-remove');
        Route::post('/order', 'CartController@cartConfirm')->name('cart-confirm');
    });
});

Route::get('/{category}', 'MainController@category')->name('category');
Route::get('/{category}/{product?}', 'MainController@product')->name('product');
