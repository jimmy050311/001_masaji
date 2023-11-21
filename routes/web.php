<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//前台
Route::get('/', function () {
    return view('home');
});
Route::get('/service', function() {
    return view('service');
});
Route::get('/news', function() {
    return view('news');
});
Route::get('/news/{id}', function() {
    return view('news-detail');
});
Route::get('/gallery', function() {
    return view('gallery');
});
Route::get('/contact', function() {
    return view('contact');
});
Route::get('/login', function() {
    return view('login');
});
Route::get('/manage', function() {
    return view('backend');
});
Route::get('/member', function() {
    return view('member.member');
});
Route::get('/member/order/{id}', function() {
    return view('member.order-detail');
});

//後台
Route::prefix('/manage')->group(function() {
    Route::get('/login', function() {
        return view('backend');
    });
    Route::get('/pos', function() {
        return view('backend');
    });
    Route::get('/admin/list', function() {
        return view('backend');
    });
    Route::prefix('/user')->group(function() {
        Route::get('/create', function() {
            return view('backend');
        });
        Route::get('/edit/{id}', function() {
            return view('backend');
        });
        Route::get('/list', function() {
            return view('backend');
        });
        Route::get('/point', function() {
            return view('backend');
        });
        Route::get('/point/{id}', function() {
            return view('backend');
        });
    });
    Route::prefix('/product')->group(function() {
        Route::get('/category', function() {
            return view('backend');
        });
        Route::get('/create', function() {
            return view('backend');
        });
        Route::get('/list', function() {
            return view('backend');
        });
        Route::get('/edit/{id}', function() {
            return view('backend');
        });
    });
    Route::prefix('/inventory')->group(function() {
        Route::get('/list', function() {
            return view('backend');
        });
        Route::get('/purchase', function() {
            return view('backend');
        });
        Route::get('/change', function() {
            return view('backend');
        });
        Route::get('/change-list', function() {
            return view('backend');
        });
    });
    Route::prefix('event')->group(function() {
        Route::get('/create', function() {
            return view('backend');
        });
        Route::get('/list', function() {
            return view('backend');
        });
        Route::get('/edit/{id}', function() {
            return view('backend');
        });
    });
    Route::prefix('coupon')->group(function() {
        Route::get('/create', function() {
            return view('backend');
        });
        Route::get('/list', function() {
            return view('backend');
        });
        Route::get('/edit/{id}', function() {
            return view('backend');
        });
    });
    Route::prefix('order')->group(function() {
        Route::get('/list', function() {
            return view('backend');
        });
        Route::get('/edit/{id}', function() {
            return view('backend');
        });
        Route::get('/chart', function() {
            return view('backend');
        });
    });
    Route::prefix('contact')->group(function() {
        Route::get('/list', function() {
            return view('backend');
        });
    });
    Route::prefix('news')->group(function() {
        Route::get('/list', function() {
            return view('backend');
        });
        Route::get('/create', function() {
            return view('backend');
        });
        Route::get('/edit/{id}', function() {
            return view('backend');
        });
    });
});