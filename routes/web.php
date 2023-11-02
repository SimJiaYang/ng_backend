<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BiddingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProductController;
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

// Settings Login and Home Page
Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['middleware' => 'isAdmin'], function () {
        // Customer
        Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
        Route::any('/customer/search', [CustomerController::class, 'search'])->name('customer.search');

        Route::group(['middleware' => 'isSadmin'], function () {
            Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
            Route::post('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
        });

        // Category
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/insert', [CategoryController::class, 'insert'])->name('category.insert');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::any('/category/search', [CategoryController::class, 'search'])->name('category.search');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

        // Plant
        Route::get('/plant', [PlantController::class, 'index'])->name('plant.index');
        Route::get('/plant/insert', [PlantController::class, 'insert'])->name('plant.insert');
        Route::post('/plant/store', [PlantController::class, 'store'])->name('plant.store');
        Route::any('/plant/search', [PlantController::class, 'search'])->name('plant.search');
        Route::get('/plant/edit/{id}', [PlantController::class, 'edit'])->name('plant.edit');
        Route::post('/plant/update', [PlantController::class, 'update'])->name('plant.update');
        Route::get('/plant/delete/{id}', [PlantController::class, 'delete'])->name('plant.delete');

        // Product
        Route::get('/product', [ProductController::class, 'index'])->name('product.index');
        Route::get('/product/insert', [ProductController::class, 'insert'])->name('product.insert');
        Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
        Route::any('/product/search', [ProductController::class, 'search'])->name('product.search');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
        Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

        // Order
        Route::get('/order', [OrderController::class, 'index'])->name('order.index');
        Route::get('/order/detail/{id}', [OrderController::class, 'order_detail'])->name('order.detail');
        Route::any('/order/search', [OrderController::class, 'search'])->name('order.search');
        Route::any('/order/filter/{status}', [OrderController::class, 'filter'])->name('order.filter');
        Route::get('/order/ship/{id}', [OrderController::class, 'showShipOrder'])->name('order.ship');

        // Bidding
        Route::get('/bidding', [BiddingController::class, 'index'])->name('bidding.index');
    });

    Route::group(['middleware' => 'isUser'], function () {
    });
});
