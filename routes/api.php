<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->namespace('App\\Http\\Controllers\\Api')->group(function () {
    // Unauthorized
    Route::post('login', 'AuthApiController@login');
    Route::post('register', 'AuthApiController@store');

    Route::middleware('auth:sanctum')->group(function () {
        /* User*/
        Route::get('logout', 'AuthApiController@destroy');
        Route::get('profile', 'UserApiController@show');
        Route::post('profile/update', 'UserApiController@update');
        Route::post('profile/password/update', 'UserApiController@updatePassword');
        Route::post('profile/avatar/update', 'UserApiController@handleUploadUserImage');

        /* Plant*/
        Route::get('plant', 'PlantApiController@plant');
        Route::get('plantlist', 'PlantApiController@plantList');
        Route::any('plant/search', 'PlantApiController@searchPlant');
        Route::get('plant/category', 'PlantApiController@getCategory');
        Route::get('plant/detail', 'PlantApiController@show');

        /* Product */
        Route::get('product', 'ProductApiController@product');
        Route::get('productlist', 'ProductApiController@productList');
        Route::any('product/search', 'ProductApiController@searchProduct');
        Route::get('product/category', 'ProductApiController@getCategory');

        /* Cart */
        Route::get('cart', 'CartApiController@show');
        Route::post('cart/add', 'CartApiController@add');
    });
});
