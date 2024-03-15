<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
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

/**
 * Redirect to home
 */
Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/home', [HomeController::class, 'home'])->name('home');

/**
 * Authentication
 */
Auth::routes([
    'register' => false,
    'reset' => false,
]);


Route::middleware('auth:sanctum')->group(function () {
    Route::group(['middleware' => 'isAdmin'], function () {
        /**
         * Customer CRUD Route
         */
        Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
        Route::any('/customer/search', [CustomerController::class, 'search'])->name('customer.search');

        /**
         * Admin Route
         */
        Route::group(['middleware' => 'isSadmin'], function () {
            Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
            Route::post('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
        });

        /**
         * Category CRUD Route
         */
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::any('/category/search', [CategoryController::class, 'search'])->name('category.search');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

        /**
         * Plant CRUD Route
         */
        Route::get('/plant', [PlantController::class, 'index'])->name('plant.index');
        Route::get('/plant/create', [PlantController::class, 'create'])->name('plant.create');
        Route::post('/plant/store', [PlantController::class, 'store'])->name('plant.store');
        Route::any('/plant/search', [PlantController::class, 'search'])->name('plant.search');
        Route::get('/plant/edit/{id}', [PlantController::class, 'edit'])->name('plant.edit');
        Route::post('/plant/update', [PlantController::class, 'update'])->name('plant.update');
        Route::get('/plant/destroy/{id}', [PlantController::class, 'destroy'])->name('plant.destroy');

        /**
         * Plant Stock Management Route
         */
        Route::get('/plant/stock/show/{id}', [StockController::class, 'showPlantStock'])->name('plant.stock.show');
        Route::get('/plant/stock/{id}', [StockController::class, 'editPlantStock'])->name('plant.stock');
        Route::post('/plant/stock/update', [StockController::class, 'updatePlantStock'])->name('plant.stock.update');

        /**
         * Product CRUD Route
         */
        Route::get('/product', [ProductController::class, 'index'])->name('product.index');
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
        Route::any('/product/search', [ProductController::class, 'search'])->name('product.search');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
        Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');


        /**
         * Product Stock Management Route
         */
        Route::get('/product/stock/show/{id}', [StockController::class, 'showProductStock'])->name('product.stock.show');
        Route::get('/product/stock/{id}', [StockController::class, 'editProductStock'])->name('product.stock');
        Route::post('/product/stock/update', [StockController::class, 'updateProductStock'])->name('product.stock.update');

        // Order
        Route::get('/order', [OrderController::class, 'index'])->name('order.index');
        Route::get('/order/detail/{id}', [OrderController::class, 'order_detail'])->name('order.detail');
        Route::any('/order/search', [OrderController::class, 'search'])->name('order.search');
        Route::any('/order/filter/{status}', [OrderController::class, 'filter'])->name('order.filter');
        Route::get('/order/ship/{id}', [OrderController::class, 'showShipOrder'])->name('order.ship');
        Route::get('/order/partial/{id}', [OrderController::class, 'showPartialOrder'])->name('order.partial');

        // Delivery
        Route::post('/order/delivery', [DeliveryController::class, 'updateDelivery'])->name('delivery.update');
        Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery.index');
        Route::any('/delivery/search', [DeliveryController::class, 'search'])->name('delivery.search');
        Route::get('/delivery/detail/{id}', [DeliveryController::class, 'detail'])->name('delivery.detail');
    });

    Route::group(['middleware' => 'isUser'], function () {
    });
});
