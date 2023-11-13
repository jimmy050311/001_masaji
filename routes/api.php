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

//登入
Route::prefix('/login')->group(function() {
    Route::post('/', [\App\Http\Controllers\Backend\LoginController::class, 'login']);
});
//登出
Route::prefix('/logout')->group(function() {
    Route::post('/', [\App\Http\Controllers\Backend\LoginController::class, 'logout']);
});

//管理員
Route::prefix('admin')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'update']);
});

//會員
Route::prefix('user')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\User\UserController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\User\UserController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'update']);
    Route::put('/update-password/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'updatePassword']);
    Route::get('/get/obtain', [\App\Http\Controllers\Backend\User\UserController::class, 'obtain']);
});

//等級
Route::prefix('level')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\User\LevelController::class, 'index']);
});

//點數
Route::prefix('point')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\User\PointController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\User\PointController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\User\PointController::class, 'update']);
});

//點數log
Route::prefix('point-log')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\User\PointLogController::class, 'index']);
});

//商品類別
Route::prefix('category')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Product\CategoryController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Product\CategoryController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\Product\CategoryController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\Product\CategoryController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\Backend\Product\CategoryController::class, 'destroy']);
});

//商品
Route::prefix('product')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Product\ProductController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Product\ProductController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'update']);
    Route::put('/edit/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'updateLowAmount']);
    Route::get('/get/obtain', [\App\Http\Controllers\Backend\Product\ProductController::class, 'obtain']);
});

//庫存
Route::prefix('inventory')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Inventory\InventoryController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Inventory\InventoryController::class, 'store']);
});

//活動
Route::prefix('event')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Event\EventController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Event\EventController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\Event\EventController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\Event\EventController::class, 'update']);
    Route::get('/get/obtain', [\App\Http\Controllers\Backend\Event\EventController::class, 'obtain']);
});

//優惠券
Route::prefix('coupon')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Coupon\CouponController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Coupon\CouponController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\Coupon\CouponController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\Coupon\CouponController::class, 'update']);
    Route::get('/get/obtain', [\App\Http\Controllers\Backend\Coupon\CouponController::class, 'obtain']);
});

//訂單
Route::prefix('order')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Backend\Order\OrderController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Backend\Order\OrderController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\Backend\Order\OrderController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\Backend\Order\OrderController::class, 'update']);
});

//圖表
Route::prefix('chart')->middleware(['assign.guard:admins', 'auth.admin.verified'])->group(function() {
    Route::get('/bar-chart', [\App\Http\Controllers\Backend\Chart\ChartController::class, 'barChart']);
    Route::get('/pie-chart', [\App\Http\Controllers\Backend\Chart\ChartController::class, 'pieChart']);
});


//==============================================前台======================================================


//聯絡我們
Route::prefix('front')->group(function() {
    Route::prefix('contact')->group(function() {
        Route::post('/', [\App\Http\Controllers\Frontend\Contact\ContactController::class, 'store']);
    });
});
