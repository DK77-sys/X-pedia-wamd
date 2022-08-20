<?php

use App\Http\Controllers\DeviceController;
use App\Http\Livewire\ScanDevice;
use App\Http\Controllers\UserController;
use App\Http\Livewire\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::group(["middleware" => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/user', [UserController::class, "index_view"])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');

    Route::get('/device', [DeviceController::class, "index_view"])->name('device');
    Route::get('/device/scan/{deviceId}', ScanDevice::class)->name('device.scan');
    Route::view('/device/new', "pages.device.device-new")->name('device.new');
    Route::view('/device/edit/{deviceId}', "pages.device.device-edit")->name('device.edit');

    Route::view('/auto-reply', "pages.auto-reply.auto-reply-data")->name('auto-reply');
    Route::view('/auto-reply/new', "pages.auto-reply.auto-reply-new")->name('auto-reply.new');
});