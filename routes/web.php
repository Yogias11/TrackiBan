<?php

use App\Http\Controllers\TrackingBan;
use App\Http\Controllers\Vehicle;
use App\Http\Controllers\VehicleCategory;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('vehicleCat', VehicleCategory::class);
    Route::resource('vehicle', Vehicle::class);
    Route::resource('track', TrackingBan::class);
    Route::get('getRoda/{id}', [\App\Http\Controllers\TrackingBan::class, 'getRoda'])->name('getRoda');
    Route::get('getKontainer/{id}', [\App\Http\Controllers\TrackingBan::class, 'getKontainer'])->name('getKontainer');
    Route::get('show/{id}', [\App\Http\Controllers\TrackingBan::class, 'show'])->name('showId');

    // kontainer
    Route::get('kontainer', [\App\Http\Controllers\TrackingBan::class, 'kontainer'])->name('kontainer');
    Route::post('kontainer', [\App\Http\Controllers\TrackingBan::class, 'create'])->name('kontainer.post');
    Route::post('kontainer-del{id}', [\App\Http\Controllers\TrackingBan::class, 'delete'])->name('kontainer.delete');
    Route::post('kontainer-edit/{id}', [\App\Http\Controllers\TrackingBan::class, 'rubah'])->name('kontainer.update');
    Route::get('kontainer/{id}', [\App\Http\Controllers\TrackingBan::class, 'ubah'])->name('kontainer.edit');
});

Route::get('get-catveh', [\App\Http\Controllers\VehicleCategory::class, 'getData'])->name('get-cat');
