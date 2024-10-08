<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
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

// chia theo controller cho dễ quản lí
Route::get('/customers', [UserController::class, 'index']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/cars-outstanding', [ProductController::class, '_getCarOutstanding']);
Route::get('/car-detail/{slug}', [ProductController::class, '_getDataCarDetail_slug']);
Route::post('/get-question', [CustomerController::class, '_addCusQuestion']);
Route::get('/get-name-brand', [CarBrandController::class, '_getAllBrand']);
Route::get('/get-news-outstanding', [NewsController::class, '_getDataNewsOutstanding']);
Route::get('/get-filter-products', [FilterController::class, '_getDataFilter']);
Route::get('/get-data-userviewpage', [DashBoardController::class, '_getDataUserViewPage']);
Route::post('/booking', [BookingController::class, '_bookingCar'])->name('booking');
//user
Route::post('/update-user-profile', [UserController::class, '_updateProfile']);
// admin api
Route::get('/admin/get-all-brand', [CarBrandController::class, '_getAllBrand']);
Route::get('/get-detail-brand', [CarBrandController::class, '_getDetailBrand']);
Route::post('/add-brand', [CarBrandController::class, '_addBrand']);
Route::put('/update-brand/{id}', [CarBrandController::class, '_updateBrand']);
Route::put('/update-brand_noibat/{id}', [CarBrandController::class, '_checkBoxNoiBat']);
Route::post('/delete-selected-brands', [CarBrandController::class, '_deleteSelectedBrands']);
Route::get('/admin/get-all-products', [ProductController::class, '_getAllProduct']);
Route::post('/add-product', [ProductController::class, '_addProduct']);
Route::post('/update-product/{slug}', [ProductController::class, '_updateProduct']);
Route::put('/update-product_noibat/{id}', [ProductController::class, '_checkBoxNoiBat']);
Route::post('/delete-selected-products', [ProductController::class, '_deleteSelectedProducts']);
