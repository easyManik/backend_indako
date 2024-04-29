<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UOMController;
use App\Http\Controllers\ProductUomController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\SellTransactionController;
use App\Http\Controllers\SellTransactionDetailController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::prefix('product-uoms')->group(function () {
    Route::get('/', [ProductUomController::class, 'getAllProductUom']);
    Route::post('/', [ProductUomController::class, 'addProductUom']);
    Route::get('/{id}', [ProductUomController::class, 'getProductUomById']);
    Route::put('/{id}', [ProductUomController::class, 'updateProductUom']);
    Route::delete('/{id}', [ProductUomController::class, 'deleteProductUom']);
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'getAllProduct']);
    Route::post('/', [ProductController::class, 'addProduct']);
    Route::put('/sell/{id}', [ProductController::class, 'reduceStock']);
    Route::get('/{id}', [ProductController::class, 'getProductById']);
    Route::put('/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
});

Route::prefix('uom')->group(function () {
    Route::get('/', [UOMController::class, 'getAllUOM']);
    Route::post('/', [UOMController::class, 'addUOM']);
    Route::get('/{id}', [UOMController::class, 'getUOMById']);
    Route::put('/{id}', [UOMController::class, 'updateUOM']);
    Route::delete('/{id}', [UOMController::class, 'deleteUOM']);
});

Route::prefix('product-price')->group(function () {
    Route::get('/', [ProductPriceController::class, 'getAllProductprice']);
    Route::post('/', [ProductPriceController::class, 'addProductprice']);
    Route::get('/{id}', [ProductPriceController::class, 'getProductpriceById']);
    Route::put('/{id}', [ProductPriceController::class, 'updateProductprice']);
    Route::delete('/{id}', [ProductPriceController::class, 'deleteProductprice']);
});

Route::prefix('sell-transaction')->group(function () {
    Route::get('/', [SellTransactionController::class, 'getAllSellTransaction']);
    Route::post('/', [SellTransactionController::class, 'addSellTransaction']);
    Route::get('/{id}', [SellTransactionController::class, 'getSellTransactionById']);
    Route::put('/{id}', [SellTransactionController::class, 'updateSellTransaction']);
    Route::delete('/{id}', [SellTransactionController::class, 'deleteSellTransaction']);
});

Route::prefix('sell-transaction-detail')->group(function () {
    Route::get('/', [SellTransactionDetailController::class, 'getAllSellTransactionDetail']);
    Route::post('/', [SellTransactionDetailController::class, 'addSellTransactionDetail']);
    Route::get('/{id}', [SellTransactionDetailController::class, 'getSellTransactionDetailById']);
    Route::put('/{id}', [SellTransactionDetailController::class, 'updateSellTransactionDetail']);
    Route::delete('/{id}', [SellTransactionDetailController::class, 'deleteSellTransactionDetail']);
});