<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerQuestionsController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\CarBrandController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashBoardController;


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
//refresh token khi access token hết hạn
Route::post('/auth/refresh-token', [UserController::class, 'refreshToken'])->name('refresh_token');

// chia theo controller cho dễ quản lí
Route::get('/customers', [UserController::class, 'index']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/cars-outstanding', [ProductController::class, '_getCarOutstanding']);
Route::get('/car-detail/{slug}', [ProductController::class, '_getDataCarDetail_slug']);
Route::get('/get-name-brand', [CarBrandController::class, '_getAllBrand']);
Route::get('/get-news-outstanding', [NewsController::class, '_getDataNewsOutstanding']);
Route::get('/get-filter-products', [FilterController::class, '_getDataFilter']);
//dùng cho khách vãng lai
Route::post('/get-question', [CustomerController::class, '_addCusQuestion']);
Route::post('/booking', [BookingController::class, '_bookingCar'])->name('booking');
Route::get('/get-all-questions', [CustomerQuestionsController::class, '_getAllQuestions']);
//dùng middleware để check token có hợp lệ hay k
// User API routes (Yêu cầu đăng nhập)
Route::middleware('auth:api')->group(function () {
    Route::post('/update-user-profile', [UserController::class, '_updateProfile']);
});

// Admin API routes (Yêu cầu đăng nhập )
Route::middleware('auth:api')->group(function () {
    Route::get('/admin/get-all-brand', [CarBrandController::class, '_getAllBrand']);
    Route::get('/get-detail-brand', [CarBrandController::class, '_getDetailBrand']);
    Route::get('/admin/get-all-products', [ProductController::class, '_getAllProduct']);
    // nếu là admin thì cho thêm xóa sửa
    Route::middleware('isAdmin')->group(function () {
        //xem lượt truy cập
        Route::get('/get-data-userviewpage', [DashBoardController::class, '_getDataUserViewPage']);
        //brand
        Route::post('/add-brand', [CarBrandController::class, '_addBrand']);
        Route::put('/update-brand/{id}', [CarBrandController::class, '_updateBrand']);
        Route::put('/update-brand_noibat/{id}', [CarBrandController::class, '_checkBoxNoiBat']);
        Route::post('/delete-selected-brands', [CarBrandController::class, '_deleteSelectedBrands']);
        //product
        Route::post('/add-product', [ProductController::class, '_addProduct']);
        Route::post('/update-product/{slug}', [ProductController::class, '_updateProduct']);
        Route::put('/update-product_noibat/{id}', [ProductController::class, '_checkBoxNoiBat']);
        Route::post('/delete-selected-products', [ProductController::class, '_deleteSelectedProducts']);
        //question
        Route::put('/update-cus-question/{id}', [CustomerQuestionsController::class, '_updateQuestion']);

    });
});

