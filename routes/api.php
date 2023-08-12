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
    Route::post('login', 'UserApiController@login');
    Route::post('register', 'UserApiController@store');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('logout', 'UserApiController@destroy');
    });
});
