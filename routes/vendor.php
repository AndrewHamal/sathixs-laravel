<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\Auth\LoginController;
use App\Http\Controllers\Vendor\Auth\RegisterController;
use App\Http\Controllers\Vendor\PackageController;
use App\Http\Controllers\Vendor\PackageCancelController;
use App\Http\Controllers\Vendor\TicketController;
use App\Http\Controllers\Vendor\PackageStatusController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
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
Route::post('vendor/login', [LoginController::class, 'login']);
Route::post('vendor/register', [RegisterController::class, 'register']);

//google Oauth
Route::get('vendor/redirect', [LoginController::class, 'redirect']);
Route::get('vendor/callback', [LoginController::class, 'callback']);

use App\Events\Vendor\ReceiveCoordinate;
Route::get('test', function(){

        broadcast(new ReceiveCoordinate(['id'=>'dsds']));

});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'vendor'], function(){
    Route::get('/', function (Request $request) {
        return Auth::user();
    });

    Route::resource('location', LocationController::class);

    Route::post('update-vendor', VendorController::class);

    Route::post('logout', [LoginController::class, 'logout']);

    Route::resource('package', PackageController::class);

    Route::resource('ticket', TicketController::class);

    Route::resource('package-status', PackageStatusController::class);

    Route::post('package-cancel', PackageCancelController::class);

    Route::get('categories', CategoryController::class);
});
