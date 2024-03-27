<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\UserAuthController;
use App\Http\Controllers\Api\Auth\CustomerAuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CustomerController;
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

Route::prefix('user')->group(function (){
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);
});
Route::prefix('customer')->group(function (){
    Route::post('register', [CustomerAuthController::class, 'register']);
    Route::post('login', [CustomerAuthController::class, 'login']);
});

// for authenticated Customers
Route::middleware('auth:customer')->group(function (){
    Route::get('customer', [CustomerController::class, 'getAuthenticatedCustomer']);
});


// for authenticated user
Route::middleware('auth:user')->group(function (){
    Route::get('user', [UserController::class, 'getAuthenticateduser']);
});