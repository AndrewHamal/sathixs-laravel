<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\Auth\LoginController;
use App\Http\Controllers\Vendor\Auth\RegisterController;
use App\Http\Controllers\Vendor\PackageController;
use App\Http\Controllers\Vendor\PackageCancelController;
use App\Http\Controllers\Vendor\TicketController;
use App\Http\Controllers\Vendor\PackageStatusController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [LoginController::class, 'login']);

Route::post('/register', [RegisterController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'vendor'], function(){
    Route::get('/', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [LoginController::class, 'logout']);

    Route::resource('package', PackageController::class);

    Route::resource('ticket', TicketController::class);

    Route::resource('package-status', PackageStatusController::class);

    Route::post('package-cancel', PackageCancelController::class);
});
