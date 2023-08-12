<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Settings Login and Home Page
Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/register', function () {
    return redirect()->route('home');
});

Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::group(['middleware' => 'isAdmin'], function () {
});

Route::group(['middleware' => 'isUser'], function () {
});
