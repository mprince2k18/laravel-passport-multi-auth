<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::post('user/register',[RegisterController::class, 'user_register'])->name('user.register');
Route::post('user/login',[LoginController::class, 'user_login'])->name('user.login');

Route::post('customer/register',[RegisterController::class, 'customer_register'])->name('customer.register');
Route::post('customer/login',[LoginController::class, 'customer_login'])->name('customer.login');

Route::middleware(['auth:user-api','scopes:user'])->group(function () {
    Route::get('user/me',[LoginController::class, 'user_me'])->name('user.me');
});

Route::middleware(['auth:customer-api','scopes:customer'])->group(function () {
    Route::get('customer/me',[LoginController::class, 'customer_me'])->name('customer.me');
});


