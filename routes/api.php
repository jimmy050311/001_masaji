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

//管理員
Route::prefix('admin')->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'update']);
});

//會員
Route::prefix('user')->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\User\UserController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\User\UserController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'update']);
    Route::put('/update-password/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'updatePassword']);
});

//等級
Route::prefix('level')->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\User\LevelController::class, 'index']);
});

//點數
Route::prefix('point')->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\User\PointController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\User\PointController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\User\PointController::class, 'update']);
});

//點數log
Route::prefix('point-log')->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\User\PointLogController::class, 'index']);
});

//商品類別
Route::prefix('category')->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Product\CategoryController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Product\CategoryController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\Product\CategoryController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\Product\CategoryController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\Backend\Product\CategoryController::class, 'destroy']);
});

//商品
Route::prefix('product')->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Product\ProductController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Product\ProductController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'update']);
    Route::put('/edit/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'updateLowAmount']);
    Route::get('/get/obtain', [\App\Http\Controllers\Backend\Product\ProductController::class, 'obtain']);
});

//庫存
Route::prefix('inventory')->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Inventory\InventoryController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Inventory\InventoryController::class, 'store']);
});

//活動
Route::prefix('event')->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Event\EventController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Event\EventController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\Backend\Event\EventController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\Backend\Event\EventController::class, 'update']);
});

//優惠券
Route::prefix('coupon')->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Coupon\CouponController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Coupon\CouponController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\Backend\Coupon\CouponController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\Backend\Coupon\CouponController::class, 'update']);
});
