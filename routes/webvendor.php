<?php

use App\Http\Controllers\Vendor_web\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor_web\HomeController;
use App\Http\Controllers\Vendor_web\Auth\RegisterController;

Route::get('/home', [HomeController::class, 'index']);

Route::get('/', [LoginController::class, 'showLoginForm'])->name('webvendor.login');
Route::post('/',[LoginController::class, 'login']);

Route::post('logout', [HomeController::class, 'logout'])->name('webvendor.logout');

Route::get('/register', [RegisterController::class, 'create'])->name('webvendor.register');
Route::post('/register', [RegisterController::class, 'store']);
