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
use App\Events\Vendor\ReceiveCoordinate;
use App\Http\Controllers\Vendor\ChatController;
use App\Http\Controllers\Vendor\TicketChatController;
use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::routes(['middleware' => ['auth:sanctum'], 'prefix' => 'vendor']);

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'vendor'], function(){

    Route::get('/', function (Request $request) {
        return Vendor::find(\Auth::user()->id);
    });

    Route::resource('location', LocationController::class);

    Route::post('update-vendor-location', [VendorController::class, 'locationUpdate']);
    Route::post('update-vendor', [VendorController::class, 'profileUpdate']);

    Route::post('pan', [VendorController::class, 'updatePan']);
    Route::post('pan/destroy/{id}', [VendorController::class, 'destroyPan']);

    Route::post('id-proof', [VendorController::class, 'updateId']);
    Route::post('id-proof/destroy/{id}', [VendorController::class, 'destroyId']);

    Route::post('tax', [VendorController::class, 'updateTax']);
    Route::post('tax/destroy/{id}', [VendorController::class, 'destroyTax']);

    Route::post('logout', [LoginController::class, 'logout']);

    Route::resource('package', PackageController::class);

    Route::resource('ticket', TicketController::class);

    Route::resource('package-status', PackageStatusController::class);

    Route::post('package-cancel', PackageCancelController::class);

    Route::get('categories', CategoryController::class);

    Route::post('/chat', [ChatController::class, 'store']);


    Route::post('/ticket-chat/{id}', [ChatController::class, 'storeTicketChat']);

    Route::get('/chat/{id}', [ChatController::class, 'index']);

    Route::get('/ticket-chat/{id}', [TicketChatController::class, 'index']);

});
