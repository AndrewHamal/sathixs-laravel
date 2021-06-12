<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Rider\HomeController;
use App\Http\Controllers\Admin\Rider\RiderController;
use App\Http\Controllers\Admin\Rider\GeneralController;
use App\Http\Controllers\Admin\AdminController;
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

Route::get('/home', [HomeController::class, 'index']);

Route::resource('rider', RiderController::class);

Route::get('active/rider/{id}', [GeneralController::class, 'activeRider']);

Route::get('inactive/rider/{id}', [GeneralController::class, 'inactiveRider']);

Route::resource('adminuser', AdminController::class);
