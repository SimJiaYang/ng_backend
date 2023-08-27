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
        /* User Log Out */
        Route::get('logout', 'AuthApiController@destroy');
        /* Get User Profile */
        Route::get('profile', 'UserApiController@show');

        /* Get Plant Information */
        Route::get('plant', 'PlantApiController@index');
        Route::get('plant/detail', 'PlantApiController@show');

        /*** Get Product Information */
        Route::get('product', 'ProductApiController@index');
    });
});
