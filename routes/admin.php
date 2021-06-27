<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminUser\AdminController;
use App\Http\Controllers\Admin\Package\PackageController;
use App\Http\Controllers\Admin\Rider\GeneralController;
use App\Http\Controllers\Admin\Rider\RiderController;
use App\Http\Controllers\Admin\Vendor\VendorController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;



Route::get('/home', [HomeController::class, 'index']);

Route::get('/', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/',[LoginController::class, 'login']);
Route::get('/register', [AdminController::class, 'create'])->name('admin.register');

Route::post('logout', [HomeController::class, 'logout'])->name('admin.logout');

Route::resource('rider', RiderController::class);

Route::get('active/rider/{id}', [GeneralController::class, 'activeRider']);

Route::get('inactive/rider/{id}', [GeneralController::class, 'inactiveRider']);

Route::resource('adminuser', AdminController::class);

Route::resource('admin_vendor', VendorController::class);

Route::resource('admin_package', PackageController::class);
