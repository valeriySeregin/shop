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
Route::get('/', 'MainController@index')->name('index');

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');

Route::middleware(['auth'])->group(function () {
    Route::group([
        'prefix' => 'person',
        'namespace' => 'Person',
        'as' => 'person.'
    ], function () {
        Route::get('/orders', 'OrderController@index')->name('orders.index');
        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
    });

    Route::group([
        'namespace' => 'Admin',
        'prefix' => 'admin'
    ], function () {
        Route::group(['middleware' => 'is.admin'], function () {
            Route::get('/orders', 'OrderController@index')->name('orders');
            Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
        });

        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
    });
});

Route::group(['prefix' => 'cart'], function () {
    Route::post('/add/{id}', 'CartController@cartAdd')->name('cart-add');

    Route::group(['middleware' => 'cart.not.empty'], function () {
        Route::get('/', 'CartController@cart')->name('cart');
        Route::get('/order', 'CartController@cartOrder')->name('cart-order');
        Route::post('/remove/{id}', 'CartController@cartRemove')->name('cart-remove');
        Route::post('/order', 'CartController@cartConfirm')->name('cart-confirm');
    });
});

Route::get('/categories', 'MainController@categories')->name('categories');
Route::get('/{category}', 'MainController@category')->name('category');
Route::get('/{category}/{product?}', 'MainController@product')->name('product');
