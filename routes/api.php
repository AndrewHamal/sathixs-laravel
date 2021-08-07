<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Rider\v1\Auth\AuthController;
use App\Http\Controllers\Api\Rider\v1\Profile\ProfileController;
use App\Http\Controllers\Api\Rider\v1\Document\DrivingLicenseController;
use App\Http\Controllers\Api\Rider\v1\Profile\ProfilePhotoController;
use App\Http\Controllers\Api\Rider\v1\Document\PhotoProofController;
use App\Http\Controllers\Api\Rider\v1\Document\VehicleInsuranceController;
use App\Http\Controllers\Api\Rider\v1\Document\RegistrationCertificateController;
use App\Http\Controllers\Api\Rider\v1\Profile\HomeLocationController;
use App\Http\Controllers\Api\Rider\v1\Profile\WorkLocationController;
use App\Http\Controllers\Api\Rider\v1\Package\ManagePackage;
use App\Http\Controllers\Api\Rider\v1\Package\ReceiptController;
use App\Http\Controllers\Api\Rider\v1\RiderLocationController;
use App\Http\Controllers\Api\Rider\LocationController;
use App\Http\Controllers\Api\Rider\v1\ChatController;
use App\Http\Controllers\Vendor\PackageStatusController;
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

/* @ for rider registration */
Route::post('rider/register', [AuthController::class, 'register']);

/* @ for rider login */
Route::post('rider/login', [AuthController::class, 'login']);

Broadcast::routes(['middleware' => ['auth:sanctum'], 'prefix' => 'rider']);

/* @ authenticate routes only */
Route::group(['prefix' => 'rider', 'middleware' => ['auth:sanctum']], function(){

    /* @ for rider logout */
    Route::post('/logout', [AuthController::class, 'logout']);

    /* @ profile routes */
    Route::resource('riders', ProfileController::class);

    /* @ for uploading different documents */
    Route::post('/upload_profile', ProfilePhotoController::class);

    Route::post('license', [DrivingLicenseController::class, 'update']);
    Route::post('license/destroy/{id}', [DrivingLicenseController::class, 'destroy']);

    Route::post('photo-proof', [PhotoProofController::class, 'update']);
    Route::post('photo-proof/destroy/{id}', [PhotoProofController::class, 'destroy']);

    Route::post('insurance', [VehicleInsuranceController::class, 'update']);
    Route::post('insurance/destroy/{id}', [VehicleInsuranceController::class, 'destroy']);

    Route::resource('certificate', RegistrationCertificateController::class);

    Route::resource('home_address', HomeLocationController::class);

    Route::resource('work_address', WorkLocationController::class);

    Route::resource('package-status', PackageStatusController::class);

    /* @ package accept processes routes */
    Route::get('/accept_package/{package_id}', [ManagePackage::class, 'acceptPackage']);

    Route::get('/ongoing', [ManagePackage::class, 'ongoingPackage']);

    Route::get('/history', [ManagePackage::class, 'historyPackage']);

    Route::get('/canceled', [ManagePackage::class, 'canceledPackage']);

    Route::get('/package/{package_id}', [ManagePackage::class, 'show_package']);

    /* @ upload receipt of delivery  */
    Route::post('/upload_receipt', ReceiptController::class);

    /* @ package cancel part  */
    Route::get('/cancel_reason', [ManagePackage::class, 'cancel_reason']);

    Route::post('/cancel_reason', [ManagePackage::class, 'add_cancel_reason']);

    // @ rider tracking
    Route::post('/tracking', [RiderLocationController::class, 'store']);

    // @get all vendor shop location
    Route::get('/allVendorLocation', LocationController::class);

    Route::get('/chat/{id}', [ChatController::class, 'index']);

    Route::post('/chat', [ChatController::class, 'store']);

    Route::get('seen-chat/{id}', [ChatController::class, 'seenChat']);
});
