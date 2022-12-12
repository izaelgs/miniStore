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

Route::get('/', function() {
    return 'Bem Vindo à Api miniStore';
});

Route::namespace('App\Http\Controllers\Api')->group(function() {
    Route::resource('user', 'UserController');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');

    Route::group(['middleware' => 'api'], function() {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');

    });

    Route::group(['middleware' => 'jwt.auth'], function() {
        Route::resource('address', 'AddressController');
        Route::resource('cart', 'CartItemController');
        Route::resource('order', 'OrderController');
    });
    // Route::resource('category', 'CategoryController');
    // Route::resource('category', 'CategoryController');
});
