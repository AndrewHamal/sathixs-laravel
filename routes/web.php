<?php

use App\Events\Vendor\ReceiveCoordinate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Rider\HomeController;
use App\Http\Controllers\Admin\Rider\RiderController;
use App\Http\Controllers\Admin\Rider\GeneralController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Vendor\VendorController;
use App\Http\Controllers\Admin\Package\PackageController;
use App\Http\Controllers\Admin\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function() {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::get('/home', [HomeController::class, 'index']);

Route::resource('rider', RiderController::class);

Route::get('active/rider/{id}', [GeneralController::class, 'activeRider']);

Route::get('inactive/rider/{id}', [GeneralController::class, 'inactiveRider']);

Route::resource('adminuser', AdminController::class);

Route::resource('admin_vendor', VendorController::class);

Route::resource('admin_package', PackageController::class);
