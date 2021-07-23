<?php

use App\Events\Vendor\ReceiveCoordinate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Vendor\Package;
use Illuminate\Support\Facades\Broadcast;

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
    // return view('welcome');
    return Package::get()->where('process_step', null)->first();
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');






