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
    // Route::resource('category', 'CategoryController');
    // Route::resource('category', 'CategoryController');
    // Route::resource('category', 'CategoryController');
    // Route::resource('category', 'CategoryController');
});
