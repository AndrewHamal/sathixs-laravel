<?php

use App\Http\Controllers\Vendor_web\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor_web\HomeController;
use App\Http\Controllers\Vendor_web\Auth\RegisterController;
use App\Http\Controllers\Vendor_web\Packages\PackageController;

Route::get('/home', [HomeController::class, 'index'])->name('webvendor.dash');

Route::get('/', [LoginController::class, 'showLoginForm'])->name('webvendor.login');
Route::post('/',[LoginController::class, 'login']);

Route::post('logout', [HomeController::class, 'logout'])->name('webvendor.logout');

Route::get('/register', [RegisterController::class, 'create'])->name('webvendor.register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/verify/{code}', [RegisterController::class, 'verifyVendor']);

Route::resource('/package', PackageController::class);
