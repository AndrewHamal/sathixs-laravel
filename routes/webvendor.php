<?php

use App\Http\Controllers\Vendor_web\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor_web\HomeController;
use App\Http\Controllers\Vendor_web\Auth\RegisterController;
use App\Http\Controllers\Vendor_web\Packages\PackageController;
use App\Http\Controllers\Vendor_web\Tickets\TicketController;
use App\Http\Controllers\Vendor_web\GeneralController;
use App\Http\Controllers\Vendor_web\Profile\ProfileController;

Route::get('/home', [HomeController::class, 'index'])->name('webvendor.dash');

Route::get('/', [LoginController::class, 'showLoginForm'])->name('webvendor.login');
Route::post('/',[LoginController::class, 'login']);

Route::post('logout', [HomeController::class, 'logout'])->name('webvendor.logout');

Route::get('/register', [RegisterController::class, 'create'])->name('webvendor.register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/verify/{code}', [RegisterController::class, 'verifyVendor']);

Route::resource('/package', PackageController::class);

Route::resource('/ticket', TicketController::class);

Route::get('active/ticket/{id}', [GeneralController::class, 'activeTicket']);

Route::get('inactive/ticket/{id}', [GeneralController::class, 'inactiveTicket']);

// for vendor profile
Route::get('profile', [ProfileController::class, 'show'])->name('webvendor.profile');
Route::post('profile/{id}', [ProfileController::class, 'update']);

Route::get('location', [GeneralController::class, 'location']);

Route::get('package/share/{id}', [GeneralController::class, 'package_share']);

