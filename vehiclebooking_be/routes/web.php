<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
Route::get('login/google', [UserController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [UserController::class, 'handleGoogleCallback']);
Route::get('login/facebook', [UserController::class, 'redirectToFacebook']);
Route::get('login/facebook/callback', [UserController::class, 'handleFacebookCallback']);
