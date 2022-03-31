<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProductCampaignController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace ('Api')->group(function () {
    Route::get("healthcheck", function () {
        return "OK";
    });

    Route::prefix('group')->group(function () {
        Route::get('all', [GroupController::class, 'index']);
        Route::get('find/{id}', [GroupController::class, 'show']);
        Route::post('store', [GroupController::class, 'store']);
        Route::put('update/{id}', [GroupController::class, 'update']);
        Route::delete('delete/{id}', [GroupController::class, 'destroy']);
    });

    Route::prefix('city')->group(function () {
        Route::get('all', [CityController::class, 'index']);
        Route::get('find/{id}', [CityController::class, 'show']);
        Route::post('store', [CityController::class, 'store']);
        Route::put('update/{id}', [CityController::class, 'update']);
        Route::delete('delete/{id}', [CityController::class, 'destroy']);
    });

    Route::prefix('campaign')->group(function () {
        Route::get('all', [CampaignController::class, 'index']);
        Route::get('find/{id}', [CampaignController::class, 'show']);
        Route::post('store', [CampaignController::class, 'store']);
        Route::put('update/{id}', [CampaignController::class, 'update']);
        Route::delete('delete/{id}', [CampaignController::class, 'destroy']);
    });

    Route::prefix('discount')->group(function () {
        Route::get('all', [DiscountController::class, 'index']);
        Route::get('find/{id}', [DiscountController::class, 'show']);
        Route::post('store', [DiscountController::class, 'store']);
        Route::put('update/{id}', [DiscountController::class, 'update']);
        Route::delete('delete/{id}', [DiscountController::class, 'destroy']);
    });

    Route::prefix('product')->group(function () {
        Route::get('all', [ProductController::class, 'index']);
        Route::get('find/{id}', [ProductController::class, 'show']);
        Route::post('store', [ProductController::class, 'store']);
        Route::put('update/{id}', [ProductController::class, 'update']);
        Route::delete('delete/{id}', [ProductController::class, 'destroy']);
    });

    Route::prefix('product-campaign')->group(function () {
        Route::get('all', [ProductCampaignController::class, 'index']);
        Route::get('find/{id}', [ProductCampaignController::class, 'show']);
        Route::post('store', [ProductCampaignController::class, 'store']);
        Route::put('update/{id}', [ProductCampaignController::class, 'update']);
        Route::delete('delete/{id}', [ProductCampaignController::class, 'destroy']);
    });
});
