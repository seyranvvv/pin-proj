<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class,'showLoginForm'])->name('login.form');
Route::post('login', [LoginController::class,'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class,'logout'])->name('logout');

    Route::resource('product', ProductController::class);
});
