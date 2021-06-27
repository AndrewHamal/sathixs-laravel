<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor_web\AuthenticatedSessionController;
use App\Http\Controllers\Vendor_web\VendorWebController;

//Route::get('/webvendor', [LoginController::class, 'showLoginForm'])->name('webvendor.login');
//Route::get('/webvendor/home', [VendorWebController::class, 'index']);
//Route::post('/webvendor', [LoginController::class, 'login']);

Route::group(['middleware' => 'guest:vendor'], function() {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('webvendor.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('webvendor.loggedin');
});
Route::group(['middleware' => 'auth:vendor'], function() {
    Route::get('/home', [VendorWebController::class, 'index'])->name('webvendor.home');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('webvendor.logout');
});

